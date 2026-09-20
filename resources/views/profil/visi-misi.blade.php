@extends('layouts.app')

@section('title', 'Visi, Misi & Tujuan | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Informasi Visi, Misi, dan Tujuan Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => $pg['header_title']['heading'] ?? 'Visi, Misi & Tujuan',
    'badge' => $pg['header_badge']['heading'] ?? 'Arah & Komitmen Mutu',
    'lead' => $pg['header_lead']['body'] ?? 'Komitmen penyelenggaraan Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.',
    'breadcrumbs' => [
        ['label' => 'Profil', 'url' => route('profil.sejarah')],
        ['label' => 'Visi, Misi & Tujuan', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Status Notice Card --}}
        <div class="mb-5 p-4 p-lg-5 rounded-4 bg-subtle border">
            <div class="d-flex align-items-start gap-4">
                <div class="feature-icon-wrapper flex-shrink-0" style="width: 54px; height: 54px; font-size: 1.5rem;">
                    <i class="fa-solid fa-arrows-rotate text-navy"></i>
                </div>
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-2">Status Informasi Resmi</span>
                    <h2 class="h3 text-navy mb-2">{{ $pg['notice_heading']['heading'] ?? 'Informasi Visi, Misi, dan Tujuan Program Sedang Diperbarui' }}</h2>
                    <div class="golden-line"></div>
                    {!! $pg['notice_body']['body'] ?? '<p class="text-secondary mb-3" style="line-height: 1.7;">Berdasarkan pangkalan data SINDIG UNESA, naskah rumusan definitif visi, misi, dan tujuan spesifik Program Studi Pendidikan Profesi Akuntan (Kode Prodi: <strong>62902</strong>) saat ini berada dalam tahapan finalisasi penjaminan mutu kelembagaan seiring proses penguatan tata kelola program profesi baru yang tercatat berdiri pada <strong>23 Mei 2025</strong>.</p>' !!}
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted mb-1">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i> {{ $pg['policy_heading']['heading'] ?? 'Kebijakan Transparansi Informasi Akademik:' }}
                        </div>
                        {!! $pg['policy_body']['body'] ?? '<div class="small text-secondary">Program studi berkomitmen menyajikan informasi faktual yang bersumber langsung dari dokumen resmi kelembagaan PPAk FEB UNESA dan tidak menduplikasi visi-misi program studi sarjana maupun magister lainnya.</div>' !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- Landasan Penyelenggaraan Pendidikan Profesi --}}
        <div class="row g-4 mb-5">
            <div class="col-lg-4">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">{{ $pg['pilar_1_heading']['heading'] ?? 'Pilar Kurikulum SINDIG' }}</h3>
                    {!! $pg['pilar_1_body']['body'] ?? '<p class="small text-secondary mb-0">Penyelenggaraan akademik berpedoman pada kurikulum 11 mata kuliah terpadu dan paket magang industri yang telah tercatat resmi pada sistem SINDIG UNESA.</p>' !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">{{ $pg['pilar_2_heading']['heading'] ?? 'Akreditasi LAMEMBA' }}</h3>
                    {!! $pg['pilar_2_body']['body'] ?? '<p class="small text-secondary mb-0">Telah memperoleh status akreditasi <strong>Baik</strong> berdasarkan Keputusan LAMEMBA No. 611/DE/A.5/AR.11/II/2025 dengan masa berlaku 2025–2027.</p>' !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">{{ $pg['pilar_3_heading']['heading'] ?? 'Standar Profesi IAI & IAPI' }}</h3>
                    {!! $pg['pilar_3_body']['body'] ?? '<p class="small text-secondary mb-0">Pembelajaran diarahkan pada pencapaian kompetensi standar keprofesian akuntan (Chartered Accountant & Certified Public Accountant of Indonesia).</p>' !!}
                </div>
            </div>
        </div>

        {{-- Hubungi Sekretariat --}}
        <div class="p-4 rounded-3 border bg-subtle text-center">
            <h4 class="fs-6 fw-bold text-navy mb-1">{{ $pg['cta_heading']['heading'] ?? 'Informasi Lebih Lanjut Mengenai Dokumen Akademik' }}</h4>
            {!! $pg['cta_body']['body'] ?? '<p class="small text-secondary mb-3">Untuk permintaan salinan naskah akademik atau konsultasi program, silakan menghubungi sekretariat program studi.</p>' !!}
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('akademik.kurikulum') }}" class="btn-ppak-primary btn-ppak-sm">
                    <span>Lihat Kurikulum Resmi</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
                <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-secondary btn-ppak-sm">
                    <span>Hubungi Sekretariat</span>
                    <i class="fa-solid fa-envelope ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

