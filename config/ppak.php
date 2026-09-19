<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PPAk FEB UNESA - Scalable Institution Configuration
    |--------------------------------------------------------------------------
    | Single source of truth for institution identity, pagination, cache TTL,
    | SEO defaults, and scalability thresholds. All controllers/components
    | read from here instead of hardcoding values in Blade.
    */

    'institution' => [
        'name' => env('PPAK_NAME', 'Pendidikan Profesi Akuntan'),
        'faculty' => env('PPAK_FACULTY', 'Fakultas Ekonomika dan Bisnis'),
        'university' => env('PPAK_UNIVERSITY', 'Universitas Negeri Surabaya'),
        'short_name' => env('PPAK_SHORT', 'PPAk FEB UNESA'),
        'program_code' => env('PPAK_CODE', '62902'),
        'email' => env('PPAK_EMAIL', 'ppak.feb@unesa.ac.id'),
        'phone' => env('PPAK_PHONE', '+62 31 828 0009'),
        'address' => env('PPAK_ADDRESS', 'Gedung G6 FEB Kampus Ketintang, Surabaya'),
    ],

    'pagination' => [
        'home_berita' => (int) env('PPAK_PER_PAGE_BERITA_HOME', 3),
        'berita' => (int) env('PPAK_PER_PAGE_BERITA', 6),
        'agenda' => (int) env('PPAK_PER_PAGE_AGENDA', 5),
        'galeri' => (int) env('PPAK_PER_PAGE_GALERI', 12),
        'dosen' => (int) env('PPAK_PER_PAGE_DOSEN', 8),
        'dokumen' => (int) env('PPAK_PER_PAGE_DOKUMEN', 10),
        'testimoni' => (int) env('PPAK_PER_PAGE_TESTIMONI', 3),
    ],

    'cache' => [
        'ttl' => [
            'institution' => 3600, // 1 hour
            'static' => 3600,
            'dynamic' => 600, // 10 min for news/agenda
            'sitemap' => 3600,
        ],
        'prefix' => env('CACHE_PREFIX', 'ppak'),
    ],

    'seo' => [
        'title_suffix' => ' | PPAk FEB UNESA',
        'default_title' => 'Pendidikan Profesi Akuntan FEB UNESA | Universitas Negeri Surabaya',
        'default_description' => 'Program Studi Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya mempersiapkan akuntan profesional berkarakter, beretika, dan kompeten.',
        'default_keywords' => 'PPAk, Pendidikan Profesi Akuntan, PPAk FEB UNESA, Pendidikan Profesi Akuntan UNESA, PPAk UNESA, Profesi Akuntan UNESA, FEB UNESA, Akuntan, CA Indonesia, CPA of Indonesia',
        'default_image' => '/images/og-ppak-unesa.jpg',
    ],

    'media' => [
        // Image variants - avoid serving raw camera uploads
        'variants' => [
            'thumb' => ['width' => 400, 'height' => 300],
            'card' => ['width' => 600, 'height' => 400],
            'hero' => ['width' => 1200, 'height' => 630],
        ],
        'max_upload_size' => 5 * 1024 * 1024, // 5MB
        'allowed_mimes' => ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'],
    ],

    'search' => [
        'min_length' => 2,
        'per_category_limit' => 6,
        // Future: driver 'database' -> 'meilisearch' without changing Blade
        'driver' => env('SEARCH_DRIVER', 'database'),
    ],

    'rate_limit' => [
        'search' => '30,1', // 30/min
        'helpdesk' => '10,1',
        'download' => '60,1',
    ],
];
