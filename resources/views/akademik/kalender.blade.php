@extends('layouts.app')

@section('title', 'Kalender Akademik | PPAk FEB UNESA')
@section('meta_description', 'Jadwal dan kalender akademik Semester Gasal dan Genap Program Pendidikan Profesi Akuntansi FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Kalender Akademik 2024/2025',
    'badge' => 'Jadwal & Agenda Studi',
    'lead' => 'Rangkaian jadwal registrasi, perkuliahan tatap muka & praktika, ujian semester, hingga seremoni yudisium profesi.',
    'breadcrumbs' => [
        ['label' => 'Akademik', 'url' => route('akademik.kurikulum')],
        ['label' => 'Kalender Akademik', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Action bar --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center p-4 rounded-3 border bg-subtle mb-5 gap-3">
            <div>
                <h3 class="fs-6 fw-bold text-navy mb-1"><i class="fa-regular fa-calendar-days text-primary me-2"></i>Tahun Akademik 2024/2025</h3>
                <p class="small text-secondary mb-0">Kalender resmi berlaku untuk program kelas reguler dan kelas eksekutif akhir pekan.</p>
            </div>
            <div>
                <a href="{{ route('kontak.unduhan') }}" class="btn-ppak-primary btn-ppak-sm">
                    <i class="fa-solid fa-download me-1"></i>
                    <span>Unduh Kalender Resmi (PDF)</span>
                </a>
            </div>
        </div>

        <div class="row g-5">
            {{-- Semester Gasal --}}
            <div class="col-lg-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                        <h4 class="h5 text-navy fw-bold mb-0">Semester Gasal (Ganjil)</h4>
                        <span class="badge-ppak badge-ppak-blue">Semester I</span>
                    </div>

                    <div class="stepper-container">
                        @foreach($kalender['semester_gasal'] as $item)
                            <div class="stepper-item">
                                <div class="stepper-circle" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <div class="stepper-content py-2 px-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-bold text-primary">{{ $item['tanggal'] }}</span>
                                        <span class="badge-ppak {{ $item['status'] === 'Selesai' ? 'badge-ppak-navy' : 'badge-ppak-green' }}" style="font-size: 0.65rem;">
                                            {{ $item['status'] }}
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
                        <h4 class="h5 text-navy fw-bold mb-0">Semester Genap</h4>
                        <span class="badge-ppak badge-ppak-gold">Semester II</span>
                    </div>

                    <div class="stepper-container">
                        @foreach($kalender['semester_genap'] as $item)
                            <div class="stepper-item">
                                <div class="stepper-circle" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <div class="stepper-content py-2 px-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-bold text-primary">{{ $item['tanggal'] }}</span>
                                        <span class="badge-ppak {{ $item['status'] === 'Selesai' ? 'badge-ppak-navy' : 'badge-ppak-green' }}" style="font-size: 0.65rem;">
                                            {{ $item['status'] }}
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
