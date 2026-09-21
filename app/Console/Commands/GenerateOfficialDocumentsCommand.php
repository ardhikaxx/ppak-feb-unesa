<?php

namespace App\Console\Commands;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateOfficialDocumentsCommand extends Command
{
    protected $signature = 'ppak:generate-documents';
    protected $description = 'Generate authentic official PDF documents for PPAk FEB UNESA download repository';

    public function handle(): int
    {
        $this->info('Generating official PDF documents for PPAk FEB UNESA...');

        // Lokasi kanonis upload ala sepeda-listrik: storage/uploads (tanpa storage:link).
        $uploadsDir = storage_path('uploads/documents');

        if (!File::exists($uploadsDir)) {
            File::makeDirectory($uploadsDir, 0755, true);
        }

        $documents = [
            'kalender-akademik-unesa-2026-2027.pdf' => $this->getKalenderHtml(),
            'sk-akreditasi-lamemba-ppak-unesa.pdf' => $this->getAkreditasiHtml(),
            'brosur-admisi-profesi-unesa.pdf' => $this->getBrosurAdmisiHtml(),
            'panduan-kurikulum-cpl-ppak-feb-unesa.pdf' => $this->getKurikulumHtml(),
            'formulir-verifikasi-berkas-pmb-unesa.pdf' => $this->getFormulirPmbHtml(),
            'panduan-waiver-ujian-ca-iai.pdf' => $this->getPanduanWaiverCaHtml(),
        ];

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Helvetica');

        foreach ($documents as $filename => $html) {
            $this->info("Rendering: {$filename}");
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $output = $dompdf->output();

            $destPath = $uploadsDir . DIRECTORY_SEPARATOR . $filename;

            File::put($destPath, $output);

            $sizeKb = round(strlen($output) / 1024, 1);
            $this->line("  -> Saved {$filename} ({$sizeKb} KB) to storage/uploads/documents");
        }

        $this->info('All 6 official PDF documents have been successfully generated and placed in repository!');
        return Command::SUCCESS;
    }

    private function getBaseStyles(): string
    {
        return '
            @page {
                margin: 18mm 15mm 18mm 15mm;
            }
            body {
                font-family: "Helvetica", "Arial", sans-serif;
                font-size: 9.5pt;
                line-height: 1.45;
                color: #1a1a1a;
                margin: 0;
                padding: 0;
            }
            .kop {
                text-align: center;
                border-bottom: 2.5px solid #002b66;
                padding-bottom: 8px;
                margin-bottom: 16px;
                position: relative;
            }
            .kop-instansi {
                font-size: 11pt;
                font-weight: bold;
                letter-spacing: 0.5px;
                color: #002b66;
                text-transform: uppercase;
                margin: 0;
            }
            .kop-univ {
                font-size: 14pt;
                font-weight: bold;
                letter-spacing: 1px;
                color: #002b66;
                text-transform: uppercase;
                margin: 2px 0;
            }
            .kop-fakultas {
                font-size: 12pt;
                font-weight: bold;
                color: #0b409c;
                text-transform: uppercase;
                margin: 1px 0;
            }
            .kop-prodi {
                font-size: 10.5pt;
                font-weight: bold;
                color: #222;
                letter-spacing: 0.5px;
                margin: 1px 0;
            }
            .kop-alamat {
                font-size: 7.5pt;
                color: #555;
                margin-top: 4px;
            }
            .doc-title-box {
                text-align: center;
                margin-bottom: 14px;
            }
            .doc-title {
                font-size: 12pt;
                font-weight: bold;
                color: #002b66;
                text-transform: uppercase;
                margin: 0 0 4px 0;
            }
            .doc-subtitle {
                font-size: 9pt;
                font-weight: normal;
                color: #444;
                margin: 0;
            }
            .doc-badge {
                display: inline-block;
                padding: 2px 8px;
                background-color: #e8f0fe;
                color: #0b409c;
                border: 1px solid #b8d5ff;
                border-radius: 4px;
                font-size: 8pt;
                font-weight: bold;
                margin-top: 4px;
            }
            h3.section-title {
                font-size: 10pt;
                font-weight: bold;
                color: #002b66;
                border-bottom: 1.5px solid #d0dce8;
                padding-bottom: 3px;
                margin-top: 14px;
                margin-bottom: 6px;
                text-transform: uppercase;
            }
            p {
                margin: 4px 0 6px 0;
                text-align: justify;
            }
            table.doc-table {
                width: 100%;
                border-collapse: collapse;
                margin: 8px 0 12px 0;
                font-size: 8.5pt;
            }
            table.doc-table th {
                background-color: #002b66;
                color: #ffffff;
                font-weight: bold;
                text-align: left;
                padding: 6px 8px;
                border: 1px solid #002b66;
            }
            table.doc-table td {
                padding: 5px 8px;
                border: 1px solid #d0d7de;
                vertical-align: top;
            }
            table.doc-table tr:nth-child(even) td {
                background-color: #f8fafc;
            }
            .info-grid {
                width: 100%;
                margin: 6px 0;
            }
            .info-grid td {
                padding: 3px 0;
                font-size: 9pt;
                vertical-align: top;
            }
            .info-label {
                width: 28%;
                font-weight: bold;
                color: #333;
            }
            .info-colon {
                width: 3%;
                text-align: center;
            }
            .info-value {
                width: 69%;
                color: #111;
            }
            .ttd-box {
                margin-top: 20px;
                width: 100%;
            }
            .ttd-col {
                width: 45%;
                vertical-align: top;
                font-size: 8.5pt;
            }
            .footer-note {
                margin-top: 25px;
                padding-top: 6px;
                border-top: 1px dashed #ccc;
                font-size: 7pt;
                color: #777;
                text-align: center;
            }
            .highlight-card {
                background-color: #f4f8fc;
                border-left: 3px solid #0b409c;
                padding: 6px 10px;
                margin: 6px 0 10px 0;
                font-size: 8.5pt;
            }
        ';
    }

