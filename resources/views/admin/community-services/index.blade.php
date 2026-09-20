@extends('admin.layouts.app')

@section('title', 'Pengabdian (PKM)')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Pengabdian</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 fw-bold mb-0">Pengabdian kepada Masyarakat (PKM)</h1>
            <p class="text-muted small mb-0">Hanya yang berstatus <em>published</em> yang tampil di website.</p>
        </div>
        <a href="{{ route('admin.community-services.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Kegiatan</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Kegiatan</th><th>Ketua / Lokasi</th><th>Tahun</th><th>Status</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->title }}</td>
                            <td class="small">{{ $item->leader_name ?? '—' }}@if($item->location)<br><span class="text-muted">{{ $item->location }}</span>@endif</td>
                            <td><span class="badge text-bg-light border">{{ $item->year ?? '—' }}</span></td>
                            <td><span class="badge {{ $item->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.community-services.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.community-services.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada kegiatan PKM. Halaman publik menampilkan status kosong yang profesional.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
