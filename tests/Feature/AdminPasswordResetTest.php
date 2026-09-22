<?php

use App\Models\Admin;
use Database\Seeders\AdminSeeder;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

test('halaman login memuat link lupa password', function () {
    $this->get(route('admin.login'))
        ->assertStatus(200)
        ->assertSee('Lupa password?', false);
});

test('halaman lupa password dapat dibuka', function () {
    $this->get(route('admin.password.request'))
        ->assertStatus(200)
        ->assertSee('Lupa Password', false);
});

test('verifikasi email gagal jika email tidak terdaftar', function () {
    $response = $this->post(route('admin.password.email'), ['email' => 'tidakada@unesa.ac.id']);
    $response->assertRedirect();
    $response->assertSessionHas('error');
    expect(session('admin_pw_reset_email'))->toBeNull();
});

test('verifikasi email berhasil lalu reset password dan login dengan password baru', function () {
    $verify = $this->post(route('admin.password.email'), ['email' => 'superadmin@gmail.com']);
    $verify->assertRedirect(route('admin.password.reset'));
    $verify->assertSessionHas('success');

    $this->get(route('admin.password.reset'))->assertStatus(200)->assertSee('Buat Password Baru', false);

    $newPassword = 'Baru1234';
    $reset = $this->post(route('admin.password.update'), [
        'password' => $newPassword,
        'password_confirmation' => $newPassword,
    ]);
    $reset->assertRedirect(route('admin.login'));
    $reset->assertSessionHas('success');
    $reset->assertSessionHas('password_reset_success');

    expect(Hash::check($newPassword, Admin::where('email', 'superadmin@gmail.com')->first()->password))->toBeTrue();

    // Login dengan password baru berhasil.
    $login = $this->post(route('admin.login.store'), ['email' => 'superadmin@gmail.com', 'password' => $newPassword]);
    $login->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticated('admin');
});

test('akses reset tanpa verifikasi dialihkan ke lupa password', function () {
    $this->get(route('admin.password.reset'))->assertRedirect(route('admin.password.request'));
});
