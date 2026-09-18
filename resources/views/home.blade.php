@extends('layouts.app')

@section('title', 'Pendidikan Profesi Akuntansi FEB UNESA | Universitas Negeri Surabaya')
@section('meta_description', 'Website resmi Program Pendidikan Profesi Akuntansi (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya. Mempersiapkan akuntan profesional beregister dengan standar global.')

@section('content')

{{-- =========================================================================
   1. HERO SECTION (Apple-Inspired Split Minimalist)
   ========================================================================= --}}
<section class="hero-home" aria-label="Hero Banner Utama">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="badge-ppak badge-ppak-navy">
                        <i class="fa-solid fa-graduation-cap text-primary"></i> Program Profesi Akuntan Beregister
                    </span>
                </div>
                <h1 class="hero-headline">
                    Pendidikan Profesi Akuntansi <span class="accent">FEB UNESA</span>
                </h1>
                <p class="hero-subheadline">
                    Program pendidikan profesi unggulan yang membina calon profesional akuntansi dengan penguasaan kompetensi akademik mutakhir, integritas etika luhur, skeptisisme profesional, serta kesiapan penuh menghadapi ekosistem kerja global.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('admisi.jalur-syarat') }}" class="btn-ppak-primary btn-ppak-lg">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('profil.sejarah') }}" class="btn-ppak-secondary btn-ppak-lg">
                        <i class="fa-solid fa-circle-info text-primary"></i>
                        <span>Pelajari PPAk</span>
                    </a>
                </div>

                {{-- Fast Feature Bullets --}}
                <div class="d-flex flex-wrap gap-4 mt-5 pt-3 border-top border-light-subtle">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-check text-primary"></i>
                        <span class="small fw-semibold text-secondary">Sebutan Akuntan (Ak.)</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-check text-primary"></i>
                        <span class="small fw-semibold text-secondary">Skema Waiver Ujian CA</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-check text-primary"></i>
                        <span class="small fw-semibold text-secondary">Kelas Reguler & Eksekutif</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-visual-card">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1000&q=85" alt="Aktivitas Akademik dan Pembelajaran di PPAk FEB UNESA">
                    <div class="hero-floating-badge">
                        <div class="d-flex align-items-center gap-3">
                            <div class="navbar-brand-emblem" style="width: 46px; height: 46px; font-size: 1.15rem;">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-navy" style="font-size: 0.95rem;">Terakreditasi Baik Sekali</div>
                                <div class="text-secondary small">Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   2. PENGENALAN SINGKAT & KEY STATS (2-Column Editorial)
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Pengenalan PPAk">
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-5">
                <span class="badge-ppak badge-ppak-blue mb-2">Tentang Program</span>
                <h2 class="mb-3">Mencetak Pemimpin Akuntansi yang Berintegritas</h2>
            </div>
            <div class="col-lg-7">
                <p class="lead mb-3">
                    Pendidikan Profesi Akuntansi (PPAk) pada Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya diselenggarakan untuk menjawab kebutuhan industri dan profesi terhadap akuntan yang tidak hanya menguasai teori, namun memiliki kecakapan analitis dan etika kerja standar internasional.
                </p>
                <p class="text-secondary mb-0">
                    Dengan bimbingan dosen bereputasi, jejaring Kantor Akuntan Publik (KAP), dan kurikulum berbasis IFRS serta regulasi perpajakan terkini, lulusan PPAk UNESA siap berkarier di berbagai sektor strategis, baik sektor publik maupun swasta.
                </p>
            </div>
        </div>

        {{-- Stat Cards --}}
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
   3. KEUNGGULAN PPAK (Editorial Minimalist)
   ========================================================================= --}}
<section class="section-py" aria-label="Keunggulan Program PPAk">
    <div class="container">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-blue mb-2">Mengapa Memilih Kami</span>
            <h2>Keunggulan Pendidikan Profesi di FEB UNESA</h2>
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
   4. PROGRAM & KOMPETENSI (Grid of Competencies)
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Kompetensi Utama Lulusan">
    <div class="container">
        <div class="row align-items-end justify-content-between mb-5">
            <div class="col-lg-7">
                <span class="badge-ppak badge-ppak-navy mb-2">Standar Pembelajaran</span>
                <h2>Pilar Kompetensi Profesional Akuntan</h2>
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
   5. ADMISI & PENDAFTARAN (Stepper & Pathways)
   ========================================================================= --}}
<section class="section-py" aria-label="Alur Pendaftaran Admisi">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <span class="badge-ppak badge-ppak-gold mb-2">Admisi Mahasiswa Baru</span>
                <h2 class="mb-3">Jalur Pendaftaran & Alur Seleksi Masuk</h2>
                <p class="text-secondary mb-4">
                    Penerimaan mahasiswa baru PPAk dibuka pada semester gasal dan genap. Proses seleksi transparan, berbasis portofolio akademik dan verifikasi kualifikasi sarjana.
                </p>

                <div class="p-4 rounded-3 border bg-subtle mb-4">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <i class="fa-solid fa-calendar-check text-primary fs-5"></i>
                        <span class="fw-bold text-navy">Periode Gelombang Berjalan</span>
                    </div>
                    <div class="small text-secondary mb-3">Pendaftaran daring sedang berlangsung untuk Semester Akademik 2024/2025.</div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admisi.jalur-syarat') }}" class="btn-ppak-primary btn-ppak-sm">
                            <span>Syarat Masuk</span>
                        </a>
                        <a href="{{ route('admisi.biaya') }}" class="btn-ppak-secondary btn-ppak-sm">
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
                                <h4 class="fs-6 fw-bold text-navy mb-1">{{ $step['title'] }}</h4>
                                <p class="small text-secondary mb-0">{{ $step['desc'] }}</p>
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
   6. BERITA & PENGUMUMAN TERBARU (Editorial Clean Cards)
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Berita dan Pengumuman Terkini">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="badge-ppak badge-ppak-blue mb-2">Publikasi Informasi</span>
                <h2>Berita & Pengumuman Terbaru</h2>
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
                                <a href="{{ route('informasi.berita.detail', $item['slug']) }}" class="small fw-bold text-primary text-decoration-none">
                                    Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
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
   7. AGENDA & EVENT MENDATANG (Distinct Horizontal Editorial List)
   ========================================================================= --}}
