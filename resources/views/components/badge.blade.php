@props(['variant' => 'navy', 'size' => 'default'])
@php
$base = 'badge-ppak';
$variantMap = [
    'navy' => 'badge-ppak-navy',
    'gold' => 'badge-ppak-gold',
    'blue' => 'badge-ppak-blue',
    'green' => 'badge-ppak-green',
];
$classes = $base . ' ' . ($variantMap[$variant] ?? $variantMap['navy']);
@endphp
<span {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</span>
