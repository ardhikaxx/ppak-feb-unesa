{{-- ================= MODUL KONTEN (Operator & Super Admin) ================= --}}

<section id="berita" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-newspaper me-1"></i>Berita &amp; Pengumuman</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Informasi &amp; Publikasi <i class="fa-solid fa-angle-right"></i> Berita &nbsp;•&nbsp; URL: <code>/admin/news</code></p>
            <p>Mengelola berita dan pengumuman yang tampil di halaman <a class="guide-a" href="{{ url('/informasi/berita') }}" target="_blank" rel="noopener">/informasi/berita</a>, beranda (3 terbaru), detail <code>/informasi/berita/{slug}</code>, serta sitemap.</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar berita</h3>
            <ul>
                <li><strong>Cari</strong> — kata kunci pada judul/excerpt (maks 100 karakter).</li>
                <li><strong>Semua status</strong> — Draft / Terbit / Terjadwal / Arsip.</li>
                <li><strong>Semua kategori</strong> — filter per kategori berita.</li>
                <li><strong>Tampilkan arsip (soft delete)</strong> — menampilkan berita yang diarsipkan untuk dipulihkan.</li>
            </ul>
            <p>Kolom tabel: Judul (+slug), Kategori, Status, Terbit, Aksi (12 baris/halaman).</p>

            <h3 class="h6 fw-bold mt-3">Langkah membuat berita</h3>
            <ol class="guide-step">
                <li>Buka <strong>Berita</strong> → klik <strong>Tambah Berita</strong>.</li>
                <li>Isi <strong>Judul</strong>; <strong>Slug</strong> terisi otomatis dari judul (huruf kecil, angka, tanda <code>-</code>; harus unik).</li>
                <li>Tulis <strong>Excerpt</strong> (ringkasan 1–2 kalimat, maks 500 karakter) dan <strong>Isi berita</strong> (min. 20 karakter; boleh format dasar: tebal, miring, daftar, tautan — script otomatis dibuang).</li>
                <li>Pilih <strong>Status</strong>, kategori (opsional), tanggal publikasi, estimasi baca, dan tag (pisahkan koma, maks 10 tag).</li>
                <li>Unggah <strong>gambar utama</strong> (saat membuat: wajib; JPG/PNG/WebP, maks 5 MB).</li>
                <li>Opsional: isi kartu <strong>SEO</strong> (lihat bagian “Kartu SEO” di bawah).</li>
                <li>Klik <strong>Simpan</strong>. Setelah terbit, klik ikon 🌐 untuk <strong>preview publik</strong>.</li>
            </ol>

            <h3 class="h6 fw-bold mt-3">Penjelasan field</h3>
            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Judul</td><td><span class="guide-req">Ya</span></td><td>Maks 255 karakter.</td></tr>
                    <tr><td class="guide-field-name">Slug</td><td><span class="guide-req">Ya</span></td><td>Otomatis dari judul; hanya huruf kecil/angka/<code>-</code>; harus unik (jadi URL: <code>/informasi/berita/{slug}</code>).</td></tr>
                    <tr><td class="guide-field-name">Excerpt (ringkasan)</td><td><span class="guide-req">Ya</span></td><td>Maks 500 karakter; tampil di daftar berita &amp; kartu sosial.</td></tr>
                    <tr><td class="guide-field-name">Isi berita</td><td><span class="guide-req">Ya</span></td><td>Min. 20 karakter. Tag HTML yang diizinkan: p, br, strong, em, u, ul, ol, li, a, h2–h4, blockquote.</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td><strong>Draft</strong> = konsep, tidak tampil; <strong>Terbit</strong> = tampil di website; <strong>Terjadwal</strong> = disiapkan untuk penjadwalan; <strong>Arsip</strong> = disembunyikan tanpa menghapus.</td></tr>
                    <tr><td class="guide-field-name">Kategori</td><td><span class="guide-opt">Opsional</span></td><td>Dipilih dari kategori bertipe <em>berita</em> (dikelola Super Admin di menu Kategori).</td></tr>
                    <tr><td class="guide-field-name">Tanggal publikasi</td><td><span class="guide-opt">Opsional</span></td><td>Kosong + status Terbit → otomatis memakai waktu saat ini.</td></tr>
                    <tr><td class="guide-field-name">Estimasi baca</td><td><span class="guide-opt">Opsional</span></td><td>Contoh: “3 Menit Baca”.</td></tr>
                    <tr><td class="guide-field-name">Tag</td><td><span class="guide-opt">Opsional</span></td><td>Pisahkan dengan koma, maksimal 10 tag.</td></tr>
                    <tr><td class="guide-field-name">Gambar utama</td><td><span class="guide-req">Ya (saat buat)</span></td><td>JPG/PNG/WebP, maks 5 MB; otomatis dikompres ke WebP dan di-resize maks lebar 1200px.</td></tr>
                    <tr><td class="guide-field-name">Hapus gambar saat ini</td><td><span class="guide-opt">Opsional</span></td><td>Centang untuk menghapus gambar utama saat mengedit.</td></tr>
                </tbody>
            </table>

            <h3 class="h6 fw-bold mt-3">Kartu SEO (pratinjau langsung)</h3>
            <p>Pada form berita (dan agenda) terdapat kartu SEO dengan pratinjau <strong>Google SERP</strong> dan <strong>kartu sosial (Open Graph)</strong> yang berubah real-time saat mengetik:</p>
            <table class="table guide-table table-bordered mb-2">
                <thead><tr><th>Field SEO</th><th>Aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Custom SEO Title</td><td>Maks 255; counter hingga 60 karakter (ideal untuk Google).</td></tr>
                    <tr><td class="guide-field-name">Custom Meta Description</td><td>Maks 500; counter hingga 160 karakter.</td></tr>
                    <tr><td class="guide-field-name">Custom OG Title / OG Description</td><td>Judul &amp; deskripsi khusus saat tautan dibagikan di media sosial.</td></tr>
                    <tr><td class="guide-field-name">Custom Canonical URL</td><td>Harus URL valid; menandai URL kanonik halaman ini.</td></tr>
                    <tr><td class="guide-field-name">Custom OG Image</td><td>JPG/PNG/WebP maks 5 MB; ukuran ideal 1200×630px. Kosongkan = memakai gambar utama berita. Centang “Hapus gambar OG saat ini” untuk mengosongkannya.</td></tr>
                    <tr><td class="guide-field-name">Izinkan Mesin Pencari Mengindeks</td><td>Default aktif; matikan agar berita tidak diindeks Google.</td></tr>
                </tbody>
            </table>

            <div class="row g-2">
                <div class="col-md-6"><div class="alert guide-tip small mb-0"><strong><i class="fa-solid fa-lightbulb me-1"></i>Tips:</strong> selalu cek <strong>preview 🌐</strong> sebelum menerbitkan berita penting; tulis excerpt yang menarik karena excerpt tampil di hasil pencarian.</div></div>
                <div class="col-md-6"><div class="alert guide-warn small mb-0"><strong><i class="fa-solid fa-triangle-exclamation me-1"></i>Hati-hati:</strong> tombol hapus berlabel “Arsipkan” — berita masuk arsip (soft delete), bukan hilang permanen. Pulihkan lewat checkbox “Tampilkan arsip”.</div></div>
            </div>
        </div>
    </div>
