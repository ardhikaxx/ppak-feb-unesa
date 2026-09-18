<footer class="footer-ppak" aria-label="Informasi Footer Institusi">
    <div class="footer-top">
        <div class="container-xl">
            <div class="row g-4 g-lg-5">
                {{-- Column 1: Identity & About --}}
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo Resmi Universitas Negeri Surabaya" style="height: 48px; width: auto; max-width: 170px; object-fit: contain;" class="d-block mb-3">
                        <div class="fw-bold text-white fs-5 lh-sm" style="letter-spacing: -0.015em;">Pendidikan Profesi Akuntansi</div>
                        <div class="text-gold small fw-semibold">Fakultas Ekonomika dan Bisnis &bull; UNESA</div>
                    </div>
                    <p class="text-secondary small mb-4 pe-lg-3" style="line-height: 1.7;">
                        Program Pendidikan Profesi Akuntansi (PPAk) Fakultas Ekonomika dan Bisnis menyelenggarakan pendidikan keprofesian berstandar nasional dan global, berakar pada integritas, kepakaran teknis, dan etika profesi luhur.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="https://instagram.com/unesa_official" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Instagram Resmi">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://youtube.com/@unesaofficial" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="YouTube Resmi">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="https://facebook.com/unesa.surabaya" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Facebook Resmi">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://linkedin.com/school/universitas-negeri-surabaya" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="LinkedIn Resmi">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                {{-- Column 2: Navigasi Akademik & Profil --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <h3 class="footer-heading">Akademik & Profil</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('profil.sejarah') }}">Sejarah Program</a></li>
                        <li><a href="{{ route('profil.visi-misi') }}">Visi & Misi</a></li>
                        <li><a href="{{ route('profil.dosen-pengajar') }}">Dosen Pengajar</a></li>
                        <li><a href="{{ route('akademik.kurikulum') }}">Kurikulum SKS</a></li>
                        <li><a href="{{ route('akademik.kalender') }}">Kalender Akademik</a></li>
                        <li><a href="{{ route('akademik.gelar-sertifikasi') }}">Sertifikasi CA & CPA</a></li>
                    </ul>
                </div>

                {{-- Column 3: Admisi & Informasi --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <h3 class="footer-heading">Admisi & Publikasi</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('admisi.jalur-syarat') }}">Syarat Pendaftaran</a></li>
                        <li><a href="{{ route('admisi.biaya') }}">Biaya Perkuliahan</a></li>
                        <li><a href="{{ route('admisi.prosedur-jadwal') }}">Jadwal Seleksi</a></li>
                        <li><a href="{{ route('admisi.faq') }}">FAQ Pendaftaran</a></li>
                        <li><a href="{{ route('informasi.berita') }}">Berita & Artikel</a></li>
                        <li><a href="{{ route('kontak.unduhan') }}">Unduhan Dokumen</a></li>
                    </ul>
                </div>

                {{-- Column 4: Kontak Sekretariat --}}
                <div class="col-lg-4 col-md-6">
                    <h3 class="footer-heading">Sekretariat PPAk FEB UNESA</h3>
                    <ul class="list-unstyled small text-secondary mb-3">
                        <li class="d-flex align-items-start gap-3 mb-2">
                            <i class="fa-solid fa-location-dot mt-1 text-gold"></i>
                            <span>Gedung G6 FEB, Kampus Ketintang, Jl. Ketintang, Surabaya, Jawa Timur 60231</span>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-2">
                            <i class="fa-solid fa-envelope text-gold"></i>
                            <a href="mailto:ppak.feb@unesa.ac.id" class="text-secondary text-decoration-none hover-white">ppak.feb@unesa.ac.id</a>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-2">
                            <i class="fa-solid fa-phone text-gold"></i>
                            <span>+62 31 828 0009 / Ext. 312</span>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-2">
                            <i class="fa-brands fa-whatsapp text-success"></i>
                            <span>+62 812 3456 7890 (Helpdesk Mahasiswa)</span>
                        </li>
                    </ul>
                    <div class="p-3 mt-3 rounded-3" style="background-color: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.12);">
                        <div class="d-flex align-items-center gap-2 text-white small fw-bold mb-1">
                            <i class="fa-solid fa-clock text-gold"></i>
                            <span>Jam Operasional Layanan:</span>
                        </div>
                        <div class="text-white-50 small">Senin – Jumat: 08.00 – 16.00 WIB</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="footer-bottom">
        <div class="container-xl">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 text-center text-md-start">
                <div>
                    <span>&copy; {{ date('Y') }} <strong>Pendidikan Profesi Akuntansi (PPAk)</strong>. Fakultas Ekonomika dan Bisnis — Universitas Negeri Surabaya.</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge-ppak badge-ppak-navy" style="font-size: 0.725rem; text-transform: none;">
                        <i class="fa-solid fa-award text-warning"></i> Akreditasi Baik Sekali [LAMEMBA]
                    </span>
                    <a href="#top-infobar" class="text-secondary hover-white" aria-label="Kembali ke atas">
                        <i class="fa-solid fa-arrow-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
