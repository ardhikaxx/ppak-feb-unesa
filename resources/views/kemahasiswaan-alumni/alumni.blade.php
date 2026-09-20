@extends('layouts.app')

@section('title', 'Jejaring Alumni | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Informasi pengembangan jejaring alumni Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => $pg['header_title']['heading'] ?? 'Jejaring Alumni (PPAk FEB UNESA)',
    'badge' => $pg['header_badge']['heading'] ?? 'Pengembangan Jejaring & Silaturahmi',
    'lead' => $pg['header_lead']['body'] ?? 'Wadah sinergi dan jejaring komunikasi profesional bagi lulusan Program Studi Pendidikan Profesi Akuntan FEB UNESA.',
    'breadcrumbs' => [
        ['label' => 'Kemahasiswaan & Alumni', 'url' => route('kemahasiswaan-alumni.alumni')],
        ['label' => 'Jejaring Alumni', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Status Notification Card --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle mb-5">
            <div class="d-flex align-items-start gap-4">
                <div class="feature-icon-wrapper flex-shrink-0" style="width: 52px; height: 52px; font-size: 1.4rem;">
                    <i class="fa-solid fa-user-group text-navy"></i>
                </div>
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-2">PENGEMBANGAN JEJARING PROFESI</span>
                    <h2 class="h4 text-navy fw-bold mb-2">Jejaring Alumni Pendidikan Profesi Akuntan</h2>
                    <p class="text-secondary small mb-3" style="line-height: 1.7;">
                        Program Studi Pendidikan Profesi Akuntan FEB UNESA tercatat resmi berdiri pada <strong>23 Mei 2025</strong>. Pembentukan struktur ikatan alumni resmi dan pendataan direktori lulusan disiapkan secara terpadu bersama kelulusan kohor mahasiswa program profesi.
                    </p>
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i> Seluruh data lulusan terintegrasi dengan Pangkalan Data Alumni Universitas Negeri Surabaya melalui portal resmi <strong>alumni.unesa.ac.id</strong>.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Direktori Alumni Terverifikasi (dari CMS; kosong = tidak tampil) --}}
        @if($alumniList->isNotEmpty())
            <div class="p-4 p-lg-5 rounded-4 border bg-white shadow-sm mb-5">
                <span class="badge-ppak badge-ppak-navy mb-2">DIREKTORI LULUSAN</span>
                <h3 class="h5 text-navy fw-bold mb-4">Alumni Terverifikasi</h3>
                <div class="row g-4">
                    @foreach($alumniList as $al)
                        <div class="col-md-6">
                            <div class="card-ppak-flat h-100 bg-subtle p-4 rounded-3 border">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="feature-icon-wrapper flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.1rem;">
                                        <i class="fa-solid fa-user-graduate"></i>
                                    </div>
                                    <div>
                                        <h4 class="fs-6 fw-bold text-navy mb-1">{{ $al->full_name }}</h4>
                                        <div class="small text-muted mb-1">Lulusan {{ $al->graduation_year ?? '-' }}</div>
                                        @php($alMeta = array_filter([$al->current_position ?? null, $al->current_company ?? null]))
                                        <div class="small text-secondary">{{ implode(' • ', $alMeta) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Pilar Pengembangan Sinergi Alumni --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                    <div class="feature-icon-wrapper mx-auto mb-3">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">{{ $pg['pilar_1_heading']['heading'] ?? 'Forum Silaturahmi & Diskusi' }}</h3>
                    {!! $pg['pilar_1_body']['body'] ?? '<p class="small text-secondary mb-0">Menjaga komunikasi antarangkatan dan pertukaran wawasan dinamika keprofesian akuntan.</p>' !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                    <div class="feature-icon-wrapper mx-auto mb-3">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">{{ $pg['pilar_2_heading']['heading'] ?? 'Peluang Karier & Referral' }}</h3>
                    {!! $pg['pilar_2_body']['body'] ?? '<p class="small text-secondary mb-0">Berbagi informasi rekrutmen profesional di Kantor Akuntan Publik, korporasi, dan lembaga pemerintah.</p>' !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                    <div class="feature-icon-wrapper mx-auto mb-3">
                        <i class="fa-solid fa-handshake-angle"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-2">{{ $pg['pilar_3_heading']['heading'] ?? 'Mentoring & Kontribusi Almamater' }}</h3>
                    {!! $pg['pilar_3_body']['body'] ?? '<p class="small text-secondary mb-0">Dukungan pembekalan studi kasus dan masukan praktis bagi pengembangan mutu pembelajaran.</p>' !!}
                </div>
            </div>
        </div>

        {{-- Portal Database Alumni UNESA --}}
        <div class="p-4 p-md-5 rounded-4 border bg-subtle text-center">
            <h3 class="fs-6 fw-bold text-navy mb-2">Pangkalan Data Alumni Universitas Negeri Surabaya</h3>
            <p class="small text-secondary mb-4 max-w-700 mx-auto">
                Lulusan UNESA dapat melakukan pembaruan biodata karier dan penelusuran tracer study resmi melalui portal IKA UNESA pusat.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="https://alumni.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary btn-ppak-sm">
                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
                    <span>Akses Portal Alumni UNESA</span>
                </a>
                <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-secondary btn-ppak-sm">
                    <i class="fa-solid fa-envelope me-1"></i>
                    <span>Hubungi Sekretariat Program</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

