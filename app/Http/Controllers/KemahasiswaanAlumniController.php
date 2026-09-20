<?php

namespace App\Http\Controllers;

use App\Contracts\ContentRepositoryInterface;
use App\Models\AlumniRecord;
use Illuminate\View\View;

class KemahasiswaanAlumniController extends Controller
{
    public function __construct(private ContentRepositoryInterface $content) {}

    public function alumni(): View
    {
        return view('kemahasiswaan-alumni.alumni', [
            'stats' => $this->content->getStats(),
            'karierSectors' => $this->content->getKarierSectors(),
            'info' => $this->content->getGeneralInfo(),
            'alumniList' => AlumniRecord::where('status', 'published')
                ->orderByDesc('graduation_year')->orderBy('full_name')->get(),
        ]);
    }

    public function mahasiswa(): View
    {
        return view('kemahasiswaan-alumni.mahasiswa', [
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function testimoniKarier(): View
    {
        return view('kemahasiswaan-alumni.testimoni-karier', [
            'testimoni' => $this->content->getTestimoni(),
            'karierSectors' => $this->content->getKarierSectors(),
            'info' => $this->content->getGeneralInfo(),
        ]);
    }
}
