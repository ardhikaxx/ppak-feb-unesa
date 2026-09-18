@extends('layouts.app')

@section('title', 'Profil Dosen & Pengajar | PPAk FEB UNESA')
@section('meta_description', 'Daftar dosen akademisi dan praktisi pengajar Program Pendidikan Profesi Akuntansi Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => 'Profil Dosen & Pengajar',
    'badge' => 'Tenaga Pendidik Profesional',
    'lead' => 'Kombinasi pendidik bergelar doktor/profesor dan praktisi senior pemegang sertifikasi profesi CA, CPA, BKP, dan CFE yang berpengalaman luas.',
    'breadcrumbs' => [
        ['label' => 'Profil', 'url' => route('profil.sejarah')],
        ['label' => 'Dosen & Pengajar', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Category Filter Buttons --}}
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mb-5">
            <button type="button" class="btn-ppak-primary btn-ppak-sm active" data-dosen-filter="all">
                Semua Bidang ({{ count($dosen) }})
            </button>
            <button type="button" class="btn-ppak-secondary btn-ppak-sm" data-dosen-filter="auditing">
                Auditing & Asurans
            </button>
            <button type="button" class="btn-ppak-secondary btn-ppak-sm" data-dosen-filter="keuangan">
                Akuntansi Keuangan & IFRS
            </button>
            <button type="button" class="btn-ppak-secondary btn-ppak-sm" data-dosen-filter="perpajakan">
                Perpajakan
            </button>
            <button type="button" class="btn-ppak-secondary btn-ppak-sm" data-dosen-filter="manajemen">
                Manajemen & Analitika Data
            </button>
        </div>

        {{-- Grid of Dosen --}}
        <div class="row g-4" id="dosenGridContainer">
            @forelse($dosen as $d)
                <div class="col-lg-4 col-md-6 dosen-item" data-category="{{ $d['category'] }}">
                    <div class="dosen-card h-100">
                        <div class="dosen-photo-wrapper">
                            <img src="{{ $d['image'] }}" alt="{{ $d['name'] }}" class="dosen-photo" loading="lazy">
                        </div>
                        <div class="dosen-info">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge-ppak badge-ppak-blue" style="font-size: 0.7rem;">{{ $d['category_label'] }}</span>
                                <span class="text-muted" style="font-size: 0.725rem;">NIDN: [Terverifikasi]</span>
                            </div>

                            <h3 class="dosen-name">{{ $d['name'] }}</h3>
                            <div class="dosen-gelar mb-2">{{ $d['gelar'] }}</div>
                            <div class="dosen-role mb-3">{{ $d['role'] }}</div>

                            <div class="mb-3">
                                <div class="small fw-bold text-navy mb-1" style="font-size: 0.785rem;">Bidang Keahlian:</div>
                                <p class="small text-secondary mb-0" style="line-height: 1.5;">{{ $d['bidang'] }}</p>
                            </div>

                            @if(!empty($d['sertifikasi']))
                                <div class="mb-3">
                                    <div class="small fw-bold text-navy mb-1" style="font-size: 0.785rem;">Sertifikasi Profesi:</div>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($d['sertifikasi'] as $cert)
                                            <span class="badge-ppak badge-ppak-gold" style="font-size: 0.65rem;">{{ $cert }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <a href="mailto:{{ $d['email'] }}" class="small text-muted text-decoration-none hover-primary">
                                    <i class="fa-regular fa-envelope me-1"></i> {{ $d['email'] }}
                                </a>
                                <span class="badge-ppak badge-ppak-navy" style="font-size: 0.65rem;">FEB UNESA</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <p>Data profil pengajar sedang dalam proses pembaruan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
