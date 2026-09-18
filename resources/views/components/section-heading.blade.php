@props(['badge' => null, 'badgeVariant' => 'gold', 'title' => '', 'subtitle' => null, 'align' => 'left', 'withLine' => true])
@php
$alignClass = $align === 'center' ? 'text-center max-w-700 mx-auto' : '';
$lineClass = $withLine ? 'golden-line' . ($align === 'center' ? ' center' : '') : '';
@endphp
<div class="{{ $alignClass }} {{ $attributes->get('class') }}">
    @if($badge)
        <x-badge :variant="$badgeVariant" class="mb-2">{{ $badge }}</x-badge>
    @endif
    @if($title)
        <h2>{{ $title }}</h2>
    @endif
    @if($withLine)
        <div class="{{ $lineClass }}"></div>
    @endif
    @if($subtitle)
        <p class="text-secondary">{{ $subtitle }}</p>
    @endif
    {{ $slot }}
</div>
