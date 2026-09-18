<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Scalable content tables for PPAk FEB UNESA CMS.
 * Designed for growth from tens to thousands of records.
 * All searchable/filterable columns indexed, slug unique, soft deletes where needed.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Categories - reusable across news, agenda, documents
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->index(); // news, agenda, document, gallery
            $table->string('color')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['type', 'slug']);
        });

        // News / Pengumuman
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('image')->nullable();
            $table->string('image_thumb')->nullable();
            $table->string('status')->default('published')->index(); // enum: draft/scheduled/published/archived
            $table->timestamp('published_at')->nullable()->index();
            $table->unsignedInteger('view_count')->default(0);
            $table->string('read_time')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'published_at']);
            $table->index(['category_id', 'status']);
            $table->fullText(['title', 'excerpt']); // MySQL fulltext for search
        });

        // Agenda / Events
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->date('event_date')->index();
            $table->date('event_end_date')->nullable();
            $table->string('time')->nullable();
            $table->string('venue')->nullable();
            $table->string('speaker')->nullable();
            $table->string('status')->default('upcoming')->index();
            $table->boolean('is_upcoming')->default(true)->index();
            $table->text('description')->nullable();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['event_date', 'is_upcoming']);
            $table->index(['status', 'event_date']);
        });

        // Lecturers / Dosen
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('gelar')->nullable();
            $table->string('role')->nullable();
            $table->string('category')->index(); // auditing, keuangan, perpajakan, manajemen
            $table->string('category_label')->nullable();
            $table->string('bidang')->nullable();
            $table->json('matkul')->nullable();
            $table->string('image')->nullable();
            $table->string('image_thumb')->nullable();
            $table->string('email')->nullable();
            $table->json('sertifikasi')->nullable();
            $table->string('status')->default('active')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['category', 'status']);
        });

        // Documents / Unduhan
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('filename')->unique();
            $table->string('path'); // storage path, not exposed
            $table->string('mime_type')->index();
            $table->unsignedBigInteger('size'); // bytes
            $table->string('format')->index(); // PDF, DOCX
            $table->year('year')->nullable()->index();
            $table->string('status')->default('published')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['category_id', 'status']);
            $table->index(['year', 'status']);
        });

        // Galleries
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('image');
            $table->string('image_thumb')->nullable();
            $table->string('image_medium')->nullable();
            $table->date('event_date')->nullable()->index();
            $table->string('status')->default('published')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'event_date']);
        });

        // Testimonials / Alumni
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('company')->nullable();
            $table->string('year')->nullable()->index();
            $table->string('avatar')->nullable();
            $table->text('quote');
            $table->string('status')->default('published')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // Partners / Mitra
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->index();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('status')->default('active')->index();
            $table->timestamps();
        });

        // Helpdesk inquiries - with rate limiting and audit
        Schema::create('helpdesk_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->index();
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->string('category')->nullable()->index();
            $table->string('status')->default('open')->index();
            $table->string('ip_address')->nullable()->index();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });

        // Audit trail for admin actions
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('auditable');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action')->index(); // created, updated, published, deleted
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();

            $table->index(['auditable_type', 'auditable_id']);
            $table->index(['action', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('helpdesk_inquiries');
        Schema::dropIfExists('partners');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('lecturers');
        Schema::dropIfExists('agendas');
        Schema::dropIfExists('news');
        Schema::dropIfExists('categories');
    }
};