</section>

<section id="agenda" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-calendar-check me-1"></i>Agenda / Event</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Informasi &amp; Publikasi <i class="fa-solid fa-angle-right"></i> Agenda / Event &nbsp;•&nbsp; URL: <code>/admin/agendas</code></p>
            <p>Mengelola agenda kegiatan yang tampil di <a class="guide-a" href="{{ url('/informasi/agenda') }}" target="_blank" rel="noopener">/informasi/agenda</a>, beranda (3 agenda), dan berita terkait event (schema Event).</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar agenda</h3>
            <ul>
                <li><strong>Cari</strong> — judul / lokasi.</li>
                <li><strong>Status</strong> — Mendatang / Berlangsung / Selesai / Batal.</li>
                <li><strong>Tahun</strong> — 2000–2100.</li>
                <li><strong>Tampilkan arsip (soft delete)</strong>.</li>
            </ul>
            <p>Kolom: Kegiatan, Tanggal, Lokasi, Status, Aksi (12/halaman). <em>Catatan:</em> kolom Status pada daftar memakai penanda “Mendatang/Selesai” (checkbox <em>Tandai sebagai event mendatang</em>), bukan field Status di form.</p>

            <h3 class="h6 fw-bold mt-3">Langkah membuat agenda</h3>
            <ol class="guide-step">
                <li>Buka <strong>Agenda / Event</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Judul</strong> (slug otomatis) dan <strong>Tanggal mulai</strong> (wajib).</li>
                <li>Bila acara lebih dari sehari, isi <strong>Tanggal selesai</strong> (tidak boleh sebelum tanggal mulai).</li>
                <li>Lengkapi <strong>Waktu</strong> (mis. “08.00 - Selesai WIB”), <strong>Lokasi</strong>, dan <strong>Pembicara / narasumber</strong>.</li>
                <li>Tulis <strong>Deskripsi</strong>, pilih <strong>Status</strong>, kategori, dan sumber (opsional).</li>
                <li>Centang <strong>Tandai sebagai event mendatang</strong> bila ingin tampil di seksi “Mendatang” di website (default aktif).</li>
                <li>Opsional: isi kartu SEO. Klik <strong>Simpan</strong>.</li>
            </ol>

            <h3 class="h6 fw-bold mt-3">Penjelasan field</h3>
            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Judul</td><td><span class="guide-req">Ya</span></td><td>Maks 255; slug unik otomatis.</td></tr>
                    <tr><td class="guide-field-name">Tanggal mulai</td><td><span class="guide-req">Ya</span></td><td>Tanggal pelaksanaan.</td></tr>
                    <tr><td class="guide-field-name">Tanggal selesai</td><td><span class="guide-opt">Opsional</span></td><td>Wajib ≥ tanggal mulai.</td></tr>
                    <tr><td class="guide-field-name">Waktu</td><td><span class="guide-opt">Opsional</span></td><td>Maks 100 karakter, mis. “08.00 - 12.00 WIB”.</td></tr>
                    <tr><td class="guide-field-name">Lokasi</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255, mis. “Gedung G6 FEB Kampus Ketintang”.</td></tr>
                    <tr><td class="guide-field-name">Pembicara / narasumber</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255.</td></tr>
                    <tr><td class="guide-field-name">Deskripsi</td><td><span class="guide-opt">Opsional</span></td><td>Teks bebas (sanitasi HTML).</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td>Mendatang / Berlangsung / Selesai / Batal (default Mendatang).</td></tr>
                    <tr><td class="guide-field-name">Tandai sebagai event mendatang</td><td><span class="guide-opt">Opsional</span></td><td>Checkbox; default aktif; mengendalikan label “Mendatang” di daftar &amp; website.</td></tr>
                    <tr><td class="guide-field-name">Kategori</td><td><span class="guide-opt">Opsional</span></td><td>Dari kategori bertipe <em>agenda</em>.</td></tr>
                    <tr><td class="guide-field-name">Sumber &amp; URL sumber</td><td><span class="guide-opt">Opsional</span></td><td>Kredit/tautan asal kegiatan; URL harus valid.</td></tr>
                    <tr><td class="guide-field-name">SEO (kartu)</td><td><span class="guide-opt">Opsional</span></td><td>Seperti berita, <strong>tanpa OG Image</strong>.</td></tr>
                </tbody>
            </table>

            <div class="row g-2">
                <div class="col-md-6"><div class="alert guide-tip small mb-0"><strong><i class="fa-solid fa-lightbulb me-1"></i>Tips:</strong> event lampau biarkan berstatus “Selesai” — di website otomatis pindah ke arsip tampilan, datanya tetap ada.</div></div>
                <div class="col-md-6"><div class="alert guide-info small mb-0"><strong><i class="fa-solid fa-circle-info me-1"></i>Info:</strong> agenda mendukung soft delete + pemulihan seperti berita.</div></div>
            </div>
        </div>
    </div>
