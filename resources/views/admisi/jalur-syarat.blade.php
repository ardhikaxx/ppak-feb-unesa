@extends('layouts.app')

@section('title', 'Jalur & Syarat Pendaftaran | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Informasi jalur pendaftaran dan persyaratan umum calon mahasiswa Program Studi Pendidikan Profesi Akuntan FEB UNESA melalui portal PMB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Jalur & Persyaratan Pendaftaran',
    'badge' => 'Informasi Admisi PMB UNESA',
    'lead' => 'Ketentuan umum dan dokumen yang diperlukan calon mahasiswa Program Studi Pendidikan Profesi Akuntan (Kode: 62902) FEB UNESA.',
    'breadcrumbs' => [
        ['label' => 'Admisi', 'url' => route('admisi.jalur-syarat')],
        ['label' => 'Jalur & Syarat', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Source Attribution Banner --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center p-3 rounded-3 border bg-subtle mb-5 gap-2">
            <div class="small text-secondary">
                <i class="fa-solid fa-circle-check text-success me-1"></i> Ketentuan pendaftaran mengacu pada panduan resmi <strong>Admisi UNESA</strong> untuk penerimaan program jenjang profesi.
            </div>
            <a href="https://pmb.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="small text-navy fw-semibold text-decoration-none">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Akses Portal PMB UNESA
            </a>
        </div>

        {{-- PERSYARATAN UMUM & DOKUMEN YANG DIPERLUKAN --}}
        <div class="row g-5 mb-5">
            <div class="col-lg-6">
                <div class="p-4 p-md-5 rounded-4 border bg-subtle h-100">
                    <span class="badge-ppak badge-ppak-blue mb-2">Kelayakan Pendaftar</span>
                    <h2 class="h4 text-navy mb-4">Persyaratan Umum Pendaftaran</h2>
                    <ul class="list-unstyled mb-0">
                        @foreach($admisi['persyaratan_umum'] as $syarat)
                            <li class="d-flex align-items-start gap-3 mb-3">
                                <div class="feature-icon-wrapper" style="width: 28px; height: 28px; font-size: 0.75rem; background: #ecfdf5; color: #059669; border-color: #a7f3d0;">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <span class="small text-secondary pt-1">{{ $syarat }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="p-4 p-md-5 rounded-4 border bg-subtle h-100">
                    <span class="badge-ppak badge-ppak-gold mb-2">Checklist Unggah Berkas</span>
                    <h2 class="h4 text-navy mb-4">Dokumen yang Umumnya Diperlukan</h2>
                    <p class="small text-secondary mb-3">
                        Dokumen berikut dipersiapkan dalam bentuk pindaian (scan) berkas asli untuk diunggah pada dashboard akun PMB UNESA:
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <div class="feature-icon-wrapper" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-navy small">Ijazah Sarjana (S1 / D4) Akuntansi <span class="text-danger">*wajib</span></div>
                                <div class="small text-muted">Pindaian ijazah asli atau fotokopi legalisir basah dari perguruan tinggi terakreditasi.</div>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <div class="feature-icon-wrapper" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-navy small">Transkrip Nilai Akademik <span class="text-danger">*wajib</span></div>
                                <div class="small text-muted">Pindaian transkrip nilai akademik sarjana lengkap seluruh semester.</div>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <div class="feature-icon-wrapper" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-navy small">Identitas Diri (KTP / KK) <span class="text-danger">*wajib</span></div>
                                <div class="small text-muted">Pindaian e-KTP dan Kartu Keluarga yang masih berlaku.</div>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <div class="feature-icon-wrapper" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                <i class="fa-solid fa-image"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-navy small">Pasfoto Formal Berwarna <span class="text-danger">*wajib</span></div>
                                <div class="small text-muted">Foto terbaru dengan latar belakang berwarna format JPG/PNG.</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Next step box --}}
        <div class="text-center p-4 rounded-3 border bg-white shadow-sm">
            <h3 class="fs-6 fw-bold text-navy mb-2">Pelajari Komponen Biaya & Jadwal Seleksi</h3>
            <p class="small text-secondary mb-3">Lihat rincian UKT semester atau telusuri prosedur pendaftaran melalui sistem PMB UNESA.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('admisi.biaya') }}" class="btn-ppak-primary btn-ppak-sm">
                    <i class="fa-solid fa-receipt me-1"></i>
                    <span>Informasi Biaya Pendidikan (UKT)</span>
                </a>
                <a href="{{ route('admisi.prosedur-jadwal') }}" class="btn-ppak-secondary btn-ppak-sm">
                    <i class="fa-solid fa-calendar-days me-1"></i>
                    <span>Prosedur & Jadwal Seleksi</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

