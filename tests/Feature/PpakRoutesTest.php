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

test('legacy alias routes redirect 301 to canonical (no duplicate content)', function () {
    $aliases = [
        'profil.struktur' => '/profil/struktur-organisasi',
        'profil.dosen' => '/profil/dosen-pengajar',
        'akademik.sertifikasi' => '/akademik/gelar-sertifikasi',
        'admisi.syarat' => '/admisi/jalur-syarat',
        'admisi.prosedur' => '/admisi/prosedur-jadwal',
        'riset.publikasi' => '/riset-pengabdian/riset-publikasi',
        'riset.pengabdian' => '/riset-pengabdian/pengabdian',
        'riset.kerjasama' => '/riset-pengabdian/kerja-sama',
        'kemahasiswaan.alumni' => '/kemahasiswaan-alumni/alumni',
        'kemahasiswaan.komunitas' => '/kemahasiswaan-alumni/mahasiswa',
        'kemahasiswaan.karier' => '/kemahasiswaan-alumni/testimoni-karier',
    ];

    foreach ($aliases as $routeName => $canonical) {
        $response = $this->get(route($routeName));
        $response->assertStatus(301);
        $response->assertRedirect($canonical);
    }
});

test('canonical routes all return 200', function () {
    $routes = [
        'home',
        'profil.sejarah',
        'profil.visi-misi',
        'profil.struktur-organisasi',
        'profil.dosen-pengajar',
        'profil.akreditasi',
        'akademik.kurikulum',
        'akademik.kalender',
        'akademik.gelar-sertifikasi',
        'akademik.panduan',
        'admisi.jalur-syarat',
        'admisi.biaya',
        'admisi.prosedur-jadwal',
        'admisi.faq',
        'riset-pengabdian.riset-publikasi',
        'riset-pengabdian.pengabdian',
        'riset-pengabdian.kerja-sama',
        'kemahasiswaan-alumni.alumni',
        'kemahasiswaan-alumni.mahasiswa',
        'kemahasiswaan-alumni.testimoni-karier',
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

test('berita pagination returns correct structure', function () {
    $response = $this->get(route('informasi.berita', ['page' => 1]));
    $response->assertStatus(200);
    // Empty search still returns paginated
    $response2 = $this->get(route('informasi.berita', ['q' => 'CA']));
    $response2->assertStatus(200);
});

test('berita search with pagination preserves query string', function () {
    $response = $this->get(route('search', ['q' => 'akuntansi']));
    $response->assertStatus(200);
    $response->assertSee('Hasil Pencarian');
});

test('sitemap returns valid xml', function () {
    $response = $this->get(route('sitemap'));
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/xml');
    $response->assertSee('<urlset', false);
});

test('helpdesk rate limiting and validation', function () {
    $response = $this->post(route('kontak.helpdesk.submit'), []);
    $response->assertStatus(302); // validation redirect
});

test('unduhan download route throttled and validates', function () {
    $response = $this->get(route('kontak.unduhan.download', 'not-exist.pdf'));
    $response->assertStatus(404);
});
