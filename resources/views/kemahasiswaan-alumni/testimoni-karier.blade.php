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
                <span class="badge-ppak badge-ppak-navy mb-2">Prospek Masa Depan</span>
                <h2>Peta Sebaran Profesi Lulusan</h2>
                <p class="text-secondary">
                    Ijazah profesi dan sebutan Akuntan (Ak.) membuka pintu jenjang karier strategis pada berbagai domain profesi di Indonesia maupun kawasan regional.
                </p>
            </div>

            <div class="row g-4">
                @foreach($karierSectors as $sector)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-ppak-flat h-100 bg-white">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="feature-icon-wrapper" style="width: 42px; height: 42px; font-size: 1.1rem;">
                                    <i class="fa-solid {{ $sector['icon'] }}"></i>
                                </div>
                                <h3 class="fs-6 fw-bold text-navy mb-0">{{ $sector['title'] }}</h3>
                            </div>
                            <p class="small text-secondary mb-0" style="line-height: 1.6;">
                                Lingkup kerja mencakup {{ $sector['desc'] }} dengan standar kualifikasi keprofesian tinggi dan kode etik independen.
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
