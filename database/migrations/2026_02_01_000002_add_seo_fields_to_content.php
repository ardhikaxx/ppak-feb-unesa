<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Field SEO per entitas konten (kolom aditif, nullable).
     * Hierarki fallback: field khusus > excerpt/konten > default Site Settings.
     * robots_index default true agar konten terbit tetap indexable.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('seo_title', 255)->nullable()->after('read_time');
            $table->string('seo_description', 500)->nullable()->after('seo_title');
            $table->string('canonical_url', 500)->nullable()->after('seo_description');
            $table->string('og_title', 255)->nullable()->after('canonical_url');
            $table->string('og_description', 500)->nullable()->after('og_title');
            $table->string('og_image', 500)->nullable()->after('og_description');
            $table->boolean('robots_index')->default(true)->index()->after('og_image');
        });

        Schema::table('agendas', function (Blueprint $table) {
            $table->string('seo_title', 255)->nullable()->after('description');
            $table->string('seo_description', 500)->nullable()->after('seo_title');
            $table->string('canonical_url', 500)->nullable()->after('seo_description');
            $table->string('og_title', 255)->nullable()->after('canonical_url');
            $table->string('og_description', 500)->nullable()->after('og_title');
            $table->string('og_image', 500)->nullable()->after('og_description');
            $table->boolean('robots_index')->default(true)->index()->after('og_image');
        });
    }

    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn([
                'seo_title', 'seo_description', 'canonical_url',
                'og_title', 'og_description', 'og_image', 'robots_index',
            ]);
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn([
                'seo_title', 'seo_description', 'canonical_url',
                'og_title', 'og_description', 'og_image', 'robots_index',
            ]);
        });
    }
};
