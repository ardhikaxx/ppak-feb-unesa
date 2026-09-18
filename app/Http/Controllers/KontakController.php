<?php

namespace App\Http\Controllers;

use App\Services\PpakData;
use Illuminate\View\View;

class KontakController extends Controller
{
    public function lokasi(): View
    {
        return view('kontak.lokasi', [
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function helpdesk(): View
    {
        return view('kontak.helpdesk', [
            'info' => PpakData::getGeneralInfo(),
            'faqs' => array_slice(PpakData::getFaq(), 0, 4),
        ]);
    }

    public function unduhan(): View
    {
        return view('kontak.unduhan', [
            'unduhan' => PpakData::getUnduhan(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }
}
