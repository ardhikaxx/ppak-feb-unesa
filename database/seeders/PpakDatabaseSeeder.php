<?php

namespace Database\Seeders;

use App\Models\AcademicCalendar;
use App\Models\AcademicCurriculum;
use App\Models\Accreditation;
use App\Models\AdmissionSchedule;
use App\Models\Agenda;
use App\Models\Category;
use App\Models\Document;
use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\LearningOutcome;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\ProgramProfile;
use App\Models\Publication;
use App\Models\TuitionFee;
use App\Services\PpakData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PpakDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $info = PpakData::getGeneralInfo();

        // 1. Program Profile
        ProgramProfile::updateOrCreate(
            ['program_code' => '62902'],
            [
                'program_name' => $info['name'],
                'short_name' => $info['short_name'],
                'faculty' => $info['faculty'],
                'university' => $info['university'],
                'level' => $info['level'],
                'established_date' => '2025-05-23',
                'coordinator_name' => $info['coordinator'],
                'tagline' => $info['tagline'],
                'email' => $info['email'],
                'phone' => $info['phone'],
                'whatsapp' => $info['whatsapp'],
                'address' => $info['address'],
                'office_hours' => $info['office_hours'],
                'social_links' => $info['socials'],
                'source_url' => 'https://sindig.unesa.ac.id',
                'source_name' => 'SINDIG UNESA - Pendidikan Profesi Akuntan',
                'source_published_at' => '2025-05-23',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 2. Accreditation
        Accreditation::updateOrCreate(
            ['decree_number' => '611/DE/A.5/AR.11/II/2025'],
            [
                'program_name' => 'Pendidikan Profesi Akuntan',
                'agency' => 'LAMEMBA',
                'status' => 'Baik',
                'decree_date' => '2025-02-26',
                'effective_from' => '2025-02-26',
                'effective_until' => '2027-02-25',
                'source_url' => 'https://simutu.unesa.ac.id',
                'source_name' => 'SIMUTU UNESA - Data Akreditasi Nasional',
                'source_published_at' => '2025-02-26',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 3. Learning Outcomes (CPL)
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

        // 4. Academic Curricula
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

        // 5. Academic Calendars (2026/2027) - tanggal akurat sesuai SK resmi
        $kalender = PpakData::getKalender();
        $calOrder = 1;
        // Peta tanggal resmi per kegiatan (agar format tampilan frontend sama persis).
        // Kunci: semester|kegiatan, karena nama kegiatan Gasal & Genap bisa sama.
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
            $dates = $dateMap['Gasal|' . $item['kegiatan']] ?? ['2026-08-01', null];
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
            $dates = $dateMap['Genap|' . $item['kegiatan']] ?? ['2027-02-01', null];
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

        // 6. Tuition Fee
        TuitionFee::updateOrCreate(
            ['program_name' => 'Pendidikan Profesi Akuntan', 'fee_type' => 'UKT'],
            [
                'amount' => 5500000,
                'currency' => 'IDR',
                'period' => 'Per Semester',
                'academic_year' => '2026/2027',
                'description' => 'Besaran Uang Kuliah Tunggal (UKT) Program Studi Pendidikan Profesi Akuntan FEB UNESA berdasarkan ketetapan resmi Admisi UNESA.',
                'source_url' => 'https://admisi.unesa.ac.id',
                'source_name' => 'Admisi UNESA (UKT S2, S3, dan Profesi)',
                'source_published_at' => '2026-01-01',
                'verified_at' => now(),
                'data_status' => 'verified',
            ]
        );

        // 7. Admission Schedules (2026 Archive)
        $admisi = PpakData::getAdmisiInfo();
        $admOrder = 1;
        foreach ($admisi['jadwal_2026'] as $j) {
            AdmissionSchedule::updateOrCreate(
                ['academic_year' => '2026/2027', 'wave_name' => $j['gelombang']],
                [
                    'period_label' => $j['pendaftaran'],
                    'start_date' => '2026-02-10',
                    'end_date' => '2026-08-15',
                    'status' => 'archived',
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
                    'verified_at' => now(),
                ]
            );
        }

        // 9. Publication
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

        // 10. FAQs
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

        // 11. Categories & News
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
                    'read_time' => '3 Menit',
                    'tags' => $n['tags'],
                ]
            );
        }

        // 12. Agendas
        $agendas = PpakData::getAgenda();
        $agendaEnds = [
            'perkuliahan-semester-gasal-2026-2027' => '2026-12-18',
            'evaluasi-formatif-tengah-semester-uts-gasal' => '2026-10-30',
            'penilaian-sumatif-akhir-semester-uas-gasal' => '2027-01-08',
        ];
        foreach ($agendas as $ag) {
            Agenda::updateOrCreate(
                ['slug' => $ag['slug']],
                [
                    'title' => $ag['title'],
                    'event_date' => $ag['date_raw'],
                    'event_end_date' => $agendaEnds[$ag['slug']] ?? null,
                    'time' => $ag['time'],
                    'venue' => $ag['venue'],
                    'speaker' => $ag['speaker'],
                    'status' => 'upcoming',
                    'is_upcoming' => $ag['is_upcoming'],
                    'description' => $ag['description'],
                    'published_at' => now(),
                    'verified_at' => now(),
                ]
            );
        }

        // 13. Documents
        $unduhans = PpakData::getUnduhan();
        foreach ($unduhans as $u) {
            $filename = $u['filename'] ?? ($u['slug'] . '.' . strtolower($u['format']));
            $filePath = public_path('documents/' . $filename);
            $fileSize = file_exists($filePath) ? filesize($filePath) : 8500;

            Document::updateOrCreate(
                ['slug' => $u['slug']],
                [
                    'title' => $u['judul'] ?? $u['title'],
                    'filename' => $filename,
                    'path' => 'documents/' . $filename,
                    'mime_type' => 'application/pdf',
                    'size' => $fileSize,
                    'format' => $u['format'] ?? 'PDF',
                    'year' => (int) ($u['tahun'] ?? 2026),
                    'status' => 'published',
                    'published_at' => now(),
                    'verified_at' => now(),
                ]
            );
        }

        // 14. Galleries
        $galeris = PpakData::getGaleri();
        foreach ($galeris as $g) {
            Gallery::updateOrCreate(
                ['slug' => Str::slug($g['title'])],
                [
                    'title' => $g['title'],
                    'image' => $g['image'],
                    'event_date' => '2026-01-01',
                    'status' => 'published',
                    'verified_at' => now(),
                ]
            );
        }
    }
}
