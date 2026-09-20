<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $guarded = ['id'];

    public const PAGES = [
        'sejarah' => 'Sejarah Singkat (/profil/sejarah)',
        'visi-misi' => 'Visi, Misi & Tujuan (/profil/visi-misi)',
        'struktur-organisasi' => 'Struktur Organisasi (/profil/struktur-organisasi)',
        'gelar-sertifikasi' => 'Gelar & Sertifikasi (/akademik/gelar-sertifikasi)',
        'mahasiswa' => 'Aktivitas Mahasiswa (/kemahasiswaan-alumni/mahasiswa)',
    ];

    public function scopeOfPage($query, string $page)
    {
        return $query->where('page', $page);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
