# Panduan Deployment PPAk FEB UNESA

Panduan memindahkan aplikasi dari lokal ke server produksi (VPS maupun shared
hosting/cPanel, termasuk lingkungan XAMPP). Target pembaca: administrator server.

## Daftar Isi

- [1. Kebutuhan Server](#1-kebutuhan-server)
- [2. Deployment ke VPS / Server Penuh](#2-deployment-ke-vps--server-penuh)
- [3. Deployment ke Shared Hosting / cPanel](#3-deployment-ke-shared-hosting--cpanel)
- [4. Deployment di XAMPP Lokal (Demo)](#4-deployment-di-xampp-lokal-demo)
- [5. Checklist Produksi](#5-checklist-produksi)
- [6. Pemeliharaan](#6-pemeliharaan)
- [7. Troubleshooting](#7-troubleshooting)

## 1. Kebutuhan Server

| Kebutuhan | Versi minimum |
|---|---|
| PHP (+ ekstensi standar Laravel: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, driver PDO MySQL) | ^8.3 |
| Composer | 2.x |
| Database | MySQL 8+ / MariaDB 10.4+ (satu-satunya database yang didukung; SQLite sudah dihapus dari proyek) |
| Web server | Nginx / Apache (mod_rewrite) |
| Node.js + NPM | Hanya bila perlu build ulang aset (opsional — hasil build sudah ada di `public/build`) |

## 2. Deployment ke VPS / Server Penuh

```bash
# 1. Clone
git clone https://github.com/ardhikaxx/ppak-feb-unesa.git
cd ppak-feb-unesa

# 2. Dependensi produksi (tanpa dev)
composer install --no-dev --optimize-autoloader

# 3. Environment
cp .env.example .env
php artisan key:generate
```

Ubah `.env` produksi:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ppak-feb.unesa.ac.id
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppak_unesa
DB_USERNAME=ppak_user
DB_PASSWORD=rahasia-yang-kuat
SESSION_DRIVER=database
CACHE_STORE=database
```

Lanjut:

```bash
# 4. Migrasi + data awal (idempotent, aman dijalankan ulang)
php artisan migrate --force
php artisan db:seed --force

# 5. Storage upload CMS
php artisan storage:link

# 6. Optimasi
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Hak akses (contoh Ubuntu + www-data)
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

Arahkan document root virtual host ke `<proyek>/public`. Contoh Nginx:

```nginx
server {
    listen 80;
    server_name ppak-feb.unesa.ac.id;
    root /var/www/ppak-feb-unesa/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
    }

    location ~ /\.(?!well-known).* { deny all; }
}
```

## 3. Deployment ke Shared Hosting / cPanel

1. Zip proyek **tanpa** folder `node_modules/` (dan tanpa `.git/` bila tidak perlu).
2. Upload & ekstrak ke hosting, mis. ke `~/ppak-feb-unesa`, lalu arahkan
   **document root domain/subdomain ke `~/ppak-feb-unesa/public`**
   (di cPanel: menu *Domains* → ubah document root; bila tidak bisa, gunakan
   `.htaccess` rewrite dari `public_html` ke subfolder `public`).
3. Buat database MySQL + user di cPanel; catat nama, user, password.
4. Salin `.env.example` menjadi `.env` via File Manager/SSH lalu sesuaikan
   (`APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, kredensial `DB_*`).
5. Via SSH (atau cron sekali jalan bila SSH tidak tersedia):
   `composer install --no-dev`, `php artisan key:generate`,
   `php artisan migrate --force`, `php artisan db:seed --force`,
   `php artisan storage:link`, lalu `php artisan config:cache route:cache view:cache`.
6. Pastikan folder `storage/` dan `bootstrap/cache/` writable.

> Jika `php artisan storage:link` gagal di shared hosting (symlink dibatasi),
> buat symlink manual via File Manager/SSH dari `public/storage` ke
> `../storage/app/public`, atau pindahkan upload ke disk yang didukung.

## 4. Deployment di XAMPP Lokal (Demo)

1. Clone/copy proyek ke `C:\xampp\htdocs\ppak-feb-unesa`.
2. `composer install`, salin `.env.example` → `.env`, `php artisan key:generate`.
3. `php artisan migrate --force` lalu `php artisan db:seed --force`.
4. `php artisan storage:link`.
5. Jalankan `php artisan serve` lalu buka `http://localhost:8000`
   (alternatif: buat Apache Alias/VirtualHost ke folder `public/`).

## 5. Checklist Produksi

- [ ] `APP_DEBUG=false` dan `APP_ENV=production`.
- [ ] Kredensial admin demo diganti (menu CMS **Kelola Admin** + hapus akun demo).
- [ ] `APP_KEY` unik per server (jangan salin dari lokal).
- [ ] `migrate --force` + `db:seed --force` sudah dijalankan; konten tampil benar.
- [ ] `storage:link` aktif — gambar upload tampil (`/storage/...` tidak 404).
- [ ] Cache config/route/view dibuat ulang setiap kali `.env`/route/view berubah.
- [ ] HTTPS aktif; `APP_URL` memakai `https://`.
- [ ] Backup berkala: database + folder `storage/app/public` + `public/documents`.
- [ ] Log (`storage/logs/laravel.log`) dipantau; permission `storage/` benar.

## 6. Pemeliharaan

```bash
# Update kode lalu sinkronkan
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force          # migrasi baru (tidak menghapus data)
php artisan db:seed --force          # idempotent: update data master, tambah yang baru
php artisan storage:link             # bila belum ada
php artisan optimize:clear
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

- Menambah tahun akademik/gelombang/tarif baru **tidak perlu deploy** — cukup lewat CMS.
- Uji cepat pasca-deploy: `php artisan test` (30 test mencakup frontend & CMS).

## 7. Troubleshooting

| Gejala | Penyebab umum & solusi |
|---|---|
| Halaman putih / 500 | `APP_DEBUG=true` sementara untuk melihat error; cek `storage/logs/laravel.log`; pastikan permission `storage/` & `bootstrap/cache/` writable |
| Gambar upload 404 | `public/storage` belum ter-link → jalankan `php artisan storage:link` |
| CSS/JS tidak termuat | Jalankan `npm install && npm run build`, atau pastikan `public/build` ter-upload |
| Session sering logout | Pastikan tabel `sessions` ada (`migrate`) dan `SESSION_DRIVER` konsisten |
| Login admin "terlalu banyak percobaan" | Tunggu 1 menit (throttle brute force); pastikan jam server benar |
| Seeder error duplikat | Seeder idempotent — aman dijalankan ulang; pastikan migrasi sudah jalan dulu |
| 404 pada semua route selain `/` | `mod_rewrite`/aturan try_files belum aktif; document root harus ke `public/` |
