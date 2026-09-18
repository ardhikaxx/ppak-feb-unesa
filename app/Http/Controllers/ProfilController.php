<?php

namespace App\Http\Controllers;

use App\Services\PpakData;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function sejarah(): View
    {
        return view('profil.sejarah', [
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function visiMisi(): View
    {
        return view('profil.visi-misi', [
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function strukturOrganisasi(): View
    {
        return view('profil.struktur-organisasi', [
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function dosenPengajar(): View
    {
        return view('profil.dosen-pengajar', [
            'dosen' => PpakData::getDosen(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function akreditasi(): View
    {
        return view('profil.akreditasi', [
            'info' => PpakData::getGeneralInfo(),
            'unduhan' => PpakData::getUnduhan(),
        ]);
    }
}
