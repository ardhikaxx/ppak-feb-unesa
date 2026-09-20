@extends('layouts.app')

@section('title', 'Pencarian: ' . $keyword . ' | PPAk FEB UNESA')
@section('meta_description', 'Hasil pencarian untuk ' . $keyword . ' di PPAk FEB UNESA.')
{{-- Hasil pencarian internal bukan landing page: jangan diindeks, tetap ikuti link --}}
@section('meta_robots', 'noindex,follow')

@section('content')

@include('partials.page-header', [
    'title' => 'Hasil Pencarian',
    'badge' => 'Pencarian',
    'lead' => 'Menampilkan hasil untuk kata kunci: "' . $keyword . '"',
    'breadcrumbs' => [
        ['label' => 'Beranda', 'url' => route('home')],
        ['label' => 'Pencarian', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        @if(empty($results['berita']) && empty($results['agenda']) && empty($results['dosen']))
            <x-empty-state title="Tidak ada hasil" message="Tidak ditemukan konten untuk kata kunci '{{ $keyword }}'. Coba kata kunci lain." icon="fa-magnifying-glass" />
        @else
            @if(!empty($results['berita']))
                <div class="mb-5">
                    <h3 class="h5 fw-bold text-navy mb-3">Berita ({{ count($results['berita']) }})</h3>
                    <div class="row g-4">
                        @foreach($results['berita'] as $item)
                            <div class="col-md-6 col-lg-4">
                                <x-news-card :image="$item['image']" :category="$item['category']" :date="$item['date']" :title="$item['title']" :excerpt="$item['excerpt']" :href="route('informasi.berita.detail', $item['slug'])" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(!empty($results['agenda']))
                <div class="mb-5">
                    <h3 class="h5 fw-bold text-navy mb-3">Agenda ({{ count($results['agenda']) }})</h3>
                    @foreach($results['agenda'] as $ev)
                        <x-event-card 
                            :day="$ev['day'] ?? ''" 
                            :month="$ev['month'] ?? ''" 
                            :category="$ev['category_label'] ?? $ev['category'] ?? ''" 
                            :time="$ev['time'] ?? ''" 
                            :venue="$ev['venue'] ?? ''" 
                            :title="$ev['title'] ?? ''" 
                            :desc="$ev['desc'] ?? $ev['description'] ?? ''" 
                            :status="$ev['status'] ?? ($ev['is_upcoming'] ? 'Mendatang' : 'Selesai')" 
                            :isUpcoming="$ev['is_upcoming'] ?? false" 
                        />
                    @endforeach
                </div>
            @endif
            @if(!empty($results['dosen']))
                <div class="mb-5">
                    <h3 class="h5 fw-bold text-navy mb-3">Dosen ({{ count($results['dosen']) }})</h3>
                    <div class="row g-4">
                        @foreach($results['dosen'] as $d)
                            <div class="col-md-6 col-lg-3">
                                <x-dosen-card 
                                    :image="$d['image'] ?? '/images/default-img.png'" 
                                    :name="$d['name'] ?? ''" 
                                    :gelar="$d['gelar'] ?? ''" 
                                    :role="$d['role'] ?? ''" 
                                    :categoryLabel="$d['category_label'] ?? ''" 
                                />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>

@endsection
