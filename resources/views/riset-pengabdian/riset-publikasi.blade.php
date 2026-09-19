@extends('layouts.app')

@section('title', 'Riset & Publikasi Dosen | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Publikasi ilmiah dan karya pengabdian dosen pengajar Program Studi Pendidikan Profesi Akuntan FEB UNESA terindeks pangkalan data resmi.')

@section('content')

@include('partials.page-header', [
    'title' => 'Riset & Publikasi Ilmiah',
    'badge' => 'Karya Dosen Pengajar',
    'lead' => 'Daftar publikasi artikel ilmiah dan kegiatan ilmiah dosen pengajar Program Studi Pendidikan Profesi Akuntan FEB UNESA yang tercatat pada database resmi.',
    'breadcrumbs' => [
        ['label' => 'Riset & Pengabdian', 'url' => route('riset-pengabdian.riset-publikasi')],
        ['label' => 'Riset & Publikasi', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Source Attribution Notice --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center p-3 rounded-3 border bg-subtle mb-5 gap-2">
            <div class="small text-secondary">
                <i class="fa-solid fa-circle-check text-success me-1"></i> Data publikasi ilmiah dihimpun dari pangkalan data <strong>SINTA Kemendikbudristek</strong> dan repositori publikasi dosen Universitas Negeri Surabaya.
            </div>
            <a href="https://sinta.kemdikbud.go.id" target="_blank" rel="noopener noreferrer" class="small text-navy fw-semibold text-decoration-none">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Portal SINTA
            </a>
        </div>

        {{-- DAFTAR PUBLIKASI DOSEN --}}
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-1">Publikasi Terverifikasi</span>
                    <h2 class="h4 text-navy mb-0">Publikasi Dosen Pengajar (Periode 2026)</h2>
                </div>
                <span class="badge-ppak badge-ppak-navy">{{ count($riset) }} Publikasi</span>
            </div>

            <div class="row g-4">
                @foreach($riset as $item)
                    <div class="col-lg-12">
                        <div class="p-4 rounded-4 border bg-white shadow-sm">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-3">
                                <div>
                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                        <span class="badge-ppak badge-ppak-navy">{{ $item['kategori'] ?? 'Publikasi Dosen PPAk/FEB' }}</span>
                                        <span class="badge-ppak badge-ppak-gold">Tahun {{ $item['tahun'] ?? '2026' }}</span>
                                        <span class="small text-muted"><i class="fa-regular fa-calendar me-1"></i> {{ $item['tanggal'] ?? '12 Februari 2026' }}</span>
                                    </div>
                                    <h3 class="h5 text-navy fw-bold mb-2">{{ $item['judul'] ?? $item['title'] }}</h3>
                                    <div class="small text-secondary mb-2">
                                        <i class="fa-solid fa-user-pen me-1 text-primary"></i> Penulis: <strong>{{ $item['penulis'] ?? $item['peneliti'] }}</strong>
                                    </div>
                                    <div class="small text-muted mb-3">
                                        <i class="fa-solid fa-book-bookmark me-1 text-gold"></i> Media / Jurnal: {{ $item['jurnal'] }} &bull; <span class="text-success">{{ $item['sitasi'] ?? 'Terindeks SINTA' }}</span>
                                    </div>
                                    <p class="small text-secondary mb-0" style="line-height: 1.65;">
                                        {{ $item['deskripsi'] ?? $item['abstrak'] }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-md-end">
                                    <a href="{{ $item['sinta_url'] ?? 'https://sinta.kemdikbud.go.id' }}" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary btn-ppak-sm text-nowrap">
                                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
                                        <span>Profil Peneliti SINTA</span>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3 pt-2 border-top">
                                <small class="text-muted">
                                    <i class="fa-solid fa-database me-1"></i> Sumber: {{ $item['source'] ?? 'SINTA & Database Dosen UNESA' }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
