<?php

namespace App\Http\Controllers;

use App\Services\PpakData;
use Illuminate\View\View;

class KemahasiswaanAlumniController extends Controller
{
    public function alumni(): View
    {
        return view('kemahasiswaan-alumni.alumni', [
            'stats' => PpakData::getStats(),
            'karierSectors' => PpakData::getKarierSectors(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function mahasiswa(): View
    {
        return view('kemahasiswaan-alumni.mahasiswa', [
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function testimoniKarier(): View
    {
        return view('kemahasiswaan-alumni.testimoni-karier', [
            'testimoni' => PpakData::getTestimoni(),
            'karierSectors' => PpakData::getKarierSectors(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }
}
