@extends('layouts.app')
@section('title', '500 - Kesalahan Server | PPAk FEB UNESA')
@section('hide_cta', true)
@section('content')
<div class="container">
    <div class="error-404-container">
        <div class="error-404-num">500</div>
        <x-badge variant="navy" class="mb-3">Kesalahan Internal</x-badge>
        <h1 class="h2 text-navy mb-2" style="font-weight:700;">Terjadi Kesalahan Server</h1>
        <p class="text-secondary small max-w-700 mb-4" style="max-width:540px;">Mohon maaf, terjadi gangguan internal. Tim teknis telah mencatat kejadian ini. Silakan coba beberapa saat lagi.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn-ppak-primary"><i class="fa-solid fa-house me-1"></i> Kembali ke Beranda</a>
            <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-secondary"><i class="fa-solid fa-headset me-1"></i> Hubungi Helpdesk</a>
        </div>
    </div>
</div>
@endsection
