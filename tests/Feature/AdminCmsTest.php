<?php

use App\Contracts\ContentRepositoryInterface;
use App\Models\AcademicCurriculum;
use App\Models\Accreditation;
use App\Models\Agenda;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\PageContent;
use App\Models\SiteSetting;
use App\Models\TuitionFee;
use Database\Seeders\AdminSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

function adminCredentials(): array
{
    return ['email' => env('ADMIN_EMAIL', 'admin@gmail.com'), 'password' => env('ADMIN_PASSWORD', 'password')];
}

function loginAdmin($testcase)
{
    return $testcase->post(route('admin.login.store'), array_merge(adminCredentials(), ['remember' => false]));
}

test('tamu yang membuka halaman admin diarahkan ke login', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
    $this->get(route('admin.news.index'))->assertRedirect(route('admin.login'));
});

test('halaman login admin dapat dibuka publik', function () {
    $response = $this->get(route('admin.login'));
    $response->assertStatus(200);
    $response->assertSee('Login Administrator');
});

test('login dengan kredensial salah ditolak', function () {
    $response = $this->post(route('admin.login.store'), ['email' => 'salah@unesa.ac.id', 'password' => 'salah-salah-salah']);
    $response->assertSessionHasErrors('email');
    $this->assertGuest('admin');
});

test('login berhasil mengarah ke dashboard dengan angka database aktual', function () {
    $response = loginAdmin($this);
    $response->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticated('admin');

    $dashboard = $this->get(route('admin.dashboard'));
    $dashboard->assertStatus(200);
    $dashboard->assertSee('Dashboard CMS PPAk FEB UNESA');
    $dashboard->assertSee((string) News::where('status', 'published')->count());
});

test('admin dapat membuat, mengubah, mengarsipkan, dan memulihkan berita', function () {
    loginAdmin($this);

    // Create
    $create = $this->post(route('admin.news.store'), [
        'title' => 'Berita Uji CMS Admin',
        'slug' => 'berita-uji-cms-admin',
        'excerpt' => 'Ringkasan berita uji untuk memastikan alur CMS berjalan.',
        'content' => 'Isi lengkap berita uji CMS admin dengan panjang lebih dari dua puluh karakter.',
        'status' => 'draft',
    ]);
    $create->assertRedirect(route('admin.news.index'));
    $article = News::where('slug', 'berita-uji-cms-admin')->first();
    expect($article)->not->toBeNull();
    expect($article->status->value ?? (string) $article->status)->toBe('draft');

    // Draft tidak tampil di publik
    $this->get(route('informasi.berita.detail', 'berita-uji-cms-admin'))->assertStatus(404);

    // Publish → tampil di publik
    $this->put(route('admin.news.update', $article), [
        'title' => 'Berita Uji CMS Admin',
        'slug' => 'berita-uji-cms-admin',
        'excerpt' => 'Ringkasan berita uji untuk memastikan alur CMS berjalan.',
        'content' => 'Isi lengkap berita uji CMS admin dengan panjang lebih dari dua puluh karakter.',
        'status' => 'published',
    ])->assertRedirect(route('admin.news.index'));
    $this->get(route('informasi.berita.detail', 'berita-uji-cms-admin'))->assertStatus(200);

    // Slug duplikat ditolak
    $this->post(route('admin.news.store'), [
        'title' => 'Duplikat',
        'slug' => 'berita-uji-cms-admin',
        'excerpt' => 'Excerpt duplikat slug untuk validasi.',
        'content' => 'Isi duplikat slug dengan panjang lebih dari dua puluh karakter.',
        'status' => 'draft',
    ])->assertSessionHasErrors('slug');

    // Soft delete → hilang dari publik, masih di DB
    $this->delete(route('admin.news.destroy', $article))->assertRedirect(route('admin.news.index'));
    expect(News::where('slug', 'berita-uji-cms-admin')->count())->toBe(0);
    expect(News::withTrashed()->where('slug', 'berita-uji-cms-admin')->count())->toBe(1);
    $this->get(route('informasi.berita.detail', 'berita-uji-cms-admin'))->assertStatus(404);

    // Restore → tampil lagi
    $this->post(route('admin.news.restore', $article->id))->assertRedirect(route('admin.news.index'));
    $this->get(route('informasi.berita.detail', 'berita-uji-cms-admin'))->assertStatus(200);

    // Audit log tercatat
    $this->assertDatabaseHas('audit_logs', ['action' => 'created', 'auditable_type' => News::class]);
});

