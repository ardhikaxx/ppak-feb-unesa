<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * RBAC CMS: super_admin (akses penuh) vs operator (modul konten).
     *
     * - Default DB 'super_admin' disengaja: DatabaseSeeder memakai
     *   WithoutModelEvents sehingga model hook tidak berjalan saat
     *   `php artisan db:seed`; default ini menjamin install baru tidak
     *   terkunci bila ada akun dibuat tanpa role eksplisit.
     *   Pembuatan akun via CMS selalu mengisi role eksplisit di belakang
     *   route khusus super_admin + validasi, jadi default ini tidak
     *   bisa dimanfaatkan untuk eskalasi dari publik.
     * - Backfill: seluruh admin existing menjadi super_admin (pengganti
     *   pengubahan seeder yang dilarang AGENTS.md). Super admin kemudian
     *   dapat menurunkan akun lain menjadi operator via Kelola Admin.
     */
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('role', 20)->default('super_admin')->after('password');
            $table->index('role');
        });

        DB::table('admins')->update(['role' => 'super_admin']);
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropColumn('role');
        });
    }
};
