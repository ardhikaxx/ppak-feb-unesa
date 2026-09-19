@extends('layouts.app')

@section('title', 'Unduhan Dokumen Publik | PPAk FEB UNESA')
@section('meta_description', 'Pusat unduhan dokumen publik, brosur admisi, buku pedoman akademik, formulir pendaftaran ujian CA, dan kalender akademik PPAk FEB UNESA.')

@section('content')

<x-page-header title="Unduhan Dokumen Publik & Formulir" badge="Repositori Berkas Resmi" lead="Akses berkas digital resmi seperti brosur program, formulir permohonan waiver CA, kalender studi, dan surat keputusan akreditasi." :breadcrumbs="[
    ['label' => 'Kontak', 'url' => route('kontak.lokasi')],
    ['label' => 'Unduhan Dokumen', 'url' => '']
]" />

<section class="section-py bg-white">
    <div class="container">
        {{-- Server-side search - scalable --}}
        <form method="GET" action="{{ route('kontak.unduhan') }}" class="p-4 rounded-4 border bg-subtle mb-4">
            <div class="row align-items-center g-3">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control border-start-0 ps-0" placeholder="Ketik kata kunci dokumen (kalender, pedoman, waiver, brosur)..." aria-label="Cari Dokumen">
                        @if(request('q'))
                            <a href="{{ route('kontak.unduhan') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3">
                    <select name="kategori" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <option value="Pedoman Akademik" @selected(request('kategori')==='Pedoman Akademik')>Pedoman Akademik</option>
                        <option value="Kalender" @selected(request('kategori')==='Kalender')>Kalender</option>
                        <option value="Admisi & Brosur" @selected(request('kategori')==='Admisi & Brosur')>Admisi & Brosur</option>
                    </select>
                </div>
                <div class="col-lg-3 text-lg-end">
                    <button class="btn-ppak-primary w-100"><i class="fa-solid fa-search me-1"></i> Cari</button>
                </div>
            </div>
        </form>

        <div class="table-ppak-wrapper mb-4">
            <table class="table-ppak">
                <thead>
                    <tr>
                        <th style="width:45%;">Judul Berkas Dokumen</th>
                        <th style="width:20%;">Kategori</th>
                        <th style="width:10%;">Tahun</th>
                        <th style="width:10%;">Format</th>
                        <th style="width:15%;" class="text-end">Tautan Unduh</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($unduhan as $doc)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="feature-icon-wrapper" style="width:36px; height:36px; font-size:0.95rem;">
                                        @if(($doc['format'] ?? 'PDF') === 'PDF')
                                            <i class="fa-solid fa-file-pdf text-danger"></i>
                                        @else
                                            <i class="fa-solid fa-file-word text-primary"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-navy">{{ $doc['title'] ?? $doc['judul'] ?? 'Dokumen' }}</div>
                                        <div class="small text-muted" style="font-size:0.75rem;">{{ $doc['filename'] ?? ($doc['slug'] ?? 'doc') . '.pdf' }} &bull; {{ $doc['size'] ?? $doc['ukuran'] ?? 'PDF' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><x-badge variant="blue" style="font-size:0.7rem;">{{ $doc['kategori'] ?? 'Umum' }}</x-badge></td>
                            <td>{{ $doc['tahun'] ?? $doc['tanggal'] ?? '2026' }}</td>
                            <td><x-badge variant="navy" style="font-size:0.675rem;">{{ $doc['format'] ?? 'PDF' }}</x-badge></td>
                            <td class="text-end">
                                <a href="{{ route('kontak.unduhan.download', $doc['filename'] ?? ($doc['slug'] ?? 'doc') . '.pdf') }}" class="btn-ppak-primary btn-ppak-sm">
                                    <i class="fa-solid fa-download me-1"></i> Unduh
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <x-empty-state title="Dokumen Tidak Ditemukan" message="Coba kata kunci lain atau hubungi helpdesk." icon="fa-file-circle-xmark" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mb-4">
            {{ $unduhan->withQueryString()->links('vendor.pagination.numbers') }}
        </div>

        <div class="p-4 rounded-3 border bg-subtle text-center">
            <h4 class="fs-6 fw-bold text-navy mb-1"><i class="fa-solid fa-shield-halved text-primary me-2"></i>Legalitas Dokumen Terverifikasi</h4>
            <p class="small text-secondary mb-0 max-w-700 mx-auto">Dokumen publik merupakan publikasi resmi Sekretariat PPAk FEB UNESA. Penggandaan komersial tanpa izin dilarang.</p>
        </div>
    </div>
</section>

@endsection
