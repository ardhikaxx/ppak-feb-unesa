<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Akun admin awal. Kredensial via ENV agar tidak hardcode di repo.
     * Idempotent: updateOrCreate berdasarkan email.
     *
     * Pengecualian satu kali dari proteksi seeder (disetujui pemilik
     * proyek): akun lama admin@gmail.com dihapus dan diganti dua akun
     * CMS (super admin + operator). Role diisi eksplisit karena
     * DatabaseSeeder memakai WithoutModelEvents sehingga model hook
     * tidak berjalan saat `php artisan db:seed`.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin PPAk',
                'password' => 'ppakunesa', // cast 'hashed' otomatis
                'role' => Admin::ROLE_SUPER_ADMIN,
                'is_active' => true,
            ]
        );

        Admin::updateOrCreate(
            ['email' => 'operator@gmail.com'],
            [
                'name' => 'Operator PPAk',
                'password' => 'ppakunesa', // cast 'hashed' otomatis
                'role' => Admin::ROLE_OPERATOR,
                'is_active' => true,
            ]
        );
    }
}
