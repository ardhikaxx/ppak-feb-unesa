<?php

namespace App\Providers;

use App\Contracts\ContentRepositoryInterface;
use App\Models\HelpdeskInquiry;
use App\Models\SiteSetting;
use App\Repositories\EloquentContentRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
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
     * - Rate limiting for search/helpdesk/download
     */
    public function boot(): void
    {
        // Use custom numbers-only pagination styling
        Paginator::defaultView('vendor.pagination.numbers');

        // Rate limiters - prevent abuse on public endpoints
        RateLimiter::for('search', fn (Request $request) => Limit::perMinute(30)->by($request->ip()));
        RateLimiter::for('helpdesk', fn (Request $request) => Limit::perMinute(10)->by($request->ip()));
        RateLimiter::for('download', fn (Request $request) => Limit::perMinute(60)->by($request->ip()));
        // Admin login: 5 percobaan/menit per email+IP (anti brute force)
        RateLimiter::for('admin-login', function (Request $request) {
            $key = mb_strtolower((string) $request->input('email')).'|'.$request->ip();

            return Limit::perMinute(5)->by($key)->response(function () {
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
}
