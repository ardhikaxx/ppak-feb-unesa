<?php

namespace App\Services;

class PpakData
{
    /**
     * Data profil umum PPAk FEB UNESA
     */
    public static function getGeneralInfo(): array
    {
        return [
            'name' => 'Pendidikan Profesi Akuntansi',
            'short_name' => 'PPAk FEB UNESA',
            'faculty' => 'Fakultas Ekonomika dan Bisnis',
            'university' => 'Universitas Negeri Surabaya',
            'tagline' => 'Mencetak Akuntan Profesional, Berintegritas, dan Berdaya Saing Global',
            'email' => 'ppak.feb@unesa.ac.id',
            'phone' => '+62 31 828 0009',
            'whatsapp' => '+62 812 3456 7890',
            'address' => 'Gedung G6 FEB Kampus Ketintang, Jl. Ketintang, Surabaya, Jawa Timur 60231',
            'office_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'socials' => [
                'instagram' => 'https://instagram.com/unesa_official',
                'youtube' => 'https://youtube.com/@unesaofficial',
                'facebook' => 'https://facebook.com/unesa.surabaya',
                'linkedin' => 'https://linkedin.com/school/universitas-negeri-surabaya',
            ],
            'akreditasi_status' => 'Terakreditasi Baik Sekali [LAMEMBA]',
            'sk_akreditasi' => 'No. [Nomor SK Akreditasi LAMEMBA]',
            'masa_berlaku' => '2024 - 2029',
        ];
    }

    /**
     * Statistik utama untuk homepage & profil
     */
    public static function getStats(): array
    {
        return [
            [
                'number' => '98%',
                'label' => 'Tingkat Kelulusan Ujian CA',
                'desc' => 'Tingkat kelulusan peserta dalam modul sertifikasi Chartered Accountant Indonesia.',
            ],
            [
                'number' => '45+',
                'label' => 'Mitra Strategis & KAP',
                'desc' => 'Jejaring Kantor Akuntan Publik, BUMN, instansi pemerintah, dan korporasi nasional.',
            ],
            [
                'number' => '100%',
                'label' => 'Dosen Berkualifikasi CA / CPA / Ph.D',
                'desc' => 'Kombinasi akademisi doktor akuntansi dan praktisi senior pemegang sertifikasi profesi.',
            ],
            [
                'number' => '1.200+',
                'label' => 'Alumni Tersebar Nasional',
                'desc' => 'Alumni berkarier di Big 4, BPK, OJK, DJP, BUMN, perbankan, dan multinasional.',
            ],
        ];
    }

    /**
     * Keunggulan PPAk FEB UNESA
     */
    public static function getKeunggulan(): array
    {
        return [
            [
                'icon' => 'fa-certificate',
                'title' => 'Kurikulum Selaras IAI & Standar Global',
                'description' => 'Materi pembelajaran terintegrasi langsung dengan silabus Chartered Accountant (CA) Ikatan Akuntan Indonesia dan standar pelaporan keuangan IFRS terkini.',
            ],
            [
                'icon' => 'fa-chalkboard-user',
                'title' => 'Pengajar Akademisi & Praktisi Ahli',
                'description' => 'Dididik oleh gabungan guru besar, doktor akuntansi, serta praktisi aktif pemilik izin Akuntan Publik (AP/CPA), Konsultan Pajak (BKP), dan penilai publik.',
            ],
            [
                'icon' => 'fa-network-wired',
                'title' => 'Jejaring Kantor Akuntan Publik & Industri',
                'description' => 'Kemitraan strategis dengan jaringan KAP terkemuka, BUMN, perbankan, dan lembaga pemeriksa negara (BPK & BPKP) untuk rekrutmen karier prioritas.',
            ],
            [
                'icon' => 'fa-laptop-code',
                'title' => 'Laboratorium Audit & Analitika Terkini',
                'description' => 'Fasilitas praktika modern dilengkapi perangkat lunak audit audit-assist, analitika data keuangan, serta simulasi sistem perpajakan digital (e-Faktur & Coretax).',
            ],
            [
                'icon' => 'fa-clock-rotate-left',
                'title' => 'Waktu Kuliah Fleksibel & Terjadwal',
                'description' => 'Menyediakan kelas reguler dan kelas eksekutif akhir pekan yang dirancang khusus bagi para profesional dan staf yang sudah bekerja.',
            ],
            [
                'icon' => 'fa-scale-balanced',
                'title' => 'Fondasi Etika & Tata Kelola Kuat',
                'description' => 'Penanaman nilai integritas, independensi, skeptisisme profesional, dan kode etik profesi akuntan sebagai pilar utama pembentukan karakter lulusan.',
            ],
        ];
    }

    /**
     * Pilar Kompetensi Program
     */
    public static function getKompetensi(): array
    {
        return [
            [
                'code' => 'K-01',
                'title' => 'Pelaporan Keuangan & IFRS',
                'desc' => 'Kemampuan menyusun, menganalisis, dan mengevaluasi laporan keuangan entitas tunggal maupun konsolidasian berdasarkan PSAK konvergensi IFRS.',
                'icon' => 'fa-file-invoice-dollar',
            ],
            [
                'code' => 'K-02',
                'title' => 'Audit, Asurans & Skeptisisme',
                'desc' => 'Keahlian merancang prosedur pengauditan berbasis risiko (risk-based audit) sesuai Standar Audit (SA) berbasis ISA dan kode etik independensi.',
                'icon' => 'fa-magnifying-glass-chart',
            ],
            [
                'code' => 'K-03',
                'title' => 'Perpajakan Strategis & Kepatuhan',
                'desc' => 'Kompetensi mendalam dalam manajemen perpajakan korporasi, transfer pricing, sengketa pajak, serta kepatuhan sistem administrasi perpajakan digital.',
                'icon' => 'fa-receipt',
            ],
            [
                'code' => 'K-04',
                'title' => 'Tata Kelola, Risiko & Kepatuhan (GRC)',
                'desc' => 'Penguasaan implementasi Good Corporate Governance, enterprise risk management (ERM), sistem pengendalian internal COSO, dan kepatuhan regulasi.',
                'icon' => 'fa-shield-halved',
            ],
            [
                'code' => 'K-05',
                'title' => 'Manajemen Keuangan Lanjutan & Valuasi',
                'desc' => 'Analisis kelayakan investasi, restrukturisasi modal, merger dan akuisisi, valuasi bisnis, serta strategi mitigasi risiko pasar dan likuiditas.',
                'icon' => 'fa-chart-line',
            ],
            [
                'code' => 'K-06',
                'title' => 'Sistem Informasi & Analitika Data Akuntansi',
                'desc' => 'Pemanfaatan data analytics, audit data interrogation tools, dan pemahaman arsitektur ERP keuangan dalam ekosistem bisnis digital modern.',
                'icon' => 'fa-database',
            ],
        ];
    }

    /**
     * Data Dosen & Pengajar
     */
    public static function getDosen(): array
    {
        return [
            [
                'id' => 1,
                'name' => '[Nama Dosen / Pengajar 1]',
                'gelar' => 'Dr. [Nama Lengkap], S.E., M.Ak., Ak., CA., CPA.',
                'role' => 'Ketua Program Studi PPAk / Lektor Kepala',
                'category' => 'auditing',
                'category_label' => 'Auditing & Asurans',
                'bidang' => 'Pengauditan Lanjutan, Asurans, dan Etika Profesi',
                'matkul' => ['Audit dan Asurans Lanjutan', 'Etika Profesi dan Tata Kelola Korporasi'],
                'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80',
                'email' => 'kaprodi.ppak@unesa.ac.id',
                'sertifikasi' => ['Chartered Accountant (CA)', 'Certified Public Accountant (CPA)'],
            ],
            [
                'id' => 2,
                'name' => '[Nama Dosen / Pengajar 2]',
                'gelar' => 'Prof. Dr. [Nama Lengkap], M.Si., Ak., CA.',
                'role' => 'Guru Besar Akuntansi Keuangan',
                'category' => 'keuangan',
                'category_label' => 'Akuntansi Keuangan',
                'bidang' => 'Pelaporan Keuangan Korporat & Standar Akuntansi Keuangan (PSAK/IFRS)',
                'matkul' => ['Pelaporan Korporat Lanjutan', 'Akuntansi Keuangan Strategis'],
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80',
                'email' => 'guru.besar.ak@unesa.ac.id',
                'sertifikasi' => ['Chartered Accountant (CA)', 'ASEAN CPA'],
            ],
            [
                'id' => 3,
                'name' => '[Nama Dosen / Pengajar 3]',
                'gelar' => 'Dr. [Nama Lengkap], S.E., M.SA., Ak., CA., BKP.',
                'role' => 'Dosen Spesialis Perpajakan / Konsultan Pajak',
                'category' => 'perpajakan',
                'category_label' => 'Perpajakan',
                'bidang' => 'Manajemen Perpajakan, Transfer Pricing, dan Kebijakan Fiskal',
                'matkul' => ['Manajemen Perpajakan Lanjutan', 'Perpajakan Internasional & Strategi'],
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80',
                'email' => 'pajak.dosen@unesa.ac.id',
                'sertifikasi' => ['Chartered Accountant (CA)', 'Bersertifikat Konsultan Pajak (BKP) C'],
            ],
            [
                'id' => 4,
                'name' => '[Nama Dosen / Pengajar 4]',
                'gelar' => '[Nama Praktisi], S.E., M.M., Ak., CA., CPA., CFE.',
                'role' => 'Managing Partner KAP Rekanan / Dosen Praktisi',
                'category' => 'auditing',
                'category_label' => 'Auditing & Asurans',
                'bidang' => 'Forensic Accounting, Fraud Investigation, dan Quality Assurance',
                'matkul' => ['Akuntansi Forensik dan Investigasi', 'Praktik Audit Berbantuan Komputer'],
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&q=80',
                'email' => 'partner.kap@unesa.ac.id',
                'sertifikasi' => ['Certified Fraud Examiner (CFE)', 'Certified Public Accountant (CPA)'],
            ],
            [
                'id' => 5,
                'name' => '[Nama Dosen / Pengajar 5]',
                'gelar' => 'Dr. [Nama Lengkap], S.Pd., M.Ak., CMA., CSRA.',
                'role' => 'Sekretaris Program Studi PPAk / Lektor',
                'category' => 'manajemen',
                'category_label' => 'Manajemen & Informasi',
                'bidang' => 'Akuntansi Manajemen Stratejik & Pelaporan Keberlanjutan (ESG)',
                'matkul' => ['Akuntansi Manajemen Stratejik', 'Sustainability Reporting & ESG'],
                'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=600&q=80',
                'email' => 'sekprodi.ppak@unesa.ac.id',
                'sertifikasi' => ['Certified Management Accountant (CMA)', 'Certified Sustainability Reporting Assessor'],
            ],
            [
                'id' => 6,
                'name' => '[Nama Dosen / Pengajar 6]',
                'gelar' => '[Nama Dosen], S.E., M.Si., Ak., CA., CertDA.',
                'role' => 'Dosen Sistem Informasi & Analitika Data',
                'category' => 'manajemen',
                'category_label' => 'Manajemen & Informasi',
                'bidang' => 'Sistem Pengendalian Internal, Data Analytics, dan IT Governance',
                'matkul' => ['Sistem Informasi Akuntansi Lanjutan', 'Analitika Data Keuangan'],
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=600&q=80',
                'email' => 'analytics.dosen@unesa.ac.id',
                'sertifikasi' => ['Chartered Accountant (CA)', 'Certificate in Data Analytics (CertDA ICAEW)'],
            ],
        ];
    }

    /**
     * Berita & Pengumuman
     */
    public static function getBerita(): array
    {
        return [
            [
                'id' => 1,
                'slug' => 'penerimaan-mahasiswa-baru-ppak-feb-unesa-semester-gasal-2024-2025',
                'title' => 'Penerimaan Mahasiswa Baru PPAk FEB UNESA Semester Gasal 2024/2025 Resmi Dibuka',
                'excerpt' => 'Program Pendidikan Profesi Akuntansi FEB UNESA membuka pendaftaran mahasiswa baru gelombang reguler dan profesional untuk mencetak akuntan beregister negara.',
                'category' => 'Admisi & Pendaftaran',
                'date' => '15 September 2024',
                'author' => 'Tim Sekretariat PPAk',
                'image' => '/images/unesa_campus_hero.jpg',
                'read_time' => '4 menit baca',
                'tags' => ['Pendaftaran', 'Admisi', 'Mahasiswa Baru', 'Akuntansi'],
                'content' => '
                    <p class="lead">Pendidikan Profesi Akuntansi (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya resmi membuka pendaftaran penerimaan mahasiswa baru tahun akademik 2024/2025.</p>
                    <p>Program ini dirancang khusus bagi lulusan Sarjana (S1) maupun Sarjana Terapan (D4) Akuntansi yang ingin menuntaskan kualifikasi profesionalnya guna memperoleh sebutan Akuntan (Ak.) serta mempersiapkan diri menghadapi ujian Chartered Accountant (CA) Indonesia dan Certified Public Accountant (CPA).</p>
                    <h5>Fokus Pembelajaran Terkini</h5>
                    <p>Dalam kurikulum terbaru, mahasiswa PPAk FEB UNESA tidak hanya dibekali materi audit, perpajakan, dan pelaporan keuangan konvensional, tetapi juga diperkaya dengan kompetensi analitika data akuntansi (data analytics), pemahaman sistem informasi ERP, serta pelaporan keberlanjutan (ESG / Sustainability Reporting) yang kini menjadi tuntutan industri modern.</p>
                    <blockquote>"PPAk FEB UNESA berkomitmen menyelenggarakan perkuliahan yang menjembatani ranah akademis murni dengan standar praktik kantor akuntan publik dan regulasi pasar modal terkini," jelas Ketua Program Studi PPAk.</blockquote>
                    <h5>Jadwal & Mekanisme Pendaftaran</h5>
                    <p>Pendaftaran dilaksanakan secara daring melalui portal admisi resmi UNESA. Calon peserta diwajibkan mengunggah berkas portofolio akademik, ijazah dan transkrip legalisir, serta mengikuti tes potensi akademik dan wawancara pendalaman motivasi keprofesian.</p>
                ',
            ],
            [
                'id' => 2,
                'slug' => 'kuliah-tamu-praktisi-big-4-kap-tantangan-audit-digital-dan-ai',
                'title' => 'Kuliah Tamu Praktisi Big 4 KAP: Navigasi Tantangan Audit Berbasis Kecerdasan Buatan',
                'excerpt' => 'Menghadirkan Partner dari salah satu KAP Big Four di Indonesia guna membedah implementasi Artificial Intelligence dalam prosedur pengujian asurans.',
                'category' => 'Akademik & Seminar',
                'date' => '02 September 2024',
                'author' => 'Gugus Humas FEB',
                'image' => '/images/accounting_lecture.jpg',
                'read_time' => '5 menit baca',
                'tags' => ['Kuliah Tamu', 'Big 4', 'Auditing', 'AI in Accounting'],
                'content' => '
                    <p class="lead">Auditorium G6 FEB UNESA dipadati oleh mahasiswa PPAk dan sivitas akademika dalam sesi kuliah tamu bertajuk <em>"Navigating AI & Machine Learning in Modern Auditing Engagements"</em>.</p>
                    <p>Narasumber memaparkan bagaimana kantor akuntan publik bertaraf internasional bertransformasi dari pengujian sampel audit manual ke metode continuous auditing dan automated risk anomaly detection menggunakan algoritma kecerdasan buatan.</p>
                    <p>Mahasiswa diajak mengamati demonstrasi langsung perangkat lunak audit assist yang mampu menganalisis jutaan transaksi buku besar hanya dalam hitungan detik untuk mendeteksi potensi fraud dan transaksi anomali pada akhir periode buku.</p>
                ',
            ],
            [
                'id' => 3,
                'slug' => 'sosialisasi-skema-waiver-dan-persiapan-ujian-ca-bersama-iai-jawa-timur',
                'title' => 'Sosialisasi Skema Pembebasan Ujian (Waiver) dan Persiapan Ujian CA Bersama IAI Wilayah Jawa Timur',
                'excerpt' => 'PPAk FEB UNESA berkolaborasi dengan Ikatan Akuntan Indonesia Wilayah Jawa Timur menyelenggarakan pembekalan sertifikasi Chartered Accountant bagi mahasiswa.',
                'category' => 'Sertifikasi & Profesi',
                'date' => '20 Agustus 2024',
                'author' => 'Koordinator Kerja Sama',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
                'read_time' => '3 menit baca',
                'tags' => ['IAI', 'Chartered Accountant', 'Waiver CA', 'Sertifikasi'],
                'content' => '
                    <p class="lead">Kerja sama erat antara PPAk FEB UNESA dengan Ikatan Akuntan Indonesia (IAI) Jawa Timur memberikan kemudahan nyata bagi para calon lulusan dalam menempuh sertifikasi CA Indonesia.</p>
                    <p>Dalam forum ini, perwakilan IAI menjelaskan struktur modul ujian CA tingkat profesi serta bagaimana kurikulum PPAk UNESA telah terakreditasi sehingga mahasiswa berhak memperoleh skema waiver (pembebasan) untuk mata ujian tertentu yang telah ditempuh selama masa perkuliahan profesi.</p>
                ',
            ],
            [
                'id' => 4,
                'slug' => 'workshop-manajemen-perpajakan-korporasi-hadapi-implementasi-coretax',
                'title' => 'Workshop Intensif Manajemen Perpajakan: Strategi Kepatuhan Entitas Menghadapi Pembaruan Sistem Coretax',
                'excerpt' => 'Pelatihan teknis bagi mahasiswa profesi dan praktisi akuntansi mengenai arsitektur sistem administrasi perpajakan baru DJP.',
                'category' => 'Workshop & Pelatihan',
                'date' => '10 Agustus 2024',
                'author' => 'Laboratorium Perpajakan PPAk',
                'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80',
                'read_time' => '4 menit baca',
                'tags' => ['Perpajakan', 'Coretax', 'DJP', 'Workshop'],
                'content' => '
                    <p class="lead">Perkembangan regulasi perpajakan nasional dan digitalisasi sistem kepatuhan menuntut akuntan memahami mekanisme Coretax Administration System (CTAS).</p>
                    <p>Laboratorium Perpajakan PPAk FEB UNESA menggelar workshop praktika yang menghadirkan instruktur dari Direktorat Jenderal Pajak (DJP) Jawa Timur. Mahasiswa mempraktikkan simulasi deposit pajak, pelaporan SPT terpadu, dan manajemen pemotongan PPh secara daring.</p>
                ',
            ],
            [
                'id' => 5,
                'slug' => 'penandatanganan-mou-kerja-sama-rekrutmen-dengan-lima-kantor-akuntan-publik',
                'title' => 'Perkuat Peluang Kerja Lulusan: PPAk FEB UNESA Teken Kerja Sama dengan 5 Kantor Akuntan Publik',
                'excerpt' => 'Kemitraan strategis mencakup program magang profesi terstruktur, penyaluran kerja auditor junior, serta penelitian bersama dalam bidang asurans.',
                'category' => 'Kerja Sama & Kemitraan',
                'date' => '28 Juli 2024',
                'author' => 'Humas FEB UNESA',
                'image' => '/images/audit_team_practice.jpg',
                'read_time' => '3 menit baca',
                'tags' => ['MoU', 'KAP', 'Karier', 'Kemitraan'],
                'content' => '
                    <p class="lead">Dekan FEB UNESA bersama lima pimpinan Kantor Akuntan Publik resmi menandatangani nota kesepahaman (MoU) dan perjanjian kerja sama operasional.</p>
                    <p>Inisiatif ini dirancang agar mahasiswa PPAk mendapatkan prioritas rekrutmen magang pada musim audit (busy season), dengan peluang konversi menjadi staf auditor tetap pasca kelulusan pendidikan profesi.</p>
                ',
            ],
            [
                'id' => 6,
                'slug' => 'alumni-sharing-session-membangun-karier-di-lingkungan-auditor-negara-bpk-ri',
                'title' => 'Alumni Sharing Session: Strategi Membangun Karier Sebagai Auditor Pemeriksa Keuangan Negara',
                'excerpt' => 'Alumni PPAk yang berkarier di Badan Pemeriksa Keuangan (BPK RI) membagikan wawasan mengenai integritas dan metodologi audit sektor publik.',
                'category' => 'Alumni & Karier',
                'date' => '15 Juli 2024',
                'author' => 'Ikatan Alumni PPAk',
                'image' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=800&q=80',
                'read_time' => '4 menit baca',
                'tags' => ['Alumni', 'BPK RI', 'Sektor Publik', 'Karier'],
                'content' => '
                    <p class="lead">Ikatan Alumni PPAk FEB UNESA secara berkala menggelar forum diskusi untuk menginspirasi para mahasiswa yang sedang menempuh pendidikan profesi.</p>
                    <p>Sesi kali ini menghadirkan alumni yang mengabdi sebagai Auditor Pertama di BPK RI Perwakilan Jawa Timur. Topik bahasan menitikberatkan pada Standar Pemeriksaan Keuangan Negara (SPKN) dan peran penting audit kinerja dalam mendorong transparansi anggaran publik.</p>
                ',
            ],
        ];
    }

    /**
     * Agenda & Event
     */
    public static function getAgenda(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Sosialisasi & Workshop Persiapan Ujian Tingkat Lanjutan CA Indonesia',
                'category' => 'Ujian Profesi & Sertifikasi',
                'day' => '28',
                'month' => 'OKT',
                'year' => '2024',
                'date_range' => 'Senin, 28 Oktober 2024',
                'time' => '09.00 - 15.00 WIB',
                'venue' => 'Ruang Seminar Utama Gd. G6 Lt. 3 FEB UNESA',
                'speaker' => 'Dewan Sertifikasi Akuntan Profesional IAI',
                'status' => 'Pendaftaran Dibuka',
                'is_upcoming' => true,
                'desc' => 'Pembekalan komprehensif bagi mahasiswa PPAk mengenai kisi-kisi, simulasi pengerjaan studi kasus, serta manajemen waktu ujian CA tingkat akhir.',
            ],
            [
                'id' => 2,
                'title' => 'Guest Lecture: Forensic Accounting & Advanced Fraud Examination Techniques',
                'category' => 'Kuliah Tamu',
                'day' => '05',
                'month' => 'NOV',
                'year' => '2024',
                'date_range' => 'Selasa, 05 November 2024',
                'time' => '13.30 - 16.30 WIB',
                'venue' => 'Hybrid (Auditorium FEB & Zoom Meeting)',
                'speaker' => 'Managing Director Forensic Advisory Services',
                'status' => 'Segera Dibuka',
                'is_upcoming' => true,
                'desc' => 'Pemaparan metodologi investigasi fraud korporasi, analisis jejak digital transaksi keuangan tersembunyi, dan peran akuntan forensik dalam persidangan.',
            ],
            [
                'id' => 3,
                'title' => 'Batas Akhir Pendaftaran Mahasiswa Baru PPAk Gelombang II Tahun 2024',
                'category' => 'Admisi & Pendaftaran',
                'day' => '15',
                'month' => 'NOV',
                'year' => '2024',
                'date_range' => 'Jumat, 15 November 2024',
                'time' => '23.59 WIB',
                'venue' => 'Portal Online Admisi UNESA',
                'speaker' => 'Panitia PMB FEB UNESA',
                'status' => 'Berlangsung',
                'is_upcoming' => true,
                'desc' => 'Penutupan submit berkas administratif dan pembayaran formulir seleksi penerimaan mahasiswa baru program profesi semester genap.',
            ],
            [
                'id' => 4,
                'title' => 'Webinar Nasional: Tantangan Penerapan PSAK 117 (Kontrak Asuransi) di Industri Finansial',
                'category' => 'Webinar Nasional',
                'day' => '14',
                'month' => 'SEP',
                'year' => '2024',
                'date_range' => 'Sabtu, 14 September 2024',
                'time' => '08.30 - 12.00 WIB',
                'venue' => 'Live Zoom Webinar & YouTube FEB',
                'speaker' => 'Komite Standar Akuntansi Keuangan (DSAK IAI)',
                'status' => 'Selesai',
                'is_upcoming' => false,
                'desc' => 'Kajian mendalam mengenai pengukuran liabilitas asuransi dan dampaknya terhadap solvabilitas modal perusahaan asuransi nasional.',
            ],
            [
                'id' => 5,
                'title' => 'Yudisium & Pengukuhan Sebutan Akuntan (Ak.) Lulusan PPAk Periode Genap',
                'category' => 'Seremoni Akademik',
                'day' => '25',
                'month' => 'AGU',
                'year' => '2024',
                'date_range' => 'Minggu, 25 Agustus 2024',
                'time' => '08.00 - 13.00 WIB',
                'venue' => 'Grand Ballroom Gedung Rektorat UNESA Lidah Wetan',
                'speaker' => 'Rektor UNESA & Dekan FEB',
                'status' => 'Selesai',
                'is_upcoming' => false,
                'desc' => 'Pelantikan resmi dan penyerahan piagam gelar profesi Akuntan bagi para lulusan yang telah menyelesaikan seluruh SKS kurikulum.',
            ],
        ];
    }

    /**
     * Testimoni Alumni
     */
    public static function getTestimoni(): array
    {
        return [
            [
                'name' => '[Nama Alumni 1, S.E., M.Ak., Ak., CA., CPA.]',
                'year' => 'Alumni Angkatan 2021',
                'role' => 'Senior Assurance Auditor',
                'company' => 'KAP Big Four (Jakarta)',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'quote' => 'PPAk FEB UNESA tidak sekadar mengajarkan teori akuntansi lanjutan, melainkan melatih ketajaman skeptisisme profesional dan studi kasus nyata yang sangat aplikatif saat saya memimpin tim audit di KAP internasional.',
            ],
            [
                'name' => '[Nama Alumni 2, S.E., Ak., CA., BKP.]',
                'year' => 'Alumni Angkatan 2022',
                'role' => 'Corporate Tax Planning Specialist',
                'company' => 'BUMN Industri Energi',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'quote' => 'Dosen-dosen pengajar yang sebagian besar adalah praktisi senior membuat setiap sesi perkuliahan terasa seperti simulasi dinamika kerja korporasi. Pengurusan sertifikasi CA dan pembebasan modul ujian juga berjalan sangat transparan dan terarah.',
            ],
            [
                'name' => '[Nama Alumni 3, S.E., Ak., CA.]',
                'year' => 'Alumni Angkatan 2020',
                'role' => 'Auditor Pertama Pengawasan Keuangan',
                'company' => 'Badan Pengawasan Keuangan dan Pembangunan (BPKP)',
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'quote' => 'Penanaman kode etik dan integritas di PPAk FEB UNESA menjadi pedoman utama saya dalam melaksanakan penugasan audit sektor publik dan audit kinerja kementerian.',
            ],
            [
                'name' => '[Nama Alumni 4, S.E., Ak., CA., CMA.]',
                'year' => 'Alumni Angkatan 2023',
                'role' => 'Financial Controller',
                'company' => 'Multinational Manufacturing Group',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                'quote' => 'Kelas eksekutif akhir pekan di PPAk UNESA memberikan ruang belajar yang sangat kondusif bagi pekerja profesional. Diskusi lintas profesi dengan sesama rekan kuliah memperluas wawasan bisnis secara signifikan.',
            ],
        ];
    }

    /**
     * Kategori Karier Alumni
     */
    public static function getKarierSectors(): array
    {
        return [
            ['title' => 'Auditor Eksternal (KAP)', 'icon' => 'fa-magnifying-glass', 'desc' => 'KAP Big Four, KAP Nasional & Multinasional'],
            ['title' => 'Pemeriksa Keuangan Negara', 'icon' => 'fa-landmark', 'desc' => 'BPK RI, BPKP, Inspektorat Daerah & Kementerian'],
            ['title' => 'Konsultan Pajak & Transfer Pricing', 'icon' => 'fa-receipt', 'desc' => 'Kantor Konsultan Pajak & Kantor Advokat Pajak'],
            ['title' => 'Financial Controller & CFO', 'icon' => 'fa-briefcase', 'desc' => 'Perusahaan Terbuka (Tbk), BUMN & Multinasional'],
            ['title' => 'Internal Auditor & Risk Manager', 'icon' => 'fa-shield-check', 'desc' => 'Sektor Perbankan, Fintech & Korporasi Global'],
            ['title' => 'Akademisi & Peneliti Akuntansi', 'icon' => 'fa-user-graduate', 'desc' => 'Perguruan Tinggi Negeri & Lembaga Kajian Kebijakan'],
        ];
    }

    /**
     * Mitra & Lembaga Kerja Sama
     */
    public static function getMitra(): array
    {
        return [
            [
                'name' => 'Ikatan Akuntan Indonesia (IAI)',
                'category' => 'Organisasi Profesi',
                'type' => 'Mitra Sertifikasi CA & Pengembangan Standar',
                'desc' => 'Penyelenggaraan ujian sertifikasi Chartered Accountant dan penyelarasan kurikulum profesi.',
            ],
            [
                'name' => 'Institut Akuntan Publik Indonesia (IAPI)',
                'category' => 'Organisasi Profesi',
                'type' => 'Mitra Sertifikasi CPA & Pelatihan Audit',
                'desc' => 'Kerja sama pelaksanaan ujian profesi Certified Public Accountant dan forum audit.',
            ],
            [
                'name' => 'KAP Rekanan Big Four & Afiliasi Global',
                'category' => 'Kantor Akuntan Publik',
                'type' => 'Penyaluran Magang & Rekrutmen Kerja',
                'desc' => 'Kemitraan penempatan kerja lulusan dan program magang intensif pada busy season.',
            ],
            [
                'name' => 'Badan Pemeriksa Keuangan (BPK RI)',
                'category' => 'Instansi Pemerintah',
                'type' => 'Mitra Riset Sektor Publik & Kuliah Pakar',
                'desc' => 'Kuliah tamu kepatuhan sektor publik, studi kasus audit kinerja, dan program pengabdian.',
            ],
            [
                'name' => 'Badan Pengawasan Keuangan dan Pembangunan (BPKP)',
                'category' => 'Instansi Pemerintah',
                'type' => 'Penguatan GRC & Akuntabilitas Pemda',
                'desc' => 'Riset bersama evaluasi sistem pengendalian internal dan tata kelola keuangan daerah.',
            ],
            [
                'name' => 'Direktorat Jenderal Pajak (DJP) Jawa Timur',
                'category' => 'Regulator',
                'type' => 'Edukasi Kepatuhan Pajak & Coretax',
                'desc' => 'Penyelenggaraan Tax Center, pelatihan aplikasi sistem perpajakan terpadu dan konsultasi regulasi.',
            ],
            [
                'name' => 'Otoritas Jasa Keuangan (OJK)',
                'category' => 'Regulator',
                'type' => 'Edukasi Pasar Modal & Good Governance',
                'desc' => 'Sosialisasi kepatuhan emiten, pelaporan keuangan pasar modal, dan tata kelola lembaga jasa keuangan.',
            ],
            [
                'name' => 'BUMN & Korporasi Perbankan Nasional',
                'category' => 'Dunia Usaha & Industri',
                'type' => 'Jejaring Magang & Beasiswa Rekrutmen',
                'desc' => 'Kerja sama penyerapan tenaga akuntan manajemen, financial analyst, dan internal auditor.',
            ],
        ];
    }

    /**
     * Struktur Kurikulum Lengkap
     */
    public static function getKurikulum(): array
    {
        return [
            'semester_1' => [
                ['kode' => 'PAK6101', 'nama' => 'Pelaporan Keuangan Korporat Lanjutan', 'sks' => 3, 'kategori' => 'Wajib Profesi', 'silabus' => 'Penerapan standar akuntansi keuangan terkini (PSAK berbasis IFRS) untuk transaksi kompleks, konsolidasi entitas bertujuan khusus, dan instrumen keuangan.'],
                ['kode' => 'PAK6102', 'nama' => 'Audit & Asurans Lanjutan', 'sks' => 3, 'kategori' => 'Wajib Profesi', 'silabus' => 'Prosedur pengauditan berbasis risiko internasional (ISA), pengujian substantif menyeluruh, skeptisisme profesional, serta pelaporan auditor independen.'],
                ['kode' => 'PAK6103', 'nama' => 'Manajemen Perpajakan Strategis', 'sks' => 3, 'kategori' => 'Wajib Profesi', 'silabus' => 'Perencanaan pajak legal, kepatuhan perpajakan badan, mitigasi risiko sengketa pajak, transfer pricing, dan implementasi kepatuhan berbasis Coretax.'],
                ['kode' => 'PAK6104', 'nama' => 'Etika Profesi & Tata Kelola Korporasi (GCG)', 'sks' => 3, 'kategori' => 'Wajib Profesi', 'silabus' => 'Kode etik akuntan profesional IAI/IESBA, tanggung jawab hukum akuntan, prinsip-prinsip GCG, manajemen risiko, dan pengendalian internal.'],
            ],
            'semester_2' => [
                ['kode' => 'PAK6201', 'nama' => 'Akuntansi Manajemen Stratejik & Pengendalian', 'sks' => 3, 'kategori' => 'Wajib Profesi', 'silabus' => 'Analisis biaya strategis, balanced scorecard, sistem pengukuran kinerja korporasi, serta pengambilan keputusan manajerial jangka panjang.'],
                ['kode' => 'PAK6202', 'nama' => 'Sistem Informasi Akuntansi & Data Analytics', 'sks' => 3, 'kategori' => 'Wajib Profesi', 'silabus' => 'Integrasi sistem ERP, audit data analytics (CAATs), keamanan sistem informasi akuntansi, dan teknik interogasi data transaksi keuangan.'],
                ['kode' => 'PAK6203', 'nama' => 'Manajemen Keuangan Lanjutan & Valuasi Bisnis', 'sks' => 3, 'kategori' => 'Wajib Profesi', 'silabus' => 'Restrukturisasi keuangan, valuasi merger & akuisisi, evaluasi portofolio investasi, serta mitigasi risiko volatilitas valas dan bunga.'],
                ['kode' => 'PAK6204', 'nama' => 'Praktik Profesi Akuntansi Terpadu (Capstone Project)', 'sks' => 3, 'kategori' => 'Tugas Akhir Profesi', 'silabus' => 'Penyelesaian simulasi penugasan audit komprehensif, penyusunan kertas kerja pemeriksaan profesional, dan presentasi laporan hasil audit.'],
            ],
            'total_sks' => 24,
            'masa_studi' => '2 Semester (1 Tahun Akademik)',
            'cpl' => [
                [
                    'ranah' => 'Sikap & Etika (Attitude)',
                    'items' => [
                        'Menjunjung tinggi nilai kemanusiaan, moral, dan etika profesi akuntan dalam menjalankan tugas profesional.',
                        'Menunjukkan sikap independen, berintegritas tinggi, objektif, dan memiliki skeptisisme profesional dalam setiap pertimbangan teknis.',
                        'Bertanggung jawab penuh atas pekerjaan di bidang profesi akuntansi secara mandiri maupun tim.',
                    ],
                ],
                [
                    'ranah' => 'Penguasaan Pengetahuan (Knowledge)',
                    'items' => [
                        'Menguasai konsep teoretis mendalam mengenai pelaporan keuangan korporat berbasis SAK/IFRS.',
                        'Menguasai metodologi pengauditan dan asurans berbasis risiko sesuai Standar Profesional Akuntan Publik (SPAP) dan standar internasional ISA.',
                        'Menguasai regulasi perpajakan nasional dan internasional serta strategi perencanaan pajak yang etis dan taat asas.',
                        'Menguasai prinsip tata kelola korporasi yang baik (Good Corporate Governance) dan sistem manajemen risiko terpadu.',
                    ],
                ],
                [
                    'ranah' => 'Keterampilan Khusus (Practical Skills)',
                    'items' => [
                        'Mampu merancang dan melaksanakan audit laporan keuangan entitas publik maupun privat secara komprehensif.',
                        'Mampu memanfaatkan teknologi informasi dan perangkat data analytics untuk mengevaluasi kewajaran transaksi keuangan berskala besar.',
                        'Mampu menyusun strategi kepatuhan perpajakan dan memberikan rekomendasi mitigasi risiko fiskal bagi korporasi.',
                        'Mampu berkomunikasi secara efektif dalam bentuk opini, laporan rekomendasi manajemen, dan kertas kerja berstandar baku.',
                    ],
                ],
            ],
        ];
    }

    /**
     * Kalender Akademik
     */
    public static function getKalender(): array
    {
        return [
            'semester_gasal' => [
                ['tanggal' => '01 Juli - 15 Agustus 2024', 'kegiatan' => 'Pendaftaran & Seleksi Masuk Calon Mahasiswa Baru Gelombang I & II', 'status' => 'Selesai'],
                ['tanggal' => '19 - 23 Agustus 2024', 'kegiatan' => 'Registrasi Ulang & Pembayaran Biaya Pendidikan', 'status' => 'Selesai'],
                ['tanggal' => '26 - 30 Agustus 2024', 'kegiatan' => 'Program Matrikulasi Akuntansi (Bagi Peserta Tertentu)', 'status' => 'Selesai'],
                ['tanggal' => '02 September 2024', 'kegiatan' => 'Awal Perkuliahan Semester Gasal Tahun Akademik 2024/2025', 'status' => 'Selesai'],
                ['tanggal' => '21 - 25 Oktober 2024', 'kegiatan' => 'Ujian Tengah Semester (UTS) Gasal', 'status' => 'Akan Datang'],
                ['tanggal' => '23 - 27 Desember 2024', 'kegiatan' => 'Ujian Akhir Semester (UAS) Gasal', 'status' => 'Akan Datang'],
                ['tanggal' => '30 Desember 2024 - 10 Januari 2025', 'kegiatan' => 'Evaluasi Hasil Studi & Penginputan Nilai Semester Gasal', 'status' => 'Akan Datang'],
            ],
            'semester_genap' => [
                ['tanggal' => '02 - 17 Januari 2025', 'kegiatan' => 'Pembayaran Biaya Pendidikan & Pemrograman KRS Semester Genap', 'status' => 'Akan Datang'],
                ['tanggal' => '03 Februari 2025', 'kegiatan' => 'Awal Perkuliahan Semester Genap Tahun Akademik 2024/2025', 'status' => 'Akan Datang'],
                ['tanggal' => '24 - 28 Maret 2025', 'kegiatan' => 'Ujian Tengah Semester (UTS) Genap', 'status' => 'Akan Datang'],
                ['tanggal' => '19 - 23 Mei 2025', 'kegiatan' => 'Ujian Akhir Semester (UAS) Genap', 'status' => 'Akan Datang'],
                ['tanggal' => '02 - 20 Juni 2025', 'kegiatan' => 'Ujian Komprehensif / Sidang Capstone Project Profesi Akuntansi', 'status' => 'Akan Datang'],
                ['tanggal' => 'Juli - Agustus 2025', 'kegiatan' => 'Yudisium & Pengukuhan Gelar Profesi Akuntan (Ak.)', 'status' => 'Akan Datang'],
            ],
        ];
    }

    /**
     * Jalur & Syarat Pendaftaran
     */
    public static function getAdmisiInfo(): array
    {
        return [
            'jalur' => [
                [
                    'name' => 'Jalur Reguler (Lulusan S1/D4 Akuntansi)',
                    'target' => 'Lulusan sarjana program studi Akuntansi terakreditasi minimal B/Baik Sekali.',
                    'durasi' => '2 Semester (24 SKS)',
                    'desc' => 'Dapat langsung mengikuti perkuliahan reguler profesi tanpa kewajiban matrikulasi dasar.',
                ],
                [
                    'name' => 'Jalur Matrikulasi (Penyelarasan Kompetensi)',
                    'target' => 'Lulusan rumpun ilmu ekonomi atau praktisi dengan latar belakang tertentu yang membutuhkan penyegaran prasyarat.',
                    'durasi' => 'Matrikulasi 1 Bulan + 2 Semester PPAk',
                    'desc' => 'Wajib menempuh modul pengantar akuntansi lanjutan sebelum memasuki perkuliahan inti profesi.',
                ],
                [
                    'name' => 'Jalur Kemitraan / Eksekutif Instansi',
                    'target' => 'Staf utusan dari BUMN, Kementerian/Lembaga, Kantor Akuntan Publik, atau korporasi mitra.',
                    'durasi' => '2 Semester (Jadwal Khusus Akhir Pekan / Blended)',
                    'desc' => 'Skema kerja sama institusi dengan kurikulum terpadu dan fleksibilitas waktu perkuliahan.',
                ],
            ],
            'syarat_umum' => [
                'Warga Negara Indonesia (WNI) atau Warga Negara Asing (WNA) dengan izin kementerian yang berwenang.',
                'Memiliki ijazah Sarjana (S1) atau Sarjana Terapan (D4) dari perguruan tinggi terakreditasi.',
                'Indeks Prestasi Kumulatif (IPK) program sarjana minimal 2.75 (skala 4.00) atau sesuai kebijakan program studi.',
                'Sehat jasmani dan rohani serta bebas dari penyalahgunaan narkotika.',
            ],
            'dokumen' => [
                ['item' => 'Salinan Ijazah S1/D4 Legalisir', 'wajib' => true, 'ket' => 'Scan warna dokumen asli atau fotokopi berlegalisir basah'],
                ['item' => 'Salinan Transkrip Akademik Legalisir', 'wajib' => true, 'ket' => 'Scan transkrip nilai lengkap dari jenjang sarjana'],
                ['item' => 'Kartu Tanda Penduduk (KTP) / Paspor', 'wajib' => true, 'ket' => 'Scan KTP WNI atau paspor aktif bagi peserta asing'],
                ['item' => 'Pasfoto Berwarna Terbaru', 'wajib' => true, 'ket' => 'Latar belakang merah atau biru, format formal'],
                ['item' => 'Sertifikat Kemampuan Bahasa Inggris (TOEFL/IELTS)', 'wajib' => false, 'ket' => 'Skor minimal setara TOEFL 450 (dapat disusulkan)'],
                ['item' => 'Surat Rekomendasi Akademik / Atasan Kerja', 'wajib' => false, 'ket' => 'Terutama disarankan bagi pendaftar jalur eksekutif kemitraan'],
            ],
            'biaya' => [
                ['komponen' => 'Biaya Pendaftaran & Seleksi Masuk', 'nominal' => 'Rp [Nominal Biaya Pendaftaran]', 'keterangan' => 'Dibayarkan 1x saat submit formulir pendaftaran daring'],
                ['komponen' => 'Uang Kuliah Tunggal (UKT) Semester I', 'nominal' => 'Rp [Nominal Biaya Semester I]', 'keterangan' => 'Mencakup 12 SKS perkuliahan, modul ajar, dan akses laboratorium'],
                ['komponen' => 'Uang Kuliah Tunggal (UKT) Semester II', 'nominal' => 'Rp [Nominal Biaya Semester II]', 'keterangan' => 'Mencakup 12 SKS perkuliahan, praktika audit, dan capstone project'],
                ['komponen' => 'Biaya Program Matrikulasi (Jika Dipersyaratkan)', 'nominal' => 'Rp [Nominal Biaya Matrikulasi]', 'keterangan' => 'Hanya bagi pendaftar yang diwajibkan mengikuti matrikulasi'],
                ['komponen' => 'Biaya Ujian Sertifikasi CA Indonesia', 'nominal' => 'Sesuai Ketentuan IAI', 'keterangan' => 'Dikelola langsung oleh Ikatan Akuntan Indonesia (skema waiver berlaku)'],
            ],
            'prosedur' => [
                ['step' => '01', 'title' => 'Buat Akun & Registrasi Daring', 'desc' => 'Buka portal resmi admisi UNESA, pilih jenjang Profesi, dan isi formulir biodata awal.'],
                ['step' => '02', 'title' => 'Unggah Dokumen Portofolio', 'desc' => 'Upload scan ijazah, transkrip, identitas diri, pasfoto, dan dokumen pendukung sesuai format.'],
                ['step' => '03', 'title' => 'Verifikasi Administratif', 'desc' => 'Tim sekretariat memverifikasi keabsahan dokumen berkas pendaftaran calon mahasiswa.'],
                ['step' => '04', 'title' => 'Seleksi & Tes Wawancara', 'desc' => 'Mengikuti tes potensi kompetensi dasar dan wawancara motivasi akademik bersama pimpinan prodi.'],
                ['step' => '05', 'title' => 'Pengumuman & Registrasi Ulang', 'desc' => 'Melihat status kelulusan, melakukan pembayaran biaya pendidikan, dan aktivasi akun mahasiswa UNESA.'],
            ],
        ];
    }

    /**
     * FAQ Admisi & Program
     */
    public static function getFaq(): array
    {
        return [
            [
                'q' => 'Apa perbedaan lulusan S1 Akuntansi dengan lulusan PPAk?',
                'a' => 'Lulusan S1 Akuntansi memiliki gelar akademik (S.E. atau S.Ak.), namun belum berhak menyandang sebutan profesi Akuntan (Ak.) serta belum memenuhi syarat langsung untuk memperoleh izin Akuntan Publik (AP). Lulusan PPAk menyelesaikan kurikulum profesi resmi yang diakui kementerian, berhak menyandang sebutan Akuntan (Ak.), teregistrasi di Kementerian Keuangan (RNA), serta memiliki jalur pembebasan ujian sertifikasi Chartered Accountant (CA) dari IAI.',
            ],
            [
                'q' => 'Berapa lama masa studi di PPAk FEB UNESA?',
                'a' => 'Masa studi normal ditempuh selama 2 (dua) semester atau 1 (satu) tahun akademik dengan total beban kurikulum 24 SKS. Tersedia pilihan jadwal kelas reguler dan kelas eksekutif akhir pekan.',
            ],
            [
                'q' => 'Apakah lulusan sarjana terapan (D4) Akuntansi dapat mendaftar?',
                'a' => 'Ya, lulusan Sarjana Terapan (D4) bidang Akuntansi dari perguruan tinggi terakreditasi berhak mendaftar di PPAk FEB UNESA dengan ketentuan memenuhi persyaratan administratif dan kelayakan akademik yang berlaku.',
            ],
            [
                'q' => 'Bagaimana skema pembebasan ujian (waiver) Chartered Accountant (CA)?',
                'a' => 'Karena kurikulum PPAk FEB UNESA dirancang selaras dengan silabus IAI dan telah terakreditasi, mahasiswa yang lulus mata kuliah terkait di PPAk berhak memperoleh pembebasan (waiver) modul ujian CA tertentu sehingga mahasiswa hanya perlu menempuh ujian modul tersisa untuk meraih kualifikasi CA penuh.',
            ],
            [
                'q' => 'Apakah perkuliahan dapat diikuti oleh pekerja atau profesional aktif?',
                'a' => 'Sangat bisa. PPAk FEB UNESA menyelenggarakan kelas eksekutif dengan waktu perkuliahan yang dijadwalkan pada hari Jumat malam dan Sabtu, didukung fasilitas pembelajaran blended learning untuk memfasilitasi kebutuhan para profesional aktif.',
            ],
            [
                'q' => 'Bagaimana cara melakukan pembayaran formulir dan biaya pendidikan?',
                'a' => 'Seluruh pembayaran dilakukan secara resmi melalui Virtual Account (VA) perbankan mitra UNESA (Bank Mandiri, BTN, BNI, BRI, BSI) yang tertera pada kartu bukti pendaftaran admisi online.',
            ],
        ];
    }

    /**
     * Riset & Publikasi Dosen / Mahasiswa
     */
    public static function getRiset(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Determinants of Audit Quality in the Era of Automated Intelligence: Evidence from Indonesian Public Accounting Firms',
                'peneliti' => '[Nama Dosen / Tim Peneliti PPAk]',
                'tahun' => '2024',
                'jurnal' => 'Journal of Accounting and Auditing Research (SINTA 2)',
                'bidang' => 'Auditing & Technology',
                'abstrak' => 'Penelitian ini menguji pengaruh adopsi piranti audit berbantuan komputer terhadap efektivitas skeptisisme profesional auditor pada KAP di Surabaya dan Jakarta.',
            ],
            [
                'id' => 2,
                'title' => 'Tax Compliance Dynamics under the Core Tax Administration System: A Behavioral Perspective',
                'peneliti' => '[Nama Dosen Perpajakan]',
                'tahun' => '2024',
                'jurnal' => 'Indonesian Journal of Taxation & Public Finance',
                'bidang' => 'Taxation & Fiscal Policy',
                'abstrak' => 'Menganalisis kesiapan wajib pajak badan serta konsultan pajak dalam menyongsong otomasi kepatuhan pajak digital pada sistem CTAS DJP.',
            ],
            [
                'id' => 3,
                'title' => 'The Impact of ESG Disclosure on Cost of Equity Capital in Indonesian Capital Market',
                'peneliti' => '[Nama Dosen / Kolaborasi Mahasiswa]',
                'tahun' => '2023',
                'jurnal' => 'Asia Pacific Journal of Corporate Governance',
                'bidang' => 'Sustainability & Corporate Finance',
                'abstrak' => 'Mengevaluasi sejauh mana pengungkapan laporan keberlanjutan (sustainability reporting) mampu mereduksi asimetri informasi dan menurunkan biaya ekuitas emiten BEI.',
            ],
            [
                'id' => 4,
                'title' => 'Role of Forensic Accounting and Internal Control System in Fraud Prevention among Public Sector Entities',
                'peneliti' => '[Nama Dosen Akuntansi Sektor Publik]',
                'tahun' => '2023',
                'jurnal' => 'Jurnal Akuntansi dan Akuntabilitas Publik',
                'bidang' => 'Forensic Accounting & Public Sector',
                'abstrak' => 'Kajian empiris mengenai penerapan audit investigatif dan audit kepatuhan dalam memperkuat transparansi pengelolaan anggaran pemerintah daerah.',
            ],
        ];
    }

    /**
     * Pengabdian Kepada Masyarakat (PKM)
     */
    public static function getPengabdian(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Pendampingan Penyusunan Laporan Keuangan Berbasis SAK EMKM bagi Paguyuban UMKM Unggulan Jawa Timur',
                'lokasi' => 'Kabupaten Sidoarjo & Surabaya',
                'tahun' => '2024',
                'mitra' => 'Dinas Koperasi dan UKM serta Asosiasi UMKM Binaan',
                'ringkasan' => 'Dosen dan mahasiswa PPAk memberikan pelatihan intensif pencatatan transaksi kas digital dan penyusunan neraca sederhana guna mempermudah akses pembiayaan perbankan.',
                'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'id' => 2,
                'title' => 'Edukasi Manajemen Tata Kelola Keuangan dan Akuntabilitas Dana Desa Berbasis Sistem Terintegrasi',
                'lokasi' => 'Kecamatan Pacet, Kabupaten Mojokerto',
                'tahun' => '2024',
                'mitra' => 'Aparatur Desa dan Badan Usaha Milik Desa (BUMDes)',
                'ringkasan' => 'Penguatan kapabilitas aparatur desa dalam menerapkan prinsip transparansi, mitigasi risiko penatausahaan kas, dan pelaporan realisasi APBDes.',
                'image' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'id' => 3,
                'title' => 'Klinik Pajak Gratis: Bimbingan Pelaporan SPT Tahunan Orang Pribadi dan Edukasi e-Faktur bagi Pelaku Usaha Muda',
                'lokasi' => 'Kampus Ketintang UNESA',
                'tahun' => '2023',
                'mitra' => 'Tax Center FEB UNESA & KPP Pratama Surabaya',
                'ringkasan' => 'Layanan konsultasi sukarela yang melibatkan mahasiswa profesi untuk mendampingi masyarakat umum dalam memenuhi kewajiban pelaporan pajak.',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=600&q=80',
            ],
        ];
    }

    /**
     * Dokumen Unduhan Publik
     */
    public static function getUnduhan(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Buku Pedoman Akademik Program Pendidikan Profesi Akuntansi (PPAk) FEB UNESA',
                'kategori' => 'Pedoman Akademik',
                'tahun' => '2024',
                'format' => 'PDF',
                'size' => '2.4 MB',
                'filename' => 'Buku_Pedoman_Akademik_PPAk_FEB_UNESA_2024.pdf',
            ],
            [
                'id' => 2,
                'title' => 'Brosur Informasi Admisi & Program Studi PPAk FEB UNESA 2024/2025',
                'kategori' => 'Admisi & Brosur',
                'tahun' => '2024',
                'format' => 'PDF',
                'size' => '4.8 MB',
                'filename' => 'Brosur_Admisi_PPAk_FEB_UNESA_2024.pdf',
            ],
            [
                'id' => 3,
                'title' => 'Kalender Akademik PPAk Semester Gasal & Genap Tahun Akademik 2024/2025',
                'kategori' => 'Kalender',
                'tahun' => '2024',
                'format' => 'PDF',
                'size' => '850 KB',
                'filename' => 'Kalender_Akademik_PPAk_2024_2025.pdf',
            ],
            [
                'id' => 4,
                'title' => 'Panduan Penulisan & Format Capstone Project / Laporan Praktik Profesi',
                'kategori' => 'Pedoman Akademik',
                'tahun' => '2024',
                'format' => 'PDF',
                'size' => '1.6 MB',
                'filename' => 'Panduan_Capstone_Project_PPAk_2024.pdf',
            ],
            [
                'id' => 5,
                'title' => 'Formulir Pendaftaran Ujian Sertifikasi Profesi & Verifikasi Bebas Mata Kuliah (Waiver)',
                'kategori' => 'Formulir',
                'tahun' => '2024',
                'format' => 'DOCX',
                'size' => '420 KB',
                'filename' => 'Formulir_Pengajuan_Waiver_CA_2024.docx',
            ],
            [
                'id' => 6,
                'title' => 'Salinan Keputusan Akreditasi Program Studi PPAk FEB UNESA oleh Lembaga Akreditasi Mandiri',
                'kategori' => 'Akreditasi & Legalitas',
                'tahun' => '2024',
                'format' => 'PDF',
                'size' => '1.1 MB',
                'filename' => 'SK_Akreditasi_LAMEMBA_PPAk_UNESA.pdf',
            ],
        ];
    }

    /**
     * Galeri Dokumentasi Kegiatan
     */
    public static function getGaleri(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Sesi Perkuliahan Praktika Audit Berbantuan Komputer di Laboratorium Komputasi Akuntansi',
                'category' => 'akademik',
                'category_label' => 'Perkuliahan & Praktika',
                'date' => 'September 2024',
                'image' => '/images/audit_team_practice.jpg',
            ],
            [
                'id' => 2,
                'title' => 'Kuliah Tamu Eksekutif Bersama Praktisi Partner Kantor Akuntan Publik Internasional',
                'category' => 'seminar',
                'category_label' => 'Seminar & Kuliah Pakar',
                'date' => 'Agustus 2024',
                'image' => '/images/accounting_lecture.jpg',
            ],
            [
                'id' => 3,
                'title' => 'Yudisium dan Pengukuhan Gelar Profesi Akuntan (Ak.) Lulusan PPAk FEB UNESA',
                'category' => 'yudisium',
                'category_label' => 'Yudisium & Seremoni',
                'date' => 'Agustus 2024',
                'image' => '/images/unesa_campus_hero.jpg',
            ],
            [
                'id' => 4,
                'title' => 'Kunjungan Studi Profesional dan Benchmarking Mahasiswa ke Otoritas Jasa Keuangan & BEI',
                'category' => 'kunjungan',
                'category_label' => 'Kunjungan Industri',
                'date' => 'Juli 2024',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id' => 5,
                'title' => 'Workshop Intensif Persiapan Ujian Chartered Accountant Indonesia Bersama IAI Jawa Timur',
                'category' => 'seminar',
                'category_label' => 'Seminar & Kuliah Pakar',
                'date' => 'Juni 2024',
                'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id' => 6,
                'title' => 'Program Pengabdian Masyarakat Pendampingan Pencatatan Keuangan UMKM Mitra Binaan',
                'category' => 'pengabdian',
                'category_label' => 'Pengabdian Masyarakat',
                'date' => 'Mei 2024',
                'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80',
            ],
        ];
    }
}
