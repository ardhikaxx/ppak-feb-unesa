@extends('layouts.app')

@section('title', 'Riset & Publikasi Ilmiah | PPAk FEB UNESA')
@section('meta_description', 'Publikasi karya ilmiah, riset terapan auditing, akuntansi keuangan, dan perpajakan oleh dosen dan mahasiswa PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Riset & Publikasi Ilmiah',
    'badge' => 'Tridharma & Pengembangan Keilmuan',
    'lead' => 'Karya penelitian terapan dan telaah empiris mutakhir yang dihasilkan sivitas akademika PPAk FEB UNESA pada jurnal nasional bereputasi dan internasional.',
    'breadcrumbs' => [
        ['label' => 'Riset & Pengabdian', 'url' => route('riset-pengabdian.riset-publikasi')],
        ['label' => 'Riset & Publikasi', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Research Clusters --}}
        <div class="row g-4 mb-5">
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3 border bg-subtle text-center h-100">
                    <i class="fa-solid fa-microchip text-primary fs-3 mb-2"></i>
                    <h3 class="fs-6 fw-bold text-navy mb-1">Audit & AI Analytics</h3>
                    <div class="text-muted" style="font-size: 0.75rem;">Continuous audit & deteksi anomali digital</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3 border bg-subtle text-center h-100">
                    <i class="fa-solid fa-leaf text-success fs-3 mb-2"></i>
                    <h3 class="fs-6 fw-bold text-navy mb-1">ESG & Sustainability</h3>
                    <div class="text-muted" style="font-size: 0.75rem;">Pelaporan keberlanjutan & tata kelola</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3 border bg-subtle text-center h-100">
                    <i class="fa-solid fa-receipt text-warning fs-3 mb-2"></i>
                    <h3 class="fs-6 fw-bold text-navy mb-1">Perpajakan Digital</h3>
                    <div class="text-muted" style="font-size: 0.75rem;">Kepatuhan CTAS & transfer pricing</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded-3 border bg-subtle text-center h-100">
                    <i class="fa-solid fa-landmark text-primary fs-3 mb-2"></i>
                    <h3 class="fs-6 fw-bold text-navy mb-1">Akuntabilitas Publik</h3>
                    <div class="text-muted" style="font-size: 0.75rem;">Audit SPKN, BPK & mitigasi fraud</div>
                </div>
            </div>
        </div>

        {{-- DAFTAR PUBLIKASI RISET --}}
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <span class="badge-ppak badge-ppak-blue mb-1">Arsip Penelitian</span>
                    <h2 class="h4 text-navy mb-0">Publikasi Karya Ilmiah Terpilih</h2>
                </div>
                <span class="small text-muted">{{ count($riset) }} Dokumen Terindeks</span>
            </div>

            <div class="row g-4">
                @foreach($riset as $item)
                    <div class="col-lg-6">
                        <div class="card-ppak-flat h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge-ppak badge-ppak-navy" style="font-size: 0.675rem;">{{ $item['bidang'] }}</span>
                                    <span class="badge-ppak badge-ppak-gold" style="font-size: 0.675rem;">Tahun {{ $item['tahun'] }}</span>
                                </div>
                                <h3 class="fs-6 fw-bold text-navy mb-2" style="line-height: 1.4;">{{ $item['title'] }}</h3>
                                <div class="small text-primary fw-semibold mb-2">
                                    <i class="fa-solid fa-user-pen me-1"></i> {{ $item['peneliti'] }}
                                </div>
                                <div class="small text-muted mb-3">
                                    <i class="fa-solid fa-book-bookmark me-1"></i> {{ $item['jurnal'] }}
                                </div>
                                <p class="small text-secondary mb-3" style="line-height: 1.6;">
                                    {{ $item['abstrak'] }}
                                </p>
                            </div>
                            <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                                <span class="small text-muted" style="font-size: 0.75rem;">DOI: 10.1234/ppak-feb.{{ $item['tahun'] }}.{{ $item['id'] }}</span>
                                <a href="https://ejournal.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="small text-primary fw-bold text-decoration-none">
                                    Baca Jurnal <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
