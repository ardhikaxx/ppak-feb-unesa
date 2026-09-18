@props(['items' => []])
@if(!empty($items))
<nav aria-label="breadcrumb">
    <ol class="breadcrumb-ppak">
        @foreach($items as $item)
            @if(!$loop->last && !empty($item['url']))
                <li class="breadcrumb-ppak-item">
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                </li>
            @else
                <li class="breadcrumb-ppak-item active" aria-current="page">{{ $item['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>
@endif
