@extends('layouts.app')

@section('title', 'Kurikulum & Capaian Pembelajaran | PPAk FEB UNESA')
@section('meta_description', 'Struktur mata kuliah, distribusi SKS semester, dan Capaian Pembelajaran Lulusan (CPL) Program Pendidikan Profesi Akuntansi FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Kurikulum & Capaian Pembelajaran',
    'badge' => 'Struktur Perkuliahan Profesi',
    'lead' => 'Kurikulum terintegrasi dengan silabus Chartered Accountant (CA) IAI dan standar internasional IFAC dengan beban 24 SKS dalam 2 semester.',
    'breadcrumbs' => [
        ['label' => 'Akademik', 'url' => route('akademik.kurikulum')],
        ['label' => 'Kurikulum & CPL', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Ringkasan Beban Studi --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card-apple text-center">
                    <div class="stat-number text-primary">24 SKS</div>
                    <div class="stat-label">Total Beban Studi</div>
                    <p class="stat-desc">Ditempuh dalam 2 semester perkuliahan komprehensif</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-apple text-center">
                    <div class="stat-number text-navy">2 Semester</div>
                    <div class="stat-label">Masa Studi Normal</div>
                    <p class="stat-desc">1 Tahun Akademik (Kelas Reguler & Eksekutif Akhir Pekan)</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-apple text-center">
                    <div class="stat-number text-warning">Waiver CA</div>
                    <div class="stat-label">Penyetaraan Sertifikasi</div>
                    <p class="stat-desc">Bebas modul ujian tertentu dari Ikatan Akuntan Indonesia</p>
                </div>
            </div>
        </div>

        {{-- TABEL MATA KULIAH SEMESTER 1 --}}
        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <span class="badge-ppak badge-ppak-blue mb-1">Tahap 1</span>
                    <h3 class="h4 text-navy mb-0">Semester Gasal (Semester I) &bull; 12 SKS</h3>
                </div>
                <span class="small text-muted">Fondasi Pelaporan & Pengauditan Lanjutan</span>
            </div>

            <div class="table-ppak-wrapper">
                <table class="table-ppak">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Kode MK</th>
                            <th style="width: 40%;">Nama Mata Kuliah</th>
                            <th style="width: 10%;" class="text-center">SKS</th>
                            <th style="width: 15%;">Kategori</th>
                            <th style="width: 20%;">Fokus Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kurikulum['semester_1'] as $mk)
                            <tr>
                                <td><code>{{ $mk['kode'] }}</code></td>
                                <td class="fw-semibold text-navy">{{ $mk['nama'] }}</td>
                                <td class="text-center"><span class="badge-ppak badge-ppak-navy">{{ $mk['sks'] }} SKS</span></td>
                                <td><span class="badge-ppak badge-ppak-blue">{{ $mk['kategori'] }}</span></td>
                                <td class="small text-muted">{{ $mk['silabus'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- TABEL MATA KULIAH SEMESTER 2 --}}
        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-1">Tahap 2</span>
                    <h3 class="h4 text-navy mb-0">Semester Genap (Semester II) &bull; 12 SKS</h3>
                </div>
                <span class="small text-muted">Aplikasi Stratejik & Capstone Praktik Profesi</span>
            </div>

            <div class="table-ppak-wrapper">
                <table class="table-ppak">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Kode MK</th>
                            <th style="width: 40%;">Nama Mata Kuliah</th>
                            <th style="width: 10%;" class="text-center">SKS</th>
                            <th style="width: 15%;">Kategori</th>
                            <th style="width: 20%;">Fokus Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kurikulum['semester_2'] as $mk)
                            <tr>
                                <td><code>{{ $mk['kode'] }}</code></td>
                                <td class="fw-semibold text-navy">{{ $mk['nama'] }}</td>
                                <td class="text-center"><span class="badge-ppak badge-ppak-navy">{{ $mk['sks'] }} SKS</span></td>
                                <td><span class="badge-ppak badge-ppak-gold">{{ $mk['kategori'] }}</span></td>
                                <td class="small text-muted">{{ $mk['silabus'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- CAPAIAN PEMBELAJARAN LULUSAN (CPL) --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <div class="mb-4">
                <span class="badge-ppak badge-ppak-blue mb-2">Outcome-Based Education</span>
                <h3 class="h3 text-navy mb-1">Capaian Pembelajaran Lulusan (CPL)</h3>
                <p class="text-secondary small mb-0">Disusun berdasarkan Standar Kompetensi Kerja Nasional Indonesia (SKKNI) dan Kerangka Kualifikasi Nasional Indonesia (KKNI) Jenjang 7.</p>
            </div>

            <div class="row g-4">
                @foreach($kurikulum['cpl'] as $cpl)
                    <div class="col-lg-4">
                        <div class="card-ppak-flat h-100 bg-white">
                            <h4 class="fs-6 fw-bold text-navy mb-3 pb-2 border-bottom">
                                <i class="fa-solid fa-check-double text-primary me-2"></i>{{ $cpl['ranah'] }}
                            </h4>
                            <ul class="list-unstyled mb-0">
                                @foreach($cpl['items'] as $item)
                                    <li class="d-flex align-items-start gap-2 mb-2 small text-secondary">
                                        <i class="fa-solid fa-circle text-primary mt-1" style="font-size: 0.45rem;"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
