@extends('layouts.app')

@section('title', 'Berita & Pengumuman Resmi | PPAk FEB UNESA')
@section('meta_description', 'Kumpulan berita kegiatan, siaran pers, pengumuman akademik, dan dinamika keprofesian Program Pendidikan Profesi Akuntansi FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Berita & Pengumuman',
    'badge' => 'Informasi & Publikasi Resmi',
    'lead' => 'Kabar teraktual mengenai aktivitas perkuliahan, kerja sama industri, kuliah tamu pakar, dan pengumuman administratif PPAk FEB UNESA.',
    'breadcrumbs' => [
        ['label' => 'Informasi', 'url' => route('informasi.berita')],
        ['label' => 'Berita', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- FEATURED ARTICLE (Large Editorial Layout) --}}
        @if($featured)
            <div class="mb-5">
                <article class="p-4 p-lg-5 rounded-4 border bg-subtle">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <div class="news-card-img-wrapper rounded-3 overflow-hidden shadow-sm">
                                <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" class="news-card-img" style="position: absolute; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge-ppak badge-ppak-blue">{{ $featured['category'] }}</span>
                                <span class="badge-ppak badge-ppak-gold">Utama</span>
                                <span class="small text-muted"><i class="fa-regular fa-calendar me-1"></i> {{ $featured['date'] }}</span>
                            </div>
                            <h2 class="h3 fw-bold text-navy mb-3" style="line-height: 1.3;">
                                <a href="{{ route('informasi.berita.detail', $featured['slug']) }}" class="text-navy text-decoration-none hover-primary">
                                    {{ $featured['title'] }}
                                </a>
                            </h2>
                            <p class="text-secondary small mb-4" style="line-height: 1.7;">
                                {{ $featured['excerpt'] }}
                            </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="small text-muted"><i class="fa-solid fa-user-pen me-1"></i> {{ $featured['author'] }}</span>
                                <a href="{{ route('informasi.berita.detail', $featured['slug']) }}" class="btn-ppak-primary btn-ppak-sm">
                                    <span>Baca Artikel Lengkap</span>
                                    <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        @endif

        {{-- REGULAR ARTICLES GRID --}}
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="h4 text-navy fw-bold mb-0">Artikel & Warta Terbaru</h3>
                <span class="small text-muted">Menampilkan {{ count($berita) }} dari {{ count($allBerita) }} artikel</span>
            </div>

            <div class="row g-4">
                @forelse($berita as $item)
                    <div class="col-lg-4 col-md-6">
                        <article class="news-card">
                            <div class="news-card-img-wrapper">
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="news-card-img" loading="lazy">
                            </div>
                            <div class="news-card-body">
                                <div class="news-card-meta">
                                    <span class="badge-ppak badge-ppak-navy" style="font-size: 0.7rem;">{{ $item['category'] }}</span>
                                    <span><i class="fa-regular fa-calendar me-1"></i> {{ $item['date'] }}</span>
                                </div>
                                <h4 class="news-card-title">
                                    <a href="{{ route('informasi.berita.detail', $item['slug']) }}">
                                        {{ $item['title'] }}
                                    </a>
                                </h4>
                                <p class="news-card-excerpt">{{ $item['excerpt'] }}</p>
                                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                    <span class="small text-muted" style="font-size: 0.75rem;"><i class="fa-regular fa-clock me-1"></i> {{ $item['read_time'] }}</span>
                                    <a href="{{ route('informasi.berita.detail', $item['slug']) }}" class="small fw-bold text-primary text-decoration-none">
                                        Selengkapnya &rarr;
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <p>Belum ada artikel berita tambahan saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- BOOTSTRAP PAGINATION (Front-end Ready) --}}
        <nav aria-label="Navigasi Halaman Berita" class="d-flex justify-content-center">
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <span class="page-link"><i class="fa-solid fa-chevron-left"></i></span>
                </li>
                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</section>

@endsection
