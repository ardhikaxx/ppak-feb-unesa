@extends('layouts.app')

@section('title', 'Kurikulum & Capaian Pembelajaran | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Struktur kurikulum resmi SINDIG UNESA dan Capaian Pembelajaran Lulusan (CPL) Program Studi Pendidikan Profesi Akuntan (Kode Prodi: 62902) FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Kurikulum & Capaian Pembelajaran',
    'badge' => 'Kurikulum Resmi SINDIG UNESA',
    'lead' => 'Struktur mata kuliah, distribusi SKS semester, dan pemetaan Capaian Pembelajaran Lulusan (CPL) Program Studi Pendidikan Profesi Akuntan (Kode: 62902).',
    'breadcrumbs' => [
        ['label' => 'Akademik', 'url' => route('akademik.kurikulum')],
        ['label' => 'Kurikulum & CPL', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Print Header (hanya muncul saat cetak) --}}
        <div class="print-header d-none">
            <div class="print-header-title">Kurikulum & Capaian Pembelajaran Lulusan</div>
            <p>Pendidikan Profesi Akuntan FEB UNESA — Tahun Akademik 2026/2027</p>
        </div>

        {{-- Print Button --}}
        <div class="text-end mb-3 no-print">
            <button onclick="window.print()" class="btn-ppak-secondary btn-ppak-sm">
                <i class="fa-solid fa-print me-1"></i> Cetak Halaman
            </button>
        </div>

        {{-- Source Attribution Banner --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center p-3 rounded-3 border bg-subtle mb-5 gap-2">
            <div class="small text-secondary">
                <i class="fa-solid fa-circle-check text-success me-1"></i> Data kurikulum resmi diambil langsung dari sistem kurikulum <strong>SINDIG UNESA</strong> untuk Program Studi Pendidikan Profesi Akuntan (Kode: <strong>62902</strong>).
            </div>
            <a href="https://sindig.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="small text-navy fw-semibold text-decoration-none">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Portal SINDIG
            </a>
        </div>

        {{-- TABEL MATA KULIAH SEMESTER 1 --}}
        <div class="mb-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
                <div>
                    <span class="badge-ppak badge-ppak-blue mb-1">Tahap 1</span>
                    <h3 class="h4 text-navy mb-0">Mata Kuliah Semester 1 ({{ $sks1 }} SKS)</h3>
                </div>
                <span class="badge-ppak badge-ppak-navy">Semester Gasal</span>
            </div>

            <div class="table-ppak-wrapper">
                <table class="table-ppak">
                    <thead>
                        <tr>
                            <th style="width: 14%;">Kode MK</th>
                            <th style="width: 32%;">Nama Mata Kuliah</th>
                            <th style="width: 8%;" class="text-center">SKS</th>
                            <th style="width: 10%;">Jenis</th>
                            <th style="width: 24%;">Deskripsi Pembelajaran</th>
                            <th style="width: 12%;">Pemetaan CPL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kurikulum['semester_1'] as $mk)
                            <tr>
                                <td><code class="fw-bold">{{ $mk['kode'] }}</code></td>
                                <td class="fw-semibold text-navy">
                                    {{ $mk['nama'] }}
                                    @if(!empty($mk['pengajar']))
                                        <div class="small text-muted mt-1" style="font-size: 0.75rem;">
                                            <i class="fa-solid fa-chalkboard-user me-1 text-primary"></i> Pengajar: {{ implode(', ', $mk['pengajar']) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center"><span class="badge-ppak badge-ppak-navy">{{ $mk['sks'] }} SKS</span></td>
                                <td><span class="badge-ppak badge-ppak-blue">{{ $mk['jenis'] }}</span></td>
                                <td class="small text-secondary">{{ $mk['deskripsi'] }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($mk['cpl'] as $cplTag)
                                            <span class="badge bg-light text-navy border" style="font-size: 0.65rem;">{{ $cplTag }}</span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- TABEL MATA KULIAH SEMESTER 2 --}}
        <div class="mb-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-1">Tahap 2</span>
                    <h3 class="h4 text-navy mb-0">Mata Kuliah Semester 2 ({{ $sks2 }} SKS)</h3>
                </div>
                <span class="badge-ppak badge-ppak-navy">Semester Genap</span>
            </div>

            <div class="table-ppak-wrapper">
                <table class="table-ppak">
                    <thead>
                        <tr>
                            <th style="width: 14%;">Kode MK</th>
                            <th style="width: 32%;">Nama Mata Kuliah</th>
                            <th style="width: 8%;" class="text-center">SKS</th>
                            <th style="width: 10%;">Jenis</th>
                            <th style="width: 24%;">Deskripsi Pembelajaran</th>
                            <th style="width: 12%;">Pemetaan CPL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kurikulum['semester_2'] as $mk)
                            <tr>
                                <td><code class="fw-bold">{{ $mk['kode'] }}</code></td>
                                <td class="fw-semibold text-navy">
                                    {{ $mk['nama'] }}
                                    @if(!empty($mk['pengajar']))
                                        <div class="small text-muted mt-1" style="font-size: 0.75rem;">
                                            <i class="fa-solid fa-chalkboard-user me-1 text-primary"></i> Pengajar: {{ implode(', ', $mk['pengajar']) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center"><span class="badge-ppak badge-ppak-navy">{{ $mk['sks'] }} SKS</span></td>
                                <td><span class="badge-ppak badge-ppak-gold">{{ $mk['jenis'] }}</span></td>
                                <td class="small text-secondary">{{ $mk['deskripsi'] }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($mk['cpl'] as $cplTag)
                                            <span class="badge bg-light text-navy border" style="font-size: 0.65rem;">{{ $cplTag }}</span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAKET MATA KULIAH MAGANG --}}
        <div class="mb-5 p-4 rounded-4 border bg-subtle">
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="fa-solid fa-briefcase text-navy fs-5"></i>
                <h3 class="h5 text-navy mb-0">Paket Mata Kuliah Magang Praktik Industri</h3>
            </div>
            <p class="small text-secondary mb-3">
                Paket modul pendukung mata kuliah magang (Internship) yang tercatat pada struktur SINDIG untuk memastikan ketercapaian kompetensi kerja praktik.
            </p>
            <div class="row g-3">
                @foreach($kurikulum['paket_magang'] as $pm)
                    <div class="col-md-4">
                        <div class="p-3 bg-white rounded-3 border h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge-ppak badge-ppak-navy" style="font-size: 0.675rem;">Paket Magang</span>
                                <span class="badge-ppak badge-ppak-gold">{{ $pm['sks'] }} SKS</span>
                            </div>
                            <h4 class="fs-6 fw-bold text-navy mb-1">{{ $pm['nama'] }}</h4>
                            <p class="small text-secondary mb-0" style="line-height: 1.5;">{{ $pm['deskripsi'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CAPAIAN PEMBELAJARAN LULUSAN (4 CPL RESMI SINDIG) --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-white shadow-sm mb-4">
            <div class="mb-4">
                <span class="badge-ppak badge-ppak-gold mb-2">Standar Kelulusan SINDIG</span>
                <h3 class="h3 text-navy mb-1">Capaian Pembelajaran Lulusan (CPL)</h3>
                <p class="text-secondary small mb-0">Empat rumusan Capaian Pembelajaran Lulusan resmi yang menjadi acuan penilaian kompetensi mahasiswa.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card-ppak-flat h-100 bg-subtle">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge-ppak badge-ppak-navy font-monospace">CPL-1</span>
                            <span class="badge-ppak badge-ppak-gold" style="font-size:0.65rem;">Sikap & Etika</span>
                        </div>
                        <h4 class="fs-6 fw-bold text-navy mb-2">Nilai Agama & Etika Akademik</h4>
                        <p class="small text-secondary mb-0" style="line-height:1.6;">
                            Kemampuan menunjukkan nilai agama, kebangsaan, budaya nasional, dan etika akademik dalam pelaksanaan tugas profesional akuntan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card-ppak-flat h-100 bg-subtle">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge-ppak badge-ppak-navy font-monospace">CPL-2</span>
                            <span class="badge-ppak badge-ppak-gold" style="font-size:0.65rem;">Karakter</span>
                        </div>
                        <h4 class="fs-6 fw-bold text-navy mb-2">Tangguh & Kolaboratif</h4>
                        <p class="small text-secondary mb-0" style="line-height:1.6;">
                            Karakter tangguh, kolaboratif, adaptif, inovatif, inklusif, pembelajar sepanjang hayat, dan memiliki jiwa kewirausahaan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card-ppak-flat h-100 bg-subtle">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge-ppak badge-ppak-navy font-monospace">CPL-3</span>
                            <span class="badge-ppak badge-ppak-gold" style="font-size:0.65rem;">Standar Kerja</span>
                        </div>
                        <h4 class="fs-6 fw-bold text-navy mb-2">Pemikiran Logis & Kritis</h4>
                        <p class="small text-secondary mb-0" style="line-height:1.6;">
                            Kemampuan mengembangkan pemikiran logis, kritis, sistematis, dan kreatif sesuai standar kompetensi kerja bidang akuntansi dan auditing.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card-ppak-flat h-100 bg-subtle">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge-ppak badge-ppak-navy font-monospace">CPL-4</span>
                            <span class="badge-ppak badge-ppak-gold" style="font-size:0.65rem;">Pengembangan Diri</span>
                        </div>
                        <h4 class="fs-6 fw-bold text-navy mb-2">Pengembangan Berkelanjutan</h4>
                        <p class="small text-secondary mb-0" style="line-height:1.6;">
                            Pengembangan diri secara berkelanjutan dan kemampuan berkolaborasi secara efektif dalam tim kerja profesional.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.related-links', ['links' => [
            ['label' => 'Jadwal perkuliahan semester berjalan', 'url' => route('akademik.kalender'), 'desc' => 'Kalender resmi masa kuliah, ujian, dan yudisium.'],
            ['label' => 'Tenaga pengajar mata kuliah', 'url' => route('profil.dosen-pengajar'), 'desc' => 'Dosen pengampu tiap mata kuliah profesi.'],
            ['label' => 'Jalur sertifikasi CA dan CPA', 'url' => route('akademik.gelar-sertifikasi'), 'desc' => 'Gelar profesi setelah lulus pendidikan profesi.'],
        ]])
    </div>
</section>

@endsection

