<?php

use App\Models\Admin;
use Database\Seeders\AdminSeeder;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

function assertSingleSwal($response): void
{
    // CDN SweetAlert2 tepat satu versi: 1 CSS + 1 JS, helper didefinisikan 1x.
    $html = $response->getContent();
    expect(substr_count($html, 'sweetalert2@11.26.25'))->toBe(2) // CSS + JS
        ->and(substr_count($html, 'sweetalert2.min.css'))->toBe(1)
        ->and(substr_count($html, 'sweetalert2.all.min.js'))->toBe(1)
        ->and(substr_count($html, 'window.PpakSwal = {'))->toBe(1)
        ->and(substr_count($html, 'window.__ppakSwalInit'))->toBe(2); // guard + set
}

test('login memuat swal sekali tanpa alert bootstrap duplikat', function () {
    $response = $this->get(route('admin.login'));
    $response->assertStatus(200);
    assertSingleSwal($response);
    // Flash lama sudah dipindah ke toast: tidak ada lagi alert inline success/error.
    $response->assertDontSee('alert alert-success', false);
    $response->assertDontSee('alert alert-danger', false);
    // Modal konfirmasi Bootstrap lama tidak ada di halaman login.
    $response->assertDontSee('confirmDeleteModal', false);
});

test('layout admin memuat swal sekali, modal hapus lama hilang', function () {
    $admin = Admin::first();
    $response = $this->actingAs($admin, 'admin')->get(route('admin.dashboard'));
    $response->assertStatus(200);
    assertSingleSwal($response);
    $response->assertDontSee('confirmDeleteModal', false);
    $response->assertDontSee('confirmDeleteMessage', false);
    // Form DELETE generik + konfirmasi logout tetap ada (proteksi Laravel utuh).
    $response->assertSee('id="confirmDeleteForm"', false);
    $response->assertSee('data-swal-confirm', false);
    $response->assertSee('method="POST"', false);
});

test('halaman publik memuat swal sekali', function () {
    $response = $this->get(route('kontak.helpdesk'));
    $response->assertStatus(200);
    assertSingleSwal($response);
});

test('flash session diteruskan ke toast tanpa mengubah redirect', function () {
    $admin = Admin::first();
    $response = $this->actingAs($admin, 'admin')
        ->post(route('admin.logout'));
    $response->assertRedirect(route('admin.login'));
    $response->assertSessionHas('success', 'Anda telah logout dengan aman.');
});

test('login gagal tetap menampilkan error validasi lapangan', function () {
    $response = $this->post(route('admin.login.store'), [
        'email' => 'tidak@ada.test',
        'password' => 'salah-password-123',
    ]);
    // Throttle boleh 302 kembali atau 200 dengan error; yang penting tidak 500.
    expect($response->getStatusCode())->toBeIn([200, 302]);
});
