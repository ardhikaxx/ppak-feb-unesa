@extends('admin.layouts.app')

@section('title', 'Publikasi')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Publikasi</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Publikasi Ilmiah</h1>
        <a href="{{ route('admin.publications.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Publikasi</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari judul / penulis...">
                </div>
                <div class="col-md-4">
                    <select name="tahun" class="form-select form-select-sm">
                        <option value="">Semua tahun</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" @selected((string) request('tahun') === (string) $y)>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-secondary btn-sm">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Judul / Penulis</th><th>Tahun</th><th>Jurnal / Penerbit</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $item->title }}</div>
                                <div class="small text-muted">{{ $item->authors }}</div>
                            </td>
                            <td><span class="badge text-bg-light border">{{ $item->year ?? '—' }}</span></td>
                            <td class="small">{{ $item->journal_or_publisher ?? '—' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.publications.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.publications.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada publikasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
