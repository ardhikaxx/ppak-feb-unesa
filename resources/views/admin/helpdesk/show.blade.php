@extends('admin.layouts.app')

@section('title', 'Detail Helpdesk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.helpdesk.index') }}">Helpdesk</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">Detail Pesan</h1>

    <div class="card mb-3">
        <div class="card-body">
            <span class="badge {{ $inquiry->status === 'open' ? 'text-bg-danger' : ($inquiry->status === 'in_progress' ? 'text-bg-warning' : 'text-bg-success') }}">{{ $inquiry->status }}</span>
            <h2 class="h5 fw-bold mt-2">{{ $inquiry->subject }}</h2>
            <dl class="row small mt-3 mb-0">
                <dt class="col-sm-3">Nama</dt><dd class="col-sm-9">{{ $inquiry->name }}</dd>
                <dt class="col-sm-3">Email / Telepon</dt><dd class="col-sm-9">{{ $inquiry->email }} / {{ $inquiry->phone ?? '—' }}</dd>
                <dt class="col-sm-3">Kategori</dt><dd class="col-sm-9">{{ $inquiry->category ?? '—' }}</dd>
                <dt class="col-sm-3">Masuk</dt><dd class="col-sm-9">{{ \App\Support\Tanggal::datetime($inquiry->created_at) }} (IP: {{ $inquiry->ip_address ?? '—' }})</dd>
                <dt class="col-sm-3">Isi pesan</dt><dd class="col-sm-9">{{ $inquiry->message }}</dd>
            </dl>
        </div>
        <div class="card-footer">
            <form method="POST" action="{{ route('admin.helpdesk.update', $inquiry) }}" class="row g-2 align-items-end">
                @csrf
                @method('PATCH')
                <div class="col-md-4">
                    <label class="form-label fw-semibold small" for="status">Ubah status</label>
                    <select name="status" id="status" class="form-select form-select-sm">
                        @foreach(['open' => 'Terbuka', 'in_progress' => 'Diproses', 'closed' => 'Selesai'] as $val => $label)
                            <option value="{{ $val }}" @selected($inquiry->status === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
