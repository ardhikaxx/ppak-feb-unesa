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
    <div class="container-xl">
        <div class="row g-5 mb-5">
            {{-- Contact Information --}}
            <div class="col-lg-5">
                <span class="badge-ppak badge-ppak-gold mb-2">Alamat Lengkap</span>
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
                    <a href="https://maps.google.com/?q=Gedung+G6+FEB+UNESA" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary btn-ppak-sm">
                        <i class="fa-solid fa-diamond-turn-right me-1"></i>
                        <span>Buka di Google Maps</span>
                    </a>
                    <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-secondary btn-ppak-sm">
                        <span>Kontak Helpdesk</span>
                    </a>
                </div>
            </div>

            {{-- Map Display Google Maps Embed --}}
            <div class="col-lg-7">
                <div class="p-3 rounded-4 border bg-white shadow-sm h-100 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-3 px-1">
                        <span class="small fw-bold text-navy"><i class="fa-solid fa-map-location-dot me-1 text-gold"></i> Peta Lokasi Gedung G6 FEB UNESA</span>
                        <a href="https://maps.google.com/?q=Gedung+G6+FEB+UNESA" target="_blank" rel="noopener noreferrer" class="badge-ppak badge-ppak-gold text-decoration-none" style="font-size: 0.72rem;">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Peta Penuh
                        </a>
                    </div>

                    <div class="rounded-3 border overflow-hidden flex-grow-1 position-relative" style="min-height: 420px;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.362658310499!2d112.72604727593402!3d-7.313093871907306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbff455381bd%3A0xf2fe8ae1a9e31504!2sGedung%20G6%20FEB%20UNESA!5e0!3m2!1sid!2sid!4v1789748209875!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0; min-height: 420px; width: 100%; display: block;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="strict-origin-when-cross-origin"
                            title="Peta Lokasi Gedung G6 FEB UNESA">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
