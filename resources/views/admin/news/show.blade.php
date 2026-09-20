@extends('admin.layouts.app')

@section('title', 'Detail Berita')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Berita</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Detail Berita</h1>
        <div class="d-flex gap-2">
            @if($news->status === 'published')
                <a href="{{ route('informasi.berita.detail', $news->slug) }}" target="_blank" rel="noopener" class="btn btn-info btn-sm">
                    <i class="fa-solid fa-globe me-1"></i>Preview Publik
                </a>
            @endif
            <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen me-1"></i>Ubah</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <span class="badge {{ $news->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $news->status }}</span>
            <span class="badge text-bg-light border">{{ $news->category?->name ?? 'Tanpa kategori' }}</span>
            <h2 class="h5 fw-bold mt-2">{{ $news->title }}</h2>
            <p class="text-muted small">Slug: /{{ $news->slug }} &bull; Terbit: {{ $news->published_at?->format('d M Y H:i') ?? '—' }} &bull; Dilihat: {{ $news->view_count }}</p>
            @if($news->image)
                <img src="{{ $news->image }}" alt="" class="img-fluid rounded mb-3" style="max-height:320px;">
            @endif
            <p class="fst-italic text-secondary">{{ $news->excerpt }}</p>
            <hr>
            <div>{!! nl2br(e($news->content)) !!}</div>
            @if($news->tags)
                <hr>
                <div class="small">Tag: {{ implode(', ', (array) $news->tags) }}</div>
            @endif
        </div>
    </div>
@endsection
