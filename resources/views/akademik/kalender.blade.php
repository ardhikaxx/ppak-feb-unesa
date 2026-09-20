@extends('layouts.app')

@section('title', 'Kalender Akademik 2026/2027 | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Kalender Akademik Universitas Negeri Surabaya Tahun Akademik 2026/2027 (Surat No. B/2322/UN38.I/TU.00.02/2026) untuk Semester Gasal dan Genap.')

@section('content')

@include('partials.page-header', [
    'title' => 'Kalender Akademik 2026/2027',
    'badge' => 'Jadwal & Agenda Resmi UNESA',
    'lead' => 'Kalender Akademik Universitas Negeri Surabaya Tahun Akademik 2026/2027 yang menjadi pedoman perkuliahan dan evaluasi studi.',
    'breadcrumbs' => [
        ['label' => 'Akademik', 'url' => route('akademik.kurikulum')],
        ['label' => 'Kalender Akademik', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Formal SK Decree Header --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle mb-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-2">Dokumen Resmi Penetapan</span>
                    <h2 class="h4 text-navy fw-bold mb-1">
                        <i class="fa-regular fa-calendar-days text-primary me-2"></i>Kalender Akademik Universitas Negeri Surabaya 2026/2027
                    </h2>
                    <p class="small text-secondary mb-1">
                        Ditetapkan melalui <strong>Surat Nomor B/2322/UN38.I/TU.00.02/2026</strong> tanggal <strong>6 Januari 2026</strong> oleh Direktorat Pendidikan dan Transformasi Pembelajaran UNESA.
                    </p>
                    <div class="small text-muted">
                        <i class="fa-solid fa-circle-info text-primary me-1"></i> Seluruh kegiatan perkuliahan, registrasi, evaluasi, dan yudisium program studi profesi mengacu pada kalender akademik universitas.
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('kontak.unduhan') }}" class="btn-ppak-primary btn-ppak-sm">
                        <i class="fa-solid fa-download me-1"></i>
                        <span>Unduh Kalender Resmi (PDF)</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-5">
            {{-- Semester Gasal --}}
            <div class="col-lg-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                        <div>
                            <h3 class="h5 text-navy fw-bold mb-0">Semester Gasal 2026/2027</h3>
                            <div class="small text-muted">{{ $kalender['gasal']['periode'] ?? '1 Agustus 2026 – 31 Januari 2027' }}</div>
                        </div>
                        <span class="badge-ppak badge-ppak-blue">Semester I</span>
                    </div>

                    <div class="stepper-container">
                        @foreach($kalender['gasal']['agenda'] as $item)
                            <div class="stepper-item">
                                <div class="stepper-circle" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </div>
                                <div class="stepper-content py-2 px-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-bold text-primary">{{ $item['tanggal'] }}</span>
                                        <span class="badge-ppak badge-ppak-navy" style="font-size: 0.65rem;">
                                            {{ $item['kategori'] }}
                                        </span>
                                    </div>
                                    <div class="fw-semibold text-navy small">{{ $item['kegiatan'] }}</div>
                                </div>
                                <div class="stepper-line" style="left: 15px; top: 32px;"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Semester Genap --}}
            <div class="col-lg-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                        <div>
                            <h3 class="h5 text-navy fw-bold mb-0">Semester Genap 2026/2027</h3>
                            <div class="small text-muted">{{ $kalender['genap']['periode'] ?? '1 Februari 2027 – 31 Juli 2027' }}</div>
                        </div>
                        <span class="badge-ppak badge-ppak-gold">Semester II</span>
                    </div>

                    <div class="stepper-container">
                        @foreach($kalender['genap']['agenda'] as $item)
                            <div class="stepper-item">
                                <div class="stepper-circle" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </div>
                                <div class="stepper-content py-2 px-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-bold text-primary">{{ $item['tanggal'] }}</span>
                                        <span class="badge-ppak badge-ppak-gold" style="font-size: 0.65rem;">
                                            {{ $item['kategori'] }}
                                        </span>
                                    </div>
                                    <div class="fw-semibold text-navy small">{{ $item['kegiatan'] }}</div>
                                </div>
                                <div class="stepper-line" style="left: 15px; top: 32px;"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