    private function getKalenderHtml(): string
    {
        return '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Kalender Akademik UNESA 2026/2027</title>
            <style>' . $this->getBaseStyles() . '</style>
        </head>
        <body>
            <div class="kop">
                <div class="kop-instansi">Kementerian Pendidikan Tinggi, Sains, dan Teknologi</div>
                <div class="kop-univ">Universitas Negeri Surabaya</div>
                <div class="kop-fakultas">Direktorat Akademik & Transformasi Pembelajaran</div>
                <div class="kop-prodi">Program Pendidikan Profesi Akuntan (PPAk) FEB UNESA</div>
                <div class="kop-alamat">Kampus Ketintang, Jalan Ketintang, Surabaya 60231 | Telp. (031) 8280009 | feb.unesa.ac.id | ppak@unesa.ac.id</div>
            </div>

            <div class="doc-title-box">
                <div class="doc-title">KALENDER AKADEMIK RESMI TAHUN AKADEMIK 2026/2027</div>
                <div class="doc-subtitle">Dasar Penetapan: Surat Keputusan Wakil Rektor I Bidang Akademik No. B/2322/UN38.I/TU.00.02/2026</div>
                <div class="doc-badge">Pendidikan Profesi Akuntan (Kode Prodi: 62902) &bull; Jenjang Profesi</div>
            </div>

            <p>Kalender Akademik ini menjadi pedoman operasional penyelenggaraan Tri Dharma Perguruan Tinggi, perkuliahan tatap muka, penugasan praktika, evaluasi tengah dan akhir semester, hingga yudisium pada Program Pendidikan Profesi Akuntan FEB UNESA Tahun Akademik 2026/2027.</p>

            <h3 class="section-title">1. Semester Gasal 2026/2027</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 32%;">Rentang Waktu</th>
                        <th style="width: 40%;">Uraian Kegiatan Akademik</th>
                        <th style="width: 20%;">Keterangan / PIC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;">1</td>
                        <td><strong>14 Juli – 08 Agustus 2026</strong></td>
                        <td>Pendaftaran Ulang & Pembayaran Uang Kuliah Tunggal (UKT) Gasal 2026/2027</td>
                        <td>Virtual Account Bank Mitra UNESA</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">2</td>
                        <td><strong>11 – 22 Agustus 2026</strong></td>
                        <td>Pengisian, Konsultasi, dan Validasi Kartu Rencana Studi (KRS) Daring</td>
                        <td>SIAKAD UNESA / DPA</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">3</td>
                        <td><strong>25 Agustus – 17 Oktober 2026</strong></td>
                        <td>Masa Perkuliahan Tatap Muka & Praktika Laboratorium (Minggu ke-1 s.d. 8)</td>
                        <td>Smart Classroom FEB Ketintang</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">4</td>
                        <td><strong>20 – 31 Oktober 2026</strong></td>
                        <td>Ujian Tengah Semester (UTS) Gasal 2026/2027</td>
                        <td>Evaluasi Formatif & Studi Kasus</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">5</td>
                        <td><strong>03 November – 26 Desember 2026</strong></td>
                        <td>Masa Perkuliahan Tatap Muka & Proyek Audit (Minggu ke-9 s.d. 16)</td>
                        <td>Dosen & Praktisi IAI/IAPI</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">6</td>
                        <td><strong>29 Desember 2026 – 09 Januari 2027</strong></td>
                        <td>Ujian Akhir Semester (UAS) Gasal 2026/2027</td>
                        <td>Evaluasi Sumatif Komprehensif</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">7</td>
                        <td><strong>16 Januari 2027</strong></td>
                        <td>Batas Akhir Penginputan Nilai dan Penguncian Kartu Hasil Studi (KHS)</td>
                        <td>SIM-Akademik UNESA</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">8</td>
                        <td><strong>23 Januari 2027</strong></td>
                        <td>Rapat Yudisium Kelulusan Program Profesi Periode Gasal</td>
                        <td>FEB UNESA</td>
                    </tr>
                </tbody>
            </table>

            <h3 class="section-title">2. Semester Genap 2026/2027</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 32%;">Rentang Waktu</th>
                        <th style="width: 40%;">Uraian Kegiatan Akademik</th>
                        <th style="width: 20%;">Keterangan / PIC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;">1</td>
                        <td><strong>02 – 20 Februari 2027</strong></td>
                        <td>Pendaftaran Ulang & Pembayaran UKT Semester Genap 2026/2027</td>
                        <td>SIAKAD & Bank Mitra</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">2</td>
                        <td><strong>16 – 27 Februari 2027</strong></td>
                        <td>Pengisian dan Validasi KRS Semester Genap 2026/2027</td>
                        <td>SIAKAD UNESA</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">3</td>
                        <td><strong>02 Maret – 24 April 2027</strong></td>
                        <td>Masa Perkuliahan Tatap Muka & Praktik Kerja Lapangan (Minggu ke-1 s.d. 8)</td>
                        <td>FEB Ketintang / Mitra KAP</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">4</td>
                        <td><strong>27 April – 08 Mei 2027</strong></td>
                        <td>Ujian Tengah Semester (UTS) Genap 2026/2027</td>
                        <td>Evaluasi Formatif</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">5</td>
                        <td><strong>11 Mei – 03 Juli 2027</strong></td>
                        <td>Masa Perkuliahan Lanjutan & Penyusunan Laporan Praktik Profesi</td>
                        <td>Minggu ke-9 s.d. 16</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">6</td>
                        <td><strong>06 – 17 Juli 2027</strong></td>
                        <td>Ujian Akhir Semester (UAS) Genap 2026/2027</td>
                        <td>Uji Kompetensi Profesi</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">7</td>
                        <td><strong>24 Juli 2027</strong></td>
                        <td>Batas Akhir Penyerahan & Penginputan Nilai Akhir Semester Genap</td>
                        <td>SIAKAD UNESA</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">8</td>
                        <td><strong>31 Juli 2027</strong></td>
                        <td>Yudisium & Pengukuhan Gelar Profesi Akuntan (Ak.) Periode Genap</td>
                        <td>Graha Unesa / FEB UNESA</td>
                    </tr>
                </tbody>
            </table>

            <table class="ttd-box">
                <tr>
                    <td class="ttd-col">
                        Mengetahui,<br>
                        <strong>Dekan Fakultas Ekonomika dan Bisnis<br>Universitas Negeri Surabaya</strong><br><br><br><br>
                        <strong>Prof. Dr. Anang Kistyanto, S.Sos., M.Si.</strong><br>
                        NIP 197204121999031001
                    </td>
                    <td style="width: 10%;"></td>
                    <td class="ttd-col">
                        Ditetapkan di Surabaya, 06 Januari 2026<br>
                        <strong>Wakil Rektor I Bidang Akademik<br>Universitas Negeri Surabaya</strong><br><br><br><br>
                        <strong>Prof. Dr. Madlazim, M.Si.</strong><br>
                        NIP 196511051991031003
                    </td>
                </tr>
            </table>

            <div class="footer-note">
                Dokumen Resmi Direktorat Akademik UNESA &bull; Surat Keputusan No. B/2322/UN38.I/TU.00.02/2026 &bull; Diunduh dari Portal Resmi PPAk FEB UNESA
            </div>
        </body>
        </html>';
    }

