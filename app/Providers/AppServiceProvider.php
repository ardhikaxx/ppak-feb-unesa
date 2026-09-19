<?php

namespace App\Providers;

use App\Contracts\ContentRepositoryInterface;
use App\Repositories\ArrayContentRepository;
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
     * Binds abstraction to array implementation now, Eloquent later without changing consumers.
     */
    public function register(): void
    {
        $this->app->singleton(ContentRepositoryInterface::class, ArrayContentRepository::class);

        // Cache store abstraction - allows Redis swap without changing business logic
        $this->app->singleton('ppak.cache', fn() => app('cache'));
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
        RateLimiter::for('search', fn(Request $request) => Limit::perMinute(30)->by($request->ip()));
        RateLimiter::for('helpdesk', fn(Request $request) => Limit::perMinute(10)->by($request->ip()));
        RateLimiter::for('download', fn(Request $request) => Limit::perMinute(60)->by($request->ip()));

        // Shared institution info for topbar/footer - cached, not queried per view
        // Only for layouts that need it; lazy via View::composer to avoid running on every request unnecessarily
        View::composer(['partials.topbar', 'partials.footer', 'layouts.app'], function ($view) {
            // Lightweight, cached via repository
            $view->with('ppakInstitution', app(ContentRepositoryInterface::class)->getGeneralInfo());
        });
    }
}
