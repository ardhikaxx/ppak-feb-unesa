<?php

namespace App\Http\Controllers;

use App\Services\PpakData;
use Illuminate\View\View;

class RisetPengabdianController extends Controller
{
    public function risetPublikasi(): View
    {
        return view('riset-pengabdian.riset-publikasi', [
            'riset' => PpakData::getRiset(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function pengabdian(): View
    {
        return view('riset-pengabdian.pengabdian', [
            'pengabdian' => PpakData::getPengabdian(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function kerjaSama(): View
    {
        return view('riset-pengabdian.kerja-sama', [
            'mitra' => PpakData::getMitra(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }
}
