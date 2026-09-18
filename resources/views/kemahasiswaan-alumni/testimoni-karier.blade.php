@extends('layouts.app')

@section('title', 'Testimoni Alumni & Jejak Karier | PPAk FEB UNESA')
@section('meta_description', 'Kisah sukses, pengalaman studi, dan testimoni para alumni Pendidikan Profesi Akuntansi FEB UNESA di berbagai bidang profesi terkemuka.')

@section('content')

@include('partials.page-header', [
    'title' => 'Testimoni & Jejaring Karier Alumni',
    'badge' => 'Kisah Inspiratif Lulusan',
    'lead' => 'Simak penuturan langsung dari para profesional akuntan mengenai pengalaman mereka menempuh pendidikan keprofesian di PPAk FEB UNESA.',
    'breadcrumbs' => [
        ['label' => 'Kemahasiswaan & Alumni', 'url' => route('kemahasiswaan-alumni.alumni')],
        ['label' => 'Testimoni & Karier', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- TESTIMONIALS GRID --}}
        <div class="row g-4 mb-5">
            @foreach($testimoni as $t)
                <div class="col-lg-6">
                    <div class="testi-card h-100">
                        <blockquote class="testi-quote" style="font-size: 0.985rem; line-height: 1.75;">
                            "{{ $t['quote'] }}"
                        </blockquote>
                        <div class="testi-author pt-3 border-top">
                            <img src="{{ $t['avatar'] }}" alt="{{ $t['name'] }}" class="testi-avatar" loading="lazy">
                            <div>
                                <div class="testi-name">{{ $t['name'] }}</div>
                                <div class="testi-role text-primary fw-semibold">{{ $t['role'] }} &bull; {{ $t['company'] }}</div>
                                <div class="small text-muted">{{ $t['year'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- SEBARAN SEKTOR KARIER --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="badge-ppak badge-ppak-gold mb-2">PROSPEK MASA DEPAN</span>
                <h2 class="mb-3">Peta Sebaran Profesi Lulusan</h2>
                <div class="golden-line mx-auto mb-3"></div>
                <p class="text-secondary">
                    Ijazah profesi dan sebutan Akuntan (Ak.) membuka pintu jenjang karier strategis pada berbagai domain profesi di Indonesia maupun kawasan regional.
                </p>
            </div>

            <div class="row g-4">
                @foreach($karierSectors as $sector)
                    <div class="col-lg-4 col-md-6">
                        <div class="profesi-card">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="profesi-icon mb-0">
                                    <i class="fa-solid {{ $sector['icon'] }}"></i>
                                </div>
                                <span class="badge bg-light text-navy border fw-semibold px-2 py-1" style="font-size: 0.72rem;">Profesi Akuntan</span>
                            </div>
                            <h3 class="fs-6 fw-bold text-navy mb-2" style="line-height: 1.35;">{{ $sector['title'] }}</h3>
                            <p class="small text-secondary mb-0 flex-grow-1" style="line-height: 1.65;">
                                Lingkup kerja mencakup <strong class="text-navy">{{ $sector['desc'] }}</strong> dengan standar kualifikasi keprofesian tinggi dan kode etik independen.
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