</section>

<section id="galeri" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-images me-1"></i>Galeri</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Informasi &amp; Publikasi <i class="fa-solid fa-angle-right"></i> Galeri &nbsp;•&nbsp; URL: <code>/admin/galleries</code></p>
            <p>Mengelola foto galeri yang tampil di <a class="guide-a" href="{{ url('/informasi/galeri') }}" target="_blank" rel="noopener">/informasi/galeri</a> (12 foto/halaman, hanya yang berstatus Terbit).</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar galeri</h3>
            <ul>
                <li><strong>Cari</strong> — judul foto.</li>
                <li><strong>Status</strong> — Draft / Terbit / Arsip.</li>
            </ul>
            <p>Kolom: Foto (thumbnail), Judul (+slug • tanggal), Kategori, Status, Aksi (12/halaman).</p>

            <h3 class="h6 fw-bold mt-3">Langkah menambah foto</h3>
            <ol class="guide-step">
                <li>Buka <strong>Galeri</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Judul / caption</strong> (wajib, jelas &amp; deskriptif); slug otomatis.</li>
                <li>Pilih kategori (opsional) dan tanggal (opsional).</li>
                <li>Unggah <strong>Foto</strong> — wajib saat membuat: JPG/PNG/WebP, maks 5 MB (ada pratinjau; ganti foto = upload file baru).</li>
                <li>Pilih <strong>Status</strong> (default Terbit) lalu <strong>Simpan</strong>.</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Judul / caption</td><td><span class="guide-req">Ya</span></td><td>Maks 255; slug unik otomatis.</td></tr>
                    <tr><td class="guide-field-name">Kategori</td><td><span class="guide-opt">Opsional</span></td><td>Dari kategori bertipe <em>galeri</em>.</td></tr>
                    <tr><td class="guide-field-name">Tanggal</td><td><span class="guide-opt">Opsional</span></td><td>Tanggal kejadian foto.</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td>Draft / Terbit (default) / Arsip.</td></tr>
                    <tr><td class="guide-field-name">Foto</td><td><span class="guide-req">Ya (saat buat)</span></td><td>JPG/PNG/WebP, maks 5 MB.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-warn small mb-0">
                <i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Catatan arsip:</strong> Galeri mendukung pemulihan (<em>restore</em>), tetapi daftarnya <strong>tidak punya checkbox “Tampilkan arsip”</strong>. Untuk melihat foto yang diarsipkan, tambahkan <code>?trashed=1</code> di akhir URL halaman galeri (mis. <code>/admin/galleries?trashed=1</code>), lalu klik tombol pulihkan ↩️.
            </div>
        </div>
    </div>
</section>

