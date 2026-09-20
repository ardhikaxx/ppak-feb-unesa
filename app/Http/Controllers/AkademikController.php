<?php

namespace App\Http\Controllers;

use App\Contracts\ContentRepositoryInterface;
use Illuminate\View\View;

class AkademikController extends Controller
{
    public function __construct(private ContentRepositoryInterface $content) {}

    public function kurikulum(): View
    {
        $kurikulum = $this->content->getKurikulum();

        return view('akademik.kurikulum', [
            'kurikulum' => $kurikulum,
            'info' => $this->content->getGeneralInfo(),
            'pg' => $this->content->getPageContent('kurikulum'),
            'sks1' => collect($kurikulum['semester_1'] ?? [])->sum('sks'),
            'sks2' => collect($kurikulum['semester_2'] ?? [])->sum('sks'),
            'pg' => $this->content->getPageContent('kurikulum'),
        ]);
    }

    public function kalender(): View
    {
        return view('akademik.kalender', [
            'kalender' => $this->content->getKalender(),
            'info' => $this->content->getGeneralInfo(),
            'pg' => $this->content->getPageContent('kalender'),
        ]);
    }

    public function gelarSertifikasi(): View
    {
        return view('akademik.gelar-sertifikasi', [
            'info' => $this->content->getGeneralInfo(),
            'pg' => $this->content->getPageContent('gelar-sertifikasi'),
        ]);
    }

    public function panduan(): View
    {
        $docs = array_filter($this->content->getUnduhan(), fn($doc) => in_array($doc['kategori'], ['Pedoman Akademik', 'Kalender']));

        return view('akademik.panduan', [
            'panduanList' => array_values($docs),
            'info' => $this->content->getGeneralInfo(),
            'pg' => $this->content->getPageContent('panduan'),
        ]);
    }
}
