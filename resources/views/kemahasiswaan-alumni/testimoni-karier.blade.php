@extends('layouts.app')

@section('title', 'Testimoni & Informasi Karier Alumni | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Informasi prospek bidang profesi akuntan dan portal direktori testimoni lulusan Program Studi Pendidikan Profesi Akuntan FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Testimoni & Jejaring Karier Alumni',
    'badge' => 'Prospek Profesi & Alumni',
    'lead' => 'Informasi bidang profesi akuntan dan direktori testimoni pengalaman studi Program Studi Pendidikan Profesi Akuntan FEB UNESA.',
    'breadcrumbs' => [
        ['label' => 'Kemahasiswaan & Alumni', 'url' => route('kemahasiswaan-alumni.alumni')],
        ['label' => 'Testimoni & Karier', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Status Notification: CMS-Ready Placeholder for Testimonials --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle mb-5">
            <div class="d-flex align-items-start gap-4">
                <div class="feature-icon-wrapper flex-shrink-0" style="width: 52px; height: 52px; font-size: 1.4rem;">
                    <i class="fa-solid fa-quote-left text-navy"></i>
                </div>
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-2">STATUS DIREKTORI TESTIMONI</span>
                    <h2 class="h4 text-navy fw-bold mb-2">Testimoni Pengalaman Studi Mahasiswa & Alumni</h2>
                    <p class="text-secondary small mb-3" style="line-height: 1.7;">
                        Program Studi Pendidikan Profesi Akuntan FEB UNESA tercatat resmi berdiri pada <strong>23 Mei 2025</strong>. Direktori penuturan pengalaman studi dan testimoni lulusan dipersiapkan untuk dipublikasikan secara terstruktur bersama kelulusan mahasiswa program profesi.
                    </p>
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i> Data testimoni pada website ini hanya akan menampilkan testimoni yang secara resmi diverifikasi dan disetujui oleh alumni bersangkutan melalui modul CMS.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Direktori Testimoni Terverifikasi (dari CMS; kosong = hanya status di atas yang tampil) --}}
        @if(!empty($testimoni['items']))
            <div class="row g-4 mb-5">
                @foreach($testimoni['items'] as $t)
                    <div class="col-lg-6">
                        <div class="card-ppak-flat h-100 bg-subtle p-4 rounded-3 border">
                            <div class="d-flex align-items-start gap-3">
                                @if(!empty($t['avatar']))
                                    <img src="{{ $t['avatar'] }}" alt="{{ $t['name'] }}" class="rounded-circle flex-shrink-0" loading="lazy" width="52" height="52" style="width:52px;height:52px;object-fit:cover;">
                                @else
                                    <div class="feature-icon-wrapper flex-shrink-0" style="width: 52px; height: 52px; font-size: 1.3rem;">
                                        <i class="fa-solid fa-quote-left"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="small text-secondary mb-2" style="line-height: 1.65;">"{{ $t['quote'] }}"</p>
                                    <div class="fw-bold text-navy small">{{ $t['name'] }}</div>
                                    @php($tMeta = array_filter([$t['role'] ?? null, $t['company'] ?? null, $t['year'] ?? null]))
                                    <div class="small text-muted">{{ implode(' • ', $tMeta) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- PROSPEK DAN BIDANG KARIER PROFESIONAL AKUNTANSI (Faktual Umum) --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-white shadow-sm">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="badge-ppak badge-ppak-navy mb-2">PROSPEK PROFESI</span>
                <h3 class="h3 text-navy fw-bold mb-2">Bidang Profesi Akuntansi</h3>
                <div class="golden-line center"></div>
                <p class="small text-secondary mb-0">
                    Informasi bidang profesi yang relevan bagi lulusan sarjana akuntansi yang menempuh pendidikan profesi akuntan:
                </p>
            </div>

            <div class="row g-4">
                @foreach($karierSectors as $sector)
                    <div class="col-lg-6">
                        <div class="card-ppak-flat h-100 bg-subtle p-4 rounded-3 border">
                            <div class="d-flex align-items-start gap-3">
                                <div class="feature-icon-wrapper flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.15rem;">
                                    <i class="fa-solid {{ $sector['icon'] }}"></i>
                                </div>
                                <div>
                                    <h4 class="fs-6 fw-bold text-navy mb-2">{{ $sector['title'] }}</h4>
                                    <p class="small text-secondary mb-0" style="line-height: 1.6;">
                                        {{ $sector['desc'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 pt-3 border-top text-center">
                <small class="text-muted">
                    <i class="fa-solid fa-circle-info text-primary me-1"></i> Data karier di atas merupakan deskripsi umum prospek bidang keprofesian akuntan berdasarkan standar kualifikasi profesi akuntansi Indonesia.
                </small>
            </div>
        </div>
    </div>
</section>

@endsection

