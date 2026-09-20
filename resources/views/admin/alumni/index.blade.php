@extends('admin.layouts.app')

@section('title', 'Alumni')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Alumni</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Data Alumni</h1>
        <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Alumni</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Nama</th><th>Lulus</th><th>Instansi / Jabatan</th><th>Status</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->full_name }}</td>
                            <td><span class="badge text-bg-light border">{{ $item->graduation_year ?? '—' }}</span></td>
                            <td class="small">{{ $item->current_position ?? '—' }} @if($item->current_company)<br><span class="text-muted">{{ $item->current_company }}</span>@endif</td>
                            <td><span class="badge {{ $item->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.alumni.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.alumni.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data alumni resmi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
