@extends('layouts.app')

@section('title', 'Kerja Sama & Mitra Strategis | PPAk FEB UNESA')
@section('meta_description', 'Jejaring kerja sama strategis PPAk FEB UNESA bersama Kantor Akuntan Publik, BPK, OJK, DJP, IAI, dan korporasi multinasional.')

@section('content')

@include('partials.page-header', [
    'title' => 'Kerja Sama & Mitra Strategis',
    'badge' => 'Jejaring Kolaboratif',
    'lead' => 'Kemitraan institusional yang kokoh dalam mendukung pengembangan kurikulum terpadu, penyaluran magang kerja, dan sertifikasi profesi akuntan.',
    'breadcrumbs' => [
        ['label' => 'Riset & Pengabdian', 'url' => route('riset-pengabdian.riset-publikasi')],
        ['label' => 'Kerja Sama & Mitra', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Section Introduction --}}
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-blue mb-2">Ekosistem Kemitraan</span>
            <h2>Mitra Penyelenggaraan Pendidikan Profesi</h2>
            <p class="text-secondary">
                Kolaborasi yang dibangun memberikan nilai tambah konkret bagi mahasiswa dalam mengakselerasi kesiapan karier profesional mereka.
            </p>
        </div>

        {{-- Grid of Partners --}}
        <div class="row g-4 mb-5">
            @foreach($mitra as $m)
                <div class="col-lg-6">
                    <div class="card-ppak-flat h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge-ppak badge-ppak-navy" style="font-size: 0.7rem;">{{ $m['category'] }}</span>
                                <span class="badge-ppak badge-ppak-green" style="font-size: 0.65rem;"><i class="fa-solid fa-circle me-1" style="font-size: 0.4rem;"></i>Aktif</span>
                            </div>
                            <h3 class="fs-6 fw-bold text-navy mb-2">{{ $m['name'] }}</h3>
                            <div class="small fw-semibold text-primary mb-2">
                                <i class="fa-solid fa-handshake-angle me-1"></i> {{ $m['type'] }}
                            </div>
                            <p class="small text-secondary mb-0" style="line-height: 1.6;">
                                {{ $m['desc'] }}
                            </p>
                        </div>
                        <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                            <span class="small text-muted" style="font-size: 0.75rem;">Periode MoU: 2023 - 2028 [Terdaftar di Kerja Sama UNESA]</span>
                            <span class="badge-ppak badge-ppak-blue" style="font-size: 0.65rem;">Mitra Resmi</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Join Partnership Callout --}}
        <div class="p-4 p-md-5 rounded-4 border bg-subtle text-center">
            <h4 class="fs-6 fw-bold text-navy mb-2">Inisiasi Kerja Sama Lembaga & Industri</h4>
            <p class="small text-secondary mb-4 max-w-700 mx-auto">
                PPAk FEB UNESA menyambut baik kolaborasi bersama Kantor Akuntan Publik, korporasi perbankan, BUMN, maupun lembaga sertifikasi profesional dalam program rekrutmen talenta, riset asurans, atau penyelenggaraan kelas in-house training.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-primary btn-ppak-sm">
                    <i class="fa-solid fa-envelope me-1"></i>
                    <span>Ajukan Nota Kesepahaman (MoU)</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
