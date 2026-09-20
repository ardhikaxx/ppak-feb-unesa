@extends('layouts.app')

@section('title', 'Akreditasi & Sertifikasi Mutu | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Status legalitas dan keputusan akreditasi resmi LAMEMBA Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => 'Akreditasi & Sertifikasi Mutu',
    'badge' => 'Legalitas & Penjaminan Mutu',
    'lead' => 'Dokumentasi ketetapan akreditasi resmi dari Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi (LAMEMBA).',
    'breadcrumbs' => [
        ['label' => 'Profil', 'url' => route('profil.sejarah')],
        ['label' => 'Akreditasi', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Formal Accreditation Badge Card --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle mb-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-4 text-center">
                    <div class="p-4 bg-white rounded-3 border shadow-sm d-inline-block w-100" style="max-width: 320px;">
                        <div class="navbar-brand-emblem mx-auto mb-3" style="width: 72px; height: 72px; font-size: 1.8rem;">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <h3 class="h4 text-navy fw-bold mb-1">{{ $accreditation?->agency ?? 'LAMEMBA' }}</h3>
                        <div class="text-muted small mb-3">Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis & Akuntansi</div>
                        <div class="badge-ppak badge-ppak-gold fs-6 px-3 py-2 w-100 justify-content-center mb-2">
                            Peringkat: {{ $accreditation?->status ?? 'Baik' }}
                        </div>
                        <span class="badge-ppak badge-ppak-green px-3 py-1">
                            <i class="fa-solid fa-circle-check me-1"></i> Status: Aktif
                        </span>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                        <span class="badge-ppak badge-ppak-navy">SK {{ $accreditation?->agency ?? 'LAMEMBA' }}</span>
                        <span class="badge-ppak badge-ppak-blue">Periode {{ $accreditation?->effective_from?->format('Y') ?? '2025' }}–{{ $accreditation?->effective_until?->format('Y') ?? '2027' }}</span>
                    </div>
                    <h2 class="h3 text-navy mb-3">Status Akreditasi Resmi: {{ $accreditation?->status ?? 'Baik' }}</h2>
                    <p class="text-secondary mb-4">
                        Program Studi {{ $accreditation?->program_name ?? 'Pendidikan Profesi Akuntan' }} (Kode Prodi: <strong>62902</strong>) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya telah terakreditasi dengan peringkat <strong>{{ $accreditation?->status ?? 'Baik' }}</strong> berdasarkan Surat Keputusan Dewan Eksekutif {{ $accreditation?->agency ?? 'LAMEMBA' }}.
                    </p>

                    <div class="table-ppak-wrapper mb-4">
                        <table class="table-ppak">
                            <tbody>
                                <tr>
                                    <th style="width: 35%;">Nama Program Studi</th>
                                    <td><strong>{{ $accreditation?->program_name ?? 'Pendidikan Profesi Akuntan' }}</strong> (Kode: 62902)</td>
                                </tr>
                                <tr>
                                    <th>Status Peringkat</th>
                                    <td><span class="badge-ppak badge-ppak-gold">{{ $accreditation?->status ?? 'Baik' }}</span></td>
                                </tr>
                                <tr>
                                    <th>Lembaga Akreditasi</th>
                                    <td>Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi ({{ $accreditation?->agency ?? 'LAMEMBA' }})</td>
                                </tr>
                                <tr>
                                    <th>Nomor Keputusan</th>
                                    <td><code class="fw-bold">{{ $accreditation?->decree_number ?? '611/DE/A.5/AR.11/II/2025' }}</code></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Penetapan</th>
                                    <td>{{ $accreditation?->decree_date ? \App\Support\Tanggal::indo($accreditation->decree_date) : '26 Februari 2025' }}</td>
                                </tr>
                                <tr>
                                    <th>Masa Berlaku</th>
                                    <td>{{ $accreditation?->effective_from ? \App\Support\Tanggal::indo($accreditation->effective_from) : '26 Februari 2025' }} s.d. <strong>{{ $accreditation?->effective_until ? \App\Support\Tanggal::indo($accreditation->effective_until) : '25 Februari 2027' }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Expiry / Period Notice --}}
                    <div class="p-3 rounded-3 border bg-white mb-4">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fa-solid fa-clock-rotate-left text-warning fs-5 mt-1"></i>
                            <div class="small">
                                <div class="fw-bold text-navy">Periode Masa Berlaku Akreditasi:</div>
                                <div class="text-secondary">Akreditasi berlaku aktif hingga <strong>{{ $accreditation?->effective_until ? \App\Support\Tanggal::indo($accreditation->effective_until) : '25 Februari 2027' }}</strong>. Unit Penjaminan Mutu FEB UNESA dan Gugus Penjaminan Mutu secara berkala memantau pemenuhan standar mutu instrumen akreditasi program studi.</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="https://simutu.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
                            <span>Lihat Data Akreditasi (SIMUTU UNESA)</span>
                        </a>
                        <a href="{{ route('kontak.unduhan') }}" class="btn-ppak-secondary">
                            <i class="fa-solid fa-download me-1"></i>
                            <span>Unduhan Dokumen SK</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Landasan Mutu & Tata Kelola Standar --}}
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Penjaminan Mutu Internal (SPMI)</h3>
                    <p class="small text-secondary mb-0">
                        Evaluasi proses pembelajaran, pemenuhan Capaian Pembelajaran Lulusan (CPL), serta kualifikasi penugasan dosen pengampu mata kuliah dimonitor secara terstruktur oleh Badan Penjaminan Mutu UNESA.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Standar Pembelajaran Profesi</h3>
                    <p class="small text-secondary mb-0">
                        Kurikulum Pendidikan Profesi Akuntan dirancang memenuhi standar kurikulum pendidikan tinggi jenjang profesi (Level 7 KKNI) yang berorientasi pada penguasaan kompetensi keprofesian akuntan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
