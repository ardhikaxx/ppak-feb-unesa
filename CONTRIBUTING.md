# Panduan Kontribusi

Terima kasih ingin berkontribusi pada Website Profil PPAk FEB UNESA. Ikuti
panduan ini agar perubahan konsisten dan aman.

## Aturan Utama (Wajib)

1. **Jangan mengubah file data master** — seluruh isi `database/seeders/`
   dan `app/Services/PpakData.php` bersifat final dan read-only
   (lihat `AGENTS.md`). Perubahan data operasional hanya lewat CMS `/admin`.
2. **Jangan mengubah tampilan frontend publik** (Blade/CSS/JS di luar
   `resources/views/admin/`) kecuali untuk mengganti sumber data statis
   menjadi database — dan wajib tanpa perubahan visual.
3. Jangan mengarang data institusi (nama, angka, SK, tanggal). Hanya pakai
   data dari dokumen resmi yang tercantum di [README.md](README.md#sumber-data-resmi).
4. Jangan commit secret (`.env`, password produksi, kunci API).

## Alur Kerja

```bash
git checkout -b <tipe>/deskripsi-singkat   # mis. feat/tambah-modul-beasiswa
# ... kerjakan perubahan ...
vendor/bin/pint <file-ubah>                # rapikan gaya kode
php artisan test                           # wajib hijau sebelum push
git add <file>                             # per file, jangan borongan bila tak terkait
git commit -m "<tipe>: <deskripsi bahasa Indonesia>"
git push origin <nama-branch>              # buka Pull Request ke main
```

## Format Commit

Gunakan Conventional Commits berbahasa Indonesia, satu file per commit bila
perubahan tidak terkait:

- `feat: penambahan ...` — fitur baru
- `fix: perbaikan ...` — perbaikan bug
- `docs: ...` — dokumentasi saja
- `test: ...` — pengujian saja
- `refactor: ...`, `style: ...`, `chore: ...` — sesuai kebutuhan

## Standar Kode

- PHP: ikuti preset Laravel Pint (`vendor/bin/pint --test` harus bersih).
- Controller CMS baru wajib: Form Request untuk validasi, pencatatan audit
  (`$this->audit(...)`), dan invalidasi cache (`$this->flushContentCache()`).
- Setiap list wajib paginasi + pencarian/filter; relasi wajib eager loading.
- Tambahkan/ perbarui test Pest untuk setiap perubahan perilaku; tambahkan
  halaman baru ke smoke test `AdminCmsTest` bila relevan.
- Dokumentasikan perubahan perilaku di `CHANGELOG.md` (bagian `[Unreleased]`
  bila ada, atau buat seksi versi baru saat rilis).

## Melaporkan Bug

Buka issue dengan: deskripsi, langkah reproduksi, hasil yang diharapkan vs
aktual, dan screenshot bila terkait tampilan. Untuk kerentanan keamanan,
ikuti [SECURITY.md](SECURITY.md) (jangan via issue publik).
