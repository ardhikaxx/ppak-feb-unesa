<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Penghapusan tabel blok konten & konten halaman (diputuskan tidak dipakai;
     * teks kembali hardcoded di Blade). Aman di semua environment.
     */
    public function up(): void
    {
        Schema::dropIfExists('content_blocks');
        Schema::dropIfExists('page_contents');
    }

    public function down(): void
    {
        // Tidak dikembalikan (fitur dihapus).
    }
};
