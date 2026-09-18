@extends('layouts.app')

@section('title', 'Prosedur & Jadwal Pendaftaran | PPAk FEB UNESA')
@section('meta_description', 'Tahapan alur pendaftaran daring, verifikasi berkas, tes seleksi, dan kalender jadwal seleksi mahasiswa baru PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Prosedur & Jadwal Seleksi Masuk',
    'badge' => 'Alur Penerimaan Daring',
    'lead' => 'Ikuti lima tahapan sederhana proses pendaftaran mahasiswa baru PPAk FEB UNESA secara terintegrasi.',
    'breadcrumbs' => [
        ['label' => 'Admisi', 'url' => route('admisi.jalur-syarat')],
        ['label' => 'Prosedur & Jadwal', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- STEPPER PROSEDUR --}}
        <div class="mb-5">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="badge-ppak badge-ppak-blue mb-2">Langkah Mudah</span>
                <h2>5 Tahapan Alur Pendaftaran Daring</h2>
                <p class="text-secondary">Seluruh proses registrasi dan pengunggahan dokumen dilakukan melalui portal resmi penerimaan mahasiswa baru UNESA.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="stepper-container">
                        @foreach($admisi['prosedur'] as $step)
                            <div class="stepper-item">
                                <div class="stepper-circle">{{ $step['step'] }}</div>
                                <div class="stepper-content">
                                    <h4 class="fs-6 fw-bold text-navy mb-1">{{ $step['title'] }}</h4>
                                    <p class="small text-secondary mb-0">{{ $step['desc'] }}</p>
                                </div>
                                <div class="stepper-line"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- JADWAL GELOMBANG PENDAFTARAN --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-1">Agenda Penerimaan</span>
                    <h3 class="h4 text-navy mb-0">Jadwal Seleksi Mahasiswa Baru 2024/2025</h3>
                </div>
                <span class="badge-ppak badge-ppak-green">Gelombang II Aktif</span>
            </div>

            <div class="table-ppak-wrapper">
                <table class="table-ppak">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Kegiatan</th>
                            <th style="width: 35%;">Gelombang I (Gasal)</th>
                            <th style="width: 35%;">Gelombang II (Genap)</th>
                            <th style="width: 15%;" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-semibold text-navy">Pendaftaran Online & Unggah Berkas</td>
                            <td>01 Mei - 30 Juni 2024</td>
                            <td>01 Oktober - 15 November 2024</td>
                            <td class="text-center"><span class="badge-ppak badge-ppak-green">Berjalan</span></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-navy">Verifikasi Kelengkapan Portofolio</td>
                            <td>01 - 05 Juli 2024</td>
                            <td>16 - 20 November 2024</td>
                            <td class="text-center"><span class="badge-ppak badge-ppak-navy">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-navy">Tes Potensi Akademik & Wawancara</td>
                            <td>08 - 10 Juli 2024</td>
                            <td>22 - 24 November 2024</td>
                            <td class="text-center"><span class="badge-ppak badge-ppak-navy">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-navy">Pengumuman Hasil Kelulusan</td>
                            <td>15 Juli 2024</td>
                            <td>29 November 2024</td>
                            <td class="text-center"><span class="badge-ppak badge-ppak-navy">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-navy">Registrasi Ulang & Pembayaran UKT</td>
                            <td>16 - 31 Juli 2024</td>
                            <td>01 - 15 Desember 2024</td>
                            <td class="text-center"><span class="badge-ppak badge-ppak-navy">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-navy">Awal Perkuliahan Perdana</td>
                            <td>02 September 2024</td>
                            <td>03 Februari 2025</td>
                            <td class="text-center"><span class="badge-ppak badge-ppak-navy">Terjadwal</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4 pt-3">
                <a href="https://pmb.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary">
                    <span>Akses Portal Admisi PMB UNESA</span>
                    <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
