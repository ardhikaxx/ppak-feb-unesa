@extends('layouts.app')

@section('title', 'Ikatan Alumni PPAk (IKA PPAk) | PPAk FEB UNESA')
@section('meta_description', 'Jejaring Ikatan Alumni Pendidikan Profesi Akuntansi Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => 'Ikatan Alumni PPAk (IKA PPAk FEB UNESA)',
    'badge' => 'Jejaring Profesional & Silaturahmi',
    'lead' => 'Wadah sinergi dan kolaborasi bagi lebih dari seribu alumni yang telah berkarier di sektor Kantor Akuntan Publik, korporasi, perbankan, dan pengawasan keuangan negara.',
    'breadcrumbs' => [
        ['label' => 'Kemahasiswaan & Alumni', 'url' => route('kemahasiswaan-alumni.alumni')],
        ['label' => 'Ikatan Alumni', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Tracer Study Statistics --}}
        <div class="row g-4 mb-5">
            <div class="col-md-3 col-6">
                <div class="stat-card-apple text-center">
                    <div class="stat-number text-primary">1.200+</div>
                    <div class="stat-label">Total Alumni</div>
                    <p class="stat-desc">Tersebar di seluruh Indonesia</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card-apple text-center">
                    <div class="stat-number text-navy">&lt; 3 Bln</div>
                    <div class="stat-label">Waktu Tunggu Kerja</div>
                    <p class="stat-desc">Keterserapan magang & profesi cepat</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card-apple text-center">
                    <div class="stat-number text-warning">85%</div>
                    <div class="stat-label">Karier Linear</div>
                    <p class="stat-desc">Bekerja di bidang asurans & keuangan</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card-apple text-center">
                    <div class="stat-number text-success">100%</div>
                    <div class="stat-label">Terdaftar RNA</div>
                    <p class="stat-desc">Memiliki register negara akuntan</p>
                </div>
            </div>
        </div>

        {{-- Profil & Program IKA PPAk --}}
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <span class="badge-ppak badge-ppak-blue mb-2">Organisasi Alumni</span>
                <h2 class="h3 text-navy mb-3">Mempererat Hubungan & Berbagi Pengalaman</h2>
                <p class="lead mb-3">
                    Ikatan Alumni PPAk FEB UNESA didirikan untuk mempererat tali silaturahmi antarangkatan serta menjembatani almamater dengan dinamika praktik keprofesian di lapangan.
                </p>
                <p class="text-secondary small mb-4">
                    Alumni secara berkala menyelenggarakan sesi mentoring karier, pembekalan ujian sertifikasi CA bagi mahasiswa aktif, serta berpartisipasi aktif dalam evaluasi kurikulum berkala bersama Gugus Penjaminan Mutu prodi.
                </p>

                <div class="d-flex flex-wrap gap-2">
                    <a href="https://alumni.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary btn-ppak-sm">
                        <i class="fa-solid fa-user-plus me-1"></i>
                        <span>Registrasi Database Alumni UNESA</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="p-4 p-md-5 rounded-4 border bg-subtle">
                    <h3 class="fs-6 fw-bold text-navy mb-4"><i class="fa-solid fa-list-check text-primary me-2"></i>Inisiatif Utama IKA PPAk</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <div class="feature-icon-wrapper" style="width: 32px; height: 32px; font-size: 0.85rem;">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-navy small">Alumni Mentoring Program</div>
                                <div class="small text-muted">Bimbingan intensif dari alumni senior mengenai persiapan wawancara rekrutmen KAP Big Four dan tes BPK.</div>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <div class="feature-icon-wrapper" style="width: 32px; height: 32px; font-size: 0.85rem;">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-navy small">KAP & Corporate Job Referral</div>
                                <div class="small text-muted">Akses informasi lowongan auditor junior dan staf akuntansi langsung dari jaringan alumni internal.</div>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3">
                            <div class="feature-icon-wrapper" style="width: 32px; height: 32px; font-size: 0.85rem;">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-navy small">Forum Diskusi Regulasi Akuntansi (FDRA)</div>
                                <div class="small text-muted">Diskusi bulanan mengkaji draft eksposur PSAK baru, regulasi CTAS DJP, dan studi kasus penugasan audit.</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
