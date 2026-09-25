<?php

namespace App\Http\Controllers;

use App\Contracts\ContentRepositoryInterface;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private ContentRepositoryInterface $content) {}

    /**
     * Homepage - read-heavy, cache-friendly, minimal queries.
     * Only fetches required slices for above-the-fold sections.
     * No N+1, no Collection::filter in Blade.
     *
     * Hanya variabel yang benar-benar dipakai home.blade.php yang
     * diambil; keunggulan/testimoni/mitra tidak dirender di beranda
     * sehingga query-nya tidak lagi dijalankan.
     */
    public function index(): View
    {
        $perPageBeritaHome = config('ppak.pagination.home_berita', 3);
        $perPageAgendaHome = 3;

        return view('home', [
            'info' => $this->content->getGeneralInfo(),
            'stats' => $this->content->getStats(),
            'kompetensi' => $this->content->getKompetensi(),
            'kurikulum' => $this->content->getKurikulum(),
            'riset' => $this->content->getRiset(),
            'berita' => array_slice($this->content->getBerita(['id', 'slug', 'title', 'excerpt', 'category', 'date', 'image']), 0, $perPageBeritaHome),
            'agenda' => array_slice($this->content->getAgenda(), 0, $perPageAgendaHome),
            'dosen' => array_slice($this->content->getDosen(['id', 'name', 'gelar', 'role', 'category_label', 'image']), 0, config('ppak.pagination.dosen', 4)),
            'karierSectors' => $this->content->getKarierSectors(),
            'admisiInfo' => $this->content->getAdmisiInfo(),
        ]);
    }
}

