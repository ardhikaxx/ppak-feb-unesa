<?php

use App\Models\Admin;
use Database\Seeders\AdminSeeder;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

function createOperator(array $overrides = []): Admin
{
    return Admin::create(array_merge([
        'name' => 'Operator CMS',
        'email' => 'operator@unesa.ac.id',
        'password' => 'Operator123',
        'role' => Admin::ROLE_OPERATOR,
        'is_active' => true,
    ], $overrides));
}

test('akun seeder menjadi super admin dan operator baru tetap operator', function () {
    expect(Admin::where('email', 'superadmin@gmail.com')->first()->isSuperAdmin())->toBeTrue();
    expect(Admin::where('email', 'operator@gmail.com')->first()->isOperator())->toBeTrue();
    expect(Admin::where('email', 'admin@gmail.com')->exists())->toBeFalse();

    $operator = createOperator();
    expect($operator->isOperator())->toBeTrue();
    expect(Admin::superAdmins()->count())->toBe(1);
});

test('operator dapat mengakses dashboard, profil, dan modul konten yang diizinkan', function () {
    $this->actingAs(createOperator(), 'admin');

    $allowed = [
        'admin.dashboard',
        'admin.guide',
        'admin.profile.edit',
        'admin.lecturers.index',
        'admin.curricula.index',
        'admin.admission-schedules.index',
        'admin.tuition-fees.index',
        'admin.faqs.index',
        'admin.publications.index',
        'admin.news.index',
        'admin.news.create',
        'admin.agendas.index',
        'admin.galleries.index',
        'admin.documents.index',
    ];

    foreach ($allowed as $route) {
        $this->get(route($route))->assertStatus(200);
    }
});

test('operator ditolak 403 pada area sensitif (enforcement backend)', function () {
    $this->actingAs(createOperator(), 'admin');

    $denied = [
        'admin.program-profile.edit',
        'admin.accreditations.index',
        'admin.learning-outcomes.index',
        'admin.academic-calendars.index',
        'admin.researches.index',
        'admin.community-services.index',
        'admin.partnerships.index',
        'admin.testimonials.index',
        'admin.alumni.index',
        'admin.categories.index',
        'admin.media.index',
        'admin.seo-health.index',
        'admin.site-settings.index',
        'admin.helpdesk.index',
        'admin.audit-logs.index',
        'admin.admins.index',
        'admin.admins.create',
    ];

    foreach ($denied as $route) {
        $this->get(route($route))->assertForbidden();
    }
});

test('halaman panduan dapat diakses super admin, operator, dan ditolak tamu', function () {
    $this->get(route('admin.guide'))->assertRedirect(route('admin.login'));

    $this->actingAs(createOperator(), 'admin');
    $this->get(route('admin.guide'))
        ->assertStatus(200)
        ->assertSee('Panduan Penggunaan CMS')
        ->assertSee('Daftar Isi')
        // Panduan khusus super admin tidak dirender sama sekali untuk operator.
        ->assertSee('id="berita"', false)
        ->assertDontSee('id="kelola-admin"', false)
        ->assertDontSee('id="pengaturan"', false)
        ->assertDontSee('id="helpdesk"', false);

    $this->actingAs(Admin::where('email', 'superadmin@gmail.com')->first(), 'admin');
    $this->get(route('admin.guide'))
        ->assertStatus(200)
        ->assertSee('id="berita"', false)
        ->assertSee('id="kelola-admin"', false)
        ->assertSee('id="pengaturan"', false)
        ->assertSee('id="helpdesk"', false);
});

test('role selain super_admin dan operator ditolak total di CMS', function () {
    $alien = createOperator(['email' => 'alien@unesa.ac.id']);
    $alien->forceFill(['role' => 'alien'])->saveQuietly();

    $this->actingAs($alien->fresh(), 'admin');

    $this->get(route('admin.dashboard'))->assertForbidden();
    $this->get(route('admin.news.index'))->assertForbidden();
});

test('operator tidak bisa membuat admin via POST langsung', function () {
    $this->actingAs(createOperator(), 'admin');

    $response = $this->post(route('admin.admins.store'), [
        'name' => 'Hacker',
        'email' => 'hacker@unesa.ac.id',
        'password' => 'Hacker1234',
        'password_confirmation' => 'Hacker1234',
        'role' => Admin::ROLE_SUPER_ADMIN,
    ]);

    $response->assertForbidden();
    expect(Admin::where('email', 'hacker@unesa.ac.id')->exists())->toBeFalse();
});

test('operator tidak bisa mengubah pengaturan website dan eskalasi role via profil', function () {
    $operator = createOperator();
    $this->actingAs($operator, 'admin');

    $this->put(route('admin.site-settings.update'), ['site_name' => 'Hacked'])->assertForbidden();

    // Field role pada form profil diabaikan (hanya name/email yang divalidasi).
    $this->put(route('admin.profile.update'), [
        'name' => 'Operator CMS',
        'email' => 'operator@unesa.ac.id',
        'role' => Admin::ROLE_SUPER_ADMIN,
    ])->assertRedirect(route('admin.profile.edit'));

    expect($operator->fresh()->isOperator())->toBeTrue();
});

test('super admin dapat membuat operator dan mengelola admin', function () {
    $this->actingAs(Admin::where('email', 'superadmin@gmail.com')->first(), 'admin');

    $this->get(route('admin.admins.index'))->assertStatus(200);

    $response = $this->post(route('admin.admins.store'), [
        'name' => 'Operator Baru',
        'email' => 'operator.baru@unesa.ac.id',
        'password' => 'Operator123',
        'password_confirmation' => 'Operator123',
        'role' => Admin::ROLE_OPERATOR,
    ]);
    $response->assertRedirect(route('admin.admins.index'));

    $account = Admin::where('email', 'operator.baru@unesa.ac.id')->first();
    expect($account)->not->toBeNull();
    expect($account->isOperator())->toBeTrue();
});

test('super admin tidak bisa mengubah role atau menghapus akun sendiri', function () {
    $super = Admin::where('email', 'superadmin@gmail.com')->first();
    $this->actingAs($super, 'admin');

    $this->put(route('admin.admins.update', $super), [
        'name' => $super->name,
        'email' => $super->email,
        'role' => Admin::ROLE_OPERATOR,
        'is_active' => true,
    ])->assertSessionHas('error');
    expect($super->fresh()->isSuperAdmin())->toBeTrue();

    $this->delete(route('admin.admins.destroy', $super))->assertSessionHas('error');
    expect(Admin::find($super->id))->not->toBeNull();
});

test('penghapusan super admin lain diizinkan selama bukan yang terakhir', function () {
    $super = Admin::where('email', 'superadmin@gmail.com')->first();
    $this->actingAs($super, 'admin');

    $second = Admin::create([
        'name' => 'Super Kedua',
        'email' => 'super2@unesa.ac.id',
        'password' => 'Super1234',
        'role' => Admin::ROLE_SUPER_ADMIN,
        'is_active' => true,
    ]);

    $this->delete(route('admin.admins.destroy', $second))->assertRedirect(route('admin.admins.index'));
    expect(Admin::find($second->id))->toBeNull();
    expect(Admin::superAdmins()->count())->toBe(1);
});