<section class="section-py" aria-label="Agenda dan Seminar Mendatang">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="badge-ppak badge-ppak-navy mb-2">Kegiatan Ilmiah & Profesi</span>
                <h2>Agenda & Event Mendatang</h2>
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
                                <span class="badge-ppak badge-ppak-blue" style="font-size: 0.725rem;">{{ $event['category'] }}</span>
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
   8. PROFIL DOSEN & PENGAJAR (Curated Faculty Preview)
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Pengajar PPAk">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <span class="badge-ppak badge-ppak-blue mb-2">Tenaga Pendidik</span>
                <h2>Profil Dosen & Praktisi Pengajar</h2>
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
   9. AKREDITASI & SERTIFIKASI (Credible Academic Section)
   ========================================================================= --}}
<section class="section-py" aria-label="Akreditasi dan Legalitas">
    <div class="container">
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <div class="row align-items-center g-4">
                <div class="col-lg-3 text-center">
                    <div class="p-4 bg-white rounded-3 border d-inline-block shadow-sm">
                        <i class="fa-solid fa-building-columns text-primary display-4 mb-2"></i>
                        <div class="fw-bold text-navy small">LAMEMBA</div>
                        <div class="badge-ppak badge-ppak-gold mt-2">Baik Sekali</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="badge-ppak badge-ppak-blue mb-2">Jaminan Mutu Akademik</span>
                    <h3 class="h2 mb-2">Status Akreditasi Resmi Program Studi</h3>
                    <p class="text-secondary small mb-3">
                        Pendidikan Profesi Akuntansi (PPAk) Fakultas Ekonomika dan Bisnis UNESA telah memenuhi standar nasional penjaminan mutu pendidikan tinggi dengan predikat <strong>Baik Sekali</strong> berdasarkan asesmen Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi (LAMEMBA).
                    </p>
                    <div class="d-flex flex-wrap gap-3 small text-muted">
                        <div><i class="fa-solid fa-file-lines me-1 text-primary"></i> SK: {{ $info['sk_akreditasi'] }}</div>
                        <div><i class="fa-solid fa-calendar me-1 text-primary"></i> Masa Berlaku: {{ $info['masa_berlaku'] }}</div>
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
   10. TESTIMONI ALUMNI & KARIER (Quotes & Pathways)
   ========================================================================= --}}
<section class="section-py bg-subtle" aria-label="Testimoni Alumni dan Jejak Karier">
    <div class="container">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-blue mb-2">Dampak Lulusan</span>
            <h2>Testimoni Alumni & Jejak Profesional</h2>
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
        <div class="p-4 rounded-3 bg-white border">
            <div class="text-center mb-4">
                <h4 class="fs-6 fw-bold text-navy mb-1">Sebaran Karier Utama Alumni PPAk FEB UNESA</h4>
                <p class="small text-muted mb-0">Peluang penyerapan kerja lulusan di ranah profesional multidisipliner</p>
            </div>
            <div class="row g-3">
                @foreach($karierSectors as $sector)
                    <div class="col-md-4 col-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-2 bg-subtle border border-light-subtle h-100">
                            <div class="feature-icon-wrapper" style="width: 36px; height: 36px; font-size: 0.9rem;">
                                <i class="fa-solid {{ $sector['icon'] }}"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-navy small">{{ $sector['title'] }}</div>
                                <div class="text-muted" style="font-size: 0.725rem;">{{ $sector['desc'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- =========================================================================
   11. KERJA SAMA & MITRA STRATEGIS (Monochrome Minimalist)
   ========================================================================= --}}
<section class="section-py" aria-label="Mitra Strategis dan Kerja Sama">
    <div class="container">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-navy mb-2">Jejaring Kelembagaan</span>
            <h2>Mitra Strategis & Organisasi Profesi</h2>
            <p class="text-secondary">
                Kolaborasi sinergis dalam kurikulum profesi, penempatan magang, riset asurans, serta penyelenggaraan ujian sertifikasi akuntansi.
            </p>
        </div>

        <div class="row g-3">
            @foreach($mitra as $m)
                <div class="col-lg-3 col-md-6">
                    <div class="p-3 rounded-3 border bg-white h-100 text-center transition-hover">
                        <div class="badge-ppak badge-ppak-blue mb-2" style="font-size: 0.675rem;">{{ $m['category'] }}</div>
                        <h4 class="fs-6 fw-bold text-navy mb-1">{{ $m['name'] }}</h4>
                        <div class="small text-secondary" style="font-size: 0.775rem;">{{ $m['type'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
