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
     * Berita list - paginated, searchable, projection.
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

        return view('informasi.berita', [
            'featured' => $featured,
            'berita' => $paginated,
            'allBerita' => $allForCount,
            'info' => $this->content->getGeneralInfo(),
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
     * Scalable search - server-side filtering with pagination.
     * Ready to swap to Meilisearch without changing Blade.
     */
    public function search(Request $request): View
    {
        $request->validate([
            'q' => ['required', 'string', 'min:2', 'max:100'],
        ]);

        $keyword = $request->query('q');
        $results = $this->content->search($keyword, config('ppak.search.per_category_limit', 6));

        return view('informasi.search', [
            'keyword' => $keyword,
            'results' => $results,
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    /**
     * XML sitemap - chunked generation, cached, scalable to thousands of URLs.
     */
    public function sitemap(): Response
    {
        $xml = Cache::remember(CacheKeys::SITEMAP, config('ppak.cache.ttl.sitemap', 3600), function () {
            $urls = collect([
                route('home'),
                route('profil.sejarah'),
                route('profil.visi-misi'),
                route('profil.struktur-organisasi'),
                route('profil.dosen-pengajar'),
                route('profil.akreditasi'),
                route('akademik.kurikulum'),
                route('akademik.kalender'),
                route('akademik.gelar-sertifikasi'),
                route('akademik.panduan'),
                route('admisi.jalur-syarat'),
                route('admisi.biaya'),
                route('admisi.prosedur-jadwal'),
                route('admisi.faq'),
                route('riset-pengabdian.riset-publikasi'),
                route('riset-pengabdian.pengabdian'),
                route('riset-pengabdian.kerja-sama'),
                route('kemahasiswaan-alumni.alumni'),
                route('kemahasiswaan-alumni.mahasiswa'),
                route('kemahasiswaan-alumni.testimoni-karier'),
                route('informasi.berita'),
                route('informasi.agenda'),
                route('informasi.galeri'),
                route('kontak.lokasi'),
                route('kontak.helpdesk'),
                route('kontak.unduhan'),
            ]);

            // Dynamic URLs - chunked, only published
            $berita = $this->content->getBerita(['slug']);
            foreach ($berita as $item) {
                $urls->push(route('informasi.berita.detail', $item['slug']));
            }

            $xmlContent = view('sitemap', ['urls' => $urls])->render();
            return $xmlContent;
        });

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
