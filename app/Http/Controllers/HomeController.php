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
     */
    public function index(): View
    {
        $perPageBeritaHome = config('ppak.pagination.home_berita', 3);
        $perPageAgendaHome = 3;

        return view('home', [
            'info' => $this->content->getGeneralInfo(),
            'stats' => $this->content->getStats(),
            'keunggulan' => $this->content->getKeunggulan(),
            'kompetensi' => $this->content->getKompetensi(),
            'kurikulum' => $this->content->getKurikulum(),
            'riset' => $this->content->getRiset(),
            'berita' => array_slice($this->content->getBerita(['id', 'slug', 'title', 'excerpt', 'category', 'date', 'image']), 0, $perPageBeritaHome),
            'agenda' => array_slice($this->content->getAgenda(), 0, $perPageAgendaHome),
            'dosen' => array_slice($this->content->getDosen(['id', 'name', 'gelar', 'role', 'category_label', 'image']), 0, config('ppak.pagination.dosen', 4)),
            'testimoni' => $this->content->getTestimoni(),
            'mitra' => $this->content->getMitra(),
            'karierSectors' => $this->content->getKarierSectors(),
            'admisiInfo' => $this->content->getAdmisiInfo(),
            'pg' => $this->content->getPageContent('home'),
        ]);
    }
}
