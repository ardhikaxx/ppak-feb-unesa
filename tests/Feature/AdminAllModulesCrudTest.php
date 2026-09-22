<?php

use App\Models\AcademicCalendar;
use App\Models\AcademicCurriculum;
use App\Models\Accreditation;
use App\Models\Admin;
use App\Models\AdmissionSchedule;
use App\Models\Agenda;
use App\Models\AlumniRecord;
use App\Models\CommunityService;
use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\HelpdeskInquiry;
use App\Models\LearningOutcome;
use App\Models\Partnership;
use App\Models\Publication;
use App\Models\Research;
use App\Models\Testimonial;
use App\Models\TuitionFee;
use App\Support\Uploads;
use Database\Seeders\AdminSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

function loginAsAdmin($testcase)
{
    $admin = Admin::first();
    $testcase->actingAs($admin, 'admin');

    return $admin;
}

test('guest cannot access any admin CMS routes and gets redirected to login', function () {
    $adminRoutes = [
        'admin.dashboard',
        'admin.program-profile.edit',
        'admin.accreditations.index',
        'admin.lecturers.index',
        'admin.curricula.index',
        'admin.learning-outcomes.index',
        'admin.academic-calendars.index',
        'admin.admission-schedules.index',
        'admin.tuition-fees.index',
        'admin.faqs.index',
        'admin.publications.index',
        'admin.researches.index',
        'admin.community-services.index',
        'admin.partnerships.index',
        'admin.testimonials.index',
        'admin.alumni.index',
        'admin.news.index',
        'admin.agendas.index',
        'admin.galleries.index',
        'admin.documents.index',
        'admin.categories.index',
        'admin.media.index',
        'admin.seo-health.index',
        'admin.site-settings.index',
        'admin.helpdesk.index',
        'admin.audit-logs.index',
        'admin.admins.index',
        'admin.profile.edit',
    ];

    foreach ($adminRoutes as $route) {
        $this->get(route($route))->assertRedirect(route('admin.login'));
    }
});

test('admin can manage accreditations CRUD', function () {
    loginAsAdmin($this);

    // Create
    $res = $this->post(route('admin.accreditations.store'), [
        'program_name' => 'Pendidikan Profesi Akuntan',
        'agency' => 'LAMEMBA Test',
        'status' => 'Unggul',
        'decree_number' => 'SK-TEST-999',
        'decree_date' => '2026-01-01',
        'effective_from' => '2026-01-01',
        'effective_until' => '2031-01-01',
    ]);
    $res->assertRedirect(route('admin.accreditations.index'));
    $item = Accreditation::where('decree_number', 'SK-TEST-999')->first();
    expect($item)->not->toBeNull();

    // Edit view
    $this->get(route('admin.accreditations.edit', $item))->assertStatus(200);

    // Update
    $this->put(route('admin.accreditations.update', $item), [
        'program_name' => 'Pendidikan Profesi Akuntan',
        'agency' => 'LAMEMBA Test Updated',
        'status' => 'Baik Sekali',
        'decree_number' => 'SK-TEST-999',
        'decree_date' => '2026-01-01',
        'effective_from' => '2026-01-01',
        'effective_until' => '2031-01-01',
    ])->assertRedirect(route('admin.accreditations.index'));
    expect($item->fresh()->agency)->toBe('LAMEMBA Test Updated');

    // Delete
    $this->delete(route('admin.accreditations.destroy', $item))->assertRedirect(route('admin.accreditations.index'));
    expect(Accreditation::where('decree_number', 'SK-TEST-999')->count())->toBe(0);
});

test('admin can manage curriculum and course CRUD', function () {
    loginAsAdmin($this);

    $code = 'TESTMK101';
    $res = $this->post(route('admin.curricula.store'), [
        'course_code' => $code,
        'name_id' => 'Akuntansi Forensik Lanjutan',
        'name_en' => 'Advanced Forensic Accounting',
        'semester' => 2,
        'credits' => 3,
        'course_type' => 'Pilihan',
        'description' => 'Mata kuliah pilihan audit investigasi.',
    ]);
    $res->assertRedirect(route('admin.curricula.index'));
    $course = AcademicCurriculum::where('course_code', $code)->first();
    expect($course)->not->toBeNull();

    // Update
    $this->put(route('admin.curricula.update', $course), [
        'course_code' => $code,
        'name_id' => 'Akuntansi Forensik & Investigasi',
        'semester' => 2,
        'credits' => 3,
        'course_type' => 'Pilihan',
    ])->assertRedirect(route('admin.curricula.index'));
    expect($course->fresh()->name_id)->toBe('Akuntansi Forensik & Investigasi');

    // Delete
    $this->delete(route('admin.curricula.destroy', $course))->assertRedirect(route('admin.curricula.index'));
    expect(AcademicCurriculum::where('course_code', $code)->count())->toBe(0);
});

