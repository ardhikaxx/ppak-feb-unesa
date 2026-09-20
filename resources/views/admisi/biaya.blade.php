@extends('layouts.app')

@section('title', 'Biaya Pendidikan & Investasi Studi | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Informasi resmi Uang Kuliah Tunggal (UKT) Program Studi Pendidikan Profesi Akuntan FEB UNESA sebesar Rp5.500.000 per semester berdasarkan data Admisi UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Biaya Pendidikan & Investasi Studi',
    'badge' => 'Informasi Biaya Resmi',
    'lead' => 'Besaran Uang Kuliah Tunggal (UKT) Program Studi Pendidikan Profesi Akuntan berdasarkan penetapan resmi Admisi UNESA.',
    'breadcrumbs' => [
        ['label' => 'Admisi', 'url' => route('admisi.jalur-syarat')],
        ['label' => 'Biaya Pendidikan', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Source Attribution Notice --}}
        <div class="p-3 px-4 rounded-3 border bg-subtle mb-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div class="small text-secondary">
                <i class="fa-solid fa-circle-info text-primary me-1"></i> <strong>Data Biaya Resmi:</strong> Berdasarkan informasi yang tercantum pada laman <strong>Admisi UNESA</strong> (Kategori Tarif UKT S2, S3, dan Profesi).
            </div>
            <a href="https://admisi.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary btn-ppak-sm text-nowrap">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
                <span>Lihat Laman Admisi UNESA</span>
            </a>
        </div>

        {{-- CARD UTAMA UKT --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-white shadow-sm mb-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge-ppak badge-ppak-gold mb-2">Tarif UKT Resmi (Periode 2026)</span>
                    <h2 class="h3 text-navy fw-bold mb-2">Uang Kuliah Tunggal (UKT) Profesi</h2>
                    <p class="text-secondary small mb-3">
                        Besaran Uang Kuliah Tunggal (UKT) Program Studi Pendidikan Profesi Akuntan (Kode: <strong>62902</strong>) pada Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya:
                    </p>
                    <div class="display-5 fw-bold text-navy mb-2">Rp{{ number_format($admisi['ukt'] ?? 5500000, 0, ',', '.') }} <span class="fs-6 text-muted fw-normal">/ semester</span></div>
                    <div class="small text-muted">
                        <i class="fa-solid fa-check text-success me-1"></i> Tarif berlaku per semester untuk mahasiswa Program Studi Pendidikan Profesi Akuntan.
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-4 rounded-3 bg-subtle border">
                        <div class="fw-bold text-navy small mb-2"><i class="fa-solid fa-receipt text-primary me-1"></i> Catatan Pendaftaran & Biaya Seleksi:</div>
                        <p class="small text-secondary mb-2" style="line-height: 1.55;">
                            Biaya pendaftaran seleksi penerimaan mahasiswa baru mengikuti ketentuan tarif pendaftaran umum yang berlaku pada sistem Admisi PMB Universitas Negeri Surabaya.
                        </p>
                        <div class="small text-muted" style="font-size: 0.75rem;">
                            *Pembayaran biaya seleksi maupun UKT dilakukan secara terpusat melalui Virtual Account (VA) perbankan mitra resmi UNESA.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KANAL PEMBAYARAN RESMI --}}
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card-ppak-flat h-100 bg-subtle">
                    <h3 class="fs-6 fw-bold text-navy mb-3"><i class="fa-solid fa-building-columns text-primary me-2"></i>Kanal Pembayaran Resmi Bank Mitra UNESA</h3>
                    <p class="small text-secondary mb-3">Seluruh transaksi pembayaran biaya pendaftaran maupun UKT semester menggunakan kode <strong>Virtual Account (VA)</strong> resmi yang diterbitkan oleh sistem PMB/SIAKAD UNESA:</p>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge-ppak badge-ppak-navy">Bank Mandiri</span>
                        <span class="badge-ppak badge-ppak-navy">Bank BTN</span>
                        <span class="badge-ppak badge-ppak-navy">Bank BNI</span>
                        <span class="badge-ppak badge-ppak-navy">Bank BRI</span>
                        <span class="badge-ppak badge-ppak-navy">Bank Syariah Indonesia (BSI)</span>
                    </div>
                    <div class="p-2 rounded-2 bg-white border small text-danger" style="font-size: 0.775rem;">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i> UNESA tidak pernah melayani pembayaran di luar kode Virtual Account resmi atau melalui rekening perorangan.
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-ppak-flat h-100 bg-subtle">
                    <h3 class="fs-6 fw-bold text-navy mb-3"><i class="fa-solid fa-circle-question text-primary me-2"></i>Konsultasi Informasi Keuangan</h3>
                    <p class="small text-secondary mb-3">
                        Untuk konfirmasi teknis validasi Virtual Account atau pertanyaan seputar registrasi ulang pembayaran UKT, Anda dapat menghubungi saluran resmi:
                    </p>
                    <ul class="list-unstyled small text-secondary mb-0">
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="fa-solid fa-envelope text-gold"></i>
                            <span>Email: <a href="mailto:{{ $info['email'] ?? 'ppak.feb@unesa.ac.id' }}" class="text-navy text-decoration-none">{{ $info['email'] ?? 'ppak.feb@unesa.ac.id' }}</a></span>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="fa-solid fa-phone text-gold"></i>
                            <span>Telepon: {{ $info['phone'] ?? '+62 31 828 0009' }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-location-dot text-gold"></i>
                            <span>Lokasi: {{ $info['address'] ?? 'Gedung G6 FEB Kampus Ketintang Surabaya' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @include('partials.related-links', ['links' => [
            ['label' => 'Syarat dokumen pendaftaran', 'url' => route('admisi.jalur-syarat'), 'desc' => 'Berkas yang perlu disiapkan sebelum membayar biaya seleksi.'],
            ['label' => 'Jadwal gelombang dan pengumuman', 'url' => route('admisi.prosedur-jadwal'), 'desc' => 'Batas waktu pembayaran dan daftar ulang tiap gelombang.'],
            ['label' => 'Pertanyaan seputar biaya', 'url' => route('admisi.faq'), 'desc' => 'Klarifikasi umum mengenai UKT dan pembayaran.'],
        ]])
    </div>
</section>

@endsection


