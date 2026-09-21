@extends('admin.layouts.app')

@section('title', 'Dokumen')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dokumen</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Dokumen & Download</h1>
        <a href="{{ route('admin.documents.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-upload me-1"></i>Upload Dokumen</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari judul dokumen...">
                </div>
                <div class="col-md-3">
                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">Semua kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected((string) request('kategori') === (string) $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="tahun" class="form-select form-select-sm">
                        <option value="">Semua tahun</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" @selected((string) request('tahun') === (string) $y)>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua status</option>
                        @foreach(config('ppak.options.doc_status') as $val => $label)
                            <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-grid">
                    <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="trashed" value="1" id="trashed" @checked(request()->boolean('trashed')) onchange="this.form.submit()">
                        <label class="form-check-label small" for="trashed">Tampilkan arsip</label>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Dokumen</th><th>Kategori</th><th>Ukuran</th><th>Status</th><th style="width:150px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($documents as $doc)
                        <tr @if($doc->trashed()) class="table-light" @endif>
                            <td>
                                <div class="fw-semibold"><i class="fa-solid fa-file-pdf text-danger me-1"></i>{{ $doc->title }}</div>
                                <div class="small text-muted">{{ $doc->filename }} &bull; {{ $doc->year ?? '—' }}</div>
                            </td>
                            <td><span class="badge text-bg-light border">{{ $doc->category?->name ?? '—' }}</span></td>
                            <td class="small">{{ number_format($doc->size / 1024, 1) }} KB</td>
                            <td>
                                <span class="badge {{ $doc->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $doc->status }}</span>
                                @if($doc->trashed()) <span class="badge text-bg-danger">Arsip</span> @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($doc->trashed())
                                        <form method="POST" action="{{ route('admin.documents.restore', $doc->id) }}">
                                            @csrf
                                            <button class="btn btn-outline-success" title="Pulihkan"><i class="fa-solid fa-rotate-left"></i></button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.documents.edit', $doc) }}" class="btn btn-outline-primary" title="Ubah"><i class="fa-solid fa-pen"></i></a>
                                        <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.documents.destroy', $doc) }}" data-message="Arsipkan dokumen ini? File fisik tetap tersimpan."><i class="fa-solid fa-trash"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada dokumen.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($documents->hasPages())
            <div class="card-footer">{{ $documents->links() }}</div>
        @endif
    </div>
@endsection