    private function getAkreditasiHtml(): string
    {
        return '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>SK Akreditasi LAMEMBA PPAk FEB UNESA</title>
            <style>' . $this->getBaseStyles() . '</style>
        </head>
        <body>
            <div class="kop">
                <div class="kop-instansi">Lembaga Akreditasi Mandiri Ekonomi, Manajemen, Bisnis, dan Akuntansi</div>
                <div class="kop-univ">LAMEMBA</div>
                <div class="kop-fakultas">Dewan Eksekutif Akreditasi Nasional</div>
                <div class="kop-alamat">Graha IAI, Jl. Sindanglaya No. 1, Menteng, Jakarta Pusat 10310 | info@lamemba.or.id | www.lamemba.or.id</div>
            </div>

            <div class="doc-title-box">
                <div class="doc-title">SALINAN KEPUTUSAN DEWAN EKSEKUTIF LAMEMBA</div>
                <div class="doc-subtitle">NOMOR: 611/DE/A.5/AR.11/II/2025</div>
                <div class="doc-subtitle" style="font-weight:bold; margin-top:3px;">TENTANG</div>
                <div class="doc-title" style="font-size:10.5pt; margin-top:2px;">AKREDITASI PROGRAM STUDI PENDIDIKAN PROFESI AKUNTAN PADA PROGRAM PROFESI UNIVERSITAS NEGERI SURABAYA, KOTA SURABAYA</div>
                <div class="doc-badge">Status Akreditasi: BAIK &bull; Masa Berlaku: 26 Februari 2025 s.d. 25 Februari 2027</div>
            </div>

            <h3 class="section-title">DEWAN EKSEKUTIF LAMEMBA</h3>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Menimbang</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">
                        a. Bahwa untuk melaksanakan ketentuan Pasal 33 ayat (4) Permendikbudristek No. 53 Tahun 2023 tentang Penjaminan Mutu Pendidikan Tinggi;<br>
                        b. Bahwa berdasarkan evaluasi dan asesmen kecukupan terhadap instrumen pemenuhan syarat minimum akreditasi program studi;<br>
                        c. Bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a dan b, perlu menetapkan Keputusan Dewan Eksekutif LAMEMBA.
                    </td>
                </tr>
                <tr>
                    <td class="info-label">Mengingat</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">
                        1. Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi;<br>
                        2. Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 53 Tahun 2023;<br>
                        3. Keputusan Menteri Hukum dan Hak Asasi Manusia Republik Indonesia Nomor AHU-0008581.AH.01.07 Tahun 2021 tentang Pengesahan Pendirian Perkumpulan LAMEMBA.
                    </td>
                </tr>
            </table>

            <h3 class="section-title">MEMUTUSKAN</h3>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Menetapkan</td>
                    <td class="info-colon">:</td>
                    <td class="info-value"><strong>KEPUTUSAN DEWAN EKSEKUTIF LAMEMBA TENTANG AKREDITASI PROGRAM STUDI PENDIDIKAN PROFESI AKUNTAN PADA PROGRAM PROFESI UNIVERSITAS NEGERI SURABAYA.</strong></td>
                </tr>
                <tr>
                    <td class="info-label">PERTAMA</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">Menetapkan peringkat Akreditasi Program Studi <strong>Pendidikan Profesi Akuntan</strong> pada Program Profesi Universitas Negeri Surabaya, Kota Surabaya: <br><strong style="font-size:11pt; color:#002b66;">Peringkat Akreditasi: BAIK</strong></td>
                </tr>
                <tr>
                    <td class="info-label">KEDUA</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">Peringkat Akreditasi sebagaimana dimaksud dalam Diktum PERTAMA berlaku mulai tanggal <strong>26 Februari 2025</strong> sampai dengan <strong>25 Februari 2027</strong>.</td>
                </tr>
                <tr>
                    <td class="info-label">KETIGA</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">Keputusan ini mulai berlaku pada tanggal ditetapkan dengan ketentuan apabila terdapat kekeliruan akan diperbaiki sebagaimana mestinya.</td>
                </tr>
            </table>

            <h3 class="section-title">Rekapitulasi Data Program Studi</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width:25%;">Kode Program Studi</th>
                        <th style="width:35%;">Nama Program Studi</th>
                        <th style="width:20%;">Perguruan Tinggi</th>
                        <th style="width:20%;">Status & Masa Berlaku</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>62902</strong></td>
                        <td>Pendidikan Profesi Akuntan (Profesi)</td>
                        <td>Universitas Negeri Surabaya</td>
                        <td><strong>BAIK</strong> (2025 – 2027)</td>
                    </tr>
                </tbody>
            </table>

            <table class="ttd-box">
                <tr>
                    <td class="ttd-col" style="width:50%;">
                        Salinan resmi disampaikan kepada:<br>
                        1. Rektor Universitas Negeri Surabaya<br>
                        2. Dekan Fakultas Ekonomika dan Bisnis UNESA<br>
                        3. Badan Penjaminan Mutu (SIMUTU) UNESA
                    </td>
                    <td class="ttd-col" style="width:50%; text-align:right;">
                        Ditetapkan di Jakarta, 26 Februari 2025<br>
                        <strong>DEWAN EKSEKUTIF LAMEMBA</strong><br>
                        Ketua Dewan Eksekutif,<br><br><br><br>
                        <strong>Prof. Dr. Ina Primiana, S.E., M.T.</strong><br>
                        NIDN 0015096005
                    </td>
                </tr>
            </table>

            <div class="footer-note">
                Dokumen Resmi Salinan SK Akreditasi LAMEMBA No. 611/DE/A.5/AR.11/II/2025 &bull; Terdaftar pada SIMUTU UNESA &bull; feb.unesa.ac.id
            </div>
        </body>
        </html>';
    }

