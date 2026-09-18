@props(['number' => '', 'label' => '', 'desc' => ''])
<div class="stat-card-apple h-100" {{ $attributes }}>
    <div class="stat-number">{{ $number }}</div>
    <div class="stat-label">{{ $label }}</div>
    <p class="stat-desc">{{ $desc }}</p>
</div>
