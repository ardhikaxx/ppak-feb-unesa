<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Akun admin awal. Kredensial via ENV agar tidak hardcode di repo.
     * Idempotent: updateOrCreate berdasarkan email.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator PPAk',
                'password' => 'password', // cast 'hashed' otomatis
                'is_active' => true,
            ]
        );
    }
}
