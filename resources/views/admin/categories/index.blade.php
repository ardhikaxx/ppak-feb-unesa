@extends('admin.layouts.app')

@section('title', 'Kategori')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Kategori</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Kategori Konten</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Kategori</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Nama</th><th>Tipe</th><th>Terpakai</th><th>Urutan</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $cat->name }}</div>
                                <div class="small text-muted">/{{ $cat->slug }}</div>
                            </td>
                            <td><span class="badge text-bg-light border">{{ $cat->type }}</span></td>
                            <td class="small">{{ $usage[$cat->id] ?? 0 }} konten</td>
                            <td class="small">{{ $cat->sort_order }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.categories.destroy', $cat) }}" data-message="Hapus kategori {{ $cat->name }}? Hanya bisa dihapus jika tidak dipakai konten."><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
            <div class="card-footer">{{ $categories->links() }}</div>
        @endif
    </div>
@endsection
