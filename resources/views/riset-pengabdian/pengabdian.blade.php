@extends('layouts.app')

@section('title', 'Pengabdian Kepada Masyarakat (PKM) | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Informasi kegiatan pengabdian kepada masyarakat dosen Program Studi Pendidikan Profesi Akuntan Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')

@section('content')

@include('partials.page-header', [
    'title' => 'Pengabdian Kepada Masyarakat (PKM)',
    'badge' => 'Tridharma Perguruan Tinggi',
    'lead' => 'Penyelenggaraan kegiatan pengabdian kepada masyarakat dan literasi akuntansi oleh sivitas akademika FEB UNESA.',
    'breadcrumbs' => [
        ['label' => 'Riset & Pengabdian', 'url' => route('riset-pengabdian.riset-publikasi')],
        ['label' => 'Pengabdian Masyarakat', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Status Notification Card --}}
        <div class="p-4 p-lg-5 rounded-4 border bg-subtle mb-5">
            <div class="d-flex align-items-start gap-4">
                <div class="feature-icon-wrapper flex-shrink-0" style="width: 52px; height: 52px; font-size: 1.4rem;">
                    <i class="fa-solid fa-hand-holding-heart text-navy"></i>
                </div>
                <div>
                    <span class="badge-ppak badge-ppak-gold mb-2">Status Publikasi Kegiatan</span>
                    <h2 class="h4 text-navy fw-bold mb-2">Publikasi Kegiatan Pengabdian Masyarakat Program Studi</h2>
                    <p class="text-secondary small mb-3" style="line-height: 1.7;">
                        Program Studi Pendidikan Profesi Akuntan FEB UNESA (tercatat berdiri 23 Mei 2025) sedang mengompilasi laporan dan dokumentasi kegiatan pengabdian kepada masyarakat (PKM) yang dilaksanakan oleh tim dosen pengampu untuk periode tahun akademik berjalan.
                    </p>
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="small text-muted">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i> Data kegiatan PKM resmi yang telah diverifikasi oleh Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) UNESA akan dipublikasikan secara berkala melalui sistem manajemen konten (CMS) website ini.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CMS-Ready Empty / Prepared State Grid --}}
        @if(!empty($pengabdian['items']))
            <div class="row g-4">
                @foreach($pengabdian['items'] as $pkm)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-ppak-flat h-100">
                            <div class="badge-ppak badge-ppak-navy mb-2">{{ $pkm['tahun'] }}</div>
                            <h3 class="fs-6 fw-bold text-navy mb-2">{{ $pkm['title'] }}</h3>
                            <p class="small text-secondary mb-0">{{ $pkm['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-2">Pendampingan UMKM</h3>
                        <p class="small text-secondary mb-0">Edukasi pembukuan sederhana dan penyusunan laporan keuangan bagi pelaku usaha mikro berbasis SAK EMKM.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-2">Literasi Perpajakan</h3>
                        <p class="small text-secondary mb-0">Asistensi kepatuhan perpajakan dan pemahaman pelaporan SPT tahunan bagi wajib pajak orang pribadi dan UMKM.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-ppak-flat h-100 bg-white shadow-sm text-center">
                        <div class="feature-icon-wrapper mx-auto mb-3">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <h3 class="fs-6 fw-bold text-navy mb-2">Tata Kelola BUMDes & Koperasi</h3>
                        <p class="small text-secondary mb-0">Pelatihan akuntabilitas tata kelola dan sistem pengendalian internal keuangan entitas usaha desa.</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Kontak Pengajuan Kemitraan PKM --}}
        <div class="p-4 p-md-5 rounded-4 border bg-subtle text-center">
            <h3 class="fs-6 fw-bold text-navy mb-2">Pengajuan Kerja Sama Pengabdian Masyarakat</h3>
            <p class="small text-secondary mb-3 max-w-700 mx-auto">
                Komunitas, dinas, koperasi, atau pelaku usaha yang bermaksud mengajukan kerja sama pendampingan akuntansi dan tata kelola dapat menghubungi sekretariat program studi.
            </p>
            <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-primary btn-ppak-sm">
                <i class="fa-solid fa-envelope me-1"></i>
                <span>Hubungi Sekretariat PPAk</span>
            </a>
        </div>
    </div>
</section>

@endsection
