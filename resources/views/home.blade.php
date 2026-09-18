@extends('layouts.app')

@section('title', 'Pendidikan Profesi Akuntansi FEB UNESA | Universitas Negeri Surabaya')
@section('meta_description', 'Website resmi Program Pendidikan Profesi Akuntansi (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya. Mempersiapkan akuntan profesional beregister dengan standar global.')

@section('content')

{{-- =========================================================================
   1. HERO SECTION (Campus Photo Background with Primary Overlay & Glassmorphism)
   ========================================================================= --}}
<section class="hero-home" style="background-image: linear-gradient(135deg, rgba(7, 25, 48, 0.94) 0%, rgba(10, 35, 66, 0.90) 50%, rgba(18, 63, 115, 0.82) 100%), url('{{ asset('images/unesa_campus_hero.jpg') }}');" aria-label="Hero Banner Utama">
    <div class="container-xl">
        <div class="row align-items-center">
            <div class="col-lg-9 col-xl-8">
                <div class="hero-brand-badge">
                    <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo Resmi UNESA" class="hero-brand-badge-logo">
                    <span class="hero-brand-badge-text">PENDIDIKAN PROFESI AKUNTANSI &bull; FEB UNESA</span>
                </div>
                <h1 class="hero-headline">
                    Membangun Profesional Akuntansi yang <span class="accent">Kompeten & Berintegritas</span>
                </h1>
                <p class="hero-subheadline">
                    Program pendidikan profesi unggulan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya yang membina calon profesional akuntansi dengan penguasaan kompetensi akademik mutakhir, integritas etika luhur, skeptisisme profesional, serta kesiapan penuh menghadapi ekosistem kerja global.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('admisi.jalur-syarat') }}" class="btn-hero-primary">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('profil.sejarah') }}" class="btn-hero-secondary">
                        <i class="fa-solid fa-circle-info text-gold"></i>
                        <span>Pelajari PPAk</span>
                    </a>
                </div>

                {{-- Fast Feature Bullets --}}
                <div class="hero-bullets">
                    <div class="hero-bullet-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Sebutan Akuntan (Ak.)</span>
                    </div>
                    <div class="hero-bullet-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Skema Waiver Ujian CA</span>
                    </div>
                    <div class="hero-bullet-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Kelas Reguler & Eksekutif</span>
                    </div>
                    <div class="hero-bullet-item">
                        <i class="fa-solid fa-certificate"></i>
                        <span>Terakreditasi Baik Sekali (LAMEMBA)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   2. PENGENALAN SINGKAT (2-Column Editorial)
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Pengenalan PPAk">
    <div class="container-xl">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <span class="badge-ppak badge-ppak-gold mb-2">TENTANG PPAk FEB UNESA</span>
                <h2 class="mb-3">Mencetak Pemimpin Akuntansi Berintegritas & Berdaya Saing Global</h2>
                <div class="golden-line"></div>
            </div>
            <div class="col-lg-7">
                <p class="lead mb-3 text-dark">
                    Pendidikan Profesi Akuntansi (PPAk) pada Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya diselenggarakan untuk menjawab kebutuhan industri dan profesi terhadap akuntan yang tidak hanya menguasai teori, namun memiliki kecakapan analitis dan etika kerja standar internasional.
                </p>
                <p class="text-secondary mb-0">
                    Dengan bimbingan dosen bereputasi, jejaring Kantor Akuntan Publik (KAP), dan kurikulum berbasis IFRS serta regulasi perpajakan terkini, lulusan PPAk UNESA siap berkarier di berbagai sektor strategis, baik sektor publik maupun swasta.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   3. INDIKATOR & STATISTIK INSTITUSIONAL
   ========================================================================= --}}
