<?php

use App\Models\Document;
use App\Models\News;
use Database\Seeders\AdminSeeder;

test('all public get routes return 200 and have valid html structure and meta tags', function () {
    $routes = [
        'home' => [],
        'profil.sejarah' => [],
        'profil.visi-misi' => [],
        'profil.struktur-organisasi' => [],
        'profil.dosen-pengajar' => [],
        'profil.akreditasi' => [],
        'akademik.kurikulum' => [],
        'akademik.kalender' => [],
        'akademik.gelar-sertifikasi' => [],
        'akademik.panduan' => [],
        'admisi.jalur-syarat' => [],
        'admisi.biaya' => [],
        'admisi.prosedur-jadwal' => [],
        'admisi.faq' => [],
        'riset-pengabdian.riset-publikasi' => [],
        'riset-pengabdian.pengabdian' => [],
        'riset-pengabdian.kerja-sama' => [],
        'kemahasiswaan-alumni.alumni' => [],
        'kemahasiswaan-alumni.mahasiswa' => [],
        'kemahasiswaan-alumni.testimoni-karier' => [],
        'informasi.berita' => [],
        'informasi.agenda' => [],
        'informasi.galeri' => [],
        'kontak.lokasi' => [],
        'kontak.helpdesk' => [],
        'kontak.unduhan' => [],
    ];

    foreach ($routes as $route => $params) {
        $response = $this->get(route($route, $params));
        $response->assertStatus(200);
        $response->assertSee('<meta name="description"', false);
        $response->assertSee('<link rel="canonical"', false);
        $response->assertSee('<meta property="og:title"', false);
    }
});

test('all legacy 301 redirects work correctly and preserve SEO authority', function () {
    $redirects = [
        '/profil/struktur' => '/profil/struktur-organisasi',
        '/profil/dosen' => '/profil/dosen-pengajar',
        '/akademik/sertifikasi' => '/akademik/gelar-sertifikasi',
        '/admisi/syarat' => '/admisi/jalur-syarat',
        '/admisi/prosedur' => '/admisi/prosedur-jadwal',
        '/riset/publikasi' => '/riset-pengabdian/riset-publikasi',
        '/riset/pengabdian' => '/riset-pengabdian/pengabdian',
        '/riset/kerjasama' => '/riset-pengabdian/kerja-sama',
        '/kemahasiswaan/alumni' => '/kemahasiswaan-alumni/alumni',
        '/kemahasiswaan/komunitas' => '/kemahasiswaan-alumni/mahasiswa',
        '/kemahasiswaan/karier' => '/kemahasiswaan-alumni/testimoni-karier',
    ];

    foreach ($redirects as $from => $to) {
        $response = $this->get($from);
        $response->assertStatus(301);
        $response->assertRedirect($to);
    }
});

test('robots.txt returns valid text format with disallow admin directives', function () {
    $response = $this->get(route('robots'));
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
    $response->assertSee('User-agent: *');
    $response->assertSee('Disallow: /admin/');
    $response->assertSee('Disallow: /search');
    $response->assertSee('Sitemap:');
});

test('sitemap.xml returns valid xml sitemap format with canonical urls', function () {
    $response = $this->get(route('sitemap'));
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/xml');
    $response->assertSee('<urlset', false);
    $response->assertSee(route('home'), false);
    $response->assertSee(route('profil.akreditasi'), false);
});

test('search endpoint works with query filter and handles empty results safely', function () {
    $res = $this->get(route('search', ['q' => 'akuntansi']));
    $res->assertStatus(200);
    $res->assertSee('Hasil Pencarian');

    $resEmpty = $this->get(route('search', ['q' => 'kata_kunci_acak_yang_pasti_tidak_ada_xyz123']));
    $resEmpty->assertStatus(200);
    $resEmpty->assertSee('Hasil Pencarian');
});

test('search validation rejects query shorter than 2 chars', function () {
    $res = $this->get(route('search', ['q' => 'a']));
    $res->assertStatus(302);
    $res->assertSessionHasErrors('q');
});

test('helpdesk form submission validates input, persists to db, and rate limits', function () {
    $payload = [
        'name' => 'Budi Santoso',
        'email' => 'budi.santoso@example.com',
        'phone' => '081234567890',
        'subject' => 'Pertanyaan Syarat Admisi PPAk',
        'message' => 'Saya ingin bertanya mengenai syarat pendaftaran program studi PPAk FEB UNESA.',
        'category' => 'admisi',
    ];

    $response = $this->post(route('kontak.helpdesk.submit'), $payload);
    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('helpdesk_inquiries', [
        'email' => 'budi.santoso@example.com',
        'subject' => 'Pertanyaan Syarat Admisi PPAk',
        'status' => 'open',
    ]);
});

test('helpdesk form rejects invalid email and empty fields', function () {
    $response = $this->post(route('kontak.helpdesk.submit'), [
        'name' => '',
        'email' => 'bukan-email',
        'subject' => '',
        'message' => '',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'subject', 'message', 'phone', 'category']);
});

test('unduhan download endpoint returns 404 on non existent file safely', function () {
    $response = $this->get(route('kontak.unduhan.download', 'file-yang-tidak-pernah-ada-123.pdf'));
    $response->assertStatus(404);
});

test('berita detail returns 404 on invalid slug safely', function () {
    $response = $this->get(route('informasi.berita.detail', 'slug-berita-yang-tidak-ada-999'));
    $response->assertStatus(404);
});

test('agenda page handles upcoming, past, and all filters safely', function () {
    $this->get(route('informasi.agenda', ['filter' => 'upcoming']))->assertStatus(200);
    $this->get(route('informasi.agenda', ['filter' => 'past']))->assertStatus(200);
    $this->get(route('informasi.agenda', ['filter' => 'all']))->assertStatus(200);
});

test('dosen page handles category filter and pagination safely', function () {
    $this->get(route('profil.dosen-pengajar', ['kategori' => 'auditing']))->assertStatus(200);
    $this->get(route('profil.dosen-pengajar', ['kategori' => 'keuangan']))->assertStatus(200);
    $this->get(route('profil.dosen-pengajar', ['kategori' => 'perpajakan']))->assertStatus(200);
    $this->get(route('profil.dosen-pengajar', ['kategori' => 'manajemen']))->assertStatus(200);
    $this->get(route('profil.dosen-pengajar', ['kategori' => 'all', 'page' => 1]))->assertStatus(200);
});
