<?php

namespace App\Services;

use App\Models\SiteSetting;

/**
 * Pusat metadata SEO dengan hierarki fallback:
 * field khusus konten > judul/excerpt konten > default Site Settings > config.
 * Semua URL absolut memakai APP_URL sehingga benar di production.
 */
class SeoService
{
    public static function siteTitle(): string
    {
        return SiteSetting::get(
            'site_title',
            config('ppak.seo.default_title')
        ) ?? config('ppak.seo.default_title');
    }

    public static function siteDescription(): string
    {
        return SiteSetting::get(
            'meta_description',
            config('ppak.seo.default_description')
        ) ?? config('ppak.seo.default_description');
    }

    /**
     * OG image institusional STATIS (public/images/og-ppak-unesa.jpg).
     * Sengaja tidak diambil dari SiteSetting agar admin tidak dapat
     * mengubahnya; konsistensi preview sosial selalu terjaga.
     */
    public static function defaultOgImage(): string
    {
        return self::absoluteUrl(config('ppak.seo.default_image'));
    }

    public static function absoluteUrl(?string $path): string
    {
        if (! $path) {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return rtrim(config('app.url'), '/') . '/' . ltrim($path, '/');
    }

    public static function build(
        ?string $title = null,
        ?string $description = null,
        ?string $image = null,
        ?string $canonical = null,
        array $extra = []
    ): array {
        $config = config('ppak.seo');

        $title = $title ? $title . $config['title_suffix'] : self::siteTitle();
        $description = $description ?: self::siteDescription();
        $image = $image ? self::absoluteUrl($image) : self::defaultOgImage();
        $canonical = $canonical ?: url()->current();

        return array_merge([
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'og_type' => $extra['og_type'] ?? 'website',
            'og_title' => $title,
            'og_description' => $description,
            'og_image' => $image,
            'og_url' => $canonical,
            'twitter_card' => 'summary_large_image',
        ], $extra);
    }

    /**
     * Metadata untuk satu artikel berita (dipakai controller + Blade detail).
     */
    public static function forNews(array $article, string $url): array
    {
        $title = $article['seo_title'] ?? $article['title'];
        $description = $article['seo_description'] ?? $article['excerpt'];

        return self::build(
            title: $title,
            description: $description,
            image: $article['og_image'] ?? $article['image'] ?? null,
            canonical: $article['canonical_url'] ?? $url,
            extra: [
                'og_type' => 'article',
                'og_title' => $article['og_title'] ?? $title,
                'og_description' => $article['og_description'] ?? $description,
                'robots' => ($article['robots_index'] ?? true) ? 'index,follow' : 'noindex,follow',
            ]
        );
    }

    public static function organizationJsonLd(): array
    {
        $socials = array_filter([
            SiteSetting::get('social_instagram', 'https://instagram.com/ppak.unesa'),
            SiteSetting::get('social_youtube', 'https://youtube.com/@ppakfebunesa'),
            SiteSetting::get('social_linkedin'),
        ]);

        return [
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => config('ppak.institution.name') . ' ' . config('ppak.institution.faculty'),
            'alternateName' => 'PPAk FEB UNESA',
            'url' => config('app.url'),
            'logo' => self::absoluteUrl('images/logo-unesa.png'),
            'image' => self::defaultOgImage(),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => config('ppak.institution.address'),
                'addressLocality' => 'Surabaya',
                'addressRegion' => 'Jawa Timur',
                'postalCode' => '60231',
                'addressCountry' => 'ID',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => config('ppak.institution.phone'),
                'contactType' => 'Admissions & Academic Support',
                'email' => config('ppak.institution.email'),
                'availableLanguage' => ['Indonesian', 'English'],
            ],
            'sameAs' => array_values($socials),
        ];
    }

