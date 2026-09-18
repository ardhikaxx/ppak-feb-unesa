@extends('layouts.app')

@section('title', 'Lokasi & Peta Kampus | PPAk FEB UNESA')
@section('meta_description', 'Informasi alamat sekretariat, peta lokasi kampus Ketintang, jam pelayanan operasional, dan panduan transportasi PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Lokasi Kampus & Peta Sekretariat',
    'badge' => 'Kampus Ketintang Surabaya',
    'lead' => 'Kunjungi sekretariat PPAk di Gedung G6 Fakultas Ekonomika dan Bisnis, Universitas Negeri Surabaya.',
    'breadcrumbs' => [
        ['label' => 'Kontak', 'url' => route('kontak.lokasi')],
        ['label' => 'Lokasi & Peta', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        <div class="row g-5 mb-5">
            {{-- Contact Information --}}
            <div class="col-lg-5">
                <span class="badge-ppak badge-ppak-blue mb-2">Alamat Lengkap</span>
                <h2 class="h3 text-navy mb-4">Sekretariat PPAk FEB UNESA</h2>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="feature-icon-wrapper">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-navy small mb-1">Gedung G6 Fakultas Ekonomika dan Bisnis</div>
                        <p class="small text-secondary mb-0">
                            Kampus Ketintang UNESA, Jl. Ketintang, Kelurahan Ketintang, Kecamatan Gayungan, Kota Surabaya, Jawa Timur 60231.
                        </p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="feature-icon-wrapper">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-navy small mb-1">Jam Pelayanan Kantor:</div>
                        <p class="small text-secondary mb-0">
                            Senin – Kamis: 08.00 – 16.00 WIB<br>
                            Jumat: 08.00 – 16.30 WIB (Istirahat 11.30 – 13.00 WIB)<br>
                            Sabtu & Minggu: Layanan Khusus Kelas Eksekutif
                        </p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="feature-icon-wrapper">
                        <i class="fa-solid fa-bus"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-navy small mb-1">Akses Transportasi Publik:</div>
                        <p class="small text-secondary mb-0">
                            Terhubung langsung dengan rute feeder WiraWiri Suroboyo (Halte UNESA Ketintang), Suroboyo Bus Koridor R1/R2, serta berjarak 1.5 km dari Stasiun Kereta Api Wonokromo.
                        </p>
                    </div>
                </div>

                <div class="d-flex gap-2 pt-2">
                    <a href="https://maps.google.com/?q=FEB+UNESA+Ketintang+Surabaya" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary btn-ppak-sm">
                        <i class="fa-solid fa-diamond-turn-right me-1"></i>
                        <span>Buka di Google Maps</span>
                    </a>
                    <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-secondary btn-ppak-sm">
                        <span>Kontak Helpdesk</span>
                    </a>
                </div>
            </div>

            {{-- Map Display Mockup / Embed --}}
            <div class="col-lg-7">
                <div class="p-3 rounded-4 border bg-subtle h-100 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                        <span class="small fw-bold text-navy"><i class="fa-solid fa-map-location-dot me-1 text-primary"></i> Peta Satelit Kampus Ketintang</span>
                        <span class="badge-ppak badge-ppak-navy" style="font-size: 0.675rem;">Koordinat: -7.3117, 112.7275</span>
                    </div>

                    {{-- Stylized Map Placeholder --}}
                    <div class="rounded-3 border overflow-hidden flex-grow-1 position-relative d-flex align-items-center justify-content-center" style="min-height: 380px; background: linear-gradient(135deg, #e8f0fe 0%, #dbeafe 100%);">
                        <div class="text-center p-4">
                            <div class="navbar-brand-emblem mx-auto mb-3" style="width: 56px; height: 56px; font-size: 1.4rem;">
                                <i class="fa-solid fa-location-pin"></i>
                            </div>
                            <h4 class="h5 fw-bold text-navy mb-1">Gedung G6 FEB UNESA</h4>
                            <p class="small text-secondary mb-3 max-w-700">Jl. Ketintang, Surabaya, Jawa Timur 60231</p>
                            <a href="https://maps.google.com/?q=Fakultas+Ekonomika+dan+Bisnis+UNESA+Ketintang" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary btn-ppak-sm">
                                <i class="fa-solid fa-location-arrow me-1"></i>
                                <span>Petunjuk Arah Rute Navigasi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
