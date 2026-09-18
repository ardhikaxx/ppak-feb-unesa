@extends('layouts.app')
@section('title', '403 - Akses Ditolak | PPAk FEB UNESA')
@section('hide_cta', true)
@section('content')
<div class="container">
    <div class="error-404-container">
        <div class="error-404-num">403</div>
        <x-badge variant="navy" class="mb-3">Akses Ditolak</x-badge>
        <h1 class="h2 text-navy mb-2" style="font-weight:700;">Anda Tidak Memiliki Izin</h1>
        <p class="text-secondary small max-w-700 mb-4" style="max-width:540px;">Mohon maaf, Anda tidak memiliki hak akses ke halaman ini. Silakan login dengan akun yang sesuai atau hubungi administrator.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn-ppak-primary"><i class="fa-solid fa-house me-1"></i> Kembali ke Beranda</a>
            <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-secondary"><i class="fa-solid fa-headset me-1"></i> Helpdesk</a>
        </div>
    </div>
</div>
@endsection
