@props(['image' => '', 'category' => '', 'date' => '', 'title' => '', 'excerpt' => '', 'href' => '#', 'readTime' => null])
<article class="news-card h-100" {{ $attributes }}>
    <div class="news-card-img-wrapper">
        <img src="{{ $image ?: '/images/default-img.png' }}" alt="{{ $title }}" class="news-card-img" loading="lazy" width="600" height="338" style="aspect-ratio: 16/9; object-fit: cover;">
    </div>
    <div class="news-card-body">
        <div class="news-card-meta">
            @if($category)
                <x-badge variant="navy" style="font-size:0.7rem;">{{ $category }}</x-badge>
            @endif
            @if($date)
                <span><i class="fa-regular fa-calendar me-1"></i> {{ $date }}</span>
            @endif
        </div>
        <h3 class="news-card-title">
            <a href="{{ $href }}">{{ $title }}</a>
        </h3>
        @if($excerpt)
            <p class="news-card-excerpt">{{ $excerpt }}</p>
        @endif
        <div class="d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
            @if($readTime)
                <span class="small text-muted" style="font-size:0.75rem;"><i class="fa-regular fa-clock me-1"></i> {{ $readTime }}</span>
            @else
                <span></span>
            @endif
            <a href="{{ $href }}" class="small fw-bold text-primary text-decoration-none">Selengkapnya &rarr;</a>
        </div>
    </div>
</article>
