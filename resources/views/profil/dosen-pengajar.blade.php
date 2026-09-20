@extends('layouts.app')

@section('title', 'Profil Dosen & Pengajar | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Daftar dosen dan tenaga pengajar mata kuliah Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

<x-page-header :title="$pg['header_title']['heading'] ?? 'Profil Dosen & Pengajar'" :badge="$pg['header_badge']['heading'] ?? 'Tenaga Pengajar Terverifikasi'" :lead="$pg['header_lead']['body'] ?? 'Daftar dosen aktif dan pengajar mata kuliah Program Studi Pendidikan Profesi Akuntan FEB UNESA yang tercatat pada sistem penugasan akademik SINDIG UNESA.'" :breadcrumbs="[
    ['label' => 'Profil', 'url' => route('profil.sejarah')],
    ['label' => 'Dosen & Pengajar', 'url' => '']
]" />

<section class="section-py bg-white">
    <div class="container">
        {{-- Source Info Notice --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center p-3 rounded-3 border bg-subtle mb-4 gap-2">
            <div class="small text-secondary">
                <i class="fa-solid fa-circle-check text-success me-1"></i> Data pengajar mata kuliah dihimpun berdasarkan catatan penugasan kurikulum pada <strong>SINDIG UNESA</strong> dan Pangkalan Data Dosen UNESA.
            </div>
            <div class="small text-muted">
                <i class="fa-solid fa-database me-1"></i> Sumber: SINDIG UNESA (Prodi 62902)
            </div>
        </div>

        {{-- Server-side category filter --}}
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mb-5">
            <a href="{{ route('profil.dosen-pengajar', ['kategori' => 'all']) }}" class="btn-{{ request('kategori', 'all')==='all' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Semua Pengajar ({{ $dosen->total() }})</a>
            <a href="{{ route('profil.dosen-pengajar', ['kategori' => 'auditing']) }}" class="btn-{{ request('kategori')==='auditing' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Auditing & GRC</a>
            <a href="{{ route('profil.dosen-pengajar', ['kategori' => 'keuangan']) }}" class="btn-{{ request('kategori')==='keuangan' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Akuntansi Keuangan & Stratejik</a>
            <a href="{{ route('profil.dosen-pengajar', ['kategori' => 'manajemen']) }}" class="btn-{{ request('kategori')==='manajemen' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Manajemen & Perpajakan</a>
        </div>

        <div class="row g-4" id="dosenGridContainer">
            @forelse($dosen as $d)
                <div class="col-lg-6 col-md-6">
                    <div class="dosen-card h-100 bg-white border shadow-sm p-3 rounded-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-sm-4 text-center">
                                <div class="dosen-photo-wrapper mx-auto" style="width: 130px; height: 140px; border-radius: 12px; overflow: hidden;">
                                    <img src="{{ $d['image'] }}" alt="{{ $d['name'] }}" class="dosen-photo w-100 h-100" loading="lazy" style="object-fit:cover;">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                    <span class="badge-ppak badge-ppak-navy" style="font-size:0.65rem;">{{ $d['category_label'] }}</span>
                                    <span class="badge-ppak badge-ppak-gold" style="font-size:0.65rem;">{{ $d['status_label'] ?? $d['role'] }}</span>
                                </div>
                                <h3 class="h6 text-navy fw-bold mb-1">{{ $d['name'] }}</h3>
                                <div class="small text-muted mb-2">{{ $d['gelar'] }}</div>
                                <div class="small text-secondary mb-2" style="font-size:0.8rem;">
                                    <strong>Mata Kuliah Diampu:</strong>
                                    <div class="text-navy">{{ implode(', ', $d['matkul'] ?? []) }}</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                    <a href="mailto:{{ $d['email'] }}" class="small text-muted text-decoration-none">
                                        <i class="fa-regular fa-envelope me-1 text-primary"></i> {{ $d['email'] }}
                                    </a>
                                    <span class="badge bg-light text-secondary border" style="font-size: 0.65rem;">FEB UNESA</span>
                                </div>
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

        {{-- Numbers-only pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $dosen->withQueryString()->links('vendor.pagination.numbers') }}
        </div>
    </div>
</section>

@endsection

