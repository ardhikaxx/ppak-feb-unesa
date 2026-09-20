<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Header halaman (judul, badge, lead) + section tambahan agar seluruh
     * landing page dapat dikelola admin. Idempotent, teks = salinan tampilan.
     */
    public function up(): void
    {
        foreach ($this->headers() as $page => [$title, $badge, $lead]) {
            $this->row($page, 'header_title', $title);
            $this->row($page, 'header_badge', $badge);
            $this->row($page, 'header_lead', null, $lead);
        }

        foreach ($this->sections() as $row) {
            $this->insert($row);
        }
    }

    public function down(): void
    {
        // Data dipertahankan (hanya struktur di rollback migrasi pembuat tabel).
    }

    private function row(string $page, string $key, ?string $heading = null, ?string $body = null): void
    {
        $this->insert([
            'page' => $page, 'section_key' => $key, 'heading' => $heading,
            'subtitle' => null, 'body' => $body, 'link_url' => null,
            'sort_order' => 0, 'status' => 'published',
        ]);
    }

    private function insert(array $row): void
    {
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

    /** @return array<string, array{0: string, 1: string, 2: string}> */
    private function headers(): array
    {
        return [
            'sejarah' => ['Sejarah Singkat Program', 'Profil Program Studi', 'Pendirian Pendidikan Profesi Akuntan sebagai wujud pengembangan program pendidikan profesi di lingkungan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.'],
            'visi-misi' => ['Visi, Misi & Tujuan', 'Arah & Komitmen Mutu', 'Komitmen penyelenggaraan Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.'],
            'struktur-organisasi' => ['Struktur Organisasi', 'Tata Kelola Kelembagaan', 'Hierarki tata kelola kelembagaan Program Studi Pendidikan Profesi Akuntan di lingkungan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.'],
            'akreditasi' => ['Akreditasi & Sertifikasi Mutu', 'Legalitas & Penjaminan Mutu', 'Dokumentasi ketetapan akreditasi resmi dari Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi (LAMEMBA).'],
            'dosen' => ['Profil Dosen & Pengajar', 'Tenaga Pengajar Terverifikasi', 'Daftar dosen aktif dan pengajar mata kuliah Program Studi Pendidikan Profesi Akuntan FEB UNESA yang tercatat pada sistem penugasan akademik SINDIG UNESA.'],
            'kurikulum' => ['Kurikulum & Capaian Pembelajaran', 'Kurikulum Resmi SINDIG UNESA', 'Struktur mata kuliah, distribusi SKS semester, dan pemetaan Capaian Pembelajaran Lulusan (CPL) Program Studi Pendidikan Profesi Akuntan (Kode: 62902).'],
            'kalender' => ['Kalender Akademik 2026/2027', 'Jadwal & Agenda Resmi UNESA', 'Kalender Akademik Universitas Negeri Surabaya Tahun Akademik 2026/2027 yang menjadi pedoman perkuliahan dan evaluasi studi.'],
            'gelar-sertifikasi' => ['Gelar Profesi & Sertifikasi Akuntan', 'Informasi Keprofesian & Sertifikasi', 'Memahami hubungan program Pendidikan Profesi Akuntan dengan sebutan profesi, sertifikasi Chartered Accountant (CA) IAI, dan CPA of Indonesia IAPI.'],
            'panduan' => ['Pedoman & Panduan Akademik', 'Dokumen Resmi & Layanan', 'Akses dokumen resmi ketetapan universitas dan informasi ketersediaan panduan akademik Program Studi Pendidikan Profesi Akuntan.'],
            'jalur-syarat' => ['Jalur & Persyaratan Pendaftaran', 'Informasi Admisi PMB UNESA', 'Ketentuan umum dan dokumen yang diperlukan calon mahasiswa Program Studi Pendidikan Profesi Akuntan (Kode: 62902) FEB UNESA.'],
            'biaya' => ['Biaya Pendidikan & Investasi Studi', 'Informasi Biaya Resmi', 'Besaran Uang Kuliah Tunggal (UKT) Program Studi Pendidikan Profesi Akuntan berdasarkan penetapan resmi Admisi UNESA.'],
            'prosedur-jadwal' => ['Prosedur & Jadwal Seleksi Masuk', 'Alur Penerimaan Terpadu PMB UNESA', 'Tahapan pendaftaran terpusat melalui portal PMB UNESA dan rekam jadwal seleksi penerimaan mahasiswa baru.'],
            'faq' => ['Pertanyaan yang Sering Diajukan (FAQ)', 'Pusat Bantuan & Tanya Jawab', 'Jawaban atas pertanyaan umum seputar pendaftaran akun PMB, verifikasi dokumen, pembayaran UKT, dan layanan akademik.'],
            'riset-publikasi' => ['Riset & Publikasi Ilmiah', 'Karya Dosen Pengajar', 'Daftar publikasi artikel ilmiah dan kegiatan ilmiah dosen pengajar Program Studi Pendidikan Profesi Akuntan FEB UNESA yang tercatat pada database resmi.'],
            'pengabdian' => ['Pengabdian Kepada Masyarakat (PKM)', 'Tridharma Perguruan Tinggi', 'Penyelenggaraan kegiatan pengabdian kepada masyarakat dan literasi akuntansi oleh sivitas akademika FEB UNESA.'],
            'kerja-sama' => ['Jejaring & Kerja Sama', 'Kemitraan Kelembagaan', 'Inisiasi dan tata kelola kemitraan strategis Program Studi Pendidikan Profesi Akuntan di lingkungan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.'],
            'alumni' => ['Jejaring Alumni (PPAk FEB UNESA)', 'Pengembangan Jejaring & Silaturahmi', 'Wadah sinergi dan jejaring komunikasi profesional bagi lulusan Program Studi Pendidikan Profesi Akuntan FEB UNESA.'],
            'testimoni-karier' => ['Testimoni & Jejaring Karier Alumni', 'Prospek Profesi & Alumni', 'Informasi bidang profesi akuntan dan direktori testimoni pengalaman studi Program Studi Pendidikan Profesi Akuntan FEB UNESA.'],
            'berita' => ['Berita & Pengumuman', 'Informasi & Publikasi Resmi', 'Kabar teraktual mengenai aktivitas perkuliahan, kerja sama industri, kuliah tamu pakar, dan pengumuman administratif PPAk FEB UNESA.'],
            'agenda' => ['Agenda, Seminar & Kuliah Tamu', 'Kegiatan Sivitas Akademika', 'Ikuti rangkaian seminar berkala, workshop teknis sertifikasi CA, dan forum diskusi pakar akuntansi terkini.'],
            'galeri' => ['Galeri Foto & Dokumentasi Kegiatan', 'Dokumentasi Visual', 'Kilas balik rekaman visual suasana pembelajaran, kuliah tamu, praktika laboratorium, dan pengukuhan profesi akuntan.'],
            'unduhan' => ['Unduhan Dokumen Publik & Formulir', 'Repositori Berkas Resmi', 'Akses berkas digital resmi seperti brosur program, formulir permohonan waiver CA, kalender studi, dan surat keputusan akreditasi.'],
            'lokasi' => ['Lokasi Kampus & Peta Sekretariat', 'Kampus Ketintang Surabaya', 'Kunjungi sekretariat PPAk di Gedung G6 Fakultas Ekonomika dan Bisnis, Universitas Negeri Surabaya.'],
            'helpdesk' => ['Sekretariat & Helpdesk Layanan Mahasiswa', 'Pusat Bantuan & Komunikasi', 'Silakan hubungi staf sekretariat untuk konsultasi pendaftaran, persyaratan matrikulasi, dan administrasi akademik profesi.'],
            'mahasiswa' => ['Aktivitas Akademik & Pembelajaran', 'Dinamika Pembelajaran Profesi', 'Rangkaian kegiatan perkuliahan terstruktur, praktika kertas kerja, magang industri, dan diskusi keprofesian mahasiswa Pendidikan Profesi Akuntan.'],
        ];
    }

    private function sections(): array
    {
        $c = fn (string $page, string $key, ?string $heading = null, ?string $body = null) => [
            'page' => $page, 'section_key' => $key, 'heading' => $heading,
            'subtitle' => null, 'body' => $body, 'link_url' => null,
            'sort_order' => 0, 'status' => 'published',
        ];

        return [
            // Beranda
            $c('home', 'sec_kurikulum_heading', 'Kurikulum Profesional (Semester 1)'),
            $c('home', 'sec_kurikulum_lead', null, 'Enam mata kuliah inti semester pertama yang membentuk pondasi keahlian teknis dan etika akuntan profesional.'),
            $c('home', 'sec_cpl_heading', 'Capaian Pembelajaran Lulusan (CPL)'),
            $c('home', 'sec_cpl_lead', null, 'Empat Capaian Pembelajaran Lulusan resmi yang ditetapkan pada sistem kurikulum SINDIG Pendidikan Profesi Akuntan FEB UNESA.'),
            $c('home', 'sec_admisi_heading', 'Informasi Pendaftaran & Biaya Pendidikan'),
            $c('home', 'sec_admisi_lead', null, 'Penerimaan mahasiswa baru Program Profesi diselenggarakan secara terpusat melalui portal Penerimaan Mahasiswa Baru Universitas Negeri Surabaya (PMB UNESA).'),
            $c('home', 'sec_riset_heading', 'Riset & Publikasi Dosen Pengajar'),
            $c('home', 'sec_riset_lead', null, 'Publikasi karya ilmiah dan kegiatan pengabdian dosen pengajar yang tercatat pada pangkalan data resmi.'),
            $c('home', 'sec_dosen_heading', 'Dosen & Pengajar Mata Kuliah PPAk'),
            $c('home', 'sec_dosen_lead', null, 'Tenaga pengajar yang mengampu mata kuliah pada Program Studi Pendidikan Profesi Akuntan FEB UNESA.'),
            $c('home', 'sec_berita_heading', 'Berita & Informasi'),
            $c('home', 'sec_agenda_heading', 'Agenda Pembelajaran'),
            $c('home', 'sec_karier_heading', 'Bidang Karier & Jalur Profesi Akuntan'),
            $c('home', 'sec_karier_lead', null, 'Informasi bidang profesi yang relevan bagi lulusan sarjana akuntansi yang menempuh pendidikan profesi akuntan.'),
            // Global
            $c('global', 'cta_heading', 'Bangun Kompetensi Profesional Anda di PPAk FEB UNESA'),
            $c('global', 'cta_body', null, 'Tingkatkan kualifikasi keprofesian akuntansi Anda dengan bimbingan akademisi dan praktisi terkemuka. Tempuh jalur terpadu meraih gelar Akuntan (Ak.), pembebasan ujian sertifikasi Chartered Accountant (CA), dan keunggulan karier global.'),
            $c('global', 'cta_btn1', 'Informasi Pendaftaran'),
            $c('global', 'cta_btn2', 'Hubungi Sekretariat'),
            $c('global', 'footer_about', null, 'Program Studi Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis menyelenggarakan pendidikan keprofesian berstandar mutu tinggi, berakar pada integritas, kepakaran teknis, dan etika profesi luhur.'),
            // Lokasi
            $c('lokasi', 'schedule_body', null, 'Senin – Kamis: 08.00 – 16.00 WIB<br>Jumat: 08.00 – 16.30 WIB (Istirahat 11.30 – 13.00 WIB)<br>Sabtu & Minggu: Layanan Khusus Kelas Eksekutif'),
            $c('lokasi', 'transport_body', null, 'Terhubung langsung dengan rute feeder WiraWiri Suroboyo (Halte UNESA Ketintang), Suroboyo Bus Koridor R1/R2, serta berjarak 1.5 km dari Stasiun Kereta Api Wonokromo.'),
            // Panduan
            $c('panduan', 'docs_heading', 'Dokumen Resmi Universitas & Akreditasi'),
            $c('panduan', 'docs_lead', null, 'Dokumen ketetapan resmi yang telah dipublikasikan dan dapat diakses publik.'),
            $c('panduan', 'notice_heading', 'Pedoman Akademik & Buku Panduan Khusus Program Studi'),
            $c('panduan', 'notice_body', null, 'Dokumen Buku Pedoman Akademik Khusus Program Studi, Petunjuk Praktik Magang Industri, dan Panduan Capstone Project sedang dalam proses penyusunan dan pengesahan tata pamong kelembagaan menyusul berdirinya program pada 23 Mei 2025.'),
            // Biaya
            $c('biaya', 'payment_heading', 'Kanal Pembayaran Resmi Bank Mitra UNESA'),
            $c('biaya', 'payment_body', null, 'Seluruh transaksi pembayaran biaya pendaftaran maupun UKT semester menggunakan kode <strong>Virtual Account (VA)</strong> resmi yang diterbitkan oleh sistem PMB/SIAKAD UNESA:'),
            $c('biaya', 'banks_body', null, 'Bank Mandiri|Bank BTN|Bank BNI|Bank BRI|Bank Syariah Indonesia (BSI)'),
            // Alumni
            $c('alumni', 'pilar_1_heading', 'Forum Silaturahmi & Diskusi'),
            $c('alumni', 'pilar_1_body', null, 'Menjaga komunikasi antarangkatan dan pertukaran wawasan dinamika keprofesian akuntan.'),
            $c('alumni', 'pilar_2_heading', 'Peluang Karier & Referral'),
            $c('alumni', 'pilar_2_body', null, 'Berbagi informasi rekrutmen profesional di Kantor Akuntan Publik, korporasi, dan lembaga pemerintah.'),
            $c('alumni', 'pilar_3_heading', 'Mentoring & Kontribusi Almamater'),
            $c('alumni', 'pilar_3_body', null, 'Dukungan pembekalan studi kasus dan masukan praktis bagi pengembangan mutu pembelajaran.'),
        ];
    }
};
