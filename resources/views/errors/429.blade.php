@extends('layouts.app')
@section('title', '429 - Terlalu Banyak Permintaan | PPAk FEB UNESA')
@section('hide_cta', true)
@section('content')
<div class="container">
    <div class="error-404-container">
        <div class="error-404-num">429</div>
        <x-badge variant="gold" class="mb-3">Batas Permintaan</x-badge>
        <h1 class="h2 text-navy mb-2" style="font-weight:700;">Terlalu Banyak Permintaan</h1>
        <p class="text-secondary small max-w-700 mb-4" style="max-width:540px;">Anda mengirim terlalu banyak permintaan dalam waktu singkat. Silakan tunggu beberapa saat sebelum mencoba lagi.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn-ppak-primary"><i class="fa-solid fa-house me-1"></i> Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
