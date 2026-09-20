@extends('admin.layouts.app')

@section('title', 'Kelola Agenda')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Agenda</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Agenda, Seminar & Event</h1>
        <a href="{{ route('admin.agendas.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Agenda</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari judul / lokasi...">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua status</option>
                        @foreach(['upcoming' => 'Mendatang', 'ongoing' => 'Berlangsung', 'completed' => 'Selesai', 'cancelled' => 'Batal'] as $val => $label)
                            <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="tahun" class="form-select form-select-sm">
                        <option value="">Semua tahun</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" @selected((string) request('tahun') === (string) $y)>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-grid">
                    <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="trashed" value="1" id="trashed" @checked(request()->boolean('trashed')) onchange="this.form.submit()">
                        <label class="form-check-label small" for="trashed">Tampilkan arsip</label>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th style="width:190px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendas as $item)
                        <tr @if($item->trashed()) class="table-light" @endif>
                            <td>
                                <div class="fw-semibold">{{ $item->title }}</div>
                                <div class="small text-muted">/{{ $item->slug }}</div>
                            </td>
                            <td class="small">{{ \App\Support\Tanggal::indo($item->event_date) }}@if($item->event_end_date)<br><span class="text-muted">s.d. {{ \App\Support\Tanggal::indo($item->event_end_date) }}</span>@endif</td>
                            <td class="small">{{ $item->venue ?? '—' }}</td>
                            <td>
                                <span class="badge {{ $item->is_upcoming ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->is_upcoming ? 'Mendatang' : 'Selesai' }}</span>
                                @if($item->trashed()) <span class="badge text-bg-danger">Arsip</span> @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($item->trashed())
                                        <form method="POST" action="{{ route('admin.agendas.restore', $item->id) }}">
                                            @csrf
                                            <button class="btn btn-outline-success" title="Pulihkan"><i class="fa-solid fa-rotate-left"></i></button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.agendas.show', $item) }}" class="btn btn-outline-secondary" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('admin.agendas.edit', $item) }}" class="btn btn-outline-primary" title="Ubah"><i class="fa-solid fa-pen"></i></a>
                                        <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.agendas.destroy', $item) }}" title="Arsipkan"><i class="fa-solid fa-trash"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada agenda.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($agendas->hasPages())
            <div class="card-footer">{{ $agendas->links() }}</div>
        @endif
    </div>
@endsection
