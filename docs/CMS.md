# Dokumentasi Teknis CMS Admin PPAk FEB UNESA

> CMS (Content Management System) khusus admin agar seluruh konten website yang
> sebelumnya statis dapat dikelola dinamis dari database **tanpa mengubah
> tampilan frontend**. Desain, layout, dan Blade publik tidak disentuh; yang
> berubah hanya sumber datanya (array statis → database).

Dokumen ini untuk **pengembang**. Panduan pemakaian harian untuk operator ada di
[PANDUAN-ADMIN.md](PANDUAN-ADMIN.md). Panduan server ada di [DEPLOYMENT.md](DEPLOYMENT.md).

## Daftar Isi

- [1. Arsitektur](#1-arsitektur)
- [2. Autentikasi Admin](#2-autentikasi-admin)
- [3. Database & Seeder](#3-database--seeder)
- [4. Modul CMS](#4-modul-cms)
- [5. Referensi Route](#5-referensi-route)
- [6. Alur Kerja Konten](#6-alur-kerja-konten)
- [7. Cache & Invalidasi](#7-cache--invalidasi)
- [8. Upload & Media](#8-upload--media)
- [9. Keamanan](#9-keamanan)
- [10. Pengujian](#10-pengujian)

## 1. Arsitektur

Frontend publik membaca konten lewat kontrak `App\Contracts\ContentRepositoryInterface`,
sehingga sumber data bisa diganti tanpa mengubah controller maupun Blade:

| Implementasi | Sumber | Status |
|---|---|---|
| `App\Repositories\EloquentContentRepository` | Database (Eloquent) | **Aktif** (di-binding di `AppServiceProvider`) |
| `App\Repositories\ArrayContentRepository` | `App\Services\PpakData` (statis) | Arsip/referensi, tidak di-binding |

Bentuk array yang dikembalikan repository database **identik** dengan sumber statis
(terverifikasi otomatis, lihat [10. Pengujian](#10-pengujian)). Controller CMS berada di
`app/Http/Controllers/Admin/` — terpisah penuh dari controller publik — dengan base
class `BaseAdminController` berisi helper audit log, invalidasi cache, upload aman,
dan sanitasi HTML.

```text
Pengunjung ──▶ Route publik ──▶ Controller publik ──▶ ContentRepositoryInterface ──▶ Database
Admin ──▶ /admin/* (admin.auth + admin.active) ──▶ Controller Admin ──▶ Eloquent + audit + flush cache
```

## 2. Autentikasi Admin

- Tabel `admins` (**terpisah** dari `users`): `name`, `email` (unik), `password`
  (bcrypt via cast `hashed`), `is_active`, `last_login_at`, `remember_token`, timestamps.
- Guard `admin` (driver session) + provider `admins` + broker `admins`
  terdaftar di `config/auth.php`; tabel `admin_password_reset_tokens`.
- URL: `GET /admin/login` (form), `POST /admin/login` (throttle `admin-login`:
  **5x/menit per email+IP**) → sukses ke `/admin/dashboard`.
- Middleware: `admin.auth:admin` (tamu → redirect `/admin/login`) dan
  `admin.active` (akun nonaktif → logout paksa + pesan).
- Login: regenerasi session + catat `last_login_at`. Logout (`POST /admin/logout`):
  logout guard, invalidate session, regenerate token CSRF.
- Akun demo (khusus pengembangan, hardcoded di `AdminSeeder`):
  email `admin@gmail.com`, password `password`. Ganti untuk produksi.

## 3. Database & Seeder

Semua seeder idempotent (`updateOrCreate`) sehingga aman dijalankan ulang:

| Seeder | Isi |
|---|---|
| `PpakDatabaseSeeder` | Data asli website: profil (62902), akreditasi LAMEMBA, 4 CPL, 11 MK kurikulum, kalender 2026/2027 (16 kegiatan + label periode resmi), UKT Rp5.500.000, 3 gelombang admisi (arsip), 4 dosen, 1 publikasi, 8 FAQ, 5 berita, 3 agenda, 6 dokumen (terhubung ke `public/documents/*.pdf`), 4 galeri |
| `AdminSeeder` | Akun admin awal |
| `SiteSettingSeeder` | 25 pengaturan global (umum, kontak, sosmed, SEO, admisi) |

Migrasi tambahan CMS:

| Migrasi | Isi |
|---|---|
| `2026_02_01_000001_create_admins_table` | `admins` + `admin_password_reset_tokens` |
| `2026_02_01_000002_create_site_settings_table` | `site_settings` (key-value per grup, satu sumber kebenaran) |
| `2026_02_01_000003_add_period_label_to_academic_calendars` | Kolom aditif `period_label` (label resmi mis. "1 Agustus 2026 – 31 Januari 2027"; fallback ke rentang tanggal bila kosong) |

Catatan data: satu baris berita duplikat lawas (`sosialisasi-kurikulum-...`, tidak
ditampilkan frontend saat ini) diarsipkan via soft delete agar daftar publik tetap
5 artikel. Barisnya tetap ada di DB dan bisa di-restore dari CMS (filter Arsip).

> File seeder bersifat final (lihat `AGENTS.md`). Perubahan data operasional
> dilakukan lewat CMS `/admin`, bukan dengan mengedit seeder.

## 4. Modul CMS

Sidebar dikelompokkan: Dashboard · Profil PPAk · Akademik · Admisi ·
Riset & Pengabdian · Kemahasiswaan & Alumni · Informasi & Publikasi ·
Dokumen & Media · Website · Akun.

| Modul | Kemampuan utama |
|---|---|
| Dashboard | Statistik real DB, periode aktif, konten terakhir diubah, audit terakhir, shortcut |
| Profil Program | Form tunggal (identitas, kontak, 6 sosmed, sumber) — langsung tampil global |
| Akreditasi | Multi-baris (riwayat), SK, masa berlaku, salinan PDF |
| Dosen | Foto, gelar, peran, kategori, bidang, matkul, sertifikasi, status aktif, urutan, arsip/restore |
| Kurikulum | Kode unik, semester, SKS, jenis (Wajib/Pilihan/Paket Magang), deskripsi, pemetaan CPL (checkbox), pengampu, urutan |
| CPL | Kode unik, judul, deskripsi, kategori, urutan |
| Kalender Akademik | Filter tahun/semester; tahun baru = tambah baris baru (lama jadi arsip); label periode opsional |
| Gelombang Pendaftaran | Status `active` (dibuka di website) / `upcoming` / `archived`; tanggal seleksi, pengumuman, daftar ulang |
| Biaya Pendidikan | Per periode/tahun; **tambah record baru** untuk tarif baru (lama = historis) |
| FAQ | Kategori bebas, urutan tampil |
| Publikasi / Riset / PKM | Penulis/ketua, tahun (filter), jurnal/skema/lokasi, DOI/URL; status terbit mengendalikan tampil |
| Kerja Sama | Kategori, jenis (MoU/MoA), masa berlaku, logo; status `active` tampil di website |
| Testimoni / Alumni | Hanya data terverifikasi; status `published` tampil; tanpa data fiktif |
| Berita | `draft/scheduled/published/archived`, slug unik auto-dari-judul, excerpt, gambar, tanggal terbit, estimasi baca, tag, **preview publik**, arsip/restore |
| Agenda | Tanggal mulai/selesai, waktu, lokasi, pembicara, mendatang/selesai, sumber, arsip/restore |
| Galeri | Foto wajib saat tambah, kategori, tanggal, status |
| Dokumen | Upload PDF/DOC/XLS/PPT/ZIP ≤10 MB; update mengganti file **tanpa menghapus file lama**; filter kategori/tahun/status; arsip/restore |
| Kategori | Tipe (berita/agenda/dokumen/galeri); **tidak bisa dihapus selama dipakai konten** |
| Media Manager | Daftar file `storage/` + ukuran + pemakaian di konten; file terpakai **tidak bisa dihapus** |
| Pengaturan Website | 25 key global (nama, footer, kontak, maps, sosmed, SEO, tautan admisi) per grup |
| Helpdesk | Daftar pesan masuk (rate-limited di publik) + ubah status tiket |
| Audit Log | Read-only: admin pelaksana, aksi, entitas, waktu, IP |
| Kelola Admin / Profil | Tambah/nonaktifkan admin (tidak bisa menonaktifkan diri sendiri; admin aktif terakhir dilindungi); ubah profil & password (min. 8, huruf besar-kecil + angka) |

## 5. Referensi Route

Prefix `/admin`, nama `admin.*`, middleware `admin.auth:admin` + `admin.active`
(kecuali login):

| Route | Keterangan |
|---|---|
| `GET /admin/login`, `POST /admin/login`, `POST /admin/logout` | Autentikasi |
| `GET /admin/dashboard` | Dashboard |
| `GET+PUT /admin/program-profile` | Profil program (tunggal) |
| Resource `accreditations`, `curricula`, `learning-outcomes`, `academic-calendars`, `admission-schedules`, `tuition-fees`, `faqs`, `publications`, `researches`, `community-services`, `partnerships`, `testimonials`, `alumni`, `categories` | `index/create/store/edit/update/destroy` (tanpa `show`) |
| Resource `news`, `agendas` + `POST .../restore` | CRUD + `show` + restore soft delete |
| Resource `lecturers`, `galleries`, `documents` + `POST .../restore` | CRUD + restore (`lecturers` juga `show`) |
| `GET /admin/media`, `DELETE /admin/media` | Media manager |
| `GET+PUT /admin/site-settings` | Pengaturan website |
| `GET /admin/helpdesk`, `GET/PATCH /admin/helpdesk/{inquiry}` | Helpdesk |
| `GET /admin/audit-logs` | Audit log |
| Resource `admins` (tanpa `show`) | Kelola akun admin |
| `GET+PUT /admin/profile`, `PUT /admin/profile/password` | Profil sendiri |

## 6. Alur Kerja Konten

1. Admin menambah/mengubah konten berstatus `draft` → **tidak tampil** di publik.
2. Admin dapat pratinjau (berita memakai template publik asli via tombol Preview).
3. Ubah status ke `published` → controller CMS menulis DB, mencatat audit,
   mem-flush cache → frontend langsung menampilkan.
4. Hapus = soft delete (masuk arsip, hilang dari publik, bisa di-restore).
5. Dokumen yang di-update: file baru disimpan berdampingan; file lama tetap ada.

## 7. Cache & Invalidasi

- Key terpusat: `App\Support\CacheKeys` (store: database di dev, siap Redis).
- Setiap aksi tulis CMS memanggil `ContentCache::flush()` (semua key tetap) +
  `Cache::forget(beritaSlug)` eksplisit untuk detail berita.
- List/pencarian/paginasi **tidak di-cache** (query langsung ke kolom berindeks)
  agar perubahan admin selalu seketika.

## 8. Upload & Media

- Disk `public` (`storage/app/public`, diakses via `/storage/...` setelah
  `php artisan storage:link`). File bawaan di `public/images` & `public/documents`
  tidak dipindah dan tetap dipakai.
- Gambar: JPG/JPEG/PNG/WebP ≤5 MB; dokumen: PDF/DOC/DOCX/XLS/XLSX/PPT/PPTX/ZIP ≤10 MB.
- Nama file disanitasi (`Str::slug` + timestamp); executable (PHP dsb.) ditolak
  oleh validasi MIME + ekstensi; proteksi path traversal di Media Manager.

## 9. Keamanan

- Guard admin terpisah; tidak ada role publik — pengunjung biasa tak punya akses CMS.
- CSRF di semua form; session regenerate (login) & invalidate + regenerate token (logout).
- Validasi server-side via `app/Http/Requests/Admin/*` (wajib; JS hanya UX).
  Error ditampilkan jelas dan input tidak hilang (`old()`).
- HTML konten disanitasi saat simpan (`BaseAdminController::sanitizeHtml`):
  hanya tag format dasar; `<script>/<iframe>` dan event handler dibuang
  (frontend me-render `{!! !!}` sehingga sanitasi sisi simpan bersifat wajib).
- Password/token tidak pernah ditulis ke audit log (di-scrub otomatis).
- Batasan hapus: kategori terpakai, file terpakai, akun sendiri, dan
  satu-satunya admin aktif tidak dapat dihapus/dinonaktifkan.

## 10. Pengujian

```bash
php artisan test
```

| File | Cakupan |
|---|---|
| `tests/Feature/PpakRoutesTest.php` | 21 test: seluruh halaman publik (termasuk 6 unduhan PDF resmi + redirect alias 301) — bukti preservasi frontend & data dengan sumber database |
| `tests/Feature/AdminCmsTest.php` | Auth & guard, siklus berita (buat draft → 404 publik → terbit → 200 → tolak slug duplikat → arsip → restore), cerminan profil ke frontend, logout, rate limit brute force, smoke 50+ halaman CMS (HTTP 200) |

Hasil terakhir: **30 test, 271 assertion, semua lolos.**
