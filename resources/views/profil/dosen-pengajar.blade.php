@extends('layouts.app')

@section('title', 'Profil Dosen & Pengajar | PPAk FEB UNESA')
@section('meta_description', 'Daftar dosen akademisi dan praktisi pengajar Program Pendidikan Profesi Akuntansi Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

<x-page-header title="Profil Dosen & Pengajar" badge="Tenaga Pendidik Profesional" lead="Kombinasi pendidik bergelar doktor/profesor dan praktisi senior pemegang sertifikasi profesi CA, CPA, BKP, dan CFE yang berpengalaman luas." :breadcrumbs="[
    ['label' => 'Profil', 'url' => route('profil.sejarah')],
    ['label' => 'Dosen & Pengajar', 'url' => '']
]" />

<section class="section-py bg-white">
    <div class="container">
        {{-- Server-side category filter - scalable, bookmarkable, no JS needed for large datasets --}}
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mb-5">
            <a href="{{ route('profil.dosen-pengajar', ['kategori' => 'all']) }}" class="btn-{{ request('kategori', 'all')==='all' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Semua Bidang ({{ $dosen->total() }})</a>
            <a href="{{ route('profil.dosen-pengajar', ['kategori' => 'auditing']) }}" class="btn-{{ request('kategori')==='auditing' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Auditing & Asurans</a>
            <a href="{{ route('profil.dosen-pengajar', ['kategori' => 'keuangan']) }}" class="btn-{{ request('kategori')==='keuangan' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Akuntansi Keuangan & IFRS</a>
            <a href="{{ route('profil.dosen-pengajar', ['kategori' => 'perpajakan']) }}" class="btn-{{ request('kategori')==='perpajakan' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Perpajakan</a>
            <a href="{{ route('profil.dosen-pengajar', ['kategori' => 'manajemen']) }}" class="btn-{{ request('kategori')==='manajemen' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Manajemen & Analitika Data</a>
        </div>

        <div class="row g-4" id="dosenGridContainer">
            @forelse($dosen as $d)
                <div class="col-lg-4 col-md-6">
                    <div class="dosen-card h-100">
                        <div class="dosen-photo-wrapper">
                            <img src="{{ $d['image'] }}" alt="{{ $d['name'] }}" class="dosen-photo" loading="lazy" width="400" height="420" style="aspect-ratio:1/1.05; object-fit:cover;">
                        </div>
                        <div class="dosen-info">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <x-badge variant="blue" style="font-size:0.7rem;">{{ $d['category_label'] }}</x-badge>
                                <span class="text-muted" style="font-size:0.725rem;">NIDN: [Terverifikasi]</span>
                            </div>
                            <h3 class="dosen-name">{{ $d['name'] }}</h3>
                            <div class="dosen-gelar mb-2">{{ $d['gelar'] }}</div>
                            <div class="dosen-role mb-3">{{ $d['role'] }}</div>
                            <div class="mb-3">
                                <div class="small fw-bold text-navy mb-1" style="font-size:0.785rem;">Bidang Keahlian:</div>
                                <p class="small text-secondary mb-0" style="line-height:1.5;">{{ $d['bidang'] }}</p>
                            </div>
                            @if(!empty($d['sertifikasi']))
                                <div class="mb-3">
                                    <div class="small fw-bold text-navy mb-1" style="font-size:0.785rem;">Sertifikasi Profesi:</div>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($d['sertifikasi'] as $cert)
                                            <x-badge variant="gold" style="font-size:0.65rem;">{{ $cert }}</x-badge>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <a href="mailto:{{ $d['email'] }}" class="small text-muted text-decoration-none">
                                    <i class="fa-regular fa-envelope me-1"></i> {{ $d['email'] }}
                                </a>
                                <x-badge variant="navy" style="font-size:0.65rem;">FEB UNESA</x-badge>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <x-empty-state title="Belum ada pengajar" message="Data profil pengajar untuk kategori ini belum tersedia." icon="fa-user-tie" />
                </div>
            @endforelse
        </div>

        <nav aria-label="Navigasi Dosen" class="d-flex justify-content-center mt-5">
            {{ $dosen->withQueryString()->links('pagination::bootstrap-5') }}
        </nav>
    </div>
</section>

@endsection