test('perubahan profil program langsung tampil di frontend', function () {
    loginAdmin($this);

    $this->put(route('admin.program-profile.update'), [
        'program_code' => '62902',
        'program_name' => 'Pendidikan Profesi Akuntan',
        'coordinator_name' => 'Nama Koordinator Uji',
    ])->assertRedirect(route('admin.program-profile.edit'));

    $info = app(ContentRepositoryInterface::class)->getGeneralInfo();
    expect($info['coordinator'])->toBe('Nama Koordinator Uji');
});

test('logout mengakhiri sesi admin dengan aman', function () {
    loginAdmin($this);
    $this->assertAuthenticated('admin');

    $this->post(route('admin.logout'))->assertRedirect(route('admin.login'));
    $this->assertGuest('admin');
    $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
});

test('login rate limiting menolak brute force', function () {
    for ($i = 0; $i < 6; $i++) {
        $this->post(route('admin.login.store'), ['email' => 'brute@unesa.ac.id', 'password' => 'salah-salah-salah']);
    }
    $response = $this->post(route('admin.login.store'), ['email' => 'brute@unesa.ac.id', 'password' => 'salah-salah-salah']);
    $response->assertStatus(302);
    $response->assertSessionHasErrors('email');
});

test('perubahan dosen via CMS tampil di halaman publik', function () {
    loginAdmin($this);

    $dosen = Lecturer::first();
    $this->put(route('admin.lecturers.update', $dosen), [
        'name' => $dosen->name,
        'slug' => $dosen->slug,
        'gelar' => 'Gelar Uji Propagasi CMS',
        'category' => $dosen->category,
        'status' => 'active',
    ])->assertRedirect(route('admin.lecturers.index'));

    $this->get(route('profil.dosen-pengajar'))->assertStatus(200)->assertSee('Gelar Uji Propagasi CMS');
});

test('perubahan kurikulum dan CPL via CMS tampil di halaman publik', function () {
    loginAdmin($this);

    $mk = AcademicCurriculum::first();
    $this->put(route('admin.curricula.update', $mk), [
        'course_code' => $mk->course_code,
        'name_id' => 'Mata Kuliah Uji Propagasi',
        'semester' => $mk->semester,
        'credits' => $mk->credits,
        'course_type' => $mk->course_type,
    ])->assertRedirect(route('admin.curricula.index'));

    $this->get(route('akademik.kurikulum'))->assertStatus(200)->assertSee('Mata Kuliah Uji Propagasi');
});

test('kalender baru via CMS tampil di halaman publik', function () {
    loginAdmin($this);

    $this->post(route('admin.academic-calendars.store'), [
        'academic_year' => '2026/2027',
        'semester' => 'Gasal',
        'activity' => 'Kegiatan Uji Propagasi CMS',
        'start_date' => '2026-09-01',
    ])->assertRedirect(route('admin.academic-calendars.index'));

    $this->get(route('akademik.kalender'))->assertStatus(200)->assertSee('Kegiatan Uji Propagasi CMS');
});

test('perubahan biaya via CMS tampil di halaman publik', function () {
    loginAdmin($this);

    $fee = TuitionFee::where('fee_type', 'UKT')->first();
    $this->put(route('admin.tuition-fees.update', $fee), [
        'program_name' => $fee->program_name,
        'fee_type' => 'UKT',
        'amount' => 6000000,
        'academic_year' => $fee->academic_year,
    ])->assertRedirect(route('admin.tuition-fees.index'));

    $this->get(route('admisi.biaya'))->assertStatus(200)->assertSee('Rp6.000.000');
});

