@extends('layouts.app')

@section('title', 'Sejarah Singkat Program | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Sejarah berdirinya Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya yang tercatat berdiri pada 23 Mei 2025.')

@section('content')

@include('partials.page-header', [
    'title' => 'Sejarah Singkat Program',
    'badge' => 'Profil Program Studi',
    'lead' => 'Pendirian Pendidikan Profesi Akuntan sebagai wujud pengembangan program pendidikan profesi di lingkungan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.',
    'breadcrumbs' => [
        ['label' => 'Profil', 'url' => route('profil.sejarah')],
        ['label' => 'Sejarah Singkat', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        <div class="row g-5">
            {{-- Left column: Factual History Narrative --}}
            <div class="col-lg-8">
                <article class="pe-lg-4">
                    <span class="badge-ppak badge-ppak-gold mb-2">LATAR BELAKANG & PENDIRIAN</span>
                    <h2 class="h3 text-navy mb-4">Pengembangan Program Pendidikan Profesi di FEB UNESA</h2>
                    <p class="lead text-dark">Program Studi Pendidikan Profesi Akuntan (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya tercatat resmi berdiri pada tanggal <strong>23 Mei 2025</strong> dengan kode program studi <strong>62902</strong>.</p><p>Pendirian program studi ini merupakan bagian integral dari implementasi dokumen rencana strategis Fakultas Ekonomika dan Bisnis (FEB) UNESA dalam memperluas cakupan layanan pendidikan tinggi, khususnya pada jenjang pendidikan keprofesian akuntansi setelah jenjang sarjana.</p><p>Sebagai institusi yang memiliki tradisi akademik di bidang ilmu ekonomi, manajemen, dan akuntansi, FEB UNESA mengembangkan program Pendidikan Profesi Akuntan untuk menjembatani kompetensi lulusan sarjana akuntansi dengan tuntutan standar kompetensi kerja profesional di bidang pelaporan keuangan, audit dan asurans, perpajakan, serta tata kelola korporat.</p>

                    <div class="p-4 rounded-3 border bg-subtle my-4">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <i class="fa-solid fa-landmark text-navy fs-4"></i>
                            <h3 class="fs-6 fw-bold text-navy mb-0">Legalitas & Akreditasi Program</h3>
                        </div>
                        <p class="small text-secondary mb-2">Pendidikan Profesi Akuntan FEB UNESA telah memperoleh status akreditasi <strong>Baik</strong> dari Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi (LAMEMBA) berdasarkan Keputusan No. <strong>611/DE/A.5/AR.11/II/2025</strong> tanggal 26 Februari 2025 dengan masa berlaku hingga 25 Februari 2027.</p>
                        <div class="small text-muted">
                            <i class="fa-solid fa-link me-1"></i> Sumber: SIMUTU UNESA & SINDIG UNESA (Kode Prodi: 62902)
                        </div>
                    </div>

                    <h3 class="h4 text-navy mt-4 mb-3">Fokus Penyelenggaraan Pembelajaran</h3>
                    <p>Penyelenggaraan program studi diarahkan pada pemenuhan Capaian Pembelajaran Lulusan (CPL) yang mencakup integritas etika akademik, karakter tangguh dan kolaboratif, pemikiran logis dan kritis sesuai standar kerja, serta kemampuan pengembangan diri berkelanjutan dalam ekosistem profesi akuntan.</p>
                </article>
            </div>

            {{-- Right column: Key Institutional Facts Card --}}
            <div class="col-lg-4">
                <div class="p-4 rounded-3 border bg-subtle sticky-top" style="top: 100px;">
                    <h3 class="fs-6 fw-bold text-navy text-uppercase tracking-wider mb-3">
                        <i class="fa-solid fa-circle-info text-primary me-2"></i>Fakta Institusional
                    </h3>
                    
                    <ul class="list-unstyled d-flex flex-column gap-3 small mb-4">
                        <li class="p-3 bg-white rounded-3 border">
                            <div class="text-muted" style="font-size: 0.75rem;">Nama Resmi Program:</div>
                            <div class="fw-bold text-navy">{{ $info['name'] ?? 'Pendidikan Profesi Akuntan' }}</div>
                        </li>
                        <li class="p-3 bg-white rounded-3 border">
                            <div class="text-muted" style="font-size: 0.75rem;">Kode Program Studi:</div>
                            <div class="fw-bold text-navy font-monospace">{{ $info['program_code'] ?? '62902' }}</div>
                        </li>
                        <li class="p-3 bg-white rounded-3 border">
                            <div class="text-muted" style="font-size: 0.75rem;">Tanggal Berdiri:</div>
                            <div class="fw-bold text-navy">{{ $info['established_date'] ?? '23 Mei 2025' }}</div>
                        </li>
                        <li class="p-3 bg-white rounded-3 border">
                            <div class="text-muted" style="font-size: 0.75rem;">Koordinator Program Studi:</div>
                            <div class="fw-bold text-navy">{{ $info['coordinator'] ?? 'Rediyanto Putra, S.E., M.S.A.' }}</div>
                        </li>
                        <li class="p-3 bg-white rounded-3 border">
                            <div class="text-muted" style="font-size: 0.75rem;">Status Akreditasi:</div>
                            <div class="fw-bold text-navy">{{ $info['akreditasi_status'] ?? 'Baik' }} ({{ $info['akreditasi_lembaga'] ?? 'LAMEMBA' }})</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Masa Berlaku s.d. {{ $info['masa_berlaku_akreditasi'] ?? '25 Februari 2027' }}</div>
                        </li>
                    </ul>

                    <div class="pt-2 border-top">
                        <a href="{{ route('profil.struktur-organisasi') }}" class="btn-ppak-secondary w-100 btn-ppak-sm text-center">
                            <span>Struktur Organisasi</span>
                            <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


