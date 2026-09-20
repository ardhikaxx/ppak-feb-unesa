<?php

use App\Contracts\ContentRepositoryInterface;
use App\Models\Agenda;
use App\Models\Lecturer;
use App\Models\News;
use Database\Seeders\AdminSeeder;

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
