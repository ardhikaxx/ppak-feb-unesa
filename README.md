<p align="center">
  <img src="public/images/logo-unesa.png" width="130" alt="Logo UNESA">
</p>

<h1 align="center">Website Profil PPAk FEB UNESA + CMS Admin</h1>

<p align="center">
  <strong>Sistem Informasi Profil Resmi Program Studi Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya dilengkapi Content Management System (CMS) Terintegrasi.</strong>
</p>

<p align="center">
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"></a>
  <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-%5E8.3-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"></a>
  <a href="https://getbootstrap.com"><img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap"></a>
  <a href="https://mysql.com"><img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"></a>
  <a href="https://pestphp.com"><img src="https://img.shields.io/badge/Tested%20with-Pest%205-EB4432?style=for-the-badge&logo=pest&logoColor=white" alt="Pest"></a>
  <a href="./LICENSE"><img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License"></a>
  <a href="https://github.com/ardhikaxx"><img src="https://img.shields.io/badge/Author-Yanuar%20Ardhika%20Rahmadhani%20Ubaidillah-181717?style=for-the-badge&logo=github&logoColor=white" alt="Author"></a>
</p>

---

## 📌 Tentang Proyek

Aplikasi **Website Profil PPAk FEB UNESA + CMS Admin** adalah platform profil kelembagaan modern untuk Program Studi Pendidikan Profesi Akuntan (Kode Prodi **62902**) di bawah Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.

Sistem ini dirancang untuk menyajikan informasi akademik, legalitas akreditasi LAMEMBA, profil dosen, kurikulum, alur admisi, publikasi riset, hingga portal helpdesk dan unduhan dokumen resmi institusi. Sistem dilengkapi dengan **CMS (Content Management System)** mandiri yang terisolasi dari portal publik, memungkinkan tim pengelola prodi memperbarui seluruh konten website secara dinamis dari basis data tanpa menyentuh kode program dan tanpa mengubah sistem desain antarmuka publik.

---

## ✨ Fitur Utama

### 1. 🌐 Portal Informasi Publik Komprehensif (27 Rute Terintegrasi)
* **Beranda**: Hero banner interaktif, sambutan kaprodi, identitas resmi, indikator statistik, keunggulan program, ringkasan kurikulum, berita terkini, dan agenda mendatang.
* **Profil Institusi**: Sejarah pendirian, visi-misi & tujuan, struktur organisasi, direktori profil dosen & tenaga pengajar, serta rekam jejak akreditasi LAMEMBA.
* **Akademik**: Kurikulum lengkap per semester dengan pemetaan CPL, kalender akademik interaktif (Ganjil/Genap), informasi gelar & sertifikasi profesi akuntan (Chartered Accountant), serta panduan akademik resmi.
* **Admisi & Biaya**: Jalur dan syarat pendaftaran, rincian biaya pendidikan (UKT Rp5.500.000), prosedur dan jadwal seleksi PMB UNESA, serta modul tanya jawab (FAQ) berkategori.
* **Riset & Pengabdian**: Direktori publikasi ilmiah dosen/mahasiswa, rekapitulasi riset terapan, kegiatan PKM, dan jejaring kemitraan/kerja sama strategis.
* **Kemahasiswaan & Alumni**: Profil mahasiswa, jejaring ikatan alumni, testimoni terverifikasi, dan prospek karier lulusan.
* **Informasi & Publikasi**: Portal berita dengan paginasi, pencarian, dan filter kategori; agenda kegiatan akademik; galeri foto kegiatan; serta peta lokasi kampus Ketintang.
* **Layanan & Unduhan**: Formulir helpdesk interaktif dengan perlindungan laju kirim (*rate limiting*), portal unduhan 6 dokumen PDF resmi institusi, pencarian global (`/search`), serta sitemap XML otomatis (`/sitemap.xml`).