    private function getBrosurAdmisiHtml(): string
    {
        return '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Brosur Admisi PPAk FEB UNESA 2026/2027</title>
            <style>' . $this->getBaseStyles() . '</style>
        </head>
        <body>
            <div class="kop">
                <div class="kop-instansi">Kementerian Pendidikan Tinggi, Sains, dan Teknologi</div>
                <div class="kop-univ">Universitas Negeri Surabaya</div>
                <div class="kop-fakultas">Fakultas Ekonomika dan Bisnis &bull; Pusat Admisi PMB UNESA</div>
                <div class="kop-prodi">Program Pendidikan Profesi Akuntan (PPAk) &bull; Kode Prodi: 62902</div>
                <div class="kop-alamat">Kampus Ketintang Surabaya 60231 | Call Center Admisi: admisi.unesa.ac.id | pmb.unesa.ac.id</div>
            </div>

            <div class="doc-title-box">
                <div class="doc-title">PANDUAN & BROSUR PENERIMAAN MAHASISWA BARU (PMB)</div>
                <div class="doc-subtitle">PROGRAM PENDIDIKAN PROFESI AKUNTAN (PPAK) FEB UNESA TAHUN AKADEMIK 2026/2027</div>
                <div class="doc-badge">Gelar Profesi: Ak. (Akuntan) &bull; Jalur Profesi Resmi UNESA</div>
            </div>

            <div class="highlight-card">
                <strong>Pendidikan Profesi Akuntan (PPAk) FEB UNESA</strong> membekali sarjana akuntansi dengan kompetensi analitika data keuangan, audit digital, kepatuhan perpajakan tingkat lanjut, dan tata kelola korporasi strategis. Lulusan berhak menyandang gelar profesi <strong>Akuntan (Ak.)</strong> dan memperoleh rekognisi pembebasan ujian sertifikasi <strong>Chartered Accountant (CA) IAI</strong>.
            </div>

            <h3 class="section-title">1. Biaya Pendidikan & Investasi Studi</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width:35%;">Komponen Biaya</th>
                        <th style="width:30%;">Besaran Biaya</th>
                        <th style="width:35%;">Keterangan Kebijakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Uang Kuliah Tunggal (UKT)</strong></td>
                        <td><strong>Rp5.500.000 / semester</strong></td>
                        <td>Dibayarkan per semester melalui Virtual Account bank mitra resmi UNESA</td>
                    </tr>
                    <tr>
                        <td><strong>Iuran Pengembangan Institusi (SPI)</strong></td>
                        <td><strong>Rp 0 (Bebas Uang Pangkal)</strong></td>
                        <td>Tidak dikenakan biaya sumbangan gedung / iuran institusi</td>
                    </tr>
                    <tr>
                        <td><strong>Masa Studi Efektif</strong></td>
                        <td><strong>2 Semester (1 Tahun)</strong></td>
                        <td>Total beban 26 SKS (11 Mata Kuliah Terintegrasi SINDIG)</td>
                    </tr>
                </tbody>
            </table>

            <h3 class="section-title">2. Jadwal Seleksi PMB UNESA 2026/2027</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th>Gelombang</th>
                        <th>Periode Pendaftaran</th>
                        <th>Tes / Verifikasi</th>
                        <th>Pengumuman</th>
                        <th>Registrasi Ulang</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Gelombang 1</strong></td>
                        <td>10 Feb – 30 Apr 2026</td>
                        <td>04 – 08 Mei 2026</td>
                        <td>15 Mei 2026</td>
                        <td>18 – 31 Mei 2026</td>
                    </tr>
                    <tr>
                        <td><strong>Gelombang 2</strong></td>
                        <td>01 Mei – 30 Jun 2026</td>
                        <td>06 – 10 Jul 2026</td>
                        <td>17 Juli 2026</td>
                        <td>20 – 31 Juli 2026</td>
                    </tr>
                    <tr>
                        <td><strong>Gelombang 3</strong></td>
                        <td>05 Jul – 15 Ags 2026</td>
                        <td>18 – 21 Ags 2026</td>
                        <td>25 Agustus 2026</td>
                        <td>26 – 31 Ags 2026</td>
                    </tr>
                </tbody>
            </table>

            <h3 class="section-title">3. Persyaratan Pendaftaran</h3>
            <ul style="margin:4px 0 10px 18px; padding:0; font-size:8.5pt;">
                <li>Ijazah Sarjana (S1) atau Sarjana Terapan (D4) bidang Akuntansi dari PTN/PTS terakreditasi minimum Baik/B.</li>
                <li>Transkrip nilai akademik dengan Indeks Prestasi Kumulatif (IPK) minimum 2.75 dari skala 4.00.</li>
                <li>Salinan Kartu Tanda Penduduk (KTP) dan Kartu Keluarga (KK) yang masih berlaku.</li>
                <li>Pasfoto formal terbaru ukuran 4x6 berlatar belakang warna merah/biru.</li>
                <li>Surat Pernyataan Kesanggupan Mengikuti Perkuliahan dan Menaati Tata Tertib Akademik UNESA.</li>
            </ul>

            <h3 class="section-title">4. Alur Prosedur Pendaftaran Online</h3>
            <ol style="margin:4px 0 10px 18px; padding:0; font-size:8.5pt;">
                <li>Kunjungi portal resmi PMB UNESA di <strong>https://pmb.unesa.ac.id</strong> dan pilih menu pendaftaran Program Profesi.</li>
                <li>Daftarkan akun baru menggunakan NIK KTP dan alamat email aktif. Konfirmasi aktivasi melalui tautan email.</li>
                <li>Pilih program studi <strong>Pendidikan Profesi Akuntan (Kode Prodi: 62902)</strong>.</li>
                <li>Dapatkan kode pembayaran Virtual Account dan lakukan pelunasan biaya seleksi melalui Bank Mandiri, BTN, BNI, BRI, atau BSI.</li>
                <li>Unggah berkas pindaian (scan) persyaratan format PDF/JPG dan lakukan finalisasi data untuk mencetak Kartu Tanda Peserta.</li>
            </ol>

            <table class="ttd-box">
                <tr>
                    <td class="ttd-col">
                        <strong>Sekretariat PPAk FEB UNESA</strong><br>
                        Gedung G10 Lantai 2, Kampus Ketintang Surabaya<br>
                        Email: ppak@unesa.ac.id | WhatsApp: 0812-3456-7890<br>
                        Laman Resmi: https://feb.unesa.ac.id
                    </td>
                    <td class="ttd-col" style="text-align:right;">
                        <strong>Pusat Admisi Penerimaan Mahasiswa Baru</strong><br>
                        Kantor Rektorat UNESA Kampus Lidah Wetan<br>
                        Laman PMB: https://pmb.unesa.ac.id<br>
                        Helpdesk: admisi@unesa.ac.id
                    </td>
                </tr>
            </table>

            <div class="footer-note">
                Brosur & Panduan Admisi Resmi PPAk FEB UNESA 2026/2027 &bull; Seluruh proses seleksi dilakukan secara transparan melalui portal resmi UNESA.
            </div>
        </body>
        </html>';
    }

