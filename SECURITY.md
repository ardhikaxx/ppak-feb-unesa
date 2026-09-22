# Kebijakan Keamanan (Security Policy)

Dokumen ini menjelaskan cara melaporkan kerentanan keamanan pada proyek
Website Profil PPAk FEB UNESA + CMS Admin secara bertanggung jawab.

## Versi yang Didukung

| Versi | Status |
|---|---|
| `main` (rilis terakhir, CMS Admin v1.0.0) | ✅ Didukung, menerima perbaikan keamanan |
| Riwayat commit lama / snapshot demo | ❌ Tidak didukung |

## Cara Melaporkan Kerentanan

1. **Jangan** membuka issue publik untuk kerentanan yang belum diperbaiki.
2. Laporkan melalui tab **Security → Advisories** di repository
   [ardhikaxx/ppak-feb-unesa](https://github.com/ardhikaxx/ppak-feb-unesa),
   atau hubungi maintainer **Yanuar Ardhika Rahmadhani Ubaidillah** melalui
   profil GitHub [@ardhikaxx](https://github.com/ardhikaxx).
3. Sertakan: deskripsi dampak, langkah reproduksi, URL/parameter terdampak,
   dan (bila ada) saran perbaikan.

Kami akan mengonfirmasi laporan maksimal **7 hari kerja** dan memprioritaskan
perbaikan berdasarkan tingkat keparahan (RCE/kebocoran data > eskalasi hak
akses > XSS/CSRF > informasi minor).

## Cakupan yang Dilindungi

- Autentikasi admin (`/admin/*`, guard `admin`, throttle brute force).
- Otorisasi route CMS dan proteksi akun nonaktif.
- Upload file (validasi MIME/ekstensi/ukuran, sanitasi nama file).
- Sanitasi HTML konten (anti-XSS pada render `{!! !!}`).
- Audit log tanpa penyimpanan password/token.
- Unduhan dokumen publik dan form helpdesk (rate limited).

## Di Luar Cakupan

- Kredensial demo bawaan (`superadmin@gmail.com` / `operator@gmail.com`,
  password `password`) — memang untuk pengembangan lokal dan **wajib
  diganti** di produksi (lihat checklist di
  [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md)).
- Kerentanan pada dependensi upstream (Laravel, Bootstrap CDN, dsb.) —
  laporkan ke maintainer masing-masing, lalu beri tahu kami bila perlu
  pembaruan versi di `composer.json`/`package.json`.
- Serangan fisik, rekayasa sosial, atau konfigurasi server yang salah
  (gunakan checklist produksi sebelum go-live).

## Praktik Keamanan Proyek

- Password admin di-hash (bcrypt); tidak ada password plain text di kode
  maupun log (audit log di-scrub otomatis).
- Secret (`.env`, kredensial produksi) tidak di-commit — yang di-commit
  hanya `.env.example` tanpa nilai rahasia.
- Dependensi dipasang dari lockfile (`composer.lock`, `package-lock.json`).
- Seluruh perubahan CMS tercatat di audit log dan dapat diaudit via
  `php artisan test` (kasus auth, guard, rate limit, dan validasi).