### 2. ⚡ Arsitektur Repository Pattern (Pemisahan Konten Dinamis & Desain)
* Frontend publik membaca seluruh data melalui kontrak `App\Contracts\ContentRepositoryInterface`.
* Implementasi default `App\Repositories\EloquentContentRepository` menyuplai data dari database Eloquent dengan struktur array yang identik dengan sumber data asli, sehingga keindahan dan keutuhan desain Blade tetap terjaga 100%.

### 3. 🔑 Autentikasi Khusus & Multi-Role RBAC (Super Admin & Operator)
* Autentikasi terpisah menggunakan guard `admin` pada tabel `admins`, independen dari tabel user umum.
* Otorisasi berbasis peran (*Role-Based Access Control*) ditegakkan di backend via middleware `admin.auth`, `admin.active`, dan `admin.role:super_admin`:
  * **Super Admin**: Akses penuh ke seluruh modul CMS, pengelolaan pengguna admin, akses audit log lengkap, dan pengaturan global website.
  * **Operator**: Akses khusus operasional konten (berita, agenda, galeri, dokumen, FAQ, riset, kurikulum, dosen, dan admisi).
* Mekanisme proteksi akun: pembatasan login brute force (5x/menit per email+IP), session regeneration saat login, serta proteksi super admin terakhir dari penghapusan.
* Fitur **Lupa Password** mandiri berbasis verifikasi email dan token aman dengan antarmuka SweetAlert2.

### 4. 📊 Dashboard Analitik & Statistik Konten Real-Time
* Metrik statistik langsung dari database (total dosen, matkul, berita, agenda, dokumen, dsb.).
* Indikator status periode akademik aktif dan gelombang pendaftaran yang sedang dibuka.
* Log riwayat konten yang baru saja dimodifikasi beserta identitas administrator pengubahnya.

### 5. 🎓 Manajemen Akademik, Kurikulum & Pemetaan CPL
* Manajemen mata kuliah dengan kode unik, semester, bobot SKS, jenis mata kuliah, dan pengampu.
* Pemetaan Capaian Pembelajaran Lulusan (CPL) menggunakan relasi checkbox interaktif.
* Pengelolaan butir CPL berdasarkan kategori sikap, pengetahuan, keterampilan umum, dan keterampilan khusus.

### 6. 📅 Kalender Akademik Dinamis & Rekam Jejak Periode
* Pengelolaan agenda akademik terbagi berdasarkan tahun akademik dan semester (Ganjil/Genap).
* Penambahan tahun baru otomatis mengarsipkan periode lama tanpa menghilangkan riwayat historis.
* Label periode opsional untuk penyesuaian agenda khusus.

### 7. 📝 Manajemen Admisi, Gelombang & Biaya Pendidikan Historis
* Pengaturan status gelombang admisi (`active`, `upcoming`, `archived`) dengan tanggal seleksi, pengumuman, dan daftar ulang.
* Pencatatan tarif biaya pendidikan berbasis periode; record lama dipertahankan sebagai rekam jejak historis.
* Pengelolaan pertanyaan yang sering diajukan (FAQ) dengan kategorisasi tematik.

### 8. 📰 Publikasi Berita, Agenda & Galeri Multimedia
* Manajemen artikel berita dengan status *draft*, *published*, *scheduled*, dan *archived*.
* Generator slug otomatis anti bentrok (*unique slug*), pratinjau publik, serta mekanisme *soft delete* & *restore*.
* Agenda kegiatan lengkap dengan rentang tanggal pelaksanaan dan penanda status acara.
* Galeri foto kegiatan dengan pratinjau gambar dan keterangan kegiatan.

### 9. 📁 Dokumen Resmi & Media Manager
* Manajemen unduhan dokumen PDF resmi: penambahan dokumen baru tidak menghapus dokumen lama pada saat pembaruan (*non-destructive update*).
* Proteksi penghapusan kategori dokumen yang masih memiliki relasi berkas.
* Media Manager untuk memantau berkas unggahan dan informasi pemakaian file pada sistem.

