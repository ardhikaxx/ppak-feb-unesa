@extends('layouts.app')

@section('title', 'Visi, Misi & Tujuan | PPAk FEB UNESA')
@section('meta_description', 'Visi, Misi, Tujuan, dan Nilai-Nilai Utama Program Pendidikan Profesi Akuntansi Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => 'Visi, Misi & Tujuan',
    'badge' => 'Arah & Komitmen Strategis',
    'lead' => 'Landasan filosofis dan komitmen strategis PPAk FEB UNESA dalam menyelenggarakan pendidikan keprofesian akuntan bertaraf internasional.',
    'breadcrumbs' => [
        ['label' => 'Profil', 'url' => route('profil.sejarah')],
        ['label' => 'Visi & Misi', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- VISI (Typography Besar & Elegan) --}}
        <div class="mb-5 p-5 rounded-4 bg-subtle border">
            <span class="badge-ppak badge-ppak-blue mb-3">Visi Program Studi</span>
            <div class="display-6 fw-bold text-navy mb-3" style="letter-spacing: -0.025em; line-height: 1.25;">
                "Menjadi pusat pendidikan profesi akuntansi terkemuka di tingkat nasional dan berdaya saing global yang menghasilkan akuntan profesional berintegritas tinggi, adaptif terhadap teknologi informasi, serta berwawasan etika luhur pada tahun 2030."
            </div>
            <p class="text-secondary mb-0 small">
                Diselaraskan dengan Rencana Strategis FEB dan Visi Universitas Negeri Surabaya sebagai universitas kependidikan dan sains berstandar internasional.
            </p>
        </div>

        {{-- MISI --}}
        <div class="mb-5">
            <div class="text-center max-w-700 mx-auto mb-4">
                <span class="badge-ppak badge-ppak-navy mb-2">Misi Utama</span>
                <h2>Misi Penyelenggaraan Pendidikan</h2>
                <p class="text-secondary">Empat pilar pelaksanaan mandat tridharma perguruan tinggi pada jenjang profesi akuntansi.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card-ppak-flat h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="feature-icon-wrapper">
                                <span class="fw-bold fs-6">01</span>
                            </div>
                            <h3 class="fs-6 fw-bold text-navy mb-0">Pendidikan Profesi Berstandar Internasional</h3>
                        </div>
                        <p class="small text-secondary mb-0">
                            Menyelenggarakan proses pembelajaran profesi akuntansi berkualitas tinggi berbasis luaran (Outcome-Based Education) yang selaras dengan International Education Standards (IES) dan silabus Chartered Accountant (CA) Indonesia.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-ppak-flat h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="feature-icon-wrapper">
                                <span class="fw-bold fs-6">02</span>
                            </div>
                            <h3 class="fs-6 fw-bold text-navy mb-0">Riset Terapan & Kajian Praktik Akuntansi</h3>
                        </div>
                        <p class="small text-secondary mb-0">
                            Mengembangkan penelitian terapan dan studi kasus riil dalam bidang auditing, tata kelola korporasi (GCG), analitika data keuangan, dan kepatuhan perpajakan guna memberikan sumbangsih pemikiran bagi profesi.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-ppak-flat h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="feature-icon-wrapper">
                                <span class="fw-bold fs-6">03</span>
                            </div>
                            <h3 class="fs-6 fw-bold text-navy mb-0">Pengabdian & Literasi Akuntabilitas Publik</h3>
                        </div>
                        <p class="small text-secondary mb-0">
                            Melaksanakan pengabdian kepada masyarakat melalui pendampingan akuntansi UMKM, tata kelola keuangan badan usaha milik desa (BUMDes), serta asistensi kepatuhan perpajakan masyarakat luas.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-ppak-flat h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="feature-icon-wrapper">
                                <span class="fw-bold fs-6">04</span>
                            </div>
                            <h3 class="fs-6 fw-bold text-navy mb-0">Jejaring Kemitraan Sektor Publik & Industri</h3>
                        </div>
                        <p class="small text-secondary mb-0">
                            Membangun kerja sama strategis yang berkelanjutan dengan Kantor Akuntan Publik, organisasi profesi (IAI, IAPI), regulator (OJK, BPK, DJP), serta dunia usaha untuk mempercepat keterserapan lulusan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TUJUAN PROGRAM --}}
        <div class="p-5 rounded-4 border bg-subtle">
            <div class="row align-items-center g-4">
                <div class="col-lg-4">
                    <span class="badge-ppak badge-ppak-gold mb-2">Tujuan Program</span>
                    <h3 class="text-navy">Profil Capaian Lulusan PPAk</h3>
                    <p class="text-secondary small mb-0">
                        Lulusan dirancang memiliki kesiapan prima dalam mengambil peran strategis kepemimpinan keuangan korporasi dan jasa asurans publik.
                    </p>
                </div>
                <div class="col-lg-8">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 bg-white rounded-3 border h-100">
                                <div class="fw-bold text-navy small mb-1"><i class="fa-solid fa-circle-check text-primary me-2"></i>Kompetensi Teknis Unggul</div>
                                <div class="text-muted" style="font-size: 0.8rem;">Mampu menyusun, menganalisis, dan mengaudit laporan keuangan berbasis standar internasional (IFRS & ISA).</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-white rounded-3 border h-100">
                                <div class="fw-bold text-navy small mb-1"><i class="fa-solid fa-circle-check text-primary me-2"></i>Integritas & Skeptisisme</div>
                                <div class="text-muted" style="font-size: 0.8rem;">Menjunjung tinggi kode etik profesi akuntan dan bersikap independen dalam menghadapi dilema etika bisnis.</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-white rounded-3 border h-100">
                                <div class="fw-bold text-navy small mb-1"><i class="fa-solid fa-circle-check text-primary me-2"></i>Kecakapan Analitika Data</div>
                                <div class="text-muted" style="font-size: 0.8rem;">Mampu mengoperasikan audit assist software dan memanfaatkan data analytics dalam evaluasi risiko.</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-white rounded-3 border h-100">
                                <div class="fw-bold text-navy small mb-1"><i class="fa-solid fa-circle-check text-primary me-2"></i>Kesiapan Sertifikasi CA/CPA</div>
                                <div class="text-muted" style="font-size: 0.8rem;">Lulusan memenuhi syarat portofolio pembebasan ujian serta siap menempuh ujian tingkat lanjutan profesi.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