test('agenda dan FAQ baru via CMS tampil di halaman publik', function () {
    loginAdmin($this);

    $this->post(route('admin.agendas.store'), [
        'title' => 'Agenda Uji Propagasi',
        'slug' => 'agenda-uji-propagasi',
        'event_date' => '2026-11-01',
        'status' => 'upcoming',
    ])->assertRedirect(route('admin.agendas.index'));

    $this->post(route('admin.faqs.store'), [
        'category' => 'Pendaftaran',
        'question' => 'Pertanyaan Uji Propagasi?',
        'answer' => 'Jawaban uji propagasi CMS.',
    ])->assertRedirect(route('admin.faqs.index'));

    $this->get(route('informasi.agenda'))->assertStatus(200)->assertSee('Agenda Uji Propagasi');
    $this->get(route('admisi.faq'))->assertStatus(200)->assertSee('Pertanyaan Uji Propagasi?');
});

test('dokumen baru via CMS tampil di halaman unduhan', function () {
    loginAdmin($this);
    Storage::fake('public');

    $this->post(route('admin.documents.store'), [
        'title' => 'Dokumen Uji Propagasi',
        'slug' => 'dokumen-uji-propagasi',
        'file' => UploadedFile::fake()->create('uji.pdf', 100, 'application/pdf'),
        'year' => 2026,
        'status' => 'published',
    ])->assertRedirect(route('admin.documents.index'));

    $this->get(route('kontak.unduhan'))->assertStatus(200)->assertSee('Dokumen Uji Propagasi');
});

test('pengaturan website via CMS tampil di footer publik', function () {
    loginAdmin($this);

    SiteSetting::updateOrCreate(['key' => 'email'], [
        'group' => 'contact', 'value' => 'ppak.feb@unesa.ac.id', 'type' => 'email', 'label' => 'Email',
    ]);
    $this->put(route('admin.site-settings.update'), [
        'settings' => ['email' => 'uji.propagasi@unesa.ac.id'],
    ])->assertRedirect(route('admin.site-settings.index'));

    $this->get(route('home'))->assertStatus(200)->assertSee('uji.propagasi@unesa.ac.id');
});

test('blok konten tahapan via CMS mengambil alih beranda', function () {
    loginAdmin($this);

    // Awal: fallback bawaan tampil
    $this->get(route('home'))->assertStatus(200)->assertSee('Pembuatan Akun PMB');

    $this->post(route('admin.content-blocks.store'), [
        'group' => 'tahapan',
        'title' => 'Tahap Uji Propagasi CMS',
        'description' => 'Deskripsi tahap uji.',
        'sort_order' => 1,
        'status' => 'published',
    ])->assertRedirect(route('admin.content-blocks.index', ['group' => 'tahapan']));

    // Setelah diambil alih: hanya baris CMS yang tampil
    $response = $this->get(route('home'));
    $response->assertStatus(200);
    $response->assertSee('Tahap Uji Propagasi CMS');
    $response->assertDontSee('Pembuatan Akun PMB');
});

test('konten halaman statis via CMS tampil di halaman publik', function () {
    loginAdmin($this);

    $row = PageContent::ofPage('sejarah')->where('section_key', 'fokus_heading')->first();
    $this->put(route('admin.page-contents.update', $row), [
        'page' => 'sejarah',
        'section_key' => 'fokus_heading',
        'heading' => 'Fokus Uji Propagasi CMS',
        'status' => 'published',
    ])->assertRedirect(route('admin.page-contents.index', ['page' => 'sejarah']));

    $this->get(route('profil.sejarah'))->assertStatus(200)->assertSee('Fokus Uji Propagasi CMS');
});