### 10. ⚙️ Pengaturan Global Website & Strategi SEO
* Konfigurasi satu pintu untuk kontak resmi, 6 kanal media sosial, alamat kampus, dan identitas prodi.
* Manajemen metadata SEO institusional: meta description, OpenGraph tags, Twitter Cards, dan integrasi skema JSON-LD.
* Monitoring pesan formulir helpdesk yang masuk dari masyarakat.

### 11. 🛡️ Audit Trail & Keamanan Sistem
* Setiap aksi penting (create, update, delete, restore, password reset) dicatat di tabel `audit_logs`.
* Pembersihan data sensitif (*scrubbing*) otomatis pada payload log audit.
* Filter sanitasi HTML terpusat pada controller guna menangkal risiko *Stored Cross-Site Scripting* (XSS).

---

## 👥 Hak Akses Pengguna (Role-Based Access Control)

| Modul & Hak Akses | Super Admin | Operator |
| :--- | :---: | :---: |
| **Dashboard Analitik** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Profil Program & Akreditasi** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Manajemen Dosen & Pengajar** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Kurikulum & Capaian Pembelajaran (CPL)** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Kalender Akademik** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Admisi (Gelombang, Biaya, FAQ)** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Riset, PKM & Mitra Kerja Sama** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Kemahasiswaan, Alumni & Testimoni** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Berita, Agenda & Galeri** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Dokumen Resmi & Media Manager** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Kotak Masuk Helpdesk** | ✅ Akses Penuh | ✅ Akses Penuh |
| **Pengaturan Global Website & SEO** | ✅ Akses Penuh | ❌ Dibatasi (403) |
| **Audit Trail Log** | ✅ Akses Penuh | ❌ Dibatasi (403) |
| **Kelola Akun Admin (Tambah/Ubah Peran/Hapus)** | ✅ Akses Penuh | ❌ Dibatasi (403) |
| **Profil Pribadi & Ubah Password Sendiri** | ✅ Akses Mandiri | ✅ Akses Mandiri |

> Otorisasi ditegakkan secara mutlak di sisi server melalui middleware `admin.role:super_admin` (*deny by default*).

---

## 🛠️ Tech Stack & Dependensi

