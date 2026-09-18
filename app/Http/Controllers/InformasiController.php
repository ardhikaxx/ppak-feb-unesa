<?php

namespace App\Http\Controllers;

use App\Services\PpakData;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InformasiController extends Controller
{
    public function berita(Request $request): View
    {
        $allBerita = PpakData::getBerita();
        $featured = $allBerita[0] ?? null;
        $otherBerita = array_slice($allBerita, 1);

        return view('informasi.berita', [
            'featured' => $featured,
            'berita' => $otherBerita,
            'allBerita' => $allBerita,
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function beritaDetail(string $slug): View
    {
        $allBerita = PpakData::getBerita();
        $article = collect($allBerita)->firstWhere('slug', $slug);

        if (!$article) {
            abort(404);
        }

        $related = collect($allBerita)
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values()
            ->all();

        return view('informasi.berita-detail', [
            'article' => $article,
            'related' => $related,
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function agenda(): View
    {
        return view('informasi.agenda', [
            'agenda' => PpakData::getAgenda(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }

    public function galeri(): View
    {
        return view('informasi.galeri', [
            'galeri' => PpakData::getGaleri(),
            'info' => PpakData::getGeneralInfo(),
        ]);
    }
}
