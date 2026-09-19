@extends('layouts.app')

@section('title', 'Galeri Dokumentasi Kegiatan | PPAk FEB UNESA')
@section('meta_description', 'Dokumentasi visual aktivitas perkuliahan, workshop praktika audit, seremoni yudisium, dan pengabdian masyarakat PPAk FEB UNESA.')

@section('content')

<x-page-header title="Galeri Foto & Dokumentasi Kegiatan" badge="Dokumentasi Visual" lead="Kilas balik rekaman visual suasana pembelajaran, kuliah tamu, praktika laboratorium, dan pengukuhan profesi akuntan." :breadcrumbs="[
    ['label' => 'Informasi', 'url' => route('informasi.berita')],
    ['label' => 'Galeri Kegiatan', 'url' => '']
]" />

<section class="section-py bg-white">
    <div class="container">
        {{-- Server-side filter - scalable, avoids loading hundreds of images --}}
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mb-5">
            <span class="small text-muted me-2">Menampilkan {{ $galeri->total() }} foto</span>
            <a href="{{ route('informasi.galeri') }}" class="btn-ppak-primary btn-ppak-sm">Semua</a>
        </div>

        @if($galeri->count() > 0)
            <div class="row g-4" id="galleryContainer">
                @foreach($galeri as $item)
                    <div class="col-lg-4 col-md-6 gallery-item" data-category="{{ $item['category'] ?? 'akademik' }}">
                        <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-gallery-img="{{ $item['image'] }}" data-bs-gallery-title="{{ $item['title'] }}" data-bs-gallery-date="{{ $item['date'] ?? '' }} - {{ $item['category_label'] ?? '' }}">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy" width="600" height="400" style="aspect-ratio:4/3; object-fit:cover;">
                            <div class="gallery-overlay">
                                <x-badge variant="gold" style="font-size:0.65rem;">{{ $item['category_label'] ?? 'Dokumentasi' }}</x-badge>
                                <div class="gallery-overlay-title">{{ $item['title'] }}</div>
                                <div class="gallery-overlay-date"><i class="fa-regular fa-calendar me-1"></i> {{ $item['date'] ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $galeri->withQueryString()->links('vendor.pagination.numbers') }}
            </div>
        @else
            <x-empty-state title="Belum ada foto" message="Galeri dokumentasi sedang diperbarui." icon="fa-images" />
        @endif
    </div>
</section>

<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">
            <div class="modal-header border-bottom py-3 px-4">
                <div>
                    <h5 class="modal-title fs-6 fw-bold text-navy" id="galleryModalTitle">Dokumentasi Kegiatan</h5>
                    <div class="small text-muted" id="galleryModalDate">PPAk FEB UNESA</div>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-0 bg-dark text-center">
                <img id="galleryModalImage" src="" alt="Pratinjau Foto" class="img-fluid" style="max-height:75vh; width:100%; object-fit:contain;">
            </div>
        </div>
    </div>
</div>

@endsection
