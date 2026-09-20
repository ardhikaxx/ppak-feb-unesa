@extends('admin.layouts.app')

@section('title', 'Detail Agenda')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.agendas.index') }}">Agenda</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Detail Agenda</h1>
        <a href="{{ route('admin.agendas.edit', $agenda) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen me-1"></i>Ubah</a>
    </div>

    <div class="card">
        <div class="card-body">
            <span class="badge {{ $agenda->is_upcoming ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $agenda->is_upcoming ? 'Mendatang' : 'Selesai' }}</span>
            <span class="badge text-bg-light border">{{ $agenda->category?->name ?? 'Tanpa kategori' }}</span>
            <h2 class="h5 fw-bold mt-2">{{ $agenda->title }}</h2>
            <dl class="row small mt-3 mb-0">
                <dt class="col-sm-3">Slug</dt><dd class="col-sm-9">/{{ $agenda->slug }}</dd>
                <dt class="col-sm-3">Tanggal</dt><dd class="col-sm-9">{{ \App\Support\Tanggal::indo($agenda->event_date) }} @if($agenda->event_end_date) s.d. {{ \App\Support\Tanggal::indo($agenda->event_end_date) }} @endif</dd>
                <dt class="col-sm-3">Waktu</dt><dd class="col-sm-9">{{ $agenda->time ?? '—' }}</dd>
                <dt class="col-sm-3">Lokasi</dt><dd class="col-sm-9">{{ $agenda->venue ?? '—' }}</dd>
                <dt class="col-sm-3">Pembicara</dt><dd class="col-sm-9">{{ $agenda->speaker ?? '—' }}</dd>
                <dt class="col-sm-3">Deskripsi</dt><dd class="col-sm-9">{{ $agenda->description ?? '—' }}</dd>
            </dl>
        </div>
    </div>
@endsection