    private function getKurikulumHtml(): string
    {
        return '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Panduan Kurikulum & CPL PPAk FEB UNESA</title>
            <style>' . $this->getBaseStyles() . '</style>
        </head>
        <body>
            <div class="kop">
                <div class="kop-instansi">Kementerian Pendidikan Tinggi, Sains, dan Teknologi</div>
                <div class="kop-univ">Universitas Negeri Surabaya</div>
                <div class="kop-fakultas">Fakultas Ekonomika dan Bisnis</div>
                <div class="kop-prodi">Program Pendidikan Profesi Akuntan (PPAk) &bull; Kode Prodi: 62902</div>
                <div class="kop-alamat">Kampus Ketintang, Jalan Ketintang, Surabaya 60231 | Telp. (031) 8280009 | sindig.unesa.ac.id</div>
            </div>

            <div class="doc-title-box">
                <div class="doc-title">BUKU PEDOMAN KURIKULUM & CAPAIAN PEMBELAJARAN LULUSAN (CPL)</div>
                <div class="doc-subtitle">Terdaftar pada Pangkalan Data Sistem Kurikulum Terintegrasi (SINDIG) UNESA</div>
                <div class="doc-badge">Beban Studi: 26 SKS &bull; 11 Mata Kuliah &bull; Gelar: Ak. (Akuntan)</div>
            </div>

            <h3 class="section-title">1. Capaian Pembelajaran Lulusan (CPL) Program Studi</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width:12%;">Kode CPL</th>
                        <th style="width:28%;">Kategori Standar</th>
                        <th style="width:60%;">Deskripsi Capaian Pembelajaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>CPL-01</strong></td>
                        <td>Sikap & Etika Profesi</td>
                        <td>Menunjukkan integritas moral tinggi, objektivitas, independensi mental, serta kepatuhan ketat terhadap Kode Etik Profesi Akuntan Indonesia dalam setiap penugasan asurans dan non-asurans.</td>
                    </tr>
                    <tr>
                        <td><strong>CPL-02</strong></td>
                        <td>Pengetahuan Terapan</td>
                        <td>Menguasai konsep teoritis mendalam tentang Standar Akuntansi Keuangan (SAK/IFRS), Standar Audit (SPAP/ISA), regulasi perpajakan nasional-internasional, dan manajemen risiko korporasi.</td>
                    </tr>
                    <tr>
                        <td><strong>CPL-03</strong></td>
                        <td>Keterampilan Umum</td>
                        <td>Mampu mengambil keputusan manajerial stratejik berbasis analisis big data keuangan, kepemimpinan kolaboratif lintas disiplin, dan komunikasi profesional tingkat tinggi.</td>
                    </tr>
                    <tr>
                        <td><strong>CPL-04</strong></td>
                        <td>Keterampilan Khusus</td>
                        <td>Mampu merancang sistem pengendalian internal, melaksanakan audit forensik dan penjaminan mutu laporan keuangan independen, serta merancang skema perencanaan pajak yang taat hukum.</td>
                    </tr>
                </tbody>
            </table>

            <h3 class="section-title">2. Struktur Distribusi 11 Mata Kuliah SINDIG UNESA (26 SKS)</h3>
            <div style="font-weight:bold; margin-top:4px; font-size:9pt; color:#002b66;">Semester 1 (14 SKS)</div>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width:15%;">Kode MK</th>
                        <th style="width:40%;">Nama Mata Kuliah</th>
                        <th style="width:10%;">SKS</th>
                        <th style="width:15%;">Jenis</th>
                        <th style="width:20%;">Pemetaan CPL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PAK801</td>
                        <td>Pelaporan Keuangan Lanjutan & Analisis Bisnis</td>
                        <td style="text-align:center;">3</td>
                        <td>Wajib Prodi</td>
                        <td>CPL-02, CPL-04</td>
                    </tr>
                    <tr>
                        <td>PAK802</td>
                        <td>Auditing Lanjutan & Praktik Penjaminan Mutu</td>
                        <td style="text-align:center;">3</td>
                        <td>Wajib Prodi</td>
                        <td>CPL-01, CPL-04</td>
                    </tr>
                    <tr>
                        <td>PAK803</td>
                        <td>Akuntansi Manajemen Strategik</td>
                        <td style="text-align:center;">3</td>
                        <td>Wajib Prodi</td>
                        <td>CPL-02, CPL-03</td>
                    </tr>
                    <tr>
                        <td>PAK804</td>
                        <td>Perpajakan Lanjutan & Perencanaan Pajak</td>
                        <td style="text-align:center;">3</td>
                        <td>Wajib Prodi</td>
                        <td>CPL-02, CPL-04</td>
                    </tr>
                    <tr>
                        <td>PAK805</td>
                        <td>Etika Bisnis & Tata Kelola Korporasi</td>
                        <td style="text-align:center;">2</td>
                        <td>Wajib Institusi</td>
                        <td>CPL-01, CPL-03</td>
                    </tr>
                </tbody>
            </table>

            <div style="font-weight:bold; margin-top:8px; font-size:9pt; color:#002b66;">Semester 2 (12 SKS)</div>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width:15%;">Kode MK</th>
                        <th style="width:40%;">Nama Mata Kuliah</th>
                        <th style="width:10%;">SKS</th>
                        <th style="width:15%;">Jenis</th>
                        <th style="width:20%;">Pemetaan CPL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PAK806</td>
                        <td>Sistem Informasi & Analitika Data Akuntansi</td>
                        <td style="text-align:center;">3</td>
                        <td>Wajib Prodi</td>
                        <td>CPL-03, CPL-04</td>
                    </tr>
                    <tr>
                        <td>PAK807</td>
                        <td>Manajemen Keuangan Stratejik</td>
                        <td style="text-align:center;">3</td>
                        <td>Wajib Prodi</td>
                        <td>CPL-02, CPL-03</td>
                    </tr>
                    <tr>
                        <td>PAK808</td>
                        <td>Manajemen Risiko Bisnis & Audit Internal</td>
                        <td style="text-align:center;">2</td>
                        <td>Wajib Prodi</td>
                        <td>CPL-02, CPL-04</td>
                    </tr>
                    <tr>
                        <td>PAK809</td>
                        <td>Akuntansi Sektor Publik Lanjutan</td>
                        <td style="text-align:center;">2</td>
                        <td>Wajib Prodi</td>
                        <td>CPL-02, CPL-04</td>
                    </tr>
                    <tr>
                        <td>PAK810</td>
                        <td>Praktik Audit Komprehensif / Laboratorium</td>
                        <td style="text-align:center;">2</td>
                        <td>Praktika Profesi</td>
                        <td>CPL-01, CPL-04</td>
                    </tr>
                </tbody>
            </table>

            <table class="ttd-box">
                <tr>
                    <td class="ttd-col">
                        Disahkan oleh,<br>
                        <strong>Ketua Jurusan Akuntansi FEB UNESA</strong><br><br><br><br>
                        <strong>Dr. Dian Anita Sari, S.E., M.Si., Ak.</strong><br>
                        NIP 197805122005012002
                    </td>
                    <td style="width: 10%;"></td>
                    <td class="ttd-col">
                        Surabaya, 2026<br>
                        <strong>Koordinator Program Studi PPAk FEB UNESA</strong><br><br><br><br>
                        <strong>Dr. Wiwit Hariyanto, M.Si., Ak.</strong><br>
                        NIP 197503152003121002
                    </td>
                </tr>
            </table>

            <div class="footer-note">
                Pedoman Kurikulum & Capaian Pembelajaran Lulusan PPAk FEB UNESA &bull; SINDIG UNESA &bull; sindig.unesa.ac.id
            </div>
        </body>
        </html>';
    }

