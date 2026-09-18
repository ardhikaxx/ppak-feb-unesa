<?php

namespace App\Http\Controllers;

use App\Services\PpakData;
use Illuminate\View\View;

class AdmisiController extends Controller
{
    public function jalurSyarat(): View
    {
        return view('admisi.jalur-syarat', [
            'admisi' => PpakData::getAdmisiInfo(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function biaya(): View
    {
        return view('admisi.biaya', [
            'admisi' => PpakData::getAdmisiInfo(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function prosedurJadwal(): View
    {
        return view('admisi.prosedur-jadwal', [
            'admisi' => PpakData::getAdmisiInfo(),
            'kalender' => PpakData::getKalender(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function faq(): View
    {
        return view('admisi.faq', [
            'faqs' => PpakData::getFaq(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }
}
