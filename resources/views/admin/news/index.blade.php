@extends('admin.layouts.app')

@section('title', 'Kelola Berita')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Berita</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Berita & Pengumuman</h1>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Berita</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari judul / excerpt...">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua status</option>
                        @foreach(['draft' => 'Draft', 'published' => 'Terbit', 'scheduled' => 'Terjadwal', 'archived' => 'Arsip'] as $val => $label)
                            <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">Semua kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected((string) request('kategori') === (string) $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-grid">
                    <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="trashed" value="1" id="trashed" @checked(request()->boolean('trashed')) onchange="this.form.submit()">
                        <label class="form-check-label small" for="trashed">Tampilkan arsip (soft delete)</label>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Terbit</th>
                        <th style="width:220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                        <tr @if($item->trashed()) class="table-light" @endif>
                            <td>
                                <div class="fw-semibold">{{ $item->title }}</div>
                                <div class="small text-muted">/{{ $item->slug }}</div>
                            </td>
                            <td><span class="badge text-bg-light border">{{ $item->category?->name ?? '—' }}</span></td>
                            <td>
                                <span class="badge {{ $item->status === 'published' ? 'text-bg-success' : ($item->status === 'draft' ? 'text-bg-secondary' : 'text-bg-warning') }}">
                                    {{ $item->status }}
                                </span>
                                @if($item->trashed()) <span class="badge text-bg-danger">Arsip</span> @endif
                            </td>
                            <td class="small">{{ $item->published_at?->format('d M Y') ?? '—' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($item->trashed())
                                        <form method="POST" action="{{ route('admin.news.restore', $item->id) }}">
                                            @csrf
                                            <button class="btn btn-outline-success" title="Pulihkan"><i class="fa-solid fa-rotate-left"></i></button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.news.show', $item) }}" class="btn btn-outline-secondary" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-outline-primary" title="Ubah"><i class="fa-solid fa-pen"></i></a>
                                        @if($item->status === 'published')
                                            <a href="{{ route('informasi.berita.detail', $item->slug) }}" target="_blank" rel="noopener" class="btn btn-outline-info" title="Preview publik"><i class="fa-solid fa-globe"></i></a>
                                        @endif
                                        <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.news.destroy', $item) }}" title="Arsipkan"><i class="fa-solid fa-trash"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada berita. <a href="{{ route('admin.news.create') }}">Tambah berita pertama</a>.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($news->hasPages())
            <div class="card-footer">{{ $news->links() }}</div>
        @endif
    </div>
@endsection
