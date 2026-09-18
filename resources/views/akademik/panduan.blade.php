@extends('layouts.app')

@section('title', 'Pedoman & Buku Panduan Akademik | PPAk FEB UNESA')
@section('meta_description', 'Kumpulan buku pedoman akademik, panduan capstone project, dan peraturan perkuliahan Program Pendidikan Profesi Akuntansi FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Pedoman & Buku Panduan Akademik',
    'badge' => 'Regulasi & Panduan Teknis',
    'lead' => 'Unduh dokumen acuan penyelenggaraan studi, pedoman penulisan laporan praktik profesi (capstone project), serta tata tertib perkuliahan.',
    'breadcrumbs' => [
        ['label' => 'Akademik', 'url' => route('akademik.kurikulum')],
        ['label' => 'Buku Panduan', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-blue mb-2">Dokumen Resmi Mahasiswa</span>
            <h2>Daftar Pedoman Pembelajaran</h2>
            <p class="text-secondary">
                Seluruh mahasiswa diwajibkan memahami dan memedomani buku panduan resmi guna menunjang kelancaran studi profesi.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-ppak-wrapper">
                    <table class="table-ppak">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Nama Dokumen Panduan</th>
                                <th style="width: 15%;">Kategori</th>
                                <th style="width: 10%;">Tahun</th>
                                <th style="width: 10%;">Ukuran</th>
                                <th style="width: 15%;" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($panduanList as $doc)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="feature-icon-wrapper" style="width: 36px; height: 36px; font-size: 0.95rem;">
                                                <i class="fa-solid fa-file-pdf text-danger"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-navy">{{ $doc['title'] }}</div>
                                                <div class="small text-muted">{{ $doc['filename'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-ppak badge-ppak-blue" style="font-size: 0.7rem;">{{ $doc['kategori'] }}</span>
                                    </td>
                                    <td>{{ $doc['tahun'] }}</td>
                                    <td><span class="badge-ppak badge-ppak-navy" style="font-size: 0.675rem;">{{ $doc['size'] }}</span></td>
                                    <td class="text-end">
                                        <a href="{{ route('kontak.unduhan') }}" class="btn-ppak-secondary btn-ppak-sm">
                                            <i class="fa-solid fa-download me-1"></i>
                                            <span>Unduh</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada dokumen panduan yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Panduan Layanan Tambahan --}}
                <div class="p-4 rounded-3 border bg-subtle mt-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h4 class="fs-6 fw-bold text-navy mb-1"><i class="fa-solid fa-circle-question text-primary me-2"></i>Butuh Dokumen Spesifik Lainnya?</h4>
                        <p class="small text-secondary mb-0">Silakan telusuri repositori arsip berkas publik atau hubungi sekretariat akademik.</p>
                    </div>
                    <div>
                        <a href="{{ route('kontak.unduhan') }}" class="btn-ppak-primary btn-ppak-sm">
                            <span>Buka Semua Unduhan</span>
                            <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
