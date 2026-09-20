@extends('admin.layouts.app')

@section('title', 'Galeri')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Galeri Foto</h1>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Foto</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari judul foto...">
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua status</option>
                        @foreach(['draft' => 'Draft', 'published' => 'Terbit', 'archived' => 'Arsip'] as $val => $label)
                            <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-secondary btn-sm">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th style="width:80px;">Foto</th><th>Judul</th><th>Kategori</th><th>Status</th><th style="width:150px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr @if($item->trashed()) class="table-light" @endif>
                            <td><img src="{{ $item->image }}" alt="" class="rounded" style="width:64px;height:48px;object-fit:cover;"></td>
                            <td>
                                <div class="fw-semibold">{{ $item->title }}</div>
                                <div class="small text-muted">/{{ $item->slug }} &bull; {{ $item->event_date?->format('d M Y') ?? '—' }}</div>
                            </td>
                            <td class="small">{{ $item->category?->name ?? '—' }}</td>
                            <td>
                                <span class="badge {{ $item->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status }}</span>
                                @if($item->trashed()) <span class="badge text-bg-danger">Arsip</span> @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($item->trashed())
                                        <form method="POST" action="{{ route('admin.galleries.restore', $item->id) }}">
                                            @csrf
                                            <button class="btn btn-outline-success" title="Pulihkan"><i class="fa-solid fa-rotate-left"></i></button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.galleries.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                        <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.galleries.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada foto galeri.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
