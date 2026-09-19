@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi Halaman" class="d-flex justify-content-center my-4">
        <ul class="ppak-pagination">
            {{-- Pagination Elements (Numbers Only - Tanpa Teks) --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="ppak-page-item disabled" aria-disabled="true">
                        <span class="ppak-page-link ppak-page-dots">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="ppak-page-item active" aria-current="page">
                                <span class="ppak-page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="ppak-page-item">
                                <a class="ppak-page-link" href="{{ $url }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif
