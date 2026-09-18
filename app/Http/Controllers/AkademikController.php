<?php

namespace App\Http\Controllers;

use App\Services\PpakData;
use Illuminate\View\View;

class AkademikController extends Controller
{
    public function kurikulum(): View
    {
        return view('akademik.kurikulum', [
            'kurikulum' => PpakData::getKurikulum(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function kalender(): View
    {
        return view('akademik.kalender', [
            'kalender' => PpakData::getKalender(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function gelarSertifikasi(): View
    {
        return view('akademik.gelar-sertifikasi', [
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function panduan(): View
    {
        return view('akademik.panduan', [
            'panduanList' => array_filter(PpakData::getUnduhan(), fn($doc) => in_array($doc['kategori'], ['Pedoman Akademik', 'Kalender'])),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }
}
