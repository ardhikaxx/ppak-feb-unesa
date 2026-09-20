@extends('admin.layouts.app')

@section('title', 'Blok Konten')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Blok Konten</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 fw-bold mb-0">Blok Konten Section</h1>
            <p class="text-muted small mb-0">Kelola teks section sederhana. Selama grup kosong, website memakai data bawaan (tampilan tidak berubah).</p>
        </div>
        <div class="d-flex gap-2">
            <form method="POST" action="{{ route('admin.content-blocks.import', $group) }}">
                @csrf
                <button class="btn btn-outline-secondary btn-sm" title="Salin data bawaan menjadi baris yang bisa diedit">
                    <i class="fa-solid fa-download me-1"></i>Impor Bawaan
                </button>
            </form>
            <a href="{{ route('admin.content-blocks.create', ['group' => $group]) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah</a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="btn-group" role="group" aria-label="Grup konten">
                @foreach(\App\Models\ContentBlock::GROUPS as $key => $label)
                    <a href="{{ route('admin.content-blocks.index', ['group' => $key]) }}"
                       class="btn btn-sm {{ $group === $key ? 'btn-primary' : 'btn-outline-secondary' }}">{{ $label }}</a>
                @endforeach
            </div>
            <div class="small text-muted mt-2">
                Data bawaan grup ini: <strong>{{ $fallbackCount }} item</strong>.
                @if($items->total() === 0)
                    Grup masih kosong — website menampilkan data bawaan.
                @else
                    Grup sudah diambil alih ({{ $items->total() }} baris) — website menampilkan data ini.
                @endif
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Judul</th><th>Deskripsi</th><th>Urutan</th><th>Status</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="fw-semibold">@if($item->icon)<i class="fa-solid {{ $item->icon }} me-1"></i>@endif{{ $item->title }}</div>
                            </td>
                            <td class="small text-muted">{{ \Illuminate\Support\Str::limit($item->description, 110) }}</td>
                            <td class="small">{{ $item->sort_order }}</td>
                            <td><span class="badge {{ $item->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.content-blocks.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.content-blocks.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada baris kustom. Klik <strong>Impor Bawaan</strong> untuk mulai mengedit dari data saat ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
