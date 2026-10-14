# 📋 Catatan Perubahan (Changelog)

Semua perubahan penting, pembaruan fitur, dan perbaikan pada proyek **Website Profil PPAk FEB UNESA + CMS Admin** didokumentasikan dalam file ini.

Format pencatatan mengacu pada [Keep a Changelog](https://keepachangelog.com/id/1.1.0/) dan mematuhi kaidah [Semantic Versioning (SemVer)](https://semver.org/).

---

## [1.1.0] - 2026-09-25

### ✨ Ditambahkan (Added)
- **Role-Based Access Control (RBAC) CMS Admin**:
  - Pembagian wewenang eksplisit antara peran `super_admin` (akses penuh: kelola admin, audit log, konfigurasi sistem) dan `operator` (pengelolaan konten berita, agenda, galeri, dokumen, FAQ, riset, kurikulum, dan dosen).
  - Otorisasi server-side melalui middleware `admin.access` dan `admin.role:super_admin` dengan prinsip *deny-by-default* (HTTP 403).
  - Penyesuaian antarmuka sidebar CMS secara otomatis sesuai peran yang sedang login.
  - Proteksi akun super admin terakhir dari penghapusan atau penonaktifan.
  - Test suite baru `AdminRbacTest`.
- **Fitur Lupa Password Admin**:
  - Alur pemulihan kata sandi admin mandiri: verifikasi email terdaftar → pembuatan kata sandi baru.
  - Umpan balik visual interaktif dengan SweetAlert2 dan toast notifikasi di halaman login.
- **Validasi Terstruktur (FormRequest)**:
  - Pembuatan form request terdedikasi untuk seluruh modul CMS dengan pesan validasi berbahasa Indonesia yang jelas dan ramah pengguna.
- **Keamanan Unggah Berkas & Media**:
  - Penerapan visibilitas berkas unggahan non-publik dan validasi MIME-type riil berbasis binary content (`ext-fileinfo`).
  - Helper khusus format ukuran berkas desimal resmi (KB/MB).
- **HTTP Security Headers & Content Security Policy (CSP)**:
  - Penerapan header keamanan modern termasuk izin iframe embed Google Maps untuk peta lokasi kampus FEB UNESA.

### ⚡ Dioptimalkan (Performance & Refactoring)
- **Optimasi Query & Caching**:
  - Optimasi kueri database pada halaman Beranda publik dan penyempurnaan mekanisme *cache flushing* terpusat saat konten diubah di CMS.
  - Pembacaan konfigurasi TTL cache yang fleksibel dan seleksi kolom spesifik pada daftar berita publik untuk menghemat memori.
- **Pembersihan & Perampingan Frontend**:
  - Penghapusan build tools (Vite & Tailwind) dan konsolidasi menggunakan Bootstrap 5.3 CDN + vanilla JS murni tanpa proses kompilasi aset yang rumit.
  - Konsolidasi komponen Blade *page header* publik agar seragam dan mudah dirawat.

### 🐛 Diperbaiki (Fixed)
- Perbaikan whitelist frame-src CSP untuk iframe Google Maps pada halaman Kontak.
- Pembersihan berkas artefak uji otomatis pada lingkungan testing.

---

## [1.0.0] - 2026-09-20

### 🚀 Rilis Perdana CMS Admin (Initial CMS Release)
- **CMS Admin Terintegrasi (`/admin/*`)**:
  - Dashboard analitik dengan statistik konten *real-time* dari basis data, ringkasan periode akademik aktif, riwayat konten terakhir diubah, dan log audit mutakhir.
  - 20+ modul manajemen konten: Profil Program, Akreditasi, Dosen & Pengajar, Kurikulum (pemetaan CPL), Kalender Akademik, Admisi (Gelombang Pendaftaran, Biaya Pendidikan, FAQ), Riset, PKM, Kemitraan, Berita & Artikel (draft/publish/scheduled/arsip), Agenda Kegiatan, Galeri Foto, Dokumen & Kategori, Media Manager, Pengaturan Global Website, Helpdesk Masuk, Audit Log, Kelola Admin, dan Profil Pribadi.
- **Pemisahan Guard Autentikasi**:
  - Guard terpisah `admin` (driver session) dengan entitas tabel `admins`.
  - Middleware perlindungan `admin.auth` dan `admin.active` (pemblokiran otomatis akun nonaktif).
  - Pembatasan laju percobaan login (*rate limiting*) 5 kali per menit per email dan IP untuk mencegah serangan *brute force*.
- **Pola Arsitektur Repository**:
  - Implementasi `EloquentContentRepository` berbasis kontrak `ContentRepositoryInterface`, menjamin halaman publik membaca basis data tanpa mengubah markup Blade dan CSS yang sudah ada.
- **Integritas & Audit Data**:
  - Mekanisme soft delete dan pemulihan (*restore*) data pada modul krusial.
  - Sanitasi HTML terpusat pada controller untuk melindungi sistem dari serangan XSS tersimpan.
  - Pencatatan seluruh mutasi data administrator pada tabel `audit_logs`.
- **Pengujian & Dokumentasi Lengkap**:
  - Penambahan rangkaian test `AdminCmsTest` dan pengujian integrasi (30 test / 271 assertion).
  - Dokumentasi resmi: `README.md`, `docs/CMS.md`, `docs/PANDUAN-ADMIN.md`, dan `docs/DEPLOYMENT.md`.

---

## [0.1.0] - 2026-09-18

### 🌐 Rilis Awal Website Profil Publik (Initial Public Website)
- **Halaman & Rute Publik Lengkap (27 Route)**:
  - Beranda dengan hero banner, identitas prodi, statistik, keunggulan, ringkasan kurikulum, berita terkini, dan agenda mendatang.
  - Menu Profil: Sejarah, Visi-Misi & Tujuan, Struktur Organisasi, Profil Dosen/Pengajar, dan Riwayat Akreditasi.
  - Menu Akademik: Kurikulum komprehensif, Capaian Pembelajaran Lulusan (CPL), Kalender Akademik interaktif, Gelar & Sertifikasi Profesi Akuntan, Panduan Akademik.
  - Menu Admisi: Jalur & Persyaratan Pendaftaran, Rincian Biaya Pendidikan (UKT Rp5.500.000), Prosedur & Jadwal Seleksi, Tanya Jawab (FAQ).
  - Menu Riset & Pengabdian: Publikasi Ilmiah Dosen/Mahasiswa, Riset Terapan, Pengabdian Kepada Masyarakat (PKM), Mitra Kerja Sama.
  - Menu Kemahasiswaan & Alumni: Profil Mahasiswa, Ikatan Alumni, Testimoni Lulusan & Prospek Karier.
  - Menu Informasi & Kontak: Portal Berita, Agenda Kegiatan, Galeri Foto Kegiatan, Lokasi Kampus Ketintang, Formulir Helpdesk Interaktif, Portal Unduhan Dokumen Resmi PDF.
  - Fitur Pencarian Global terpadu (`/search`) dan Sitemap XML otomatis (`/sitemap.xml`).
- **Desain & Identitas Institusi**:
  - Sistem desain resmi UNESA mengusung palet UNESA Navy (`#0d2346`) dan Gold (`#cda851`).
  - Responsif di berbagai perangkat (desktop, tablet, smartphone) menggunakan Bootstrap 5.3 CDN dan Font Awesome 6 CDN.
- **Data Master Resmi Terverifikasi**:
  - Integrasi sumber data resmi SK Rektor No. 645/UN38/HK/2025, SK LAMEMBA No. 611/DE/A.5/AR.11/II/2025 (Peringkat Baik), Kalender Akademik UNESA 2026/2027, serta kurikulum & CPL SINDIG UNESA.
  - Penyiapan 6 dokumen PDF resmi institusi pada direktori `public/documents/`.
- **Pengujian Otomatis Awal**:
  - Test suite rute publik `PpakRoutesTest` (21 test) menggunakan kerangka kerja Pest.

---

[1.1.0]: https://github.com/ardhikaxx/ppak-feb-unesa/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/ardhikaxx/ppak-feb-unesa/compare/v0.1.0...v1.0.0
[0.1.0]: https://github.com/ardhikaxx/ppak-feb-unesa/releases/tag/v0.1.0
