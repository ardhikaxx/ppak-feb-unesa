<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Konten section halaman statis (sejarah, visi-misi, struktur, gelar,
     * mahasiswa) agar dapat dikelola admin tanpa mengubah desain.
     * Data bawaan = salinan persis tampilan saat ini (idempotent).
     */
    public function up(): void
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page', 50)->index();
            $table->string('section_key', 100);
            $table->string('heading')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('body')->nullable();
            $table->string('link_url', 500)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('status', 20)->default('published')->index();
            $table->timestamps();

            $table->unique(['page', 'section_key']);
        });

        foreach ($this->defaults() as $row) {
            $exists = DB::table('page_contents')
                ->where('page', $row['page'])
                ->where('section_key', $row['section_key'])
                ->exists();

            if (! $exists) {
                DB::table('page_contents')->insert(array_merge($row, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }

    private function defaults(): array
    {
        $c = fn (string $page, string $key, ?string $heading = null, ?string $body = null, ?string $subtitle = null, int $sort = 0) => [
            'page' => $page, 'section_key' => $key, 'heading' => $heading,
            'subtitle' => $subtitle, 'body' => $body, 'link_url' => null,
            'sort_order' => $sort, 'status' => 'published',
        ];

        return [
            // ---------------- SEJARAH ----------------
            $c('sejarah', 'narasi_heading', 'Pengembangan Program Pendidikan Profesi di FEB UNESA'),
            $c('sejarah', 'narasi_body', null, '<p class="lead text-dark">Program Studi Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya tercatat resmi berdiri pada tanggal <strong>23 Mei 2025</strong> dengan kode program studi <strong>62902</strong>.</p><p>Pendirian program studi ini merupakan bagian integral dari implementasi dokumen rencana strategis Fakultas Ekonomika dan Bisnis (FEB) UNESA dalam memperluas cakupan layanan pendidikan tinggi, khususnya pada jenjang pendidikan keprofesian akuntansi setelah jenjang sarjana.</p><p>Sebagai institusi yang memiliki tradisi akademik di bidang ilmu ekonomi, manajemen, dan akuntansi, FEB UNESA mengembangkan program Pendidikan Profesi Akuntan untuk menjembatani kompetensi lulusan sarjana akuntansi dengan tuntutan standar kompetensi kerja profesional di bidang pelaporan keuangan, audit dan asurans, perpajakan, serta tata kelola korporat.</p>'),
            $c('sejarah', 'legal_heading', 'Legalitas & Akreditasi Program'),
            $c('sejarah', 'legal_body', null, '<p class="small text-secondary mb-2">Pendidikan Profesi Akuntan FEB UNESA telah memperoleh status akreditasi <strong>Baik</strong> dari Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi (LAMEMBA) berdasarkan Keputusan No. <strong>611/DE/A.5/AR.11/II/2025</strong> tanggal 26 Februari 2025 dengan masa berlaku hingga 25 Februari 2027.</p>'),
            $c('sejarah', 'legal_source', null, '<i class="fa-solid fa-link me-1"></i> Sumber: SIMUTU UNESA & SINDIG UNESA (Kode Prodi: 62902)'),
            $c('sejarah', 'fokus_heading', 'Fokus Penyelenggaraan Pembelajaran'),
            $c('sejarah', 'fokus_body', null, '<p>Penyelenggaraan program studi diarahkan pada pemenuhan Capaian Pembelajaran Lulusan (CPL) yang mencakup integritas etika akademik, karakter tangguh dan kolaboratif, pemikiran logis dan kritis sesuai standar kerja, serta kemampuan pengembangan diri berkelanjutan dalam ekosistem profesi akuntan.</p>'),

            // ---------------- VISI-MISI ----------------
            $c('visi-misi', 'notice_heading', 'Informasi Visi, Misi, dan Tujuan Program Sedang Diperbarui'),
            $c('visi-misi', 'notice_body', null, '<p class="text-secondary mb-3" style="line-height: 1.7;">Berdasarkan pangkalan data SINDIG UNESA, naskah rumusan definitif visi, misi, dan tujuan spesifik Program Studi Pendidikan Profesi Akuntan (Kode Prodi: <strong>62902</strong>) saat ini berada dalam tahapan finalisasi penjaminan mutu kelembagaan seiring proses penguatan tata kelola program profesi baru yang tercatat berdiri pada <strong>23 Mei 2025</strong>.</p>'),
            $c('visi-misi', 'policy_heading', 'Kebijakan Transparansi Informasi Akademik:'),
            $c('visi-misi', 'policy_body', null, '<div class="small text-secondary">Program studi berkomitmen menyajikan informasi faktual yang bersumber langsung dari dokumen resmi kelembagaan PPAk FEB UNESA dan tidak menduplikasi visi-misi program studi sarjana maupun magister lainnya.</div>'),
            $c('visi-misi', 'pilar_1_heading', 'Pilar Kurikulum SINDIG'),
            $c('visi-misi', 'pilar_1_body', null, '<p class="small text-secondary mb-0">Penyelenggaraan akademik berpedoman pada kurikulum 11 mata kuliah terpadu dan paket magang industri yang telah tercatat resmi pada sistem SINDIG UNESA.</p>'),
            $c('visi-misi', 'pilar_2_heading', 'Akreditasi LAMEMBA'),
            $c('visi-misi', 'pilar_2_body', null, '<p class="small text-secondary mb-0">Telah memperoleh status akreditasi <strong>Baik</strong> berdasarkan Keputusan LAMEMBA No. 611/DE/A.5/AR.11/II/2025 dengan masa berlaku 2025–2027.</p>'),
            $c('visi-misi', 'pilar_3_heading', 'Standar Profesi IAI & IAPI'),
            $c('visi-misi', 'pilar_3_body', null, '<p class="small text-secondary mb-0">Pembelajaran diarahkan pada pencapaian kompetensi standar keprofesian akuntan (Chartered Accountant & Certified Public Accountant of Indonesia).</p>'),
            $c('visi-misi', 'cta_heading', 'Informasi Lebih Lanjut Mengenai Dokumen Akademik'),
            $c('visi-misi', 'cta_body', null, '<p class="small text-secondary mb-3">Untuk permintaan salinan naskah akademik atau konsultasi program, silakan menghubungi sekretariat program studi.</p>'),

            // ---------------- STRUKTUR ORGANISASI ----------------
            $c('struktur-organisasi', 'intro_heading', 'Struktur Organisasi & Kepemimpinan'),
            $c('struktur-organisasi', 'intro_body', null, '<p class="text-secondary">Hubungan kelembagaan Program Studi Pendidikan Profesi Akuntan dalam struktur tata kelola Universitas Negeri Surabaya dan Fakultas Ekonomika dan Bisnis.</p>'),
            $c('struktur-organisasi', 'org_1_role', 'Tingkat Universitas'),
            $c('struktur-organisasi', 'org_1_name', 'Universitas Negeri Surabaya'),
            $c('struktur-organisasi', 'org_1_sub', null, 'Perguruan Tinggi Negeri Badan Hukum (PTN-BH)'),
            $c('struktur-organisasi', 'org_2_role', 'Tingkat Fakultas'),
            $c('struktur-organisasi', 'org_2_name', 'Fakultas Ekonomika dan Bisnis (FEB)'),
            $c('struktur-organisasi', 'org_2_sub', null, 'Dekan, Wakil Dekan, Senat Fakultas & Kantor Tata Usaha'),
            $c('struktur-organisasi', 'org_3_role', 'Tingkat Program Studi'),
            $c('struktur-organisasi', 'org_3_name', 'Pendidikan Profesi Akuntan (PPAk)'),
            $c('struktur-organisasi', 'org_4_role', 'Koordinator Program Studi'),
            $c('struktur-organisasi', 'org_4_sub', null, 'Koordinator Program Studi Pendidikan Profesi Akuntan'),
            $c('struktur-organisasi', 'kartu_1_heading', 'Pimpinan Fakultas'),
            $c('struktur-organisasi', 'kartu_1_body', null, '<p class="small text-secondary mb-0">Tata kelola fakultas dipimpin oleh Dekan bersama para Wakil Dekan bidang akademik, keuangan & sumber daya, serta kemahasiswaan dan alumni yang menetapkan kebijakan strategis bagi seluruh program studi di FEB UNESA.</p>'),
            $c('struktur-organisasi', 'kartu_2_heading', 'Koordinasi Program Studi'),
            $c('struktur-organisasi', 'kartu_2_body', null, '<p class="small text-secondary mb-0">Penyelenggaraan operasional kurikulum, penugasan dosen pengampu, evaluasi proses pembelajaran, dan layanan mahasiswa dikoordinasikan secara langsung oleh Koordinator Program Studi.</p>'),
            $c('struktur-organisasi', 'kartu_3_heading', 'Laboratorium & Layanan Terpadu'),
            $c('struktur-organisasi', 'kartu_3_body', null, '<p class="small text-secondary mb-0">Didukung oleh fasilitas Laboratorium Akuntansi Komputer FEB UNESA, sarana perpustakaan fakultas, serta unit tata usaha FEB untuk administrasi persuratan dan bantuan teknis perkuliahan.</p>'),

            // ---------------- GELAR & SERTIFIKASI ----------------
            $c('gelar-sertifikasi', 'hero_heading', 'Pendidikan Profesi & Hubungannya dengan Sertifikasi'),
            $c('gelar-sertifikasi', 'hero_lead', null, '<p class="lead text-dark mb-3">Program Studi Pendidikan Profesi Akuntan (PPAk) FEB UNESA menyelenggarakan pendidikan profesi untuk membentuk lulusan yang menguasai kompetensi teoritis dan aplikatif di bidang akuntansi profesional.</p>'),
            $c('gelar-sertifikasi', 'hero_sub', null, '<p class="text-secondary small mb-0">Pendidikan profesi merupakan tahapan akademik pascasarjana, sedangkan sebutan profesi dan sertifikasi keprofesian diselenggarakan oleh organisasi profesi resmi (IAI dan IAPI) yang memiliki regulasi, kurikulum ujian, dan persyaratan tersendiri.</p>'),
            $c('gelar-sertifikasi', 'alur_heading', 'Alur Pendidikan Menuju Sertifikasi & Registrasi Profesi'),
            $c('gelar-sertifikasi', 'alur_body', null, '<p class="small text-secondary mb-0">Proses terstruktur dari penuntasan beban studi pendidikan profesi hingga keikutsertaan dalam ujian sertifikasi profesi masing-masing lembaga.</p>'),
            $c('gelar-sertifikasi', 'tahap_1_heading', 'Pendidikan PPAk UNESA'),
            $c('gelar-sertifikasi', 'tahap_1_body', null, '<p class="small text-secondary mb-0">Menempuh pembelajaran komprehensif 11 mata kuliah terpadu dan paket magang industri sesuai kurikulum SINDIG UNESA.</p>'),
            $c('gelar-sertifikasi', 'tahap_2_heading', 'Kelulusan Pendidikan Profesi'),
            $c('gelar-sertifikasi', 'tahap_2_body', null, '<p class="small text-secondary mb-0">Lulus dari program studi, memperoleh ijazah profesi, serta menyelesaikan seluruh persyaratan akademik dan praktika.</p>'),
            $c('gelar-sertifikasi', 'tahap_3_heading', 'Jalur Sertifikasi / Registrasi'),
            $c('gelar-sertifikasi', 'tahap_3_body', null, '<p class="small text-secondary mb-0">Mengikuti ujian sertifikasi profesi (CA oleh IAI atau CPA of Indonesia oleh IAPI) serta registrasi sesuai persyaratan masing-masing lembaga.</p>'),
            $c('gelar-sertifikasi', 'ca_heading', 'Chartered Accountant (CA) Indonesia'),
            $c('gelar-sertifikasi', 'ca_body', null, '<p class="small text-secondary mb-3" style="line-height: 1.65;">Chartered Accountant (CA) Indonesia merupakan sebutan profesi akuntan yang ditetapkan oleh <strong>Ikatan Akuntan Indonesia (IAI)</strong> untuk akuntan profesional yang memenuhi standar kompetensi internasional.</p>'),
            $c('gelar-sertifikasi', 'ca_ketentuan', null, '<ul class="list-unstyled small text-secondary mb-0"><li class="d-flex align-items-start gap-2 mb-2"><i class="fa-solid fa-circle-check text-primary mt-1" style="font-size: 0.5rem;"></i><span>Mahasiswa PPAk mengikuti Ujian Sertifikasi Akuntan Profesional yang diselenggarakan oleh IAI.</span></li><li class="d-flex align-items-start gap-2 mb-2"><i class="fa-solid fa-circle-check text-primary mt-1" style="font-size: 0.5rem;"></i><span>Pemberian sebutan CA memiliki persyaratan ujian, pengalaman kerja di bidang akuntansi, dan keanggotaan IAI tersendiri.</span></li><li class="d-flex align-items-start gap-2"><i class="fa-solid fa-circle-check text-primary mt-1" style="font-size: 0.5rem;"></i><span>Kelulusan PPAk menjadi fondasi akademik yang relevan untuk menempuh tahapan sertifikasi CA.</span></li></ul>'),
            $c('gelar-sertifikasi', 'cpa_heading', 'Certified Public Accountant (CPA) of Indonesia'),
            $c('gelar-sertifikasi', 'cpa_body', null, '<p class="small text-secondary mb-3" style="line-height: 1.65;">Certified Public Accountant (CPA) of Indonesia merupakan sertifikasi kompetensi yang diselenggarakan oleh <strong>Institut Akuntan Publik Indonesia (IAPI)</strong> melalui CPA of Indonesia Exam.</p>'),
            $c('gelar-sertifikasi', 'cpa_ketentuan', null, '<ul class="list-unstyled small text-secondary mb-0"><li class="d-flex align-items-start gap-2 mb-2"><i class="fa-solid fa-circle-check text-warning mt-1" style="font-size: 0.5rem;"></i><span>Sertifikasi CPA ditempuh melalui CPA of Indonesia Exam dengan tahapan ujian tingkat dasar, profesional, dan lanjutan.</span></li><li class="d-flex align-items-start gap-2 mb-2"><i class="fa-solid fa-circle-check text-warning mt-1" style="font-size: 0.5rem;"></i><span>Izin praktik sebagai Akuntan Publik (AP) memiliki persyaratan tambahan berupa pengalaman praktik audit dan izin dari Kementerian Keuangan RI.</span></li><li class="d-flex align-items-start gap-2"><i class="fa-solid fa-circle-check text-warning mt-1" style="font-size: 0.5rem;"></i><span>Lulusan PPAk menempuh tahapan sertifikasi sesuai regulasi yang berlaku pada IAPI.</span></li></ul>'),
            ['page' => 'gelar-sertifikasi', 'section_key' => 'ca_link', 'heading' => null, 'subtitle' => null, 'body' => null, 'link_url' => 'https://iaiglobal.or.id', 'sort_order' => 0, 'status' => 'published'],
            ['page' => 'gelar-sertifikasi', 'section_key' => 'cpa_link', 'heading' => null, 'subtitle' => null, 'body' => null, 'link_url' => 'https://iapi.or.id', 'sort_order' => 0, 'status' => 'published'],

            // ---------------- MAHASISWA ----------------
            $c('mahasiswa', 'intro_heading', 'Aktivitas Pembelajaran Pendidikan Profesi'),
            $c('mahasiswa', 'intro_body', null, '<p class="text-secondary">Aktivitas perkuliahan dirancang komprehensif mengintegrasikan penguasaan teori lanjutan dan aplikasi praktik nyata di bidang akuntansi profesional.</p>'),
            $c('mahasiswa', 'aktivitas_1_heading', 'Perkuliahan Tatap Muka Terstruktur'),
            $c('mahasiswa', 'aktivitas_1_body', null, '<p class="small text-secondary mb-0">Pendalaman materi mata kuliah inti seperti Pelaporan Korporat, Audit dan Asurans, serta Manajemen Pajak dengan pendekatan studi kasus nyata.</p>'),
            $c('mahasiswa', 'aktivitas_2_heading', 'Magang Praktik Profesi (Internship)'),
            $c('mahasiswa', 'aktivitas_2_body', null, '<p class="small text-secondary mb-0">Pelaksanaan penugasan magang industri (4 SKS) pada kantor akuntan publik, divisi keuangan korporasi, atau konsultan perpajakan dengan bimbingan mentor.</p>'),
            $c('mahasiswa', 'aktivitas_3_heading', 'Praktika Laboratorium Akuntansi'),
            $c('mahasiswa', 'aktivitas_3_body', null, '<p class="small text-secondary mb-0">Simulasi pengolahan data transaksi keuangan, kertas kerja audit elektronik, serta analisis sistem informasi pengendalian internal berbasis komputer.</p>'),
            $c('mahasiswa', 'aktivitas_4_heading', 'Diskusi Standar & Regulasi Terkini'),
            $c('mahasiswa', 'aktivitas_4_body', null, '<p class="small text-secondary mb-0">Forum telaah implementasi Standar Akuntansi Keuangan (SAK), regulasi administrasi perpajakan, dan tata kelola risiko korporasi (GRC).</p>'),
            $c('mahasiswa', 'aktivitas_5_heading', 'Pembinaan Etika & Skeptisisme'),
            $c('mahasiswa', 'aktivitas_5_body', null, '<p class="small text-secondary mb-0">Penanaman integritas dan independensi akuntan dalam menghadapi dilema etika pelaporan keuangan dan penugasan perikatan asurans.</p>'),
            $c('mahasiswa', 'aktivitas_6_heading', 'Evaluasi Formatif & Sumatif'),
            $c('mahasiswa', 'aktivitas_6_body', null, '<p class="small text-secondary mb-0">Pengukuran capaian kompetensi secara berkala melalui ujian formatif (UTS) dan sumatif (UAS) sesuai Kalender Akademik UNESA 2026/2027.</p>'),
            $c('mahasiswa', 'fasilitas_heading', 'Fasilitas Pembelajaran Kampus Ketintang'),
            $c('mahasiswa', 'fasilitas_body', null, '<p class="text-secondary small mb-3">Aktivitas perkuliahan dipusatkan di Gedung G6 Fakultas Ekonomika dan Bisnis UNESA Kampus Ketintang Surabaya, didukung ruang kelas representatif, perpustakaan fakultas, dan Laboratorium Akuntansi Komputer Terpadu.</p>'),
        ];
    }
};
