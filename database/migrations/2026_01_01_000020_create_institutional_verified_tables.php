<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Program Profile
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
            $table->string('data_status', 30)->default('verified')->index(); // verified, pending_verification, archived
            $table->timestamps();
        });

        // 2. Accreditations
        Schema::create('accreditations', function (Blueprint $table) {
            $table->id();
            $table->string('program_name')->default('Pendidikan Profesi Akuntan');
            $table->string('agency', 100)->default('LAMEMBA'); // LAMEMBA, BAN-PT
            $table->string('status', 50)->default('Baik'); // Baik, Unggul, Baik Sekali
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

        // 3. Learning Outcomes (CPL)
        Schema::create('learning_outcomes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique(); // CPL-1, CPL-2, CPL-3, CPL-4
            $table->string('title')->nullable();
            $table->text('description');
            $table->string('category', 50)->nullable(); // Sikap, Keterampilan Umum, Pengetahuan, Keterampilan Khusus
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        // 4. Academic Curricula
        Schema::create('academic_curricula', function (Blueprint $table) {
            $table->id();
            $table->string('course_code', 30)->unique();
            $table->string('name_id');
            $table->string('name_en')->nullable();
            $table->unsignedTinyInteger('semester')->index(); // 1, 2
            $table->unsignedTinyInteger('credits'); // SKS
            $table->string('course_type', 50)->default('Wajib'); // Wajib, Paket Magang
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

        // 5. Academic Calendars
        Schema::create('academic_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year', 20)->default('2026/2027')->index();
            $table->string('semester', 20)->index(); // Gasal, Genap, Tahunan
            $table->string('activity');
            $table->date('start_date')->index();
            $table->date('end_date')->nullable();
            $table->string('category', 50)->default('Akademik'); // Registrasi, Perkuliahan, Ujian, Yudisium
            $table->string('decree_info')->nullable(); // SK No. B/2322/UN38.I/TU.00.02/2026
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('verified')->index();
            $table->timestamps();
        });

        // 6. Admission Schedules
        Schema::create('admission_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year', 20)->default('2026/2027')->index();
            $table->string('wave_name', 50); // Gelombang 1, Gelombang 2, Gelombang 3
            $table->string('period_label', 100)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('verification_date')->nullable();
            $table->date('exam_date')->nullable();
            $table->date('announcement_date')->nullable();
            $table->date('registration_deadline')->nullable();
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

        // 7. Tuition Fees
        Schema::create('tuition_fees', function (Blueprint $table) {
            $table->id();
            $table->string('program_name')->default('Pendidikan Profesi Akuntan');
            $table->string('fee_type', 50)->default('UKT'); // UKT, Biaya Pendaftaran Admisi
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

        // 8. Publications
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('authors');
            $table->string('publication_type', 50)->default('Pengabdian / Publikasi Ilmiah');
            $table->string('journal_or_publisher')->nullable();
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

        // 9. Research & Community Services (Institutional / Dosen)
        Schema::create('researches', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('principal_investigator')->nullable();
            $table->string('scheme')->nullable();
            $table->year('year')->nullable();
            $table->string('status')->default('draft')->index(); // draft, unpublished, published
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
            $table->string('status')->default('draft')->index(); // draft, unpublished, published
            $table->text('description')->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('pending_verification')->index();
            $table->timestamps();
        });

        // 10. Partnerships
        Schema::create('partnerships', function (Blueprint $table) {
            $table->id();
            $table->string('partner_name');
            $table->string('partner_category', 50)->nullable(); // Asosiasi Profesi, Instansi Pemerintah, KAP, Korporasi
            $table->string('collaboration_type')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->string('status')->default('draft')->index(); // draft, unpublished, active, archived
            $table->string('logo')->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('pending_verification')->index();
            $table->timestamps();
        });

        // 11. FAQs
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('category', 50)->default('Admisi'); // Admisi, Akademik, Umum
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

        // 12. Alumni & Testimonials
        Schema::create('alumni_records', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('graduation_year', 10)->nullable();
            $table->string('current_company')->nullable();
            $table->string('current_position')->nullable();
            $table->string('status')->default('draft')->index(); // draft, unpublished, published
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->date('source_published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('data_status', 30)->default('pending_verification')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
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
    }
};
