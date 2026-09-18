@extends('layouts.app')

@section('title', 'Biaya Pendidikan | PPAk FEB UNESA')
@section('meta_description', 'Rincian komponen biaya pendaftaran, Uang Kuliah Tunggal (UKT) semester, dan tata cara pembayaran biaya studi PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Biaya Pendidikan & Investasi Studi',
    'badge' => 'Informasi Keuangan',
    'lead' => 'Struktur pembiayaan pendidikan profesi yang transparan untuk kelas reguler maupun eksekutif.',
    'breadcrumbs' => [
        ['label' => 'Admisi', 'url' => route('admisi.jalur-syarat')],
        ['label' => 'Biaya Pendidikan', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Disclaimer note --}}
        <div class="p-3 px-4 rounded-3 border border-warning bg-warning bg-opacity-10 mb-5 d-flex align-items-center gap-3">
            <i class="fa-solid fa-circle-info text-warning fs-5"></i>
            <div class="small text-dark">
                <strong>Catatan Resmi:</strong> Besaran biaya di bawah ini merupakan estimasi referensi tarif resmi universitas. Nominal final dapat disesuaikan berdasarkan Surat Keputusan (SK) Rektor Universitas Negeri Surabaya terbaru untuk periode tahun akademik berjalan.
            </div>
        </div>

        {{-- TABEL BIAYA --}}
        <div class="mb-5">
            <div class="table-ppak-wrapper">
                <table class="table-ppak">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 40%;">Komponen Pembiayaan</th>
                            <th style="width: 25%;">Perkiraan Tarif / Semester</th>
                            <th style="width: 30%;">Keterangan & Lingkup</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admisi['biaya'] as $idx => $b)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td class="fw-semibold text-navy">{{ $b['komponen'] }}</td>
                                <td>
                                    <span class="badge-ppak badge-ppak-gold" style="font-size: 0.8rem;">{{ $b['nominal'] }}</span>
                                </td>
                                <td class="small text-muted">{{ $b['keterangan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- KANAL PEMBAYARAN RESMI & KEBIJAKAN --}}
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card-ppak-flat h-100">
                    <h4 class="fs-6 fw-bold text-navy mb-3"><i class="fa-solid fa-building-columns text-primary me-2"></i>Kanal Pembayaran Resmi</h4>
                    <p class="small text-secondary mb-3">
                        Seluruh transaksi keuangan pendidikan di lingkungan UNESA menggunakan kode <strong>Virtual Account (VA)</strong> yang tertera pada slip pendaftaran resmi melalui jaringan bank mitra:
                    </p>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge-ppak badge-ppak-navy">Bank Mandiri</span>
                        <span class="badge-ppak badge-ppak-navy">Bank BTN</span>
                        <span class="badge-ppak badge-ppak-navy">Bank BNI</span>
                        <span class="badge-ppak badge-ppak-navy">Bank BRI</span>
                        <span class="badge-ppak badge-ppak-navy">Bank Syariah Indonesia (BSI)</span>
                    </div>
                    <div class="small text-danger">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i> UNESA tidak pernah menerima pembayaran melalui rekening perorangan atas nama dosen atau panitia.
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-ppak-flat h-100">
                    <h4 class="fs-6 fw-bold text-navy mb-3"><i class="fa-solid fa-shield-halved text-primary me-2"></i>Ketentuan & Kebijakan Biaya</h4>
                    <ul class="list-unstyled small text-secondary mb-0">
                        <li class="mb-2 d-flex align-items-start gap-2">
                            <i class="fa-solid fa-check text-primary mt-1"></i>
                            <span>Biaya UKT sudah mencakup modul praktika, ujian semester, serta akses perpustakaan dan laboratorium komputasi akuntansi.</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start gap-2">
                            <i class="fa-solid fa-check text-primary mt-1"></i>
                            <span>Biaya pendaftaran seleksi masuk yang telah disetorkan tidak dapat ditarik kembali apabila peserta dinyatakan tidak lulus seleksi.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-check text-primary mt-1"></i>
                            <span>Fasilitas cicilan atau pembayaran bertahap dapat dikonsultasikan melalui Bagian Keuangan FEB UNESA sesuai ketentuan yang berlaku.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
