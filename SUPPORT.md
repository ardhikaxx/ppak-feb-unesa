# 💬 Dukungan & Bantuan Teknis (Support)

Terima kasih telah menggunakan dan mengembangkan sistem **Website Profil PPAk FEB UNESA + CMS Admin**.

Jika Anda membutuhkan bantuan teknis dalam instalasi, integrasi sistem, pemecahan masalah operasional, maupun konsultasi adaptasi untuk unit akademik lainnya, silakan manfaatkan kanal-kanal komunikasi resmi berikut:

---

## 📬 Kanal Komunikasi Resmi

* **Pemilik & Pengembang**: **Yanuar Ardhika Rahmadhani Ubaidillah ([@ardhikaxx](https://github.com/ardhikaxx))**
* **Email Resmi**: `ardhikayanuar58@gmail.com`
* **GitHub Issues**: [https://github.com/ardhikaxx/ppak-feb-unesa/issues](https://github.com/ardhikaxx/ppak-feb-unesa/issues)
* **Repositori Resmi**: [https://github.com/ardhikaxx/ppak-feb-unesa](https://github.com/ardhikaxx/ppak-feb-unesa)

---

## 📚 Sumber Dokumentasi Mandiri

Sebelum mengajukan pertanyaan, kami sangat menyarankan Anda membaca dokumen teknis dan panduan operasional berikut:

1. [**`README.md`**](./README.md) — Ringkasan sistem, fitur publik & CMS, matriks RBAC, panduan instalasi, dan akun demo.
2. [**`docs/CMS.md`**](./docs/CMS.md) — Arsitektur teknis CMS, implementasi repository pattern (`EloquentContentRepository`), modul admin, dan cache.
3. [**`docs/PANDUAN-ADMIN.md`**](./docs/PANDUAN-ADMIN.md) — Panduan operasional praktis bagi operator dan administrator CMS.
4. [**`docs/DEPLOYMENT.md`**](./docs/DEPLOYMENT.md) — Panduan deployment ke server produksi (Apache, Nginx, cPanel/VPS, HTTPS/SSL, optimasi cache).
5. [**`docs/SEO_STRATEGY_AND_TECHNICAL_GUIDE.md`**](./docs/SEO_STRATEGY_AND_TECHNICAL_GUIDE.md) — Strategi metadata SEO institusi, OpenGraph, Twitter Cards, Schema.org, dan sitemap XML.
6. [**`CHANGELOG.md`**](./CHANGELOG.md) — Riwayat rilis fitur dan pembaruan sistem (*Keep a Changelog* & SemVer).
7. [**`SECURITY.md`**](./SECURITY.md) — Kebijakan keamanan, otorisasi RBAC, rate-limiting, dan pelaporan kerentanan privat.
8. [**`CONTRIBUTING.md`**](./CONTRIBUTING.md) — Pedoman kontribusi kode, standar PSR-12, alur Git, dan proteksi mutlak seeder.
9. [**`CITATION.md`**](./CITATION.md) — Format sitasi akademik karya (APA, BibTeX, IEEE, MLA).
10. [**`LICENSE`**](./LICENSE) — Ketentuan lisensi perangkat lunak terbuka MIT License.

---

## 🧭 Sebelum Mengajukan Pertanyaan (Troubleshooting Checklist)

Untuk mempercepat penyelesaian kendala, pastikan Anda telah memeriksa beberapa poin berikut:

1. **Persyaratan Sistem**: Pastikan lingkungan Anda menggunakan PHP `^8.3` dengan ekstensi aktif: `pdo_mysql`, `mbstring`, `fileinfo`, `gd`, dan MySQL 8.0 / MariaDB 10.4+.
2. **Konfigurasi Environment**: Pastikan file `.env` telah disalin dari `.env.example`, kredensial database sesuai, dan perintah `php artisan key:generate` sudah dijalankan.
3. **Database & Seeder**: Di lingkungan lokal, jalankan `php artisan migrate:fresh --seed` untuk memastikan seluruh tabel dan data master resmi terisi dengan benar.
4. **Symlink Berkas Publik**: Jalankan `php artisan storage:link` agar file upload dokumen dan media CMS dapat diakses oleh browser.
5. **Pemeriksaan Error Log**: Jika mendapati kesalahan HTTP 500, selalu periksa catatan log lengkap pada `storage/logs/laravel.log`.
6. **Laporan yang Jelas**: Saat mengajukan tiket bantuan atau pertanyaan, sertakan informasi versi PHP, MySQL, tangkapan layar antarmuka/error, dan langkah-langkah reproduksi masalah.

---

## 🛠️ Layanan Konsultasi & Implementasi

Bagi institusi, fakultas, atau program studi yang memerlukan penyesuaian khusus, layanan berikut tersedia melalui kontak resmi pengembang:

* Adaptasi dan implementasi CMS untuk unit/program studi lain di lingkungan perguruan tinggi.
* Hardening keamanan server produksi, konfigurasi SSL/HTTPS, dan optimasi performa caching.
* Integrasi basis data akademik dan integrasi sistem autentikasi single sign-on (SSO).
* Pelatihan teknis bagi pengelola konten institusi.

---

## 💖 Dukungan & Donasi

Jika sistem **Website Profil PPAk FEB UNESA + CMS Admin** ini memberikan manfaat bagi Anda, membantu institusi Anda, atau menghemat waktu pengembangan Anda, Anda dapat memberikan apresiasi dan dukungan sukarela kepada pengembang melalui pemindaian kode **QRIS** berikut:

<p align="center">
  <img src="./qris.png" alt="QRIS Donasi" width="300"/>
</p>

> [!NOTE]
> Donasi sepenuhnya bersifat sukarela dan tidak mengikat. Seluruh fitur kode sumber ini tetap bebas digunakan dan dimanfaatkan di bawah ketentuan [MIT License](./LICENSE).

---

**Yanuar Ardhika Rahmadhani Ubaidillah ([@ardhikaxx](https://github.com/ardhikaxx))**  
*Lead Developer & Maintainer*
