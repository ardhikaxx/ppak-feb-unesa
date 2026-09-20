@extends('admin.layouts.app')

@section('title', 'Gelombang Pendaftaran')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Gelombang Pendaftaran</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 fw-bold mb-0">Gelombang Pendaftaran</h1>
            <p class="text-muted small mb-0">Periode berjalan & arsip. Status <em>active</em> menandai pendaftaran dibuka di website.</p>
        </div>
        <a href="{{ route('admin.admission-schedules.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Gelombang</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-6">
                    <select name="tahun" class="form-select form-select-sm">
                        <option value="">Semua tahun akademik</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" @selected(request('tahun') === $y)>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua status</option>
                        @foreach(['active' => 'Aktif (dibuka)', 'upcoming' => 'Segera dibuka', 'archived' => 'Arsip'] as $val => $label)
                            <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-secondary btn-sm">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Tahun / Gelombang</th><th>Periode Pendaftaran</th><th>Pengumuman</th><th>Status</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td><span class="badge text-bg-primary">{{ $item->academic_year }}</span><div class="fw-semibold small mt-1">{{ $item->wave_name }}</div></td>
                            <td class="small">{{ $item->period_label ?? (\App\Support\Tanggal::indo($item->start_date) . ' – ' . \App\Support\Tanggal::indo($item->end_date)) }}</td>
                            <td class="small">{{ \App\Support\Tanggal::indo($item->announcement_date) ?? '—' }}</td>
                            <td>
                                <span class="badge {{ $item->status === 'active' ? 'text-bg-success' : ($item->status === 'upcoming' ? 'text-bg-warning' : 'text-bg-secondary') }}">{{ $item->status }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.admission-schedules.edit', $item) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.admission-schedules.destroy', $item) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada gelombang pendaftaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
