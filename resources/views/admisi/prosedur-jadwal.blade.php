@extends('layouts.app')

@section('title', 'Prosedur & Jadwal Seleksi Masuk | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Tahapan alur pendaftaran daring PMB UNESA dan arsip jadwal seleksi mahasiswa baru Program Studi Pendidikan Profesi Akuntan 2026/2027.')

@section('content')

@include('partials.page-header', [
    'title' => 'Prosedur & Jadwal Seleksi Masuk',
    'badge' => 'Alur Penerimaan Terpadu PMB UNESA',
    'lead' => 'Tahapan pendaftaran terpusat melalui portal PMB UNESA dan rekam jadwal seleksi penerimaan mahasiswa baru.',
    'breadcrumbs' => [
        ['label' => 'Admisi', 'url' => route('admisi.jalur-syarat')],
        ['label' => 'Prosedur & Jadwal', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- STEPPER PROSEDUR (5 TAHAPAN RESMI PMB UNESA) --}}
        <div class="mb-5">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="badge-ppak badge-ppak-blue mb-2">Alur Pendaftaran Daring</span>
                <h2>5 Tahapan Alur Pendaftaran PMB UNESA</h2>
                <div class="golden-line center"></div>
                <p class="text-secondary">Seluruh proses registrasi, pengunggahan berkas, verifikasi, hingga penerbitan kartu ujian dilaksanakan melalui portal resmi PMB UNESA.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="stepper-container">
                        @foreach($admisi['tahapan_pendaftaran'] as $step)
                            <div class="stepper-item">
                                <div class="stepper-circle">{{ $step['langkah'] }}</div>
                                <div class="stepper-content">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <h3 class="fs-6 fw-bold text-navy mb-0">{{ $step['judul'] }}</h3>
                                        <span class="badge-ppak badge-ppak-navy" style="font-size: 0.65rem;">Tahap {{ $step['langkah'] }}</span>
                                    </div>
                                    <p class="small text-secondary mb-0" style="line-height: 1.6;">{{ $step['deskripsi'] }}</p>
                                </div>
                                <div class="stepper-line"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- JADWAL GELOMBANG PENDAFTARAN (ARSIP SELEKSI 2026/2027) --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-1">Agenda Penerimaan Mahasiswa Baru</span>
                    <h3 class="h4 text-navy mb-1">Jadwal Seleksi Admisi UNESA 2026/2027</h3>
                    <div class="small text-muted">
                        <i class="fa-solid fa-circle-info text-primary me-1"></i> Data jadwal resmi berdasarkan pengumuman Admisi UNESA untuk Semester Ganjil 2026/2027.
                    </div>
                </div>
                <span class="badge-ppak badge-ppak-navy px-3 py-2">
                    <i class="fa-solid fa-box-archive me-1 text-gold"></i> Arsip Seleksi 2026/2027
                </span>
            </div>

            <div class="table-ppak-wrapper">
                <table class="table-ppak">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Gelombang Seleksi</th>
                            <th style="width: 30%;">Periode Pendaftaran Daring</th>
                            <th style="width: 25%;">Pelaksanaan Seleksi / Wawancara</th>
                            <th style="width: 20%;" class="text-center">Status Periode</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admisi['jadwal_2026'] as $j)
                            <tr>
                                <td class="fw-semibold text-navy">
                                    <i class="fa-regular fa-calendar-check me-2 text-primary"></i>{{ $j['gelombang'] }}
                                </td>
                                <td>{{ $j['pendaftaran'] }}</td>
                                <td>{{ $j['seleksi'] }}</td>
                                <td class="text-center">
                                    <span class="badge-ppak badge-ppak-navy">{{ $j['status'] }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Notice on Selection Status --}}
            <div class="p-3 rounded-3 bg-white border mt-4">
                <div class="d-flex align-items-start gap-3">
                    <i class="fa-solid fa-circle-info text-primary fs-5 mt-1"></i>
                    <div class="small">
                        <div class="fw-bold text-navy">Informasi Periode Seleksi Berikutnya:</div>
                        <div class="text-secondary">
                            Seluruh gelombang seleksi untuk Tahun Akademik 2026/2027 telah terlaksana. Jadwal dan pembukaan gelombang baru untuk periode berikutnya akan diumumkan secara resmi melalui portal <strong>pmb.unesa.ac.id</strong> dan laman Admisi UNESA.
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 pt-2">
                <a href="https://pmb.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary">
                    <span>Akses Portal Admisi PMB UNESA</span>
                    <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                </a>
            </div>
        </div>

        @include('partials.related-links', ['links' => [
            ['label' => 'Dokumen persyaratan seleksi', 'url' => route('admisi.jalur-syarat'), 'desc' => 'Pastikan berkas lengkap sebelum jadwal berakhir.'],
            ['label' => 'Besaran UKT dan pembayaran', 'url' => route('admisi.biaya'), 'desc' => 'Biaya yang dibayar setelah dinyatakan lolos seleksi.'],
            ['label' => 'Kalender akademik berjalan', 'url' => route('akademik.kalender'), 'desc' => 'Acuan jadwal perkuliahan setelah registrasi.'],
        ]])
    </div>
</section>

@endsection

