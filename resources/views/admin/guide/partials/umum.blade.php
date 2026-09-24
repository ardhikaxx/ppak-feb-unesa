{{-- ================= PANDUAN UMUM (semua role) ================= --}}

<section id="umum" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-book me-1"></i>Tentang Panduan Ini</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="mb-2">Halaman ini adalah panduan resmi penggunaan <strong>CMS PPAk FEB UNESA</strong> yang disusun per fitur dan otomatis menyesuaikan dengan role Anda. Klik judul pada <strong>Daftar Isi</strong> (kiri) untuk berpindah ke bagian panduan yang dipilih — hanya satu bagian yang tampil setiap saat.</p>
            <ul class="mb-2">
                <li>Setiap bagian memuat: <strong>letak menu</strong>, <strong>tujuan fitur</strong>, <strong>langkah pemakaian</strong>, <strong>penjelasan setiap field</strong>, <strong>filter daftar data</strong>, dan <strong>tips</strong>.</li>
                <li>Konten otomatis sesuai role login Anda: <strong>Operator</strong> melihat panduan umum + modul konten; <strong>Super Admin</strong> melihat seluruh panduan sesuai akses penuhnya. Badge <span class="badge guide-badge-both">Semua Role</span> = bisa dipakai kedua role; badge <span class="badge guide-badge-sa">Super Admin</span> = khusus Super Admin.</li>
                <li>Gunakan tombol <strong>Sebelumnya / Berikutnya</strong> di bawah tiap bagian untuk berpindah berurutan, dan tombol <em>Cetak Panduan</em> di atas untuk mencetak/menyimpan PDF (seluruh bagian role Anda ikut tercetak).</li>
            </ul>
            <div class="alert guide-info mb-0 small">
                <i class="fa-solid fa-circle-info me-1"></i>Panduan ini dapat dibuka kapan saja dari menu <strong>Bantuan <i class="fa-solid fa-angle-right" style="font-size:.65rem"></i> Panduan CMS</strong> di sidebar.
            </div>
        </div>
    </div>
</section>

<section id="login" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-right-to-bracket me-1"></i>Login &amp; Keamanan Akun</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Akses: <a class="guide-a" href="{{ url('/admin/login') }}" target="_blank" rel="noopener">{{ url('/admin/login') }}</a> (di luar CMS, tanpa sidebar)</p>

            <h3 class="h6 fw-bold mt-3">Langkah login</h3>
            <ol class="guide-step">
                <li>Buka halaman login CMS pada <code>/admin/login</code>.</li>
                <li>Masukkan <strong>email</strong> dan <strong>password</strong> akun admin Anda.</li>
                <li>Opsional: centang <strong>Ingat saya</strong> hanya jika memakai perangkat pribadi dan terpercaya.</li>
                <li>Klik <strong>Masuk ke Dashboard</strong>. Anda akan diarahkan ke halaman Dashboard.</li>
            </ol>

            <h3 class="h6 fw-bold mt-3">Lupa password</h3>
            <ol class="guide-step">
                <li>Di halaman login, klik <strong>Lupa password?</strong></li>
                <li>Masukkan email akun Anda, lalu kirim tautan reset.</li>
                <li>Buka tautan dari email, masukkan password baru, lalu simpan. Password lama langsung tidak berlaku.</li>
            </ol>

            <div class="alert guide-warn small mt-3 mb-2">
                <i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Keamanan:</strong>
                <ul class="mb-0 mt-1">
                    <li>Login dikunci sementara bila salah password <strong>5 kali dalam 1 menit</strong> (anti brute force) — tunggu 1 menit lalu coba lagi.</li>
                    <li>Setelah selesai bekerja, selalu <strong>Logout</strong> (klik nama Anda di kanan atas → Logout), terutama di komputer bersama. Menutup tab saja tidak logout.</li>
                    <li>Jangan membagikan akun. Setiap pengelola wajib memakai akun sendiri agar tercatat di Audit Log.</li>
                    <li>Akun yang dinonaktifkan Super Admin akan langsung keluar (force logout) saat mencoba mengakses CMS.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="dashboard" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-gauge-high me-1"></i>Dashboard</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Dashboard &nbsp;•&nbsp; URL: <code>/admin/dashboard</code></p>

            <p>Dashboard adalah halaman pertama setelah login, berisi ringkasan seluruh konten website dalam angka dan pintasan cepat.</p>

            <h3 class="h6 fw-bold mt-3">Isi halaman Dashboard</h3>
            <table class="table guide-table table-bordered mb-2">
                <thead><tr><th>Bagian</th><th>Isi &amp; Kegunaan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Sapaan &amp; aksi cepat</td><td>Sapaan dengan nama Anda dan tombol <strong>Tulis Berita</strong> untuk langsung membuat berita baru.</td></tr>
                    <tr><td class="guide-field-name">Kartu statistik (12 kartu)</td><td>Jumlah: Berita Terbit, Berita Draft (klik → daftar berita berfilter draft), Agenda/Event, Dosen Aktif, Mata Kuliah, CPL, Dokumen, Galeri, Publikasi, FAQ, Testimoni Terbit, dan Helpdesk Terbuka (border merah). Angka diambil langsung dari database.</td></tr>
                    <tr><td class="guide-field-name">Periode &amp; Status</td><td>Progres berita, daftar tahun akademik kalender tersedia, jumlah gelombang admisi aktif, dan periode biaya tercatat.</td></tr>
                    <tr><td class="guide-field-name">Konten Terakhir Diubah</td><td>5 konten yang paling baru diubah (Berita/Agenda/Dosen/Dokumen/Kurikulum) — memantau kerja tim.</td></tr>
                    <tr><td class="guide-field-name">Berita Terbaru</td><td>5 berita terbaru beserta badge status.</td></tr>
                    <tr><td class="guide-field-name">Aktivitas Perubahan Terakhir</td><td>10 entri audit log terakhir: aksi, data, waktu, dan admin pelaku (detail lengkap ada di halaman Audit Log — khusus Super Admin).</td></tr>
                    <tr><td class="guide-field-name">Akses Cepat</td><td>Pintasan: Profil Program, Tambah Dosen, Tambah Agenda, Upload Dokumen, Tambah Galeri, Pengaturan Website.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-warn small mb-0">
                <i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Catatan untuk Operator:</strong> tombol <em>Akses Cepat</em> <strong>Profil Program</strong> dan <strong>Pengaturan Website</strong> mengarah ke halaman khusus Super Admin — jika diklik, Anda akan mendapat halaman <strong>403</strong>. Aman dilewati; cukup gunakan menu konten Anda di sidebar.
            </div>
        </div>
    </div>
