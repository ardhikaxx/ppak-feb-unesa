@extends('admin.layouts.app')

@section('title', 'Konten Halaman')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Konten Halaman</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 fw-bold mb-0">Konten Halaman Statis</h1>
            <p class="text-muted small mb-0">Ubah teks section tanpa mengubah desain. Baris yang dihapus kembali ke teks bawaan.</p>
        </div>
        <a href="{{ route('admin.page-contents.create', ['page' => $page]) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Section</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="btn-group flex-wrap" role="group" aria-label="Halaman">
                @foreach(\App\Models\PageContent::PAGES as $key => $label)
                    <a href="{{ route('admin.page-contents.index', ['page' => $key]) }}"
                       class="btn btn-sm {{ $page === $key ? 'btn-primary' : 'btn-outline-secondary' }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Kunci Section</th><th>Heading</th><th>Isi (ringkas)</th><th>Status</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td><code class="small">{{ $item->section_key }}</code></td>
                            <td class="fw-semibold">{{ $item->heading ?? $item->subtitle ?? '—' }}</td>
                            <td class="small text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($item->body ?? ''), 110) }}</td>
                            <td><span class="badge {{ $item->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.page-contents.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.page-contents.destroy', $item) }}" data-message="Hapus section {{ $item->section_key }}? Halaman akan memakai teks bawaan."><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada section. Halaman memakai teks bawaan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
