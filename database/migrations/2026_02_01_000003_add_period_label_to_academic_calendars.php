<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Label periode resmi per semester (mis. "1 Agustus 2026 – 31 Januari 2027").
     * Aditif, nullable, tidak mengubah data existing.
     */
    public function up(): void
    {
        Schema::table('academic_calendars', function (Blueprint $table) {
            $table->string('period_label', 100)->nullable()->after('semester');
        });
    }

    public function down(): void
    {
        Schema::table('academic_calendars', function (Blueprint $table) {
            $table->dropColumn('period_label');
        });
    }
};
