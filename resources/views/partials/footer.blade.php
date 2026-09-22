<footer class="footer-ppak" aria-label="Informasi Footer Institusi">
    <div class="footer-top">
        <div class="container-xl">
            <div class="row g-4 g-lg-5">
                {{-- Column 1: Identity & About --}}
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo Resmi Universitas Negeri Surabaya" width="170" height="48" loading="lazy" style="height: 48px; width: auto; max-width: 170px; object-fit: contain;" class="d-block mb-3">
                        <div class="fw-bold text-white fs-5 lh-sm" style="letter-spacing: -0.015em;">Pendidikan Profesi Akuntan</div>
                        <div class="text-gold small fw-semibold">Fakultas Ekonomika dan Bisnis &bull; UNESA (Kode: {{ $ppakInstitution['program_code'] ?? '62902' }})</div>
                    </div>
                    <p class="text-secondary small mb-4 pe-lg-3" style="line-height: 1.7;">
                        Program Studi Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis menyelenggarakan pendidikan keprofesian berstandar mutu tinggi, berakar pada integritas, kepakaran teknis, dan etika profesi luhur.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ $ppakInstitution['socials']['instagram'] ?? 'https://www.instagram.com/official_unesa' }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Instagram Resmi UNESA" title="Instagram Resmi UNESA (@official_unesa)">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="{{ $ppakInstitution['socials']['instagram_feb'] ?? 'https://www.instagram.com/feb.unesa' }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Instagram FEB UNESA" title="Instagram FEB UNESA (@feb.unesa)">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </a>
                        <a href="{{ $ppakInstitution['socials']['youtube'] ?? 'https://www.youtube.com/@officialunesa' }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="YouTube Resmi UNESA" title="YouTube Resmi UNESA (@officialunesa)">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="{{ $ppakInstitution['socials']['tiktok'] ?? 'https://www.tiktok.com/@unesaid' }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="TikTok Resmi UNESA" title="TikTok Resmi UNESA (@unesaid)">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        <a href="{{ $ppakInstitution['socials']['facebook'] ?? 'https://www.facebook.com/officialunesa' }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Facebook Resmi UNESA" title="Facebook Resmi UNESA">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="{{ $ppakInstitution['socials']['linkedin'] ?? 'https://www.linkedin.com/school/universitas-negeri-surabaya' }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="LinkedIn Resmi UNESA" title="LinkedIn Resmi UNESA">
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
                            <span>{{ $ppakInstitution['address'] ?? 'Gedung G6 FEB, Kampus Ketintang, Jl. Ketintang, Surabaya, Jawa Timur 60231' }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-2">
                            <i class="fa-solid fa-envelope text-gold"></i>
                            <a href="mailto:{{ $ppakInstitution['email'] ?? 'ppak.feb@unesa.ac.id' }}" class="text-secondary text-decoration-none hover-white">{{ $ppakInstitution['email'] ?? 'ppak.feb@unesa.ac.id' }}</a>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-2">
                            <i class="fa-solid fa-phone text-gold"></i>
                            <span>{{ $ppakInstitution['phone'] ?? '+62 31 828 0009' }} / Ext. 312</span>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-2">
                            <i class="fa-brands fa-whatsapp text-success"></i>
                            <span>{{ $ppakInstitution['whatsapp'] ?? '+62 812 3456 7890' }} (Helpdesk Mahasiswa)</span>
                        </li>
                    </ul>
                    <div class="p-3 mt-3 rounded-3" style="background-color: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.12);">
                        <div class="d-flex align-items-center gap-2 text-white small fw-bold mb-1">
                            <i class="fa-solid fa-clock text-gold"></i>
                            <span>Jam Operasional Layanan:</span>
                        </div>
                        <div class="text-white-50 small">{{ $ppakInstitution['office_hours'] ?? 'Senin – Jumat: 08.00 – 16.00 WIB' }}</div>
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
                    <span>&copy; {{ date('Y') }} <strong>Pendidikan Profesi Akuntan (PPAk)</strong>. Fakultas Ekonomika dan Bisnis — Universitas Negeri Surabaya.</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge-ppak" style="font-size: 0.725rem; text-transform: none; background: rgba(255,255,255,0.08); color: #ffffff; border: 1px solid rgba(255,255,255,0.15);">
                        <i class="fa-solid fa-award text-warning"></i> Akreditasi {{ $ppakInstitution['akreditasi_status'] ?? 'Baik' }} [{{ $ppakInstitution['akreditasi_lembaga'] ?? 'LAMEMBA' }}]
                    </span>
                    <a href="{{ route('admin.login') }}" class="text-secondary hover-white text-decoration-none d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold" style="font-size:.95rem;" aria-label="Login Admin CMS">
                        <i class="fa-solid fa-lock"></i>Login Admin
                    </a>

                </div>
            </div>
        </div>
    </div>
</footer>