<section id="dosen" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-chalkboard-user me-1"></i>Dosen / Pengajar</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Profil PPAk <i class="fa-solid fa-angle-right"></i> Dosen / Pengajar &nbsp;•&nbsp; URL: <code>/admin/lecturers</code></p>
            <p>Mengelola data dosen yang tampil di <a class="guide-a" href="{{ url('/profil/dosen-pengajar') }}" target="_blank" rel="noopener">/profil/dosen-pengajar</a> (hanya status Aktif; 8/halaman + filter bidang) dan beranda (4 dosen).</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar dosen</h3>
            <ul>
                <li><strong>Cari</strong> — nama / bidang keahlian.</li>
                <li><strong>Status</strong> — Aktif / Nonaktif.</li>
                <li><strong>Kategori bidang</strong> — Auditing / Keuangan / Perpajakan / Manajemen.</li>
                <li><strong>Tampilkan arsip (soft delete)</strong>.</li>
            </ul>
            <p>Kolom: Foto, Nama, Bidang, Urutan, Status, Aksi (+ tombol Pulihkan bila diarsipkan), 12/halaman. Modul ini punya halaman <strong>detail</strong> (ikon mata 👁).</p>

            <h3 class="h6 fw-bold mt-3">Langkah menambah dosen</h3>
            <ol class="guide-step">
                <li>Buka <strong>Dosen / Pengajar</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Nama lengkap (tanpa gelar)</strong> — slug otomatis dibuat dari nama.</li>
                <li>Isi <strong>Nama bergelar</strong> terpisah, mis. “Nama, S.E., M.S.A.” (kedua nama dipisah kolom agar rapi di tampilan).</li>
                <li>Pilih <strong>Kategori bidang</strong> (wajib: Auditing/Keuangan/Perpajakan/Manajemen) dan isi label kategori bila perlu.</li>
                <li>Lengkapi bidang keahlian, mata kuliah diampu (pisahkan koma, maks 20), email, sertifikasi (pisahkan koma, maks 20).</li>
                <li>Unggah <strong>Foto baru</strong> (opsional; JPG/PNG/WebP maks 5 MB) atau centang “Hapus foto saat ini”.</li>
                <li>Atur <strong>Status</strong> (Aktif tampil di publik / Nonaktif) dan <strong>Urutan tampil</strong> (angka kecil tampil lebih dulu; default 0).</li>
                <li>Klik <strong>Simpan</strong>.</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama lengkap (tanpa gelar)</td><td><span class="guide-req">Ya</span></td><td>Maks 255; sumber slug.</td></tr>
                    <tr><td class="guide-field-name">Nama bergelar</td><td><span class="guide-opt">Opsional</span></td><td>“Nama, S.E., M.S.A.” — tampil pada kartu dosen.</td></tr>
                    <tr><td class="guide-field-name">Slug</td><td><span class="guide-req">Ya</span></td><td>Otomatis dari nama; unik.</td></tr>
                    <tr><td class="guide-field-name">Jabatan / peran</td><td><span class="guide-opt">Opsional</span></td><td>Mis. “Ketua Prodi”, “Sekretaris Prodi”.</td></tr>
                    <tr><td class="guide-field-name">Kategori bidang</td><td><span class="guide-req">Ya</span></td><td>auditing / keuangan / perpajakan / manajemen (default manajemen).</td></tr>
                    <tr><td class="guide-field-name">Label kategori</td><td><span class="guide-opt">Opsional</span></td><td>Label tampilan alternatif bila perlu.</td></tr>
                    <tr><td class="guide-field-name">Bidang keahlian</td><td><span class="guide-opt">Opsional</span></td><td>Maks 500 karakter.</td></tr>
                    <tr><td class="guide-field-name">Mata kuliah diampu</td><td><span class="guide-opt">Opsional</span></td><td>Pisahkan koma → tersimpan sebagai daftar, maks 20 item.</td></tr>
                    <tr><td class="guide-field-name">Email</td><td><span class="guide-opt">Opsional</span></td><td>Format email valid, maks 255.</td></tr>
                    <tr><td class="guide-field-name">Sertifikasi</td><td><span class="guide-opt">Opsional</span></td><td>Pisahkan koma, maks 20 item.</td></tr>
                    <tr><td class="guide-field-name">Foto baru</td><td><span class="guide-opt">Opsional</span></td><td>JPG/PNG/WebP maks 5 MB; bisa dihapus via “Hapus foto saat ini”.</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td><strong>Aktif</strong> = tampil di publik; <strong>Nonaktif</strong> = disembunyikan tanpa menghapus data.</td></tr>
                    <tr><td class="guide-field-name">Urutan tampil</td><td><span class="guide-opt">Opsional</span></td><td>0–9999; angka kecil = tampil lebih dulu.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-tip small mb-0"><i class="fa-solid fa-lightbulb me-1"></i><strong>Tips:</strong> dosen pindah institusi? Cukup ubah <strong>Status → Nonaktif</strong> — datanya tersimpan rapi dan tidak tampil di website, tanpa perlu menghapus.</div>
        </div>
    </div>
</section>

