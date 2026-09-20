@extends('admin.layouts.app')

@section('title', 'Akreditasi')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Akreditasi</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Akreditasi</h1>
        <a href="{{ route('admin.accreditations.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Data</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Program</th><th>Lembaga / Status</th><th>SK & Masa Berlaku</th><th style="width:150px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($accreditations as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->program_name }}</td>
                            <td><span class="badge text-bg-success">{{ $item->agency }} — {{ $item->status }}</span></td>
                            <td class="small">{{ $item->decree_number }}<br><span class="text-muted">{{ $item->effective_from?->format('d M Y') }} s.d. {{ $item->effective_until?->format('d M Y') }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.accreditations.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.accreditations.destroy', $item) }}" data-message="Hapus data akreditasi ini? Riwayat akreditasi akan hilang."><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data akreditasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($accreditations->hasPages())
            <div class="card-footer">{{ $accreditations->links() }}</div>
        @endif
    </div>
@endsection
