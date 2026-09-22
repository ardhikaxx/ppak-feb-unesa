<?php

use App\Http\Controllers\Admin\AcademicCalendarController;
use App\Http\Controllers\Admin\AccreditationController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdmissionScheduleController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommunityServiceController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HelpdeskController;
use App\Http\Controllers\Admin\LearningOutcomeController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PartnershipController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProgramProfileController;
use App\Http\Controllers\Admin\PublicationController;
use App\Http\Controllers\Admin\ResearchController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TuitionFeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CMS Admin PPAk FEB UNESA - terpisah dari route publik
|--------------------------------------------------------------------------
| Prefix /admin, name admin.*. Seluruh route CMS di dalam grup
| middleware admin.auth + admin.active (kecuali login).
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Autentikasi (rate limited terhadap brute force)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:admin-login')
        ->name('login.store');

    // Lupa password admin (verifikasi email via session, tanpa token email)
    Route::get('/forgot-password', [AuthController::class, 'showForgot'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'verifyEmail'])
        ->middleware('throttle:admin-login')
        ->name('password.email');
    Route::get('/reset-password', [AuthController::class, 'showReset'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->middleware('throttle:admin-login')
        ->name('password.update');

    // RBAC server-side (OWASP): admin.access memeriksa izin berbasis route
    // untuk SETIAP request terotentikasi (deny by default); grup sensitif
    // di bawah dilapisi lagi admin.role:super_admin secara eksplisit.
    Route::middleware(['admin.auth:admin', 'admin.active', 'admin.access'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profil milik sendiri (kedua role).
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        // Modul konten operator: berita, agenda, galeri, dokumen, FAQ,
        // publikasi, kurikulum, dosen, informasi admisi.
        Route::resource('lecturers', LecturerController::class);
        Route::post('/lecturers/{lecturer}/restore', [LecturerController::class, 'restore'])->name('lecturers.restore')->withTrashed();
        Route::resource('curricula', CurriculumController::class)->except(['show']);
        Route::resource('admission-schedules', AdmissionScheduleController::class)->except(['show']);
        Route::resource('tuition-fees', TuitionFeeController::class)->except(['show']);
        Route::resource('faqs', FaqController::class)->except(['show']);
        Route::resource('publications', PublicationController::class)->except(['show']);
        Route::resource('news', NewsController::class);
        Route::post('/news/{news}/restore', [NewsController::class, 'restore'])->name('news.restore')->withTrashed();
        Route::resource('agendas', AgendaController::class);
        Route::post('/agendas/{agenda}/restore', [AgendaController::class, 'restore'])->name('agendas.restore')->withTrashed();
        Route::resource('galleries', GalleryController::class)->except(['show']);
        Route::post('/galleries/{gallery}/restore', [GalleryController::class, 'restore'])->name('galleries.restore')->withTrashed();
        Route::resource('documents', DocumentController::class)->except(['show']);
        Route::post('/documents/{document}/restore', [DocumentController::class, 'restore'])->name('documents.restore')->withTrashed();

        // Area sensitif: khusus super_admin (profil program, CPL, kalender,
        // riset/PKM/mitra, testimoni/alumni, kategori, media, SEO, pengaturan,
        // helpdesk, audit log, kelola admin).
        Route::middleware(['admin.role:super_admin'])->group(function () {
            // Profil PPAk
            Route::get('/program-profile', [ProgramProfileController::class, 'edit'])->name('program-profile.edit');
            Route::put('/program-profile', [ProgramProfileController::class, 'update'])->name('program-profile.update');
            Route::resource('accreditations', AccreditationController::class)->except(['show']);

            // Akademik
            Route::resource('learning-outcomes', LearningOutcomeController::class)->except(['show']);
            Route::resource('academic-calendars', AcademicCalendarController::class)->except(['show']);

            // Riset & pengabdian
            Route::resource('researches', ResearchController::class)->except(['show']);
            Route::resource('community-services', CommunityServiceController::class)->except(['show']);
            Route::resource('partnerships', PartnershipController::class)->except(['show']);

            // Kemahasiswaan & alumni
            Route::resource('testimonials', TestimonialController::class)->except(['show']);
            Route::resource('alumni', AlumniController::class)->except(['show']);

            // Dokumen & media
            Route::resource('categories', CategoryController::class)->except(['show']);
            Route::get('/media', [MediaController::class, 'index'])->name('media.index');
            Route::delete('/media', [MediaController::class, 'destroy'])->name('media.destroy');

            // Website & sistem
            Route::get('/seo-health', [\App\Http\Controllers\Admin\SeoHealthController::class, 'index'])->name('seo-health.index');
            Route::post('/seo-health/flush-cache', [\App\Http\Controllers\Admin\SeoHealthController::class, 'flushCache'])->name('seo-health.flush-cache');
            Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
            Route::put('/site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
            Route::get('/helpdesk', [HelpdeskController::class, 'index'])->name('helpdesk.index');
            Route::get('/helpdesk/{inquiry}', [HelpdeskController::class, 'show'])->name('helpdesk.show');
            Route::patch('/helpdesk/{inquiry}', [HelpdeskController::class, 'update'])->name('helpdesk.update');
            Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');

            // Akun
            Route::resource('admins', AdminAccountController::class)->except(['show']);
        });
    });
});
