<p align="center">
  <img src="public/images/logo-unesa.png" width="120" alt="Logo UNESA">
</p>

<h1 align="center">Website Profil PPAk FEB UNESA + CMS Admin</h1>

<p align="center">
  Website profil resmi <strong>Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya</strong>
  yang dilengkapi <strong>CMS (Content Management System)</strong> khusus admin untuk mengelola seluruh konten website secara dinamis.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-%5E8.3-777BB4?logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Database-MySQL_%2F_MariaDB-4479A1?logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Tested-Pest_5-4CAF50?logo=pest&logoColor=white" alt="Pest">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="MIT">
</p>

## Tentang Proyek

Aplikasi web profil Program Studi Pendidikan Profesi Akuntan (Kode Prodi **62902**)
FEB UNESA. Bagian frontend publik menampilkan informasi program, akademik, admisi,
riset, kemahasiswaan, berita, agenda, galeri, dokumen, dan kontak — semuanya dibaca
dari **database** melalui CMS admin, sehingga pengelola dapat memperbarui konten
tanpa menyentuh source code dan tanpa mengubah tampilan website.

## Fitur Website Publik

| Halaman | Route |
|---|---|
| Beranda (hero, identitas, statistik, keunggulan, kurikulum ringkas, berita, agenda) | `/` |
| Sejarah, Visi-Misi, Struktur Organisasi, Dosen & Pengajar, Akreditasi | `/profil/*` |
| Kurikulum, Kalender Akademik, Gelar & Sertifikasi, Panduan | `/akademik/*` |
| Jalur & Syarat, Biaya, Prosedur & Jadwal, FAQ | `/admisi/*` |
| Riset & Publikasi, Pengabdian, Kerja Sama | `/riset-pengabdian/*` |
| Alumni, Mahasiswa, Testimoni & Karier | `/kemahasiswaan-alumni/*` |
| Berita (paginasi, pencarian, filter kategori, detail slug), Agenda, Galeri | `/informasi/*` |
| Lokasi, Helpdesk, Unduhan (6 dokumen PDF resmi) | `/kontak/*` |
| Pencarian global & Sitemap XML | `/search`, `/sitemap.xml` |

## Fitur CMS Admin

CMS khusus admin dengan autentikasi terproteksi untuk mengelola seluruh konten website.

- **Dashboard** dengan statistik konten real dari database, konten terakhir diubah, dan audit log terakhir.
- **Profil PPAk**: profil program (satu sumber kebenaran), akreditasi, dosen/pengajar (foto, urutan tampil, aktif/nonaktif, arsip + restore).
- **Akademik**: kurikulum/mata kuliah (per semester, pemetaan CPL), CPL, kalender akademik (per tahun akademik & semester, arsip otomatis).
- **Admisi**: gelombang pendaftaran (aktif/segera dibuka/arsip), biaya pendidikan per periode (historis dipertahankan), FAQ berkategori.
- **Riset & Pengabdian**: publikasi, riset, PKM, kerja sama/mitra.
- **Kemahasiswaan & Alumni**: testimoni terverifikasi, data alumni.
- **Informasi & Publikasi**: berita (draft/terbit/terjadwal/arsip, slug unik, preview publik, restore), agenda/event, galeri foto.
- **Dokumen & Media**: upload dokumen (file lama tidak dihapus saat update), kategori (proteksi hapus), media manager (info pemakaian file).
- **Website**: pengaturan global (kontak, media sosial, SEO), helpdesk masuk, audit log, kelola akun admin, profil & password sendiri.

## Teknologi

- **Backend**: PHP ^8.3, Laravel 13, Eloquent ORM, Blade.
- **Frontend publik & CMS**: Bootstrap 5.3.3 CDN, Font Awesome 6.6.0 CDN (tanpa framework JS tambahan).
- **Database**: MySQL / MariaDB (XAMPP & Server Produksi).
- **Testing**: Pest 5 + PHPUnit (39 test, 310 assertion).
- **Lainnya**: `dompdf/dompdf` (cetak PDF), Vite + Tailwind CSS (build aset).

## Sumber Data Resmi

Seluruh data awal terverifikasi dari dokumen resmi dan dimuat melalui seeder idempotent
(`updateOrCreate`, aman dijalankan ulang):

- SK Rektor UNESA No. 645/UN38/HK/2025
- SK LAMEMBA No. 611/DE/A.5/AR.11/II/2025 (Peringkat **Baik**, berlaku s.d. 25 Februari 2027)
- Kalender Akademik UNESA 2026/2027 (Surat No. B/2322/UN38.I/TU.00.02/2026)
- UKT Admisi UNESA **Rp5.500.000/semester** (Kode Prodi 62902)
- Kurikulum & CPL SINDIG UNESA, portal PMB `pmb.unesa.ac.id`

## Penulis

Dikembangkan oleh **Yanuar Ardhika Rahmadhani Ubaidillah**.

- GitHub: [@ardhikaxx](https://github.com/ardhikaxx)
- Repository: [ardhikaxx/ppak-feb-unesa](https://github.com/ardhikaxx/ppak-feb-unesa)

## Lisensi

Proyek ini menggunakan lisensi MIT — lihat file [LICENSE](LICENSE). Data dan dokumen
institusi di dalamnya adalah milik Universitas Negeri Surabaya dan digunakan untuk
keperluan informasi akademik.
