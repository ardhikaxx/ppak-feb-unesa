<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom aditif untuk fidelitas tampilan (nullable, tanpa mengubah data existing):
     * - news.author_name: nama penulis per artikel (relasi users hanya untuk akun).
     * - documents.display_date: tanggal tampil (tabel hanya punya year).
     * - publications.summary: ringkasan untuk kartu publikasi.
     * - admission_schedules.*_label: rentang tanggal tampil (kolom date = tanggal tunggal).
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('author_name')->nullable()->after('author_id');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->string('display_date', 50)->nullable()->after('year');
        });

        Schema::table('publications', function (Blueprint $table) {
            $table->text('summary')->nullable()->after('journal_or_publisher');
        });

        Schema::table('admission_schedules', function (Blueprint $table) {
            $table->string('exam_label', 100)->nullable()->after('exam_date');
            $table->string('announcement_label', 100)->nullable()->after('announcement_date');
            $table->string('registration_label', 100)->nullable()->after('registration_deadline');
        });
    }

    public function down(): void
    {
        Schema::table('admission_schedules', function (Blueprint $table) {
            $table->dropColumn(['exam_label', 'announcement_label', 'registration_label']);
        });
        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn('summary');
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('display_date');
        });
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('author_name');
        });
    }
};
