@props(['variant' => 'primary', 'size' => 'default', 'href' => null, 'type' => 'button'])
@php
$variantMap = [
    'primary' => 'btn-ppak-primary',
    'secondary' => 'btn-ppak-secondary',
    'gold' => 'btn-ppak-gold',
    'navbar' => 'btn-navbar-cta',
    'hero-primary' => 'btn-hero-primary',
    'hero-secondary' => 'btn-hero-secondary',
];
$sizeMap = [
    'sm' => 'btn-ppak-sm',
    'lg' => 'btn-ppak-lg',
];
$classes = ($variantMap[$variant] ?? $variantMap['primary']) . ' ' . ($sizeMap[$size] ?? '');
@endphp
@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
