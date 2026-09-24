{{-- ================= MODUL KHUSUS SUPER ADMIN ================= --}}

<section id="profil-program" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-building-columns me-1"></i>Profil Program</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Profil PPAk <i class="fa-solid fa-angle-right"></i> Profil Program &nbsp;•&nbsp; URL: <code>/admin/program-profile</code></p>
            <p>Halaman <strong>satu data (single record)</strong> berisi identitas resmi program studi yang dipakai di hampir seluruh halaman website (footer, kontak, media sosial). Hanya GET edit + PUT update — tidak ada daftar/tambah banyak.</p>

            <h3 class="h6 fw-bold mt-3">Bagian 1: Identitas Resmi</h3>
            <table class="table guide-table table-bordered mb-3">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Kode prodi</td><td><span class="guide-req">Ya</span></td><td>Maks 20 (mis. kode resmi 62902).</td></tr>
                    <tr><td class="guide-field-name">Nama resmi</td><td><span class="guide-req">Ya</span></td><td>Nama lengkap program (maks 255).</td></tr>
                    <tr><td class="guide-field-name">Nama singkat</td><td><span class="guide-opt">Opsional</span></td><td>Maks 50.</td></tr>
                    <tr><td class="guide-field-name">Jenjang</td><td><span class="guide-opt">Opsional</span></td><td>Mis. “Profesi”.</td></tr>
                    <tr><td class="guide-field-name">Fakultas / Universitas</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255 masing-masing.</td></tr>
                    <tr><td class="guide-field-name">Tanggal berdiri</td><td><span class="guide-opt">Opsional</span></td><td>Tanggal berdirinya program.</td></tr>
                    <tr><td class="guide-field-name">Koordinator prodi</td><td><span class="guide-opt">Opsional</span></td><td>Nama koordinator, maks 255.</td></tr>
                    <tr><td class="guide-field-name">Tagline</td><td><span class="guide-opt">Opsional</span></td><td>Maks 500 karakter.</td></tr>
                </tbody>
            </table>

            <h3 class="h6 fw-bold">Bagian 2: Kontak &amp; Layanan</h3>
            <table class="table guide-table table-bordered mb-3">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Alamat</td><td><span class="guide-opt">Opsional</span></td><td>Teks bebas (sanitasi HTML).</td></tr>
                    <tr><td class="guide-field-name">Email</td><td><span class="guide-opt">Opsional</span></td><td>Harus format email valid.</td></tr>
                    <tr><td class="guide-field-name">Telepon / WhatsApp</td><td><span class="guide-opt">Opsional</span></td><td>Maks 50 masing-masing.</td></tr>
                    <tr><td class="guide-field-name">Jam layanan</td><td><span class="guide-opt">Opsional</span></td><td>Mis. “Senin–Jumat 08.00–16.00 WIB”.</td></tr>
                </tbody>
            </table>

            <h3 class="h6 fw-bold">Bagian 3: Media Sosial</h3>
            <p>Enam URL resmi (semua <strong>opsional, harus diawali <code>https://</code></strong>): Instagram UNESA, Instagram FEB, YouTube, TikTok, Facebook, LinkedIn. Disimpan sebagai JSON dan ditampilkan pada ikon media sosial website.</p>

            <div class="alert guide-warn small mt-3 mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Penting:</strong> perubahan di sini langsung berlaku di seluruh website — periksa ejaan &amp; URL sebelum menyimpan. Isi dengan <strong>data resmi</strong>, jangan mengarang.</div>
        </div>
    </div>
</section>

<section id="akreditasi" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-award me-1"></i>Akreditasi</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Profil PPAk <i class="fa-solid fa-angle-right"></i> Akreditasi &nbsp;•&nbsp; URL: <code>/admin/accreditations</code></p>
            <p>Mengelola riwayat akreditasi program yang tampil di <a class="guide-a" href="{{ url('/profil/akreditasi') }}" target="_blank" rel="noopener">/profil/akreditasi</a> (akreditasi terbaru + daftar unduhan salinan SK).</p>

            <h3 class="h6 fw-bold mt-3">Daftar &amp; langkah</h3>
            <ul>
                <li>Tanpa filter; kolom: Program, Lembaga/Status, SK &amp; Masa Berlaku, Aksi (10/halaman).</li>
                <li>Klik <strong>Tambah</strong> → isi data SK → <strong>Simpan</strong>. Edit lewat ikon pensil.</li>
            </ul>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama program</td><td><span class="guide-req">Ya</span></td><td>Default “PPAk”; maks 255.</td></tr>
                    <tr><td class="guide-field-name">Lembaga</td><td><span class="guide-req">Ya</span></td><td>Maks 100 (mis. “LAMEMBA”).</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td>Teks bebas maks 50 (mis. “Baik”) — <strong>bukan dropdown</strong>, tulis persis sesuai SK.</td></tr>
                    <tr><td class="guide-field-name">Nomor SK</td><td><span class="guide-req">Ya</span></td><td>Nomor SK akreditasi.</td></tr>
                    <tr><td class="guide-field-name">Tanggal SK</td><td><span class="guide-opt">Opsional</span></td><td>Tanggal ditetapkan.</td></tr>
                    <tr><td class="guide-field-name">Berlaku dari / Berlaku sampai</td><td><span class="guide-opt">Opsional</span></td><td>Masa berlaku; “sampai” tidak boleh sebelum “dari”.</td></tr>
                    <tr><td class="guide-field-name">Salinan SK</td><td><span class="guide-opt">Opsional</span></td><td>File <strong>PDF</strong> maks 10 MB; disimpan ke <code>documents/accreditations</code> dan bisa diunduh pengunjung.</td></tr>
                    <tr><td class="guide-field-name">Nama sumber &amp; URL sumber</td><td><span class="guide-opt">Opsional</span></td><td>Referensi dokumen.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-warn small mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Perhatian:</strong> penghapusan <strong>permanen</strong> dan <strong>file salinan SK ikut terhapus</strong> — konfirmasi berbunyi “Hapus data akreditasi ini? Riwayat akreditasi akan hilang.” Simpan selalu salinan SK resmi terbaru.</div>
        </div>
    </div>
</section>

<section id="cpl" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-bullseye me-1"></i>CPL (Capaian Pembelajaran)</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Akademik <i class="fa-solid fa-angle-right"></i> CPL &nbsp;•&nbsp; URL: <code>/admin/learning-outcomes</code></p>
            <p>Mengelola butir CPL yang menjadi acuan <strong>pemetaan CPL</strong> pada form Kurikulum dan ditampilkan di <a class="guide-a" href="{{ url('/akademik/kurikulum') }}" target="_blank" rel="noopener">/akademik/kurikulum</a>.</p>

            <ul>
                <li>Tanpa filter; kolom: Kode, Judul, Kategori, Urutan, Aksi (15/halaman). Hapus permanen (konfirmasi “Hapus CPL-1?”).</li>
                <li><strong>Disarankan</strong>: buat seluruh butir CPL <em>sebelum</em> memetakan kurikulum, agar checkbox pemetaan di form kurikulum lengkap.</li>
            </ul>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Kode</td><td><span class="guide-req">Ya</span></td><td>Maks 20, <strong>unik</strong> (placeholder “CPL-1”).</td></tr>
                    <tr><td class="guide-field-name">Judul</td><td><span class="guide-opt">Opsional</span></td><td>Judul singkat butir, maks 255.</td></tr>
                    <tr><td class="guide-field-name">Urutan tampil</td><td><span class="guide-opt">Opsional</span></td><td>0 ke atas; angka kecil tampil lebih dulu.</td></tr>
                    <tr><td class="guide-field-name">Kategori</td><td><span class="guide-opt">Opsional</span></td><td>Maks 50 (mis. “Sikap &amp; Nilai”, “Pengetahuan”, “Keterampilan Umum”, “Keterampilan Khusus”).</td></tr>
                    <tr><td class="guide-field-name">Deskripsi</td><td><span class="guide-req">Ya</span></td><td>Teks lengkap capaian pembelajaran (sanitasi HTML).</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section id="kalender" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-calendar-days me-1"></i>Kalender Akademik</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Akademik <i class="fa-solid fa-angle-right"></i> Kalender Akademik &nbsp;•&nbsp; URL: <code>/admin/academic-calendars</code></p>
            <p>Mengelola kegiatan kalender per tahun akademik &amp; semester yang tampil di <a class="guide-a" href="{{ url('/akademik/kalender') }}" target="_blank" rel="noopener">/akademik/kalender</a> dan halaman prosedur admisi.</p>

            <h3 class="h6 fw-bold mt-3">Filter daftar kalender</h3>
            <ul>
                <li><strong>Tahun</strong> — tahun akademik (2026/2027).</li>
                <li><strong>Semester</strong> — Gasal / Genap.</li>
                <li><strong>Cari</strong> — nama kegiatan.</li>
            </ul>
            <p>Kolom: Tahun/Semester, Kegiatan, Tanggal, Kategori, Aksi (15/halaman).</p>

            <h3 class="h6 fw-bold mt-3">Langkah menambah kegiatan</h3>
            <ol class="guide-step">
                <li>Buka <strong>Kalender Akademik</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Tahun akademik</strong> format <code>2026/2027</code> dan pilih <strong>Semester</strong> (Gasal/Genap).</li>
                <li>Isi <strong>Nama kegiatan</strong> (wajib) dan <strong>Tanggal mulai</strong> (wajib); <strong>Tanggal selesai</strong> bila berjangka (≥ mulai).</li>
                <li>Isi kategori (default “Akademik”), urutan, dan <strong>Info SK penetapan</strong> bila ada (mis. nomor surat penetapan kalender).</li>
                <li>Opsional: <strong>Label periode semester</strong> (mis. “1 Agustus 2026 – 31 Januari 2027”); <strong>kosongkan agar dihitung otomatis</strong> dari tanggal.</li>
                <li>Klik <strong>Simpan</strong>.</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Tahun akademik</td><td><span class="guide-req">Ya</span></td><td>Format <code>2026/2027</code> (regex ketat).</td></tr>
                    <tr><td class="guide-field-name">Semester</td><td><span class="guide-req">Ya</span></td><td>Gasal / Genap (default Gasal).</td></tr>
                    <tr><td class="guide-field-name">Kategori</td><td><span class="guide-opt">Opsional</span></td><td>Maks 50 (default “Akademik”).</td></tr>
                    <tr><td class="guide-field-name">Urutan</td><td><span class="guide-opt">Opsional</span></td><td>Pengurutan dalam tampilan.</td></tr>
                    <tr><td class="guide-field-name">Nama kegiatan</td><td><span class="guide-req">Ya</span></td><td>Maks 255, mis. “Awal Perkuliahan Gasal”.</td></tr>
                    <tr><td class="guide-field-name">Label periode semester</td><td><span class="guide-opt">Opsional</span></td><td>Maks 100; kosongkan = dihitung otomatis dari tanggal.</td></tr>
                    <tr><td class="guide-field-name">Tanggal mulai / selesai</td><td><span class="guide-req">Ya / Opsional</span></td><td>Mulai wajib; selesai ≥ mulai.</td></tr>
                    <tr><td class="guide-field-name">Info SK penetapan</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255 (mis. “Surat Nomor B/2322/UN38.I/TU.00.02/2026”).</td></tr>
                </tbody>
            </table>

            <div class="alert guide-warn small mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Aturan tahun baru:</strong> memasuki tahun akademik baru, selalu <strong>tambah baris baru</strong> — jangan menimpa data tahun lama (data lama tetap sebagai arsip referensi).</div>
        </div>
    </div>
</section>

<section id="riset" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-flask me-1"></i>Riset</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Riset &amp; Pengabdian <i class="fa-solid fa-angle-right"></i> Riset &nbsp;•&nbsp; URL: <code>/admin/researches</code></p>
            <p>Mengelola daftar penelitian yang tampil di <a class="guide-a" href="{{ url('/riset-pengabdian/riset-publikasi') }}" target="_blank" rel="noopener">/riset-pengabdian/riset-publikasi</a> — <strong>hanya yang berstatus Terbit</strong> yang tampil.</p>

            <ul>
                <li>Filter: <strong>Cari</strong> (judul) &amp; <strong>Status</strong>. Kolom: Judul, Ketua/Skema, Tahun, Status, Aksi (12/halaman). Hapus permanen.</li>
            </ul>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Judul riset</td><td><span class="guide-req">Ya</span></td><td>Maks 500.</td></tr>
                    <tr><td class="guide-field-name">Ketua peneliti</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255.</td></tr>
                    <tr><td class="guide-field-name">Skema</td><td><span class="guide-opt">Opsional</span></td><td>Mis. “PDUPT”, “Penelitian Dosen”, “Hibah Internal”.</td></tr>
                    <tr><td class="guide-field-name">Tahun</td><td><span class="guide-opt">Opsional</span></td><td>2000–2100.</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td>Draft / Tidak terbit / Terbit (default Draft).</td></tr>
                    <tr><td class="guide-field-name">Deskripsi</td><td><span class="guide-opt">Opsional</span></td><td>Abstrak/ringkasan (sanitasi HTML).</td></tr>
                </tbody>
            </table>

            <div class="alert guide-tip small mb-0"><i class="fa-solid fa-lightbulb me-1"></i><strong>Tips:</strong> ubah status Draft → Terbit hanya setelah data diverifikasi; riset berstatus “Tidak terbit” tersimpan sebagai konsep yang tidak tampil publik.</div>
        </div>
    </div>
</section>

<section id="pengabdian" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-hand-holding-heart me-1"></i>Pengabdian (PKM)</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Riset &amp; Pengabdian <i class="fa-solid fa-angle-right"></i> Pengabdian (PKM) &nbsp;•&nbsp; URL: <code>/admin/community-services</code></p>
            <p>Mengelola kegiatan pengabdian kepada masyarakat yang tampil di <a class="guide-a" href="{{ url('/riset-pengabdian/pengabdian') }}" target="_blank" rel="noopener">/riset-pengabdian/pengabdian</a> (hanya status Terbit).</p>

            <ul>
                <li>Daftar tanpa filter UI (12/halaman): Kegiatan, Ketua/Lokasi, Tahun, Status, Aksi. Hapus permanen.</li>
            </ul>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Judul kegiatan</td><td><span class="guide-req">Ya</span></td><td>Maks 500.</td></tr>
                    <tr><td class="guide-field-name">Ketua pelaksana</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255.</td></tr>
                    <tr><td class="guide-field-name">Lokasi</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255.</td></tr>
                    <tr><td class="guide-field-name">Tahun</td><td><span class="guide-opt">Opsional</span></td><td>2000–2100.</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td>Draft / Tidak terbit / Terbit (default Draft).</td></tr>
                    <tr><td class="guide-field-name">Sasaran / audiens</td><td><span class="guide-opt">Opsional</span></td><td>Mis. “UMKM Gunung Anyar”, maks 255.</td></tr>
                    <tr><td class="guide-field-name">Deskripsi</td><td><span class="guide-opt">Opsional</span></td><td>Uraian kegiatan (sanitasi HTML).</td></tr>
                </tbody>
            </table>

            <div class="alert guide-info small mb-0"><i class="fa-solid fa-circle-info me-1"></i>Catatan pada halaman daftar: “Hanya yang berstatus published yang tampil di website.”</div>
        </div>
    </div>
</section>

<section id="kerja-sama" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-handshake me-1"></i>Kerja Sama (Mitra)</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Riset &amp; Pengabdian <i class="fa-solid fa-angle-right"></i> Kerja Sama &nbsp;•&nbsp; URL: <code>/admin/partnerships</code></p>
            <p>Mengelola mitra/kerja sama yang tampil pada strip mitra beranda dan <a class="guide-a" href="{{ url('/riset-pengabdian/kerja-sama') }}" target="_blank" rel="noopener">/riset-pengabdian/kerja-sama</a> (hanya status <strong>Aktif</strong>).</p>

            <ul>
                <li>Filter: <strong>Cari</strong> (nama mitra) &amp; <strong>Status</strong>. Kolom: Mitra, Kategori/Jenis, Masa Berlaku, Status, Aksi (12/halaman).</li>
            </ul>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama mitra</td><td><span class="guide-req">Ya</span></td><td>Maks 255 (nama instansi resmi).</td></tr>
                    <tr><td class="guide-field-name">Kategori</td><td><span class="guide-opt">Opsional</span></td><td>Maks 50 (mis. “KAP”, “Korporasi”, “Asosiasi Profesi”).</td></tr>
                    <tr><td class="guide-field-name">Jenis kerja sama</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255 (mis. “MoU”, “MoA”, “Magang”).</td></tr>
                    <tr><td class="guide-field-name">Berlaku dari / sampai</td><td><span class="guide-opt">Opsional</span></td><td>Masa berlaku; “sampai” ≥ “dari”.</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td>Draft / Tidak tampil / <strong>Aktif (tampil)</strong> / Arsip (default Draft).</td></tr>
                    <tr><td class="guide-field-name">Logo</td><td><span class="guide-opt">Opsional</span></td><td>JPG/PNG/WebP, <strong>maks 2 MB</strong> (lebih kecil dari gambar lain).</td></tr>
                </tbody>
            </table>

            <div class="alert guide-warn small mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Perhatian:</strong> penghapusan <strong>permanen</strong> dan <strong>file logo ikut terhapus</strong>. Pastikan kerja sama sudah tidak berlaku sebelum dihapus dari daftar.</div>
        </div>
    </div>
</section>

<section id="testimoni" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-quote-left me-1"></i>Testimoni</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Kemahasiswaan &amp; Alumni <i class="fa-solid fa-angle-right"></i> Testimoni &nbsp;•&nbsp; URL: <code>/admin/testimonials</code></p>
            <p>Mengelola testimoni alumni/karier yang tampil di beranda dan <a class="guide-a" href="{{ url('/kemahasiswaan-alumni/testimoni-karier') }}" target="_blank" rel="noopener">/kemahasiswaan-alumni/testimoni-karier</a> (hanya Terbit, urut kolom Urutan).</p>

            <div class="alert guide-warn small"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Peringatan di form:</strong> “Hanya cantumkan testimoni resmi yang terverifikasi dan disetujui alumni bersangkutan.” Empty state daftar juga menegaskan: <em>“Jangan membuat testimoni fiktif.”</em></div>

            <ul>
                <li>Daftar tanpa filter UI (12/halaman): Nama, Isi, Status, Urutan, Aksi.</li>
            </ul>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama</td><td><span class="guide-req">Ya</span></td><td>Maks 255 (nama asli pemberi testimoni).</td></tr>
                    <tr><td class="guide-field-name">Peran / angkatan</td><td><span class="guide-opt">Opsional</span></td><td>Mis. “Alumni 2019”, maks 255.</td></tr>
                    <tr><td class="guide-field-name">Instansi / perusahaan</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255.</td></tr>
                    <tr><td class="guide-field-name">Tahun</td><td><span class="guide-opt">Opsional</span></td><td>Maks 10.</td></tr>
                    <tr><td class="guide-field-name">Urutan</td><td><span class="guide-opt">Opsional</span></td><td>Pengurutan tampilan (default 0).</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td>Draft / Tidak terbit / Terbit (default Draft).</td></tr>
                    <tr><td class="guide-field-name">Isi testimoni</td><td><span class="guide-req">Ya</span></td><td>Min. 10 karakter.</td></tr>
                    <tr><td class="guide-field-name">Foto</td><td><span class="guide-opt">Opsional</span></td><td>JPG/PNG/WebP, maks 2 MB.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-info small mb-0"><i class="fa-solid fa-circle-info me-1"></i><strong>Catatan:</strong> modul ini belum menyediakan tombol pemulihan (restore) di UI — setelah dihapus, data tidak bisa dipulihkan lewat CMS. Pastikan sudah yakin sebelum menghapus.</div>
        </div>
    </div>
</section>

<section id="alumni" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-user-graduate me-1"></i>Alumni</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Kemahasiswaan &amp; Alumni <i class="fa-solid fa-angle-right"></i> Alumni &nbsp;•&nbsp; URL: <code>/admin/alumni</code></p>
            <p>Mengelola data alumni yang tampil di <a class="guide-a" href="{{ url('/kemahasiswaan-alumni/alumni') }}" target="_blank" rel="noopener">/kemahasiswaan-alumni/alumni</a> (hanya status Terbit).</p>

            <div class="alert guide-warn small"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Peringatan di form:</strong> “Gunakan data resmi. Jangan membuat nama, jabatan, atau perusahaan fiktif.”</div>

            <ul>
                <li>Daftar tanpa filter UI (12/halaman): Nama, Lulus, Instansi/Jabatan, Status, Aksi. Hapus permanen.</li>
            </ul>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama lengkap</td><td><span class="guide-req">Ya</span></td><td>Data resmi alumni; wajib diisi benar.</td></tr>
                    <tr><td class="guide-field-name">Tahun lulus</td><td><span class="guide-opt">Opsional</span></td><td>Maks 10 (mis. “2021”).</td></tr>
                    <tr><td class="guide-field-name">Status</td><td><span class="guide-req">Ya</span></td><td>Draft / Tidak terbit / Terbit (default Draft).</td></tr>
                    <tr><td class="guide-field-name">Instansi / perusahaan</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255.</td></tr>
                    <tr><td class="guide-field-name">Jabatan</td><td><span class="guide-opt">Opsional</span></td><td>Maks 255 (mis. “Auditor”).</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section id="kategori" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-tags me-1"></i>Kategori</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Dokumen &amp; Media <i class="fa-solid fa-angle-right"></i> Kategori &nbsp;•&nbsp; URL: <code>/admin/categories</code></p>
            <p>Mengelola kategori yang menjadi dropdown pada form <strong>Berita, Agenda, Galeri, dan Dokumen</strong>. Setiap kategori memiliki <strong>tipe</strong> sehingga hanya muncul pada modul yang sesuai.</p>

            <ul>
                <li>Daftar menampilkan seluruh kategori: Nama, Tipe, Terpakai (jumlah konten memakainya), Urutan (15/halaman).</li>
                <li>Hapus <strong>diblokir</strong> bila masih dipakai: “Kategori masih digunakan oleh {n} konten. Pindahkan konten ke kategori lain terlebih dahulu.”</li>
            </ul>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Field</th><th>Wajib</th><th>Penjelasan &amp; aturan</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama kategori</td><td><span class="guide-req">Ya</span></td><td>Nama tampil, maks 255.</td></tr>
                    <tr><td class="guide-field-name">Slug</td><td><span class="guide-req">Ya</span></td><td>Otomatis dari nama; unik; huruf kecil/angka/<code>-</code>.</td></tr>
                    <tr><td class="guide-field-name">Tipe</td><td><span class="guide-req">Ya</span></td><td><strong>berita</strong> / <strong>agenda</strong> / <strong>dokumen</strong> / <strong>galeri</strong> (default berita) — menentukan modul mana yang melihat kategori ini.</td></tr>
                    <tr><td class="guide-field-name">Warna (badge)</td><td><span class="guide-opt">Opsional</span></td><td>Kode heks warna badge, mis. <code>#0d6efd</code>, maks 20.</td></tr>
                    <tr><td class="guide-field-name">Urutan</td><td><span class="guide-opt">Opsional</span></td><td>Pengurutan dalam dropdown/tampilan.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-tip small mb-0"><i class="fa-solid fa-lightbulb me-1"></i><strong>Urutan kerja yang benar:</strong> buat kategori dulu di sini → baru kategorikan berita/agenda/galeri/dokumen. Bila ingin menghapus kategori terpakai, pindahkan kontennya ke kategori lain terlebih dahulu.</div>
        </div>
    </div>
</section>

<section id="media" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-folder-open me-1"></i>Media Manager</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Dokumen &amp; Media <i class="fa-solid fa-angle-right"></i> Media Manager &nbsp;•&nbsp; URL: <code>/admin/media</code></p>
            <p>Gudang file: melihat <strong>semua file upload</strong> (di <code>storage/uploads</code>) beserta tipe, ukuran, dan <strong>di mana file itu dipakai</strong>. Halaman ini <strong>hanya daftar + hapus</strong> — <strong>tidak ada form upload</strong>; upload dilakukan lewat modul Berita, Dosen, Galeri, Dokumen, dll.</p>

            <h3 class="h6 fw-bold mt-3">Kolom &amp; filter</h3>
            <table class="table guide-table table-bordered mb-2">
                <thead><tr><th>Kolom</th><th>Isi</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Pratinjau</td><td>Thumbnail file (atau ikon untuk non-gambar).</td></tr>
                    <tr><td class="guide-field-name">File</td><td>Nama file &amp; path.</td></tr>
                    <tr><td class="guide-field-name">Tipe / Ukuran</td><td>Jenis MIME dan ukuran file.</td></tr>
                    <tr><td class="guide-field-name">Penggunaan</td><td>Badge per konten: “Berita (n)”, “Dosen (n)”, “Galeri (n)”, “Dokumen (n)”, “Testimoni (n)”, “Mitra (n)”; atau hijau “Tidak dipakai”.</td></tr>
                    <tr><td class="guide-field-name">Aksi</td><td>Tombol hapus — <strong>hanya muncul bila file tidak dipakai konten mana pun</strong>.</td></tr>
                </tbody>
            </table>
            <ul>
                <li>Filter: <strong>Cari nama file…</strong> (tanpa paginasi; diurutkan terbaru).</li>
                <li>File masih dipakai → sistem menolak: “File masih digunakan oleh: … Hapus/nonaktifkan konten tersebut terlebih dahulu.”</li>
                <li>File tidak terpakai → konfirmasi “Hapus file {nama} secara permanen?” (aksi tercatat di Audit Log).</li>
                <li>Belum ada file → “Upload melalui modul Berita, Dosen, Galeri, atau Dokumen.”</li>
            </ul>

            <div class="alert guide-warn small mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Hati-hati:</strong> penghapusan file di sini <strong>permanen</strong> (bisa merusak tampilan konten yang menyimpan path file). Selalu cek badge “Penggunaan” terlebih dahulu.</div>
        </div>
    </div>
</section>

<section id="seo" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-gauge-high me-1"></i>Kesehatan SEO</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Website <i class="fa-solid fa-angle-right"></i> Kesehatan SEO &nbsp;•&nbsp; URL: <code>/admin/seo-health</code></p>
            <p>Dasbor <strong>baca-saja</strong> (read-only) untuk memantau kesehatan Technical SEO website, plus <strong>satu aksi</strong>: menyegarkan cache.</p>

            <h3 class="h6 fw-bold mt-3">Isi halaman</h3>
            <table class="table guide-table table-bordered mb-2">
                <thead><tr><th>Bagian</th><th>Isi</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">4 kartu statistik</td><td>Rute Publik Terindeks (jumlah rute + % HTTP 200), Berita Terbit (SEO) — termasuk jumlah noindex &amp; berita tanpa gambar, Dokumen Publik di Sitemap, Default OG Image (cek ketersediaan + dimensi 1200×630).</td></tr>
                    <tr><td class="guide-field-name">Tautan cepat</td><td>Tab baru ke <strong>Sitemap XML</strong>, <strong>Sitemap News</strong>, dan <strong>robots.txt</strong>.</td></tr>
                    <tr><td class="guide-field-name">Audit Fondasi Technical SEO</td><td>Pengecekan bahasa (id), canonical, robots.txt, sitemap, H1 tunggal, dan gambar SEO.</td></tr>
                    <tr><td class="guide-field-name">Structured Data</td><td>Schema.org JSON-LD aktif: EducationalOrganization, WebSite, BreadcrumbList, NewsArticle, Event, Person.</td></tr>
                    <tr><td class="guide-field-name">Matriks Rute &amp; Keyword</td><td>Tabel: Halaman/Entitas, Canonical URL, Search Intent Utama, Indexing Status.</td></tr>
                    <tr><td class="guide-field-name">Checklist Production</td><td>Langkah deployment &amp; pemasangan di Google Search Console.</td></tr>
                </tbody>
            </table>

            <h3 class="h6 fw-bold">Aksi: Segarkan Cache</h3>
            <ol class="guide-step">
                <li>Klik tombol <strong>Segarkan Cache</strong>.</li>
                <li>Sistem mem-flush sitemap &amp; content cache (prefix <code>ppak</code>) — perubahan konten langsung tercermin di sitemap.</li>
                <li>Aksi tercatat di Audit Log sebagai <code>cache_cleared</code>.</li>
            </ol>

            <div class="alert guide-info small mb-0"><i class="fa-solid fa-circle-info me-1"></i>Gunakan “Segarkan Cache” setelah perubahan massal konten (mis. menerbitkan banyak berita) agar sitemap segera diperbarui.</div>
        </div>
    </div>
</section>

<section id="pengaturan" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-gear me-1"></i>Pengaturan Website</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Website <i class="fa-solid fa-angle-right"></i> Pengaturan Website &nbsp;•&nbsp; URL: <code>/admin/site-settings</code></p>
            <p>Satu-satunya tempat untuk <strong>data global</strong> website. Semua perubahan <strong>langsung berlaku di seluruh halaman</strong> dan content cache otomatis di-flush. Bentuk: satu form besar (PUT) yang dibagi per grup.</p>

            <h3 class="h6 fw-bold mt-3">Grup Umum (nama &amp; footer)</h3>
            <table class="table guide-table table-bordered mb-3">
                <thead><tr><th>Label (key)</th><th>Tipe</th><th>Contoh default</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Nama website (site_name)</td><td>Teks</td><td><code>PPAk FEB UNESA</code></td></tr>
                    <tr><td class="guide-field-name">Nama resmi program (program_name)</td><td>Teks</td><td>—</td></tr>
                    <tr><td class="guide-field-name">Kode program (program_code)</td><td>Teks</td><td><code>62902</code></td></tr>
                    <tr><td class="guide-field-name">Fakultas (faculty)</td><td>Teks</td><td>—</td></tr>
                    <tr><td class="guide-field-name">Universitas (university)</td><td>Teks</td><td>—</td></tr>
                    <tr><td class="guide-field-name">Tagline (tagline)</td><td>Textarea</td><td>—</td></tr>
                    <tr><td class="guide-field-name">Teks footer (footer_text)</td><td>Textarea</td><td>—</td></tr>
                    <tr><td class="guide-field-name">Copyright (copyright)</td><td>Teks</td><td><code>© 2026 PPAk FEB UNESA. Hak cipta dilindungi.</code></td></tr>
                </tbody>
            </table>

            <h3 class="h6 fw-bold">Grup Kontak &amp; Layanan</h3>
            <p>Alamat (textarea), Email (wajib format email), Telepon, WhatsApp, Jam layanan, Link Google Maps (wajib URL valid). <strong>Kontak ini tampil di topbar, footer, halaman biaya &amp; lokasi.</strong></p>

            <h3 class="h6 fw-bold">Grup Media Sosial</h3>
            <p>6 URL (semua wajib URL valid bila diisi, diawali <code>https://</code>): Instagram UNESA, Instagram FEB, YouTube, TikTok, Facebook, LinkedIn.</p>

            <h3 class="h6 fw-bold">Grup SEO &amp; Metadata</h3>
            <p><strong>Site title</strong> (judul tab browser) dan <strong>Meta description</strong> (deskripsi hasil pencarian/pratinjau tautan). Gambar OG institusional disediakan sistem (tidak diedit di sini).</p>

            <h3 class="h6 fw-bold">Grup Tautan Admisi</h3>
            <p><strong>Portal PMB</strong> (default <code>https://pmb.unesa.ac.id</code>) dan <strong>Portal Admisi</strong> (default <code>https://admisi.unesa.ac.id</code>) — dipakai tombol pendaftaran di website.</p>

            <h3 class="h6 fw-bold">Langkah menyimpan</h3>
            <ol class="guide-step">
                <li>Buka <strong>Pengaturan Website</strong>.</li>
                <li>Ubah hanya field yang perlu (field kosong yang tidak diisi tidak merusak data lain).</li>
                <li>Klik <strong>Simpan</strong> → notifikasi “Pengaturan website berhasil disimpan dan langsung berlaku.”</li>
                <li>Opsional: buka halaman publik untuk memverifikasi (footer/topbar/SEO).</li>
            </ol>

            <div class="row g-2">
                <div class="col-md-6"><div class="alert guide-warn small mb-0"><strong><i class="fa-solid fa-triangle-exclamation me-1"></i>Validasi:</strong> URL harus lengkap <code>https://…</code> dan email harus valid — pesan error muncul per field, isian tidak hilang.</div></div>
                <div class="col-md-6"><div class="alert guide-info small mb-0"><strong><i class="fa-solid fa-circle-info me-1"></i>Audit:</strong> penyimpanan tercatat sebagai update massal di Audit Log dan langsung membersihkan cache konten.</div></div>
            </div>
        </div>
    </div>
</section>

<section id="helpdesk" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-headset me-1"></i>Helpdesk</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Website <i class="fa-solid fa-angle-right"></i> Helpdesk &nbsp;•&nbsp; URL: <code>/admin/helpdesk</code></p>
            <p>Kotak masuk pesan dari form publik <a class="guide-a" href="{{ url('/kontak/helpdesk') }}" target="_blank" rel="noopener">/kontak/helpdesk</a> (pengunjung mengirim pesan, status awal <strong>Terbuka</strong>, IP tercatat, maks 10 kiriman/menit). Anda <strong>tidak membuat tiket</strong> di sini — hanya membaca &amp; mengubah status.</p>

            <div class="alert guide-info small"><i class="fa-solid fa-circle-info me-1"></i><strong>Badge merah</strong> di menu sidebar Helpdesk menunjukkan jumlah tiket berstatus <strong>Terbuka</strong> — tanda ada pesan yang belum ditangani.</div>

            <h3 class="h6 fw-bold mt-3">Filter daftar tiket</h3>
            <ul>
                <li><strong>Cari</strong> — nama / subjek / email pengirim.</li>
                <li><strong>Status</strong> — Terbuka / Diproses / Selesai.</li>
            </ul>
            <p>Kolom: Pengirim, Subjek, Masuk, Status, Aksi (lihat 👁) — 15/halaman. Badge warna: merah = Terbuka, kuning = Diproses, hijau = Selesai.</p>

            <h3 class="h6 fw-bold">Langkah menindaklanjuti tiket</h3>
            <ol class="guide-step">
                <li>Buka <strong>Helpdesk</strong>, gunakan filter/cari untuk menemukan tiket.</li>
                <li>Klik ikon <strong>Detail (mata)</strong> untuk membuka halaman tiket.</li>
                <li>Baca data lengkap: badge status, subjek, nama, email/telepon, kategori, waktu masuk + IP, dan isi pesan.</li>
                <li>Setelah ditindaklanjuti (mis. dibalas via email/telepon), ubah <strong>Ubah status</strong>: Terbuka → Diproses → Selesai.</li>
                <li>Klik <strong>Simpan</strong> → notifikasi “Status tiket diperbarui.” (aksi tercatat di Audit Log).</li>
            </ol>

            <table class="table guide-table table-bordered">
                <thead><tr><th>Status</th><th>Makna</th></tr></thead>
                <tbody>
                    <tr><td><span class="badge text-bg-danger">open / Terbuka</span></td><td>Belum ditangani — muncul sebagai hitungan badge sidebar.</td></tr>
                    <tr><td><span class="badge text-bg-warning">in_progress / Diproses</span></td><td>Sedang dikerjakan/ditindaklanjuti.</td></tr>
                    <tr><td><span class="badge text-bg-success">closed / Selesai</span></td><td>Selesai ditangani; tidak lagi dihitung terbuka.</td></tr>
        </tbody>
            </table>

            <div class="alert guide-tip small mb-0"><i class="fa-solid fa-lightbulb me-1"></i><strong>Alur kerja disarankan:</strong> cek badge merah sidebar setiap hari → buka detail → tangani → ubah status ke Diproses (saat sedang dikerjakan) → Selesai (setelah beres).</div>
        </div>
    </div>
</section>

<section id="audit-log" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-clock-rotate-left me-1"></i>Audit Log</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Website <i class="fa-solid fa-angle-right"></i> Audit Log &nbsp;•&nbsp; URL: <code>/admin/audit-logs</code></p>
            <p>Riwayat <strong>hanya-baca</strong> (read-only): siapa mengubah apa, kapan, dan dari IP mana. Tidak ada tombol tambah/ubah/hapus — log ditulis otomatis oleh sistem untuk setiap aksi konten (created, updated, deleted, restored, cache_cleared).</p>

            <h3 class="h6 fw-bold mt-3">Filter</h3>
            <ul>
                <li><strong>Cari</strong> — mencocok jenis data (entitas) atau alamat IP.</li>
                <li><strong>Aksi</strong> — created / updated / deleted / restored / cache_cleared (opsi muncul otomatis dari data).</li>
            </ul>

            <h3 class="h6 fw-bold">Kolom &amp; melihat detail perubahan</h3>
            <ol class="guide-step">
                <li>Kolom: Waktu, Admin, Aksi, Entitas, IP (20/halaman).</li>
                <li>Klik tombol <strong>diff</strong> (ikon perbandingan) pada baris untuk membuka modal <strong>“Field / Sebelum / Sesudah”</strong>.</li>
                <li>Baris yang berubah tersorot: nilai lama dicoret merah, nilai baru tebal hijau — memudahkan melacak perubahan bermasalah.</li>
            </ol>

            <div class="row g-2">
                <div class="col-md-6"><div class="alert guide-ok small mb-0"><strong><i class="fa-solid fa-shield-halved me-1"></i>Privasi:</strong> password tidak pernah dicatat; key internal (diawali <code>_</code>) disaring dari tampilan diff.</div></div>
                <div class="col-md-6"><div class="alert guide-info small mb-0"><strong><i class="fa-solid fa-circle-info me-1"></i>Penggunaan:</strong> audit log adalah alat utama bila ada kebingungan “siapa yang mengubah data X kapan”.</div></div>
            </div>
        </div>
    </div>
</section>

<section id="kelola-admin" class="guide-section mb-4" data-roles="super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-users-gear me-1"></i>Kelola Admin</span>
            <span class="badge guide-badge-sa">Super Admin</span>
        </div>
        <div class="card-body">
            <p class="guide-menu-path mb-2">Menu: <i class="fa-solid fa-angle-right"></i> Akun <i class="fa-solid fa-angle-right"></i> Kelola Admin &nbsp;•&nbsp; URL: <code>/admin/admins</code></p>
            <p>Mengelola akun login CMS: menambah admin, mengatur role, mengaktifkan/menonaktifkan, dan menghapus akun (kecuali dengan perlindungan diri sendiri — lihat di bawah).</p>

            <h3 class="h6 fw-bold mt-3">Daftar akun</h3>
            <ul>
                <li>Kolom: Nama (+ badge <strong>“Anda”</strong> pada akun sendiri), Email, Role, Status, Login Terakhir, Aksi (12/halaman).</li>
            </ul>

            <h3 class="h6 fw-bold">Langkah menambah admin</h3>
            <ol class="guide-step">
                <li>Buka <strong>Kelola Admin</strong> → <strong>Tambah</strong>.</li>
                <li>Isi <strong>Nama</strong> dan <strong>Email</strong> (harus unik).</li>
                <li>Isi <strong>Password</strong> (min. 8 karakter) dan ulangi pada kolom konfirmasi.</li>
                <li>Pilih <strong>Role</strong>:
                    <ul class="mt-1">
                        <li><span class="badge text-bg-secondary">Operator — konten</span> (berita, agenda, galeri, dokumen, FAQ, publikasi, kurikulum, dosen, admisi).</li>
                        <li><span class="badge text-bg-warning">Super Admin — akses penuh CMS</span>.</li>
                    </ul>
                </li>
                <li>Centang <strong>Akun aktif (dapat login CMS)</strong> (default aktif) → <strong>Simpan</strong>.</li>
            </ol>

            <h3 class="h6 fw-bold">Aturan &amp; perlindungan (ditegakkan server)</h3>
            <table class="table guide-table table-bordered">
                <thead><tr><th>Situasi</th><th>Hasil</th></tr></thead>
                <tbody>
                    <tr><td class="guide-field-name">Mengubah role akun sendiri</td><td>Ditolak — “Anda tidak dapat mengubah role akun sendiri.”</td></tr>
                    <tr><td class="guide-field-name">Menonaktifkan akun sendiri</td><td>Ditolak — “Anda tidak dapat menonaktifkan akun sendiri.”</td></tr>
                    <tr><td class="guide-field-name">Menghapus akun sendiri</td><td>Ditolak — “Anda tidak dapat menghapus akun sendiri.”</td></tr>
                    <tr><td class="guide-field-name">Menurunkan/nonaktifkan/menghapus <strong>satu-satunya</strong> Super Admin</td><td>Ditolak — “Tidak dapat menurunkan/menonaktifkan/menghapus satu-satunya super admin.”</td></tr>
                    <tr><td class="guide-field-name">Menghapus admin aktif terakhir</td><td>Ditolak — “Tidak dapat menghapus satu-satunya admin aktif.”</td></tr>
                    <tr><td class="guide-field-name">Password saat edit</td><td>Opsional (dikosongkan = password tidak berubah); bila diisi, min. 8 karakter + konfirmasi.</td></tr>
                </tbody>
            </table>

            <div class="alert guide-warn small mb-0"><i class="fa-solid fa-triangle-exclamation me-1"></i><strong>Catatan:</strong> menonaktifkan akun (uncheck “Akun aktif”) membuat pengguna langsung ter-logout saat berikutnya mengakses CMS. Beri tahu pengguna terkait sebelum menonaktifkan. Jangan membagikan satu akun untuk banyak orang — buat akun per pengelola agar jejak Audit Log akurat.</div>
        </div>
    </div>
</section>
