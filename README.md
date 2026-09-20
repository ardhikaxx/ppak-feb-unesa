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

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur Website Publik](#fitur-website-publik)
- [Fitur CMS Admin](#fitur-cms-admin)
- [Teknologi](#teknologi)
- [Sumber Data Resmi](#sumber-data-resmi)
- [Struktur Proyek](#struktur-proyek)
- [Instalasi](#instalasi)
- [Akun Demo](#akun-demo)
- [Pengujian](#pengujian)
- [Keamanan](#keamanan)
- [Dokumentasi](#dokumentasi)
- [Deployment](#deployment)
- [Penulis](#penulis)
- [Lisensi](#lisensi)

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

Akses di `/admin/login` → `/admin/dashboard`. Selengkapnya di [docs/CMS.md](docs/CMS.md).

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

> File seeder bersifat final dan hanya dibaca/di-seed ulang oleh AI maupun pengembang.
> Perubahan data operasional dilakukan lewat CMS `/admin`, bukan dengan mengedit seeder.

## Struktur Proyek

```text
app/
├── Contracts/            # Kontrak repository konten (frontend)
├── Http/
│   ├── Controllers/      # Controller publik (per domain)
│   │   └── Admin/        # Controller CMS (per modul, terpisah dari publik)
│   ├── Middleware/       # admin.auth, admin.active
│   └── Requests/Admin/   # Validasi server-side tiap form CMS
├── Models/               # Eloquent (News, Lecturer, Document, Admin, ...)
├── Repositories/
│   ├── EloquentContentRepository.php  # Sumber data frontend (database) — aktif
│   └── ArrayContentRepository.php     # Implementasi statis lama (referensi)
├── Services/PpakData.php # Data master statis (read-only, acuan seeder)
└── Support/              # CacheKeys, ContentCache, ArrayPaginator
database/
├── migrations/           # Termasuk admins & site_settings
└── seeders/              # PpakDatabaseSeeder, AdminSeeder, SiteSettingSeeder
docs/                     # CMS.md, PANDUAN-ADMIN.md, DEPLOYMENT.md
resources/views/
├── <publik>              # Blade frontend (tidak diubah oleh CMS)
└── admin/                # Blade CMS (layout, dashboard, CRUD per modul)
routes/
├── web.php               # Route publik
└── admin.php             # Route CMS prefix /admin
tests/Feature/           # PpakRoutesTest, AdminCmsTest
```

## Instalasi

Kebutuhan: PHP ^8.3 (ekstensi standar Laravel), Composer, Node.js (opsional, untuk build aset).

```bash
# 1. Clone & masuk direktori
git clone https://github.com/ardhikaxx/ppak-feb-unesa.git
cd ppak-feb-unesa

# 2. Dependensi PHP
composer install

# 3. Environment
cp .env.example .env
php artisan key:generate

# 4. Database + data awal
php artisan migrate --force
php artisan db:seed --force

# 5. Storage untuk upload CMS (wajib)
php artisan storage:link

# 6. Jalankan
php artisan serve
```

Buka `http://localhost:8000` untuk website dan `http://localhost:8000/admin/login` untuk CMS.
Untuk XAMPP, arahkan virtual host/document root ke folder `public/`.

## Akun Demo

Kredensial demo (khusus pengembangan, didefinisikan di `database/seeders/AdminSeeder.php`):

| Item | Nilai |
|---|---|
| URL | `/admin/login` |
| Email | `admin@gmail.com` |
| Password | `password` |

> Untuk produksi, ganti kredensial ini dan kelola akun lewat menu **Kelola Admin** di CMS.

## Pengujian

```bash
php artisan test
```

- `tests/Feature/PpakRoutesTest.php` — 21 test yang memastikan seluruh halaman publik
  (termasuk 6 unduhan PDF resmi dan redirect alias 301) tetap tampil dengan data yang benar.
- `tests/Feature/AdminCmsTest.php` — autentikasi, guard route, siklus CRUD berita
  (draft → terbit → arsip → restore) yang tercermin di frontend, validasi, logout,
  rate limiting, dan smoke test 50+ halaman CMS.

## Keamanan

- Guard `admin` terpisah dari pengguna publik; password di-hash (bcrypt).
- Throttle login 5x/menit per email+IP; CSRF di semua form; regenerasi session saat login/logout.
- Validasi server-side (Form Request) + sanitasi HTML konten; upload dibatasi tipe & ukuran.
- Soft delete + restore untuk data penting; audit log mencatat setiap perubahan (tanpa password).

## Dokumentasi

- [docs/CMS.md](docs/CMS.md) — dokumentasi teknis CMS (arsitektur, tabel, route, keamanan).
- [docs/PANDUAN-ADMIN.md](docs/PANDUAN-ADMIN.md) — panduan penggunaan CMS untuk admin.
- [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md) — panduan deployment (XAMPP & shared hosting).
- [CONTRIBUTING.md](CONTRIBUTING.md) — panduan kontribusi.
- [SECURITY.md](SECURITY.md) — kebijakan keamanan & pelaporan kerentanan.
- [CHANGELOG.md](CHANGELOG.md) — riwayat perubahan per versi.

## Deployment

Ringkasan: upload file (tanpa `node_modules`), set document root ke `public/`,
salin `.env` produksi, `composer install --no-dev`, `php artisan migrate --force`,
`php artisan db:seed --force`, `php artisan storage:link`, lalu cache config/route/view.
Panduan lengkap di [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md).

## Penulis

Dikembangkan oleh **Yanuar Ardhika Rahmadhani Ubaidillah**.

- GitHub: [@ardhikaxx](https://github.com/ardhikaxx)
- Repository: [ardhikaxx/ppak-feb-unesa](https://github.com/ardhikaxx/ppak-feb-unesa)

## Lisensi

Proyek ini menggunakan lisensi MIT — lihat file [LICENSE](LICENSE). Data dan dokumen
institusi di dalamnya adalah milik Universitas Negeri Surabaya dan digunakan untuk
keperluan informasi akademik.
