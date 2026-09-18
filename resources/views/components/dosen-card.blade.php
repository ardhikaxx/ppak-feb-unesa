@props(['image' => '', 'name' => '', 'gelar' => '', 'role' => '', 'categoryLabel' => ''])
<div class="dosen-card h-100" {{ $attributes }}>
    <div class="dosen-photo-wrapper">
        <img src="{{ $image ?: '/images/default-img.png' }}" alt="{{ $name }}" class="dosen-photo" loading="lazy" width="400" height="420" style="aspect-ratio: 1/1.05; object-fit: cover;">
    </div>
    <div class="dosen-info">
        <h3 class="dosen-name">{{ $name }}</h3>
        @if($gelar)
            <div class="dosen-gelar">{{ $gelar }}</div>
        @endif
        @if($role)
            <div class="dosen-role">{{ $role }}</div>
        @endif
        @if($categoryLabel)
            <div class="mt-auto pt-2 border-top">
                <x-badge variant="navy" style="font-size:0.7rem;">{{ $categoryLabel }}</x-badge>
            </div>
        @endif
    </div>
</div>
