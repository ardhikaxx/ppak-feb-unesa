<header class="navbar-floating-header">
    <nav class="navbar navbar-expand-xl navbar-ppak" aria-label="Navigasi Utama Program Studi">
        <div class="navbar-ppak-container">
            {{-- 1. Brand Area (Sisi Kiri) --}}
            <a class="navbar-brand-wrapper" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo Resmi Universitas Negeri Surabaya" class="navbar-brand-logo">
                <div class="navbar-brand-divider"></div>
                <div class="navbar-brand-text">
                    <span class="navbar-brand-title">Pendidikan Profesi Akuntan</span>
                    <span class="navbar-brand-subtitle">Fakultas Ekonomika dan Bisnis</span>
                </div>
            </a>

            {{-- Mobile Hamburger Toggle Button --}}
            <button class="navbar-toggler navbar-toggler-apple d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas" aria-label="Buka navigasi menu">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>

            {{-- 2. Navigation & 3. CTA Area (Offcanvas Drawer on Mobile, Inline on Desktop) --}}
            <div class="offcanvas offcanvas-end offcanvas-ppak" tabindex="-1" id="navbarOffcanvas" aria-labelledby="navbarOffcanvasLabel">
                <div class="offcanvas-header border-bottom d-xl-none">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo UNESA" height="36" style="width:auto; max-width: 130px; object-fit: contain;">
                        <div>
                            <div class="fw-bold text-navy lh-sm" style="font-size: 0.95rem;">Pendidikan Profesi Akuntan</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Fakultas Ekonomika dan Bisnis</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
                </div>

                <div class="offcanvas-body">
                    {{-- Navigation Menu (Area Tengah) --}}
                    <ul class="navbar-nav mx-auto align-items-xl-center">
                        {{-- 1. Beranda --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <span>Beranda</span>
                            </a>
                        </li>

                        {{-- 2. Profil --}}
                        <li class="nav-item dropdown {{ request()->routeIs('profil.*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="{{ route('profil.sejarah') }}" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Profil</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('profil.sejarah') ? 'active' : '' }}" href="{{ route('profil.sejarah') }}">
                                        <i class="fa-solid fa-timeline" aria-hidden="true"></i>
                                        <span>Sejarah Singkat</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('profil.visi-misi') ? 'active' : '' }}" href="{{ route('profil.visi-misi') }}">
                                        <i class="fa-solid fa-bullseye" aria-hidden="true"></i>
                                        <span>Visi, Misi & Tujuan</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('profil.struktur-organisasi') ? 'active' : '' }}" href="{{ route('profil.struktur-organisasi') }}">
                                        <i class="fa-solid fa-sitemap" aria-hidden="true"></i>
                                        <span>Struktur Organisasi</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('profil.dosen-pengajar') ? 'active' : '' }}" href="{{ route('profil.dosen-pengajar') }}">
                                        <i class="fa-solid fa-user-tie" aria-hidden="true"></i>
                                        <span>Profil Dosen & Pengajar</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('profil.akreditasi') ? 'active' : '' }}" href="{{ route('profil.akreditasi') }}">
                                        <i class="fa-solid fa-award" aria-hidden="true"></i>
                                        <span>Akreditasi & Sertifikasi</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- 3. Akademik --}}
                        <li class="nav-item dropdown {{ request()->routeIs('akademik.*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="{{ route('akademik.kurikulum') }}" id="akademikDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Akademik</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="akademikDropdown">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('akademik.kurikulum') ? 'active' : '' }}" href="{{ route('akademik.kurikulum') }}">
                                        <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                                        <span>Kurikulum & Capaian (CPL)</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('akademik.kalender') ? 'active' : '' }}" href="{{ route('akademik.kalender') }}">
                                        <i class="fa-regular fa-calendar-days" aria-hidden="true"></i>
                                        <span>Kalender Akademik</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('akademik.gelar-sertifikasi') ? 'active' : '' }}" href="{{ route('akademik.gelar-sertifikasi') }}">
                                        <i class="fa-solid fa-certificate" aria-hidden="true"></i>
                                        <span>Gelar & Sertifikasi CA/CPA</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('akademik.panduan') ? 'active' : '' }}" href="{{ route('akademik.panduan') }}">
                                        <i class="fa-solid fa-book" aria-hidden="true"></i>
                                        <span>Pedoman & Buku Panduan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- 4. Admisi & Pendaftaran --}}
                        <li class="nav-item dropdown {{ request()->routeIs('admisi.*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="{{ route('admisi.jalur-syarat') }}" id="admisiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Admisi & Pendaftaran</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="admisiDropdown">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('admisi.jalur-syarat') ? 'active' : '' }}" href="{{ route('admisi.jalur-syarat') }}">
                                        <i class="fa-solid fa-list-check" aria-hidden="true"></i>
                                        <span>Jalur & Syarat Masuk</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('admisi.biaya') ? 'active' : '' }}" href="{{ route('admisi.biaya') }}">
                                        <i class="fa-solid fa-receipt" aria-hidden="true"></i>
                                        <span>Biaya Pendidikan</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('admisi.prosedur-jadwal') ? 'active' : '' }}" href="{{ route('admisi.prosedur-jadwal') }}">
                                        <i class="fa-solid fa-route" aria-hidden="true"></i>
                                        <span>Prosedur & Jadwal</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('admisi.faq') ? 'active' : '' }}" href="{{ route('admisi.faq') }}">
                                        <i class="fa-regular fa-circle-question" aria-hidden="true"></i>
                                        <span>FAQ Admisi</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- 5. Riset & Pengabdian --}}
                        <li class="nav-item dropdown {{ request()->routeIs('riset-pengabdian.*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="{{ route('riset-pengabdian.riset-publikasi') }}" id="risetDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Riset & Pengabdian</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="risetDropdown">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('riset-pengabdian.riset-publikasi') ? 'active' : '' }}" href="{{ route('riset-pengabdian.riset-publikasi') }}">
                                        <i class="fa-solid fa-flask" aria-hidden="true"></i>
                                        <span>Riset & Publikasi Ilmiah</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('riset-pengabdian.pengabdian') ? 'active' : '' }}" href="{{ route('riset-pengabdian.pengabdian') }}">
                                        <i class="fa-solid fa-hand-holding-heart" aria-hidden="true"></i>
                                        <span>Pengabdian Kepada Masyarakat</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('riset-pengabdian.kerja-sama') ? 'active' : '' }}" href="{{ route('riset-pengabdian.kerja-sama') }}">
                                        <i class="fa-solid fa-handshake" aria-hidden="true"></i>
                                        <span>Kerja Sama & Mitra Strategis</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- 6. Kemahasiswaan & Alumni --}}
                        <li class="nav-item dropdown {{ request()->routeIs('kemahasiswaan-alumni.*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="{{ route('kemahasiswaan-alumni.alumni') }}" id="alumniDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Kemahasiswaan & Alumni</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="alumniDropdown">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('kemahasiswaan-alumni.alumni') ? 'active' : '' }}" href="{{ route('kemahasiswaan-alumni.alumni') }}">
                                        <i class="fa-solid fa-users" aria-hidden="true"></i>
                                        <span>Ikatan Alumni PPAk (IKA)</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('kemahasiswaan-alumni.mahasiswa') ? 'active' : '' }}" href="{{ route('kemahasiswaan-alumni.mahasiswa') }}">
                                        <i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>
                                        <span>Komunitas & Aktivitas Mahasiswa</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('kemahasiswaan-alumni.testimoni-karier') ? 'active' : '' }}" href="{{ route('kemahasiswaan-alumni.testimoni-karier') }}">
                                        <i class="fa-solid fa-briefcase" aria-hidden="true"></i>
                                        <span>Testimoni & Jejaring Karier</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- 7. Informasi & Publikasi --}}
                        <li class="nav-item dropdown {{ request()->routeIs('informasi.*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="{{ route('informasi.berita') }}" id="infoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Informasi & Publikasi</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="infoDropdown">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('informasi.berita*') ? 'active' : '' }}" href="{{ route('informasi.berita') }}">
                                        <i class="fa-solid fa-newspaper" aria-hidden="true"></i>
                                        <span>Berita & Pengumuman</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('informasi.agenda') ? 'active' : '' }}" href="{{ route('informasi.agenda') }}">
                                        <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
                                        <span>Agenda & Seminar</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('informasi.galeri') ? 'active' : '' }}" href="{{ route('informasi.galeri') }}">
                                        <i class="fa-solid fa-images" aria-hidden="true"></i>
                                        <span>Galeri Kegiatan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- 8. Kontak & Layanan --}}
                        <li class="nav-item dropdown {{ request()->routeIs('kontak.*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="{{ route('kontak.lokasi') }}" id="kontakDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Kontak & Layanan</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="kontakDropdown">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('kontak.lokasi') ? 'active' : '' }}" href="{{ route('kontak.lokasi') }}">
                                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                                        <span>Lokasi & Peta Kampus</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('kontak.helpdesk') ? 'active' : '' }}" href="{{ route('kontak.helpdesk') }}">
                                        <i class="fa-solid fa-headset" aria-hidden="true"></i>
                                        <span>Sekretariat & Helpdesk</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('kontak.unduhan') ? 'active' : '' }}" href="{{ route('kontak.unduhan') }}">
                                        <i class="fa-solid fa-file-arrow-down" aria-hidden="true"></i>
                                        <span>Unduhan Dokumen Publik</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    {{-- 3. CTA Area (Sisi Kanan) --}}
                    <div class="navbar-cta-group">
                        <a href="{{ route('admisi.jalur-syarat') }}" class="btn-navbar-cta w-100 w-xl-auto">
                            <span>Pendaftaran</span>
                            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
