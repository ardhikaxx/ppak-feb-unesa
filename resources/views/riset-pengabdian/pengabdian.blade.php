@extends('layouts.app')

@section('title', 'Pengabdian Kepada Masyarakat (PKM) | PPAk FEB UNESA')
@section('meta_description', 'Program pengabdian masyarakat dosen dan mahasiswa PPAk FEB UNESA dalam pendampingan akuntansi UMKM, tata kelola BUMDes, dan literasi pajak.')

@section('content')

@include('partials.page-header', [
    'title' => 'Pengabdian Kepada Masyarakat (PKM)',
    'badge' => 'Dampak Sosial & Hilirisasi Kepakaran',
    'lead' => 'Penerapan keilmuan akuntansi dan tata kelola secara langsung untuk memberdayakan UMKM, desa binaan, dan masyarakat Jawa Timur.',
    'breadcrumbs' => [
        ['label' => 'Riset & Pengabdian', 'url' => route('riset-pengabdian.riset-publikasi')],
        ['label' => 'Pengabdian Masyarakat', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-blue mb-2">Program Unggulan PKM</span>
            <h2>Kontribusi Nyata Akuntan Bagi Masyarakat</h2>
            <p class="text-secondary">
                Dosen dan mahasiswa berkolaborasi memberikan asistensi praktis bagi pelaku ekonomi kerakyatan demi terciptanya transparansi dan inklusi keuangan.
            </p>
        </div>

        <div class="row g-4">
            @foreach($pengabdian as $pkm)
                <div class="col-lg-4 col-md-6">
                    <div class="card-ppak h-100 d-flex flex-column">
                        <div class="news-card-img-wrapper">
                            <img src="{{ $pkm['image'] }}" alt="{{ $pkm['title'] }}" class="news-card-img" loading="lazy">
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge-ppak badge-ppak-navy" style="font-size: 0.675rem;">{{ $pkm['tahun'] }}</span>
                                <span class="small text-muted"><i class="fa-solid fa-location-dot me-1 text-primary"></i>{{ $pkm['lokasi'] }}</span>
                            </div>
                            <h3 class="fs-6 fw-bold text-navy mb-2" style="line-height: 1.4;">{{ $pkm['title'] }}</h3>
                            <div class="small text-primary fw-semibold mb-3">
                                <i class="fa-solid fa-handshake me-1"></i> Mitra: {{ $pkm['mitra'] }}
                            </div>
                            <p class="small text-secondary mb-0 mt-auto" style="line-height: 1.6;">
                                {{ $pkm['ringkasan'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Mitra Usaha Binaan Box --}}
        <div class="p-4 p-md-5 rounded-4 border bg-subtle mt-5 text-center">
            <h4 class="fs-6 fw-bold text-navy mb-2">Tertarik Menjadi Mitra Binaan PKM PPAk FEB UNESA?</h4>
            <p class="small text-secondary mb-3 max-w-700 mx-auto">Kami membuka kerja sama pendampingan pembukuan UMKM, pelatihan pelaporan keuangan koperasi, dan asistensi pajak gratis bagi komunitas usaha binaan.</p>
            <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-primary btn-ppak-sm">
                <span>Ajukan Kemitraan Pengabdian</span>
                <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

@endsection
