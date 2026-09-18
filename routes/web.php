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
| Web Routes - PPAk FEB UNESA
|--------------------------------------------------------------------------
| Seluruh rute profil website Pendidikan Profesi Akuntansi FEB UNESA.
| Menggunakan named route untuk konsistensi struktur dan navigasi terarah.
|
*/

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah');
    Route::get('/visi-misi', [ProfilController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/struktur-organisasi', [ProfilController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
    Route::get('/struktur', [ProfilController::class, 'strukturOrganisasi'])->name('struktur');
    Route::get('/dosen-pengajar', [ProfilController::class, 'dosenPengajar'])->name('dosen-pengajar');
    Route::get('/dosen', [ProfilController::class, 'dosenPengajar'])->name('dosen');
    Route::get('/akreditasi', [ProfilController::class, 'akreditasi'])->name('akreditasi');
});

// Akademik
Route::prefix('akademik')->name('akademik.')->group(function () {
    Route::get('/kurikulum', [AkademikController::class, 'kurikulum'])->name('kurikulum');
    Route::get('/kalender', [AkademikController::class, 'kalender'])->name('kalender');
    Route::get('/gelar-sertifikasi', [AkademikController::class, 'gelarSertifikasi'])->name('gelar-sertifikasi');
    Route::get('/sertifikasi', [AkademikController::class, 'gelarSertifikasi'])->name('sertifikasi');
    Route::get('/panduan', [AkademikController::class, 'panduan'])->name('panduan');
});

// Admisi & Pendaftaran
Route::prefix('admisi')->name('admisi.')->group(function () {
    Route::get('/jalur-syarat', [AdmisiController::class, 'jalurSyarat'])->name('jalur-syarat');
    Route::get('/syarat', [AdmisiController::class, 'jalurSyarat'])->name('syarat');
    Route::get('/biaya', [AdmisiController::class, 'biaya'])->name('biaya');
    Route::get('/prosedur-jadwal', [AdmisiController::class, 'prosedurJadwal'])->name('prosedur-jadwal');
    Route::get('/prosedur', [AdmisiController::class, 'prosedurJadwal'])->name('prosedur');
    Route::get('/faq', [AdmisiController::class, 'faq'])->name('faq');
});

// Riset & Pengabdian
Route::prefix('riset-pengabdian')->name('riset-pengabdian.')->group(function () {
    Route::get('/riset-publikasi', [RisetPengabdianController::class, 'risetPublikasi'])->name('riset-publikasi');
    Route::get('/pengabdian', [RisetPengabdianController::class, 'pengabdian'])->name('pengabdian');
    Route::get('/kerja-sama', [RisetPengabdianController::class, 'kerjaSama'])->name('kerja-sama');
});
Route::prefix('riset')->name('riset.')->group(function () {
    Route::get('/publikasi', [RisetPengabdianController::class, 'risetPublikasi'])->name('publikasi');
    Route::get('/pengabdian', [RisetPengabdianController::class, 'pengabdian'])->name('pengabdian');
    Route::get('/kerjasama', [RisetPengabdianController::class, 'kerjaSama'])->name('kerjasama');
});

// Kemahasiswaan & Alumni
Route::prefix('kemahasiswaan-alumni')->name('kemahasiswaan-alumni.')->group(function () {
    Route::get('/alumni', [KemahasiswaanAlumniController::class, 'alumni'])->name('alumni');
    Route::get('/mahasiswa', [KemahasiswaanAlumniController::class, 'mahasiswa'])->name('mahasiswa');
    Route::get('/testimoni-karier', [KemahasiswaanAlumniController::class, 'testimoniKarier'])->name('testimoni-karier');
});
Route::prefix('kemahasiswaan')->name('kemahasiswaan.')->group(function () {
    Route::get('/alumni', [KemahasiswaanAlumniController::class, 'alumni'])->name('alumni');
    Route::get('/komunitas', [KemahasiswaanAlumniController::class, 'mahasiswa'])->name('komunitas');
    Route::get('/karier', [KemahasiswaanAlumniController::class, 'testimoniKarier'])->name('karier');
});

// Informasi & Publikasi
Route::prefix('informasi')->name('informasi.')->group(function () {
    Route::get('/berita', [InformasiController::class, 'berita'])->name('berita');
    Route::get('/berita/{slug}', [InformasiController::class, 'beritaDetail'])->name('berita.detail');
    Route::get('/agenda', [InformasiController::class, 'agenda'])->name('agenda');
    Route::get('/galeri', [InformasiController::class, 'galeri'])->name('galeri');
});

// Kontak & Layanan
Route::prefix('kontak')->name('kontak.')->group(function () {
    Route::get('/lokasi', [KontakController::class, 'lokasi'])->name('lokasi');
    Route::get('/helpdesk', [KontakController::class, 'helpdesk'])->name('helpdesk');
    Route::get('/unduhan', [KontakController::class, 'unduhan'])->name('unduhan');
});
