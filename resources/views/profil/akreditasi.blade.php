@extends('layouts.app')

@section('title', 'Akreditasi & Sertifikasi | PPAk FEB UNESA')
@section('meta_description', 'Status legalitas dan sertifikat akreditasi resmi Program Pendidikan Profesi Akuntansi Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => 'Akreditasi & Sertifikasi Mutu',
    'badge' => 'Legalitas & Jaminan Kualitas',
    'lead' => 'Dokumentasi resmi akreditasi program studi dari lembaga independen penjaminan mutu pendidikan tinggi ekonomi dan akuntansi.',
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
                        <h3 class="h4 text-navy fw-bold mb-1">LAMEMBA</h3>
                        <div class="text-muted small mb-3">Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis & Akuntansi</div>
                        <div class="badge-ppak badge-ppak-gold fs-6 px-3 py-2 w-100 justify-content-center">
                            Terakreditasi Baik Sekali
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <span class="badge-ppak badge-ppak-blue mb-2">Sertifikasi Resmi</span>
                    <h2 class="h3 text-navy mb-3">Jaminan Mutu Pendidikan Profesi Akuntansi</h2>
                    <p class="text-secondary mb-4">
                        Pendidikan Profesi Akuntansi FEB UNESA menyelenggarakan perkuliahan sesuai dengan kriteria baku penjaminan mutu yang ditetapkan oleh LAMEMBA dan Kementerian Pendidikan Tinggi. Status akreditasi ini mencerminkan komitmen terhadap kurikulum yang relevan, rasio dosen-mahasiswa yang ideal, fasilitas komputasi yang memadai, serta luaran penelitian dan kepuasan pemangku kepentingan.
                    </p>

                    <div class="table-ppak-wrapper mb-4">
                        <table class="table-ppak">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">Status Peringkat</th>
                                    <td><span class="badge-ppak badge-ppak-gold">Terakreditasi Baik Sekali</span></td>
                                </tr>
                                <tr>
                                    <th>Nomor Keputusan SK</th>
                                    <td><code>{{ $info['sk_akreditasi'] }}</code></td>
                                </tr>
                                <tr>
                                    <th>Lembaga Pengakreditasi</th>
                                    <td>Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi (LAMEMBA)</td>
                                </tr>
                                <tr>
                                    <th>Masa Berlaku Akreditasi</th>
                                    <td>{{ $info['masa_berlaku'] }}</td>
                                </tr>
                                <tr>
                                    <th>Gelar / Sebutan Lulusan</th>
                                    <td><strong>Akuntan (Ak.)</strong> &bull; Beregister Negara (RNA Kemenkeu)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <a href="{{ route('kontak.unduhan') }}" class="btn-ppak-primary">
                            <i class="fa-solid fa-download me-1"></i>
                            <span>Unduh Salinan Sertifikat Akreditasi (PDF)</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Asosiasi & Sertifikasi Pendukung --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h4 class="fs-6 fw-bold text-navy mb-2">Ikatan Akuntan Indonesia (IAI)</h4>
                    <p class="small text-secondary mb-0">
                        Kurikulum telah ditelaah dan memperoleh pengakuan waiver ujian sertifikasi Chartered Accountant (CA) tingkat profesi dari IAI.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-file-shield"></i>
                    </div>
                    <h4 class="fs-6 fw-bold text-navy mb-2">Institut Akuntan Publik Indonesia</h4>
                    <p class="small text-secondary mb-0">
                        Penyelarasan standar kompetensi audit berbasis Standar Profesional Akuntan Publik (SPAP) dan persiapan sertifikasi CPA.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h4 class="fs-6 fw-bold text-navy mb-2">Kementerian Keuangan RI</h4>
                    <p class="small text-secondary mb-0">
                        Lulusan berhak mengajukan permohonan Register Negara Akuntan (RNA) pada Pusat Pembinaan Profesi Keuangan (PPPK) Kemenkeu.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
