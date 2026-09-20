<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Single source of truth untuk informasi global website.
     * Key-value store: group.key (mis. general.site_name, contact.address,
     * seo.meta_description, social.instagram). Satu baris per key agar
     * idempotent via updateOrCreate dan mudah di-cache.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->default('general')->index();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, url, email, image, json
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['group', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