    public static function websiteJsonLd(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => self::siteTitle(),
            'alternateName' => 'PPAk FEB UNESA',
            'url' => config('app.url'),
        ];
    }

    public static function breadcrumbJsonLd(array $breadcrumbs): array
    {
        $items = [];
        $position = 1;
        foreach ($breadcrumbs as $crumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $crumb['label'],
                'item' => $crumb['url'] ?? url()->current(),
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }

    /**
     * Article schema dari data yang benar-benar tampil di halaman.
     * Tanpa rating/review palsu; author & tanggal dari database.
     */
    public static function articleJsonLd(array $article, string $url): array
    {
        $image = $article['og_image'] ?? $article['image'] ?? null;

        return [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $article['title'],
            'description' => $article['excerpt'] ?? null,
            'image' => $image ? [self::absoluteUrl($image)] : null,
            'datePublished' => $article['date_raw'] ?? null,
            'dateModified' => $article['updated_at'] ?? $article['date_raw'] ?? null,
            'author' => [
                '@type' => 'Organization',
                'name' => $article['author'] ?? 'PPAk FEB UNESA',
            ],
            'publisher' => [
                '@type' => 'EducationalOrganization',
                'name' => 'PPAk FEB UNESA - Universitas Negeri Surabaya',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => self::absoluteUrl('images/logo-unesa.png'),
                ],
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $url,
            ],
        ];
    }

    /**
     * Event schema untuk agenda/kegiatan ilmiah resmi.
     */
    public static function eventsJsonLd(iterable $agendas): array
    {
        $events = [];
        foreach ($agendas as $agenda) {
            if (is_array($agenda)) {
                $title = $agenda['title'] ?? 'Agenda Akademik';
                $desc = $agenda['desc'] ?? null;
                $venue = $agenda['venue'] ?? 'Gedung G6 FEB UNESA Kampus Ketintang';
                $startDate = $agenda['date_raw'] ?? null;
                $status = ($agenda['status'] ?? 'upcoming') === 'cancelled'
                    ? 'https://schema.org/EventCancelled'
                    : 'https://schema.org/EventScheduled';
            } else {
                $title = $agenda->title;
                $desc = $agenda->description;
                $venue = $agenda->venue ?: 'Gedung G6 FEB UNESA Kampus Ketintang';
                $startDate = $agenda->event_date?->format('Y-m-d');
                $status = $agenda->status === 'cancelled'
                    ? 'https://schema.org/EventCancelled'
                    : 'https://schema.org/EventScheduled';
            }

            $eventItem = [
                '@type' => 'Event',
                'name' => $title,
                'description' => $desc,
                'eventStatus' => $status,
                'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
                'location' => [
                    '@type' => 'Place',
                    'name' => $venue,
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => config('ppak.institution.address'),
                        'addressLocality' => 'Surabaya',
                        'addressRegion' => 'Jawa Timur',
                        'postalCode' => '60231',
                        'addressCountry' => 'ID',
                    ],
                ],
                'organizer' => [
                    '@type' => 'EducationalOrganization',
                    'name' => 'PPAk FEB UNESA',
                    'url' => config('app.url'),
                ],
            ];

            if ($startDate) {
                $eventItem['startDate'] = $startDate;
            }

            $events[] = $eventItem;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'itemListElement' => array_map(function ($event, $index) {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'item' => $event,
                ];
            }, $events, array_keys($events)),
        ];
    }

    /**
     * Person schema untuk profil pengajar / dosen PPAk.
     */
    public static function lecturersJsonLd(iterable $lecturers): array
    {
        $items = [];
        $index = 1;
        foreach ($lecturers as $d) {
            $name = is_array($d) ? ($d['name'] ?? '') : $d->name;
            $gelar = is_array($d) ? ($d['gelar'] ?? '') : $d->title_degree;
            $email = is_array($d) ? ($d['email'] ?? '') : $d->email;
            $image = is_array($d) ? ($d['image'] ?? null) : $d->photo;
            $role = is_array($d) ? ($d['status_label'] ?? $d['role'] ?? 'Dosen Pengajar') : $d->role;

            $person = [
                '@type' => 'Person',
                'name' => $name,
                'jobTitle' => $role . ($gelar ? " ({$gelar})" : ''),
                'worksFor' => [
                    '@type' => 'EducationalOrganization',
                    'name' => 'Universitas Negeri Surabaya - FEB PPAk',
                    'url' => config('app.url'),
                ],
            ];

            if ($email) {
                $person['email'] = $email;
            }
            if ($image) {
                $person['image'] = self::absoluteUrl($image);
            }

            $items[] = [
                '@type' => 'ListItem',
                'position' => $index++,
                'item' => $person,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'itemListElement' => $items,
        ];
    }

    /**
     * Audit kesehatan SEO database & sistem.
     */
    public static function auditHealth(): array
    {
        $newsTotal = \App\Models\News::count();
        $newsPublished = \App\Models\News::published()->count();
        $newsMissingFeaturedImage = \App\Models\News::published()->whereNull('image')->count();
        $newsMissingSeoTitle = \App\Models\News::published()->whereNull('seo_title')->count();
        $newsMissingSeoDesc = \App\Models\News::published()->whereNull('seo_description')->count();
        $newsNoindex = \App\Models\News::where('robots_index', false)->count();

        $agendaTotal = \App\Models\Agenda::count();
        $agendaMissingSeoTitle = \App\Models\Agenda::whereNull('seo_title')->count();
        $agendaNoindex = \App\Models\Agenda::where('robots_index', false)->count();

        $documentsTotal = \App\Models\Document::where('status', 'published')->count();

        $siteTitle = SiteSetting::get('site_title', config('ppak.seo.default_title'));
        $metaDesc = SiteSetting::get('meta_description', config('ppak.seo.default_description'));

        $publicRoutes = [
            'Beranda' => route('home'),
            'Profil: Sejarah' => route('profil.sejarah'),
            'Profil: Visi & Misi' => route('profil.visi-misi'),
            'Profil: Struktur Organisasi' => route('profil.struktur-organisasi'),
            'Profil: Dosen & Pengajar' => route('profil.dosen-pengajar'),
            'Profil: Akreditasi' => route('profil.akreditasi'),
            'Akademik: Kurikulum' => route('akademik.kurikulum'),
            'Akademik: Kalender' => route('akademik.kalender'),
            'Akademik: Gelar & Sertifikasi' => route('akademik.gelar-sertifikasi'),
            'Akademik: Panduan' => route('akademik.panduan'),
            'Admisi: Jalur & Syarat' => route('admisi.jalur-syarat'),
            'Admisi: Biaya UKT' => route('admisi.biaya'),
            'Admisi: Prosedur & Jadwal' => route('admisi.prosedur-jadwal'),
            'Admisi: FAQ' => route('admisi.faq'),
            'Riset & Pengabdian: Publikasi' => route('riset-pengabdian.riset-publikasi'),
            'Riset & Pengabdian: PKM' => route('riset-pengabdian.pengabdian'),
            'Riset & Pengabdian: Kerja Sama' => route('riset-pengabdian.kerja-sama'),
            'Kemahasiswaan: Alumni' => route('kemahasiswaan-alumni.alumni'),
            'Kemahasiswaan: Kegiatan' => route('kemahasiswaan-alumni.mahasiswa'),
            'Kemahasiswaan: Testimoni' => route('kemahasiswaan-alumni.testimoni-karier'),
            'Informasi: Berita' => route('informasi.berita'),
            'Informasi: Agenda' => route('informasi.agenda'),
            'Informasi: Galeri' => route('informasi.galeri'),
            'Kontak: Lokasi' => route('kontak.lokasi'),
            'Kontak: Helpdesk' => route('kontak.helpdesk'),
            'Kontak: Unduhan' => route('kontak.unduhan'),
        ];

        return [
            'routes_count' => count($publicRoutes),
            'public_routes' => $publicRoutes,
            'news' => [
                'total' => $newsTotal,
                'published' => $newsPublished,
                'missing_featured_image' => $newsMissingFeaturedImage,
                'missing_custom_title' => $newsMissingSeoTitle,
                'missing_custom_desc' => $newsMissingSeoDesc,
                'noindex_count' => $newsNoindex,
            ],
            'agenda' => [
                'total' => $agendaTotal,
                'missing_custom_title' => $agendaMissingSeoTitle,
                'noindex_count' => $agendaNoindex,
            ],
            'documents_in_sitemap' => $documentsTotal,
            'settings' => [
                'has_site_title' => !empty($siteTitle),
                'has_meta_description' => !empty($metaDesc),
                'default_og_image' => config('ppak.seo.default_image'),
                'og_image_exists' => file_exists(public_path(ltrim(config('ppak.seo.default_image'), '/'))),
            ],
        ];
    }
}
