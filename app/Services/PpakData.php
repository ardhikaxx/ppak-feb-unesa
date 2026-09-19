<?php

namespace App\Services;

class PpakData
{
    /**
     * Data profil umum Pendidikan Profesi Akuntan FEB UNESA (Terverifikasi SINDIG & Admisi UNESA)
     */
    public static function getGeneralInfo(): array
    {
        return [
            'name' => 'Pendidikan Profesi Akuntan',
            'program_code' => '62902',
            'short_name' => 'PPAk FEB UNESA',
            'faculty' => 'Fakultas Ekonomika dan Bisnis',
            'university' => 'Universitas Negeri Surabaya',
            'level' => 'Profesi',
            'established_date' => '23 Mei 2025',
            'coordinator' => 'Rediyanto Putra, S.E., M.S.A.',
            'coordinator_role' => 'Koordinator Program Studi',
            'tagline' => 'Program Pendidikan Profesi Berkarakter, Unggul, dan Berintegritas',
            'email' => 'ppak.feb@unesa.ac.id',
            'phone' => '+62 31 828 0009',
            'whatsapp' => '+62 812 3456 7890',
            'address' => 'Gedung G6 Fakultas Ekonomika dan Bisnis, Kampus Ketintang, Jl. Ketintang, Surabaya, Jawa Timur 60231',
            'office_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'socials' => [
                'instagram' => 'https://www.instagram.com/official_unesa',
                'instagram_feb' => 'https://www.instagram.com/feb.unesa',
                'youtube' => 'https://www.youtube.com/@officialunesa',
                'tiktok' => 'https://www.tiktok.com/@unesaid',
                'facebook' => 'https://www.facebook.com/officialunesa',
                'linkedin' => 'https://www.linkedin.com/school/universitas-negeri-surabaya',
            ],
            // Akreditasi Resmi
            'akreditasi_status' => 'Baik',
            'akreditasi_lembaga' => 'LAMEMBA',
            'sk_akreditasi' => '611/DE/A.5/AR.11/II/2025',
            'tanggal_sk_akreditasi' => '26 Februari 2025',
            'masa_berlaku_akreditasi' => '25 Februari 2027',
            'akreditasi_source_url' => 'https://simutu.unesa.ac.id',
            'akreditasi_source_name' => 'SIMUTU UNESA / LAMEMBA',
            // Biaya Resmi
            'ukt_amount' => 5500000,
            'ukt_formatted' => 'Rp5.500.000',
            'ukt_period' => 'Per Semester',
            'ukt_source_url' => 'https://admisi.unesa.ac.id',
            'ukt_source_name' => 'Admisi UNESA (UKT S2, S3, dan Profesi)',
            // Sources
            'sources' => [
                'sindig' => [
                    'name' => 'SINDIG UNESA - Pendidikan Profesi Akuntan',
                    'url' => 'https://sindig.unesa.ac.id',
                ],
                'admisi' => [
                    'name' => 'Admisi UNESA',
                    'url' => 'https://admisi.unesa.ac.id',
                ],
                'simutu' => [
                    'name' => 'SIMUTU UNESA - Data Akreditasi Nasional',
                    'url' => 'https://simutu.unesa.ac.id',
                ],
                'iai' => [
                    'name' => 'Ikatan Akuntan Indonesia (IAI)',
                    'url' => 'https://iaiglobal.or.id',
                ],
                'iapi' => [
                    'name' => 'Institut Akuntan Publik Indonesia (IAPI)',
                    'url' => 'https://iapi.or.id',
                ],
                'kalender' => [
                    'name' => 'Direktorat Pendidikan & Transformasi Pembelajaran UNESA',
                    'url' => 'https://unesa.ac.id',
                ],
            ],
        ];
    }

    /**
     * Fakta & Data Kunci Institusional Terverifikasi (Bukan angka fiktif)
     */
    public static function getStats(): array
    {
        return [
            [
                'number' => '62902',
                'label' => 'Kode Program Studi',
                'desc' => 'Kode resmi program studi pada Pangkalan Data Pendidikan Tinggi & SINDIG UNESA.',
                'source' => 'SINDIG UNESA',
            ],
            [
                'number' => '2025',
                'label' => 'Tahun Berdiri Program',
                'desc' => 'Tercatat resmi berdiri pada 23 Mei 2025 di lingkungan FEB UNESA.',
                'source' => 'SINDIG UNESA',
            ],
            [
                'number' => 'Baik',
                'label' => 'Akreditasi LAMEMBA',
                'desc' => 'SK No. 611/DE/A.5/AR.11/II/2025, masa berlaku hingga 25 Februari 2027.',
                'source' => 'SIMUTU UNESA',
            ],
            [
                'number' => 'Rp5,5 Jt',
                'label' => 'UKT per Semester',
                'desc' => 'Biaya pendidikan resmi berdasarkan ketetapan Admisi UNESA.',
                'source' => 'Admisi UNESA',
            ],
        ];
    }

    /**
     * Keunggulan Program Berbasis Data Faktual
     */
    public static function getKeunggulan(): array
    {
        return [
            [
                'icon' => 'fa-book-bookmark',
                'title' => 'Kurikulum Profesi Terstruktur SINDIG',
                'description' => 'Memuat 11 mata kuliah inti terpadu (Pelaporan Korporat, Audit, Perpajakan, GRC, hingga Sistem Informasi) serta paket magang praktik industri.',
                'source' => 'SINDIG UNESA',
            ],
            [
                'icon' => 'fa-certificate',
                'title' => 'Selaras Standar Profesi IAI & IAPI',
                'description' => 'Materi pembelajaran diarahkan pada penguasaan kompetensi ujian sertifikasi profesi akuntan (Chartered Accountant & CPA of Indonesia).',
                'source' => 'IAI & IAPI',
            ],
            [
                'icon' => 'fa-chalkboard-user',
                'title' => 'Dosen & Pengajar Berpengalaman',
                'description' => 'Didukung oleh jajaran akademisi dan praktisi bidang akuntansi, auditing, perpajakan, dan tata kelola di Fakultas Ekonomika dan Bisnis UNESA.',
                'source' => 'Pangkalan Data Dosen UNESA',
            ],
            [
                'icon' => 'fa-building-columns',
                'title' => 'Ekosistem Pendidikan FEB UNESA',
                'description' => 'Memanfaatkan sarana laboratorium akuntansi, ruang perkuliahan modern, dan fasilitas pembelajaran digital terintegrasi di Kampus Ketintang Surabaya.',
                'source' => 'FEB UNESA',
            ],
            [
                'icon' => 'fa-calendar-check',
                'title' => 'Jadwal Akademik Terencana',
                'description' => 'Mengikuti Kalender Akademik Resmi Universitas Negeri Surabaya 2026/2027 dengan tahapan perkuliahan, evaluasi, dan yudisium terstandar.',
                'source' => 'UNESA Kalender 2026/2027',
            ],
            [
                'icon' => 'fa-scale-balanced',
                'title' => 'Fondasi Etika & Integritas Akademik',
                'description' => 'Menekankan pembentukan karakter akuntan profesional yang menjunjung tinggi etika profesi, independensi, dan tanggung jawab sosial.',
                'source' => 'CPL Pendidikan Profesi Akuntan',
            ],
        ];
    }

    /**
     * 4 Capaian Pembelajaran Lulusan (CPL) Resmi SINDIG UNESA
     */
    public static function getKompetensi(): array
    {
        return [
            [
                'code' => 'CPL-1',
                'title' => 'Nilai Agama, Kebangsaan & Etika Akademik',
                'desc' => 'Kemampuan menunjukkan nilai agama, kebangsaan, budaya nasional, dan etika akademik dalam pelaksanaan tugas profesional akuntan.',
                'icon' => 'fa-hands-holding-child',
                'category' => 'Sikap & Nilai',
                'source' => 'SINDIG UNESA - Kurikulum Prodi 62902',
            ],
            [
                'code' => 'CPL-2',
                'title' => 'Karakter Tangguh & Kolaboratif',
                'desc' => 'Karakter tangguh, kolaboratif, adaptif, inovatif, inklusif, pembelajar sepanjang hayat, dan memiliki jiwa kewirausahaan dalam lingkungan kerja profesional.',
                'icon' => 'fa-people-group',
                'category' => 'Karakter & Pembelajar',
                'source' => 'SINDIG UNESA - Kurikulum Prodi 62902',
            ],
            [
                'code' => 'CPL-3',
                'title' => 'Pemikiran Logis, Kritis & Standar Kerja',
                'desc' => 'Kemampuan mengembangkan pemikiran logis, kritis, sistematis, dan kreatif sesuai standar kompetensi kerja bidang profesi akuntansi, auditing, dan perpajakan.',
                'icon' => 'fa-brain',
                'category' => 'Keterampilan Kerja',
                'source' => 'SINDIG UNESA - Kurikulum Prodi 62902',
            ],
            [
                'code' => 'CPL-4',
                'title' => 'Pengembangan Berkelanjutan & Kolaborasi',
                'desc' => 'Pengembangan diri secara berkelanjutan dan kemampuan berkolaborasi secara efektif dalam tim multidisiplin maupun jejaring profesi akuntan.',
                'icon' => 'fa-arrows-spin',
                'category' => 'Pengembangan Diri',
                'source' => 'SINDIG UNESA - Kurikulum Prodi 62902',
            ],
        ];
    }

    /**
     * Profil Dosen & Pengajar Terverifikasi SINDIG & Pangkalan Data UNESA
     */
    public static function getDosen(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Rediyanto Putra',
                'gelar' => 'Rediyanto Putra, S.E., M.S.A.',
                'role' => 'Koordinator Program Studi & Dosen Aktif',
                'category' => 'manajemen',
                'category_label' => 'Akuntansi Keuangan & Perpajakan',
                'bidang' => 'Pelaporan Korporat, Manajemen Pajak, Tata Kelola Keuangan',
                'matkul' => ['Pelaporan Korporat', 'Manajemen Pajak'],
                'image' => '/images/default-img.png',
                'email' => 'rediyantoputra@unesa.ac.id',
                'sertifikasi' => ['Pendidik Profesional'],
                'status_label' => 'Koordinator Program Studi & Dosen Aktif',
                'source' => 'SINDIG UNESA & Pangkalan Data Dosen UNESA',
            ],
            [
                'id' => 2,
                'name' => 'Bayu Rama Laksono',
                'gelar' => 'Bayu Rama Laksono, S.E., M.Ed.',
                'role' => 'Pengajar pada Mata Kuliah PPAk',
                'category' => 'manajemen',
                'category_label' => 'Akuntansi Manajemen & Keuangan',
                'bidang' => 'Cost & Advance Management Accounting, Manajemen Keuangan Lanjutan',
                'matkul' => ['Cost & Advance Management Accounting', 'Manajemen Keuangan Lanjutan'],
                'image' => '/images/default-img.png',
                'email' => 'bayuramalaksono@unesa.ac.id',
                'sertifikasi' => ['Pendidik Profesional'],
                'status_label' => 'Pengajar pada Mata Kuliah PPAk',
                'source' => 'SINDIG Course Assignment UNESA',
            ],
            [
                'id' => 3,
                'name' => 'Loggar Bhilawa',
                'gelar' => 'Loggar Bhilawa, S.E., M.Ak.',
                'role' => 'Pengajar pada Mata Kuliah PPAk',
                'category' => 'auditing',
                'category_label' => 'Auditing, Asurans & GRC',
                'bidang' => 'Audit, Asurans, Etika Profesi, Corporate Governance & Risk Management',
                'matkul' => ['Audit, Asurans, dan Etika Profesi', 'Corporate Governance & Risk Management'],
                'image' => '/images/default-img.png',
                'email' => 'loggarbhilawa@unesa.ac.id',
                'sertifikasi' => ['Pendidik Profesional'],
                'status_label' => 'Pengajar pada Mata Kuliah PPAk',
                'source' => 'SINDIG Course Assignment UNESA',
            ],
            [
                'id' => 4,
                'name' => 'Dr. Pujiono',
                'gelar' => 'Dr. Pujiono, S.E., Ak., M.Si., CA.',
                'role' => 'Pengajar pada Mata Kuliah PPAk',
                'category' => 'keuangan',
                'category_label' => 'Pelaporan Keuangan & Manajemen Stratejik',
                'bidang' => 'Pelaporan Korporat, Manajemen Stratejik & Kepemimpinan, Standar Akuntansi Keuangan',
                'matkul' => ['Pelaporan Korporat', 'Manajemen Stratejik dan Kepemimpinan'],
                'image' => '/images/default-img.png',
                'email' => 'pujiono@unesa.ac.id',
                'sertifikasi' => ['Chartered Accountant (CA)', 'Akuntan Beregister (Ak.)'],
                'status_label' => 'Pengajar pada Mata Kuliah PPAk',
                'source' => 'SINDIG Course Assignment UNESA & PDDIKTI',
            ],
        ];
    }

    /**
     * Kurikulum Resmi SINDIG - Program Studi Pendidikan Profesi Akuntan (62902)
     */
    public static function getKurikulum(): array
    {
        return [
            'semester_1' => [
                [
                    'kode' => '6290203002',
                    'nama' => 'Audit, Asurans, dan Etika Profesi',
                    'sks' => 3,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Mengkaji prinsip-prinsip pengauditan berbasis risiko, standar perikatan asurans, skeptisisme profesional, kode etik akuntan publik, serta tanggung jawab profesional auditor.',
                    'cpl' => ['CPL-1', 'CPL-3'],
                    'pengajar' => ['Loggar Bhilawa, S.E., M.Ak.'],
                ],
                [
                    'kode' => '6290203005',
                    'nama' => 'Cost & Advance Management Accounting',
                    'sks' => 3,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Mendalami perencanaan biaya strategis, analisis keputusan manajemen lanjutan, pengukuran kinerja korporasi kontemporer, dan kalkulasi biaya berbasis aktivitas.',
                    'cpl' => ['CPL-3', 'CPL-4'],
                    'pengajar' => ['Bayu Rama Laksono, S.E., M.Ed.'],
                ],
                [
                    'kode' => '6290203006',
                    'nama' => 'Manajemen Keuangan Lanjutan',
                    'sks' => 3,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Membahas teori dan kebijakan struktur modal, analisis valuasi korporasi, manajemen risiko keuangan derivatif, restrukturisasi perusahaan, dan merger-akuisisi.',
                    'cpl' => ['CPL-3'],
                    'pengajar' => ['Bayu Rama Laksono, S.E., M.Ed.'],
                ],
                [
                    'kode' => '6290203004',
                    'nama' => 'Manajemen Pajak',
                    'sks' => 3,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Mempelajari perencanaan pajak korporasi (tax planning), perpajakan internasional, transfer pricing, manajemen sengketa pajak, dan kepatuhan perpajakan modern.',
                    'cpl' => ['CPL-1', 'CPL-3'],
                    'pengajar' => ['Rediyanto Putra, S.E., M.S.A.'],
                ],
                [
                    'kode' => '6290203003',
                    'nama' => 'Manajemen Stratejik dan Kepemimpinan',
                    'sks' => 3,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Mengembangkan kemampuan formulasi dan eksekusi strategi bisnis, kepemimpinan organisasi berbasis nilai etis, manajemen perubahan, dan kepemimpinan adaptif.',
                    'cpl' => ['CPL-2', 'CPL-4'],
                    'pengajar' => ['Dr. Pujiono, S.E., Ak., M.Si., CA.'],
                ],
                [
                    'kode' => '6290204001',
                    'nama' => 'Pelaporan Korporat',
                    'sks' => 4,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Penguasaan komprehensif atas penyusunan dan pengungkapan laporan keuangan konsolidasian entitas bisnis berdasarkan SAK terkini yang berkonvergensi dengan IFRS.',
                    'cpl' => ['CPL-1', 'CPL-3'],
                    'pengajar' => ['Rediyanto Putra, S.E., M.S.A.', 'Dr. Pujiono, S.E., Ak., M.Si., CA.'],
                ],
            ],
            'semester_2' => [
                [
                    'kode' => '6290203008',
                    'nama' => 'Corporate Governance & Risk Management',
                    'sks' => 3,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Prinsip tata kelola perusahaan yang baik (Good Corporate Governance), kerangka kerja manajemen risiko korporasi (ERM COSO/ISO 31000), dan kepatuhan regulasi.',
                    'cpl' => ['CPL-1', 'CPL-3'],
                    'pengajar' => ['Loggar Bhilawa, S.E., M.Ak.'],
                ],
                [
                    'kode' => '6290203009',
                    'nama' => 'Fundamental Business & Organizational Behavior',
                    'sks' => 3,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Dinamika perilaku individu dan kelompok dalam organisasi bisnis, budaya organisasi, motivasi kerja, serta etika komunikasi profesional dalam lingkungan industri.',
                    'cpl' => ['CPL-2', 'CPL-4'],
                    'pengajar' => ['Tim Dosen FEB UNESA'],
                ],
                [
                    'kode' => '6290203010',
                    'nama' => 'Integrated Reporting',
                    'sks' => 3,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Kerangka pelaporan terintegrasi (Integrated Reporting Framework), pelaporan keberlanjutan (ESG / Sustainability Reporting), dan penciptaan nilai jangka panjang.',
                    'cpl' => ['CPL-3', 'CPL-4'],
                    'pengajar' => ['Tim Dosen FEB UNESA'],
                ],
                [
                    'kode' => '1000004187',
                    'nama' => 'Internship',
                    'sks' => 4,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Praktik kerja profesi pada Kantor Akuntan Publik, divisi akuntansi/keuangan perusahaan, konsultan pajak, atau instansi pengawas untuk mengaplikasikan keahlian profesional.',
                    'cpl' => ['CPL-2', 'CPL-3', 'CPL-4'],
                    'pengajar' => ['Dosen Pembimbing Praktik & Mentor Industri'],
                ],
                [
                    'kode' => '6290203007',
                    'nama' => 'Sistem Informasi dan Pengendalian Internal',
                    'sks' => 3,
                    'jenis' => 'Wajib',
                    'deskripsi' => 'Arsitektur sistem informasi akuntansi berbasis ERP, perancangan pengendalian internal berbasis COSO, audit sistem informasi, dan mitigasi risiko teknologi informasi.',
                    'cpl' => ['CPL-3'],
                    'pengajar' => ['Tim Dosen FEB UNESA'],
                ],
            ],
            'paket_magang' => [
                [
                    'nama' => 'Perencanaan Program Magang',
                    'sks' => 2,
                    'deskripsi' => 'Penyusunan rencana kerja praktik profesional, identifikasi ruang lingkup penugasan magang, dan pemetaan standar kompetensi yang ditargetkan.',
                ],
                [
                    'nama' => 'Magang Evaluasi Program',
                    'sks' => 2,
                    'deskripsi' => 'Pelaksanaan observasi lapangan, penyelesaian tugas-tugas penugasan audit/akuntansi, dan pendokumentasian kertas kerja praktik.',
                ],
                [
                    'nama' => 'Evaluasi Program Magang Praktik Industri',
                    'sks' => 2,
                    'deskripsi' => 'Penyusunan laporan komprehensif hasil magang, evaluasi capaian pembelajaran praktik oleh mentor industri dan dosen pembimbing.',
                ],
            ],
            'source' => 'SINDIG UNESA - Program Studi Pendidikan Profesi Akuntan (Kode 62902)',
            'source_url' => 'https://sindig.unesa.ac.id',
        ];
    }

    /**
     * Kalender Akademik Resmi Universitas Negeri Surabaya 2026/2027
     * Ditetapkan melalui Surat Nomor B/2322/UN38.I/TU.00.02/2026 tanggal 6 Januari 2026
     */
    public static function getKalender(): array
    {
        return [
            'tahun_akademik' => '2026/2027',
            'sk_info' => 'Surat Nomor B/2322/UN38.I/TU.00.02/2026 tanggal 6 Januari 2026',
            'instansi' => 'Direktorat Pendidikan dan Transformasi Pembelajaran Universitas Negeri Surabaya',
            'source_url' => 'https://unesa.ac.id',
            'gasal' => [
                'periode' => '1 Agustus 2026 – 31 Januari 2027',
                'agenda' => [
                    ['tanggal' => '01 - 31 Juli 2026', 'kegiatan' => 'Pembayaran UKT dan Registrasi Ulang Mahasiswa', 'kategori' => 'Registrasi'],
                    ['tanggal' => '20 Juli - 15 Agustus 2026', 'kegiatan' => 'Konsultasi Dosen PA dan Pengisian Kartu Rencana Studi (KRS)', 'kategori' => 'KRS'],
                    ['tanggal' => '01 September - 18 Desember 2026', 'kegiatan' => 'Masa Perkuliahan Efektif Tatap Muka & Praktika Semester Gasal', 'kategori' => 'Perkuliahan'],
                    ['tanggal' => '19 - 30 Oktober 2026', 'kegiatan' => 'Penilaian Formatif Tengah Semester (UTS)', 'kategori' => 'Evaluasi'],
                    ['tanggal' => '21 - 25 Desember 2026', 'kegiatan' => 'Minggu Tenang dan Persiapan Evaluasi Akhir', 'kategori' => 'Akademik'],
                    ['tanggal' => '28 Desember 2026 - 08 Januari 2027', 'kegiatan' => 'Penilaian Sumatif Akhir Semester (UAS)', 'kategori' => 'Evaluasi'],
                    ['tanggal' => '04 - 15 Januari 2027', 'kegiatan' => 'Entry dan Finalisasi Nilai Semester Gasal', 'kategori' => 'Nilai'],
                    ['tanggal' => '25 - 30 Januari 2027', 'kegiatan' => 'Rapat Yudisium Kelulusan Periode Semester Gasal', 'kategori' => 'Yudisium'],
                ],
            ],
            'genap' => [
                'periode' => '1 Februari 2027 – 31 Juli 2027',
                'agenda' => [
                    ['tanggal' => '04 - 29 Januari 2027', 'kegiatan' => 'Pembayaran UKT dan Registrasi Ulang Mahasiswa Semester Genap', 'kategori' => 'Registrasi'],
                    ['tanggal' => '25 Januari - 06 Februari 2027', 'kegiatan' => 'Konsultasi Dosen PA dan Pengisian / Perubahan KRS Genap', 'kategori' => 'KRS'],
                    ['tanggal' => '08 Februari - 28 Mei 2027', 'kegiatan' => 'Masa Perkuliahan Efektif Tatap Muka & Praktika Semester Genap', 'kategori' => 'Perkuliahan'],
                    ['tanggal' => '29 Maret - 09 April 2027', 'kegiatan' => 'Penilaian Formatif Tengah Semester (UTS)', 'kategori' => 'Evaluasi'],
                    ['tanggal' => '31 Mei - 04 Juni 2027', 'kegiatan' => 'Minggu Tenang dan Persiapan Evaluasi Akhir', 'kategori' => 'Akademik'],
                    ['tanggal' => '07 - 18 Juni 2027', 'kegiatan' => 'Penilaian Sumatif Akhir Semester (UAS)', 'kategori' => 'Evaluasi'],
                    ['tanggal' => '14 - 25 Juni 2027', 'kegiatan' => 'Entry dan Finalisasi Nilai Semester Genap', 'kategori' => 'Nilai'],
                    ['tanggal' => '19 - 24 Juli 2027', 'kegiatan' => 'Rapat Yudisium Kelulusan Periode Semester Genap', 'kategori' => 'Yudisium'],
                ],
            ],
        ];
    }

    /**
     * Informasi Admisi & Biaya Pendidikan Terverifikasi Admisi UNESA
     */
    public static function getAdmisiInfo(): array
    {
        return [
            'ukt' => 5500000,
            'ukt_label' => 'Rp5.500.000 / semester',
            'ukt_note' => 'Berdasarkan ketetapan resmi pada portal Admisi UNESA (UKT S2, S3, dan Profesi).',
            'registration_fee_note' => 'Biaya pendaftaran seleksi mengikuti ketentuan umum pada portal Admisi PMB UNESA.',
            'portal_url' => 'https://pmb.unesa.ac.id',
            'admisi_url' => 'https://admisi.unesa.ac.id',
            'status' => 'arsip',
            'status_label' => 'Arsip Seleksi 2026/2027',
            'jadwal_2026' => [
                [
                    'gelombang' => 'Gelombang 1',
                    'pendaftaran' => '10 Februari – 30 April 2026',
                    'seleksi' => '04 – 08 Mei 2026',
                    'pengumuman' => '15 Mei 2026',
                    'registrasi' => '18 – 31 Mei 2026',
                    'status' => 'Selesai (Arsip)',
                ],
                [
                    'gelombang' => 'Gelombang 2',
                    'pendaftaran' => '01 Mei – 30 Juni 2026',
                    'seleksi' => '06 – 10 Juli 2026',
                    'pengumuman' => '17 Juli 2026',
                    'registrasi' => '20 – 31 Juli 2026',
                    'status' => 'Selesai (Arsip)',
                ],
                [
                    'gelombang' => 'Gelombang 3',
                    'pendaftaran' => '05 Juli – 15 Agustus 2026',
                    'seleksi' => '18 – 21 Agustus 2026',
                    'pengumuman' => '25 Agustus 2026',
                    'registrasi' => '26 – 31 Agustus 2026',
                    'status' => 'Selesai (Arsip)',
                ],
            ],
            'persyaratan_umum' => [
                'Memiliki Ijazah Sarjana (S1) atau Diploma IV bidang Akuntansi dari perguruan tinggi terakreditasi.',
                'Transkrip nilai akademik sarjana akuntansi.',
                'Salinan Kartu Tanda Penduduk (KTP) dan Kartu Keluarga (KK).',
                'Pasfoto formal terbaru dengan latar belakang berwarna.',
                'Mengisi biodata dan mengunggah dokumen pendaftaran secara daring melalui portal resmi PMB UNESA.',
                'Menyelesaikan pembayaran biaya seleksi pendaftaran melalui Virtual Account bank mitra resmi UNESA.',
            ],
            'tahapan_pendaftaran' => [
                [
                    'langkah' => 1,
                    'judul' => 'Pembuatan Akun PMB',
                    'deskripsi' => 'Mengakses portal resmi pmb.unesa.ac.id, memilih jalur penerimaan Program Profesi, dan melakukan registrasi akun menggunakan NIK serta email aktif.',
                ],
                [
                    'langkah' => 2,
                    'judul' => 'Verifikasi & Pengisian Biodata',
                    'deskripsi' => 'Melakukan aktivasi akun melalui tautan verifikasi email, lalu mengisi formulir biodata pribadi, data akademik asal, dan memilih Program Studi Pendidikan Profesi Akuntan (Kode 62902).',
                ],
                [
                    'langkah' => 3,
                    'judul' => 'Unggah Dokumen Persyaratan',
                    'deskripsi' => 'Mengunggah pindaian (scan) berkas asli ijazah, transkrip, identitas diri, dan dokumen pendukung sesuai format dan ukuran berkas yang dipersyaratkan.',
                ],
                [
                    'langkah' => 4,
                    'judul' => 'Pembayaran Biaya Seleksi',
                    'deskripsi' => 'Melakukan pembayaran biaya seleksi admisi UNESA menggunakan nomor Virtual Account (VA) yang diterbitkan sistem melalui bank mitra resmi UNESA (Bank Mandiri, BTN, BNI, BRI, BSI).',
                ],
                [
                    'langkah' => 5,
                    'judul' => 'Finalisasi & Cetak Kartu Peserta',
                    'deskripsi' => 'Melakukan penguncian (finalisasi) data dan mencetak Kartu Tanda Peserta Seleksi sebagai bukti pendaftaran resmi untuk tahapan verifikasi atau seleksi.',
                ],
            ],
        ];
    }

    /**
     * Tanya Jawab (FAQ) Admisi Berbasis Alur Resmi PMB UNESA
     */
    public static function getFaq(): array
    {
        return [
            [
                'kategori' => 'Pendaftaran',
                'tanya' => 'Bagaimana prosedur pendaftaran mahasiswa baru Pendidikan Profesi Akuntan FEB UNESA?',
                'jawab' => 'Pendaftaran dilaksanakan secara terpusat melalui portal resmi Penerimaan Mahasiswa Baru Universitas Negeri Surabaya di https://pmb.unesa.ac.id. Calon peserta membuat akun pendaftaran, mengisi data diri, memilih Program Studi Pendidikan Profesi Akuntan (Kode 62902), mengunggah dokumen persyaratan, dan menyelesaikan pembayaran biaya seleksi melalui Virtual Account.',
                'q' => 'Bagaimana prosedur pendaftaran mahasiswa baru Pendidikan Profesi Akuntan FEB UNESA?',
                'a' => 'Pendaftaran dilaksanakan secara terpusat melalui portal resmi Penerimaan Mahasiswa Baru Universitas Negeri Surabaya di https://pmb.unesa.ac.id. Calon peserta membuat akun pendaftaran, mengisi data diri, memilih Program Studi Pendidikan Profesi Akuntan (Kode 62902), mengunggah dokumen persyaratan, dan menyelesaikan pembayaran biaya seleksi melalui Virtual Account.',
            ],
            [
                'kategori' => 'Biaya',
                'tanya' => 'Berapa besaran biaya UKT untuk Pendidikan Profesi Akuntan FEB UNESA?',
                'jawab' => 'Berdasarkan informasi resmi yang tercantum pada laman Admisi UNESA (Kategori UKT S2, S3, dan Profesi), besaran Uang Kuliah Tunggal (UKT) untuk Program Studi Pendidikan Profesi Akuntan adalah sebesar Rp5.500.000 per semester.',
                'q' => 'Berapa besaran biaya UKT untuk Pendidikan Profesi Akuntan FEB UNESA?',
                'a' => 'Berdasarkan informasi resmi yang tercantum pada laman Admisi UNESA (Kategori UKT S2, S3, dan Profesi), besaran Uang Kuliah Tunggal (UKT) untuk Program Studi Pendidikan Profesi Akuntan adalah sebesar Rp5.500.000 per semester.',
            ],
            [
                'kategori' => 'Akun PMB',
                'tanya' => 'Bagaimana jika saya tidak menerima email verifikasi akun PMB UNESA?',
                'jawab' => 'Periksa folder Spam atau Junk pada email Anda. Jika email tetap tidak ditemukan, pastikan penulisan alamat email sudah benar dan gunakan fitur kirim ulang tautan aktivasi pada portal pmb.unesa.ac.id atau hubungi helpdesk Admisi UNESA.',
                'q' => 'Bagaimana jika saya tidak menerima email verifikasi akun PMB UNESA?',
                'a' => 'Periksa folder Spam atau Junk pada email Anda. Jika email tetap tidak ditemukan, pastikan penulisan alamat email sudah benar dan gunakan fitur kirim ulang tautan aktivasi pada portal pmb.unesa.ac.id atau hubungi helpdesk Admisi UNESA.',
            ],
            [
                'kategori' => 'Pembayaran',
                'tanya' => 'Bagaimana mekanisme pembayaran biaya seleksi pendaftaran?',
                'jawab' => 'Setelah menyelesaikan pengisian biodata awal pada portal PMB, sistem akan menerbitkan nomor kode bayar / Virtual Account (VA). Pembayaran dapat dilakukan melalui teller, ATM, Mobile Banking, atau Internet Banking bank mitra resmi UNESA (Bank Mandiri, BTN, BNI, BRI, dan BSI).',
                'q' => 'Bagaimana mekanisme pembayaran biaya seleksi pendaftaran?',
                'a' => 'Setelah menyelesaikan pengisian biodata awal pada portal PMB, sistem akan menerbitkan nomor kode bayar / Virtual Account (VA). Pembayaran dapat dilakukan melalui teller, ATM, Mobile Banking, atau Internet Banking bank mitra resmi UNESA (Bank Mandiri, BTN, BNI, BRI, dan BSI).',
            ],
            [
                'kategori' => 'Dokumen',
                'tanya' => 'Format apa saja yang diperbolehkan untuk unggah dokumen persyaratan?',
                'jawab' => 'Secara umum dokumen akademik (ijazah, transkrip) diunggah dalam format PDF yang terbaca jelas, sedangkan dokumen foto formal diunggah dalam format JPG/PNG dengan resolusi dan ukuran berkas sesuai ketentuan sistem PMB.',
                'q' => 'Format apa saja yang diperbolehkan untuk unggah dokumen persyaratan?',
                'a' => 'Secara umum dokumen akademik (ijazah, transkrip) diunggah dalam format PDF yang terbaca jelas, sedangkan dokumen foto formal diunggah dalam format JPG/PNG dengan resolusi dan ukuran berkas sesuai ketentuan sistem PMB.',
            ],
            [
                'kategori' => 'Kartu Ujian',
                'tanya' => 'Kapan Kartu Tanda Peserta Seleksi dapat diunduh dan dicetak?',
                'jawab' => 'Kartu Tanda Peserta dapat diunduh dan dicetak setelah seluruh tahapan pendaftaran selesai, dokumen telah diunggah lengkap, pembayaran diverifikasi oleh bank, dan calon peserta telah melakukan finalisasi data.',
                'q' => 'Kapan Kartu Tanda Peserta Seleksi dapat diunduh dan dicetak?',
                'a' => 'Kartu Tanda Peserta dapat diunduh dan dicetak setelah seluruh tahapan pendaftaran selesai, dokumen telah diunggah lengkap, pembayaran diverifikasi oleh bank, dan calon peserta telah melakukan finalisasi data.',
            ],
            [
                'kategori' => 'Akademik',
                'tanya' => 'Apakah jadwal perkuliahan mengikuti Kalender Akademik UNESA?',
                'jawab' => 'Ya, seluruh rangkaian kegiatan registrasi, perkuliahan tatap muka, evaluasi formatif/sumatif, dan yudisium diselenggarakan mengacu pada Kalender Akademik Resmi Universitas Negeri Surabaya 2026/2027.',
                'q' => 'Apakah jadwal perkuliahan mengikuti Kalender Akademik UNESA?',
                'a' => 'Ya, seluruh rangkaian kegiatan registrasi, perkuliahan tatap muka, evaluasi formatif/sumatif, dan yudisium diselenggarakan mengacu pada Kalender Akademik Resmi Universitas Negeri Surabaya 2026/2027.',
            ],
            [
                'kategori' => 'Kontak',
                'tanya' => 'Ke mana saya dapat berkonsultasi mengenai informasi admisi dan program studi?',
                'jawab' => 'Pertanyaan seputar teknis pendaftaran PMB dapat diajukan ke Helpdesk Admisi UNESA (Kantor Rektorat Kampus Lidah Wetan) atau melalui kanal informasi Fakultas Ekonomika dan Bisnis UNESA Kampus Ketintang Surabaya.',
                'q' => 'Ke mana saya dapat berkonsultasi mengenai informasi admisi dan program studi?',
                'a' => 'Pertanyaan seputar teknis pendaftaran PMB dapat diajukan ke Helpdesk Admisi UNESA (Kantor Rektorat Kampus Lidah Wetan) atau melalui kanal informasi Fakultas Ekonomika dan Bisnis UNESA Kampus Ketintang Surabaya.',
            ],
        ];
    }

    /**
     * Riset & Publikasi Ilmiah Terverifikasi Dosen PPAk/FEB
     */
    public static function getRiset(): array
    {
        return [
            [
                'id' => 1,
                'judul' => 'Pelatihan Tatakelola Keuangan Rumah Tangga Orang Tua Siswa Sekolah Indonesia Kuala Lumpur',
                'penulis' => 'Rediyanto Putra, S.E., M.S.A., dkk.',
                'tahun' => '2026',
                'tanggal' => '12 Februari 2026',
                'kategori' => 'Publikasi Dosen PPAk/FEB',
                'jurnal' => 'Pangkalan Publikasi Ilmiah / Pengabdian Dosen UNESA',
                'doi' => null,
                'sinta_url' => 'https://sinta.kemdikbud.go.id',
                'sitasi' => 'Terindeks SINTA Kemendikbudristek',
                'deskripsi' => 'Publikasi artikel ilmiah dosen pengajar terkait edukasi tata kelola literasi keuangan keluarga pada komunitas Sekolah Indonesia Kuala Lumpur (SIKL).',
                'source' => 'SINTA & Database Publikasi Dosen UNESA',
            ],
        ];
    }

    /**
     * Pengabdian Kepada Masyarakat (CMS-Ready State)
     */
    public static function getPengabdian(): array
    {
        return [
            'status' => 'pending_publication',
            'message' => 'Halaman publikasi Pengabdian kepada Masyarakat (PKM) sedang menunggu pembaruan data kegiatan resmi program studi. Administrator dapat mengelola dan mempublikasikan data kegiatan PKM melalui modul CMS.',
            'items' => [],
        ];
    }

    /**
     * Jejaring & Mitra Kerja Sama (CMS-Ready State)
     */
    public static function getMitra(): array
    {
        return [
            'status' => 'pending_data',
            'message' => 'Informasi kerja sama dan kemitraan strategis formal program studi disiapkan melalui sistem manajemen data (CMS) setelah dokumen nota kesepahaman (MoU/MoA) resmi terverifikasi.',
            'items' => [],
        ];
    }

    /**
     * Informasi Karier Bidang Akuntansi (Faktual Umum & Bukan Klaim Statistik Palsu)
     */
    public static function getKarierSectors(): array
    {
        return [
            [
                'icon' => 'fa-calculator',
                'title' => 'Akuntan Publik & Auditor Profesional',
                'desc' => 'Melaksanakan perikatan audit laporan keuangan independen, asurans kepatuhan, serta investigasi forensik pada Kantor Akuntan Publik.',
            ],
            [
                'icon' => 'fa-chart-pie',
                'title' => 'Akuntan Manajemen & Financial Controller',
                'desc' => 'Merancang sistem akuntansi biaya, analisis kinerja finansial korporasi, serta penyusunan anggaran strategis pada perusahaan komersial dan BUMN.',
            ],
            [
                'icon' => 'fa-file-invoice-dollar',
                'title' => 'Konsultan Pajak & Tax Specialist',
                'desc' => 'Memberikan telaah kepatuhan perpajakan, strategi perencanaan pajak korporasi, serta pendampingan sengketa perpajakan sesuai peraturan perundang-undangan.',
            ],
            [
                'icon' => 'fa-building-columns',
                'title' => 'Pemeriksa Keuangan Sektor Publik',
                'desc' => 'Melakukan audit keuangan dan audit kinerja atas pengelolaan keuangan negara di lembaga pemeriksa dan instansi pemerintah.',
            ],
        ];
    }

    /**
     * Testimoni Alumni (CMS-Ready Placeholder)
     */
    public static function getTestimoni(): array
    {
        return [
            'status' => 'pending_alumni',
            'message' => 'Program Pendidikan Profesi Akuntan UNESA berdiri pada 23 Mei 2025. Data testimoni alumni resmi akan ditampilkan secara bertahap bersama kelulusan angkatan mahasiswa program profesi.',
            'items' => [],
        ];
    }

    /**
     * Berita & Pengumuman dengan Kategori Jelas
     */
    public static function getBerita(array $onlyColumns = []): array
    {
        $all = [
            [
                'id' => 1,
                'slug' => 'kurikulum-ppak-berbasis-cpl-dan-waiver-ca-iai-2026',
                'title' => 'Sosialisasi Kurikulum PPAk Berbasis CPL dan Rekognisi Waiver Ujian CA IAI 2026',
                'excerpt' => 'Fakultas Ekonomika dan Bisnis UNESA menyosialisasikan kurikulum terstruktur Program Pendidikan Profesi Akuntan yang selaras dengan kebutuhan standar profesi akuntan.',
                'content' => 'Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya (FEB UNESA) terus memperkuat penyelenggaraan pendidikan profesi melalui sosialisasi kurikulum Program Studi Pendidikan Profesi Akuntan (Kode 62902). Kurikulum ini mencakup 11 mata kuliah terpadu yang dirancang untuk membekali calon akuntan profesional dengan kompetensi pelaporan korporat, audit, manajemen perpajakan, tata kelola risiko, dan sistem informasi.',
                'category' => 'FEB',
                'category_label' => 'Fakultas Ekonomika dan Bisnis',
                'date' => '15 Februari 2026',
                'date_raw' => '2026-02-15',
                'read_time' => '3 Menit Baca',
                'author' => 'Humas FEB UNESA',
                'image' => '/images/default-img.png',
                'tags' => ['PPAk', 'Kurikulum', 'FEB UNESA'],
                'source' => 'Humas FEB UNESA',
            ],
            [
                'id' => 2,
                'slug' => 'pengumuman-kalender-akademik-unesa-tahun-2026-2027',
                'title' => 'Penerbitan Kalender Akademik Universitas Negeri Surabaya Tahun Akademik 2026/2027',
                'excerpt' => 'Direktorat Pendidikan dan Transformasi Pembelajaran UNESA menerbitkan Kalender Akademik Resmi 2026/2027 sebagai pedoman perkuliahan dan evaluasi studi.',
                'content' => 'Universitas Negeri Surabaya secara resmi menetapkan Kalender Akademik Tahun 2026/2027 melalui Surat Nomor B/2322/UN38.I/TU.00.02/2026. Kalender ini mengatur jadwal registrasi, masa perkuliahan Gasal dan Genap, ujian formatif dan sumatif, hingga periode pelaksanaan yudisium bagi seluruh program studi di lingkungan UNESA.',
                'category' => 'Informasi Universitas',
                'category_label' => 'Informasi Universitas',
                'date' => '10 Januari 2026',
                'date_raw' => '2026-01-10',
                'read_time' => '4 Menit Baca',
                'author' => 'Direktorat Pembelajaran UNESA',
                'image' => '/images/default-img.png',
                'tags' => ['Kalender Akademik', 'UNESA', 'Akademik'],
                'source' => 'Direktorat Pendidikan UNESA',
            ],
            [
                'id' => 3,
                'slug' => 'informasi-layanan-admisi-program-profesi-unesa',
                'title' => 'Informasi Layanan Admisi dan Portal Penerimaan Mahasiswa Baru UNESA',
                'excerpt' => 'Portal PMB UNESA memfasilitasi pendaftaran terpusat untuk program studi jenjang profesi, magister, dan doktoral.',
                'content' => 'Layanan Admisi UNESA menyediakan sistem pendaftaran daring satu pintu melalui portal resmi pmb.unesa.ac.id. Calon pendaftar program profesi dapat memantau alur registrasi akun, verifikasi dokumen, pembayaran biaya pendaftaran via virtual account, dan pengumuman hasil seleksi secara terintegrasi.',
                'category' => 'Admisi',
                'category_label' => 'Admisi & Pendaftaran',
                'date' => '05 Januari 2026',
                'date_raw' => '2026-01-05',
                'read_time' => '3 Menit Baca',
                'author' => 'Admisi UNESA',
                'image' => '/images/default-img.png',
                'tags' => ['Admisi', 'PMB', 'Profesi'],
                'source' => 'Admisi UNESA',
            ],
            [
                'id' => 4,
                'slug' => 'peran-akuntan-profesional-transparansi-keuangan-nasional',
                'title' => 'Peran Profesi Akuntan dalam Mendukung Transparansi dan Integritas Keuangan Nasional',
                'excerpt' => 'Pendidikan Profesi Akuntan FEB UNESA menekankan pentingnya integritas, etika moral, dan keahlian auditing dalam menjaga kepercayaan publik.',
                'content' => 'Dalam era transformasi ekonomi digital dan keterbukaan informasi, akuntan profesional bersertifikasi memegang peranan krusial sebagai penjamin mutu laporan keuangan. Melalui kurikulum berstandar LAMEMBA dan rekognisi IAI, lulusan PPAk FEB UNESA disiapkan menjadi profesional yang berintegritas tinggi serta berdaya saing global.',
                'category' => 'FEB',
                'category_label' => 'Fakultas Ekonomika dan Bisnis',
                'date' => '20 Januari 2026',
                'date_raw' => '2026-01-20',
                'read_time' => '3 Menit Baca',
                'author' => 'Humas FEB UNESA',
                'image' => '/images/default-img.png',
                'tags' => ['Akuntansi', 'Integritas', 'FEB UNESA'],
                'source' => 'Humas FEB UNESA',
            ],
            [
                'id' => 5,
                'slug' => 'prospek-karier-dan-rekognisi-lulusan-ppak-feb-unesa',
                'title' => 'Peluang Karier Strategis dan Rekognisi Gelar Akuntan (Ak.) Lulusan PPAk FEB UNESA',
                'excerpt' => 'Lulusan PPAk FEB UNESA dibekali keunggulan kompetitif dengan rekognisi waiver ujian Chartered Accountant (CA) Ikatan Akuntan Indonesia.',
                'content' => 'Pendidikan profesi akuntan membuka jenjang karier luas di berbagai sektor, mencakup Kantor Akuntan Publik (KAP), konsultan perpajakan, perusahaan multinasional, hingga instansi audit sektor publik. Lulusan PPAk FEB UNESA berhak menyandang gelar profesi Akuntan (Ak.) dan siap menempuh sertifikasi lanjutan CPA dan CA.',
                'category' => 'FEB',
                'category_label' => 'Fakultas Ekonomika dan Bisnis',
                'date' => '12 Januari 2026',
                'date_raw' => '2026-01-12',
                'read_time' => '4 Menit Baca',
                'author' => 'Sekretariat PPAk FEB',
                'image' => '/images/default-img.png',
                'tags' => ['Karier', 'Profesi', 'Akuntan'],
                'source' => 'Sekretariat PPAk FEB UNESA',
            ],
        ];

        if (empty($onlyColumns)) {
            return $all;
        }

        return array_map(function ($item) use ($onlyColumns) {
            return array_intersect_key($item, array_flip($onlyColumns));
        }, $all);
    }

    /**
     * Agenda & Jadwal Pembelajaran Resmi (SINDIG & Kalender UNESA)
     */
    public static function getAgenda(array $onlyColumns = []): array
    {
        $all = [
            [
                'id' => 1,
                'title' => 'Perkuliahan Semester Gasal 2026/2027',
                'slug' => 'perkuliahan-semester-gasal-2026-2027',
                'day' => '01',
                'month' => 'Sep',
                'date' => '01 September 2026',
                'date_end' => '18 Desember 2026',
                'date_raw' => '2026-09-01',
                'time' => 'Sesuai Jadwal Kuliah',
                'venue' => 'Gedung G6 FEB Kampus Ketintang UNESA',
                'speaker' => 'Dosen Pengampu Mata Kuliah',
                'category' => 'Akademik',
                'category_label' => 'Aktivitas Perkuliahan Akademik',
                'status' => 'Mendatang',
                'is_upcoming' => true,
                'desc' => 'Pelaksanaan perkuliahan aktif Semester Gasal 2026/2027 untuk mata kuliah Pelaporan Korporat, Audit dan Asurans, Manajemen Pajak, Cost & Advance Management Accounting, Manajemen Keuangan Lanjutan, serta Manajemen Stratejik dan Kepemimpinan.',
                'description' => 'Pelaksanaan perkuliahan aktif Semester Gasal 2026/2027 untuk mata kuliah Pelaporan Korporat, Audit dan Asurans, Manajemen Pajak, Cost & Advance Management Accounting, Manajemen Keuangan Lanjutan, serta Manajemen Stratejik dan Kepemimpinan.',
                'source' => 'Kalender Akademik UNESA & SINDIG',
            ],
            [
                'id' => 2,
                'title' => 'Evaluasi Formatif Tengah Semester (UTS) Gasal',
                'slug' => 'evaluasi-formatif-tengah-semester-uts-gasal',
                'day' => '19',
                'month' => 'Okt',
                'date' => '19 Oktober 2026',
                'date_end' => '30 Oktober 2026',
                'date_raw' => '2026-10-19',
                'time' => '08.00 - Selesai WIB',
                'venue' => 'Ruang Kuliah & Laboratorium FEB UNESA',
                'speaker' => 'Tim Penguji Akademik',
                'category' => 'Evaluasi',
                'category_label' => 'Evaluasi Pembelajaran',
                'status' => 'Mendatang',
                'is_upcoming' => true,
                'desc' => 'Pekan evaluasi formatif tengah semester untuk mengukur capaian pembelajaran mahasiswa pada paruh pertama semester perkuliahan.',
                'description' => 'Pekan evaluasi formatif tengah semester untuk mengukur capaian pembelajaran mahasiswa pada paruh pertama semester perkuliahan.',
                'source' => 'Kalender Akademik UNESA 2026/2027',
            ],
            [
                'id' => 3,
                'title' => 'Penilaian Sumatif Akhir Semester (UAS) Gasal',
                'slug' => 'penilaian-sumatif-akhir-semester-uas-gasal',
                'day' => '28',
                'month' => 'Des',
                'date' => '28 Desember 2026',
                'date_end' => '08 Januari 2027',
                'date_raw' => '2026-12-28',
                'time' => '08.00 - Selesai WIB',
                'venue' => 'Gedung G6 FEB Kampus Ketintang UNESA',
                'speaker' => 'Tim Dosen Pengampu',
                'category' => 'Evaluasi',
                'category_label' => 'Evaluasi Pembelajaran',
                'status' => 'Mendatang',
                'is_upcoming' => true,
                'desc' => 'Pekan penilaian sumatif akhir semester untuk mengevaluasi ketuntasan Capaian Pembelajaran Lulusan (CPL) pada seluruh mata kuliah semester gasal.',
                'description' => 'Pekan penilaian sumatif akhir semester untuk mengevaluasi ketuntasan Capaian Pembelajaran Lulusan (CPL) pada seluruh mata kuliah semester gasal.',
                'source' => 'Kalender Akademik UNESA 2026/2027',
            ],
        ];

        if (empty($onlyColumns)) {
            return $all;
        }

        return array_map(function ($item) use ($onlyColumns) {
            return array_intersect_key($item, array_flip($onlyColumns));
        }, $all);
    }

    /**
     * Dokumen & Unduhan Resmi
     */
    public static function getUnduhan(): array
    {
        return [
            [
                'id' => 1,
                'judul' => 'Kalender Akademik Universitas Negeri Surabaya 2026/2027',
                'title' => 'Kalender Akademik Universitas Negeri Surabaya 2026/2027',
                'slug' => 'kalender-akademik-unesa-2026-2027',
                'filename' => 'kalender-akademik-unesa-2026-2027.pdf',
                'kategori' => 'Kalender',
                'nomor_sk' => 'Surat No. B/2322/UN38.I/TU.00.02/2026',
                'tanggal' => '06 Januari 2026',
                'tahun' => '2026',
                'ukuran' => '232.8 KB',
                'size' => '232.8 KB',
                'format' => 'PDF',
                'instansi' => 'Direktorat Pendidikan dan Transformasi Pembelajaran UNESA',
                'url' => 'https://unesa.ac.id',
                'source' => 'UNESA Resmi',
            ],
            [
                'id' => 2,
                'judul' => 'Salinan Keputusan Akreditasi LAMEMBA Pendidikan Profesi Akuntan',
                'title' => 'Salinan Keputusan Akreditasi LAMEMBA Pendidikan Profesi Akuntan',
                'slug' => 'sk-akreditasi-lamemba-ppak-unesa',
                'filename' => 'sk-akreditasi-lamemba-ppak-unesa.pdf',
                'kategori' => 'Pedoman Akademik',
                'nomor_sk' => 'SK LAMEMBA No. 611/DE/A.5/AR.11/II/2025',
                'tanggal' => '26 Februari 2025',
                'tahun' => '2025',
                'ukuran' => '523.0 KB',
                'size' => '523.0 KB',
                'format' => 'PDF',
                'instansi' => 'LAMEMBA / SIMUTU UNESA',
                'url' => 'https://simutu.unesa.ac.id',
                'source' => 'SIMUTU UNESA',
            ],
            [
                'id' => 3,
                'judul' => 'Brosur Informasi Admisi PMB Program Profesi UNESA 2026/2027',
                'title' => 'Brosur Informasi Admisi PMB Program Profesi UNESA 2026/2027',
                'slug' => 'brosur-admisi-profesi-unesa',
                'filename' => 'brosur-admisi-profesi-unesa.pdf',
                'kategori' => 'Admisi & Brosur',
                'nomor_sk' => 'Portal PMB UNESA 2026',
                'tanggal' => '2026',
                'tahun' => '2026',
                'ukuran' => '1.05 MB',
                'size' => '1.05 MB',
                'format' => 'PDF',
                'instansi' => 'Pusat Admisi UNESA & FEB UNESA',
                'url' => 'https://admisi.unesa.ac.id',
                'source' => 'Admisi UNESA',
            ],
            [
                'id' => 4,
                'judul' => 'Buku Panduan Kurikulum & Capaian Pembelajaran Lulusan (CPL)',
                'title' => 'Buku Panduan Kurikulum & Capaian Pembelajaran Lulusan (CPL)',
                'slug' => 'panduan-kurikulum-cpl-ppak-feb-unesa',
                'filename' => 'panduan-kurikulum-cpl-ppak-feb-unesa.pdf',
                'kategori' => 'Pedoman Akademik',
                'nomor_sk' => 'SINDIG UNESA Kode Prodi 62902',
                'tanggal' => '2026',
                'tahun' => '2026',
                'ukuran' => '1.74 MB',
                'size' => '1.74 MB',
                'format' => 'PDF',
                'instansi' => 'Program Studi Pendidikan Profesi Akuntan FEB UNESA',
                'url' => 'https://sindig.unesa.ac.id',
                'source' => 'SINDIG UNESA',
            ],
            [
                'id' => 5,
                'judul' => 'Formulir Pendaftaran & Lembar Verifikasi Berkas PMB Profesi',
                'title' => 'Formulir Pendaftaran & Lembar Verifikasi Berkas PMB Profesi',
                'slug' => 'formulir-verifikasi-berkas-pmb-unesa',
                'filename' => 'formulir-verifikasi-berkas-pmb-unesa.pdf',
                'kategori' => 'Admisi & Brosur',
                'nomor_sk' => 'Subbag Akademik FEB UNESA',
                'tanggal' => '2026',
                'tahun' => '2026',
                'ukuran' => '358.7 KB',
                'size' => '358.7 KB',
                'format' => 'PDF',
                'instansi' => 'Subbagian Akademik FEB UNESA',
                'url' => 'https://pmb.unesa.ac.id',
                'source' => 'PMB FEB UNESA',
            ],
            [
                'id' => 6,
                'judul' => 'Panduan Pengajuan Pembebasan Ujian (Waiver) Sertifikasi CA IAI',
                'title' => 'Panduan Pengajuan Pembebasan Ujian (Waiver) Sertifikasi CA IAI',
                'slug' => 'panduan-waiver-ujian-ca-iai',
                'filename' => 'panduan-waiver-ujian-ca-iai.pdf',
                'kategori' => 'Pedoman Akademik',
                'nomor_sk' => 'Rekognisi IAI & PPAk FEB UNESA',
                'tanggal' => '2026',
                'tahun' => '2026',
                'ukuran' => '687.5 KB',
                'size' => '687.5 KB',
                'format' => 'PDF',
                'instansi' => 'Ikatan Akuntan Indonesia (IAI) & FEB UNESA',
                'url' => 'https://iaiglobal.or.id',
                'source' => 'IAI Global',
            ],
        ];
    }

    /**
     * Galeri Foto & Dokumentasi Kampus FEB UNESA
     */
    public static function getGaleri(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Gedung Fakultas Ekonomika dan Bisnis Kampus Ketintang UNESA',
                'category' => 'Fasilitas Kampus',
                'date' => '2026',
                'image' => '/images/default-img.png',
                'description' => 'Fasilitas gedung perkuliahan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya di Kampus Ketintang.',
                'source' => 'Dokumentasi Resmi FEB UNESA',
            ],
            [
                'id' => 2,
                'title' => 'Laboratorium Akuntansi & Komputasi Keuangan Terpadu',
                'category' => 'Laboratorium',
                'date' => '2026',
                'image' => '/images/default-img.png',
                'description' => 'Fasilitas laboratorium praktika komputasi dan analisis data keuangan di FEB UNESA.',
                'source' => 'Dokumentasi Resmi FEB UNESA',
            ],
            [
                'id' => 3,
                'title' => 'Auditorium & Ruang Presentasi Akademik Gedung G6 FEB',
                'category' => 'Ruang Kuliah',
                'date' => '2026',
                'image' => '/images/default-img.png',
                'description' => 'Auditorium utama di Gedung G6 FEB UNESA yang digunakan untuk kuliah tamu, seminar, dan sidang profesi.',
                'source' => 'Dokumentasi Resmi FEB UNESA',
            ],
            [
                'id' => 4,
                'title' => 'Ruang Diskusi & Pembelajaran Interaktif Mahasiswa',
                'category' => 'Ruang Diskusi',
                'date' => '2026',
                'image' => '/images/default-img.png',
                'description' => 'Ruang kolaboratif yang mendukung diskusi studi kasus dan kerja kelompok mahasiswa Pendidikan Profesi Akuntan.',
                'source' => 'Dokumentasi Resmi FEB UNESA',
            ],
        ];
    }
}