<section id="kurikulum" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-book-open me-1"></i>Kurikulum</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Akademik <i class="fa-solid fa-angle-right"></i> Kurikulum &nbsp;•&nbsp; URL: <code>/admin/curricula</code></p>
            <p>Mengelola daftar mata kuliah yang tampil di <a class="guide-a" href="{{ url('/akademik/kurikulum') }}" target="_blank" rel="noopener">/akademik/kurikulum</a> (tabel semester 1–8 + Paket Magang, lengkap dengan total SKS) dan cuplikan beranda.</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar kurikulum</h3>
            <ul>
                <li><strong>Cari</strong> — kode / nama mata kuliah.</li>
                <li><strong>Semester</strong> — Semester 1–8.</li>
            </ul>
            <p>Kolom: Kode, Mata Kuliah, Sem., SKS, Jenis, Urutan, Aksi (15/halaman). Hapus di sini bersifat <strong>permanen</strong>.</p>

            <h3 class="h6 fw-bold mt-3">Langkah menambah mata kuliah</h3>
            <ol class="guide-step">
                <li>Buka <strong>Kurikulum</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Kode MK</strong> (wajib, maks 30, harus unik) dan <strong>Nama mata kuliah</strong>.</li>
                <li>Pilih <strong>Semester</strong> (1–8), <strong>SKS</strong> (0–12), dan <strong>Jenis</strong> (Wajib / Pilihan / Paket Magang).</li>
                <li>Atur <strong>Urutan</strong>, <strong>Tahun kurikulum</strong> (default tahun berjalan), dan deskripsi bila perlu.</li>
                <li>Centang <strong>Pemetaan CPL</strong> yang dicapai mata kuliah ini (butir CPL tersedia bila sudah diketahui Super Admin).</li>
                <li>Isi <strong>Pengampu</strong> — pisahkan nama dengan koma/garis baru (maks 20 nama).</li>
                <li>Klik <strong>Simpan</strong>.</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Kode MK</td><td><span class="guide-req">Ya</span></td><td>Maks 30; <strong>unik</strong> di seluruh kurikulum.</td></tr>
                    <tr><td class="guide-field-name">Nama mata kuliah</td><td><span class="guide-req">Ya</span></td><td>Nama Indonesia (maks 255).</td></tr>
                    <tr><td class="guide-field-name">Nama (Inggris)</td><td><span class="guide-opt">Opsional</span></td><td>Nama bahasa Inggris bila ada.</td></tr>
                    <tr><td class="guide-field-name">Semester</td><td><span class="guide-req">Ya</span></td><td>1–8 (default 1).</td></tr>
                    <tr><td class="guide-field-name">SKS</td><td><span class="guide-req">Ya</span></td><td>0–12 (default 3).</td></tr>
                    <tr><td class="guide-field-name">Jenis</td><td><span class="guide-req">Ya</span></td><td>Wajib / Pilihan / Paket Magang (default Wajib).</td></tr>
                    <tr><td class="guide-field-name">Urutan</td><td><span class="guide-opt">Opsional</span></td><td>0–9999; mengatur urutan dalam semester.</td></tr>
                    <tr><td class="guide-field-name">Tahun kurikulum</td><td><span class="guide-opt">Opsional</span></td><td>Maks 20, mis. “2025/2026”.</td></tr>
                    <tr><td class="guide-field-name">Deskripsi</td><td><span class="guide-opt">Opsional</span></td><td>Teks bebas (sanitasi HTML).</td></tr>
                    <tr><td class="guide-field-name">Pemetaan CPL</td><td><span class="guide-opt">Opsional</span></td><td>Checkbox per butir CPL; disimpan sebagai daftar kode (maks 20 karakter per kode).</td></tr>
                    <tr><td class="guide-field-name">Pengampu</td><td><span class="guide-opt">Opsional</span></td><td>Pisahkan dengan koma/garis baru/titik koma → maks 20 nama.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-warn small mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Perhatian:</strong> penghapusan mata kuliah bersifat <strong>permanen</strong> (konfirmasi “Hapus mata kuliah {kode}?”). Pastikan tidak dipakai dalam dokumen lain sebelum menghapus.</div>
        </div>
    </div>
</section>

