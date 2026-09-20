@props(['title' => '', 'badge' => null, 'lead' => null, 'breadcrumbs' => []])
{{-- BreadcrumbList JSON-LD otomatis dari breadcrumb visual yang sama --}}
@if(!empty($breadcrumbs))
@push('jsonld')
<script type="application/ld+json">{!! json_encode(\App\Services\SeoService::breadcrumbJsonLd(array_merge([['label' => 'Beranda', 'url' => route('home')]], array_filter($breadcrumbs, fn ($b) => !empty($b['label'])))), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@endif
<section class="page-header-ppak">
    <div class="container">
        @if(!empty($breadcrumbs))
            <x-breadcrumb :items="$breadcrumbs" />
        @endif
        @if($badge)
            <div class="mb-3">
                <x-badge variant="gold">{{ $badge }}</x-badge>
            </div>
        @endif
        <h1 class="page-header-title">{{ $title }}</h1>
        @if($lead)
            <p class="page-header-lead">{{ $lead }}</p>
        @endif
        {{ $slot }}
    </div>
</section>
