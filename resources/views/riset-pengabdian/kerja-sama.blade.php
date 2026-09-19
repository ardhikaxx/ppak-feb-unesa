@extends('layouts.app')

@section('title', 'Jejaring & Kerja Sama | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Informasi jejaring kemitraan kelembagaan dan tata kelola kerja sama Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => 'Jejaring & Kerja Sama',
    'badge' => 'Kemitraan Kelembagaan',
    'lead' => 'Inisiasi dan tata kelola kemitraan strategis Program Studi Pendidikan Profesi Akuntan di lingkungan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.',
    'breadcrumbs' => [
        ['label' => 'Riset & Pengabdian', 'url' => route('riset-pengabdian.riset-publikasi')],
        ['label' => 'Kerja Sama & Mitra', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Status Notification Card --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle mb-5">
            <div class="d-flex align-items-start gap-4">
                <div class="feature-icon-wrapper flex-shrink-0" style="width: 52px; height: 52px; font-size: 1.4rem;">
                    <i class="fa-solid fa-handshake text-navy"></i>
                </div>
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-2">PENGELOLAAN KERJA SAMA RESMI</span>
                    <h2 class="h4 text-navy fw-bold mb-2">Jejaring & Kemitraan Program Studi</h2>
                    <p class="text-secondary small mb-3" style="line-height: 1.7;">
                        Program Studi Pendidikan Profesi Akuntan (tercatat berdiri pada 23 Mei 2025) secara bertahap memproses dan memperbarui pencatatan dokumen nota kesepahaman (MoU / MoA) kemitraan formal di bidang pendidikan profesi, magang praktik industri, dan sertifikasi keahlian.
                    </p>
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i> Data kerja sama resmi yang telah selesai ditandatangani dan terverifikasi pada Unit Kerja Sama FEB UNESA akan ditampilkan secara terstruktur melalui modul CMS pada halaman ini.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CMS Ready Items or Planned Spheres --}}
        @if(!empty($mitra['items']))
            <div class="row g-4 mb-5">
                @foreach($mitra['items'] as $m)
                    <div class="col-lg-6">
                        <div class="card-ppak-flat h-100">
                            <span class="badge-ppak badge-ppak-navy mb-2">{{ $m['category'] ?? 'Mitra' }}</span>
                            <h3 class="fs-6 fw-bold text-navy mb-1">{{ $m['name'] }}</h3>
                            <p class="small text-secondary mb-0">{{ $m['description'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-2">Kantor Akuntan Publik (KAP)</h3>
                        <p class="small text-secondary mb-0">Kerja sama penempatan magang praktik kerja profesi audit dan asurans bagi mahasiswa.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3">
                            <i class="fa-solid fa-certificate"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-2">Organisasi Profesi (IAI & IAPI)</h3>
                        <p class="small text-secondary mb-0">Penyelarasan kurikulum pembelajaran dengan standar silabus ujian sertifikasi profesi akuntan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-2">Instansi Pemerintah & BUMN</h3>
                        <p class="small text-secondary mb-0">Kolaborasi peningkatan kompetensi tata kelola keuangan, audit sektor publik, dan perpajakan.</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Inisiasi Kerja Sama Callout --}}
        <div class="p-4 p-md-5 rounded-4 border bg-subtle text-center">
            <h3 class="fs-6 fw-bold text-navy mb-2">Inisiasi Kerja Sama Lembaga & Industri</h3>
            <p class="small text-secondary mb-4 max-w-700 mx-auto">
                Fakultas Ekonomika dan Bisnis UNESA menyambut baik inisiatif kerja sama institusional bersama Kantor Akuntan Publik, lembaga pemerintah, konsultan perpajakan, dan dunia usaha.
            </p>
            <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-primary btn-ppak-sm">
                <i class="fa-solid fa-envelope me-1"></i>
                <span>Ajukan Inisiasi Kemitraan</span>
            </a>
        </div>
    </div>
</section>

@endsection
