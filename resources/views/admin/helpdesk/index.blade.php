@extends('admin.layouts.app')

@section('title', 'Helpdesk')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Helpdesk</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">Pesan Helpdesk Masuk</h1>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-7">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari nama / subjek / email...">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua status</option>
                        @foreach(['open' => 'Terbuka', 'in_progress' => 'Diproses', 'closed' => 'Selesai'] as $val => $label)
                            <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
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
                    <tr><th>Pengirim</th><th>Subjek</th><th>Masuk</th><th>Status</th><th style="width:80px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $item->name }}</div>
                                <div class="small text-muted">{{ $item->email }}</div>
                            </td>
                            <td class="small">{{ $item->subject }}</td>
                            <td class="small">{{ \App\Support\Tanggal::datetime($item->created_at) }}</td>
                            <td>
                                <span class="badge {{ $item->status === 'open' ? 'text-bg-danger' : ($item->status === 'in_progress' ? 'text-bg-warning' : 'text-bg-success') }}">{{ $item->status }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.helpdesk.show', $item) }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Tidak ada pesan helpdesk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="card-footer">{{ $items->links() }}</div>
        @endif
    </div>
@endsection
