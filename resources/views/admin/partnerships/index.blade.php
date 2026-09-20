@extends('admin.layouts.app')

@section('title', 'Kerja Sama')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Kerja Sama</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Kerja Sama / Kemitraan</h1>
        <a href="{{ route('admin.partnerships.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Mitra</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Mitra</th><th>Kategori / Jenis</th><th>Masa Berlaku</th><th>Status</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->partner_name }}</td>
                            <td class="small">{{ $item->partner_category ?? '—' }}@if($item->collaboration_type)<br><span class="text-muted">{{ $item->collaboration_type }}</span>@endif</td>
                            <td class="small">{{ $item->valid_from?->format('d M Y') ?? '—' }} s.d. {{ $item->valid_until?->format('d M Y') ?? '—' }}</td>
                            <td><span class="badge {{ $item->status === 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.partnerships.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.partnerships.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data kemitraan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
