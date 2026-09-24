{{-- ================= LAMPIRAN (semua role) ================= --}}

<section id="aturan" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-scale-balanced me-1"></i>Aturan &amp; Tips Penting</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="alert guide-ok mb-0">
                        <strong class="d-block mb-1"><i class="fa-solid fa-circle-check me-1"></i>YA — lakukan ini</strong>
                        <ul class="mb-0 small">
                            <li>Gunakan <strong>data resmi</strong> — jangan mengarang nama dosen, alumni, testimoni, atau angka. Bagian yang datanya belum ada biarkan kosong (website menampilkan status kosong profesional).</li>
                            <li>Cek <strong>Preview 🌐</strong> sebelum menerbitkan berita penting.</li>
                            <li>Untuk tahun akademik / periode baru, selalu <strong>tambah data baru</strong>, jangan menimpa arsip.</li>
                            <li>Unggah gambar ringan &amp; jelas (maks 5 MB; logo/mitra &amp; avatar maks 2 MB; dokumen maks 10 MB).</li>
                            <li>Gunakan kategori &amp; urutan tampil secara konsisten agar website rapi.</li>
                            <li>Setelah perubahan massal konten, Super Admin dapat <strong>Segarkan Cache</strong> di Kesehatan SEO.</li>
                            <li>Logout setelah selesai bekerja, terutama di komputer bersama.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert guide-warn mb-0">
                        <strong class="d-block mb-1"><i class="fa-solid fa-circle-xmark me-1"></i>JANGAN — hindari ini</strong>
                        <ul class="mb-0 small">
                            <li>Jangan menghapus kategori/file yang masih dipakai — sistem akan menolak dan memberi tahu lokasinya; tetapi jika memaksa lewat jalan lain, website bisa rusak.</li>
                            <li>Jangan menimpa nominal biaya/tahun akademik lama — buat record baru (data historis).</li>
                            <li>Jangan meninggalkan gelombang pendaftaran berstatus <strong>Aktif</strong> setelah tanggalnya lewat.</li>
                            <li>Jangan membuat testimoni/alumni fiktif.</li>
                            <li>Jangan membagikan akun admin — buat akun sendiri per pengelola.</li>
                            <li>Jangan mengunggah file executable (PHP dsb.) — otomatis ditolak sistem.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="alert guide-info small mt-3 mb-0">
                <i class="fa-solid fa-circle-info me-1"></i><strong>Pengingat teknis:</strong>
                <ul class="mb-0 mt-1">
                    <li>Field bertanda <span class="guide-req">*</span> wajib diisi; error validasi tampil di atas form tanpa menghapus isian Anda.</li>
                    <li>Slug dibuat otomatis dari judul/nama — hanya diubah manual bila perlu (huruf kecil, angka, tanda <code>-</code>, unik).</li>
                    <li>Modul dengan tombol “Tampilkan arsip”: data terhapus tidak hilang — pulihkan lewat tombol ↩️.</li>
                    <li>Perubahan konten otomatis mem-flush cache website dan tercatat di Audit Log (Super Admin).</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="tanya" class="guide-section mb-4" data-roles="operator super_admin">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fa-solid fa-comments me-1"></i>Tanya Jawab Singkat</span>
            <span class="badge guide-badge-both">Semua Role</span>
        </div>
        <div class="card-body">
            <div class="accordion" id="guideFaq">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">Menu yang saya butuhkan tidak ada di sidebar, kenapa?</button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#guideFaq">
                        <div class="accordion-body small">Kemungkinan Anda login dengan role <strong>Operator</strong> yang aksesnya dibatasi hanya modul konten. Menu sensitif (Pengaturan, Helpdesk, Kelola Admin, dll.) hanya untuk <strong>Super Admin</strong>. Role Anda terlihat di sidebar kiri bawah. Membuka URL-nya secara langsung pun akan menghasilkan halaman 403.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">Saya salah menghapus berita/dokumen, bagaimana memulihkannya?</button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#guideFaq">
                        <div class="accordion-body small">Buka modul tersebut, centang <strong>Tampilkan arsip (soft delete)</strong>, lalu klik tombol pulihkan <i class="fa-solid fa-rotate-left text-success"></i> pada baris yang dimaksud. Modul soft delete: Berita, Agenda, Galeri, Dokumen, Dosen.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">Berita sudah disimpan tapi tidak tampil di website?</button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#guideFaq">
                        <div class="accordion-body small">Periksa <strong>Status</strong> berita — hanya status <strong>Terbit</strong> yang tampil publik. Draft/Arsip tidak tampil; Terjadwal menunggu jadwal. Juga pastikan gambar utama terisi dan klik ikon 🌐 untuk melihat halaman publiknya.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">File/kategori tidak bisa dihapus, pesan “masih digunakan”?</button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#guideFaq">
                        <div class="accordion-body small">Itu perlindungan agar website tidak rusak. Pindahkan/diubah konten yang masih menunjuk kategori/file tersebut dulu (atau nonaktifkan kontennya), baru hapus kategori/filenya. Rincian pemakaian terlihat di kolom “Terpakai” (kategori) dan “Penggunaan” (Media Manager).</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">Bagaimana menambahkan pengguna/pengelola baru?</button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#guideFaq">
                        <div class="accordion-body small">Hanya <strong>Super Admin</strong>: menu <strong>Akun → Kelola Admin → Tambah</strong>, isi nama/email/password, pilih role Operator (konten) atau Super Admin (akses penuh), simpan. Berikan panduan modul yang sesuai role kepada pengguna baru.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">Lupa password atau akun terkunci?</button>
                    </h2>
                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#guideFaq">
                        <div class="accordion-body small">Gunakan tautan <strong>Lupa password?</strong> di halaman login (tautan dikirim ke email akun). Jika terkunci karena salah password 5x/menit, tunggu 1 menit lalu coba lagi. Jika akun dinonaktifkan, hubungi Super Admin Anda.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
