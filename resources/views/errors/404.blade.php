@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan | PPAk FEB UNESA')
@section('hide_cta', true)

@section('content')
<div class="container">
    <div class="error-404-container">
        <div class="error-404-num">404</div>
        <span class="badge-ppak badge-ppak-navy mb-3">Halaman Tidak Ditemukan</span>
        <h1 class="h2 text-navy mb-2" style="font-weight: 700;">Halaman yang Anda Cari Tidak Tersedia</h1>
        <p class="text-secondary small max-w-700 mb-4" style="max-width: 540px;">
            Mohon maaf, tautan yang Anda tuju mungkin telah dipindahkan, berganti nama, atau sudah tidak aktif lagi. Silakan kembali ke beranda atau periksa navigasi menu di atas.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn-ppak-primary">
                <i class="fa-solid fa-house me-1"></i>
                <span>Kembali ke Beranda</span>
            </a>
            <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-secondary">
                <i class="fa-solid fa-headset me-1"></i>
                <span>Hubungi Bantuan Helpdesk</span>
            </a>
        </div>
    </div>
</div>
@endsection
