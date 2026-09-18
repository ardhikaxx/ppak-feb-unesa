<?php

use App\Services\PpakData;

test('beranda homepage renders successfully with key content', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('Pendidikan Profesi Akuntansi');
    $response->assertSee('FEB UNESA');
    $response->assertSee('Daftar Sekarang');
    $response->assertSee('Pelajari PPAk');
});

test('all profil subpages render successfully', function () {
    $routes = [
        'profil.sejarah',
        'profil.visi-misi',
        'profil.struktur-organisasi',
        'profil.dosen-pengajar',
        'profil.akreditasi',
    ];

    foreach ($routes as $routeName) {
        $response = $this->get(route($routeName));
        $response->assertStatus(200);
    }
});

test('all akademik subpages render successfully', function () {
    $routes = [
        'akademik.kurikulum',
        'akademik.kalender',
        'akademik.gelar-sertifikasi',
        'akademik.panduan',
    ];

    foreach ($routes as $routeName) {
        $response = $this->get(route($routeName));
        $response->assertStatus(200);
    }
});

test('all admisi subpages render successfully', function () {
    $routes = [
        'admisi.jalur-syarat',
        'admisi.biaya',
        'admisi.prosedur-jadwal',
        'admisi.faq',
    ];

    foreach ($routes as $routeName) {
        $response = $this->get(route($routeName));
        $response->assertStatus(200);
    }
});

test('all riset dan pengabdian subpages render successfully', function () {
    $routes = [
        'riset-pengabdian.riset-publikasi',
        'riset-pengabdian.pengabdian',
        'riset-pengabdian.kerja-sama',
    ];

    foreach ($routes as $routeName) {
        $response = $this->get(route($routeName));
        $response->assertStatus(200);
    }
});

test('all kemahasiswaan dan alumni subpages render successfully', function () {
    $routes = [
        'kemahasiswaan-alumni.alumni',
        'kemahasiswaan-alumni.mahasiswa',
        'kemahasiswaan-alumni.testimoni-karier',
    ];

    foreach ($routes as $routeName) {
        $response = $this->get(route($routeName));
        $response->assertStatus(200);
    }
});

test('all informasi dan publikasi subpages render successfully', function () {
    $responseBerita = $this->get(route('informasi.berita'));
    $responseBerita->assertStatus(200);

    $articles = PpakData::getBerita();
    $firstSlug = $articles[0]['slug'];
    $responseDetail = $this->get(route('informasi.berita.detail', $firstSlug));
    $responseDetail->assertStatus(200);
    $responseDetail->assertSee($articles[0]['title']);

    $responseAgenda = $this->get(route('informasi.agenda'));
    $responseAgenda->assertStatus(200);

    $responseGaleri = $this->get(route('informasi.galeri'));
    $responseGaleri->assertStatus(200);
});

test('invalid news slug returns 404', function () {
    $response = $this->get(route('informasi.berita.detail', 'berita-tidak-ada-12345'));
    $response->assertStatus(404);
});

test('all kontak dan layanan subpages render successfully', function () {
    $routes = [
        'kontak.lokasi',
        'kontak.helpdesk',
        'kontak.unduhan',
    ];

    foreach ($routes as $routeName) {
        $response = $this->get(route($routeName));
        $response->assertStatus(200);
    }
});

test('non-existent route returns 404 with custom error page', function () {
    $response = $this->get('/halaman-yang-pasti-tidak-ada-xyz');
    $response->assertStatus(404);
    $response->assertSee('404');
    $response->assertSee('Halaman Tidak Ditemukan');
});

test('all 26 designated route names and aliases resolve with status 200', function () {
    $routes = [
        'home',
        'profil.sejarah',
        'profil.visi-misi',
        'profil.struktur',
        'profil.dosen',
        'profil.akreditasi',
        'akademik.kurikulum',
        'akademik.kalender',
        'akademik.sertifikasi',
        'akademik.panduan',
        'admisi.syarat',
        'admisi.biaya',
        'admisi.prosedur',
        'admisi.faq',
        'riset.publikasi',
        'riset.pengabdian',
        'riset.kerjasama',
        'kemahasiswaan.alumni',
        'kemahasiswaan.komunitas',
        'kemahasiswaan.karier',
        'informasi.berita',
        'informasi.agenda',
        'informasi.galeri',
        'kontak.lokasi',
        'kontak.helpdesk',
        'kontak.unduhan',
    ];

    foreach ($routes as $routeName) {
        $response = $this->get(route($routeName));
        $response->assertStatus(200);
    }
});
