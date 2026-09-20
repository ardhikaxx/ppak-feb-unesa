@extends('layouts.app')

@section('title', 'Agenda & Seminar Ilmiah | PPAk FEB UNESA')
@section('meta_description', 'Kalender agenda kegiatan ilmiah, workshop sertifikasi CA, webinar perpajakan, dan seremoni akademik PPAk FEB UNESA.')

@push('jsonld')
@if(count($agenda) > 0)
<script type="application/ld+json">{!! json_encode(\App\Services\SeoService::eventsJsonLd($agenda), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endif
@endpush

@section('content')

<x-page-header title="Agenda, Seminar & Kuliah Tamu" badge="Kegiatan Sivitas Akademika" lead="Ikuti rangkaian seminar berkala, workshop teknis sertifikasi CA, dan forum diskusi pakar akuntansi terkini." :breadcrumbs="[
    ['label' => 'Informasi', 'url' => route('informasi.berita')],
    ['label' => 'Agenda & Seminar', 'url' => '']
]" />

<section class="section-py bg-white">
    <div class="container">
        {{-- Filter tabs - server-side --}}
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('informasi.agenda', ['filter' => 'all']) }}" class="btn-{{ request('filter', 'all')==='all' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Semua</a>
            <a href="{{ route('informasi.agenda', ['filter' => 'upcoming']) }}" class="btn-{{ request('filter')==='upcoming' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Mendatang</a>
            <a href="{{ route('informasi.agenda', ['filter' => 'past']) }}" class="btn-{{ request('filter')==='past' ? 'ppak-primary' : 'ppak-secondary' }} btn-ppak-sm">Arsip</a>
        </div>

        @if($agenda->count() > 0)
            @foreach($agenda as $event)
                <x-event-card :day="$event['day']" :month="$event['month']" :category="$event['category']" :time="$event['time']" :venue="$event['venue']" :title="$event['title']" :desc="$event['desc']" :status="$event['status']" :isUpcoming="$event['is_upcoming']" />
            @endforeach

            <div class="d-flex justify-content-center mt-4">
                {{ $agenda->withQueryString()->links('vendor.pagination.numbers') }}
            </div>
        @else
            <x-empty-state title="Belum ada agenda" message="Tidak ada agenda untuk filter ini." icon="fa-calendar" />
        @endif
    </div>
</section>

@endsection


