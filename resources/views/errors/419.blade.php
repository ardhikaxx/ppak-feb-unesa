@extends('layouts.app')
@section('title', '419 - Sesi Kadaluwarsa | PPAk FEB UNESA')
@section('hide_cta', true)
@section('content')
<div class="container">
    <div class="error-404-container">
        <div class="error-404-num">419</div>
        <x-badge variant="gold" class="mb-3">Sesi Kadaluwarsa</x-badge>
        <h1 class="h2 text-navy mb-2" style="font-weight:700;">Sesi Telah Berakhir</h1>
        <p class="text-secondary small max-w-700 mb-4" style="max-width:540px;">Halaman ini kadaluwarsa karena proteksi CSRF. Silakan muat ulang halaman dan coba lagi.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ url()->current() }}" class="btn-ppak-primary"><i class="fa-solid fa-rotate me-1"></i> Muat Ulang</a>
            <a href="{{ route('home') }}" class="btn-ppak-secondary"><i class="fa-solid fa-house me-1"></i> Beranda</a>
        </div>
    </div>
</div>
@endsection
