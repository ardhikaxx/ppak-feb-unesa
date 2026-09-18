@extends('layouts.app')

@section('title', 'Agenda & Seminar Ilmiah | PPAk FEB UNESA')
@section('meta_description', 'Kalender agenda kegiatan ilmiah, workshop sertifikasi CA, webinar perpajakan, dan seremoni akademik PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Agenda, Seminar & Kuliah Tamu',
    'badge' => 'Kegiatan Sivitas Akademika',
    'lead' => 'Ikuti rangkaian seminar berkala, workshop teknis sertifikasi CA, dan forum diskusi pakar akuntansi terkini.',
    'breadcrumbs' => [
        ['label' => 'Informasi', 'url' => route('informasi.berita')],
        ['label' => 'Agenda & Seminar', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- UPCOMING EVENTS --}}
        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <span class="badge-ppak badge-ppak-green mb-1"><i class="fa-solid fa-circle" style="font-size: 0.4rem;"></i> Terjadwal</span>
                    <h2 class="h4 text-navy fw-bold mb-0">Agenda & Event Mendatang</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @php
                        $upcoming = array_filter($agenda, fn($e) => $e['is_upcoming']);
                        $past = array_filter($agenda, fn($e) => !$e['is_upcoming']);
                    @endphp

                    @forelse($upcoming as $event)
                        <div class="event-item-card">
                            <div class="event-date-box">
                                <span class="event-date-day">{{ $event['day'] }}</span>
                                <span class="event-date-month">{{ $event['month'] }}</span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                    <span class="badge-ppak badge-ppak-blue" style="font-size: 0.725rem;">{{ $event['category'] }}</span>
                                    <span class="small text-muted"><i class="fa-regular fa-clock me-1"></i> {{ $event['time'] }}</span>
                                    <span class="small text-muted"><i class="fa-solid fa-location-dot me-1"></i> {{ $event['venue'] }}</span>
                                </div>
                                <h3 class="fs-6 fw-bold text-navy mb-1">{{ $event['title'] }}</h3>
                                <p class="small text-secondary mb-2">{{ $event['desc'] }}</p>
                                <div class="small text-primary fw-semibold">
                                    <i class="fa-solid fa-microphone me-1"></i> Narasumber: {{ $event['speaker'] }}
                                </div>
                            </div>
                            <div class="ms-lg-auto flex-shrink-0 mt-3 mt-lg-0">
                                <span class="badge-ppak badge-ppak-green me-2">{{ $event['status'] }}</span>
                                <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-primary btn-ppak-sm">
                                    <span>Ikuti Event</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">Belum ada agenda mendatang dalam waktu dekat.</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- PAST EVENTS --}}
        <div class="mt-5 pt-4 border-top">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <span class="badge-ppak badge-ppak-navy mb-1">Arsip Kegiatan</span>
                    <h3 class="h4 text-navy fw-bold mb-0">Event yang Telah Berlangsung</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @foreach($past as $event)
                        <div class="event-item-card opacity-75">
                            <div class="event-date-box bg-light border-light-subtle">
                                <span class="event-date-day text-secondary">{{ $event['day'] }}</span>
                                <span class="event-date-month text-muted">{{ $event['month'] }}</span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                    <span class="badge-ppak badge-ppak-navy" style="font-size: 0.7rem;">{{ $event['category'] }}</span>
                                    <span class="small text-muted"><i class="fa-regular fa-clock me-1"></i> {{ $event['time'] }}</span>
                                    <span class="small text-muted"><i class="fa-solid fa-location-dot me-1"></i> {{ $event['venue'] }}</span>
                                </div>
                                <h4 class="fs-6 fw-bold text-navy mb-1">{{ $event['title'] }}</h4>
                                <p class="small text-secondary mb-1">{{ $event['desc'] }}</p>
                                <div class="small text-muted">
                                    <i class="fa-solid fa-microphone me-1"></i> Pembicara: {{ $event['speaker'] }}
                                </div>
                            </div>
                            <div class="ms-lg-auto flex-shrink-0 mt-3 mt-lg-0">
                                <span class="badge-ppak badge-ppak-navy">{{ $event['status'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
