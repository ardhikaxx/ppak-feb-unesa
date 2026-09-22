<?php

namespace App\Http\Controllers;

use App\Contracts\ContentRepositoryInterface;
use App\Support\CacheKeys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class InformasiController extends Controller
{
    public function __construct(private ContentRepositoryInterface $content) {}

    /**
     * Berita list - paginated, filterable, projection.
     * Never Model::all() - always pagination.
     */
    public function berita(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'kategori' => ['nullable', 'string', 'max:50'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $perPage = config('ppak.pagination.berita', 6);
        $search = $request->query('q');
        $category = $request->query('kategori');

        $paginated = $this->content->getBeritaPaginated($perPage, $search, $category);

        // Featured is first item of first page when no search
        $featured = null;
        $allForCount = $this->content->getBerita();
        if (!$search && !$category && $paginated->currentPage() === 1 && $paginated->count() > 0) {
            $featured = $paginated->first();
            // Remove featured from list is handled in view by slicing, but we provide paginated without featured for clean UI
        }

        // URL filter/pencarian berita bukan landing page: noindex agar tidak duplikat.
        $robots = ($search || $category) ? 'noindex,follow' : 'index,follow';

        return view('informasi.berita', [
            'featured' => $featured,
            'berita' => $paginated,
            'allBerita' => $allForCount,
            'info' => $this->content->getGeneralInfo(),
            'robots' => $robots,
        ]);
    }

    /**
     * Slug-based detail - uses indexed slug column when DB.
     * 404 handled gracefully with custom error page.
     */
    public function beritaDetail(string $slug): View
    {
        $article = $this->content->findBeritaBySlug($slug);

        if (!$article) {
            abort(404);
        }

        $related = $this->content->getRelatedBerita($slug, 3);

        return view('informasi.berita-detail', [
            'article' => $article,
            'related' => $related,
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    /**
     * Agenda - paginated, with upcoming/past filter. Server-side, not Collection::filter in Blade.
     */
    public function agenda(Request $request): View
    {
        $request->validate([
            'page' => ['nullable', 'integer', 'min:1'],
            'filter' => ['nullable', 'in:upcoming,past,all'],
        ]);

        $filter = $request->query('filter', 'all');
        $perPage = config('ppak.pagination.agenda', 5);

        if ($filter === 'past') {
            $items = array_filter($this->content->getAgenda(), fn($e) => !$e['is_upcoming']);
            $agenda = \App\Support\ArrayPaginator::paginate(array_values($items), $perPage);
        } elseif ($filter === 'upcoming') {
            $agenda = $this->content->getAgendaPaginated($perPage, true);
        } else {
            $items = $this->content->getAgenda();
            $agenda = \App\Support\ArrayPaginator::paginate($items, $perPage);
        }

        return view('informasi.agenda', [
            'agenda' => $agenda,
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function galeri(Request $request): View
    {
        $perPage = config('ppak.pagination.galeri', 12);
        $galeri = $this->content->getGaleri();
        // Paginate gallery for large datasets
        $paginated = \App\Support\ArrayPaginator::paginate($galeri, $perPage);

        return view('informasi.galeri', [
            'galeri' => $paginated,
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    /**
     * robots.txt dinamis: izinkan publik + aset, tutup /admin/*,
     * rujuk sitemap absolut sesuai APP_URL production.
     */
    public function robots(): Response
    {
        $sitemap = rtrim(config('app.url'), '/') . '/sitemap.xml';
        $sitemapNews = rtrim(config('app.url'), '/') . '/sitemap-news.xml';

        $content = "User-agent: *\n"
            . "Allow: /\n"
            . "Disallow: /admin/\n"
            . "Disallow: /admin\n"
            . "\n"
            . "Sitemap: {$sitemap}\n"
            . "Sitemap: {$sitemapNews}\n";

        return response($content, 200, ['Content-Type' => 'text/plain']);
    }

    /**
     * XML sitemap dari database: hanya URL kanonis HTTP 200 yang layak indeks
     * (tanpa admin/login/draft/noindex/duplikat). lastmod = perubahan nyata.
     */
    public function sitemap(): Response
    {
        $xml = Cache::remember(CacheKeys::SITEMAP, config('ppak.cache.ttl.sitemap', 3600), function () {
            $entry = fn (string $loc, ?string $lastmod = null, string $freq = 'weekly', string $priority = '0.7') => [
                'loc' => $loc, 'lastmod' => $lastmod, 'changefreq' => $freq, 'priority' => $priority,
            ];

            $urls = collect([
                $entry(route('home'), null, 'daily', '1.0'),
                $entry(route('profil.sejarah')),
                $entry(route('profil.visi-misi')),
                $entry(route('profil.struktur-organisasi')),
                $entry(route('profil.dosen-pengajar')),
                $entry(route('profil.akreditasi')),
                $entry(route('akademik.kurikulum')),
                $entry(route('akademik.kalender')),
                $entry(route('akademik.gelar-sertifikasi')),
                $entry(route('akademik.panduan')),
                $entry(route('admisi.jalur-syarat')),
                $entry(route('admisi.biaya')),
                $entry(route('admisi.prosedur-jadwal')),
                $entry(route('admisi.faq')),
                $entry(route('riset-pengabdian.riset-publikasi')),
                $entry(route('riset-pengabdian.pengabdian')),
                $entry(route('riset-pengabdian.kerja-sama')),
                $entry(route('kemahasiswaan-alumni.alumni')),
                $entry(route('kemahasiswaan-alumni.mahasiswa')),
                $entry(route('kemahasiswaan-alumni.testimoni-karier')),
                $entry(route('informasi.berita'), null, 'daily', '0.9'),
                $entry(route('informasi.agenda')),
                $entry(route('informasi.galeri')),
                $entry(route('kontak.lokasi')),
                $entry(route('kontak.helpdesk')),
                $entry(route('kontak.unduhan')),
            ]);

            // Berita terbit saja (chunked, siap ribuan URL).
            \App\Models\News::published()
                ->select(['slug', 'updated_at'])
                ->orderByDesc('published_at')
                ->chunk(500, function ($items) use ($urls) {
                    foreach ($items as $item) {
                        $urls->push([
                            'loc' => route('informasi.berita.detail', $item->slug),
                            'lastmod' => $item->updated_at?->toAtomString(),
                            'changefreq' => 'weekly',
                            'priority' => '0.7',
                        ]);
                    }
                });

            // PDF publik (nama deskriptif, URL stabil) beserta lastmod file.
            \App\Models\Document::where('status', 'published')
                ->select(['filename', 'updated_at'])
                ->orderByDesc('year')
                ->chunk(500, function ($items) use ($urls) {
                    foreach ($items as $item) {
                        $urls->push([
                            'loc' => route('kontak.unduhan.download', $item->filename),
                            'lastmod' => $item->updated_at?->toAtomString(),
                            'changefreq' => 'monthly',
                            'priority' => '0.5',
                        ]);
                    }
                });

            $xmlContent = view('sitemap', ['urls' => $urls])->render();

            return $xmlContent;
        });

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    /**
     * Sitemap khusus berita: XML terpisah untuk News Google.
     * Hanya berita published, noindex excluded.
     */
    public function sitemapNews(): Response
    {
        $xml = Cache::remember('ppak:sitemap:news', config('ppak.cache.ttl.sitemap', 3600), function () {
            $urls = collect();

            \App\Models\News::published()
                ->select(['slug', 'title', 'updated_at', 'published_at', 'robots_index'])
                ->where('robots_index', true)
                ->orderByDesc('published_at')
                ->chunk(500, function ($items) use ($urls) {
                    foreach ($items as $item) {
                        $urls->push([
                            'loc' => route('informasi.berita.detail', $item->slug),
                            'lastmod' => $item->updated_at?->toAtomString(),
                            'news_title' => $item->title,
                            'news_date' => $item->published_at?->toAtomString(),
                        ]);
                    }
                });

            return view('sitemap-news', ['urls' => $urls])->render();
        });

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}

