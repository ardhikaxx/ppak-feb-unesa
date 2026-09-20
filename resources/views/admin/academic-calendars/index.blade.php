@extends('admin.layouts.app')

@section('title', 'Kalender Akademik')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Kalender Akademik</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 fw-bold mb-0">Kalender Akademik</h1>
            <p class="text-muted small mb-0">Per tahun akademik & semester. Data lama menjadi arsip otomatis.</p>
        </div>
        <a href="{{ route('admin.academic-calendars.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Kegiatan</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-4">
                    <select name="tahun" class="form-select form-select-sm">
                        <option value="">Semua tahun akademik</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" @selected(request('tahun') === $y)>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="semester" class="form-select form-select-sm">
                        <option value="">Semua semester</option>
                        @foreach(['Gasal', 'Genap'] as $s)
                            <option value="{{ $s }}" @selected(request('semester') === $s)>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari kegiatan...">
                </div>
                <div class="col-md-1 d-grid">
                    <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Tahun / Semester</th><th>Kegiatan</th><th>Tanggal</th><th>Kategori</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td><span class="badge text-bg-primary">{{ $item->academic_year }}</span> <span class="badge text-bg-light border">{{ $item->semester }}</span></td>
                            <td class="fw-semibold">{{ $item->activity }}</td>
                            <td class="small">{{ $item->start_date?->format('d M Y') }}@if($item->end_date)<br><span class="text-muted">s.d. {{ $item->end_date->format('d M Y') }}</span>@endif</td>
                            <td class="small">{{ $item->category }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.academic-calendars.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.academic-calendars.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada kegiatan kalender.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
