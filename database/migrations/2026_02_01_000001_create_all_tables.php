<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Satu-satunya migrasi database PPAk FEB UNESA (konsolidasi).
 *
 * Menggabungkan seluruh tabel framework (users, cache, jobs, sessions),
 * tabel CMS admin (admins, site_settings), dan seluruh tabel konten
 * (profil, akademik, admisi, riset, publikasi, dokumen, audit).
 * Dijalankan via: php artisan migrate:fresh --seed
 */
return new class extends Migration
{
    public function up(): void
    {
        // ---- Framework: users, sessions ----
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // ---- Framework: cache ----
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->bigInteger('expiration')->index();
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->bigInteger('expiration')->index();
        });

        // ---- Framework: queue ----
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedSmallInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('connection');
            $table->string('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();

            $table->index(['connection', 'queue', 'failed_at']);
        });

        // ---- CMS Admin ----
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('admin_password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->default('general')->index();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['group', 'key']);
        });

        // ---- Konten: kategori (induk relasi) ----
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

        // ---- Profil program ----
        Schema::create('program_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('program_code', 20)->default('62902')->index();
            $table->string('program_name')->default('Pendidikan Profesi Akuntan');
            $table->string('short_name', 50)->default('PPAk FEB UNESA');
            $table->string('faculty')->default('Fakultas Ekonomika dan Bisnis');
            $table->string('university')->default('Universitas Negeri Surabaya');
            $table->string('level', 50)->default('Profesi');
            $table->date('established_date')->default('2025-05-23');
            $table->string('coordinator_name')->default('Rediyanto Putra, S.E., M.S.A.');
            $table->string('tagline')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('address')->nullable();
            $table->string('office_hours')->nullable();
            $table->json('social_links')->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        Schema::create('accreditations', function (Blueprint $table) {
            $table->id();
            $table->string('program_name')->default('Pendidikan Profesi Akuntan');
            $table->string('agency', 100)->default('LAMEMBA');
            $table->string('status', 50)->default('Baik');
            $table->string('decree_number')->default('611/DE/A.5/AR.11/II/2025');
            $table->date('decree_date')->default('2025-02-26');
            $table->date('effective_from')->default('2025-02-26');
            $table->date('effective_until')->default('2027-02-25');
            $table->string('certificate_file')->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        Schema::create('learning_outcomes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique(); // CPL-1 .. CPL-4
            $table->string('title')->nullable();
            $table->text('description');
            $table->string('category', 50)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        Schema::create('academic_curricula', function (Blueprint $table) {
            $table->id();
            $table->string('course_code', 30)->unique();
            $table->string('name_id');
            $table->string('name_en')->nullable();
            $table->unsignedTinyInteger('semester')->index(); // 1, 2
            $table->unsignedTinyInteger('credits'); // SKS
            $table->string('course_type', 50)->default('Wajib');
            $table->text('description')->nullable();
            $table->json('cpl_mapping')->nullable();
            $table->json('instructors')->nullable();
            $table->string('curriculum_year', 20)->default('2025/2026');
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        Schema::create('academic_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year', 20)->default('2026/2027')->index();
            $table->string('semester', 20)->index(); // Gasal, Genap
            $table->string('period_label', 100)->nullable(); // label resmi, mis. 1 Agustus 2026 – 31 Januari 2027
            $table->string('activity');
            $table->date('start_date')->index();
            $table->date('end_date')->nullable();
            $table->string('category', 50)->default('Akademik');
            $table->string('decree_info')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        Schema::create('admission_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year', 20)->default('2026/2027')->index();
            $table->string('wave_name', 50); // Gelombang 1, 2, 3
            $table->string('period_label', 100)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('verification_date')->nullable();
            $table->date('exam_date')->nullable();
            $table->string('exam_label', 100)->nullable(); // rentang tampil, mis. 04 – 08 Mei 2026
            $table->date('announcement_date')->nullable();
            $table->string('announcement_label', 100)->nullable();
            $table->date('registration_deadline')->nullable();
            $table->string('registration_label', 100)->nullable();
            $table->date('course_start_date')->nullable();
            $table->string('status', 30)->default('archived'); // active, upcoming, archived
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        Schema::create('tuition_fees', function (Blueprint $table) {
            $table->id();
            $table->string('program_name')->default('Pendidikan Profesi Akuntan');
            $table->string('fee_type', 50)->default('UKT');
            $table->unsignedBigInteger('amount'); // 5500000
            $table->string('currency', 10)->default('IDR');
            $table->string('period', 30)->default('Per Semester');
            $table->string('academic_year', 20)->default('2026/2027');
            $table->text('description')->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('authors');
            $table->string('publication_type', 50)->default('Pengabdian / Publikasi Ilmiah');
            $table->string('journal_or_publisher')->nullable();
            $table->text('summary')->nullable(); // ringkasan kartu publikasi
            $table->date('publish_date')->nullable();
            $table->string('year', 10)->nullable();
            $table->string('doi_or_url')->nullable();
            $table->string('sinta_id')->nullable();
            $table->string('lecturer_name')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        Schema::create('researches', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('principal_investigator')->nullable();
            $table->string('scheme')->nullable();
            $table->year('year')->nullable();
            $table->string('status')->default('draft')->index();
            $table->text('description')->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('pending_verification')->index();
            $table->timestamps();
        });

        Schema::create('community_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('leader_name')->nullable();
            $table->string('target_audience')->nullable();
            $table->string('location')->nullable();
            $table->year('year')->nullable();
            $table->string('status')->default('draft')->index();
            $table->text('description')->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('pending_verification')->index();
            $table->timestamps();
        });

        Schema::create('partnerships', function (Blueprint $table) {
            $table->id();
            $table->string('partner_name');
            $table->string('partner_category', 50)->nullable();
            $table->string('collaboration_type')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->string('status')->default('draft')->index();
            $table->string('logo')->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('pending_verification')->index();
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('category', 50)->default('Admisi');
            $table->text('question');
            $table->text('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        Schema::create('alumni_records', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('graduation_year', 10)->nullable();
            $table->string('current_company')->nullable();
            $table->string('current_position')->nullable();
            $table->string('status')->default('draft')->index();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('pending_verification')->index();
            $table->timestamps();
        });

        // ---- Konten publikasi (relasi ke categories & users) ----
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('author_name')->nullable(); // nama penulis tampil
            $table->string('image')->nullable();
            $table->string('image_thumb')->nullable();
            $table->string('status')->default('published')->index(); // draft/scheduled/published/archived
            $table->timestamp('published_at')->nullable()->index();
            $table->unsignedInteger('view_count')->default(0);
            $table->string('read_time')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'published_at']);
            if (Schema::getConnection()->getDriverName() === 'mysql') {
                $table->fullText(['title', 'excerpt']);
            } else {
                $table->index('title');
            }
        });

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
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status')->default('verified')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['event_date', 'is_upcoming']);
            $table->index(['status', 'event_date']);
        });

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
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status')->default('verified')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['category', 'status']);
        });

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
            $table->string('display_date', 50)->nullable(); // tanggal tampil, mis. 06 Januari 2026
            $table->string('status')->default('published')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status')->default('verified')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['category_id', 'status']);
            $table->index(['year', 'status']);
        });

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
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status')->default('verified')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'event_date']);
        });

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
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status')->default('verified')->index();
            $table->timestamps();
            $table->softDeletes();
        });

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

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('auditable');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action')->index(); // created, updated, published, deleted
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
            $table->index(['action', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('helpdesk_inquiries');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('lecturers');
        Schema::dropIfExists('agendas');
        Schema::dropIfExists('news');
        Schema::dropIfExists('alumni_records');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('partnerships');
        Schema::dropIfExists('community_services');
        Schema::dropIfExists('researches');
        Schema::dropIfExists('publications');
        Schema::dropIfExists('tuition_fees');
        Schema::dropIfExists('admission_schedules');
        Schema::dropIfExists('academic_calendars');
        Schema::dropIfExists('academic_curricula');
        Schema::dropIfExists('learning_outcomes');
        Schema::dropIfExists('accreditations');
        Schema::dropIfExists('program_profiles');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('admin_password_reset_tokens');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