<section id="gelombang" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-door-open me-1"></i>Gelombang Pendaftaran</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Admisi <i class="fa-solid fa-angle-right"></i> Gelombang Pendaftaran &nbsp;•&nbsp; URL: <code>/admin/admission-schedules</code></p>
            <p>Mengelola jadwal gelombang pendaftaran yang tampil di <a class="guide-a" href="{{ url('/admisi/prosedur-jadwal') }}" target="_blank" rel="noopener">/admisi/prosedur-jadwal</a> dan banner pendaftaran beranda (<em>Pendaftaran Dibuka</em>).</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar gelombang</h3>
            <ul>
                <li><strong>Tahun</strong> — tahun akademik (format 2026/2027).</li>
                <li><strong>Status</strong> — Aktif (dibuka) / Segera dibuka / Arsip.</li>
            </ul>
            <p><em>Tidak ada kolom pencarian bebas</em> di modul ini. Kolom: Tahun/Gelombang, Periode Pendaftaran, Pengumuman, Status, Aksi (12/halaman). Hapus bersifat permanen.</p>

            <h3 class="h6 fw-bold mt-3">Langkah menambah gelombang</h3>
            <ol class="guide-step">
                <li>Buka <strong>Gelombang Pendaftaran</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Tahun akademik</strong> dengan format <code>2026/2027</code> (wajib; format lain ditolak) dan <strong>Nama gelombang</strong> (mis. “Gelombang 1”).</li>
                <li>Pilih <strong>Status periode</strong>: Aktif (sedang dibuka) / Segera dibuka / Arsip.</li>
                <li>Isi <strong>Pendaftaran mulai</strong> &amp; <strong>Pendaftaran selesai</strong> (selesai tidak boleh sebelum mulai).</li>
                <li>Opsional: Tanggal seleksi, Tanggal pengumuman, Batas daftar ulang, dan Label periode (teks tampil di website; kosongkan bila tidak perlu).</li>
                <li>Klik <strong>Simpan</strong>.</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Tahun akademik</td><td><span class="guide-req">Ya</span></td><td>Format wajib <code>2026/2027</code> (regex ketat), default 2026/2027.</td></tr>
                    <tr><td class="guide-field-name">Nama gelombang</td><td><span class="guide-req">Ya</span></td><td>Maks 50, mis. “Gelombang 1”.</td></tr>
                    <tr><td class="guide-field-name">Status periode</td><td><span class="guide-req">Ya</span></td><td><strong>Aktif</strong> = “sedang dibuka” di website; <strong>Segera dibuka</strong> = mendatang; <strong>Arsip</strong> = selesai.</td></tr>
                    <tr><td class="guide-field-name">Label periode</td><td><span class="guide-opt">Opsional</span></td><td>Teks tampilan di website, maks 100.</td></tr>
                    <tr><td class="guide-field-name">Pendaftaran mulai / selesai</td><td><span class="guide-req">Ya</span></td><td>Dua tanggal wajib; selesai ≥ mulai.</td></tr>
                    <tr><td class="guide-field-name">Tanggal seleksi</td><td><span class="guide-opt">Opsional</span></td><td>Tanggal ujian/seleksi.</td></tr>
                    <tr><td class="guide-field-name">Tanggal pengumuman</td><td><span class="guide-opt">Opsional</span></td><td>Tanggal hasil diumumkan.</td></tr>
                    <tr><td class="guide-field-name">Batas daftar ulang</td><td><span class="guide-opt">Opsional</span></td><td>Batas waktu daftar ulang penerimaan.</td></tr>
                </tbody>
            </table>

            <div class="row g-2">
                <div class="col-md-6"><div class="alert guide-ok small mb-0"><strong><i class="fa-solid fa-circle-check me-1"></i>Otomatis:</strong> saat menyimpan gelombang baru berstatus Aktif, gelombang lama yang masih Aktif otomatis diarsipkan sistem.</div></div>
                <div class="col-md-6"><div class="alert guide-warn small mb-0"><strong><i class="fa-solid fa-triangle-exclamation me-1"></i>Penting:</strong> jangan biarkan status <strong>Aktif</strong> pada gelombang yang tanggalnya sudah lewat — ubah ke <strong>Arsip</strong> agar website tidak menampilkan pendaftaran palsu.</div></div>
            </div>
        </div>
    </div>
</section>

