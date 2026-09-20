@extends('layouts.app')

@section('title', 'Pendidikan Profesi Akuntan FEB UNESA | Universitas Negeri Surabaya')
@section('meta_description', 'Website resmi Program Studi Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya (Kode Prodi: 62902). Terakreditasi Baik oleh LAMEMBA.')

@section('content')

{{-- =========================================================================
   1. HERO SECTION
   ========================================================================= --}}
<section class="hero-home" style="background-image: linear-gradient(90deg, rgba(7, 25, 48, 0.88) 0%, rgba(7, 25, 48, 0.78) 32%, rgba(10, 35, 66, 0.45) 55%, rgba(10, 35, 66, 0.15) 75%, rgba(18, 63, 115, 0) 100%), url('{{ asset('images/background-hero.jpg') }}');" aria-label="Hero Banner Utama">
    <div class="container-xl">
        <div class="row align-items-center">
            <div class="col-lg-9 col-xl-8">
                <div class="hero-brand-badge">
                    <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo Resmi UNESA" class="hero-brand-badge-logo">
                    <span class="hero-brand-badge-text">{{ strtoupper($info['name'] ?? 'PENDIDIKAN PROFESI AKUNTAN') }} &bull; {{ strtoupper($info['short_name'] ?? 'FEB UNESA') }}</span>
                </div>
                <h1 class="hero-headline">
                    {{ $info['name'] ?? 'Program Pendidikan Profesi Akuntan' }} <span class="accent">{{ $info['tagline'] ?? 'Unggul & Berintegritas' }}</span>
                </h1>
                <p class="hero-subheadline">
                    Program pendidikan profesi di bawah naungan {{ $info['faculty'] ?? 'Fakultas Ekonomika dan Bisnis' }} {{ $info['university'] ?? 'Universitas Negeri Surabaya' }} (Kode Prodi: <strong>{{ $info['program_code'] ?? '62902' }}</strong>). Menyelenggarakan kurikulum profesional berbasis standar profesi akuntan (IAI & IAPI), tata kelola, dan etika keprofesian luhur.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('admisi.prosedur-jadwal') }}" class="btn-hero-primary">
                        <span>Informasi Pendaftaran</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('profil.sejarah') }}" class="btn-hero-secondary">
                        <i class="fa-solid fa-circle-info text-gold"></i>
                        <span>Profil Program Studi</span>
                    </a>
                </div>

                {{-- Fast Feature Bullets --}}
                <div class="hero-bullets">
                    <div class="hero-bullet-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Kode Prodi: {{ $info['program_code'] ?? '62902' }}</span>
                    </div>
                    <div class="hero-bullet-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Berdiri: {{ $info['established_date'] ?? '23 Mei 2025' }}</span>
                    </div>
                    <div class="hero-bullet-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Akreditasi {{ $info['akreditasi_status'] ?? 'Baik' }} ({{ $info['akreditasi_lembaga'] ?? 'LAMEMBA' }})</span>
                    </div>
                    <div class="hero-bullet-item">
                        <i class="fa-solid fa-certificate"></i>
                        <span>UKT: {{ $info['ukt_formatted'] ?? 'Rp5.500.000' }} / Semester</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   2. PENGENALAN SINGKAT & IDENTITAS INSTITUSIONAL
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Pengenalan Program Studi">
    <div class="container-xl">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <span class="badge-ppak badge-ppak-gold mb-2">IDENTITAS RESMI PROGRAM STUDI</span>
                <h2 class="mb-3">{{ $info['name'] ?? 'Pendidikan Profesi Akuntan' }} {{ $info['short_name'] ?? 'FEB UNESA' }}</h2>
                <div class="golden-line"></div>
                <div class="p-3 bg-white rounded-3 border mt-3">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-user-tie text-navy fs-3"></i>
                        <div>
                            <div class="text-muted small">Koordinator Program Studi:</div>
                            <div class="fw-bold text-navy">{{ $info['coordinator'] ?? 'Rediyanto Putra, S.E., M.S.A.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <p class="lead mb-3 text-dark">
                    Pendidikan Profesi Akuntan ({{ $info['short_name'] ?? 'PPAk FEB UNESA' }}) {{ $info['faculty'] ?? 'Fakultas Ekonomika dan Bisnis' }} {{ $info['university'] ?? 'Universitas Negeri Surabaya' }} tercatat resmi berdiri pada <strong>{{ $info['established_date'] ?? '23 Mei 2025' }}</strong> sebagai wujud pengembangan strategis program pendidikan profesi di lingkungan FEB UNESA.
                </p>
                <p class="text-secondary mb-3">
                    Program studi ini dirancang untuk membekali calon akuntan dengan kompetensi pelaporan korporat lanjutan, pengauditan dan asurans, manajemen perpajakan strategis, tata kelola korporat, serta sistem informasi dan pengendalian internal sesuai standar profesi.
                </p>
                <div class="d-flex flex-wrap gap-2 pt-2">
                    <span class="badge-ppak badge-ppak-navy"><i class="fa-solid fa-shield-halved me-1"></i> SK {{ $info['akreditasi_lembaga'] ?? 'LAMEMBA' }} No. {{ $info['sk_akreditasi'] ?? '611/DE/A.5/AR.11/II/2025' }}</span>
                    <span class="badge-ppak badge-ppak-blue"><i class="fa-solid fa-calendar me-1"></i> Berlaku s.d. {{ $info['masa_berlaku_akreditasi'] ?? '25 Februari 2027' }}</span>
                </div>
                <div class="mt-2">
                    <small class="text-muted">
                        <i class="fa-solid fa-link me-1"></i> Sumber: <a href="https://sindig.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="text-decoration-none">SINDIG UNESA</a> &bull; <a href="https://simutu.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="text-decoration-none">SIMUTU UNESA</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   3. DATA KUNCI INSTITUSIONAL RESMI
   ========================================================================= --}}
