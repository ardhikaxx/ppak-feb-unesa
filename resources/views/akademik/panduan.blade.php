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
    <div class="container-xl">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-gold mb-2">
                <i class="fa-solid fa-book me-1"></i> DOKUMEN RESMI MAHASISWA
            </span>
            <h2>Daftar Pedoman Pembelajaran</h2>
            <p class="text-secondary">
                Seluruh mahasiswa diwajibkan memahami dan memedomani buku panduan resmi guna menunjang kelancaran studi profesi.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">
                <div class="table-ppak-wrapper">
                    <table class="table-ppak">
                        <thead>
                            <tr>
                                <th style="width: 46%;">Nama Dokumen Panduan</th>
                                <th style="width: 18%;">Kategori</th>
                                <th style="width: 10%;" class="text-center">Tahun</th>
                                <th style="width: 12%;" class="text-center">Ukuran</th>
                                <th style="width: 14%;" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($panduanList as $doc)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="feature-icon-wrapper" style="width: 38px; height: 38px; font-size: 1rem; background-color: #fef2f2; color: #dc2626; border-color: #fee2e2;">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-navy">{{ $doc['title'] }}</div>
                                                <div class="small text-muted">{{ $doc['filename'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-ppak badge-ppak-blue text-nowrap" style="font-size: 0.725rem;">{{ $doc['kategori'] }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary fw-semibold">{{ $doc['tahun'] }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-secondary border fw-medium px-2 py-1 text-nowrap" style="font-size: 0.75rem;">{{ $doc['size'] }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('kontak.unduhan') }}" class="btn-ppak-secondary btn-ppak-sm text-nowrap">
                                            <i class="fa-solid fa-download me-1 text-navy"></i>
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
                <div class="p-4 rounded-4 border bg-white shadow-sm mt-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="feature-icon-wrapper" style="width: 44px; height: 44px; font-size: 1.15rem; background: var(--unesa-gold-light); color: var(--unesa-gold); border-color: rgba(216, 174, 71, 0.3);">
                            <i class="fa-solid fa-circle-question"></i>
                        </div>
                        <div>
                            <h4 class="fs-6 fw-bold text-navy mb-1">Butuh Dokumen Spesifik Lainnya?</h4>
                            <p class="small text-secondary mb-0">Silakan telusuri repositori arsip berkas publik lengkap atau hubungi sekretariat akademik.</p>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('kontak.unduhan') }}" class="btn-ppak-primary btn-ppak-sm text-nowrap">
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
