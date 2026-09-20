@extends('layouts.app')

@section('title', 'Struktur Organisasi | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Bagan dan tata kelola struktur organisasi Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => $pg['header_title']['heading'] ?? 'Struktur Organisasi',
    'badge' => $pg['header_badge']['heading'] ?? 'Tata Kelola Kelembagaan',
    'lead' => $pg['header_lead']['body'] ?? 'Hierarki tata kelola kelembagaan Program Studi Pendidikan Profesi Akuntan di lingkungan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.',
    'breadcrumbs' => [
        ['label' => 'Profil', 'url' => route('profil.sejarah')],
        ['label' => 'Struktur Organisasi', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-gold mb-2">Hierarki Tata Kelola</span>
            <h2>{{ $pg['intro_heading']['heading'] ?? 'Struktur Organisasi & Kepemimpinan' }}</h2>
            <div class="golden-line center"></div>
            {!! $pg['intro_body']['body'] ?? '<p class="text-secondary">Hubungan kelembagaan Program Studi Pendidikan Profesi Akuntan dalam struktur tata kelola Universitas Negeri Surabaya dan Fakultas Ekonomika dan Bisnis.</p>' !!}
        </div>

        {{-- ORGANIZATIONAL HIERARCHY CHART --}}
        <div class="p-4 p-md-5 rounded-4 border bg-subtle mb-5">
            <div class="org-tree">
                {{-- Level 1: Universitas Negeri Surabaya --}}
                <div class="org-level">
                    <div class="org-card" style="border-top: 4px solid var(--unesa-navy); min-width: 300px;">
                        <div class="org-role">{{ $pg['org_1_role']['heading'] ?? 'Tingkat Universitas' }}</div>
                        <div class="org-name">{{ $pg['org_1_name']['heading'] ?? 'Universitas Negeri Surabaya' }}</div>
                        <div class="org-subtext">{{ $pg['org_1_sub']['body'] ?? 'Perguruan Tinggi Negeri Badan Hukum (PTN-BH)' }}</div>
                    </div>
                </div>

                {{-- Connector --}}
                <div class="text-muted small"><i class="fa-solid fa-arrow-down"></i></div>

                {{-- Level 2: Fakultas Ekonomika dan Bisnis --}}
                <div class="org-level">
                    <div class="org-card" style="border-top: 4px solid var(--unesa-blue); min-width: 320px;">
                        <div class="org-role">{{ $pg['org_2_role']['heading'] ?? 'Tingkat Fakultas' }}</div>
                        <div class="org-name">{{ $pg['org_2_name']['heading'] ?? 'Fakultas Ekonomika dan Bisnis (FEB)' }}</div>
                        <div class="org-subtext">{{ $pg['org_2_sub']['body'] ?? 'Dekan, Wakil Dekan, Senat Fakultas & Kantor Tata Usaha' }}</div>
                    </div>
                </div>

                {{-- Connector --}}
                <div class="text-muted small"><i class="fa-solid fa-arrow-down"></i></div>

                {{-- Level 3: Program Studi Pendidikan Profesi Akuntan --}}
                <div class="org-level">
                    <div class="org-card" style="border-top: 4px solid var(--unesa-gold); min-width: 320px; background: #ffffff;">
                        <div class="org-role">{{ $pg['org_3_role']['heading'] ?? 'Tingkat Program Studi' }}</div>
                        <div class="org-name">{{ $pg['org_3_name']['heading'] ?? 'Pendidikan Profesi Akuntan (PPAk)' }}</div>
                        <div class="org-subtext">Kode Program Studi: {{ $info['program_code'] ?? '62902' }} &bull; Berdiri: {{ $info['established_date'] ?? '23 Mei 2025' }}</div>
                    </div>
                </div>

                {{-- Connector --}}
                <div class="text-muted small"><i class="fa-solid fa-arrow-down"></i></div>

                {{-- Level 4: Koordinator Program Studi --}}
                <div class="org-level">
                    <div class="org-card org-card-leader" style="min-width: 320px; box-shadow: var(--shadow-md);">
                        <div class="org-role">{{ $pg['org_4_role']['heading'] ?? 'Koordinator Program Studi' }}</div>
                        <div class="org-name">{{ $info['coordinator'] ?? 'Rediyanto Putra, S.E., M.S.A.' }}</div>
                        <div class="org-subtext text-light opacity-75">{{ $pg['org_4_sub']['body'] ?? 'Koordinator Program Studi Pendidikan Profesi Akuntan' }}</div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 pt-3 border-top">
                <a href="https://feb.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary btn-ppak-sm">
                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
                    <span>Kunjungi Laman Struktur Organisasi FEB UNESA</span>
                </a>
            </div>
        </div>

        {{-- Tata Kelola Fakultas & Layanan Pendukung --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon-wrapper">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-0">{{ $pg['kartu_1_heading']['heading'] ?? 'Pimpinan Fakultas' }}</h3>
                    </div>
                    {!! $pg['kartu_1_body']['body'] ?? '<p class="small text-secondary mb-0">Tata kelola fakultas dipimpin oleh Dekan bersama para Wakil Dekan bidang akademik, keuangan & sumber daya, serta kemahasiswaan dan alumni yang menetapkan kebijakan strategis bagi seluruh program studi di FEB UNESA.</p>' !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon-wrapper">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-0">{{ $pg['kartu_2_heading']['heading'] ?? 'Koordinasi Program Studi' }}</h3>
                    </div>
                    {!! $pg['kartu_2_body']['body'] ?? '<p class="small text-secondary mb-0">Penyelenggaraan operasional kurikulum, penugasan dosen pengampu, evaluasi proses pembelajaran, dan layanan mahasiswa dikoordinasikan secara langsung oleh Koordinator Program Studi.</p>' !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-ppak-flat h-100 bg-white shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon-wrapper">
                            <i class="fa-solid fa-flask"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-0">{{ $pg['kartu_3_heading']['heading'] ?? 'Laboratorium & Layanan Terpadu' }}</h3>
                    </div>
                    {!! $pg['kartu_3_body']['body'] ?? '<p class="small text-secondary mb-0">Didukung oleh fasilitas Laboratorium Akuntansi Komputer FEB UNESA, sarana perpustakaan fakultas, serta unit tata usaha FEB untuk administrasi persuratan dan bantuan teknis perkuliahan.</p>' !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

