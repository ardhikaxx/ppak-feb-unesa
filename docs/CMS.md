# CMS Admin PPAk FEB UNESA — Dokumentasi Teknis

CMS (Content Management System) khusus admin agar seluruh konten website yang
sebelumnya statis dapat dikelola dinamis dari database **tanpa mengubah
tampilan frontend**. Desain, layout, dan Blade publik tidak disentuh; yang
berubah hanya sumber datanya (array statis → database).

## 1. Arsitektur singkat

- Frontend publik membaca konten lewat `App\Contracts\ContentRepositoryInterface`.
- Implementasi aktif: `App\Repositories\EloquentContentRepository` (database).
  Bentuk array yang dikembalikan **identik** dengan sumber statis sebelumnya
  (`PpakData`/`ArrayContentRepository`), sehingga Blade tidak berubah.
- Implementasi lama (`ArrayContentRepository`) tetap tersimpan sebagai
  referensi/fallback, tidak lagi di-binding.
- Cache konten publik di `App\Support\CacheKeys`; invalidasi terpusat di
  `App\Support\ContentCache::flush()` yang dipanggil setiap aksi tulis CMS.
  Detail berita per-slug di-invalidate eksplisit agar perubahan langsung tampil.

## 2. Akun admin & autentikasi

- Tabel `admins` (terpisah dari `users`): `name`, `email` (unik), `password`
  (hash Laravel), `is_active`, `last_login_at`, timestamps.
- Guard `admin` (session) terdaftar di `config/auth.php`; tabel reset
  `admin_password_reset_tokens`.
- URL: `/admin/login` → sukses ke `/admin/dashboard`. Seluruh `/admin/*`
  dilindungi middleware `admin.auth:admin` + `admin.active`.
- Proteksi: CSRF, throttle login `admin-login` (5x/menit per email+IP),
  session regenerate saat login, invalidate + regenerate token saat logout.
- Akun nonaktif tidak bisa login; akses tanpa login dialihkan ke `/admin/login`.

## 3. Seeder & kredensial awal (idempotent)

Semua seeder memakai `updateOrCreate` sehingga aman dijalankan ulang:

| Seeder | Isi |
|---|---|
| `PpakDatabaseSeeder` | Seluruh data asli website (profil, akreditasi, CPL, kurikulum, kalender 2026/2027, UKT, gelombang admisi, dosen, publikasi, FAQ, berita, agenda, dokumen, galeri) |
| `AdminSeeder` | Akun admin awal dari ENV |
| `SiteSettingSeeder` | 25 pengaturan global dari data existing |

Kredensial awal hardcoded di `AdminSeeder` (khusus demo):

- Email: `admin@gmail.com`
- Password: `password`

## 4. Cara menjalankan

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link   # wajib: upload CMS memakai disk public (/storage)
php artisan serve          # lalu buka /admin/login
```

Catatan data: satu baris berita duplikat lawas
(`sosialisasi-kurikulum-...`, tidak ditampilkan frontend saat ini) diarsipkan
via soft delete agar daftar berita publik tetap sama persis (5 artikel).
Barisnya tetap ada di DB dan bisa di-restore dari CMS (filter Arsip).

## 5. Modul CMS (sidebar)

Dashboard (angka real dari DB) · Profil Program · Akreditasi · Dosen ·
Kurikulum · CPL · Kalender Akademik (per tahun/semester, arsip otomatis) ·
Gelombang Pendaftaran (status active/upcoming/archived) · Biaya Pendidikan
(per periode, historis dipertahankan) · FAQ · Publikasi · Riset · PKM ·
Kerja Sama · Testimoni · Alumni · Berita (draft/published/scheduled/archived,
slug unik, preview publik, restore) · Agenda · Galeri · Dokumen (file lama
tidak dihapus saat update) · Kategori (proteksi hapus jika dipakai) ·
Media Manager (info pemakaian file, larang hapus file terpakai) ·
Pengaturan Website (kontak, sosmed, SEO) · Helpdesk (read-only + status) ·
Audit Log (read-only) · Kelola Admin · Profil Saya.

## 6. Keamanan & kualitas

- Validasi server-side via `app/Http/Requests/Admin/*`; input lama tidak hilang
  (`old()`), field wajib ditandai `*`.
- Upload: gambar JPG/PNG/WebP maks 5 MB; dokumen PDF/DOC/XLS/PPT/ZIP maks
  10 MB; nama file disanitasi; executable ditolak via validasi MIME+ekstensi.
- HTML konten berita disanitasi saat simpan (tanpa `<script>`/event handler).
- Soft delete untuk berita, agenda, dosen, galeri, dokumen (+ restore).
- Audit log (`audit_logs`): admin pelaksana, aksi, entitas, waktu, IP.
  Password/token tidak pernah masuk log.
- Tidak ada N+1: relasi di-eager-load; paginasi di semua list; index DB
  sudah tersedia pada kolom slug/status/tahun/kategori.

## 7. Pengujian

```bash
php artisan test
```

- `tests/Feature/PpakRoutesTest.php` — 21 test frontend existing, lolos penuh
  dengan sumber database (bukti preservasi frontend & data).
- `tests/Feature/AdminCmsTest.php` — auth, guard, CRUD+restore berita,
  validasi slug, cerminan profil ke frontend, logout, rate limit, dan smoke
  50+ halaman CMS (semua harus HTTP 200).
