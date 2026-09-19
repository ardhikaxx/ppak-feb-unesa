@extends('layouts.app')

@section('title', 'Pedoman & Panduan Akademik | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Dokumen pedoman akademik resmi, kalender akademik 2026/2027, dan informasi layanan administrasi Program Studi Pendidikan Profesi Akuntan FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Pedoman & Panduan Akademik',
    'badge' => 'Dokumen Resmi & Layanan',
    'lead' => 'Akses dokumen resmi ketetapan universitas dan informasi ketersediaan panduan akademik Program Studi Pendidikan Profesi Akuntan.',
    'breadcrumbs' => [
        ['label' => 'Akademik', 'url' => route('akademik.kurikulum')],
        ['label' => 'Buku Panduan', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container-xl">
        {{-- Dokumen Resmi yang Terverifikasi --}}
        <div class="text-center max-w-700 mx-auto mb-4">
            <span class="badge-ppak badge-ppak-gold mb-2">
                <i class="fa-solid fa-file-circle-check me-1"></i> DOKUMEN RESMI TERSEDIA
            </span>
            <h2>Dokumen Resmi Universitas & Akreditasi</h2>
            <div class="golden-line center"></div>
            <p class="text-secondary">
                Dokumen ketetapan resmi yang telah dipublikasikan dan dapat diakses publik.
            </p>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="table-ppak-wrapper">
                    <table class="table-ppak">
                        <thead>
                            <tr>
                                <th style="width: 48%;">Nama Dokumen</th>
                                <th style="width: 22%;">Kategori / Instansi</th>
                                <th style="width: 15%;" class="text-center">Format / Ukuran</th>
                                <th style="width: 15%;" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="feature-icon-wrapper" style="width: 38px; height: 38px; font-size: 1rem; background-color: #fef2f2; color: #dc2626; border-color: #fee2e2;">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-navy">Kalender Akademik Universitas Negeri Surabaya 2026/2027</div>
                                            <div class="small text-muted">Surat Nomor B/2322/UN38.I/TU.00.02/2026 (06 Januari 2026)</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-ppak badge-ppak-blue">Direktorat Pembelajaran</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-secondary border">PDF &bull; 850 KB</span>
                                </td>
                                <td class="text-end">
                                    <a href="https://unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary btn-ppak-sm text-nowrap">
                                        <i class="fa-solid fa-arrow-up-right-from-square me-1 text-navy"></i>
                                        <span>Buka Dokumen</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="feature-icon-wrapper" style="width: 38px; height: 38px; font-size: 1rem; background-color: #fef2f2; color: #dc2626; border-color: #fee2e2;">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-navy">SK & Sertifikat Akreditasi LAMEMBA (Peringkat Baik)</div>
                                            <div class="small text-muted">SK No. 611/DE/A.5/AR.11/II/2025 (26 Februari 2025)</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-ppak badge-ppak-gold">LAMEMBA / SIMUTU</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-secondary border">PDF &bull; 420 KB</span>
                                </td>
                                <td class="text-end">
                                    <a href="https://simutu.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary btn-ppak-sm text-nowrap">
                                        <i class="fa-solid fa-arrow-up-right-from-square me-1 text-navy"></i>
                                        <span>Lihat SK</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Section: Dokumen Akademik PPAk Khusus --}}
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
                    <div class="d-flex align-items-start gap-4">
                        <div class="feature-icon-wrapper flex-shrink-0" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            <i class="fa-solid fa-folder-open text-navy"></i>
                        </div>
                        <div>
                            <span class="badge-ppak badge-ppak-navy mb-2">Dokumen Akademik PPAk</span>
                            <h3 class="h4 text-navy fw-bold mb-2">Pedoman Akademik & Buku Panduan Khusus Program Studi</h3>
                            <p class="text-secondary small mb-3" style="line-height: 1.65;">
                                Dokumen Buku Pedoman Akademik Khusus Program Studi, Petunjuk Praktik Magang Industri, dan Panduan Capstone Project sedang dalam proses penyusunan dan pengesahan tata pamong kelembagaan menyusul berdirinya program pada 23 Mei 2025.
                            </p>
                            <div class="p-3 bg-white rounded-3 border mb-3">
                                <div class="fw-bold text-navy small mb-1">Status Ketersediaan Dokumen:</div>
                                <div class="small text-secondary">
                                    Dokumen resmi akan tersedia melalui sekretariat program studi bagi mahasiswa aktif yang telah terdaftar resmi.
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="mailto:ppak.feb@unesa.ac.id" class="btn-ppak-primary btn-ppak-sm">
                                    <i class="fa-solid fa-envelope me-1"></i>
                                    <span>Hubungi Sekretariat (ppak.feb@unesa.ac.id)</span>
                                </a>
                                <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-secondary btn-ppak-sm">
                                    <i class="fa-solid fa-headset me-1"></i>
                                    <span>Layanan Helpdesk</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
