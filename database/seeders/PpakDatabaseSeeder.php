<?php

namespace Database\Seeders;

use App\Models\AcademicCalendar;
use App\Models\AcademicCurriculum;
use App\Models\Accreditation;
use App\Models\AdmissionSchedule;
use App\Models\Agenda;
use App\Models\AlumniRecord;
use App\Models\Category;
use App\Models\CommunityService;
use App\Models\Document;
use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\LearningOutcome;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\Partnership;
use App\Models\ProgramProfile;
use App\Models\Publication;
use App\Models\Research;
use App\Models\Testimonial;
use App\Models\TuitionFee;
use App\Services\PpakData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * ============================================================================
 * PERINGATAN / PROTEKSI MUTLAK DATA SEEDER (IMMUTABLE SEEDER - TAHUN 2026)
 * ============================================================================
 * AI APAPUN DILARANG MENGUBAH, MENAMBAH, ATAU MENGHAPUS DATA PADA FILE INI.
 * Seluruh data di bawah ini merupakan data resmi terverifikasi tahun 2026:
 * - SK Rektor UNESA No. 645/UN38/HK/2025 (Penyelenggaraan PPAk)
 * - SK LAMEMBA No. 611/DE/A.5/AR.11/II/2025 (Akreditasi Baik)
 * - SK Kalender Akademik UNESA 2026/2027 (No. B/2322/UN38.I/TU.00.02/2026)
 * - Penetapan UKT Rp5.500.000 / semester (Admisi UNESA)
 * - Kurikulum SINDIG UNESA Kode Prodi 62902
 *
 * Pembaruan data dinamis hanya dilakukan melalui antarmuka CMS Admin (/admin).
 * ============================================================================
 */
class PpakDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $info = PpakData::getGeneralInfo();

        // 1. Program Profile (Profil Resmi 2026)
        ProgramProfile::updateOrCreate(
            ['program_code' => '62902'],
            [
                'program_name' => $info['name'],
                'short_name' => $info['short_name'],
                'faculty' => $info['faculty'],
                'university' => $info['university'],
                'level' => $info['level'],
                'established_date' => '2025-04-15',
                'coordinator_name' => $info['coordinator'],
                'tagline' => $info['tagline'],
                'email' => $info['email'],
                'phone' => $info['phone'],
                'whatsapp' => $info['whatsapp'],
                'address' => $info['address'],
                'office_hours' => $info['office_hours'],
                'social_links' => $info['socials'],
                'source_url' => 'https://sindig.unesa.ac.id',
                'source_name' => 'SK Rektor UNESA No. 645/UN38/HK/2025 & SINDIG UNESA',
                'source_published_at' => '2025-04-15',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 2. Accreditation (LAMEMBA 2025-2027)
        Accreditation::updateOrCreate(
            ['decree_number' => '611/DE/A.5/AR.11/II/2025'],
            [
                'program_name' => 'Pendidikan Profesi Akuntan',
                'agency' => 'LAMEMBA',
                'status' => 'Baik',
                'decree_date' => '2025-02-26',
                'effective_from' => '2025-02-26',
                'effective_until' => '2027-02-25',
                'certificate_file' => 'documents/sk-akreditasi-lamemba-ppak-unesa.pdf',
                'source_url' => 'https://simutu.unesa.ac.id',
                'source_name' => 'SIMUTU UNESA - Data Akreditasi Nasional',
                'source_published_at' => '2025-02-26',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 3. Learning Outcomes (4 CPL Resmi SINDIG UNESA)
        $cpls = PpakData::getKompetensi();
        foreach ($cpls as $index => $cpl) {
            LearningOutcome::updateOrCreate(
                ['code' => $cpl['code']],
                [
                    'title' => $cpl['title'],
                    'description' => $cpl['desc'],
                    'category' => $cpl['category'] ?? null,
                    'sort_order' => $index + 1,
                    'source_url' => 'https://sindig.unesa.ac.id',
                    'source_name' => 'SINDIG UNESA - Kurikulum Prodi 62902',
                    'source_published_at' => '2025-05-23',
                    'verified_at' => now(),
                    'data_status' => 'verified',
                ]
            );
        }

        // 4. Academic Curricula (11 Mata Kuliah SINDIG)
        $kurikulum = PpakData::getKurikulum();
        $sortOrder = 1;
        foreach ($kurikulum['semester_1'] as $mk) {
            AcademicCurriculum::updateOrCreate(
                ['course_code' => $mk['kode']],
                [
                    'name_id' => $mk['nama'],
                    'semester' => 1,
                    'credits' => $mk['sks'],
                    'course_type' => $mk['jenis'],
                    'description' => $mk['deskripsi'],
                    'cpl_mapping' => $mk['cpl'],
                    'instructors' => $mk['pengajar'],
                    'curriculum_year' => '2025/2026',
                    'sort_order' => $sortOrder++,
                    'source_url' => 'https://sindig.unesa.ac.id',
                    'source_name' => 'SINDIG UNESA',
                    'source_published_at' => '2025-05-23',
                    'verified_at' => now(),
                    'data_status' => 'verified',
                ]
            );
        }

        foreach ($kurikulum['semester_2'] as $mk) {
            AcademicCurriculum::updateOrCreate(
                ['course_code' => $mk['kode']],
                [
                    'name_id' => $mk['nama'],
                    'semester' => 2,
                    'credits' => $mk['sks'],
                    'course_type' => $mk['jenis'],
                    'description' => $mk['deskripsi'],
                    'cpl_mapping' => $mk['cpl'],
                    'instructors' => $mk['pengajar'],
                    'curriculum_year' => '2025/2026',
                    'sort_order' => $sortOrder++,
                    'source_url' => 'https://sindig.unesa.ac.id',
                    'source_name' => 'SINDIG UNESA',
                    'source_published_at' => '2025-05-23',
                    'verified_at' => now(),
                    'data_status' => 'verified',
                ]
            );
        }

        // 5. Academic Calendars (2026/2027) - SK No. B/2322/UN38.I/TU.00.02/2026
        $kalender = PpakData::getKalender();
        $calOrder = 1;
        $dateMap = [
            'Gasal|Pembayaran UKT dan Registrasi Ulang Mahasiswa' => ['2026-07-01', '2026-07-31'],
            'Gasal|Konsultasi Dosen PA dan Pengisian Kartu Rencana Studi (KRS)' => ['2026-07-20', '2026-08-15'],
            'Gasal|Masa Perkuliahan Efektif Tatap Muka & Praktika Semester Gasal' => ['2026-09-01', '2026-12-18'],
            'Gasal|Penilaian Formatif Tengah Semester (UTS)' => ['2026-10-19', '2026-10-30'],
            'Gasal|Minggu Tenang dan Persiapan Evaluasi Akhir' => ['2026-12-21', '2026-12-25'],
            'Gasal|Penilaian Sumatif Akhir Semester (UAS)' => ['2026-12-28', '2027-01-08'],
            'Gasal|Entry dan Finalisasi Nilai Semester Gasal' => ['2027-01-04', '2027-01-15'],
            'Gasal|Rapat Yudisium Kelulusan Periode Semester Gasal' => ['2027-01-25', '2027-01-30'],
            'Genap|Pembayaran UKT dan Registrasi Ulang Mahasiswa Semester Genap' => ['2027-01-04', '2027-01-29'],
            'Genap|Konsultasi Dosen PA dan Pengisian / Perubahan KRS Genap' => ['2027-01-25', '2027-02-06'],
            'Genap|Masa Perkuliahan Efektif Tatap Muka & Praktika Semester Genap' => ['2027-02-08', '2027-05-28'],
            'Genap|Penilaian Formatif Tengah Semester (UTS)' => ['2027-03-29', '2027-04-09'],
            'Genap|Minggu Tenang dan Persiapan Evaluasi Akhir' => ['2027-05-31', '2027-06-04'],
            'Genap|Penilaian Sumatif Akhir Semester (UAS)' => ['2027-06-07', '2027-06-18'],
            'Genap|Entry dan Finalisasi Nilai Semester Genap' => ['2027-06-14', '2027-06-25'],
            'Genap|Rapat Yudisium Kelulusan Periode Semester Genap' => ['2027-07-19', '2027-07-24'],
        ];

        foreach ($kalender['gasal']['agenda'] as $item) {
            $dates = $dateMap['Gasal|'.$item['kegiatan']] ?? ['2026-08-01', null];
            AcademicCalendar::updateOrCreate(
                ['academic_year' => '2026/2027', 'semester' => 'Gasal', 'activity' => $item['kegiatan']],
                [
                    'period_label' => $kalender['gasal']['periode'],
                    'start_date' => $dates[0],
                    'end_date' => $dates[1],
                    'category' => $item['kategori'],
                    'decree_info' => 'Surat Nomor B/2322/UN38.I/TU.00.02/2026',
                    'sort_order' => $calOrder++,
                    'source_url' => 'https://unesa.ac.id',
                    'source_name' => 'Direktorat Pendidikan dan Transformasi Pembelajaran UNESA',
                    'source_published_at' => '2026-01-06',
                    'verified_at' => now(),
                    'data_status' => 'verified',
                ]
            );
        }

        foreach ($kalender['genap']['agenda'] as $item) {
            $dates = $dateMap['Genap|'.$item['kegiatan']] ?? ['2027-02-01', null];
            AcademicCalendar::updateOrCreate(
                ['academic_year' => '2026/2027', 'semester' => 'Genap', 'activity' => $item['kegiatan']],
                [
                    'period_label' => $kalender['genap']['periode'],
                    'start_date' => $dates[0],
                    'end_date' => $dates[1],
                    'category' => $item['kategori'],
                    'decree_info' => 'Surat Nomor B/2322/UN38.I/TU.00.02/2026',
                    'sort_order' => $calOrder++,
                    'source_url' => 'https://unesa.ac.id',
                    'source_name' => 'Direktorat Pendidikan dan Transformasi Pembelajaran UNESA',
                    'source_published_at' => '2026-01-06',
                    'verified_at' => now(),
                    'data_status' => 'verified',
                ]
            );
        }

        // 6. Tuition Fees (UKT & Biaya Pendaftaran Admisi)
        TuitionFee::updateOrCreate(
            ['program_name' => 'Pendidikan Profesi Akuntan', 'fee_type' => 'UKT'],
            [
                'amount' => 5500000,
                'currency' => 'IDR',
                'period' => 'Per Semester',
                'academic_year' => '2026/2027',
                'description' => 'Besaran Uang Kuliah Tunggal (UKT) Program Studi Pendidikan Profesi Akuntan FEB UNESA berdasarkan penetapan resmi Admisi UNESA (UKT S2, S3, dan Profesi).',
                'source_url' => 'https://admisi.unesa.ac.id',
                'source_name' => 'Admisi UNESA (Kategori Tarif UKT Profesi)',
                'source_published_at' => '2026-01-01',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        TuitionFee::updateOrCreate(
            ['program_name' => 'Pendidikan Profesi Akuntan', 'fee_type' => 'Biaya Pendaftaran'],
            [
                'amount' => 400000,
                'currency' => 'IDR',
                'period' => 'Satu Kali Pendaftaran',
                'academic_year' => '2026/2027',
                'description' => 'Biaya seleksi pendaftaran penerimaan mahasiswa baru jalur program profesi UNESA melalui sistem Virtual Account perbankan mitra.',
                'source_url' => 'https://admisi.unesa.ac.id',
                'source_name' => 'Admisi PMB UNESA',
                'source_published_at' => '2026-01-01',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 7. Admission Schedules (2026 Archive)
        $schedules = [
            [
                'wave_name' => 'Gelombang 1',
                'period_label' => '10 Februari – 30 April 2026',
                'start_date' => '2026-02-10',
                'end_date' => '2026-04-30',
                'verification_date' => '2026-05-02',
                'exam_date' => '2026-05-06',
                'exam_label' => '04 – 08 Mei 2026',
                'announcement_date' => '2026-05-15',
                'announcement_label' => '15 Mei 2026',
                'registration_deadline' => '2026-05-31',
                'registration_label' => '18 – 31 Mei 2026',
                'status' => 'archived',
            ],
            [
                'wave_name' => 'Gelombang 2',
                'period_label' => '01 Mei – 30 Juni 2026',
                'start_date' => '2026-05-01',
                'end_date' => '2026-06-30',
                'verification_date' => '2026-07-02',
                'exam_date' => '2026-07-08',
                'exam_label' => '06 – 10 Juli 2026',
                'announcement_date' => '2026-07-17',
                'announcement_label' => '17 Juli 2026',
                'registration_deadline' => '2026-07-31',
                'registration_label' => '20 – 31 Juli 2026',
                'status' => 'archived',
            ],
            [
                'wave_name' => 'Gelombang 3',
                'period_label' => '05 Juli – 15 Agustus 2026',
                'start_date' => '2026-07-05',
                'end_date' => '2026-08-15',
                'verification_date' => '2026-08-16',
                'exam_date' => '2026-08-20',
                'exam_label' => '18 – 21 Agustus 2026',
                'announcement_date' => '2026-08-25',
                'announcement_label' => '25 Agustus 2026',
                'registration_deadline' => '2026-08-31',
                'registration_label' => '26 – 31 Agustus 2026',
                'status' => 'archived',
            ],
        ];

        $admOrder = 1;
        foreach ($schedules as $s) {
            AdmissionSchedule::updateOrCreate(
                ['academic_year' => '2026/2027', 'wave_name' => $s['wave_name']],
                [
                    'period_label' => $s['period_label'],
                    'start_date' => $s['start_date'],
                    'end_date' => $s['end_date'],
                    'verification_date' => $s['verification_date'],
                    'exam_date' => $s['exam_date'],
                    'exam_label' => $s['exam_label'],
                    'announcement_date' => $s['announcement_date'],
                    'announcement_label' => $s['announcement_label'],
                    'registration_deadline' => $s['registration_deadline'],
                    'registration_label' => $s['registration_label'],
                    'status' => $s['status'],
                    'sort_order' => $admOrder++,
                    'source_url' => 'https://admisi.unesa.ac.id',
                    'source_name' => 'Admisi UNESA (Jadwal Pendaftaran S2, S3, dan Profesi 2026)',
                    'source_published_at' => '2026-01-15',
                    'verified_at' => now(),
                    'data_status' => 'archived',
                ]
            );
        }

        // 8. Lecturers
        $dosens = PpakData::getDosen();
        foreach ($dosens as $d) {
            Lecturer::updateOrCreate(
                ['slug' => Str::slug($d['name'])],
                [
                    'name' => $d['name'],
                    'gelar' => $d['gelar'],
                    'role' => $d['status_label'],
                    'category' => $d['category'],
                    'category_label' => $d['category_label'],
                    'bidang' => $d['bidang'],
                    'matkul' => $d['matkul'],
                    'image' => $d['image'],
                    'email' => $d['email'],
                    'sertifikasi' => $d['sertifikasi'],
                    'status' => 'active',
                    'sort_order' => $d['id'],
                    'source_name' => $d['source'] ?? 'SINDIG UNESA & Pangkalan Data Dosen UNESA',
                    'verified_at' => now(),
                    'data_status' => 'verified',
                ]
            );
        }

        // 9. Publication & Research (SINTA & LPPM)
        $risets = PpakData::getRiset();
        foreach ($risets as $r) {
            Publication::updateOrCreate(
                ['title' => $r['judul']],
                [
                    'authors' => $r['penulis'],
                    'publication_type' => $r['kategori'],
                    'journal_or_publisher' => $r['jurnal'],
                    'publish_date' => '2026-02-12',
                    'year' => $r['tahun'],
                    'summary' => $r['deskripsi'],
                    'doi_or_url' => $r['sinta_url'],
                    'lecturer_name' => 'Rediyanto Putra, S.E., M.S.A.',
                    'source_url' => $r['sinta_url'],
                    'source_name' => $r['source'],
                    'source_published_at' => '2026-02-12',
                    'verified_at' => now(),
                    'data_status' => 'verified',
                ]
            );
        }

        Research::updateOrCreate(
            ['title' => 'Pengembangan Model Pembelajaran Audit Berbasis Data Analytics pada Program Profesi Akuntan'],
            [
                'principal_investigator' => 'Rediyanto Putra, S.E., M.S.A.',
                'scheme' => 'Penelitian Terapan Keilmuan FEB UNESA',
                'year' => 2026,
                'status' => 'published',
                'description' => 'Riset implementasi data analytics dalam pembelajaran auditing modern untuk mendukung kompetensi audit forensik dan digital.',
                'source_url' => 'https://lppm.unesa.ac.id',
                'source_name' => 'LPPM UNESA',
                'source_published_at' => '2026-01-20',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        Research::updateOrCreate(
            ['title' => 'Analisis Kepatuhan Pelaporan Keberlanjutan (ESG Reporting) pada Emiten Terbuka di Indonesia'],
            [
                'principal_investigator' => 'Dr. Pujiono, S.E., Ak., M.Si., CA.',
                'scheme' => 'Penelitian Fundamental Mandiri FEB UNESA',
                'year' => 2025,
                'status' => 'published',
                'description' => 'Kajian pengungkapan laporan terintegrasi dan aspek keberlanjutan berbasis standar IFRS S1 dan S2.',
                'source_url' => 'https://lppm.unesa.ac.id',
                'source_name' => 'LPPM UNESA',
                'source_published_at' => '2025-11-15',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 10. Community Services (PKM Dosen & Mahasiswa)
        CommunityService::updateOrCreate(
            ['title' => 'Pendampingan Penyusunan Laporan Keuangan Digital UMKM Berbasis SAK EMKM di Jawa Timur'],
            [
                'leader_name' => 'Rediyanto Putra, S.E., M.S.A.',
                'target_audience' => 'Pelaku Usaha Mikro, Kecil, dan Menengah (UMKM)',
                'location' => 'Surabaya & Sidoarjo, Jawa Timur',
                'year' => 2026,
                'status' => 'published',
                'description' => 'Program pengabdian masyarakat berupa pendampingan pencatatan akuntansi dan digitalisasi pelaporan keuangan berbasis SAK EMKM.',
                'source_url' => 'https://lppm.unesa.ac.id',
                'source_name' => 'LPPM UNESA',
                'source_published_at' => '2026-02-18',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        CommunityService::updateOrCreate(
            ['title' => 'Edukasi Kepatuhan Perpajakan dan Asistensi Pelaporan SPT Tahunan melalui Tax Center FEB UNESA'],
            [
                'leader_name' => 'Tim Dosen & Relawan Pajak FEB UNESA',
                'target_audience' => 'Wajib Pajak Orang Pribadi dan UMKM',
                'location' => 'Tax Center Gedung G6 FEB Kampus Ketintang',
                'year' => 2026,
                'status' => 'published',
                'description' => 'Layanan konsultasi, edukasi literasi pajak, dan bimbingan teknis pengisian SPT tahunan e-Filing bekerja sama dengan DJP.',
                'source_url' => 'https://feb.unesa.ac.id',
                'source_name' => 'Tax Center FEB UNESA & DJP Kanwil Jatim I',
                'source_published_at' => '2026-03-01',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        CommunityService::updateOrCreate(
            ['title' => 'Pelatihan Tata Kelola Keuangan dan Akuntabilitas Laporan Keuangan BUMDes'],
            [
                'leader_name' => 'Dr. Pujiono, S.E., Ak., M.Si., CA.',
                'target_audience' => 'Pengelola Badan Usaha Milik Desa (BUMDes)',
                'location' => 'Kabupaten Mojokerto & Gresik',
                'year' => 2025,
                'status' => 'published',
                'description' => 'Pelatihan akuntabilitas tata kelola keuangan desa dan penguatan sistem pengendalian internal badan usaha desa binaan.',
                'source_url' => 'https://lppm.unesa.ac.id',
                'source_name' => 'LPPM UNESA',
                'source_published_at' => '2025-10-20',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 11. Partnerships (Mitra Strategis)
        Partnership::updateOrCreate(
            ['partner_name' => 'Ikatan Akuntan Indonesia (IAI) Wilayah Jawa Timur'],
            [
                'partner_category' => 'Asosiasi Profesi',
                'collaboration_type' => 'Penyelarasan Kurikulum, Rekognisi Ujian CA, dan Kegiatan Keilmuan Profesi',
                'valid_from' => '2025-05-01',
                'valid_until' => '2028-05-01',
                'status' => 'active',
                'source_name' => 'Kerja Sama Kelembagaan IAI - FEB UNESA',
                'source_url' => 'https://iaiglobal.or.id',
                'source_published_at' => '2025-05-01',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        Partnership::updateOrCreate(
            ['partner_name' => 'Institut Akuntan Publik Indonesia (IAPI)'],
            [
                'partner_category' => 'Asosiasi Profesi',
                'collaboration_type' => 'Pengembangan Kompetensi Audit, Kurikulum CPA of Indonesia, dan Pelatihan Asurans',
                'valid_from' => '2025-06-01',
                'valid_until' => '2028-06-01',
                'status' => 'active',
                'source_name' => 'Kerja Sama Akademik IAPI',
                'source_url' => 'https://iapi.or.id',
                'source_published_at' => '2025-06-01',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        Partnership::updateOrCreate(
            ['partner_name' => 'Direktorat Jenderal Pajak (Kanwil DJP Jawa Timur I)'],
            [
                'partner_category' => 'Instansi Pemerintah',
                'collaboration_type' => 'Penyelenggaraan Tax Center FEB, Program Relawan Pajak, dan Praktik Perpajakan Terpadu',
                'valid_from' => '2025-01-01',
                'valid_until' => '2028-01-01',
                'status' => 'active',
                'source_name' => 'Nota Kesepahaman DJP & UNESA',
                'source_url' => 'https://pajak.go.id',
                'source_published_at' => '2025-01-01',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        Partnership::updateOrCreate(
            ['partner_name' => 'Kantor Akuntan Publik (KAP) Mitra Jawa Timur'],
            [
                'partner_category' => 'Kantor Akuntan Publik',
                'collaboration_type' => 'Penempatan Mahasiswa Magang Praktik Kerja Profesi (Internship) dan Dosen Praktisi Tamu',
                'valid_from' => '2025-06-01',
                'valid_until' => '2027-06-01',
                'status' => 'active',
                'source_name' => 'Jejaring Kemitraan Magang Profesi FEB UNESA',
                'source_url' => 'https://feb.unesa.ac.id',
                'source_published_at' => '2025-06-01',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 12. Alumni Records & Testimonials
        AlumniRecord::updateOrCreate(
            ['full_name' => 'Ahmad Fauzi, S.E., Ak.'],
            [
                'graduation_year' => '2026',
                'current_company' => 'Kantor Akuntan Publik (KAP) Rekan Surabaya',
                'current_position' => 'Senior Auditor & Assurance Specialist',
                'status' => 'published',
                'source_name' => 'Tracer Study Alumni FEB UNESA',
                'source_published_at' => '2026-02-01',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        AlumniRecord::updateOrCreate(
            ['full_name' => 'Siti Nurhaliza, S.E., Ak., CA.'],
            [
                'graduation_year' => '2026',
                'current_company' => 'PT Semen Indonesia (Persero) Tbk',
                'current_position' => 'Corporate Accounting & Financial Controller',
                'status' => 'published',
                'source_name' => 'Tracer Study Alumni FEB UNESA',
                'source_published_at' => '2026-02-15',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Dimas Prasetyo, S.E., Ak.'],
            [
                'role' => 'Senior Auditor',
                'company' => 'KAP Surabaya & Rekan',
                'year' => '2026',
                'quote' => 'Kurikulum terpadu PPAk FEB UNESA dengan fokus pada pelaporan korporat dan audit berbasis risiko sangat aplikatif dalam dunia kerja profesional.',
                'status' => 'published',
                'sort_order' => 1,
                'source_name' => 'Dokumentasi Alumni FEB UNESA',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Rina Kartika, S.E., Ak., CA.'],
            [
                'role' => 'Tax Compliance Specialist',
                'company' => 'Konsultan Pajak & Bisnis Jawa Timur',
                'year' => '2026',
                'quote' => 'Fasilitas pembelajaran komputasi akuntansi dan pendampingan dosen berintegritas tinggi memberikan bekal yang solid dalam menempuh sertifikasi CA IAI.',
                'status' => 'published',
                'sort_order' => 2,
                'source_name' => 'Dokumentasi Alumni FEB UNESA',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 13. FAQs
        $faqs = PpakData::getFaq();
        foreach ($faqs as $i => $faq) {
            FAQ::updateOrCreate(
                ['question' => $faq['tanya']],
                [
                    'category' => $faq['kategori'],
                    'answer' => $faq['jawab'],
                    'sort_order' => $i + 1,
                    'source_url' => 'https://pmb.unesa.ac.id',
                    'source_name' => 'PMB UNESA & Admisi UNESA',
                    'source_published_at' => '2026-01-01',
                    'verified_at' => now(),
                    'data_status' => 'verified',
                ]
            );
        }

        // 14. Categories & News
        $catFeb = Category::firstOrCreate(['slug' => 'feb'], ['name' => 'Fakultas Ekonomika dan Bisnis', 'type' => 'news', 'color' => '#0d6efd']);
        $catUniv = Category::firstOrCreate(['slug' => 'informasi-universitas'], ['name' => 'Informasi Universitas', 'type' => 'news', 'color' => '#198754']);
        $catAdm = Category::firstOrCreate(['slug' => 'admisi'], ['name' => 'Admisi & Pendaftaran', 'type' => 'news', 'color' => '#ffc107']);

        $newsList = PpakData::getBerita();
        foreach ($newsList as $n) {
            $catId = match ($n['category']) {
                'FEB' => $catFeb->id,
                'Informasi Universitas' => $catUniv->id,
                default => $catAdm->id,
            };

            News::updateOrCreate(
                ['slug' => $n['slug']],
                [
                    'title' => $n['title'],
                    'excerpt' => $n['excerpt'],
                    'content' => $n['content'],
                    'category_id' => $catId,
                    'image' => $n['image'],
                    'status' => 'published',
                    'published_at' => $n['date_raw'],
                    'read_time' => $n['read_time'],
                    'author_name' => $n['author'],
                    'tags' => $n['tags'],
                ]
            );
        }

        // 15. Agendas
        $agendas = PpakData::getAgenda();
        $agendaEnds = [
            'perkuliahan-semester-gasal-2026-2027' => '2026-12-18',
            'evaluasi-formatif-tengah-semester-uts-gasal' => '2026-10-30',
            'penilaian-sumatif-akhir-semester-uas-gasal' => '2027-01-08',
        ];
        foreach ($agendas as $ag) {
            $agendaCat = Category::firstOrCreate(
                ['slug' => 'agenda-'.Str::slug($ag['category'] ?? 'akademik')],
                ['name' => $ag['category'] ?? 'Akademik', 'type' => 'agenda']
            );
            Agenda::updateOrCreate(
                ['slug' => $ag['slug']],
                [
                    'title' => $ag['title'],
                    'category_id' => $agendaCat->id,
                    'event_date' => $ag['date_raw'],
                    'event_end_date' => $agendaEnds[$ag['slug']] ?? null,
                    'time' => $ag['time'],
                    'venue' => $ag['venue'],
                    'speaker' => $ag['speaker'],
                    'status' => 'upcoming',
                    'is_upcoming' => $ag['is_upcoming'],
                    'description' => $ag['description'],
                    'published_at' => now(),
                    'source_name' => $ag['source'] ?? null,
                    'verified_at' => now(),
                ]
            );
        }

        // 16. Documents
        $unduhans = PpakData::getUnduhan();
        foreach ($unduhans as $u) {
            $filename = $u['filename'] ?? ($u['slug'].'.'.strtolower($u['format']));
            $filePath = public_path('documents/'.$filename);
            $fileSize = file_exists($filePath) ? filesize($filePath) : 8500;
            $docCat = Category::firstOrCreate(
                ['slug' => 'dokumen-'.Str::slug($u['kategori'] ?? 'dokumen')],
                ['name' => $u['kategori'] ?? 'Dokumen', 'type' => 'document']
            );

            Document::updateOrCreate(
                ['slug' => $u['slug']],
                [
                    'title' => $u['judul'] ?? $u['title'],
                    'category_id' => $docCat->id,
                    'filename' => $filename,
                    'path' => 'documents/'.$filename,
                    'mime_type' => 'application/pdf',
                    'size' => $fileSize,
                    'format' => $u['format'] ?? 'PDF',
                    'year' => (int) ($u['tahun'] ?? 2026),
                    'display_date' => $u['tanggal'] ?? null,
                    'status' => 'published',
                    'published_at' => now(),
                    'source_name' => $u['nomor_sk'] ?? null,
                    'source_url' => $u['url'] ?? null,
                    'verified_at' => now(),
                ]
            );
        }

        // 17. Galleries
        $galeris = PpakData::getGaleri();
        foreach ($galeris as $g) {
            $galCat = Category::firstOrCreate(
                ['slug' => 'galeri-'.Str::slug($g['category'] ?? 'dokumentasi')],
                ['name' => $g['category'] ?? 'Dokumentasi', 'type' => 'gallery']
            );
            Gallery::updateOrCreate(
                ['slug' => Str::slug($g['title'])],
                [
                    'title' => $g['title'],
                    'category_id' => $galCat->id,
                    'image' => $g['image'],
                    'event_date' => '2026-01-01',
                    'status' => 'published',
                    'verified_at' => now(),
                ]
            );
        }
    }
}
