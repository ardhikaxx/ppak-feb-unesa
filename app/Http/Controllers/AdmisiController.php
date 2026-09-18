<?php

namespace App\Http\Controllers;

use App\Contracts\ContentRepositoryInterface;
use Illuminate\View\View;

class AdmisiController extends Controller
{
    public function __construct(private ContentRepositoryInterface $content) {}

    public function jalurSyarat(): View
    {
        return view('admisi.jalur-syarat', [
            'admisi' => $this->content->getAdmisiInfo(),
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function biaya(): View
    {
        return view('admisi.biaya', [
            'admisi' => $this->content->getAdmisiInfo(),
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function prosedurJadwal(): View
    {
        return view('admisi.prosedur-jadwal', [
            'admisi' => $this->content->getAdmisiInfo(),
            'kalender' => $this->content->getKalender(),
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function faq(): View
    {
        return view('admisi.faq', [
            'faqs' => $this->content->getFaq(),
            'info' => $this->content->getGeneralInfo(),
        ]);
    }
}
