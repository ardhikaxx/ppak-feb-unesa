<?php

use App\Models\Admin;
use Database\Seeders\AdminSeeder;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

test('response publik memuat security header dasar', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertHeader('X-Frame-Options', 'DENY');
    $response->assertHeader('X-Content-Type-Options', 'nosniff');
    $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');

    $csp = (string) $response->headers->get('Content-Security-Policy');
    expect($csp)->toContain("default-src 'self'");
    expect($csp)->toContain("frame-ancestors 'none'");
    expect($csp)->toContain('script-src');
});

test('HSTS tidak dikirim pada request HTTP non-secure', function () {
    $response = $this->get('/');
    $response->assertOk();
    expect($response->headers->has('Strict-Transport-Security'))->toBeFalse();
});

test('pembuatan admin memakai kebijakan password campuran (min 8, huruf + angka)', function () {
    $this->actingAs(Admin::where('email', 'superadmin@gmail.com')->first(), 'admin');

    $weak = $this->post(route('admin.admins.store'), [
        'name' => 'Lemah',
        'email' => 'lemah@unesa.ac.id',
        'password' => 'abcdefgh',
        'password_confirmation' => 'abcdefgh',
        'role' => Admin::ROLE_OPERATOR,
    ]);
    $weak->assertSessionHasErrors('password');
    expect(Admin::where('email', 'lemah@unesa.ac.id')->exists())->toBeFalse();

    $noNumber = $this->post(route('admin.admins.store'), [
        'name' => 'TanpaAngka',
        'email' => 'tanpaangka@unesa.ac.id',
        'password' => 'Abcdefgh',
        'password_confirmation' => 'Abcdefgh',
        'role' => Admin::ROLE_OPERATOR,
    ]);
    $noNumber->assertSessionHasErrors('password');

    $strong = $this->post(route('admin.admins.store'), [
        'name' => 'Kuat',
        'email' => 'kuat@unesa.ac.id',
        'password' => 'KuatPass123',
        'password_confirmation' => 'KuatPass123',
        'role' => Admin::ROLE_OPERATOR,
    ]);
    $strong->assertRedirect(route('admin.admins.index'));
    expect(Admin::where('email', 'kuat@unesa.ac.id')->exists())->toBeTrue();
});

test('operator tidak melihat tombol akses cepat super admin di dashboard', function () {
    $operator = Admin::create([
        'name' => 'Operator Dashboard',
        'email' => 'operator.dash@unesa.ac.id',
        'password' => 'Operator123',
        'role' => Admin::ROLE_OPERATOR,
        'is_active' => true,
    ]);

    $this->actingAs($operator, 'admin');
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Akses Cepat')
        ->assertDontSee('Profil Program', false)
        ->assertDontSee('Pengaturan Website', false)
        ->assertSee('Tulis Berita');

    $super = Admin::where('email', 'superadmin@gmail.com')->first();
    $this->actingAs($super, 'admin');
    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Profil Program')
        ->assertSee('Pengaturan Website');
});

test('indeks galeri memuat checkbox tampilkan arsip', function () {
    $this->actingAs(Admin::where('email', 'superadmin@gmail.com')->first(), 'admin');

    $this->get(route('admin.galleries.index'))
        ->assertOk()
        ->assertSee('Tampilkan arsip (soft delete)', false)
        ->assertSee('name="trashed"', false);
});
