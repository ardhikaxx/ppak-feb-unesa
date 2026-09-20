# Panduan Penggunaan CMS untuk Admin PPAk FEB UNESA

Panduan operasional harian bagi admin pengelola website. Untuk hal teknis
(arsitektur, database, keamanan), lihat [CMS.md](CMS.md).

## Daftar Isi

- [1. Login & Logout](#1-login--logout)
- [2. Mengenal Dashboard](#2-mengenal-dashboard)
- [3. Alur Umum: Tambah & Ubah Konten](#3-alur-umum-tambah--ubah-konten)
- [4. Mengelola Berita](#4-mengelola-berita)
- [5. Mengelola Agenda & Galeri](#5-mengelola-agenda--galeri)
- [6. Mengelola Dosen, Kurikulum & CPL](#6-mengelola-dosen-kurikulum--cpl)
- [7. Mengelola Kalender, Admisi & Biaya](#7-mengelola-kalender-admisi--biaya)
- [8. Mengelola Dokumen & Media](#8-mengelola-dokumen--media)
- [9. Pengaturan Website](#9-pengaturan-website)
- [10. Helpdesk, Audit Log & Akun](#10-helpdesk-audit-log--akun)
- [11. Tips & Aturan Penting](#11-tips--aturan-penting)

## 1. Login & Logout

1. Buka `https://alamat-website/admin/login` (di lokal: `http://localhost:8000/admin/login`).
2. Masukkan email dan password admin, lalu klik **Masuk ke Dashboard**.
3. Centang **Ingat saya** bila memakai perangkat pribadi dan terpercaya.
4. Setelah 5x salah dalam 1 menit, login dikunci sementara (anti brute force) — tunggu 1 menit.
5. Selesai bekerja, klik nama Anda di kanan atas → **Logout**. Jangan hanya menutup tab
   pada komputer bersama.

> Lupa password? Hubungi administrator utama untuk mereset lewat menu **Kelola Admin**.

## 2. Mengenal Dashboard

- **Kartu statistik**: jumlah berita terbit/draft, agenda, dosen aktif, dokumen, galeri,
  publikasi, FAQ, testimoni, dan tiket helpdesk terbuka. Semua angka diambil langsung
  dari database. Klik kartu untuk melompat ke modulnya.
- **Periode & Status**: tahun akademik kalender yang tersedia, jumlah gelombang admisi
  yang sedang dibuka, dan periode biaya yang tercatat.
- **Konten Terakhir Diubah** & **Berita Terbaru**: pantau perubahan terakhir.
- **Aktivitas Perubahan Terakhir**: siapa mengubah apa dan kapan (ringkas; detail di Audit Log).
- **Akses Cepat**: tombol tambah konten yang paling sering dipakai.

Navigasi kiri dikelompokkan per bagian website; di HP, buka lewat tombol ☰.
Posisi halaman selalu terlihat pada breadcrumb di bawah bar atas.

## 3. Alur Umum: Tambah & Ubah Konten

1. Buka modul (mis. **Berita**), klik **Tambah**.
2. Isi field bertanda `*` (wajib). Error validasi muncul jelas dan isian tidak hilang.
3. Klik **Simpan** → muncul notifikasi hijau bila berhasil.
4. Untuk mengubah, klik ikon pensil ✏️ pada baris data.
5. Untuk menghapus, klik ikon tempat sampah 🗑️ → konfirmasi pada dialog.
   Data penting (berita, agenda, dosen, galeri, dokumen) **tidak hilang permanen**,
   melainkan masuk arsip dan bisa dipulihkan (centang *Tampilkan arsip* → tombol pulihkan ↩️).
6. Gunakan kolom **Cari** dan filter (status/kategori/tahun) untuk menemukan data.

## 4. Mengelola Berita

- **Slug** terisi otomatis dari judul dan harus unik (huruf kecil, angka, tanda `-`).
- Tulis **Excerpt** (ringkasan 1–2 kalimat) dan **Isi** (boleh format dasar seperti
  tebal, daftar, dan tautan; script otomatis dibuang demi keamanan).
- **Status**:
  - `Draft` → tersimpan tapi tidak tampil di website (aman untuk konsep).
  - `Terbit` → langsung tampil di website.
  - `Terjadwal` → disiapkan untuk penjadwalan.
  - `Arsip` → disembunyikan dari website tanpa menghapus.
- Isi **Tanggal publikasi** bila ingin tanggal tampil tertentu; kosongkan untuk memakai waktu saat ini.
- Klik ikon 🌐 **Preview** untuk melihat tampilan publik asli sebelum/sesudah terbit.
- Gambar utama: JPG/PNG/WebP, maksimal 5 MB.

## 5. Mengelola Agenda & Galeri

- **Agenda**: isi tanggal mulai (wajib) dan tanggal selesai bila lebih dari sehari,
  waktu, lokasi, dan pembicara. Tandai **event mendatang** agar tampil sebagai
  "Mendatang" di website. Event lama otomatis menjadi arsip tampilan, datanya tetap ada.
- **Galeri**: foto wajib diisi saat menambah (JPG/PNG/WebP ≤5 MB). Beri judul/caption
  yang jelas dan kategori agar mudah dicari.

## 6. Mengelola Dosen, Kurikulum & CPL

- **Dosen**: nama lengkap tanpa gelar + nama bergelar dipisah; isi bidang keahlian,
  mata kuliah (pisahkan koma), dan sertifikasi. Atur **urutan tampil** (angka kecil
  tampil lebih dulu) dan **status aktif** (nonaktif = disembunyikan tanpa menghapus).
- **Kurikulum**: kode mata kuliah harus unik; pilih semester, SKS, dan jenis
  (Wajib/Pilihan/Paket Magang); centang **pemetaan CPL** yang sesuai.
- **CPL**: kode unik (mis. `CPL-1`) + deskripsi; urutan tampil mengikuti kolom urutan.

## 7. Mengelola Kalender, Admisi & Biaya

- **Kalender Akademik**: selalu cantumkan **tahun akademik** format `2026/2027` dan
  semester (Gasal/Genap). Memasuki tahun baru, **tambah baris baru** — data tahun
  lama otomatis menjadi arsip dan tidak tertimpa. Label periode (mis. "1 Agustus 2026
  – 31 Januari 2027") bisa dikosongkan agar dihitung otomatis dari tanggal.
- **Gelombang Pendaftaran**: status `Aktif` berarti "sedang dibuka" di website.
  Jangan biarkan status `Aktif` pada gelombang yang tanggalnya sudah lewat —
  ubah ke `Arsip`. Lengkapi tanggal seleksi, pengumuman, dan batas daftar ulang.
- **Biaya Pendidikan**: nominal lama adalah **data historis** — bila tarif berubah,
  buat record baru untuk periode baru, jangan menimpa nominal lama.
- **FAQ**: kelompokkan dengan kategori yang konsisten (Pendaftaran, Biaya, Dokumen, …)
  dan atur urutan tampil.

## 8. Mengelola Dokumen & Media

- **Upload dokumen**: format PDF/DOC/XLS/PPT/ZIP, maksimal 10 MB. Beri nama dokumen
  yang jelas, kategori, dan tahun.
- Saat dokumen di-update dengan file baru, **file lama tetap tersimpan** (tidak
  terhapus otomatis) sebagai arsip.
- **Kategori** yang masih dipakai konten tidak dapat dihapus — pindahkan dulu
  kontennya ke kategori lain.
- **Media Manager**: melihat semua file upload beserta ukuran dan **di mana file
  dipakai**. File yang masih dipakai konten **tidak bisa dihapus** sampai kontennya
  diubah/dinonaktifkan.

## 9. Pengaturan Website

Menu **Pengaturan Website** adalah satu-satunya tempat untuk data global:

- **Umum**: nama website, nama program, teks footer, copyright.
- **Kontak**: alamat, email, telepon, WhatsApp, jam layanan, link Google Maps.
- **Media sosial**: 6 URL resmi (diawali `https://`).
- **SEO**: judul situs, deskripsi meta, gambar Open Graph.
- **Admisi**: tautan portal PMB & Admisi.

Perubahan di sini langsung berlaku di seluruh website — periksa kembali sebelum menyimpan.

## 10. Helpdesk, Audit Log & Akun

- **Helpdesk**: daftar pesan dari form publik. Buka detail, tindak lanjuti, lalu ubah
  status tiket (Terbuka → Diproses → Selesai). Badge merah di sidebar = jumlah tiket terbuka.
- **Audit Log**: riwayat siapa mengubah apa dan kapan (read-only). Gunakan untuk
  melacak perubahan bermasalah.
- **Kelola Admin**: tambah/nonaktifkan akun. Anda **tidak bisa** menonaktifkan atau
  menghapus akun sendiri, dan satu-satunya admin aktif dilindungi.
- **Profil Saya**: ubah nama/email sendiri dan ganti password (minimal 8 karakter,
  kombinasi huruf besar-kecil dan angka).

## 11. Tips & Aturan Penting

1. ✅ Gunakan **data resmi** — jangan mengarang nama dosen, alumni, testimoni, atau angka.
   Bagian yang datanya belum ada biarkan kosong; website menampilkan status kosong profesional.
2. ✅ Cek **Preview** sebelum menerbitkan berita penting.
3. ✅ Untuk tahun akademik/periode baru, selalu **tambah data baru**, jangan menimpa arsip.
4. ✅ Unggah gambar yang ringan dan jelas (maks 5 MB); beri nama file yang rapi.
5. ❌ Jangan menghapus kategori/file yang masih dipakai — sistem akan menolak dan
   memberi tahu lokasinya.
6. ❌ Jangan membagikan akun admin; setiap pengelola memakai akun sendiri agar
   tercatat di audit log.
