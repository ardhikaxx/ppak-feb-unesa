@extends('layouts.app')

@section('title', 'Aktivitas Akademik & Pembelajaran | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Aktivitas akademik, perkuliahan terstruktur, magang praktik kerja industri, dan kegiatan pembelajaran mahasiswa Pendidikan Profesi Akuntan FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Aktivitas Akademik & Pembelajaran',
    'badge' => 'Dinamika Pembelajaran Profesi',
    'lead' => 'Rangkaian kegiatan perkuliahan terstruktur, praktika kertas kerja, magang industri, dan diskusi keprofesian mahasiswa Pendidikan Profesi Akuntan.',
    'breadcrumbs' => [
        ['label' => 'Kemahasiswaan & Alumni', 'url' => route('kemahasiswaan-alumni.alumni')],
        ['label' => 'Aktivitas Pembelajaran', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Section Intro --}}
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-gold mb-2">DINAMIKA AKADEMIK</span>
            <h2>Aktivitas Pembelajaran Pendidikan Profesi</h2>
            <div class="golden-line center"></div>
            <p class="text-secondary">Aktivitas perkuliahan dirancang komprehensif mengintegrasikan penguasaan teori lanjutan dan aplikasi praktik nyata di bidang akuntansi profesional.</p>
        </div>

        {{-- Aktivitas Pembelajaran Grid --}}
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Perkuliahan Tatap Muka Terstruktur</h3>
                    <p class="small text-secondary mb-0">Pendalaman materi mata kuliah inti seperti Pelaporan Korporat, Audit dan Asurans, serta Manajemen Pajak dengan pendekatan studi kasus nyata.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Magang Praktik Profesi (Internship)</h3>
                    <p class="small text-secondary mb-0">Pelaksanaan penugasan magang industri (4 SKS) pada kantor akuntan publik, divisi keuangan korporasi, atau konsultan perpajakan dengan bimbingan mentor.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Praktika Laboratorium Akuntansi</h3>
                    <p class="small text-secondary mb-0">Simulasi pengolahan data transaksi keuangan, kertas kerja audit elektronik, serta analisis sistem informasi pengendalian internal berbasis komputer.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Diskusi Standar & Regulasi Terkini</h3>
                    <p class="small text-secondary mb-0">Forum telaah implementasi Standar Akuntansi Keuangan (SAK), regulasi administrasi perpajakan, dan tata kelola risiko korporasi (GRC).</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Pembinaan Etika & Skeptisisme</h3>
                    <p class="small text-secondary mb-0">Penanaman integritas dan independensi akuntan dalam menghadapi dilema etika pelaporan keuangan dan penugasan perikatan asurans.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Evaluasi Formatif & Sumatif</h3>
                    <p class="small text-secondary mb-0">Pengukuran capaian kompetensi secara berkala melalui ujian formatif (UTS) dan sumatif (UAS) sesuai Kalender Akademik UNESA 2026/2027.</p>
                </div>
            </div>
        </div>

        {{-- Fasilitas Pembelajaran FEB UNESA --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge-ppak badge-ppak-gold mb-2">Sarana Perkuliahan</span>
                    <h3 class="h4 text-navy mb-3">Fasilitas Pembelajaran Kampus Ketintang</h3>
                    <p class="text-secondary small mb-3">Aktivitas perkuliahan dipusatkan di Gedung G6 Fakultas Ekonomika dan Bisnis UNESA Kampus Ketintang Surabaya, didukung ruang kelas representatif, perpustakaan fakultas, dan Laboratorium Akuntansi Komputer Terpadu.</p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('akademik.kurikulum') }}" class="btn-ppak-primary btn-ppak-sm">
                            <span>Lihat Kurikulum</span>
                            <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                        <a href="{{ route('informasi.galeri') }}" class="btn-ppak-secondary btn-ppak-sm">
                            <i class="fa-solid fa-images me-1"></i>
                            <span>Galeri Dokumentasi</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-3 bg-white rounded-3 border shadow-sm text-center">
                        <i class="fa-solid fa-building-columns text-navy display-4 mb-2"></i>
                        <div class="fw-bold text-navy small">Gedung G6 FEB UNESA</div>
                        <div class="text-muted small">Kampus Ketintang, Surabaya</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