test('admin can manage academic calendar CRUD', function () {
    loginAsAdmin($this);

    $res = $this->post(route('admin.academic-calendars.store'), [
        'academic_year' => '2026/2027',
        'semester' => 'Gasal',
        'activity' => 'Uji Coba Perkuliahan Perdana',
        'start_date' => '2026-09-01',
        'end_date' => '2026-09-05',
        'category' => 'Perkuliahan',
    ]);
    $res->assertRedirect(route('admin.academic-calendars.index'));
    $cal = AcademicCalendar::where('activity', 'Uji Coba Perkuliahan Perdana')->first();
    expect($cal)->not->toBeNull();

    // Delete
    $this->delete(route('admin.academic-calendars.destroy', $cal))->assertRedirect(route('admin.academic-calendars.index'));
    expect(AcademicCalendar::where('activity', 'Uji Coba Perkuliahan Perdana')->count())->toBe(0);
});

test('admin can manage admission schedules and tuition fees CRUD', function () {
    loginAsAdmin($this);

    // Admission Schedule
    $resAdm = $this->post(route('admin.admission-schedules.store'), [
        'academic_year' => '2026/2027',
        'wave_name' => 'Gelombang Uji Khusus',
        'start_date' => '2026-10-01',
        'end_date' => '2026-10-15',
        'status' => 'upcoming',
    ]);
    $resAdm->assertRedirect(route('admin.admission-schedules.index'));
    $adm = AdmissionSchedule::where('wave_name', 'Gelombang Uji Khusus')->first();
    expect($adm)->not->toBeNull();
    $this->delete(route('admin.admission-schedules.destroy', $adm));

    // Tuition Fee
    $resFee = $this->post(route('admin.tuition-fees.store'), [
        'program_name' => 'Pendidikan Profesi Akuntan',
        'fee_type' => 'UKT',
        'amount' => 5500000,
        'academic_year' => '2026/2027',
        'period' => 'per semester',
    ]);
    $resFee->assertRedirect(route('admin.tuition-fees.index'));
    $fee = TuitionFee::where('academic_year', '2026/2027')->where('amount', 5500000)->first();
    expect($fee)->not->toBeNull();
});

test('admin can manage FAQ, Learning Outcomes, Research, Publications, Partnerships, Testimonials, Alumni', function () {
    loginAsAdmin($this);

    // FAQ
    $resFaq = $this->post(route('admin.faqs.store'), [
        'category' => 'Umum',
        'question' => 'Apakah perkuliahan dilakukan secara hybrid?',
        'answer' => 'Ya, perkuliahan mendukung moda luring dan daring terstruktur.',
    ]);
    $resFaq->assertRedirect(route('admin.faqs.index'));
    $faq = FAQ::where('question', 'Apakah perkuliahan dilakukan secara hybrid?')->first();
    expect($faq)->not->toBeNull();
    $this->delete(route('admin.faqs.destroy', $faq));

    // CPL
    $resCpl = $this->post(route('admin.learning-outcomes.store'), [
        'code' => 'CPL-TEST',
        'title' => 'CPL Uji Mutu',
        'description' => 'Mampu mengevaluasi kepatuhan tata kelola korporat.',
        'category' => 'Keterampilan Khusus',
    ]);
    $resCpl->assertRedirect(route('admin.learning-outcomes.index'));
    $cpl = LearningOutcome::where('code', 'CPL-TEST')->first();
    expect($cpl)->not->toBeNull();
    $this->delete(route('admin.learning-outcomes.destroy', $cpl));

    // Research
    $resRes = $this->post(route('admin.researches.store'), [
        'title' => 'Riset Dampak AI pada Audit Keuangan Modern',
        'principal_investigator' => 'Peneliti Utama FEB',
        'year' => 2026,
        'status' => 'published',
    ]);
    $resRes->assertRedirect(route('admin.researches.index'));
    $research = Research::where('title', 'Riset Dampak AI pada Audit Keuangan Modern')->first();
    expect($research)->not->toBeNull();
    $this->delete(route('admin.researches.destroy', $research));

    // Publication
    $resPub = $this->post(route('admin.publications.store'), [
        'title' => 'Publikasi Jurnal Akuntansi Berkelanjutan',
        'authors' => 'Tim Dosen PPAk FEB UNESA',
        'journal_or_publisher' => 'Jurnal Akuntansi dan Auditing Internasional',
        'year' => '2026',
    ]);
    $resPub->assertRedirect(route('admin.publications.index'));
    $pub = Publication::where('title', 'Publikasi Jurnal Akuntansi Berkelanjutan')->first();
    expect($pub)->not->toBeNull();
    $this->delete(route('admin.publications.destroy', $pub));

    // Partnership
    $resPart = $this->post(route('admin.partnerships.store'), [
        'partner_name' => 'KAP Mitra Testing & Rekan',
        'partner_category' => 'Kantor Akuntan Publik',
        'collaboration_type' => 'Magang & Sertifikasi Profesi',
        'status' => 'active',
    ]);
    $resPart->assertRedirect(route('admin.partnerships.index'));
    $part = Partnership::where('partner_name', 'KAP Mitra Testing & Rekan')->first();
    expect($part)->not->toBeNull();
    $this->delete(route('admin.partnerships.destroy', $part));

    // Testimonial
    $resTesti = $this->post(route('admin.testimonials.store'), [
        'name' => 'Alumni Uji Testimoni',
        'role' => 'Senior Auditor',
        'company' => 'Big 4 Accounting Firm',
        'year' => '2025',
        'quote' => 'Program PPAk FEB UNESA memberikan landasan praktis yang sangat aplikatif di dunia kerja nyata.',
        'status' => 'published',
    ]);
    $resTesti->assertRedirect(route('admin.testimonials.index'));
    $testi = Testimonial::where('name', 'Alumni Uji Testimoni')->first();
    expect($testi)->not->toBeNull();
    $this->delete(route('admin.testimonials.destroy', $testi));

    // Alumni
    $resAlm = $this->post(route('admin.alumni.store'), [
        'full_name' => 'Nama Alumni Terdaftar Uji',
        'graduation_year' => '2025',
        'current_company' => 'Kementerian Keuangan RI',
        'current_position' => 'Analis Keuangan Negara',
        'status' => 'published',
    ]);
    $resAlm->assertRedirect(route('admin.alumni.index'));
    $alm = AlumniRecord::where('full_name', 'Nama Alumni Terdaftar Uji')->first();
    expect($alm)->not->toBeNull();
    $this->delete(route('admin.alumni.destroy', $alm));
});

