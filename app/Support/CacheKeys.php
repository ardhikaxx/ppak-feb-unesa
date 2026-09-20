<?php

namespace App\Support;

/**
 * Centralized cache key namespace - prevents collision, enables invalidation.
 * Scalable to Redis with tags or versioning.
 */
final class CacheKeys
{
    public const INSTITUTION_INFO = 'ppak:institution:info';
    public const STATS = 'ppak:stats';
    public const KEUNGGULAN = 'ppak:keunggulan';
    public const KOMPETENSI = 'ppak:kompetensi';
    public const BERITA_ALL = 'ppak:berita:all';
    public const BERITA_FEATURED = 'ppak:berita:featured';
    public const BERITA_HOME = 'ppak:berita:home';
    public const BERITA_PAGINATED = 'ppak:berita:paginated';
    public const BERITA_SLUG = 'ppak:berita:slug:';
    public const AGENDA_ALL = 'ppak:agenda:all';
    public const AGENDA_HOME = 'ppak:agenda:home';
    public const DOSEN_ALL = 'ppak:dosen:all';
    public const DOSEN_HOME = 'ppak:dosen:home';
    public const MITRA = 'ppak:mitra';
    public const TESTIMONI = 'ppak:testimoni';
    public const KARIER_SECTORS = 'ppak:karier:sectors';
    public const KURIKULUM = 'ppak:kurikulum';
    public const KALENDER = 'ppak:kalender';
    public const ADMISI = 'ppak:admisi';
    public const FAQ = 'ppak:faq';
    public const RISET = 'ppak:riset';
    public const PENGABDIAN = 'ppak:pengabdian';
    public const GALERI = 'ppak:galeri';
    public const UNDUHAN = 'ppak:unduhan';
    public const NAVIGATION = 'ppak:navigation';
    public const FOOTER = 'ppak:footer';
    public const SITEMAP = 'ppak:sitemap';
    public const PAGE_CONTENT = 'ppak:page-content:';

    public static function beritaSlug(string $slug): string
    {
        return self::BERITA_SLUG . $slug;
    }

    public static function paginated(string $base, int $page, int $perPage, string $search = ''): string
    {
        $suffix = $search !== '' ? ':search:' . md5($search) : '';
        return $base . ':page:' . $page . ':per:' . $perPage . $suffix;
    }
}
