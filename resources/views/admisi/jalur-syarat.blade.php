@extends('layouts.app')

@section('title', 'Jalur & Syarat Pendaftaran | PPAk FEB UNESA')
@section('meta_description', 'Informasi jalur masuk, syarat pendaftaran akademik, dan berkas dokumen yang dibutuhkan untuk mendaftar di PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Jalur & Persyaratan Pendaftaran',
    'badge' => 'Penerimaan Mahasiswa Baru',
    'lead' => 'Pahami ketentuan umum, persyaratan akademik, serta kelengkapan berkas administratif calon mahasiswa Pendidikan Profesi Akuntansi FEB UNESA.',
    'breadcrumbs' => [
        ['label' => 'Admisi', 'url' => route('admisi.jalur-syarat')],
        ['label' => 'Jalur & Syarat', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- JALUR PENERIMAAN --}}
        <div class="mb-5">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="badge-ppak badge-ppak-blue mb-2">Pilihan Program</span>
                <h2>Jalur Penerimaan Mahasiswa Baru</h2>
                <p class="text-secondary">PPAk FEB UNESA menyediakan skema jalur masuk yang disesuaikan dengan latar belakang akademik dan profil karier calon peserta.</p>
            </div>

            <div class="row g-4">
                @foreach($admisi['jalur'] as $jalur)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-ppak-flat h-100 d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge-ppak badge-ppak-navy mb-2" style="font-size: 0.7rem;">Durasi: {{ $jalur['durasi'] }}</span>
                                <h3 class="fs-6 fw-bold text-navy mb-2">{{ $jalur['name'] }}</h3>
                                <p class="small text-secondary mb-3">{{ $jalur['desc'] }}</p>
                            </div>
                            <div class="p-3 rounded-2 bg-subtle border border-light-subtle">
                                <div class="small fw-bold text-navy mb-1" style="font-size: 0.75rem;">Sasaran Pendaftar:</div>
                                <div class="small text-muted" style="font-size: 0.775rem;">{{ $jalur['target'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- PERSYARATAN UMUM & AKADEMIK (Checklist Layout) --}}
        <div class="row g-5 mb-5">
            <div class="col-lg-6">
                <div class="p-4 p-md-5 rounded-4 border bg-subtle h-100">
                    <span class="badge-ppak badge-ppak-blue mb-2">Kelayakan Dasar</span>
                    <h3 class="h4 text-navy mb-4">Persyaratan Umum</h3>
                    <ul class="list-unstyled mb-0">
                        @foreach($admisi['syarat_umum'] as $syarat)
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
                    <span class="badge-ppak badge-ppak-gold mb-2">Dokumen Portofolio</span>
                    <h3 class="h4 text-navy mb-4">Kelengkapan Berkas</h3>
                    <ul class="list-unstyled mb-0">
                        @foreach($admisi['dokumen'] as $dok)
                            <li class="d-flex align-items-start gap-3 mb-3">
                                <div class="feature-icon-wrapper" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                    <i class="fa-solid fa-file-arrow-up"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-navy small">
                                        {{ $dok['item'] }}
                                        @if($dok['wajib'])
                                            <span class="text-danger">*wajib</span>
                                        @else
                                            <span class="text-muted fw-normal">(opsional)</span>
                                        @endif
                                    </div>
                                    <div class="small text-muted" style="font-size: 0.775rem;">{{ $dok['ket'] }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Next step box --}}
        <div class="text-center p-4 rounded-3 border bg-white shadow-sm">
            <h4 class="fs-6 fw-bold text-navy mb-2">Sudah Memenuhi Persyaratan di Atas?</h4>
            <p class="small text-secondary mb-3">Silakan cek jadwal seleksi gelombang aktif atau pelajari rincian komponen biaya pendidikan.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('admisi.prosedur-jadwal') }}" class="btn-ppak-primary btn-ppak-sm">
                    <span>Lihat Jadwal Seleksi</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
                <a href="{{ route('admisi.biaya') }}" class="btn-ppak-secondary btn-ppak-sm">
                    <span>Cek Rincian Biaya</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
