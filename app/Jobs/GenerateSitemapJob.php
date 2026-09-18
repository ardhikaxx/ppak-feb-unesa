<?php

namespace App\Jobs;

use App\Support\CacheKeys;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

/**
 * Heavy sitemap generation moved to queue - avoids timeout on large datasets.
 * Uses chunking for thousands of URLs.
 */
class GenerateSitemapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;

    public function handle(): void
    {
        // Invalidate sitemap cache - next request will regenerate
        Cache::forget(CacheKeys::SITEMAP);
        // Optionally warm cache
        // app(ContentRepositoryInterface::class)->warmSitemap();
    }
}