</section>

<section id="alur-crud" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-arrows-rotate me-1"></i>Alur Tambah / Ubah / Hapus Konten</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p>Hampir semua modul konten memakai pola yang sama. Kuasai pola ini sekali, maka Anda bisa memakai semua modul.</p>

            <h3 class="h6 fw-bold mt-3">1. Menambah data</h3>
            <ol class="guide-step">
                <li>Buka modul dari sidebar (mis. <strong>Berita</strong>), lalu klik tombol <strong>Tambah</strong> di kanan atas.</li>
                <li>Isi field bertanda <span class="guide-req">*</span> (wajib). Field lain opsional.</li>
                <li>Jika validasi gagal, daftar error tampil di atas form dan <strong>isian Anda tidak hilang</strong> — perbaiki lalu simpan ulang.</li>
                <li>Klik <strong>Simpan</strong> → notifikasi sukses hijau muncul dan Anda kembali ke daftar data.</li>
            </ol>

            <h3 class="h6 fw-bold mt-3">2. Mengubah data</h3>
            <ol class="guide-step">
                <li>Pada daftar, klik ikon pensil <i class="fa-solid fa-pen text-primary"></i> pada baris data.</li>
                <li>Ubah field yang diperlukan, lalu klik <strong>Simpan</strong>.</li>
            </ol>

            <h3 class="h6 fw-bold mt-3">3. Menghapus / mengarsipkan data</h3>
            <ol class="guide-step">
                <li>Klik ikon tempat sampah <i class="fa-solid fa-trash text-danger"></i> pada baris.</li>
                <li>Konfirmasi pada dialog SweetAlert yang muncul.</li>
                <li>Modul dengan <strong>soft delete</strong> (Berita, Agenda, Galeri, Dokumen, Dosen): data <strong>tidak hilang permanen</strong> — masuk arsip dan bisa dipulihkan.</li>
            </ol>

            <h3 class="h6 fw-bold mt-3">4. Memulihkan data dari arsip</h3>
            <ol class="guide-step">
                <li>Di daftar data, centang <strong>Tampilkan arsip (soft delete)</strong>. Baris arsip tampil redup dengan badge <span class="badge text-bg-danger">Arsip</span>.</li>
                <li>Klik tombol pulihkan <i class="fa-solid fa-rotate-left text-success"></i> pada baris tersebut.</li>
                <li>Data kembali normal dan tampil kembali menurut statusnya.</li>
            </ol>

            <h3 class="h6 fw-bold mt-3">5. Mencari &amp; memfilter data</h3>
            <ul class="mb-2">
                <li>Kolom <strong>Cari</strong> mencari kata kunci (judul/nama, tergantung modul).</li>
                <li>Dropdown filter (status, kategori, tahun, semester) mempersempit hasil; kombinasikan dengan pencarian.</li>
                <li>Klik tombol kaca pembesar (atau tekan Enter) untuk menjalankan filter.</li>
            </ul>

            <div class="row g-2 mt-1">
                <div class="col-md-6">
                    <div class="alert guide-ok small mb-0">
                        <strong><i class="fa-solid fa-circle-check me-1"></i>Perilaku bawaan yang membantu:</strong>
                        <ul class="mb-0 mt-1">
                            <li><strong>Slug otomatis</strong> dibuat dari judul/nama (hingga Anda mengeditnya manual).</li>
                            <li><strong>Peringatan form kotor</strong>: browser memperingatkan sebelum Anda meninggalkan form yang belum disimpan.</li>
                            <li><strong>Konten dibersihkan otomatis</strong>: script berbahaya dibuang dari isi teks (keamanan).</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert guide-warn small mb-0">
                        <strong><i class="fa-solid fa-triangle-exclamation me-1"></i>Yang perlu diingat:</strong>
                        <ul class="mb-0 mt-1">
                            <li>Modul tanpa soft delete (FAQ, Kurikulum, dll.) menghapus <strong>permanen</strong> — pastikan benar sebelum menghapus.</li>
                            <li>Beberapa data sensitif tidak bisa dihapus bila masih dipakai (kategori, file media) — sistem akan menolak dan memberi tahu alasannya.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="role" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-user-shield me-1"></i>Memahami Role &amp; Hak Akses</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p>CMS ini mengenal tepat <strong>2 role</strong>. Pembatasan ditegakkan di <em>server</em>: bukan sekadar menu disembunyikan — mencoba membuka URL area sensitif sebagai Operator akan langsung mendapat halaman <strong>403 Forbidden</strong>.</p>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Role</th><th>Rentang akses</th></tr></thead>
                <tbody>
                    <tr>
                        <td><span class="badge text-bg-warning">Super Admin</span></td>
                        <td><strong>Akses penuh</strong> seluruh CMS: seluruh modul konten <em>plus</em> Profil Program, Akreditasi, CPL, Kalender Akademik, Riset, Pengabdian, Kerja Sama, Testimoni, Alumni, Kategori, Media Manager, Kesehatan SEO, Pengaturan Website, Helpdesk, Audit Log, dan Kelola Admin.</td>
                    </tr>
                    <tr>
                        <td><span class="badge text-bg-secondary">Operator</span></td>
                        <td><strong>Hanya modul konten</strong> (deny-by-default untuk sisanya): Dashboard, Profil Saya, Berita, Agenda, Galeri, Dokumen, FAQ, Publikasi, Kurikulum, Dosen/Pengajar, Gelombang Pendaftaran, dan Biaya Pendidikan.</td>
                    </tr>
                </tbody>
            </table>

            <div class="alert guide-info small mb-0">
                <i class="fa-solid fa-circle-info me-1"></i>Role Anda saat ini terlihat di <strong>sidebar kiri bawah</strong> (badge di bawah nama/email) dan menentukan menu yang tampil. Panduan ini otomatis menampilkan bagian yang relevan dengan role Anda pada tab <strong>Role Saya</strong>.
            </div>
        </div>
    </div>
