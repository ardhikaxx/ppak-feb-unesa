# Changelog

Semua perubahan penting proyek ini dicatat di sini dengan format
[Keep a Changelog](https://keepachangelog.com/id/1.1.0/).

## [1.0.0] - 2026-09-20

Rilis CMS Admin — seluruh konten website dapat dikelola dari database.

### Ditambahkan

- CMS Admin (`/admin/*`): login, dashboard statistik real, dan 20+ modul
  (profil, akreditasi, dosen, kurikulum, CPL, kalender akademik, gelombang
  admisi, biaya, FAQ, publikasi, riset, PKM, kerja sama, testimoni, alumni,
  berita, agenda, galeri, dokumen, kategori, media manager, pengaturan
  website, helpdesk, audit log, kelola admin, profil).
- Guard autentikasi `admin` terpisah + middleware `admin.auth`/`admin.active`.
- Tabel `admins`, `site_settings`, kolom `period_label`; seeder `AdminSeeder`
  dan `SiteSettingSeeder` (idempotent).
- `EloquentContentRepository`: frontend dibaca dari database dengan bentuk
  data identik (tanpa perubahan Blade/CSS).
- Sanitasi HTML, validasi upload, soft delete + restore, audit log,
  throttle login 5x/menit.
- Test CMS (`AdminCmsTest`): total suite menjadi 30 test / 271 assertion.
- Dokumentasi: `README.md` baru, `docs/CMS.md`, `docs/PANDUAN-ADMIN.md`,
  `docs/DEPLOYMENT.md`.

### Diperbaiki

- Tanggal akurat kalender akademik 2026/2027 + label periode resmi pada seeder.
- Tanggal selesai (end date) agenda pada seeder.
- Format ukuran dokumen mengikuti dokumen resmi (KB/MB desimal).
- Checkbox "Ingat saya" pada login admin (nilai `1` agar lolos validasi boolean).

## [0.1.0] - 2026-09-18

Rilis awal website profil (frontend publik).

### Ditambahkan

- 27 route publik: beranda, profil, akademik, admisi, riset & pengabdian,
  kemahasiswaan & alumni, informasi (berita/agenda/galeri), kontak, pencarian,
  sitemap XML.
- Komponen Blade, sistem desain institusional (UNESA Gold & Navy), logo resmi.
- Data master statis terverifikasi (`PpakData`): SK Rektor, SK LAMEMBA,
  kalender 2026/2027, UKT Rp5.500.000, kurikulum & CPL SINDIG.
- 6 dokumen PDF resmi di `public/documents`.
- Test frontend (`PpakRoutesTest`, 21 test) + konfigurasi Pest.
