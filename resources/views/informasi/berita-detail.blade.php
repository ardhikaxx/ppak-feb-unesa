@extends('layouts.app')

@php($seo = \App\Services\SeoService::forNews($article, url()->current()))
@section('title', $seo['title'])
@section('meta_description', $seo['description'])
@section('meta_robots', $seo['robots'])
@section('canonical', $seo['canonical'])
@section('og_type', 'article')
@section('og_title', $seo['og_title'])
@section('og_description', $seo['og_description'])
@section('og_image', $seo['og_image'])
@section('og_url', $seo['og_url'])

@push('jsonld')
<script type="application/ld+json">{!! json_encode(\App\Services\SeoService::articleJsonLd($article, url()->current()), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')

@include('partials.page-header', [
    'title' => $article['title'],
    'badge' => $article['category'],
    'breadcrumbs' => [
        ['label' => 'Informasi', 'url' => route('informasi.berita')],
        ['label' => 'Berita', 'url' => route('informasi.berita')],
        ['label' => 'Artikel', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                {{-- Metadata bar --}}
                <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-4 border-bottom text-muted small">
                    <div class="d-flex align-items-center gap-3">
                        <span><i class="fa-solid fa-user-pen me-1 text-primary"></i> {{ $article['author'] ?? 'Humas PPAk FEB' }}</span>
                        <span><i class="fa-regular fa-calendar me-1 text-primary"></i> {{ $article['date'] ?? '2026' }}</span>
                        <span><i class="fa-regular fa-clock me-1 text-primary"></i> {{ $article['read_time'] ?? '3 Menit Baca' }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-2 mt-sm-0">
                        <span class="badge-ppak badge-ppak-blue" style="font-size: 0.7rem;">{{ $article['category'] ?? 'Informasi' }}</span>
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="mb-4 rounded-4 overflow-hidden border shadow-sm">
                    <img src="{{ $article['image'] ?? '/images/default-img.png' }}" alt="{{ $article['title'] ?? 'Berita PPAk' }}" class="img-fluid w-100" style="max-height: 480px; object-fit: cover;">
                </div>

                {{-- Article Body --}}
                <article class="article-content mb-5" style="font-size: 1.05rem; line-height: 1.8; color: var(--ppak-text-secondary);">
                    {!! $article['content'] ?? '' !!}
                </article>

                {{-- Tags & Share Buttons --}}
                <div class="p-4 rounded-3 border bg-subtle mb-5">
                    <div class="row align-items-center g-3">
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="small fw-bold text-navy"><i class="fa-solid fa-tags me-1"></i> Tags:</span>
                                @foreach($article['tags'] ?? ['PPAk', 'FEB UNESA'] as $tag)
                                    <span class="badge-ppak badge-ppak-navy" style="font-size: 0.7rem;">#{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="d-flex align-items-center justify-content-md-end gap-2">
                                <span class="small fw-bold text-navy me-1">Bagikan:</span>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($article['title'] . ' ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary btn-ppak-sm" aria-label="Share WhatsApp">
                                    <i class="fa-brands fa-whatsapp text-success"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary btn-ppak-sm" aria-label="Share LinkedIn">
                                    <i class="fa-brands fa-linkedin text-primary"></i>
                                </a>
                                <button type="button" class="btn-ppak-secondary btn-ppak-sm" id="copyArticleLinkBtn" title="Salin Tautan">
                                    <i class="fa-regular fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Back button --}}
                <div class="mb-5">
                    <a href="{{ route('informasi.berita') }}" class="btn-ppak-secondary btn-ppak-sm">
                        <i class="fa-solid fa-arrow-left me-1"></i>
                        <span>Kembali ke Indeks Berita</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- RELATED ARTICLES --}}
        @if(!empty($related))
            <div class="mt-4 pt-5 border-top">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h4 text-navy fw-bold mb-0">Artikel & Warta Terkait</h3>
                    <a href="{{ route('informasi.berita') }}" class="small text-primary fw-bold text-decoration-none">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($related as $rel)
                        <div class="col-md-4">
                            <article class="news-card">
                                <div class="news-card-img-wrapper">
                                    <img src="{{ $rel['image'] }}" alt="{{ $rel['title'] }}" class="news-card-img" loading="lazy">
                                </div>
                                <div class="news-card-body">
                                    <div class="news-card-meta">
                                        <span class="badge-ppak badge-ppak-navy" style="font-size: 0.7rem;">{{ $rel['category'] }}</span>
                                        <span>{{ $rel['date'] }}</span>
                                    </div>
                                    <h4 class="news-card-title" style="font-size: 1rem;">
                                        <a href="{{ route('informasi.berita.detail', $rel['slug']) }}">
                                            {{ $rel['title'] }}
                                        </a>
                                    </h4>
                                    <div class="pt-2 mt-auto">
                                        <a href="{{ route('informasi.berita.detail', $rel['slug']) }}" class="small fw-bold text-primary text-decoration-none">
                                            Baca Selengkapnya &rarr;
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
