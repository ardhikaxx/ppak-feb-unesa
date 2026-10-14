# 🤝 Panduan Kontribusi (Contributing Guidelines)

Terima kasih atas minat dan partisipasi Anda dalam mengembangkan dan menyempurnakan sistem **Website Profil PPAk FEB UNESA + CMS Admin**.

Proyek ini dikembangkan dan dikelola oleh **Yanuar Ardhika Rahmadhani Ubaidillah ([@ardhikaxx](https://github.com/ardhikaxx))** di bawah lisensi terbuka [MIT License](./LICENSE). Untuk menjaga kestabilan, kepatuhan data institusi, dan kualitas kode sistem, setiap kontribusi diharapkan mengikuti panduan di bawah ini.

---

## ⚠️ Kebijakan Proteksi Mutlak Data Seeder (Immutable Seeders)

Sistem ini merepresentasikan data legal dan operasional Program Studi PPAk FEB UNESA yang telah diverifikasi akurasinya per tahun 2026:
- SK Rektor UNESA No. 645/UN38/HK/2025
- SK LAMEMBA No. 611/DE/A.5/AR.11/II/2025 (Peringkat Baik s.d. 2027)
- Kalender Akademik UNESA 2026/2027 (Surat No. B/2322/UN38.I/TU.00.02/2026)
- UKT Admisi UNESA Rp5.500.000 / semester (Kode Prodi 62902)
- Kurikulum & CPL SINDIG UNESA

> [!IMPORTANT]
> **DILARANG MENGUBAH, MENAMBAH, ATAU MENGHAPUS KONTEN PADA FILE SEEDER & MASTER DATA STATIS:**
> - `database/seeders/*` (seluruh file seeder)
> - `app/Services/PpakData.php`
>
> Seluruh pembaruan data runtime operasional harus dilakukan secara dinamis melalui dashboard CMS Admin (`/admin`), bukan dengan memodifikasi file seeder.

---

## 🛠️ Standar Pengembangan Kode (Code Standards)

* **Bahasa & Framework**: PHP `^8.3` dan **Laravel 13.x**.
* **Standar Kode PHP**: Mematuhi kaidah **PSR-12** — jalankan linter sebelum melakukan commit:
  ```bash
  vendor/bin/pint --dirty
  ```
* **Pola Arsitektur**:
  * Frontend publik mengakses data via abstraksi `App\Contracts\ContentRepositoryInterface` yang diimplementasikan oleh `App\Repositories\EloquentContentRepository`.
  * Controller CMS berada di `app/Http/Controllers/Admin/` dan mewarisi `App\Http\Controllers\Admin\BaseAdminController` untuk memanfaatkan helper terpusat: audit log, invalidasi cache, upload aman, dan sanitasi HTML.
* **Validasi & Keamanan**:
  * Seluruh endpoint POST/PUT/DELETE wajib menggunakan `FormRequest` khusus dengan pesan validasi berbahasa Indonesia yang jelas.
  * Proteksi route admin dengan middleware `admin.auth`, `admin.active`, dan `admin.role:super_admin` sesuai matriks otorisasi RBAC.
  * Hindari penulisan raw SQL tanpa parameter binding; manfaatkan kapabilitas Eloquent ORM.
  * Sanitasi teks input berformat HTML menggunakan helper sanitasi sebelum disimpan ke database.
* **Frontend & Tampilan**:
  * Desain mengadopsi palet warna resmi institusi (UNESA Navy `#0d2346` & Gold `#cda851`).
  * Menggunakan Bootstrap 5.3 CDN, Font Awesome 6 CDN, dan SweetAlert2.
  * Tidak diperkenankan menggunakan popup bawaan browser (`alert()`, `confirm()`, `prompt()`).
* **Pengujian Otomatis (Automated Testing)**:
  * Pengujian menggunakan **Pest 5** + PHPUnit.
  * Pastikan seluruh rangkaian test lolos tanpa kegagalan:
    ```bash
    php artisan test
    ```
  * Setiap penambahan fitur atau perbaikan bug wajib disertai unit/feature test pendukung.

---

## 🌿 Alur Kerja Git (Git Workflow)

1. **Fork & Clone Repositori**:
   ```bash
   git clone https://github.com/ardhikaxx/ppak-feb-unesa.git
   cd ppak-feb-unesa
   ```

2. **Buat Branch Fitur / Perbaikan**:
   Gunakan format penamaan branch yang deskriptif:
   * `feat/nama-fitur` (penambahan fitur baru)
   * `fix/nama-bug` (perbaikan *defect* atau bug)
   * `docs/nama-dokumentasi` (pembaruan dokumen panduan)
   * `refactor/nama-modul` (penataan ulang struktur kode)

   ```bash
   git checkout -b feat/tambah-filter-kalender
   ```

3. **Format Commit Message**:
   Terapkan konvensi [Conventional Commits](https://www.conventionalcommits.org/) dengan deskripsi berbahasa Indonesia:
   * `feat: tambah filter semester pada modul kalender akademik`
   * `fix: perbaikan sanitasi tag html pada deskripsi pengumuman`
   * `docs: lengkapi panduan deployment server produksi`
   * `test: tambah test case otorisasi operator cms`

4. **Kirimkan Pull Request (PR)**:
   * Satu PR hanya mencakup satu topik perubahan terfokus.
   * Sertakan ringkasan perubahan, alasan teknis, serta bukti bahwa seluruh test suite `php artisan test` telah lolos.
   * Maintainer akan melakukan *code review* dan memberikan umpan balik sebelum penggabungan (*merge*).

---

## 🐞 Melaporkan Masalah & Diskusi

* Untuk bug fungsional atau saran fitur, silakan buat laporan melalui [GitHub Issues](https://github.com/ardhikaxx/ppak-feb-unesa/issues).
* Sertakan detail lingkungan pengembangan (versi OS, PHP, MySQL), langkah reproduksi, dan tangkapan layar/pesan error bila ada.
* Untuk temuan **celah keamanan**, jangan membuat issue terbuka — ikuti prosedur pelaporan privat pada [SECURITY.md](./SECURITY.md).

---

Terima kasih atas kontribusi Anda dalam menjaga dan memajukan sistem digital PPAk FEB UNESA!

**Yanuar Ardhika Rahmadhani Ubaidillah ([@ardhikaxx](https://github.com/ardhikaxx))**  
*Lead Developer & Maintainer*
