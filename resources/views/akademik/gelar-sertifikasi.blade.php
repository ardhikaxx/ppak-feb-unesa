@extends('layouts.app')

@section('title', 'Gelar & Sertifikasi Profesi | PPAk FEB UNESA')
@section('meta_description', 'Informasi jalur penyetaraan gelar profesi Akuntan (Ak.), sertifikasi Chartered Accountant (CA) IAI, dan Certified Public Accountant (CPA) IAPI.')

@section('content')

@include('partials.page-header', [
    'title' => 'Gelar Profesi & Sertifikasi Akuntan',
    'badge' => 'Pengakuan Kualifikasi Nasional & Regional',
    'lead' => 'Memahami jalur kualifikasi keprofesian akuntan: Sebutan Akuntan (Ak.), Chartered Accountant (CA), dan Certified Public Accountant (CPA).',
    'breadcrumbs' => [
        ['label' => 'Akademik', 'url' => route('akademik.kurikulum')],
        ['label' => 'Gelar & Sertifikasi', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Penjelasan Sebutan Akuntan --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle mb-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-8">
                    <span class="badge-ppak badge-ppak-blue mb-2">Gelar Profesi Resmi</span>
                    <h2 class="h3 text-navy mb-3">Sebutan Profesi Akuntan (Ak.)</h2>
                    <p class="lead mb-3">
                        Lulusan Program Pendidikan Profesi Akuntansi (PPAk) berhak menyandang sebutan profesi <strong>Akuntan (Ak.)</strong> yang disematkan di belakang nama dan diakui secara legal oleh negara Republik Indonesia.
                    </p>
                    <p class="text-secondary small mb-0">
                        Sesuai Peraturan Menteri Keuangan, lulusan PPAk yang telah dinyatakan lulus berhak mengajukan permohonan pendaftaran ke Kementerian Keuangan RI untuk memperoleh <strong>Register Negara Akuntan (RNA)</strong> yang dikelola oleh Pusat Pembinaan Profesi Keuangan (PPPK).
                    </p>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="p-4 rounded-3 bg-white border shadow-sm">
                        <i class="fa-solid fa-graduation-cap text-primary display-4 mb-2"></i>
                        <div class="fw-bold text-navy fs-5">Akuntan (Ak.)</div>
                        <div class="small text-muted mb-2">Beregister Negara Kemenkeu</div>
                        <span class="badge-ppak badge-ppak-navy" style="font-size: 0.725rem;">KKNI Jenjang 7</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- JALUR SERTIFIKASI PROFESI (CA, CPA, ASEAN CPA) --}}
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-1">Chartered Accountant (CA)</h3>
                    <div class="badge-ppak badge-ppak-blue mb-3" style="font-size: 0.7rem;">Ikatan Akuntan Indonesia (IAI)</div>
                    <p class="small text-secondary mb-3">
                        Kualifikasi akuntan profesional terstandarisasi yang diakui secara luas di sektor korporasi, perbankan, BUMN, dan lembaga pemerintahan. Kurikulum PPAk FEB UNESA menyediakan skema penyetaraan (waiver) modul tertentu bagi mahasiswa.
                    </p>
                    <ul class="list-unstyled small text-muted mb-0">
                        <li class="mb-1"><i class="fa-solid fa-check text-primary me-2"></i>Waiver modul ujian dasar/profesi</li>
                        <li class="mb-1"><i class="fa-solid fa-check text-primary me-2"></i>Pengakuan standar IFAC</li>
                        <li><i class="fa-solid fa-check text-primary me-2"></i>Kesiapan ujian studi kasus tingkat akhir</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-magnifying-glass-dollar"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-1">Certified Public Accountant (CPA)</h3>
                    <div class="badge-ppak badge-ppak-gold mb-3" style="font-size: 0.7rem;">Institut Akuntan Publik Indonesia (IAPI)</div>
                    <p class="small text-secondary mb-3">
                        Sertifikasi tertinggi bagi para praktisi audit yang berkeinginan mendirikan atau menjadi partner pada Kantor Akuntan Publik (KAP) serta menandatangani laporan opini auditor independen.
                    </p>
                    <ul class="list-unstyled small text-muted mb-0">
                        <li class="mb-1"><i class="fa-solid fa-check text-primary me-2"></i>Prasyarat izin praktik Akuntan Publik (AP)</li>
                        <li class="mb-1"><i class="fa-solid fa-check text-primary me-2"></i>Penguasaan mendalam SPAP & ISA</li>
                        <li><i class="fa-solid fa-check text-primary me-2"></i>Pelatihan audit praktik intensif di PPAk</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100">
                    <div class="feature-icon-wrapper mb-3">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-1">ASEAN CPA</h3>
                    <div class="badge-ppak badge-ppak-navy mb-3" style="font-size: 0.7rem;">ASEAN Chartered Professional Accountant</div>
                    <p class="small text-secondary mb-3">
                        Fasilitasi mobilitas profesional akuntansi di kawasan negara-negara anggota ASEAN melalui skema Mutual Recognition Arrangement (MRA) on Accountancy Services.
                    </p>
                    <ul class="list-unstyled small text-muted mb-0">
                        <li class="mb-1"><i class="fa-solid fa-check text-primary me-2"></i>Peluang karier regional Asia Tenggara</li>
                        <li class="mb-1"><i class="fa-solid fa-check text-primary me-2"></i>Registrasi melalui ASEAN CPA Coordinating Committee</li>
                        <li><i class="fa-solid fa-check text-primary me-2"></i>Pemberian jasa konsultansi lintas batas</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Alur Karier Profesi --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle">
            <h3 class="fs-6 fw-bold text-navy text-uppercase tracking-wider mb-4">
                <i class="fa-solid fa-stairs text-primary me-2"></i>Alur Menjadi Akuntan Beregister & Praktisi
            </h3>
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="p-3 bg-white rounded-3 border h-100">
                        <span class="badge-ppak badge-ppak-navy mb-2">Langkah 1</span>
                        <div class="fw-bold text-navy small mb-1">Sarjana (S1) Akuntansi</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Menyelesaikan program akademik sarjana terakreditasi.</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3 bg-white rounded-3 border h-100">
                        <span class="badge-ppak badge-ppak-blue mb-2">Langkah 2</span>
                        <div class="fw-bold text-navy small mb-1">PPAk FEB UNESA</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Menuntaskan 24 SKS pendidikan profesi dan meraih sebutan Ak.</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3 bg-white rounded-3 border h-100">
                        <span class="badge-ppak badge-ppak-gold mb-2">Langkah 3</span>
                        <div class="fw-bold text-navy small mb-1">Ujian CA / CPA</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Menempuh ujian modul sertifikasi profesi melalui skema waiver.</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3 bg-white rounded-3 border h-100">
                        <span class="badge-ppak badge-ppak-green mb-2">Langkah 4</span>
                        <div class="fw-bold text-navy small mb-1">Izin Praktik & Karier</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Pengalaman praktik kerja profesional dan izin Akuntan Publik/CFO.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
