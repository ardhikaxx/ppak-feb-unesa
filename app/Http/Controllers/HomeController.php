<?php

namespace App\Http\Controllers;

use App\Services\PpakData;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'info' => PpakData::getGeneralInfo(),
            'stats' => PpakData::getStats(),
            'keunggulan' => PpakData::getKeunggulan(),
            'kompetensi' => PpakData::getKompetensi(),
            'berita' => array_slice(PpakData::getBerita(), 0, 3),
            'agenda' => array_slice(PpakData::getAgenda(), 0, 3),
            'dosen' => array_slice(PpakData::getDosen(), 0, 4),
            'testimoni' => PpakData::getTestimoni(),
            'mitra' => PpakData::getMitra(),
            'karierSectors' => PpakData::getKarierSectors(),
            'admisiInfo' => PpakData::getAdmisiInfo(),
        ]);
    }
}
