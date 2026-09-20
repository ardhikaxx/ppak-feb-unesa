<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $guarded = ['id'];

    public const PAGES = [
        'home' => 'Beranda (/)',
        'global' => 'Global (CTA & Footer)',
        'sejarah' => 'Sejarah Singkat (/profil/sejarah)',
        'visi-misi' => 'Visi, Misi & Tujuan (/profil/visi-misi)',
        'struktur-organisasi' => 'Struktur Organisasi (/profil/struktur-organisasi)',
        'akreditasi' => 'Akreditasi (/profil/akreditasi)',
        'dosen' => 'Dosen & Pengajar (/profil/dosen-pengajar)',
        'kurikulum' => 'Kurikulum (/akademik/kurikulum)',
        'kalender' => 'Kalender Akademik (/akademik/kalender)',
        'gelar-sertifikasi' => 'Gelar & Sertifikasi (/akademik/gelar-sertifikasi)',
        'panduan' => 'Panduan (/akademik/panduan)',
        'jalur-syarat' => 'Jalur & Syarat (/admisi/jalur-syarat)',
        'biaya' => 'Biaya (/admisi/biaya)',
        'prosedur-jadwal' => 'Prosedur & Jadwal (/admisi/prosedur-jadwal)',
        'faq' => 'FAQ (/admisi/faq)',
        'riset-publikasi' => 'Riset & Publikasi (/riset-pengabdian/riset-publikasi)',
        'pengabdian' => 'Pengabdian (/riset-pengabdian/pengabdian)',
        'kerja-sama' => 'Kerja Sama (/riset-pengabdian/kerja-sama)',
        'alumni' => 'Alumni (/kemahasiswaan-alumni/alumni)',
        'testimoni-karier' => 'Testimoni & Karier (/kemahasiswaan-alumni/testimoni-karier)',
        'mahasiswa' => 'Aktivitas Mahasiswa (/kemahasiswaan-alumni/mahasiswa)',
        'berita' => 'Berita (/informasi/berita)',
        'agenda' => 'Agenda (/informasi/agenda)',
        'galeri' => 'Galeri (/informasi/galeri)',
        'unduhan' => 'Unduhan (/kontak/unduhan)',
        'lokasi' => 'Lokasi (/kontak/lokasi)',
        'helpdesk' => 'Helpdesk (/kontak/helpdesk)',
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
