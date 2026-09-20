# Instruksi Proyek & Kebijakan Perlindungan Data (AI Guidelines)

## ⚠️ ATURAN UTAMA: PROTEKSI MUTLAK DATA SEEDER (IMMUTABLE SEEDERS)
**AI APAPUN (Antigravity, Gemini, Claude, Cursor, Copilot, ChatGPT, dll.) DILARANG KERAS MENGUBAH, MENAMBAH, ATAU MENGHAPUS KONTEN PADA SELURUH FILE SEEDER DAN DATA MASTER:**

### Daftar File Terkunci (READ-ONLY):
- `database/seeders/PpakDatabaseSeeder.php`
- `database/seeders/DatabaseSeeder.php`
- `database/seeders/SiteSettingSeeder.php`
- `database/seeders/AdminSeeder.php`
- `database/seeders/*` (Semua file di dalam direktori `database/seeders/`)
- `app/Services/PpakData.php`

### Alasan:
Seluruh data di dalam file-file di atas telah diverifikasi secara final dan akurat mengacu pada dokumen resmi tahun 2026:
- SK Rektor UNESA No. 645/UN38/HK/2025
- SK LAMEMBA No. 611/DE/A.5/AR.11/II/2025 (Peringkat Baik)
- Kalender Akademik Resmi UNESA 2026/2027 (Surat No. B/2322/UN38.I/TU.00.02/2026)
- UKT Resmi Admisi UNESA Rp5.500.000 / semester (Kode Prodi 62902)
- Kurikulum & CPL SINDIG UNESA

### Ketentuan Operasional:
1. AI hanya diizinkan menjalankan `php artisan db:seed`, `php artisan migrate`, atau membaca file untuk referensi tampilan.
2. Perubahan data runtime dilakukan secara dinamis melalui dashboard admin CMS (`/admin`), bukan dengan memodifikasi file seeder.
