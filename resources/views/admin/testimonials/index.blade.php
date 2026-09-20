@extends('admin.layouts.app')

@section('title', 'Testimoni')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Testimoni</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 fw-bold mb-0">Testimoni</h1>
            <p class="text-muted small mb-0">Hanya testimoni terverifikasi & berstatus published yang tampil di website.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Testimoni</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Nama</th><th>Isi</th><th>Status</th><th>Urutan</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $item->name }}</div>
                                <div class="small text-muted">{{ $item->role ?? '—' }} @if($item->company) &bull; {{ $item->company }} @endif</div>
                            </td>
                            <td class="small">{{ \Illuminate\Support\Str::limit($item->quote, 120) }}</td>
                            <td><span class="badge {{ $item->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status }}</span></td>
                            <td class="small">{{ $item->sort_order }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.testimonials.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.testimonials.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada testimoni. Jangan membuat testimoni fiktif.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