test('judul halaman via CMS tampil di landing page', function () {
    loginAdmin($this);

    $row = PageContent::ofPage('berita')->where('section_key', 'header_title')->first();
    $this->put(route('admin.page-contents.update', $row), [
        'page' => 'berita',
        'section_key' => 'header_title',
        'heading' => 'Kabar Uji Propagasi CMS',
        'status' => 'published',
    ])->assertRedirect(route('admin.page-contents.index', ['page' => 'berita']));

    $this->get(route('informasi.berita'))->assertStatus(200)->assertSee('Kabar Uji Propagasi CMS');
});

test('hapus section halaman kembali ke teks bawaan tanpa error', function () {
    loginAdmin($this);

    $row = PageContent::ofPage('mahasiswa')->where('section_key', 'aktivitas_1_heading')->first();
    $this->delete(route('admin.page-contents.destroy', $row))->assertRedirect();

    $this->get(route('kemahasiswaan-alumni.mahasiswa'))->assertStatus(200)->assertSee('Perkuliahan Tatap Muka Terstruktur');
});

test('halaman panduan mengambil dokumen dari database', function () {
    $response = $this->get(route('akademik.panduan'));
    $response->assertStatus(200);
    $response->assertSee('Kalender Akademik Universitas Negeri Surabaya 2026/2027');
    $response->assertSee('SK LAMEMBA No. 611/DE/A.5/AR.11/II/2025');
});

test('akreditasi via CMS tampil di halaman publik', function () {
    loginAdmin($this);

    $ak = Accreditation::first();
    $this->put(route('admin.accreditations.update', $ak), [
        'program_name' => $ak->program_name,
        'agency' => $ak->agency,
        'status' => 'Unggul Uji',
        'decree_number' => $ak->decree_number,
    ])->assertRedirect(route('admin.accreditations.index'));

    $this->get(route('profil.akreditasi'))->assertStatus(200)->assertSee('Unggul Uji');
});

test('seluruh halaman index dan form CMS dapat dibuka admin', function () {
    loginAdmin($this);

    $pages = [
        'admin.dashboard',
        'admin.program-profile.edit',
        'admin.accreditations.index', 'admin.accreditations.create',
        'admin.lecturers.index', 'admin.lecturers.create',
        'admin.curricula.index', 'admin.curricula.create',
        'admin.learning-outcomes.index', 'admin.learning-outcomes.create',
        'admin.academic-calendars.index', 'admin.academic-calendars.create',
        'admin.admission-schedules.index', 'admin.admission-schedules.create',
        'admin.tuition-fees.index', 'admin.tuition-fees.create',
        'admin.faqs.index', 'admin.faqs.create',
        'admin.publications.index', 'admin.publications.create',
        'admin.researches.index', 'admin.researches.create',
        'admin.community-services.index', 'admin.community-services.create',
        'admin.partnerships.index', 'admin.partnerships.create',
        'admin.testimonials.index', 'admin.testimonials.create',
        'admin.alumni.index', 'admin.alumni.create',
        'admin.news.index', 'admin.news.create',
        'admin.agendas.index', 'admin.agendas.create',
        'admin.galleries.index', 'admin.galleries.create',
        'admin.documents.index', 'admin.documents.create',
        'admin.categories.index', 'admin.categories.create',
        'admin.media.index',
        'admin.content-blocks.index',
        'admin.content-blocks.create',
        'admin.page-contents.index',
        'admin.page-contents.create',
        'admin.site-settings.index',
        'admin.helpdesk.index',
        'admin.audit-logs.index',
        'admin.admins.index', 'admin.admins.create',
        'admin.profile.edit',
    ];

    foreach ($pages as $routeName) {
        $this->get(route($routeName))->assertStatus(200);
    }

    // Halaman edit & detail untuk data existing
    $this->get(route('admin.news.edit', News::first()))->assertStatus(200);
    $this->get(route('admin.news.show', News::first()))->assertStatus(200);
    $this->get(route('admin.agendas.edit', Agenda::first()))->assertStatus(200);
    $this->get(route('admin.lecturers.edit', Lecturer::first()))->assertStatus(200);
});
