@props([
    'title' => 'Judul Halaman',
    'lead' => null,
    'badge' => null,
    'breadcrumbs' => []
])
{{-- BreadcrumbList JSON-LD otomatis dari breadcrumb visual yang sama --}}
@if(!empty($breadcrumbs))
@push('jsonld')
<script type="application/ld+json">{!! json_encode(\App\Services\SeoService::breadcrumbJsonLd(array_merge([['label' => 'Beranda', 'url' => route('home')]], array_filter($breadcrumbs, fn ($b) => !empty($b['label'])))), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endif

<header class="page-header-ppak">
    <div class="container">
        {{-- Breadcrumbs --}}
        @if(!empty($breadcrumbs))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb-ppak">
                    <li class="breadcrumb-ppak-item">
                        <a href="{{ route('home') }}">
                            <i class="fa-solid fa-house me-1" style="font-size: 0.75rem;"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    @foreach($breadcrumbs as $breadcrumb)
                        @if($loop->last || empty($breadcrumb['url']))
                            <li class="breadcrumb-ppak-item active" aria-current="page">
                                {{ $breadcrumb['label'] }}
                            </li>
                        @else
                            <li class="breadcrumb-ppak-item">
                                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif

        {{-- Badge / Subtitle Eyebrow in UNESA Gold --}}
        @if($badge)
            <div class="mb-2">
                <span class="badge-ppak badge-ppak-gold">
                    {{ $badge }}
                </span>
            </div>
        @endif

        {{-- Page Title --}}
        <h1 class="page-header-title">{{ $title }}</h1>

        {{-- Golden Line Accent --}}
        <div class="golden-line"></div>

        {{-- Page Description / Lead --}}
        @if($lead)
            <p class="page-header-lead">{{ $lead }}</p>
        @endif

        {{-- Konten tambahan dari pemanggil (hanya saat dipakai sebagai <x-page-header>) --}}
        {{ $slot ?? '' }}
    </div>
</header>