<section class="section-py-sm border-bottom border-top bg-white" aria-label="Statistik Institusional">
    <div class="container-xl">
        <div class="row g-4">
            @foreach($stats as $stat)
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card-apple">
                        <div class="stat-number">{{ $stat['number'] }}</div>
                        <div class="stat-label">{{ $stat['label'] }}</div>
                        <p class="stat-desc">{{ $stat['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =========================================================================
   4. KEUNGGULAN PPAK FEB UNESA (Editorial Minimalist)
   ========================================================================= --}}
<section class="section-py bg-white" aria-label="Keunggulan Program PPAk">
    <div class="container-xl">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-gold mb-2">Mengapa Memilih Kami</span>
            <h2>Keunggulan Pendidikan Profesi di FEB UNESA</h2>
            <div class="golden-line center"></div>
            <p class="text-secondary">
                Pendekatan holistik yang mengintegrasikan kecakapan teknis akuntansi, teknologi informasi analitika, dan etika profesi yang kokoh.
            </p>
        </div>

        <div class="row g-4 g-lg-5">
            @foreach($keunggulan as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="feature-item">
                        <div class="feature-icon-wrapper">
                            <i class="fa-solid {{ $item['icon'] }}"></i>
                        </div>
                        <div>
                            <h3 class="feature-title">{{ $item['title'] }}</h3>
                            <p class="feature-desc">{{ $item['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =========================================================================
   5. AKADEMIK & PILAR KOMPETENSI PROFESIONAL
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Kompetensi Utama Lulusan">
    <div class="container-xl">
        <div class="row align-items-end justify-content-between mb-5">
            <div class="col-lg-7">
                <span class="badge-ppak badge-ppak-navy mb-2">Standar Pembelajaran</span>
                <h2>Pilar Kompetensi Profesional Akuntan</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-0">
                    Struktur capaian pembelajaran disusun mengacu pada standar International Education Standards (IES) oleh IFAC dan Kerangka Kualifikasi Nasional Indonesia (KKNI) Jenjang 7.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('akademik.kurikulum') }}" class="btn-ppak-secondary">
                    <span>Lihat Kurikulum Lengkap</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($kompetensi as $komp)
                <div class="col-md-6 col-lg-4">
                    <div class="card-ppak-flat h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="feature-icon-wrapper" style="width: 40px; height: 40px; font-size: 1rem;">
                                <i class="fa-solid {{ $komp['icon'] }}"></i>
                            </div>
                            <span class="badge-ppak badge-ppak-navy" style="font-size: 0.725rem;">{{ $komp['code'] }}</span>
                        </div>
                        <h4 class="fs-6 fw-bold text-navy mb-2">{{ $komp['title'] }}</h4>
                        <p class="small text-secondary mb-0" style="line-height: 1.65;">{{ $komp['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =========================================================================
   6. ADMISI & PENDAFTARAN MAHASISWA BARU (Solid Navy Institutional)
   ========================================================================= --}}
<section class="section-py section-admisi-navy" aria-label="Alur Pendaftaran Admisi">
    <div class="container-xl">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <span class="badge-ppak badge-ppak-gold mb-2">ADMISI MAHASISWA BARU</span>
                <h2 class="text-white mb-3">Jalur Pendaftaran & Alur Seleksi Masuk</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-4">
                    Penerimaan mahasiswa baru PPAk dibuka pada semester gasal dan genap. Proses seleksi transparan, berbasis portofolio akademik dan verifikasi kualifikasi sarjana.
                </p>

                <div class="p-4 rounded-3 border border-white border-opacity-15 mb-4" style="background: rgba(255, 255, 255, 0.06); backdrop-filter: blur(8px);">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-calendar-check text-gold fs-5"></i>
                            <span class="fw-bold text-white">Periode Gelombang Berjalan</span>
                        </div>
                        <span class="badge-ppak badge-ppak-green" style="font-size: 0.7rem;">Aktif</span>
                    </div>
                    <div class="small text-white-50 mb-3">Pendaftaran daring sedang berlangsung untuk Semester Akademik 2024/2025.</div>
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
            </div>

            <div class="col-lg-7">
                <div class="stepper-container">
                    @foreach($admisiInfo['prosedur'] as $step)
                        <div class="stepper-item">
                            <div class="stepper-circle">{{ $step['step'] }}</div>
                            <div class="stepper-content">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <h4 class="fs-6 fw-bold mb-0 text-white">{{ $step['title'] }}</h4>
                                    <span class="badge rounded-pill text-bg-warning px-2 py-1" style="font-size: 0.675rem; font-weight: 600; background-color: var(--unesa-gold) !important; color: var(--unesa-navy) !important;">Tahap {{ $step['step'] }}</span>
                                </div>
                                <p class="small mb-0" style="color: #cbd5e1; line-height: 1.55;">{{ $step['desc'] }}</p>
                            </div>
                            <div class="stepper-line"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   7. BERITA & PENGUMUMAN TERBARU (Editorial Clean Cards)
   ========================================================================= --}}
<section class="section-py bg-white" aria-label="Berita dan Pengumuman Terkini">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="badge-ppak badge-ppak-gold mb-2">Publikasi Informasi</span>
                <h2>Berita & Pengumuman Terbaru</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-0">Informasi teraktual seputar dinamika akademik, kerja sama, dan kegiatan keprofesian di PPAk FEB UNESA.</p>
            </div>
            <div>
                <a href="{{ route('informasi.berita') }}" class="btn-ppak-secondary">
                    <span>Semua Berita</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($berita as $item)
                <div class="col-md-6 col-lg-4">
                    <article class="news-card">
                        <div class="news-card-img-wrapper">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="news-card-img" loading="lazy">
                        </div>
                        <div class="news-card-body">
                            <div class="news-card-meta">
                                <span class="badge-ppak badge-ppak-navy" style="font-size: 0.7rem;">{{ $item['category'] }}</span>
                                <span><i class="fa-regular fa-calendar me-1"></i> {{ $item['date'] }}</span>
                            </div>
                            <h3 class="news-card-title">
                                <a href="{{ route('informasi.berita.detail', $item['slug']) }}">
                                    {{ $item['title'] }}
                                </a>
                            </h3>
                            <p class="news-card-excerpt">{{ $item['excerpt'] }}</p>
                            <div>
                                <a href="{{ route('informasi.berita.detail', $item['slug']) }}" class="small fw-bold text-navy text-decoration-none">
                                    Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1 text-gold"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <p>Belum ada artikel berita yang dipublikasikan saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- =========================================================================
   8. AGENDA & EVENT MENDATANG (Distinct Horizontal Editorial List)
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Agenda dan Seminar Mendatang">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="badge-ppak badge-ppak-gold mb-2">Kegiatan Ilmiah & Profesi</span>
                <h2>Agenda & Event Mendatang</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-0">Ikuti rangkaian seminar pakar, workshop CA/CPA, serta kuliah tamu dari praktisi industri.</p>
            </div>
            <div>
                <a href="{{ route('informasi.agenda') }}" class="btn-ppak-secondary">
                    <span>Lihat Seluruh Agenda</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @foreach($agenda as $event)
                    <div class="event-item-card">
                        <div class="event-date-box">
                            <span class="event-date-day">{{ $event['day'] }}</span>
                            <span class="event-date-month">{{ $event['month'] }}</span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                <span class="badge-ppak badge-ppak-navy" style="font-size: 0.725rem;">{{ $event['category'] }}</span>
                                <span class="small text-muted"><i class="fa-regular fa-clock me-1"></i> {{ $event['time'] }}</span>
                                <span class="small text-muted"><i class="fa-solid fa-location-dot me-1"></i> {{ $event['venue'] }}</span>
                            </div>
                            <h4 class="fs-6 fw-bold text-navy mb-1">{{ $event['title'] }}</h4>
                            <p class="small text-secondary mb-0">{{ $event['desc'] }}</p>
                        </div>
                        <div class="ms-lg-auto flex-shrink-0">
                            @if($event['is_upcoming'])
                                <span class="badge-ppak badge-ppak-green">{{ $event['status'] }}</span>
                            @else
                                <span class="badge-ppak badge-ppak-navy">{{ $event['status'] }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   9. PROFIL DOSEN & PRAKTISI PENGAJAR (Curated Faculty Preview)
   ========================================================================= --}}
<section class="section-py bg-white" aria-label="Pengajar PPAk">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="badge-ppak badge-ppak-gold mb-2">Tenaga Pendidik</span>
                <h2>Profil Dosen & Praktisi Pengajar</h2>
                <div class="golden-line"></div>
                <p class="text-secondary mb-0">Diajar oleh gabungan akademisi bergelar doktor/profesor dan praktisi senior pemegang sertifikasi profesi.</p>
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
                    <div class="dosen-card">
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
    </div>
</section>

{{-- =========================================================================
   10. AKREDITASI & LEGALITAS RESMI (Credible Academic Quality)
   ========================================================================= --}}
<section class="section-py bg-white border-top" aria-label="Akreditasi dan Legalitas">
    <div class="container-xl">
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <div class="row align-items-center g-4">
                <div class="col-lg-3 text-center">
                    <div class="p-4 bg-white rounded-3 border d-inline-block shadow-sm">
                        <i class="fa-solid fa-building-columns text-navy display-4 mb-2"></i>
                        <div class="fw-bold text-navy small">LAMEMBA</div>
                        <div class="badge-ppak badge-ppak-gold mt-2">Baik Sekali</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="badge-ppak badge-ppak-gold mb-2">Jaminan Mutu Akademik</span>
                    <h3 class="h2 mb-2">Status Akreditasi Resmi Program Studi</h3>
                    <div class="golden-line"></div>
                    <p class="text-secondary small mb-3">
                        Pendidikan Profesi Akuntansi (PPAk) Fakultas Ekonomika dan Bisnis UNESA telah memenuhi standar nasional penjaminan mutu pendidikan tinggi dengan predikat <strong>Baik Sekali</strong> berdasarkan asesmen Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi (LAMEMBA).
                    </p>
                    <div class="d-flex flex-wrap gap-3 small text-muted">
                        <div><i class="fa-solid fa-file-lines me-1 text-gold"></i> SK: {{ $info['sk_akreditasi'] }}</div>
                        <div><i class="fa-solid fa-calendar me-1 text-gold"></i> Masa Berlaku: {{ $info['masa_berlaku'] }}</div>
                    </div>
                </div>
                <div class="col-lg-3 text-lg-end">
                    <a href="{{ route('profil.akreditasi') }}" class="btn-ppak-primary">
                        <span>Detail Akreditasi</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   11. KERJA SAMA & MITRA STRATEGIS (Monochrome Minimalist)
   ========================================================================= --}}