<section class="section-py-sm border-bottom border-top bg-white" aria-label="Fakta Institusional">
    <div class="container-xl">
        <div class="row g-4">
            @foreach($stats as $stat)
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card-apple">
                        <div class="stat-number">{{ $stat['number'] }}</div>
                        <div class="stat-label">{{ $stat['label'] }}</div>
                        <p class="stat-desc">{{ $stat['desc'] }}</p>
                        <div class="mt-2 pt-2 border-top">
                            <span class="badge-ppak badge-ppak-navy" style="font-size: 0.65rem;">
                                <i class="fa-solid fa-circle-check me-1 text-gold"></i> {{ $stat['source'] }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =========================================================================
   4. KURIKULUM PROFESIONAL (Highlight 6 Mata Kuliah Semester 1 SINDIG)
   ========================================================================= --}}
<section class="section-py bg-white" aria-label="Kurikulum Profesional Semester 1">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="badge-ppak badge-ppak-gold mb-2">Struktur Kurikulum SINDIG</span>
                <h2>Kurikulum Profesional (Semester 1)</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-0">Enam mata kuliah inti semester pertama yang membentuk pondasi keahlian teknis dan etika akuntan profesional.</p>
            </div>
            <div>
                <a href="{{ route('akademik.kurikulum') }}" class="btn-ppak-primary">
                    <span>Lihat Seluruh Kurikulum (Sem 1 & 2)</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($kurikulum['semester_1'] as $mk)
                <div class="col-md-6 col-lg-4">
                    <div class="card-ppak-flat h-100 d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge-ppak badge-ppak-navy font-monospace" style="font-size: 0.75rem;">{{ $mk['kode'] }}</span>
                            <span class="badge-ppak badge-ppak-gold">{{ $mk['sks'] }} SKS</span>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-2">{{ $mk['nama'] }}</h3>
                        <p class="small text-secondary mb-3 flex-grow-1" style="line-height: 1.6;">{{ $mk['deskripsi'] }}</p>
                        <div class="mt-auto pt-2 border-top">
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($mk['cpl'] as $cplTag)
                                    <span class="badge bg-light text-navy border" style="font-size: 0.65rem;">{{ $cplTag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 text-end">
            <small class="text-muted">
                <i class="fa-solid fa-database me-1"></i> Sumber Data: <a href="https://sindig.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="text-decoration-none">SINDIG UNESA - Kurikulum Prodi 62902</a>
            </small>
        </div>
    </div>
</section>

{{-- =========================================================================
   5. CAPAIAN PEMBELAJARAN LULUSAN (4 CPL RESMI SINDIG)
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Capaian Pembelajaran Lulusan">
    <div class="container-xl">
        <div class="row align-items-end justify-content-between mb-5">
            <div class="col-lg-7">
                <span class="badge-ppak badge-ppak-navy mb-2">Standar Kompetensi Lulusan</span>
                <h2>Capaian Pembelajaran Lulusan (CPL)</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-0">
                    Empat Capaian Pembelajaran Lulusan resmi yang ditetapkan pada sistem kurikulum SINDIG Pendidikan Profesi Akuntan FEB UNESA.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('akademik.kurikulum') }}" class="btn-ppak-secondary">
                    <span>Pemetaan CPL ke Mata Kuliah</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($kompetensi as $komp)
                <div class="col-md-6 col-lg-3">
                    <div class="card-ppak-flat h-100 bg-white shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="feature-icon-wrapper" style="width: 42px; height: 42px; font-size: 1rem;">
                                <i class="fa-solid {{ $komp['icon'] }}"></i>
                            </div>
                            <span class="badge-ppak badge-ppak-navy font-monospace">{{ $komp['code'] }}</span>
                        </div>
                        <div class="badge-ppak badge-ppak-gold mb-2" style="font-size: 0.65rem;">{{ $komp['category'] }}</div>
                        <h3 class="fs-6 fw-bold text-navy mb-2">{{ $komp['title'] }}</h3>
                        <p class="small text-secondary mb-0" style="line-height: 1.65;">{{ $komp['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 text-end">
            <small class="text-muted">
                <i class="fa-solid fa-shield-check me-1"></i> Sumber: SINDIG UNESA &bull; Kurikulum Pendidikan Profesi Akuntan (62902)
            </small>
        </div>
    </div>
</section>

{{-- =========================================================================
   6. AKREDITASI & JAMINAN MUTU RESMI LAMEMBA
   ========================================================================= --}}
<section class="section-py bg-white border-top" aria-label="Akreditasi dan Legalitas">
    <div class="container-xl">
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <div class="row align-items-center g-4">
                <div class="col-lg-3 text-center">
                    <div class="p-4 bg-white rounded-3 border d-inline-block shadow-sm w-100">
                        <i class="fa-solid fa-building-columns text-navy display-4 mb-2"></i>
                        <div class="fw-bold text-navy">{{ $info['akreditasi_lembaga'] ?? 'LAMEMBA' }}</div>
                        <div class="badge-ppak badge-ppak-gold mt-2 px-3 py-1" style="font-size: 0.85rem;">Status: {{ $info['akreditasi_status'] ?? 'Baik' }}</div>
                        <div class="mt-2"><span class="badge-ppak badge-ppak-green" style="font-size: 0.7rem;">Aktif</span></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="badge-ppak badge-ppak-gold mb-2">Jaminan Mutu Nasional</span>
                    <h3 class="h3 mb-2 text-navy">Akreditasi {{ $info['akreditasi_lembaga'] ?? 'LAMEMBA' }}: {{ $info['akreditasi_status'] ?? 'Baik' }}</h3>
                    <div class="golden-line"></div>
                    <p class="text-secondary small mb-3">
                        Program Studi {{ $info['name'] ?? 'Pendidikan Profesi Akuntan' }} {{ $info['faculty'] ?? 'Fakultas Ekonomika dan Bisnis' }} {{ $info['university'] ?? 'Universitas Negeri Surabaya' }} telah terakreditasi dengan status <strong>{{ $info['akreditasi_status'] ?? 'Baik' }}</strong> oleh {{ $info['akreditasi_lembaga'] ?? 'LAMEMBA' }}.
                    </p>
                    <div class="row g-2 small text-muted">
                        <div class="col-sm-6"><i class="fa-solid fa-file-lines me-1 text-gold"></i> SK: <strong>{{ $info['sk_akreditasi'] ?? '611/DE/A.5/AR.11/II/2025' }}</strong></div>
                        <div class="col-sm-6"><i class="fa-solid fa-calendar-check me-1 text-gold"></i> Tanggal SK: <strong>{{ $info['tanggal_sk_akreditasi'] ?? '26 Februari 2025' }}</strong></div>
                        <div class="col-12"><i class="fa-solid fa-hourglass-half me-1 text-gold"></i> Masa Berlaku: <strong>{{ $info['tanggal_sk_akreditasi'] ?? '26 Februari 2025' }} s.d. {{ $info['masa_berlaku_akreditasi'] ?? '25 Februari 2027' }}</strong></div>
                    </div>
                </div>
                <div class="col-lg-3 text-lg-end">
                    <a href="{{ route('profil.akreditasi') }}" class="btn-ppak-primary w-100 text-center mb-2">
                        <span>Detail Akreditasi</span>
                        <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                    <a href="https://simutu.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary w-100 text-center btn-ppak-sm">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
                        <span>Sumber Resmi SIMUTU</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   7. ADMISI & INFORMASI PENDAFTARAN (Data Resmi Admisi UNESA)
   ========================================================================= --}}
<section class="section-py section-admisi-navy" aria-label="Alur Pendaftaran Admisi">
    <div class="container-xl">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <span class="badge-ppak badge-ppak-gold mb-2">ADMISI MAHASISWA BARU</span>
                <h2 class="text-white mb-3">Informasi Pendaftaran & Biaya Pendidikan</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-4">
                    Penerimaan mahasiswa baru Program Profesi diselenggarakan secara terpusat melalui portal Penerimaan Mahasiswa Baru Universitas Negeri Surabaya (PMB UNESA).
                </p>

                <div class="p-4 rounded-3 border border-white border-opacity-15 mb-4" style="background: rgba(255, 255, 255, 0.06); backdrop-filter: blur(8px);">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-receipt text-gold fs-5"></i>
                            <span class="fw-bold text-white">UKT {{ $info['short_name'] ?? 'Pendidikan Profesi Akuntan' }}</span>
                        </div>
                        <span class="badge-ppak badge-ppak-gold" style="font-size: 0.75rem;">Resmi Admisi</span>
                    </div>
                    <div class="display-6 fw-bold text-white mb-1">{{ $admisiInfo['ukt_label'] ?? ($info['ukt_formatted'] ?? 'Rp5.500.000') }}</div>
                    <div class="small text-white-50 mb-3">Per Semester (Berdasarkan ketetapan UKT S2, S3, dan Profesi UNESA).</div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admisi.jalur-syarat') }}" class="btn-ppak-gold btn-ppak-sm">
                            <i class="fa-solid fa-clipboard-check me-1"></i>
                            <span>Syarat Masuk</span>
                        </a>
                        <a href="{{ route('admisi.biaya') }}" class="btn-ppak-secondary btn-ppak-sm">
                            <i class="fa-solid fa-receipt me-1"></i>
                            <span>Rincian Biaya</span>
                        </a>
                    </div>
                </div>

                {{-- Status Arsip / Jadwal Seleksi --}}
                <div class="p-3 rounded-3" style="background: rgba(255, 255, 255, 0.04); border: 1px dashed rgba(255, 255, 255, 0.2);">
                    <div class="d-flex align-items-center gap-2 text-white-50 small">
                        <i class="fa-solid fa-box-archive text-gold"></i>
                        <span>Status Jadwal: <strong>{{ $admisiInfo['status_label'] ?? 'Arsip Seleksi 2026/2027' }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="stepper-container">
                    @foreach($admisiInfo['tahapan_pendaftaran'] as $step)
                        <div class="stepper-item">
                            <div class="stepper-circle">{{ $step['langkah'] }}</div>
                            <div class="stepper-content">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <h4 class="fs-6 fw-bold mb-0 text-white">{{ $step['judul'] }}</h4>
                                    <span class="badge rounded-pill px-2 py-1" style="font-size: 0.675rem; font-weight: 600; background-color: var(--unesa-gold) !important; color: var(--unesa-navy) !important;">Tahap {{ $step['langkah'] }}</span>
                                </div>
                                <p class="small mb-0" style="color: #cbd5e1; line-height: 1.55;">{{ $step['deskripsi'] }}</p>
                            </div>
                            <div class="stepper-line"></div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 text-end">
                    <a href="https://pmb.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-gold btn-ppak-sm">
                        <span>Akses Portal PMB UNESA</span>
                        <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   8. RISET & PUBLIKASI DOSEN (Data Terverifikasi SINTA 2026)
   ========================================================================= --}}
<section class="section-py bg-white" aria-label="Publikasi Ilmiah Dosen">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="badge-ppak badge-ppak-gold mb-2">Aktivitas Ilmiah & Dosen</span>
                <h2>Riset & Publikasi Dosen Pengajar</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-0">Publikasi karya ilmiah dan kegiatan pengabdian dosen pengajar yang tercatat pada pangkalan data resmi.</p>
            </div>
            <div>
                <a href="{{ route('riset-pengabdian.riset-publikasi') }}" class="btn-ppak-secondary">
                    <span>Lihat Halaman Publikasi</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($riset as $r)
                <div class="col-lg-12">
                    <div class="p-4 rounded-3 border bg-subtle">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-3">
                            <div>
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                    <span class="badge-ppak badge-ppak-navy" style="font-size: 0.725rem;">{{ $r['kategori'] }}</span>
                                    <span class="badge-ppak badge-ppak-gold" style="font-size: 0.725rem;">{{ $r['tahun'] }}</span>
                                    <span class="small text-muted"><i class="fa-regular fa-calendar me-1"></i> {{ $r['tanggal'] }}</span>
                                </div>
                                <h3 class="h5 text-navy fw-bold mb-2">{{ $r['judul'] }}</h3>
                                <p class="text-secondary small mb-2"><i class="fa-solid fa-user-pen me-1 text-gold"></i> Penulis: <strong>{{ $r['penulis'] }}</strong></p>
                                <p class="small text-muted mb-0">{{ $r['deskripsi'] }}</p>
                            </div>
                            <div class="flex-shrink-0 text-md-end">
                                <a href="{{ $r['sinta_url'] }}" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary btn-ppak-sm">
                                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
                                    <span>Profil SINTA</span>
                                </a>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top">
                            <small class="text-muted">
                                <i class="fa-solid fa-link me-1"></i> Sumber Data: {{ $r['source'] }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =========================================================================
   9. PROFIL DOSEN & PENGAJAR MATA KULIAH PPAK
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Pengajar PPAk">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="badge-ppak badge-ppak-gold mb-2">Tenaga Pengajar</span>
                <h2>Dosen & Pengajar Mata Kuliah PPAk</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-0">Tenaga pengajar yang mengampu mata kuliah pada Program Studi Pendidikan Profesi Akuntan FEB UNESA.</p>
            </div>
            <div>
                <a href="{{ route('profil.dosen-pengajar') }}" class="btn-ppak-secondary">
                    <span>Lihat Seluruh Pengajar</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($dosen as $d)
                <div class="col-md-6 col-lg-3">
                    <div class="dosen-card bg-white">
                        <div class="dosen-photo-wrapper">
                            <img src="{{ $d['image'] }}" alt="{{ $d['name'] }}" class="dosen-photo" loading="lazy">
                        </div>
                        <div class="dosen-info">
                            <h3 class="dosen-name">{{ $d['name'] }}</h3>
                            <div class="dosen-gelar">{{ $d['gelar'] }}</div>
                            <div class="dosen-role">{{ $d['role'] }}</div>
                            <div class="mt-auto pt-2 border-top">
                                <span class="badge-ppak badge-ppak-navy" style="font-size: 0.7rem;">{{ $d['category_label'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 text-end">
            <small class="text-muted">
                <i class="fa-solid fa-database me-1"></i> Sumber: SINDIG Course Assignment & Pangkalan Data Dosen UNESA
            </small>
        </div>
    </div>
</section>

{{-- =========================================================================
   10. BERITA & AGENDA PEMBELAJARAN
   ========================================================================= --}}
<section class="section-py bg-white" aria-label="Berita dan Agenda Pembelajaran">
    <div class="container-xl">
        <div class="row g-5">
            {{-- Berita & Informasi --}}
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <span class="badge-ppak badge-ppak-gold mb-1">Publikasi</span>
                        <h3 class="h4 text-navy mb-0">Berita & Informasi</h3>
                    </div>
                    <a href="{{ route('informasi.berita') }}" class="small fw-bold text-navy text-decoration-none">
                        Semua <i class="fa-solid fa-arrow-right text-gold"></i>
                    </a>
                </div>
                <div class="golden-line mb-4"></div>

                <div class="d-flex flex-column gap-3">
                    @forelse($berita as $item)
                        <article class="p-3 rounded-3 border bg-white shadow-sm">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge-ppak badge-ppak-navy" style="font-size: 0.65rem;">{{ $item['category'] }}</span>
                                <span class="small text-muted"><i class="fa-regular fa-calendar me-1"></i> {{ $item['date'] }}</span>
                            </div>
                            <h4 class="fs-6 fw-bold mb-1">
                                <a href="{{ route('informasi.berita.detail', $item['slug']) }}" class="text-navy text-decoration-none hover-primary">
                                    {{ $item['title'] }}
                                </a>
                            </h4>
                            <p class="small text-secondary mb-0" style="line-height: 1.5;">{{ $item['excerpt'] }}</p>
                        </article>
                    @empty
                        <div class="p-4 text-center text-muted border rounded-3">Belum ada berita yang dipublikasikan.</div>
                    @endforelse
                </div>
            </div>

            {{-- Agenda & Pembelajaran --}}
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <span class="badge-ppak badge-ppak-gold mb-1">Akademik 2026/2027</span>
                        <h3 class="h4 text-navy mb-0">Agenda Pembelajaran</h3>
                    </div>
                    <a href="{{ route('akademik.kalender') }}" class="small fw-bold text-navy text-decoration-none">
                        Kalender <i class="fa-solid fa-arrow-right text-gold"></i>
                    </a>
                </div>
                <div class="golden-line mb-4"></div>

                <div class="d-flex flex-column gap-3">
                    @foreach($agenda as $event)
                        <div class="p-3 rounded-3 border bg-subtle">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="badge-ppak badge-ppak-gold" style="font-size: 0.65rem;">{{ $event['category'] }}</span>
                                <span class="small text-muted"><i class="fa-regular fa-calendar-check me-1 text-primary"></i> {{ $event['date'] }}</span>
                            </div>
                            <h4 class="fs-6 fw-bold text-navy mb-1">{{ $event['title'] }}</h4>
                            <p class="small text-secondary mb-0">{{ $event['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   11. PROSPEK KARIER BIDANG AKUNTANSI
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Prospek Karier Akuntan">
    <div class="container-xl">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-gold mb-2">PROSPEK PROFESI</span>
            <h2>Bidang Karier & Jalur Profesi Akuntan</h2>
            <div class="golden-line center"></div>
            <p class="text-secondary">
                Informasi bidang profesi yang relevan bagi lulusan sarjana akuntansi yang menempuh pendidikan profesi akuntan.
            </p>
        </div>

        <div class="row g-4">
            @foreach($karierSectors as $sector)
                <div class="col-lg-3 col-md-6">
                    <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                            <i class="fa-solid {{ $sector['icon'] }}"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-2">{{ $sector['title'] }}</h3>
                        <p class="small text-secondary mb-0" style="line-height: 1.55;">{{ $sector['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection


