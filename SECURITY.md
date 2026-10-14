# 🛡️ Kebijakan Keamanan (Security Policy)

Keamanan informasi, integritas data publik akademik, dan kerahasiaan operasional **Website Profil PPAk FEB UNESA + CMS Admin** merupakan prioritas fundamental dalam pengembangan dan pemeliharaan sistem ini.

Dokumen ini menjelaskan kebijakan keamanan, arsitektur perlindungan bawaan sistem, serta mekanisme pelaporan kerentanan secara bertanggung jawab (*responsible disclosure*).

---

## 📦 Versi yang Didukung

Pembaruan keamanan dan perbaikan celah (*security patches*) aktif diberikan untuk versi-versi berikut:

| Versi | Status Keamanan | Keterangan |
| :--- | :--- | :--- |
| **v1.1.x / `main`** | ✅ Didukung Penuh (*Active Security Support*) | Rilis termutakhir (RBAC Super Admin & Operator, Fitur Lupa Password) |
| **v1.0.x** | 🔄 Perbaikan Kritis Saja (*Critical Fixes Only*) | Rilis awal CMS Admin berbasis database |
| **< 1.0.0** | ❌ Tidak Didukung | Snapshot frontend statis awal |

---

## 🔒 Lapisan Keamanan Bawaan (Built-in Security Layers)

Sistem dibangun dengan menerapkan prinsip *Defense in Depth* dan mematuhi kaidah standar keamanan web (OWASP Top 10):

### 1. Autentikasi & Otorisasi RBAC Berlapis
* **Guard Terpisah**: Autentikasi pengelola CMS menggunakan guard `admin` dengan entitas tabel `admins`, terisolasi sepenuhnya dari user umum aplikasi.
* **Kontrol Akses Berbasis Peran (RBAC)**: Pembagian wewenang yang tegas antara `super_admin` (akses penuh: kelola admin, audit log, konfigurasi sistem) dan `operator` (pengelolaan konten informasi, berita, agenda, dokumen, dan akademik).
* **Middleware Otorisasi Server-Side**: Ditegakkan melalui middleware `admin.auth`, `admin.active` (memblokir dan memaksa logout akun yang dinonaktifkan), serta `admin.role:super_admin` (*deny by default*, penolakan HTTP 403 untuk akses tidak sah).

### 2. Perlindungan Brute-Force & Integritas Sesi
* **Rate Limiting Ketat**: Throttle login admin dibatasi maksimal **5 percobaan per menit per kombinasi email + alamat IP**.
* **Proteksi Sesi**: Regenerasi ID sesi otomatis setelah autentikasi berhasil untuk mencegah serangan *session fixation*.
* **Logout Terproteksi**: Proses keluar mewajibkan metode HTTP `POST` dengan verifikasi token CSRF, invalidasi sesi server-side, serta regenerasi token.

### 3. Perlindungan Terhadap Serangan Injeksi (SQLi, XSS, CSRF)
* **Pencegahan SQL Injection**: Penggunaan Eloquent ORM dan PDO *Prepared Statements* dengan parameter binding pada seluruh kueri database.
* **Pencegahan Cross-Site Scripting (XSS)**: Seluruh konten publik di-escape melalui Blade templating. Untuk input deskripsi berita/halaman yang membutuhkan format HTML, sistem menerapkan filter sanitasi HTML terpusat pada controller sebelum data disimpan ke database.
* **Proteksi CSRF Global**: Token Cross-Site Request Forgery diverifikasi otomatis pada seluruh mutasi data (POST, PUT, PATCH, DELETE).

### 4. Manajemen Berkas & Upload Aman
* **Validasi MIME-Type Riil**: Pengecekan tipe berkas berbasis inspeksi binary content melalui ekstensi PHP `fileinfo`, bukan sekadar ekstensi nama file.
* **Whitelist Ekstensi**: Hanya mengizinkan berkas yang relevan (PDF untuk dokumen akademik, JPG/JPEG/PNG/WEBP untuk gambar).
* **Sanitasi Nama Berkas**: Penamaan acak (*hashed filename*) dan penyimpanan terisolasi untuk mencegah *directory traversal* dan penimpaan berkas liar.

### 5. Audit Logging & Perlindungan Data Sensitif
* **Audit Trail Otomatis**: Setiap aksi krusial administrator (penciptaan, pembaruan, penghapusan, pemulihan data, pergantian password) dicatat otomatis di tabel `audit_logs` beserta timestamp, ID pelaku, dan alamat IP.
* **Pembersihan Data Kredensial**: Payload audit log secara otomatis membersihkan (*scrubbing*) input sensitif seperti kata sandi sebelum dicatat. Kata sandi selalu di-hash menggunakan algoritma **bcrypt**.

---

## 🎯 Batasan Cakupan Keamanan (Scope)

### Dalam Cakupan (*In-Scope*):
* Mekanisme autentikasi, otorisasi route CMS, dan proteksi akun nonaktif.
* Validasi input, pemrosesan upload media, dan sanitasi HTML.
* Integritas data publik, audit trail, serta alur reset password admin.
* Headers keamanan HTTP (X-Frame-Options, X-Content-Type-Options, Referrer-Policy).

### Di Luar Cakupan (*Out-of-Scope*):
* Kredensial bawaan lingkungan pengembangan lokal (`superadmin@gmail.com` / `operator@gmail.com`) — wajib diganti saat proses deployment produksi (lihat [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md)).
* Serangan *Denial of Service* (DDoS) skala besar atau serangan fisik pada infrastruktur server hosting pihak ketiga.
* Celah keamanan pada dependensi upstream PHP/Laravel inti yang belum memiliki patch resmi.

---

## 🚨 Melaporkan Celah Keamanan (Reporting a Vulnerability)

Jika Anda menemukan potensi kerentanan atau celah keamanan (*security vulnerability*) pada sistem ini:

> [!CAUTION]
> **JANGAN** membuat laporan atau berdiskusi di GitHub Issues publik terbuka demi mencegah eksploitasi oleh pihak yang tidak bertanggung jawab sebelum perbaikan dirilis.

Silakan kirimkan laporan Anda secara privat dan bertanggung jawab (*Responsible Disclosure*) melalui:

* **Email Resmi**: `ardhikayanuar58@gmail.com`
* **Subjek Email**: `[SECURITY VULNERABILITY] - PPAk FEB UNESA`
* **Atau melalui**: Tab **Security → Advisories** pada repositori [ardhikaxx/ppak-feb-unesa](https://github.com/ardhikaxx/ppak-feb-unesa)

### Format Laporan yang Diharapkan:
1. Deskripsi lengkap mengenai jenis dan mekanisme celah yang ditemukan.
2. Langkah-langkah reproduksi masalah yang sistematis atau *Proof-of-Concept (PoC)*.
3. Estimasi dampak potensial terhadap kerahasiaan atau integritas sistem.
4. Rekomendasi solusi teknis (jika ada).

Tim pengembang akan mengonfirmasi laporan Anda dalam waktu maksimal **1x24 hingga 48 jam** dan segera menyiapkan patch perbaikan.

---

Terima kasih atas dedikasi dan kerja sama Anda dalam menjaga keamanan ekosistem teknologi informasi akademik Universitas Negeri Surabaya.

**Yanuar Ardhika Rahmadhani Ubaidillah ([@ardhikaxx](https://github.com/ardhikaxx))**  
*Lead Developer & Maintainer*