test('admin can manage agendas and soft-delete/restore them', function () {
    loginAsAdmin($this);

    $slug = 'agenda-seminar-nasional-akuntansi-uji';
    $res = $this->post(route('admin.agendas.store'), [
        'title' => 'Seminar Nasional Akuntansi Uji',
        'slug' => $slug,
        'event_date' => '2026-11-20',
        'status' => 'upcoming',
        'is_upcoming' => 1,
        'description' => 'Deskripsi kegiatan seminar nasional.',
    ]);
    $res->assertRedirect(route('admin.agendas.index'));
    $agenda = Agenda::where('slug', $slug)->first();
    expect($agenda)->not->toBeNull();

    // Soft delete
    $this->delete(route('admin.agendas.destroy', $agenda))->assertRedirect(route('admin.agendas.index'));
    expect(Agenda::where('slug', $slug)->count())->toBe(0);
    expect(Agenda::withTrashed()->where('slug', $slug)->count())->toBe(1);

    // Restore
    $this->post(route('admin.agendas.restore', $agenda->id))->assertRedirect(route('admin.agendas.index'));
    expect(Agenda::where('slug', $slug)->count())->toBe(1);

    // Clean up
    $agenda->forceDelete();
});

test('admin can update site settings and manage helpdesk ticket status', function () {
    loginAsAdmin($this);

    // Site settings
    $this->get(route('admin.site-settings.index'))->assertStatus(200);
    $res = $this->put(route('admin.site-settings.update'), [
        'settings' => [
            'site_name' => 'PPAk FEB UNESA',
            'contact_email' => 'ppak@unesa.ac.id',
        ],
    ]);
    $res->assertRedirect(route('admin.site-settings.index'));

    // Helpdesk inquiry status update
    $inquiry = HelpdeskInquiry::create([
        'name' => 'Pemohon Tiket',
        'email' => 'pemohon@example.com',
        'phone' => '0811111111',
        'subject' => 'Pertanyaan Pembayaran',
        'message' => 'Detail pertanyaan terkait pembayaran UKT.',
        'status' => 'open',
    ]);

    $this->get(route('admin.helpdesk.show', $inquiry))->assertStatus(200);
    $this->patch(route('admin.helpdesk.update', $inquiry), [
        'status' => 'closed',
    ])->assertRedirect(route('admin.helpdesk.show', $inquiry));

    expect($inquiry->fresh()->status)->toBe('closed');
    $inquiry->delete();
});

test('admin can view seo health dashboard and flush cache', function () {
    loginAsAdmin($this);

    $response = $this->get(route('admin.seo-health.index'));
    $response->assertStatus(200);
    $response->assertSee('Kesehatan SEO');

    $flush = $this->post(route('admin.seo-health.flush-cache'));
    $flush->assertRedirect(route('admin.seo-health.index'));
    $flush->assertSessionHas('success');
});