</section>

<section id="profil-saya" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-user me-1"></i>Profil Saya</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Akun <i class="fa-solid fa-angle-right"></i> Profil Saya &nbsp;•&nbsp; URL: <code>/admin/profile</code></p>
            <p>Halaman untuk mengelola data akun login Anda sendiri. Tersedia dua kartu:</p>

            <h3 class="h6 fw-bold mt-3">Kartu: Data akun</h3>
            <table class="table guide-table table-bordered mb-2">
                <thead><tr><th>Field</th><th>Ketentuan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama <span class="guide-req">*</span></td><td>Nama tampilan Anda (wajib).</td></tr>
                    <tr><td class="guide-field-name">Email <span class="guide-req">*</span></td><td>Email login, harus unik di antara seluruh admin. Jika digunakan admin lain, muncul error validasi.</td></tr>
                </tbody>
            </table>
            <p>Klik <strong>Simpan Profil</strong> → notifikasi “Profil berhasil diperbarui.”</p>
            <div class="alert guide-info small"><i class="fa-solid fa-circle-info me-1"></i>Field <strong>role tidak tersedia</strong> di halaman ini — mengirim perubahan role lewat form profil diabaikan sistem (tidak bisa eskalasi hak akses sendiri). Role hanya bisa diatur oleh Super Admin melalui <strong>Kelola Admin</strong>.</div>

            <h3 class="h6 fw-bold mt-3">Kartu: Ubah password</h3>
            <table class="table guide-table table-bordered mb-2">
                <thead><tr><th>Field</th><th>Ketentuan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Password saat ini <span class="guide-req">*</span></td><td>Wajib benar; jika salah muncul pesan “Password saat ini salah.”</td></tr>
                    <tr><td class="guide-field-name">Password baru <span class="guide-req">*</span></td><td>Min. 8 karakter, kombinasi <strong>huruf besar + huruf kecil + angka</strong>, dan dikonfirmasi.</td></tr>
                    <tr><td class="guide-field-name">Konfirmasi password baru <span class="guide-req">*</span></td><td>Harus sama persis dengan password baru.</td></tr>
                </tbody>
            </table>
            <p class="mb-0">Klik <strong>Ubah Password</strong> → seluruh sesi login Anda diperbarui mengikuti password baru. Password lama tidak dapat dipakai lagi.</p>
        </div>
    </div>
</section>
