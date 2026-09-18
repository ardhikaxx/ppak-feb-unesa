@props(['title' => '', 'badge' => null, 'lead' => null, 'breadcrumbs' => []])
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
