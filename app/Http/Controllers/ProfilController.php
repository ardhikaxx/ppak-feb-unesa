<?php

namespace App\Http\Controllers;

use App\Contracts\ContentRepositoryInterface;
use App\Models\Accreditation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function __construct(private ContentRepositoryInterface $content) {}

    public function sejarah(): View
    {
        return view('profil.sejarah', [
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function visiMisi(): View
    {
        return view('profil.visi-misi', [
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function strukturOrganisasi(): View
    {
        return view('profil.struktur-organisasi', [
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function dosenPengajar(Request $request): View
    {
        $request->validate([
            'kategori' => ['nullable', 'string', 'in:auditing,keuangan,perpajakan,manajemen,all'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $category = $request->query('kategori');
        if ($category === 'all') {
            $category = null;
        }

        $perPage = config('ppak.pagination.dosen', 8);
        $dosen = $this->content->getDosenPaginated($perPage, $category);

        return view('profil.dosen-pengajar', [
            'dosen' => $dosen,
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function akreditasi(): View
    {
        return view('profil.akreditasi', [
            'info' => $this->content->getGeneralInfo(),
            'unduhan' => $this->content->getUnduhan(),
            'accreditation' => Accreditation::orderByDesc('effective_until')->first(),
        ]);
    }
}
