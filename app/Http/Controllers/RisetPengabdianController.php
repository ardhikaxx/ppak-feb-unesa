<?php

namespace App\Http\Controllers;

use App\Contracts\ContentRepositoryInterface;
use App\Models\Research;
use Illuminate\View\View;

class RisetPengabdianController extends Controller
{
    public function __construct(private ContentRepositoryInterface $content) {}

    public function risetPublikasi(): View
    {
        return view('riset-pengabdian.riset-publikasi', [
            'riset' => $this->content->getRiset(),
            'info' => $this->content->getGeneralInfo(),
            'researchList' => Research::where('status', 'published')
                ->orderByDesc('year')->orderByDesc('id')->get(),
        ]);
    }

    public function pengabdian(): View
    {
        return view('riset-pengabdian.pengabdian', [
            'pengabdian' => $this->content->getPengabdian(),
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function kerjaSama(): View
    {
        return view('riset-pengabdian.kerja-sama', [
            'mitra' => $this->content->getMitra(),
            'info' => $this->content->getGeneralInfo(),
        ]);
    }
}

