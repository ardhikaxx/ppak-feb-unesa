<?php

use App\Services\PpakData;
use Database\Seeders\AdminSeeder;

test('beranda homepage renders successfully with verified key content', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('Pendidikan Profesi Akuntan');
    $response->assertSee('FEB UNESA');
    $response->assertSee('Informasi Pendaftaran');
    $response->assertSee('Profil Program Studi');
    $response->assertSee('62902');
    $response->assertSee('Rediyanto Putra');
    $response->assertSee('611/DE/A.5/AR.11/II/2025');
    $response->assertSee('Rp5.500.000');
    $response->assertSee('Arsip Seleksi 2026/2027');
    $response->assertDontSee('Pendidikan Profesi Akuntansi');
});

test('profil subpages render verified institutional data', function () {
    // Sejarah
    $resSejarah = $this->get(route('profil.sejarah'));
    $resSejarah->assertStatus(200);
    $resSejarah->assertSee('23 Mei 2025');
    $resSejarah->assertSee('SINDIG UNESA');
    $resSejarah->assertSee('62902');

    // Visi Misi
    $resVisi = $this->get(route('profil.visi-misi'));
    $resVisi->assertStatus(200);
    $resVisi->assertSee('Informasi Visi, Misi, dan Tujuan Program Sedang Diperbarui');

    // Struktur Organisasi
    $resStruktur = $this->get(route('profil.struktur-organisasi'));
    $resStruktur->assertStatus(200);
    $resStruktur->assertSee('Rediyanto Putra, S.E., M.S.A.');
    $resStruktur->assertSee('Koordinator Program Studi');

    // Dosen Pengajar
    $resDosen = $this->get(route('profil.dosen-pengajar'));
    $resDosen->assertStatus(200);
    $resDosen->assertSee('Rediyanto Putra, S.E., M.S.A.');
    $resDosen->assertSee('Pengajar pada Mata Kuliah PPAk');

    // Akreditasi
    $resAkreditasi = $this->get(route('profil.akreditasi'));
    $resAkreditasi->assertStatus(200);
    $resAkreditasi->assertSee('LAMEMBA');
    $resAkreditasi->assertSee('Baik');
    $resAkreditasi->assertSee('611/DE/A.5/AR.11/II/2025');
    $resAkreditasi->assertSee('25 Februari 2027');
});

test('akademik subpages render verified curriculum and calendar data', function () {
    // Kurikulum
    $resKurikulum = $this->get(route('akademik.kurikulum'));
    $resKurikulum->assertStatus(200);
    $resKurikulum->assertSee('Mata Kuliah Semester 1 (19 SKS)');
    $resKurikulum->assertSee('Mata Kuliah Semester 2 (16 SKS)');
    $resKurikulum->assertSee('CPL-1');
    $resKurikulum->assertSee('CPL-4');
    $resKurikulum->assertSee('Pelaporan Korporat');

    // Kalender
    $resKalender = $this->get(route('akademik.kalender'));
    $resKalender->assertStatus(200);
    $resKalender->assertSee('B/2322/UN38.I/TU.00.02/2026');
    $resKalender->assertSee('2026/2027');
    $resKalender->assertSee('1 Agustus 2026');

    // Gelar & Sertifikasi
    $resGelar = $this->get(route('akademik.gelar-sertifikasi'));
    $resGelar->assertStatus(200);
    $resGelar->assertSee('Akuntan (Ak.)');
    $resGelar->assertSee('Chartered Accountant (CA)');
    $resGelar->assertSee('Certified Public Accountant (CPA)');

    // Panduan
    $resPanduan = $this->get(route('akademik.panduan'));
    $resPanduan->assertStatus(200);
    $resPanduan->assertSee('B/2322/UN38.I/TU.00.02/2026');
});

