@extends('layouts.app')

@section('title', 'Unduhan Dokumen Publik | PPAk FEB UNESA')
@section('meta_description', 'Pusat unduhan dokumen publik, brosur admisi, buku pedoman akademik, formulir pendaftaran ujian CA, dan kalender akademik PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Unduhan Dokumen Publik & Formulir',
    'badge' => 'Repositori Berkas Resmi',
    'lead' => 'Akses berkas digital resmi seperti brosur program, formulir permohonan waiver CA, kalender studi, dan surat keputusan akreditasi.',
    'breadcrumbs' => [
        ['label' => 'Kontak', 'url' => route('kontak.lokasi')],
        ['label' => 'Unduhan Dokumen', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Search and Filter Bar --}}
        <div class="p-4 rounded-4 border bg-subtle mb-4">
            <div class="row align-items-center g-3">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" id="docSearchInput" placeholder="Ketik kata kunci dokumen (contoh: kalender, pedoman, waiver, brosur)..." aria-label="Cari Dokumen">
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <span class="small text-muted">
                        <i class="fa-solid fa-file-circle-check text-primary me-1"></i> Seluruh file telah diverifikasi bebas malware dan berformat standar (PDF/DOCX).
                    </span>
                </div>
            </div>
        </div>

        {{-- TABLE OF DOCUMENTS --}}
        <div class="table-ppak-wrapper mb-5">
            <table class="table-ppak" id="docTable">
                <thead>
                    <tr>
                        <th style="width: 45%;">Judul Berkas Dokumen</th>
                        <th style="width: 20%;">Kategori</th>
                        <th style="width: 10%;">Tahun</th>
                        <th style="width: 10%;">Format</th>
                        <th style="width: 15%;" class="text-end">Tautan Unduh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unduhan as $doc)
                        <tr class="doc-row" data-doc-title="{{ strtolower($doc['title']) }}" data-doc-category="{{ strtolower($doc['kategori']) }}">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="feature-icon-wrapper" style="width: 36px; height: 36px; font-size: 0.95rem;">
                                        @if($doc['format'] === 'PDF')
                                            <i class="fa-solid fa-file-pdf text-danger"></i>
                                        @else
                                            <i class="fa-solid fa-file-word text-primary"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-navy">{{ $doc['title'] }}</div>
                                        <div class="small text-muted" style="font-size: 0.75rem;">{{ $doc['filename'] }} &bull; {{ $doc['size'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-ppak badge-ppak-blue" style="font-size: 0.7rem;">{{ $doc['kategori'] }}</span>
                            </td>
                            <td>{{ $doc['tahun'] }}</td>
                            <td>
                                <span class="badge-ppak badge-ppak-navy" style="font-size: 0.675rem;">{{ $doc['format'] }}</span>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn-ppak-primary btn-ppak-sm" onclick="alert('Mengunduh dokumen: {{ $doc['title'] }} ({{ $doc['size'] }})'); return false;">
                                    <i class="fa-solid fa-download me-1"></i>
                                    <span>Unduh</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Empty State for Search --}}
            <div id="docEmptyState" class="text-center py-5 text-muted" style="display: none;">
                <i class="fa-solid fa-file-circle-xmark display-6 mb-3 text-secondary"></i>
                <h4 class="fs-6 fw-bold text-navy mb-1">Dokumen Tidak Ditemukan</h4>
                <p class="small text-secondary mb-0">Coba gunakan kata kunci pencarian lain atau hubungi helpdesk untuk meminta berkas.</p>
            </div>
        </div>

        {{-- Verification note --}}
        <div class="p-4 rounded-3 border bg-subtle text-center">
            <h4 class="fs-6 fw-bold text-navy mb-1"><i class="fa-solid fa-shield-check text-primary me-2"></i>Legalitas Dokumen Terverifikasi</h4>
            <p class="small text-secondary mb-0 max-w-700 mx-auto">
                Dokumen publik yang diunggah pada repositori ini merupakan publikasi resmi dari Sekretariat PPAk FEB Universitas Negeri Surabaya. Segala bentuk penggandaan dokumen untuk tujuan komersial tanpa izin tertulis dilarang.
            </p>
        </div>
    </div>
</section>

@endsection
