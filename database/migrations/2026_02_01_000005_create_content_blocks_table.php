<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Blok konten untuk section sederhana (tanpa relasi kompleks):
     * keunggulan beranda, bidang karier, tahapan pendaftaran, persyaratan.
     * Data awal TIDAK di-seed di sini: repository memakai data master sebagai
     * fallback selama tabel kosong, dan CMS menyediakan tombol impor.
     */
    public function up(): void
    {
        Schema::create('content_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('group', 50)->index(); // keunggulan, karier, tahapan, persyaratan
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon', 100)->nullable(); // kelas Font Awesome, mis. fa-certificate
            $table->string('link_url', 500)->nullable();
            $table->json('meta')->nullable(); // mis. {"source": "SINDIG UNESA"}
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('status', 20)->default('published')->index(); // published, draft
            $table->timestamps();

            $table->index(['group', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_blocks');
    }
};
