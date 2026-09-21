<?php

use App\Models\Admin;
use Database\Seeders\AdminSeeder;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

test('semua input password punya toggle tampil/sembunyi', function () {
    // Halaman publik (tamu): login.
    $login = $this->get(route('admin.login'));
    $login->assertStatus(200);
    $login->assertSee('type="password"', false);
    $login->assertSee('data-password-input', false);
    $login->assertSee('data-password-toggle', false);
    $login->assertSee('fa-solid fa-eye', false);

    // Halaman butuh login: kelola akun & profil.
    $admin = Admin::first();
    $pages = [
        $this->actingAs($admin, 'admin')->get(route('admin.admins.create')),
        $this->actingAs($admin, 'admin')->get(route('admin.profile.edit')),
    ];

    foreach ($pages as $response) {
        $response->assertStatus(200);
        $response->assertSee('type="password"', false);
        $response->assertSee('data-password-input', false);
        $response->assertSee('data-password-toggle', false);
        $response->assertSee('fa-solid fa-eye', false);
    }
});
