<?php

namespace App\Providers;

use App\Contracts\ContentRepositoryInterface;
use App\Models\Admin;
use App\Models\AcademicCalendar;
use App\Models\AcademicCurriculum;
use App\Models\Accreditation;
use App\Models\AdmissionSchedule;
use App\Models\Agenda;
use App\Models\AlumniRecord;
use App\Models\AuditLog;
use App\Models\Category;
use App\Models\CommunityService;
use App\Models\Document;
use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\HelpdeskInquiry;
use App\Models\LearningOutcome;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\Partnership;
use App\Models\ProgramProfile;
use App\Models\Publication;
use App\Models\Research;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\TuitionFee;
use App\Policies\ContentPolicy;
use App\Policies\SuperAdminPolicy;
use App\Repositories\EloquentContentRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Frontend publik membaca dari DATABASE via EloquentContentRepository
     * dengan bentuk array yang identik seperti sebelumnya (tanpa ubah Blade).
     */
    public function register(): void
    {
        $this->app->singleton(ContentRepositoryInterface::class, EloquentContentRepository::class);

        // Cache store abstraction - allows Redis swap without changing business logic
        $this->app->singleton('ppak.cache', fn () => app('cache'));
    }

    /**
     * Bootstrap any application services.
     * - Shared view data via View Composer (efficient, not per-request heavy query)
     * - Pagination style
     * - Rate limiting for helpdesk/download
     */
    public function boot(): void
    {
        // Produksi (ppak-feb-unesa.ac.id): paksa skema HTTPS untuk semua
        // URL yang digenerate (asset, sitemap, OG image, canonical).
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }

        // Use custom numbers-only pagination styling
        Paginator::defaultView('vendor.pagination.numbers');

        // Otorisasi per-resource (Laravel Policy): pemetaan model -> kebijakan.
        // Model yang tidak terdaftar di sini otomatis ditolak Gate (deny by default).
        Gate::policy(News::class, ContentPolicy::class);
        Gate::policy(Agenda::class, ContentPolicy::class);
        Gate::policy(Gallery::class, ContentPolicy::class);
        Gate::policy(Document::class, ContentPolicy::class);
        Gate::policy(FAQ::class, ContentPolicy::class);
        Gate::policy(Publication::class, ContentPolicy::class);
        Gate::policy(AcademicCurriculum::class, ContentPolicy::class);
        Gate::policy(Lecturer::class, ContentPolicy::class);
        Gate::policy(AdmissionSchedule::class, ContentPolicy::class);
        Gate::policy(TuitionFee::class, ContentPolicy::class);

        Gate::policy(ProgramProfile::class, SuperAdminPolicy::class);
        Gate::policy(Accreditation::class, SuperAdminPolicy::class);
        Gate::policy(LearningOutcome::class, SuperAdminPolicy::class);
        Gate::policy(AcademicCalendar::class, SuperAdminPolicy::class);
        Gate::policy(Research::class, SuperAdminPolicy::class);
        Gate::policy(CommunityService::class, SuperAdminPolicy::class);
        Gate::policy(Partnership::class, SuperAdminPolicy::class);
        Gate::policy(Testimonial::class, SuperAdminPolicy::class);
        Gate::policy(AlumniRecord::class, SuperAdminPolicy::class);
        Gate::policy(Category::class, SuperAdminPolicy::class);
        Gate::policy(Admin::class, SuperAdminPolicy::class);
        Gate::policy(SiteSetting::class, SuperAdminPolicy::class);
        Gate::policy(HelpdeskInquiry::class, SuperAdminPolicy::class);
        Gate::policy(AuditLog::class, SuperAdminPolicy::class);

        // Rate limiters - prevent abuse on public endpoints (nilai dari config/ppak.php)
        RateLimiter::for('helpdesk', fn (Request $request) => Limit::perMinute(self::rateLimit('ppak.rate_limit.helpdesk', 10))->by($request->ip()));
        RateLimiter::for('download', fn (Request $request) => Limit::perMinute(self::rateLimit('ppak.rate_limit.download', 60))->by($request->ip()));
        // Admin login: 5 percobaan/menit per email+IP (anti brute force)
        RateLimiter::for('admin-login', function (Request $request) {
            $key = mb_strtolower((string) $request->input('email')).'|'.$request->ip();

            return Limit::perMinute(self::rateLimit('ppak.rate_limit.admin_login', 5))->by($key)->response(function () {
                return back()->withErrors(['email' => 'Terlalu banyak percobaan login. Coba lagi dalam 1 menit.'])->onlyInput('email');
            });
        });

        // Shared institution info for topbar/footer - cached, not queried per view
        // Only for layouts that need it; lazy via View::composer to avoid running on every request unnecessarily
        View::composer(['partials.topbar', 'partials.footer', 'layouts.app'], function ($view) {
            // Lightweight, cached via repository
            $view->with('ppakInstitution', app(ContentRepositoryInterface::class)->getGeneralInfo());
            // Site Settings global (kontak, SEO) - cached key-value, tanpa query di Blade
            $view->with('siteContact', SiteSetting::allKeyed());
        });

        // Badge helpdesk terbuka pada sidebar CMS (hanya saat admin login)
        View::composer('admin.layouts.app', function ($view) {
            $open = 0;
            if (auth('admin')->check()) {
                $open = HelpdeskInquiry::where('status', 'open')->count();
            }
            $view->with('helpdeskOpenCount', $open);
        });
    }

    /**
     * Baca nilai rate limit dari config (format throttle Laravel "10,1" atau angka polos).
     */
    private static function rateLimit(string $key, int $default): int
    {
        return (int) explode(',', (string) config($key, $default))[0];
    }
}
