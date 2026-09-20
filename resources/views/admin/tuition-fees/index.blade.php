@extends('admin.layouts.app')

@section('title', 'Biaya Pendidikan')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Biaya Pendidikan</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 fw-bold mb-0">Biaya Pendidikan</h1>
            <p class="text-muted small mb-0">Per periode/tahun akademik. Nominal lama adalah data historis — buat record baru untuk periode baru.</p>
        </div>
        <a href="{{ route('admin.tuition-fees.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Periode</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Program / Jenis</th><th>Nominal</th><th>Periode</th><th>Tahun</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td><div class="fw-semibold">{{ $item->program_name }}</div><div class="small text-muted">{{ $item->fee_type }}</div></td>
                            <td class="fw-bold">Rp{{ number_format($item->amount, 0, ',', '.') }}</td>
                            <td class="small">{{ $item->period }}</td>
                            <td><span class="badge text-bg-primary">{{ $item->academic_year }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.tuition-fees.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.tuition-fees.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data biaya.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