<section class="section-py bg-white" aria-label="Mitra Strategis dan Kerja Sama">
    <div class="container-xl">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-gold mb-2">Jejaring Kelembagaan</span>
            <h2>Mitra Strategis & Organisasi Profesi</h2>
            <div class="golden-line center"></div>
            <p class="text-secondary">
                Kolaborasi sinergis dalam kurikulum profesi, penempatan magang, riset asurans, serta penyelenggaraan ujian sertifikasi akuntansi.
            </p>
        </div>

        <div class="row g-3">
            @foreach($mitra as $m)
                <div class="col-lg-3 col-md-6">
                    <div class="p-3 rounded-3 border bg-white h-100 text-center transition-hover">
                        <div class="badge-ppak badge-ppak-navy mb-2" style="font-size: 0.675rem;">{{ $m['category'] }}</div>
                        <h4 class="fs-6 fw-bold text-navy mb-1">{{ $m['name'] }}</h4>
                        <div class="small text-secondary" style="font-size: 0.775rem;">{{ $m['type'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =========================================================================
   12. TESTIMONI ALUMNI & KARIER (Quotes & Pathways)
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Testimoni Alumni dan Jejak Karier">
    <div class="container-xl">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-gold mb-2">Dampak Lulusan</span>
            <h2>Testimoni Alumni & Jejak Profesional</h2>
            <div class="golden-line center"></div>
            <p class="text-secondary">
                Lulusan PPAk FEB UNESA telah meniti karier sebagai pemimpin keuangan, akuntan publik, dan pemeriksa negara di berbagai lembaga prestisius.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @foreach(array_slice($testimoni, 0, 3) as $t)
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card">
                        <blockquote class="testi-quote">
                            "{{ $t['quote'] }}"
                        </blockquote>
                        <div class="testi-author">
                            <img src="{{ $t['avatar'] }}" alt="{{ $t['name'] }}" class="testi-avatar" loading="lazy">
                            <div>
                                <div class="testi-name">{{ $t['name'] }}</div>
                                <div class="testi-role">{{ $t['role'] }} &bull; {{ $t['company'] }}</div>
                                <div class="small text-muted" style="font-size: 0.725rem;">{{ $t['year'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Karier Badges --}}
        <div class="p-4 p-lg-5 rounded-4 bg-white border shadow-sm">
            <div class="text-center max-w-700 mx-auto mb-4">
                <span class="badge-ppak badge-ppak-gold mb-2">PROSPEK KARIER UTAMA</span>
                <h3 class="h4 fw-bold text-navy mb-1">Sebaran Karier Utama Alumni PPAk FEB UNESA</h3>
                <p class="small text-secondary mb-0">Peluang penyerapan kerja lulusan bergelar Akuntan (Ak.) di ranah industri terkemuka, instansi pemerintahan, dan kantor akuntan publik.</p>
            </div>
            <div class="row g-3 g-lg-4">
                @foreach($karierSectors as $sector)
                    <div class="col-lg-4 col-md-6">
                        <div class="karier-item-card">
                            <div class="karier-icon-box">
                                <i class="fa-solid {{ $sector['icon'] }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold text-navy mb-1" style="font-size: 0.925rem; line-height: 1.35;">{{ $sector['title'] }}</div>
                                <div class="text-secondary" style="font-size: 0.785rem; line-height: 1.45;">{{ $sector['desc'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
