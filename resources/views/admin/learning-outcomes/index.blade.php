@extends('admin.layouts.app')

@section('title', 'CPL')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">CPL</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 fw-bold mb-0">Capaian Pembelajaran Lulusan (CPL)</h1>
            <p class="text-muted small mb-0">Urutan tampil mengikuti kolom Urutan.</p>
        </div>
        <a href="{{ route('admin.learning-outcomes.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah CPL</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Kode</th><th>Judul</th><th>Kategori</th><th>Urutan</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($outcomes as $o)
                        <tr>
                            <td><span class="badge text-bg-primary">{{ $o->code }}</span></td>
                            <td>
                                <div class="fw-semibold">{{ $o->title ?? $o->code }}</div>
                                <div class="small text-muted">{{ \Illuminate\Support\Str::limit($o->description, 120) }}</div>
                            </td>
                            <td class="small">{{ $o->category ?? '—' }}</td>
                            <td class="small">{{ $o->sort_order }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.learning-outcomes.edit', $o) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.learning-outcomes.destroy', $o) }}" data-message="Hapus {{ $o->code }}?"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada CPL.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($outcomes->hasPages())
            <div class="card-footer">{{ $outcomes->links() }}</div>
        @endif
    </div>
@endsection