test('admin can manage gallery CRUD with image upload', function () {
    loginAsAdmin($this);

    $slug = 'galeri-uji-cms-admin';
    $res = $this->post(route('admin.galleries.store'), [
        'title' => 'Galeri Uji CMS Admin',
        'slug' => $slug,
        'image' => UploadedFile::fake()->image('galeri-uji.jpg', 200, 150),
        'event_date' => '2026-09-01',
        'status' => 'published',
    ]);
    $res->assertRedirect(route('admin.galleries.index'));
    $item = Gallery::where('slug', $slug)->first();
    expect($item)->not->toBeNull();
    expect($item->image)->toStartWith('/uploads/');

    $this->get(route('admin.galleries.edit', $item))->assertStatus(200);

    $this->put(route('admin.galleries.update', $item), [
        'title' => 'Galeri Uji CMS Admin Updated',
        'slug' => $slug,
        'event_date' => '2026-09-02',
        'status' => 'draft',
    ])->assertRedirect(route('admin.galleries.index'));
    expect($item->fresh()->title)->toBe('Galeri Uji CMS Admin Updated');
    expect($item->fresh()->status)->toBe('draft');

    $this->delete(route('admin.galleries.destroy', $item))->assertRedirect(route('admin.galleries.index'));
    expect(Gallery::where('slug', $slug)->count())->toBe(0);
    expect(Gallery::withTrashed()->where('slug', $slug)->count())->toBe(1);

    $this->post(route('admin.galleries.restore', $item->id))->assertRedirect(route('admin.galleries.index'));
    expect(Gallery::where('slug', $slug)->count())->toBe(1);

    // Cleanup file fisik + record
    Uploads::delete($item->fresh()->image);
    Gallery::withTrashed()->where('slug', $slug)->forceDelete();
});

test('admin can manage community service (PKM) CRUD', function () {
    loginAsAdmin($this);

    $res = $this->post(route('admin.community-services.store'), [
        'title' => 'Pelatihan Akuntansi Desa Uji',
        'leader_name' => 'Dr. Uji PKM',
        'target_audience' => 'Perangkat Desa',
        'location' => 'Surabaya',
        'year' => 2026,
        'status' => 'published',
        'description' => 'Deskripsi kegiatan pengabdian kepada masyarakat untuk pengujian CMS.',
    ]);
    $res->assertRedirect(route('admin.community-services.index'));
    $item = CommunityService::where('title', 'Pelatihan Akuntansi Desa Uji')->first();
    expect($item)->not->toBeNull();

    $this->get(route('admin.community-services.edit', $item))->assertStatus(200);

    $this->put(route('admin.community-services.update', $item), [
        'title' => 'Pelatihan Akuntansi Desa Uji Updated',
        'leader_name' => 'Dr. Uji PKM Updated',
        'year' => 2026,
        'status' => 'draft',
        'description' => 'Deskripsi kegiatan pengabdian kepada masyarakat untuk pengujian CMS.',
    ])->assertRedirect(route('admin.community-services.index'));
    expect($item->fresh()->title)->toBe('Pelatihan Akuntansi Desa Uji Updated');
    expect($item->fresh()->status)->toBe('draft');

    $this->delete(route('admin.community-services.destroy', $item))->assertRedirect(route('admin.community-services.index'));
    expect(CommunityService::where('title', 'Pelatihan Akuntansi Desa Uji Updated')->count())->toBe(0);
});

test('admin can delete unused media file and path traversal is rejected', function () {
    loginAsAdmin($this);

    Uploads::ensureDirectory('media-uji');
    $absolute = Uploads::basePath().'/media-uji/file-uji.txt';
    File::put($absolute, 'isi file uji media manager');
    expect(File::exists($absolute))->toBeTrue();

    $this->get(route('admin.media.index'))
        ->assertStatus(200)
        ->assertSee('file-uji.txt', false);

    $this->delete(route('admin.media.destroy'), ['path' => 'media-uji/file-uji.txt'])
        ->assertRedirect(route('admin.media.index'))
        ->assertSessionHas('success');
    expect(File::exists($absolute))->toBeFalse();

    // Path traversal / file tidak ada ditolak dengan error, tanpa hapus apa pun.
    $this->delete(route('admin.media.destroy'), ['path' => '../../.env'])
        ->assertRedirect(route('admin.media.index'))
        ->assertSessionHas('error');

    $this->delete(route('admin.media.destroy'), ['path' => 'media-uji/tidak-ada.txt'])
        ->assertRedirect(route('admin.media.index'))
        ->assertSessionHas('error');
});