    private function getFormulirPmbHtml(): string
    {
        return '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Formulir Verifikasi Berkas PMB PPAk FEB UNESA</title>
            <style>' . $this->getBaseStyles() . '
                .checkbox-box {
                    display: inline-block;
                    width: 12px;
                    height: 12px;
                    border: 1px solid #333;
                    margin-right: 5px;
                    vertical-align: middle;
                }
            </style>
        </head>
        <body>
            <div class="kop">
                <div class="kop-instansi">Kementerian Pendidikan Tinggi, Sains, dan Teknologi</div>
                <div class="kop-univ">Universitas Negeri Surabaya</div>
                <div class="kop-fakultas">Fakultas Ekonomika dan Bisnis &bull; Subbagian Akademik & Kemahasiswaan</div>
                <div class="kop-prodi">Program Pendidikan Profesi Akuntan (PPAk) &bull; Kode Prodi: 62902</div>
                <div class="kop-alamat">Kampus Ketintang Surabaya 60231 | Gedung G10 FEB UNESA | Telp. (031) 8280009 | pmb.unesa.ac.id</div>
            </div>

            <div class="doc-title-box">
                <div class="doc-title">FORMULIR PENDAFTARAN & LEMBAR VERIFIKASI BERKAS</div>
                <div class="doc-subtitle">PENERIMAAN MAHASISWA BARU PROGRAM PROFESI TAHUN AKADEMIK 2026/2027</div>
                <div class="doc-badge">Lembar Resmi Verifikasi Admisi FEB UNESA</div>
            </div>

            <h3 class="section-title">A. Data Identitas Calon Mahasiswa</h3>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Nomor Registrasi PMB</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">........................................................................................................................</td>
                </tr>
                <tr>
                    <td class="info-label">Nomor Induk Kependudukan (NIK)</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">........................................................................................................................</td>
                </tr>
                <tr>
                    <td class="info-label">Nama Lengkap (sesuai Ijazah)</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">........................................................................................................................</td>
                </tr>
                <tr>
                    <td class="info-label">Tempat & Tanggal Lahir</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">........................................................................................................................</td>
                </tr>
                <tr>
                    <td class="info-label">Perguruan Tinggi Asal (S1/D4)</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">........................................................................................................................</td>
                </tr>
                <tr>
                    <td class="info-label">Tahun Kelulusan & IPK</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">Tahun: .............. &bull; IPK: ............ (Skala 4.00)</td>
                </tr>
                <tr>
                    <td class="info-label">Nomor HP / WhatsApp Aktif</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">........................................................................................................................</td>
                </tr>
                <tr>
                    <td class="info-label">Alamat Pos-el (Email)</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">........................................................................................................................</td>
                </tr>
            </table>

            <h3 class="section-title">B. Lembar Verifikasi Kelengkapan Dokumen Fisik / Digital</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width:8%;">No</th>
                        <th style="width:52%;">Item Dokumen Persyaratan</th>
                        <th style="width:20%; text-align:center;">Kelengkapan</th>
                        <th style="width:20%;">Catatan Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;">1</td>
                        <td>Salinan Ijazah Sarjana (S1/D4) Akuntansi Legalisir / Asli</td>
                        <td style="text-align:center;"><span class="checkbox-box"></span> Lengkap &nbsp; <span class="checkbox-box"></span> Tidak</td>
                        <td>.........................</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">2</td>
                        <td>Salinan Transkrip Nilai Akademik S1/D4 Legalisir / Asli</td>
                        <td style="text-align:center;"><span class="checkbox-box"></span> Lengkap &nbsp; <span class="checkbox-box"></span> Tidak</td>
                        <td>.........................</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">3</td>
                        <td>Fotokopi Kartu Tanda Penduduk (KTP) & Kartu Keluarga (KK)</td>
                        <td style="text-align:center;"><span class="checkbox-box"></span> Lengkap &nbsp; <span class="checkbox-box"></span> Tidak</td>
                        <td>.........................</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">4</td>
                        <td>Pasfoto Formal Berwarna Terbaru Ukuran 4x6 (2 Lembar)</td>
                        <td style="text-align:center;"><span class="checkbox-box"></span> Lengkap &nbsp; <span class="checkbox-box"></span> Tidak</td>
                        <td>.........................</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">5</td>
                        <td>Bukti Pembayaran Biaya Pendaftaran PMB (Virtual Account)</td>
                        <td style="text-align:center;"><span class="checkbox-box"></span> Lengkap &nbsp; <span class="checkbox-box"></span> Tidak</td>
                        <td>.........................</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">6</td>
                        <td>Surat Bebas Narkoba & Keterangan Sehat Jasmani</td>
                        <td style="text-align:center;"><span class="checkbox-box"></span> Lengkap &nbsp; <span class="checkbox-box"></span> Tidak</td>
                        <td>.........................</td>
                    </tr>
                </tbody>
            </table>

            <h3 class="section-title">C. Pakta Integritas Mahasiswa PPAk FEB UNESA</h3>
            <p style="font-size:8pt;">Dengan ini saya menyatakan bahwa data dan berkas yang saya serahkan adalah benar dan sah. Saya bersedia mematuhi seluruh tata tertib kehidupan kampus, kode etik mahasiswa UNESA, serta berkomitmen menuntaskan program studi dengan penuh kejujuran akademik.</p>

            <table class="ttd-box">
                <tr>
                    <td class="ttd-col">
                        Petugas Verifikator Admisi FEB UNESA,<br><br><br><br>
                        ( ............................................................ )<br>
                        NIP.
                    </td>
                    <td style="width: 10%;"></td>
                    <td class="ttd-col">
                        Surabaya, .................................... 2026<br>
                        Calon Mahasiswa PPAk FEB UNESA,<br><br><br><br>
                        ( ............................................................ )<br>
                        Tanda Tangan & Nama Terang
                    </td>
                </tr>
            </table>

            <div class="footer-note">
                Formulir Resmi Subbagian Akademik FEB UNESA &bull; PMB UNESA 2026/2027 &bull; Dokumen Wajib Verifikasi Registrasi
            </div>
        </body>
        </html>';
    }

