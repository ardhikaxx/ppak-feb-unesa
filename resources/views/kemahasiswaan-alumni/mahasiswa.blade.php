@extends('layouts.app')

@section('title', 'Komunitas & Aktivitas Mahasiswa | PPAk FEB UNESA')
@section('meta_description', 'Aktivitas akademik, forum kajian keprofesian, workshop kompetensi, dan jejaring komunitas mahasiswa Pendidikan Profesi Akuntansi FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Komunitas & Aktivitas Mahasiswa',
    'badge' => 'Dinamika Akademik & Kemahasiswaan',
    'lead' => 'Keluarga besar mahasiswa PPAk FEB UNESA aktif dalam pengayaan wawasan profesional, riset studi kasus, dan pembinaan soft skill kepemimpinan.',
    'breadcrumbs' => [
        ['label' => 'Kemahasiswaan & Alumni', 'url' => route('kemahasiswaan-alumni.alumni')],
        ['label' => 'Komunitas Mahasiswa', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Aktivitas Kemahasiswaan Grid --}}
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-users-rectangle"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">IFRS & PSAK Discussion Forum</h3>
                    <p class="small text-secondary mb-0">
                        Kelompok diskusi mingguan yang mengupas implementasi standar pelaporan keuangan terkini, studi kasus transaksi antarperusahaan berelasi, serta instrumen lindung nilai (hedging).
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Audit Analytics Working Group</h3>
                    <p class="small text-secondary mb-0">
                        Komunitas praktika penggunaan software pengujian data audit berbasis CAATs, simulasi kertas kerja audit elektronik, serta visualisasi data keuangan menggunakan Power BI.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Tax Law Study Club</h3>
                    <p class="small text-secondary mb-0">
                        Kelompok telaah regulasi perpajakan yang aktif mengkaji putusan pengadilan pajak, strategi mitigasi dispute transfer pricing, dan simulasi pengoperasian sistem Coretax.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Kompetisi Kasus Bisnis & Audit</h3>
                    <p class="small text-secondary mb-0">
                        Delegasi mahasiswa PPAk rutin berpartisipasi dalam kompetisi studi kasus audit tingkat nasional dan konferensi ilmiah akuntansi yang diselenggarakan oleh universitas mitra.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Bakti Sosial & Literasi Keuangan</h3>
                    <p class="small text-secondary mb-0">
                        Program sosial edukasi pembukuan sederhana dan pengelolaan keuangan keluarga bagi masyarakat prasejahtera serta pelaku usaha mikro di wilayah sekitar kampus.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">CA Exam Preparation Buddy</h3>
                    <p class="small text-secondary mb-0">
                        Sistem belajar kelompok terstruktur untuk saling mereview modul ujian sertifikasi Chartered Accountant Indonesia dengan bimbingan tutor dosen pendamping.
                    </p>
                </div>
            </div>
        </div>

        {{-- Suasana Kampus & Fasilitas --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="badge-ppak badge-ppak-gold mb-2">Fasilitas Penunjang</span>
                    <h3 class="h4 text-navy mb-3">Lingkungan Akademik yang Nyaman & Modern</h3>
                    <p class="text-secondary small mb-3">
                        Perkuliahan didukung ruang kelas eksekutif ber-AC, proyektor interaktif, laboratorium komputasi audit terlisensi, perpustakaan dengan akses jurnal internasional terindeks Scopus, serta koneksi internet berkecepatan tinggi di Gedung G6 FEB UNESA Kampus Ketintang.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('informasi.galeri') }}" class="btn-ppak-secondary btn-ppak-sm">
                            <i class="fa-solid fa-images me-1"></i>
                            <span>Lihat Galeri Fasilitas & Kegiatan</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80" alt="Ruang Perkuliahan dan Diskusi Mahasiswa FEB UNESA" class="img-fluid rounded-3 border shadow-sm">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
