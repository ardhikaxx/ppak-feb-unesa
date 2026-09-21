<?php

use App\Http\Controllers\AdmisiController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KemahasiswaanAlumniController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RisetPengabdianController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - PPAk FEB UNESA - Scalable Architecture
|--------------------------------------------------------------------------
| Canonical hierarchical named routes. Duplicate aliases redirected 301
| to prevent duplicate content. All public GET routes are cacheable and
| SEO-friendly with slug-based URLs.
*/

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil - canonical only
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah');
    Route::get('/visi-misi', [ProfilController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/struktur-organisasi', [ProfilController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
    Route::get('/dosen-pengajar', [ProfilController::class, 'dosenPengajar'])->name('dosen-pengajar');
    Route::get('/akreditasi', [ProfilController::class, 'akreditasi'])->name('akreditasi');
});
// Legacy aliases -> 301 to canonical (preserves SEO, no duplicate content)
Route::redirect('/profil/struktur', '/profil/struktur-organisasi', 301)->name('profil.struktur');
Route::redirect('/profil/dosen', '/profil/dosen-pengajar', 301)->name('profil.dosen');

// Akademik - canonical
Route::prefix('akademik')->name('akademik.')->group(function () {
    Route::get('/kurikulum', [AkademikController::class, 'kurikulum'])->name('kurikulum');
    Route::get('/kalender', [AkademikController::class, 'kalender'])->name('kalender');
    Route::get('/gelar-sertifikasi', [AkademikController::class, 'gelarSertifikasi'])->name('gelar-sertifikasi');
    Route::get('/panduan', [AkademikController::class, 'panduan'])->name('panduan');
});
Route::redirect('/akademik/sertifikasi', '/akademik/gelar-sertifikasi', 301)->name('akademik.sertifikasi');

// Admisi & Pendaftaran
Route::prefix('admisi')->name('admisi.')->group(function () {
    Route::get('/jalur-syarat', [AdmisiController::class, 'jalurSyarat'])->name('jalur-syarat');
    Route::get('/biaya', [AdmisiController::class, 'biaya'])->name('biaya');
    Route::get('/prosedur-jadwal', [AdmisiController::class, 'prosedurJadwal'])->name('prosedur-jadwal');
    Route::get('/faq', [AdmisiController::class, 'faq'])->name('faq');
});
Route::redirect('/admisi/syarat', '/admisi/jalur-syarat', 301)->name('admisi.syarat');
Route::redirect('/admisi/prosedur', '/admisi/prosedur-jadwal', 301)->name('admisi.prosedur');

// Riset & Pengabdian - single canonical prefix
Route::prefix('riset-pengabdian')->name('riset-pengabdian.')->group(function () {
    Route::get('/riset-publikasi', [RisetPengabdianController::class, 'risetPublikasi'])->name('riset-publikasi');
    Route::get('/pengabdian', [RisetPengabdianController::class, 'pengabdian'])->name('pengabdian');
    Route::get('/kerja-sama', [RisetPengabdianController::class, 'kerjaSama'])->name('kerja-sama');
});
// Legacy riset aliases
Route::redirect('/riset/publikasi', '/riset-pengabdian/riset-publikasi', 301)->name('riset.publikasi');
Route::redirect('/riset/pengabdian', '/riset-pengabdian/pengabdian', 301)->name('riset.pengabdian');
Route::redirect('/riset/kerjasama', '/riset-pengabdian/kerja-sama', 301)->name('riset.kerjasama');

// Kemahasiswaan & Alumni - canonical
Route::prefix('kemahasiswaan-alumni')->name('kemahasiswaan-alumni.')->group(function () {
    Route::get('/alumni', [KemahasiswaanAlumniController::class, 'alumni'])->name('alumni');
    Route::get('/mahasiswa', [KemahasiswaanAlumniController::class, 'mahasiswa'])->name('mahasiswa');
    Route::get('/testimoni-karier', [KemahasiswaanAlumniController::class, 'testimoniKarier'])->name('testimoni-karier');
});
Route::redirect('/kemahasiswaan/alumni', '/kemahasiswaan-alumni/alumni', 301)->name('kemahasiswaan.alumni');
Route::redirect('/kemahasiswaan/komunitas', '/kemahasiswaan-alumni/mahasiswa', 301)->name('kemahasiswaan.komunitas');
Route::redirect('/kemahasiswaan/karier', '/kemahasiswaan-alumni/testimoni-karier', 301)->name('kemahasiswaan.karier');

// Informasi & Publikasi - slug-based, paginated
Route::prefix('informasi')->name('informasi.')->group(function () {
    Route::get('/berita', [InformasiController::class, 'berita'])->name('berita');
    Route::get('/berita/{slug}', [InformasiController::class, 'beritaDetail'])
        ->where('slug', '[a-z0-9\-]+')
        ->name('berita.detail');
    Route::get('/agenda', [InformasiController::class, 'agenda'])->name('agenda');
    Route::get('/galeri', [InformasiController::class, 'galeri'])->name('galeri');
});

// Kontak & Layanan - helpdesk rate limited
Route::prefix('kontak')->name('kontak.')->group(function () {
    Route::get('/lokasi', [KontakController::class, 'lokasi'])->name('lokasi');
    Route::get('/helpdesk', [KontakController::class, 'helpdesk'])->name('helpdesk');
    Route::post('/helpdesk', [KontakController::class, 'submitHelpdesk'])
        ->middleware('throttle:helpdesk')
        ->name('helpdesk.submit');
    Route::get('/unduhan', [KontakController::class, 'unduhan'])->name('unduhan');
    Route::get('/unduhan/{filename}', [KontakController::class, 'download'])
        ->where('filename', '[A-Za-z0-9\-\_\.]+')
        ->middleware('throttle:download')
        ->name('unduhan.download');
});

// Scalable extras - SEO & performance
Route::get('/sitemap.xml', [InformasiController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [InformasiController::class, 'robots'])->name('robots');
// CMS Admin PPAk FEB UNESA - route terpisah, lihat routes/admin.php
require __DIR__.'/admin.php';
