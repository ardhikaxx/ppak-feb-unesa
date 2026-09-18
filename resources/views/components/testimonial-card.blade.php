@props(['quote' => '', 'avatar' => '', 'name' => '', 'role' => '', 'company' => '', 'year' => ''])
<div class="testi-card h-100" {{ $attributes }}>
    <blockquote class="testi-quote">"{{ $quote }}"</blockquote>
    <div class="testi-author">
        <img src="{{ $avatar ?: '/images/default-img.png' }}" alt="{{ $name }}" class="testi-avatar" loading="lazy" width="48" height="48">
        <div>
            <div class="testi-name">{{ $name }}</div>
            <div class="testi-role">{{ $role }} &bull; {{ $company }}</div>
            @if($year)
                <div class="small text-muted" style="font-size:0.725rem;">{{ $year }}</div>
            @endif
        </div>
    </div>
</div>