* **Backend Framework**: [Laravel 13.x](https://laravel.com) (PHP `^8.3`)
* **Arsitektur**: Controller-Repository Pattern, Eloquent ORM, Blade Templating
* **Basis Data**: MySQL 8.0+ / MariaDB 10.4+ (Transaksional & Relasional)
* **Frontend**: Bootstrap 5.3.3 (CDN), Font Awesome 6.6.0 (CDN), SweetAlert2 (CDN), Vanilla JS
* **PDF Engine**: `dompdf/dompdf`
* **Testing Suite**: Pest 5.2 + PHPUnit (103 Test, 923 Assertion lolos 100%)
* **Code Styling**: Laravel Pint (Kepatuhan PSR-12)

---

## 📜 Sumber Data Resmi & Kebijakan Data

Seluruh data master awal diisi melalui seeder *idempotent* (`updateOrCreate`) yang bersumber langsung dari dokumen hukum dan operasional resmi tahun 2026:

1. **SK Rektor UNESA** No. 645/UN38/HK/2025
2. **SK LAMEMBA** No. 611/DE/A.5/AR.11/II/2025 (Peringkat **Baik**, masa berlaku s.d. 25 Februari 2027)
3. **Kalender Akademik Resmi UNESA 2026/2027** (Surat No. B/2322/UN38.I/TU.00.02/2026)
4. **UKT Resmi Admisi UNESA**: **Rp5.500.000 / semester** (Kode Prodi 62902)
5. **Kurikulum & CPL SINDIG UNESA** serta portal resmi PMB `pmb.unesa.ac.id`

> [!IMPORTANT]
> **Kebijakan Proteksi Data Master (Immutable Seeders):**  
> Seluruh berkas di `database/seeders/*` dan `app/Services/PpakData.php` berstatus **READ-ONLY**. Pembaruan data harian dilakukan secara dinamis melalui antarmuka CMS Admin (`/admin`), bukan dengan memodifikasi file seeder.

---

## 🧪 Pengujian Otomatis (Testing)

Sistem telah diuji secara komprehensif menggunakan **Pest 5**:
```bash
php artisan test
```
Hasil pengujian: **103 passed**, **923 assertions** (100% lulus, mencakup rute publik, integrasi CMS, RBAC, proteksi guard, reset password, dan audit trail).

---

## 📚 Dokumentasi Sistem

Dokumentasi lengkap proyek ini disusun secara terstruktur pada direktori dokumentasi:

* [📖 **`docs/CMS.md`**](./docs/CMS.md) — Struktur arsitektur teknis CMS, relasi data, repository pattern, dan cache.
* [📘 **`docs/PANDUAN-ADMIN.md`**](./docs/PANDUAN-ADMIN.md) — Panduan visual operasional sehari-hari bagi staf admin dan operator CMS.
* [🚀 **`docs/DEPLOYMENT.md`**](./docs/DEPLOYMENT.md) — Panduan penyebaran produksi (Nginx/Apache, cPanel/VPS, SSL, optimasi).
* [🎯 **`docs/SEO_STRATEGY_AND_TECHNICAL_GUIDE.md`**](./docs/SEO_STRATEGY_AND_TECHNICAL_GUIDE.md) — Strategi metadata SEO dan skema terstruktur institusi.
* [⚖️ **`LICENSE`**](./LICENSE) — Lisensi perangkat lunak resmi **MIT License**.
* [🛡️ **`SECURITY.md`**](./SECURITY.md) — Kebijakan keamanan & prosedur pelaporan celah (*Responsible Disclosure*).
* [🤝 **`CONTRIBUTING.md`**](./CONTRIBUTING.md) — Pedoman kontribusi kode, standar PSR-12, dan kebijakan seeder.
* [📜 **`CODE_OF_CONDUCT.md`**](./CODE_OF_CONDUCT.md) — Pedoman perilaku dan integritas komunitas pengembang.
* [💬 **`SUPPORT.md`**](./SUPPORT.md) — Kanal bantuan teknis & komunikasi resmi pengembang.
* [📋 **`CHANGELOG.md`**](./CHANGELOG.md) — Catatan riwayat rilis dan pembaruan fitur terstruktur (*Keep a Changelog*).
* [📚 **`CITATION.md`**](./CITATION.md) — Format sitasi karya untuk publikasi atau riset akademik.

---

## 💖 Dukungan & Donasi

Jika sistem **Website Profil PPAk FEB UNESA + CMS Admin** ini bermanfaat bagi Anda, membantu unit kerja atau institusi Anda, dan telah menghemat banyak waktu kerja Anda, Anda dapat menunjukkan apresiasi dengan memberikan traktiran kopi (donasi sukarela) melalui pemindaian kode **QRIS** di bawah ini:

<p align="center">
  <img src="./qris.png" alt="QRIS Donasi" width="300"/>
</p>

> Donasi sepenuhnya bersifat sukarela dan tidak mengikat. Seluruh fitur kode sumber ini tetap bebas digunakan secara utuh sesuai ketentuan [MIT License](./LICENSE).

---

## ⚠️ Ketentuan Penggunaan & Lisensi

Kode sumber proyek ini dilindungi lisensi terbuka **[MIT License](./LICENSE)**. Seluruh materi resmi institusi, logo UNESA, serta dokumen SK yang disertakan merupakan hak cipta dan kekayaan intelektual milik **Universitas Negeri Surabaya**.

---

## 👨‍💻 Pengembang & Hak Cipta

Dirancang dan dikembangkan dengan penuh dedikasi oleh:  
**[Yanuar Ardhika Rahmadhani Ubaidillah (@ardhikaxx)](https://github.com/ardhikaxx)**  
*Lead Software Architect & Maintainer*

> **Copyright (c) 2026 Yanuar Ardhika Rahmadhani Ubaidillah ([@ardhikaxx](https://github.com/ardhikaxx)). All Rights Reserved.**
