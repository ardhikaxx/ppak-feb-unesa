<?php

namespace App\Http\Controllers\Admin;

use App\Services\SeoService;
use App\Support\CacheKeys;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SeoHealthController extends BaseAdminController
{
    public function index(): View
    {
        $health = SeoService::auditHealth();
        $sitemapUrl = rtrim(config('app.url'), '/') . '/sitemap.xml';
        $robotsUrl = rtrim(config('app.url'), '/') . '/robots.txt';

        $sitemapCached = Cache::has(CacheKeys::SITEMAP);

        return view('admin.seo-health.index', compact('health', 'sitemapUrl', 'robotsUrl', 'sitemapCached'));
    }

    public function flushCache(Request $request): RedirectResponse
    {
        Cache::forget(CacheKeys::SITEMAP);
        $this->flushContentCache();
        $this->audit('cache_cleared', null, ['action' => 'SEO and sitemap cache flushed']);

        return redirect()->route('admin.seo-health.index')->with('success', 'Cache SEO dan XML Sitemap berhasil dibersihkan dan diperbarui.');
    }
}