test('admisi subpages render verified admission data and archives', function () {
    // Jalur & Syarat
    $resSyarat = $this->get(route('admisi.jalur-syarat'));
    $resSyarat->assertStatus(200);
    $resSyarat->assertSee('Persyaratan Pendaftaran');
    $resSyarat->assertSee('pmb.unesa.ac.id');
    $resSyarat->assertSee('Admisi UNESA');

    // Biaya
    $resBiaya = $this->get(route('admisi.biaya'));
    $resBiaya->assertStatus(200);
    $resBiaya->assertSee('Rp5.500.000');
    $resBiaya->assertSee('Admisi UNESA');

    // Prosedur & Jadwal
    $resJadwal = $this->get(route('admisi.prosedur-jadwal'));
    $resJadwal->assertStatus(200);
    $resJadwal->assertSee('Arsip Seleksi 2026/2027');
    $resJadwal->assertSee('Gelombang 1');

    // FAQ
    $resFaq = $this->get(route('admisi.faq'));
    $resFaq->assertStatus(200);
    $resFaq->assertSee('FAQ');
});

test('all riset dan pengabdian subpages render successfully', function () {
    $resRiset = $this->get(route('riset-pengabdian.riset-publikasi'));
    $resRiset->assertStatus(200);
    $resRiset->assertSee('Rediyanto Putra');
    $resRiset->assertSee('2026');

    $resPkm = $this->get(route('riset-pengabdian.pengabdian'));
    $resPkm->assertStatus(200);

    $resKerjasama = $this->get(route('riset-pengabdian.kerja-sama'));
    $resKerjasama->assertStatus(200);
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
    $response2 = $this->get(route('informasi.berita', ['q' => 'CA']));
    $response2->assertStatus(200);
});

test('dosen page pagination renders numbers only without text labels', function () {
    config(['ppak.pagination.dosen' => 2]);
    $response = $this->get(route('profil.dosen-pengajar'));
    $response->assertStatus(200);
    $response->assertSee('ppak-pagination');
    $response->assertDontSee('Previous');
    $response->assertDontSee('Next');
    $response->assertDontSee('Sebelumnya');
    $response->assertDontSee('Berikutnya');
    $response->assertDontSee('&laquo;', false);
    $response->assertDontSee('&raquo;', false);
});

test('sitemap returns valid xml', function () {
    $response = $this->get(route('sitemap'));
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/xml');
    $response->assertSee('<urlset', false);
});

test('helpdesk rate limiting and validation', function () {
    $response = $this->post(route('kontak.helpdesk.submit'), []);
    $response->assertStatus(302);
});

test('unduhan download route throttled and validates', function () {
    $response = $this->get(route('kontak.unduhan.download', 'not-exist.pdf'));
    $response->assertStatus(404);
});

test('all 6 official PDF documents exist and can be downloaded with 200 OK', function () {
    $documents = PpakData::getUnduhan();
    expect(count($documents))->toBe(6);

    foreach ($documents as $doc) {
        $filename = $doc['filename'];
        $response = $this->get(route('kontak.unduhan.download', $filename));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }
});

test('form helpdesk menyimpan pesan ke database dan tampil di panel admin', function () {
    $payload = [
        'name' => 'Penguji Helpdesk',
        'email' => 'penguji@example.com',
        'phone' => '08123456789',
        'subject' => 'Uji simpan helpdesk',
        'message' => 'Isi pesan pengujian helpdesk minimal dua puluh karakter.',
        'category' => 'admisi',
    ];

    $response = $this->post(route('kontak.helpdesk.submit'), $payload);
    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('helpdesk_inquiries', [
        'email' => 'penguji@example.com',
        'subject' => 'Uji simpan helpdesk',
        'status' => 'open',
    ]);

    // Terlihat di panel admin CMS
    $this->seed(AdminSeeder::class);
    $this->post(route('admin.login.store'), ['email' => 'superadmin@gmail.com', 'password' => 'password']);
    $this->get(route('admin.helpdesk.index'))->assertStatus(200)->assertSee('Uji simpan helpdesk');
});

test('form helpdesk menolak input tidak valid tanpa menyimpan', function () {
    $response = $this->post(route('kontak.helpdesk.submit'), ['email' => 'bukan-email']);
    $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

    $this->assertDatabaseCount('helpdesk_inquiries', 0);
});