<section id="biaya" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-money-bill-wave me-1"></i>Biaya Pendidikan</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Admisi <i class="fa-solid fa-angle-right"></i> Biaya Pendidikan &nbsp;•&nbsp; URL: <code>/admin/tuition-fees</code></p>
            <p>Mengelola data biaya/UKT yang tampil di <a class="guide-a" href="{{ url('/admisi/biaya') }}" target="_blank" rel="noopener">/admisi/biaya</a> dan info admisi beranda.</p>

            <h3 class="h6 fw-bold mt-3">Daftar biaya</h3>
            <p>Tanpa filter di UI. Kolom: Program/Jenis, Nominal (format Rupiah), Periode, Tahun, Aksi (12/halaman). Hapus bersifat permanen. <strong>Setiap penyimpanan selalu membuat baris baru</strong> — tidak ada tombol “ubah” yang menimpa riwayat.</p>

            <h3 class="h6 fw-bold mt-3">Langkah menambah biaya</h3>
            <ol class="guide-step">
                <li>Buka <strong>Biaya Pendidikan</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Nama program</strong> (default “Pendidikan Profesi Akuntan”) dan <strong>Jenis biaya</strong> (default “UKT”).</li>
                <li>Isi <strong>Nominal (Rp)</strong> sebagai angka (mis. 5500000; tanpa titik/koma).</li>
                <li>Isi <strong>Periode berlaku</strong> (default “Per Semester”) dan <strong>Tahun akademik</strong> (format <code>2026/2027</code>, wajib).</li>
                <li>Opsional: deskripsi/catatan, nama sumber, dan URL sumber (harus <code>https://…</code>).</li>
                <li>Klik <strong>Simpan</strong>.</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama program</td><td><span class="guide-req">Ya</span></td><td>Maks 255.</td></tr>
                    <tr><td class="guide-field-name">Jenis biaya</td><td><span class="guide-req">Ya</span></td><td>Maks 50, mis. “UKT”, “SPP”.</td></tr>
                    <tr><td class="guide-field-name">Nominal (Rp)</td><td><span class="guide-req">Ya</span></td><td>Angka bulat 0–1.000.000.000.</td></tr>
                    <tr><td class="guide-field-name">Periode berlaku</td><td><span class="guide-opt">Opsional</span></td><td>Maks 30, mis. “Per Semester”.</td></tr>
                    <tr><td class="guide-field-name">Tahun akademik</td><td><span class="guide-req">Ya</span></td><td>Format <code>2026/2027</code>.</td></tr>
                    <tr><td class="guide-field-name">Deskripsi / catatan</td><td><span class="guide-opt">Opsional</span></td><td>Keterangan tambahan (sanitasi HTML).</td></tr>
                    <tr><td class="guide-field-name">Nama sumber &amp; URL sumber</td><td><span class="guide-opt">Opsional</span></td><td>Referensi resmi (mis. SK/website resmi).</td></tr>
                </tbody>
            </table>

            <div class="alert guide-warn small mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Aturan historis:</strong> nominal lama adalah <strong>data historis</strong>. Bila tarif berubah, <strong>buat record baru</strong> untuk periode/tahun baru — jangan menimpa nominal lama agar jejak riwayat biaya tetap akurat.</div>
        </div>
    </div>
</section>

<section id="faq" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-circle-question me-1"></i>FAQ (Tanya Jawab)</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Admisi <i class="fa-solid fa-angle-right"></i> FAQ &nbsp;•&nbsp; URL: <code>/admin/faqs</code></p>
            <p>Mengelola pertanyaan &amp; jawaban yang tampil di <a class="guide-a" href="{{ url('/admisi/faq') }}" target="_blank" rel="noopener">/admisi/faq</a> (seluruh FAQ) dan 4 FAQ teratas di halaman <a class="guide-a" href="{{ url('/kontak/helpdesk') }}" target="_blank" rel="noopener">/kontak/helpdesk</a>.</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar FAQ</h3>
            <ul>
                <li><strong>Cari</strong> — kata kunci pada pertanyaan/jawaban.</li>
                <li><strong>Kategori</strong> — filter per kategori FAQ.</li>
            </ul>
            <p>Kolom: Kategori, Pertanyaan, Urutan, Aksi (15/halaman). Urutan tampil mengikuti kolom <em>Urutan</em> lalu ID.</p>

            <h3 class="h6 fw-bold mt-3">Langkah menambah FAQ</h3>
            <ol class="guide-step">
                <li>Buka <strong>FAQ</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Kategori</strong> (wajib, maks 50; default “Pendaftaran”). Saran kategori: Pendaftaran, Biaya, Akun PMB, Pembayaran, Dokumen, Akademik, Kontak.</li>
                <li>Atur <strong>Urutan tampil</strong> (angka kecil tampil lebih dulu; default 0).</li>
                <li>Tulis <strong>Pertanyaan</strong> dan <strong>Jawaban</strong> (wajib; jawaban sebaiknya berbasis sumber resmi).</li>
                <li>Klik <strong>Simpan</strong>.</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Kategori</td><td><span class="guide-req">Ya</span></td><td>Maks 50 karakter; gunakan kategori yang konsisten agar mudah dikelompokkan di website.</td></tr>
                    <tr><td class="guide-field-name">Urutan tampil</td><td><span class="guide-opt">Opsional</span></td><td>0–9999 (default 0).</td></tr>
                    <tr><td class="guide-field-name">Pertanyaan</td><td><span class="guide-req">Ya</span></td><td>Teks pertanyaan singkat &amp; jelas.</td></tr>
                    <tr><td class="guide-field-name">Jawaban</td><td><span class="guide-req">Ya</span></td><td>Jawaban lengkap (textarea); utamakan merujuk ketentuan resmi.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-warn small mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Perhatian:</strong> FAQ <strong>tidak memiliki arsip (soft delete)</strong> — menghapus FAQ bersifat <strong>permanen</strong>. Pastikan sudah benar sebelum menghapus.</div>
        </div>
    </div>
</section>

<section id="publikasi" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-file-lines me-1"></i>Publikasi</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Riset &amp; Pengabdian <i class="fa-solid fa-angle-right"></i> Publikasi &nbsp;•&nbsp; URL: <code>/admin/publications</code></p>
            <p>Mengelola daftar publikasi ilmiah (artikel jurnal, dll.) yang tampil di <a class="guide-a" href="{{ url('/riset-pengabdian/riset-publikasi') }}" target="_blank" rel="noopener">/riset-pengabdian/riset-publikasi</a> dan seksi riset beranda.</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar publikasi</h3>
            <ul>
                <li><strong>Cari</strong> — judul / penulis.</li>
                <li><strong>Tahun</strong> — tahun terbit.</li>
            </ul>
            <p>Kolom: Judul/Penulis, Tahun, Jurnal/Penerbit, Aksi (12/halaman). Hapus bersifat permanen.</p>

            <h3 class="h6 fw-bold mt-3">Langkah menambah publikasi</h3>
            <ol class="guide-step">
                <li>Buka <strong>Publikasi</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Judul</strong> (wajib, maks 500) dan <strong>Penulis</strong> (wajib, maks 500 — urut sesuai publikasi asli).</li>
                <li>Isi <strong>Jenis</strong> (mis. “Artikel Jurnal”), <strong>Tanggal terbit</strong>, dan <strong>Tahun</strong> (kosongkan → diambil otomatis dari tahun tanggal terbit).</li>
                <li>Lengkapi <strong>Jurnal / penerbit</strong>, <strong>DOI / URL</strong>, dan <strong>Nama dosen terkait</strong> bila ada.</li>
                <li>Klik <strong>Simpan</strong>.</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Judul</td><td><span class="guide-req">Ya</span></td><td>Maks 500 karakter.</td></tr>
                    <tr><td class="guide-field-name">Penulis</td><td><span class="guide-req">Ya</span></td><td>Maks 500 karakter (boleh banyak penulis dipisah koma).</td></tr>
                    <tr><td class="guide-field-name">Jenis</td><td><span class="guide-opt">Opsional</span></td><td>Maks 50, mis. “Artikel Jurnal”, “Prosiding”.</td></tr>
                    <tr><td class="guide-field-name">Tanggal terbit</td><td><span class="guide-opt">Opsional</span></td><td>Tanggal rilis publikasi.</td></tr>
                    <tr><td class="guide-field-name">Tahun</td><td><span class="guide-opt">Opsional</span></td><td>Maks 10; jika kosong → diisi otomatis dari tahun tanggal terbit.</td></tr>
                    <tr><td class="guide-field-name">Jurnal / penerbit</td><td><span class="guide-opt">Opsional</span></td><td>Nama jurnal/penerbit, maks 255.</td></tr>
                    <tr><td class="guide-field-name">DOI / URL</td><td><span class="guide-opt">Opsional</span></td><td>Tautan DOI atau artikel, maks 500.</td></tr>
                    <tr><td class="guide-field-name">Nama dosen terkait</td><td><span class="guide-opt">Opsional</span></td><td>Menghubungkan publikasi dengan dosen PPAk, maks 255.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-tip small mb-0"><i class="fa-solid fa-lightbulb me-1"></i><strong>Tips:</strong> selalu isi <strong>Tahun</strong> agar publikasi bisa difilter tahunnya dengan benar di halaman publik.</div>
        </div>
    </div>
</section>

<section id="dokumen" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-file-pdf me-1"></i>Dokumen</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Dokumen &amp; Media <i class="fa-solid fa-angle-right"></i> Dokumen &nbsp;•&nbsp; URL: <code>/admin/documents</code></p>
            <p>Mengelola berkas unduhan yang tampil di <a class="guide-a" href="{{ url('/kontak/unduhan') }}" target="_blank" rel="noopener">/kontak/unduhan</a> (10/halaman + filter kategori), halaman <a class="guide-a" href="{{ url('/akademik/panduan') }}" target="_blank" rel="noopener">/akademik/panduan</a>, <a class="guide-a" href="{{ url('/profil/akreditasi') }}" target="_blank" rel="noopener">/profil/akreditasi</a>, dan sitemap.</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar dokumen</h3>
            <ul>
                <li><strong>Cari</strong> — nama dokumen.</li>
                <li><strong>Kategori</strong> — filter kategori dokumen.</li>
                <li><strong>Tahun</strong> — tahun dokumen.</li>
                <li><strong>Status</strong> — Draft / Terbit / Arsip.</li>
                <li><strong>Tampilkan arsip (soft delete)</strong>.</li>
            </ul>
            <p>Kolom: Dokumen, Kategori, Ukuran (KB), Status, Aksi (12/halaman).</p>

            <h3 class="h6 fw-bold mt-3">Langkah mengunggah dokumen</h3>
            <ol class="guide-step">
                <li>Buka <strong>Dokumen</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Nama dokumen</strong> (wajib; slug otomatis).</li>
                <li>Pilih kategori (opsional) dan tahun (default tahun berjalan).</li>
                <li>Unggah <strong>File</strong> — wajib saat membuat: PDF/DOC/DOCX/XLS/XLSX/PPT/PPTX/ZIP, maks 10 MB. <strong>File executable (PHP dll.) ditolak</strong>.</li>
                <li>Opsional: nama sumber/instansi dan URL sumber.</li>
                <li>Pilih <strong>Status</strong> (default Terbit) lalu <strong>Simpan</strong>.</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama dokumen</td><td><span class="guide-req">Ya</span></td><td>Maks 255; slug unik otomatis.</td></tr>
                    <tr><td class="guide-field-name">Kategori</td><td><span class="guide-opt">Opsional</span></td><td>Dari kategori bertipe <em>dokumen</em> (mis. “Pedoman Akademik”, “Kalender”).</td></tr>
                    <tr><td class="guide-field-name">Tahun</td><td><span class="guide-opt">Opsional</span></td><td>2000–2100 (default tahun berjalan).</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td>Draft / Terbit (default) / Arsip.</td></tr>
                    <tr><td class="guide-field-name">File</td><td><span class="guide-req">Ya (saat buat)</span></td><td>PDF/DOC/XLS/PPT/ZIP, maks 10 MB. Saat edit, nama file saat ini ditampilkan.</td></tr>
                    <tr><td class="guide-field-name">Nama sumber / instansi</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255.</td></tr>
                    <tr><td class="guide-field-name">URL sumber</td><td><span class="guide-opt">Opsional</span></td><td>Harus URL valid, maks 500.</td></tr>
                </tbody>
            </table>

            <div class="row g-2">
                <div class="col-md-6"><div class="alert guide-ok small mb-0"><strong><i class="fa-solid fa-circle-check me-1"></i>Aman:</strong> saat dokumen di-update dengan file baru, <strong>file lama tetap tersimpan</strong> sebagai arsip (tidak terhapus otomatis).</div></div>
                <div class="col-md-6"><div class="alert guide-info small mb-0"><strong><i class="fa-solid fa-circle-info me-1"></i>Info:</strong> unduhan publik dibatasi 60x/menit per pengunjung (anti-scraping). Status soft delete + restore tersedia seperti berita.</div></div>
            </div>
        </div>
    </div>
</section>
