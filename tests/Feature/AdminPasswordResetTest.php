<?php

use App\Models\Admin;
use App\Notifications\AdminResetPasswordNotification;
use Database\Seeders\AdminSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

function adminResetToken(Admin $admin): string
{
    return Password::broker('admins')->createToken($admin);
}

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

test('respons request reset identik untuk email terdaftar dan tidak (anti enumeration)', function () {
    Notification::fake();

    $message = 'Jika email terdaftar pada akun admin aktif, tautan untuk mengatur ulang password telah dikirim. Periksa kotak masuk atau folder spam Anda.';

    $valid = $this->post(route('admin.password.email'), ['email' => 'superadmin@gmail.com']);
    $valid->assertRedirect(route('admin.password.request'));
    $valid->assertSessionHas('info', $message);

    $invalid = $this->post(route('admin.password.email'), ['email' => 'tidakada@unesa.ac.id']);
    $invalid->assertRedirect(route('admin.password.request'));
    $invalid->assertSessionHas('info', $message);

    // Email tidak terdaftar: tidak ada token, tidak ada notifikasi.
    expect(DB::table('admin_password_reset_tokens')->where('email', 'tidakada@unesa.ac.id')->exists())->toBeFalse();
    Notification::assertNotSentTo(Admin::where('email', 'tidakada@unesa.ac.id')->first() ?? new Admin, AdminResetPasswordNotification::class);
});

test('request reset email terdaftar mengirim notifikasi tautan ke route admin', function () {
    Notification::fake();
    $admin = Admin::where('email', 'superadmin@gmail.com')->first();

    $this->post(route('admin.password.email'), ['email' => 'superadmin@gmail.com'])
        ->assertRedirect(route('admin.password.request'));

    Notification::assertSentTo($admin, AdminResetPasswordNotification::class);
    expect(DB::table('admin_password_reset_tokens')->where('email', $admin->email)->exists())->toBeTrue();
});

test('akun nonaktif tidak menerima tautan reset namun respons tetap sama', function () {
    Notification::fake();
    $admin = Admin::where('email', 'operator@gmail.com')->first();
    $admin->update(['is_active' => false]);

    $message = 'Jika email terdaftar pada akun admin aktif, tautan untuk mengatur ulang password telah dikirim. Periksa kotak masuk atau folder spam Anda.';

    $response = $this->post(route('admin.password.email'), ['email' => 'operator@gmail.com']);
    $response->assertRedirect(route('admin.password.request'));
    $response->assertSessionHas('info', $message);

    Notification::assertNothingSent();
    expect(DB::table('admin_password_reset_tokens')->where('email', $admin->email)->exists())->toBeFalse();
});

test('reset password via tautan token email lalu login dengan password baru', function () {
    Notification::fake();
    $admin = Admin::where('email', 'superadmin@gmail.com')->first();
    $token = adminResetToken($admin);

    $this->get(route('admin.password.reset', ['token' => $token, 'email' => $admin->email]))
        ->assertStatus(200)
        ->assertSee('Buat password baru', false);

    $newPassword = 'Baru1234';
    $reset = $this->post(route('admin.password.update'), [
        'token' => $token,
        'email' => $admin->email,
        'password' => $newPassword,
        'password_confirmation' => $newPassword,
    ]);
    $reset->assertRedirect(route('admin.login'));
    $reset->assertSessionHas('success');
    $reset->assertSessionHas('password_reset_success');

    expect(Hash::check($newPassword, Admin::where('email', 'superadmin@gmail.com')->first()->password))->toBeTrue();

    // Token terhapus setelah dipakai (sekali pakai).
    expect(DB::table('admin_password_reset_tokens')->where('email', $admin->email)->exists())->toBeFalse();

    $login = $this->post(route('admin.login.store'), ['email' => 'superadmin@gmail.com', 'password' => $newPassword]);
    $login->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticated('admin');
});

test('halaman reset tanpa token dialihkan ke lupa password', function () {
    $this->get(route('admin.password.reset'))->assertRedirect(route('admin.password.request'));
});

test('halaman reset dengan token palsu dialihkan ke lupa password', function () {
    $admin = Admin::where('email', 'superadmin@gmail.com')->first();

    $this->get(route('admin.password.reset', ['token' => 'token-palsu', 'email' => $admin->email]))
        ->assertRedirect(route('admin.password.request'));
});

test('post reset dengan token salah ditolak dan password tidak berubah', function () {
    $admin = Admin::where('email', 'superadmin@gmail.com')->first();
    $oldHash = $admin->password;

    $newPassword = 'Baru1234';
    $response = $this->post(route('admin.password.update'), [
        'token' => 'token-salah',
        'email' => $admin->email,
        'password' => $newPassword,
        'password_confirmation' => $newPassword,
    ]);

    $response->assertRedirect(route('admin.password.request'));
    $response->assertSessionHas('error');

    expect(Admin::where('email', 'superadmin@gmail.com')->first()->password)->toBe($oldHash);
});

test('post reset tanpa token ditolak', function () {
    $newPassword = 'Baru1234';
    $this->post(route('admin.password.update'), [
        'email' => 'superadmin@gmail.com',
        'password' => $newPassword,
        'password_confirmation' => $newPassword,
    ])->assertSessionHasErrors('token');
});
