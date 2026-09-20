@extends('layouts.app')

@section('title', 'Berita & Pengumuman Resmi | PPAk FEB UNESA')
@section('meta_description', 'Kumpulan berita kegiatan, siaran pers, pengumuman akademik, dan dinamika keprofesian Program Pendidikan Profesi Akuntan FEB UNESA.')
@section('meta_robots', $robots ?? 'index,follow')

@section('content')

<x-page-header title="Berita & Pengumuman" badge="Informasi & Publikasi Resmi" lead="Kabar teraktual mengenai aktivitas perkuliahan, kerja sama industri, kuliah tamu pakar, dan pengumuman administratif PPAk FEB UNESA." :breadcrumbs="[
    ['label' => 'Informasi', 'url' => route('informasi.berita')],
    ['label' => 'Berita', 'url' => '']
]" />

<section class="section-py bg-white">
    <div class="container">
        {{-- Search / filter (GET, bookmarkable) --}}
        <form method="GET" action="{{ route('informasi.berita') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari berita (judul, excerpt)..." aria-label="Cari berita">
                </div>
                <div class="col-md-4">
                    <select name="kategori" class="form-select" aria-label="Filter kategori" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <option value="FEB" @selected(request('kategori')==='FEB')>Fakultas Ekonomika dan Bisnis</option>
                        <option value="Informasi Universitas" @selected(request('kategori')==='Informasi Universitas')>Informasi Universitas</option>
                        <option value="Admisi" @selected(request('kategori')==='Admisi')>Admisi & Pendaftaran</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn-ppak-primary w-100"><i class="fa-solid fa-magnifying-glass me-1"></i> Cari</button>
                </div>
            </div>
        </form>

        {{-- Featured --}}
        @if($featured && request('page', 1) == 1 && !request('q') && !request('kategori'))
            <div class="mb-5">
                <article class="p-4 p-lg-5 rounded-4 border bg-subtle">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <div class="news-card-img-wrapper rounded-3 overflow-hidden shadow-sm" style="aspect-ratio:16/9;">
                                <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" class="news-card-img" loading="eager" width="600" height="338" style="position:absolute; width:100%; height:100%; object-fit:cover;">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <x-badge variant="blue">{{ $featured['category'] }}</x-badge>
                                <x-badge variant="gold">Utama</x-badge>
                                <span class="small text-muted"><i class="fa-regular fa-calendar me-1"></i> {{ $featured['date'] }}</span>
                            </div>
                            <h2 class="h3 fw-bold text-navy mb-3" style="line-height:1.3;">
                                <a href="{{ route('informasi.berita.detail', $featured['slug']) }}" class="text-navy text-decoration-none">{{ $featured['title'] }}</a>
                            </h2>
                            <p class="text-secondary small mb-4">{{ $featured['excerpt'] }}</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="small text-muted"><i class="fa-solid fa-user-pen me-1"></i> {{ $featured['author'] }}</span>
                                <x-button variant="primary" size="sm" href="{{ route('informasi.berita.detail', $featured['slug']) }}">Baca Artikel Lengkap <i class="fa-solid fa-arrow-right ms-1"></i></x-button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        @endif

        {{-- Regular grid - paginated --}}
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="h4 text-navy fw-bold mb-0">Artikel & Warta Terbaru</h3>
                <span class="small text-muted">Menampilkan {{ $berita->count() }} dari {{ $berita->total() }} artikel</span>
            </div>

            @if($berita->count() > 0)
                <div class="row g-4">
                    @foreach($berita as $item)
                        {{-- Hide featured from list on page 1 to avoid duplication --}}
                        @if($featured && $item['slug'] === $featured['slug'] && $berita->currentPage() == 1 && !request('q') && !request('kategori'))
                            @continue
                        @endif
                        <div class="col-lg-4 col-md-6">
                            <x-news-card :image="$item['image']" :category="$item['category']" :date="$item['date']" :title="$item['title']" :excerpt="$item['excerpt']" :href="route('informasi.berita.detail', $item['slug'])" :readTime="$item['read_time'] ?? null" />
                        </div>
                    @endforeach
                </div>
            @else
                <x-empty-state title="Belum ada artikel" message="Belum ada artikel berita untuk filter ini." icon="fa-newspaper" />
            @endif
        </div>

        {{-- Scalable pagination - Numbers only --}}
        <div class="d-flex justify-content-center">
            {{ $berita->withQueryString()->links('vendor.pagination.numbers') }}
        </div>
    </div>
</section>

@endsection


