@extends('layouts.app')

@section('title', 'Struktur Organisasi | PPAk FEB UNESA')
@section('meta_description', 'Bagan dan tata kelola struktur organisasi Program Pendidikan Profesi Akuntansi Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => 'Struktur Organisasi',
    'badge' => 'Tata Kelola Program',
    'lead' => 'Susunan pimpinan pengelola, penjaminan mutu akademik, dan staf pendukung operasional Pendidikan Profesi Akuntansi FEB UNESA.',
    'breadcrumbs' => [
        ['label' => 'Profil', 'url' => route('profil.sejarah')],
        ['label' => 'Struktur Organisasi', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge-ppak badge-ppak-blue mb-2">Bagan Kepemimpinan</span>
            <h2>Tata Kelola Program Studi PPAk</h2>
            <p class="text-secondary">
                Bagan struktural dirancang dengan garis koordinasi yang jelas guna menjamin mutu pelayanan akademik prima dan akuntabilitas penyelenggaraan profesi.
            </p>
        </div>

        {{-- ORGANIZATIONAL CHART (Pure Semantic Responsive HTML/CSS) --}}
        <div class="p-4 p-md-5 rounded-4 border bg-subtle mb-5">
            <div class="org-tree">
                {{-- Level 1: Pembina / Dekan --}}
                <div class="org-level">
                    <div class="org-card" style="border-top: 4px solid var(--ppak-navy);">
                        <div class="org-role">Pembina Program</div>
                        <div class="org-name">Prof. Dr. [Nama Dekan], S.E., M.Si.</div>
                        <div class="org-subtext">Dekan Fakultas Ekonomika dan Bisnis</div>
                    </div>
                </div>

                {{-- Connecting line indicator --}}
                <div class="text-muted small"><i class="fa-solid fa-arrow-down"></i></div>

                {{-- Level 2: Ketua Program Studi --}}
                <div class="org-level">
                    <div class="org-card org-card-leader" style="min-width: 280px; box-shadow: var(--shadow-md);">
                        <div class="org-role">Ketua Program Studi PPAk</div>
                        <div class="org-name">Dr. [Nama Kaprodi], S.E., M.Ak., Ak., CA., CPA.</div>
                        <div class="org-subtext text-light opacity-75">NIP/NIDN: [Nomor Identitas Dosen]</div>
                    </div>
                </div>

                {{-- Connecting line indicator --}}
                <div class="text-muted small"><i class="fa-solid fa-arrow-down"></i></div>

                {{-- Level 3: Sekretaris Prodi & Penjaminan Mutu --}}
                <div class="org-level">
                    <div class="org-card" style="border-top: 4px solid var(--ppak-blue);">
                        <div class="org-role">Sekretaris Program Studi</div>
                        <div class="org-name">Dr. [Nama Sekprodi], S.Pd., M.Ak., CMA.</div>
                        <div class="org-subtext">Pengelolaan Operasional & Kemahasiswaan</div>
                    </div>

                    <div class="org-card" style="border-top: 4px solid var(--ppak-gold);">
                        <div class="org-role">Gugus Penjaminan Mutu (GPM)</div>
                        <div class="org-name">[Nama Dosen GPM], S.E., M.Sc., Ak., CA.</div>
                        <div class="org-subtext">Pengendalian Mutu Akademik & Akreditasi</div>
                    </div>
                </div>

                {{-- Connecting line indicator --}}
                <div class="text-muted small"><i class="fa-solid fa-arrow-down"></i></div>

                {{-- Level 4: Koordinator Bidang --}}
                <div class="org-level">
                    <div class="org-card">
                        <div class="org-role">Koordinator Kurikulum & Ujian Profesi</div>
                        <div class="org-name">[Nama Dosen], S.E., M.Ak., Ak., CA.</div>
                        <div class="org-subtext">Integrasi Silabus IAI & Ujian CA</div>
                    </div>

                    <div class="org-card">
                        <div class="org-role">Koordinator Kerja Sama & Kemitraan KAP</div>
                        <div class="org-name">[Nama Dosen / Praktisi], M.M., CPA.</div>
                        <div class="org-subtext">Penempatan Magang & Rekrutmen Kerja</div>
                    </div>

                    <div class="org-card">
                        <div class="org-role">Koordinator Laboratorium & TI</div>
                        <div class="org-name">[Nama Dosen TI], M.Kom., CertDA.</div>
                        <div class="org-subtext">Audit Software & Analitika Data</div>
                    </div>
                </div>

                {{-- Connecting line indicator --}}
                <div class="text-muted small"><i class="fa-solid fa-arrow-down"></i></div>

                {{-- Level 5: Staf Sekretariat & Teknis --}}
                <div class="org-level">
                    <div class="org-card" style="min-width: 200px;">
                        <div class="org-role">Staf Administrasi Akademik</div>
                        <div class="org-name">[Nama Tenaga Kependidikan 1]</div>
                        <div class="org-subtext">Layanan Mahasiswa & Registrasi</div>
                    </div>

                    <div class="org-card" style="min-width: 200px;">
                        <div class="org-role">Staf Administrasi Keuangan</div>
                        <div class="org-name">[Nama Tenaga Kependidikan 2]</div>
                        <div class="org-subtext">Verifikasi UKT & Administrasi VA</div>
                    </div>

                    <div class="org-card" style="min-width: 200px;">
                        <div class="org-role">Teknisi Laboratorium Komputer</div>
                        <div class="org-name">[Nama Pranata Komputer]</div>
                        <div class="org-subtext">Pemeliharaan Software Audit & Jaringan</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Uraian Tugas Pokok & Fungsi --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-ppak-flat h-100">
                    <h3 class="fs-6 fw-bold text-navy mb-2"><i class="fa-solid fa-user-check text-primary me-2"></i>Pimpinan Program Studi</h3>
                    <p class="small text-secondary mb-0">
                        Bertanggung jawab atas kepemimpinan akademis, perencanaan kurikulum, manajemen sumber daya pengajar, serta menjalin kerja sama strategis dengan asosiasi profesi dan regulator.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-ppak-flat h-100">
                    <h3 class="fs-6 fw-bold text-navy mb-2"><i class="fa-solid fa-shield-halved text-primary me-2"></i>Gugus Penjaminan Mutu</h3>
                    <p class="small text-secondary mb-0">
                        Melakukan monitoring dan evaluasi berkala terhadap proses belajar mengajar, survei kepuasan mahasiswa, audit mutu internal, serta pemenuhan standar akreditasi LAMEMBA.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-ppak-flat h-100">
                    <h3 class="fs-6 fw-bold text-navy mb-2"><i class="fa-solid fa-headset text-primary me-2"></i>Sekretariat & Helpdesk</h3>
                    <p class="small text-secondary mb-0">
                        Menyelenggarakan layanan prima bagi mahasiswa, pendaftaran ujian sertifikasi, legalisir dokumen akademik, serta dukungan teknis laboratorium perpajakan dan audit.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
