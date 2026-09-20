@props(['title' => 'Tautan Terkait', 'links' => []])
{{-- Blok tautan kontekstual antar-halaman satu topik (topical cluster).
     $links = [['label' => ..., 'url' => ..., 'desc' => ...], ...] --}}
@if(!empty($links))
<section class="mt-5" aria-label="{{ $title }}">
    <div class="p-4 rounded-4 border bg-subtle">
        <h2 class="h5 text-navy fw-bold mb-1">
            <i class="fa-solid fa-link me-1 text-primary"></i> {{ $title }}
        </h2>
        <p class="small text-secondary mb-3">Lanjutkan membaca informasi terkait di bawah ini.</p>
        <div class="row g-3">
            @foreach($links as $link)
                <div class="col-md-6">
                    <a href="{{ $link['url'] }}" class="card-ppak-flat h-100 d-block text-decoration-none p-3">
                        <div class="fw-bold text-navy small mb-1">
                            {{ $link['label'] }} <i class="fa-solid fa-arrow-right ms-1 text-gold" style="font-size: 0.7rem;"></i>
                        </div>
                        @if(!empty($link['desc']))
                            <div class="small text-secondary mb-0">{{ $link['desc'] }}</div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