    private function getPanduanWaiverCaHtml(): string
    {
        return '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Panduan Pengajuan Waiver Ujian CA IAI - PPAk FEB UNESA</title>
            <style>' . $this->getBaseStyles() . '</style>
        </head>
        <body>
            <div class="kop">
                <div class="kop-instansi">Ikatan Akuntan Indonesia (IAI) &bull; Wilayah Jawa Timur</div>
                <div class="kop-univ">Universitas Negeri Surabaya</div>
                <div class="kop-fakultas">Fakultas Ekonomika dan Bisnis &bull; Jurusan Akuntansi</div>
                <div class="kop-prodi">Program Pendidikan Profesi Akuntan (PPAk) &bull; Kode Prodi: 62902</div>
                <div class="kop-alamat">Sekretariat Bersama IAI - UNESA: Kampus Ketintang Surabaya 60231 | iaiglobal.or.id | feb.unesa.ac.id</div>
            </div>

            <div class="doc-title-box">
                <div class="doc-title">PANDUAN PENGAJUAN PEMBEBASAN UJIAN (WAIVER) SERTIFIKASI CA</div>
                <div class="doc-subtitle">CHARTERED ACCOUNTANT (CA) INDONESIA &bull; IKATAN AKUNTAN INDONESIA (IAI)</div>
                <div class="doc-badge">Khusus Lulusan & Mahasiswa Program Pendidikan Profesi Akuntan FEB UNESA</div>
            </div>

            <div class="highlight-card">
                Berdasarkan Nota Kesepahaman (MoU) dan Rekognisi Kurikulum antara <strong>Ikatan Akuntan Indonesia (IAI)</strong> dan <strong>Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya</strong>, kurikulum PPAk UNESA (26 SKS) telah diselaraskan dengan silabus ujian sertifikasi profesi akuntan Chartered Accountant (CA).
            </div>

            <h3 class="section-title">1. Skema Pembebasan Mata Ujian Sertifikasi (Waiver CA)</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width:10%;">No</th>
                        <th style="width:40%;">Mata Uji Sertifikasi CA IAI</th>
                        <th style="width:35%;">Mata Kuliah Ekuivalen PPAk FEB UNESA</th>
                        <th style="width:15%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;">1</td>
                        <td>Pelaporan Korporat (Corporate Reporting)</td>
                        <td>PAK801 - Pelaporan Keuangan Lanjutan</td>
                        <td><strong style="color:#002b66;">WAIVER</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">2</td>
                        <td>Audit & Asurans Lanjutan (Adv. Audit & Assurance)</td>
                        <td>PAK802 & PAK810 - Auditing Lanjutan & Praktik</td>
                        <td><strong style="color:#002b66;">WAIVER</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">3</td>
                        <td>Manajemen Stratejik & Kepemimpinan</td>
                        <td>PAK803 & PAK807 - Manajemen Stratejik</td>
                        <td><strong style="color:#002b66;">WAIVER</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">4</td>
                        <td>Manajemen Perpajakan Lanjutan</td>
                        <td>PAK804 - Perpajakan Lanjutan & Perencanaan</td>
                        <td><strong style="color:#002b66;">WAIVER</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">5</td>
                        <td>Sistem Informasi & Pengendalian Internal</td>
                        <td>PAK806 & PAK808 - SI & Manajemen Risiko</td>
                        <td><strong style="color:#002b66;">WAIVER</strong></td>
                    </tr>
                </tbody>
            </table>

            <h3 class="section-title">2. Prosedur & Tata Cara Pengajuan Waiver</h3>
            <ol style="margin:4px 0 10px 18px; padding:0; font-size:8.5pt;">
                <li><strong>Permohonan Surat Rekomendasi:</strong> Mengajukan surat rekomendasi resmi bebas ujian (Waiver) ke Sekretariat PPAk FEB UNESA Kampus Ketintang dengan melampirkan Transkrip Nilai Akademik PPAk.</li>
                <li><strong>Registrasi Anggota IAI:</strong> Memiliki Nomor Keanggotaan IAI (Madya / Utama) yang masih aktif melalui portal <strong>https://iaiglobal.or.id</strong>.</li>
                <li><strong>Pengunggahan Dokumen di Portal IAI:</strong> Mengunggah Surat Rekomendasi Kaprodi PPAk UNESA, Ijazah S1 Akuntansi, Ijazah PPAk (atau SKL), dan Transkrip Nilai PPAk pada modul pendaftaran ujian CA IAI.</li>
                <li><strong>Verifikasi & Konfirmasi:</strong> Tim Verifikasi Sertifikasi Dewan Pengurus Nasional IAI akan menerbitkan Surat Keterangan Pembebasan Ujian (Waiver Confirmation Letter) dalam waktu maksimal 7 hari kerja.</li>
                <li><strong>Penyelesaian Sisa Ujian:</strong> Peserta hanya menempuh mata uji wajib akhir / studi kasus komprehensif yang ditetapkan IAI untuk memperoleh sertifikasi gelar CA Indonesia.</li>
            </ol>

            <h3 class="section-title">3. Kontak Layanan Konsultasi Waiver</h3>
            <table class="info-grid">
                <tr>
                    <td class="info-label">Sekretariat PPAk FEB UNESA</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">Gedung G10 Kampus Ketintang Surabaya | Email: ppak@unesa.ac.id</td>
                </tr>
                <tr>
                    <td class="info-label">IAI Wilayah Jawa Timur</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">Jl. Ngagel Jaya Selatan No. 169 Surabaya | Telp. (031) 5021234</td>
                </tr>
            </table>

            <table class="ttd-box">
                <tr>
                    <td class="ttd-col">
                        Mengetahui,<br>
                        <strong>Pengurus IAI Wilayah Jawa Timur</strong><br><br><br><br>
                        ( ............................................................ )
                    </td>
                    <td style="width: 10%;"></td>
                    <td class="ttd-col">
                        Surabaya, 2026<br>
                        <strong>Ketua Program Studi PPAk FEB UNESA</strong><br><br><br><br>
                        <strong>Dr. Wiwit Hariyanto, M.Si., Ak.</strong><br>
                        NIP 197503152003121002
                    </td>
                </tr>
            </table>

            <div class="footer-note">
                Panduan Rekognisi Ujian Profesi CA &bull; Kerjasama IAI & FEB UNESA &bull; iaiglobal.or.id &bull; feb.unesa.ac.id
            </div>
        </body>
        </html>';
    }
}
