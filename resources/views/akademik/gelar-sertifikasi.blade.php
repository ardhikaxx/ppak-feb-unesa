@extends('layouts.app')

@section('title', 'Gelar Profesi & Sertifikasi Akuntan | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Informasi hubungan Pendidikan Profesi Akuntan dengan sertifikasi Chartered Accountant (CA) dari IAI dan Certified Public Accountant (CPA) dari IAPI.')

@section('content')

@include('partials.page-header', [
    'title' => 'Gelar Profesi & Sertifikasi Akuntan',
    'badge' => 'Informasi Keprofesian & Sertifikasi',
    'lead' => 'Memahami hubungan program Pendidikan Profesi Akuntan dengan sebutan profesi, sertifikasi Chartered Accountant (CA) IAI, dan CPA of Indonesia IAPI.',
    'breadcrumbs' => [
        ['label' => 'Akademik', 'url' => route('akademik.kurikulum')],
        ['label' => 'Gelar & Sertifikasi', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Hubungan PPAk dengan Profesi Akuntan --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle mb-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge-ppak badge-ppak-gold mb-2">Kerangka Pendidikan Profesi</span>
                    <h2 class="h3 text-navy mb-3">{{ $pg['hero_heading']['heading'] ?? 'Pendidikan Profesi & Hubungannya dengan Sertifikasi' }}</h2>
                    {!! $pg['hero_lead']['body'] ?? '<p class="lead text-dark mb-3">Program Studi Pendidikan Profesi Akuntan (PPAk) FEB UNESA menyelenggarakan pendidikan profesi untuk membentuk lulusan yang menguasai kompetensi teoritis dan aplikatif di bidang akuntansi profesional.</p>' !!}
                    {!! $pg['hero_sub']['body'] ?? '<p class="text-secondary small mb-0">Pendidikan profesi merupakan tahapan akademik pascasarjana, sedangkan sebutan profesi dan sertifikasi keprofesian diselenggarakan oleh organisasi profesi resmi (IAI dan IAPI) yang memiliki regulasi, kurikulum ujian, dan persyaratan tersendiri.</p>' !!}
                </div>
                <div class="col-lg-4 text-center">
                    <div class="p-4 rounded-3 bg-white border shadow-sm">
                        <i class="fa-solid fa-graduation-cap text-navy display-4 mb-2"></i>
                        <div class="fw-bold text-navy fs-5">Jenjang Profesi</div>
                        <div class="small text-muted mb-2">KKNI Jenjang 7</div>
                        <span class="badge-ppak badge-ppak-navy" style="font-size: 0.725rem;">Kode Prodi: {{ $info['program_code'] ?? '62902' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- VISUAL ALUR: PPAk -> Kelulusan -> Jalur Sertifikasi Sesuai Persyaratan --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-white shadow-sm mb-5">
            <div class="text-center max-w-700 mx-auto mb-4">
                <span class="badge-ppak badge-ppak-navy mb-2">ALUR KUALIFIKASI</span>
                <h3 class="h4 text-navy fw-bold mb-1">{{ $pg['alur_heading']['heading'] ?? 'Alur Pendidikan Menuju Sertifikasi & Registrasi Profesi' }}</h3>
                <div class="golden-line center"></div>
                {!! $pg['alur_body']['body'] ?? '<p class="small text-secondary mb-0">Proses terstruktur dari penuntasan beban studi pendidikan profesi hingga keikutsertaan dalam ujian sertifikasi profesi masing-masing lembaga.</p>' !!}
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="p-4 rounded-3 border bg-subtle h-100 text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            <i class="fa-solid fa-book-open-reader text-navy"></i>
                        </div>
                        <span class="badge-ppak badge-ppak-navy mb-2">Tahap 1</span>
                        <h4 class="fs-6 fw-bold text-navy mb-2">{{ $pg['tahap_1_heading']['heading'] ?? 'Pendidikan PPAk UNESA' }}</h4>
                        {!! $pg['tahap_1_body']['body'] ?? '<p class="small text-secondary mb-0">Menempuh pembelajaran komprehensif 11 mata kuliah terpadu dan paket magang industri sesuai kurikulum SINDIG UNESA.</p>' !!}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="p-4 rounded-3 border bg-subtle h-100 text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            <i class="fa-solid fa-certificate text-navy"></i>
                        </div>
                        <span class="badge-ppak badge-ppak-blue mb-2">Tahap 2</span>
                        <h4 class="fs-6 fw-bold text-navy mb-2">{{ $pg['tahap_2_heading']['heading'] ?? 'Kelulusan Pendidikan Profesi' }}</h4>
                        {!! $pg['tahap_2_body']['body'] ?? '<p class="small text-secondary mb-0">Lulus dari program studi, memperoleh ijazah profesi, serta menyelesaikan seluruh persyaratan akademik dan praktika.</p>' !!}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="p-4 rounded-3 border bg-subtle h-100 text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            <i class="fa-solid fa-award text-navy"></i>
                        </div>
                        <span class="badge-ppak badge-ppak-gold mb-2">Tahap 3</span>
                        <h4 class="fs-6 fw-bold text-navy mb-2">{{ $pg['tahap_3_heading']['heading'] ?? 'Jalur Sertifikasi / Registrasi' }}</h4>
                        {!! $pg['tahap_3_body']['body'] ?? '<p class="small text-secondary mb-0">Mengikuti ujian sertifikasi profesi (CA oleh IAI atau CPA of Indonesia oleh IAPI) serta registrasi sesuai persyaratan masing-masing lembaga.</p>' !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- 2 SECTIONS: CHARTERED ACCOUNTANT (IAI) & CPA OF INDONESIA (IAPI) --}}
        <div class="row g-5">
            {{-- Bagian CA Indonesia (IAI) --}}
            <div class="col-lg-6">
                <div class="p-4 p-lg-5 rounded-4 border bg-white h-100 shadow-sm d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="badge-ppak badge-ppak-navy">Ikatan Akuntan Indonesia (IAI)</span>
                        <i class="fa-solid fa-stamp text-primary fs-4"></i>
                    </div>
                    <h3 class="h4 text-navy fw-bold mb-3">{{ $pg['ca_heading']['heading'] ?? 'Chartered Accountant (CA) Indonesia' }}</h3>
                    {!! $pg['ca_body']['body'] ?? '<p class="small text-secondary mb-3" style="line-height: 1.65;">Chartered Accountant (CA) Indonesia merupakan sebutan profesi akuntan yang ditetapkan oleh <strong>Ikatan Akuntan Indonesia (IAI)</strong> untuk akuntan profesional yang memenuhi standar kompetensi internasional.</p>' !!}
                    <div class="p-3 bg-subtle rounded-3 border mb-3">
                        <h4 class="fs-6 fw-bold text-navy mb-2">Ketentuan Ujian & Sertifikasi:</h4>
                        {!! $pg['ca_ketentuan']['body'] ?? '<ul class="list-unstyled small text-secondary mb-0"><li class="d-flex align-items-start gap-2 mb-2"><i class="fa-solid fa-circle-check text-primary mt-1" style="font-size: 0.5rem;"></i><span>Mahasiswa PPAk mengikuti Ujian Sertifikasi Akuntan Profesional yang diselenggarakan oleh IAI.</span></li><li class="d-flex align-items-start gap-2 mb-2"><i class="fa-solid fa-circle-check text-primary mt-1" style="font-size: 0.5rem;"></i><span>Pemberian sebutan CA memiliki persyaratan ujian, pengalaman kerja di bidang akuntansi, dan keanggotaan IAI tersendiri.</span></li><li class="d-flex align-items-start gap-2"><i class="fa-solid fa-circle-check text-primary mt-1" style="font-size: 0.5rem;"></i><span>Kelulusan PPAk menjadi fondasi akademik yang relevan untuk menempuh tahapan sertifikasi CA.</span></li></ul>' !!}
                    </div>
                    <div class="mt-auto pt-3 border-top">
                        <a href="{{ $pg['ca_link']['link_url'] ?? 'https://iaiglobal.or.id' }}" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary w-100 text-center btn-ppak-sm">
                            <span>Informasi Resmi Ujian CA (IAI)</span>
                            <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Bagian CPA of Indonesia (IAPI) --}}
            <div class="col-lg-6">
                <div class="p-4 p-lg-5 rounded-4 border bg-white h-100 shadow-sm d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="badge-ppak badge-ppak-gold">Institut Akuntan Publik Indonesia (IAPI)</span>
                        <i class="fa-solid fa-file-signature text-navy fs-4"></i>
                    </div>
                    <h3 class="h4 text-navy fw-bold mb-3">{{ $pg['cpa_heading']['heading'] ?? 'Certified Public Accountant (CPA) of Indonesia' }}</h3>
                    {!! $pg['cpa_body']['body'] ?? '<p class="small text-secondary mb-3" style="line-height: 1.65;">Certified Public Accountant (CPA) of Indonesia merupakan sertifikasi kompetensi yang diselenggarakan oleh <strong>Institut Akuntan Publik Indonesia (IAPI)</strong> melalui CPA of Indonesia Exam.</p>' !!}
                    <div class="p-3 bg-subtle rounded-3 border mb-3">
                        <h4 class="fs-6 fw-bold text-navy mb-2">Ketentuan Ujian & Sertifikasi:</h4>
                        {!! $pg['cpa_ketentuan']['body'] ?? '<ul class="list-unstyled small text-secondary mb-0"><li class="d-flex align-items-start gap-2 mb-2"><i class="fa-solid fa-circle-check text-warning mt-1" style="font-size: 0.5rem;"></i><span>Sertifikasi CPA ditempuh melalui CPA of Indonesia Exam dengan tahapan ujian tingkat dasar, profesional, dan lanjutan.</span></li><li class="d-flex align-items-start gap-2 mb-2"><i class="fa-solid fa-circle-check text-warning mt-1" style="font-size: 0.5rem;"></i><span>Izin praktik sebagai Akuntan Publik (AP) memiliki persyaratan tambahan berupa pengalaman praktik audit dan izin dari Kementerian Keuangan RI.</span></li><li class="d-flex align-items-start gap-2"><i class="fa-solid fa-circle-check text-warning mt-1" style="font-size: 0.5rem;"></i><span>Lulusan PPAk menempuh tahapan sertifikasi sesuai regulasi yang berlaku pada IAPI.</span></li></ul>' !!}
                    </div>
                    <div class="mt-auto pt-3 border-top">
                        <a href="{{ $pg['cpa_link']['link_url'] ?? 'https://iapi.or.id' }}" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary w-100 text-center btn-ppak-sm">
                            <span>Informasi Sertifikasi CPA (IAPI)</span>
                            <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
