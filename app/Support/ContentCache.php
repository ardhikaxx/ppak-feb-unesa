<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

/**
 * Invalidate cache konten publik setiap Admin menyimpan perubahan,
 * sehingga perubahan CMS langsung terlihat tanpa caching berlebihan.
 */
final class ContentCache
{
    public static function flush(): void
    {
        $keys = [
            CacheKeys::INSTITUTION_INFO,
            CacheKeys::STATS,
            CacheKeys::KEUNGGULAN,
            CacheKeys::KOMPETENSI,
            CacheKeys::BERITA_ALL,
            CacheKeys::BERITA_FEATURED,
            CacheKeys::BERITA_HOME,
            CacheKeys::BERITA_PAGINATED,
            CacheKeys::AGENDA_ALL,
            CacheKeys::AGENDA_HOME,
            CacheKeys::DOSEN_ALL,
            CacheKeys::DOSEN_HOME,
            CacheKeys::MITRA,
            CacheKeys::TESTIMONI,
            CacheKeys::KARIER_SECTORS,
            CacheKeys::KURIKULUM,
            CacheKeys::KALENDER,
            CacheKeys::ADMISI,
            CacheKeys::FAQ,
            CacheKeys::RISET,
            CacheKeys::PENGABDIAN,
            CacheKeys::GALERI,
            CacheKeys::UNDUHAN,
            CacheKeys::NAVIGATION,
            CacheKeys::FOOTER,
            CacheKeys::SITEMAP,
            SiteSetting::CACHE_KEY,
        ];

        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }
}
