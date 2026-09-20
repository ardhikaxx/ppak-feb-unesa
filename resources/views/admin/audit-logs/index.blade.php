@extends('admin.layouts.app')

@section('title', 'Audit Log')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Audit Log</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-1">Audit Log Perubahan Konten</h1>
    <p class="text-muted small mb-3">Mencatat admin pelaksana, aksi, entitas, dan waktu. Password tidak pernah disimpan di sini.</p>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-7">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari entitas / IP...">
                </div>
                <div class="col-md-3">
                    <select name="action" class="form-select form-select-sm">
                        <option value="">Semua aksi</option>
                        @foreach($actions as $a)
                            <option value="{{ $a }}" @selected(request('action') === $a)>{{ $a }}</option>
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
            <table class="table table-hover align-middle mb-0 small">
                <thead>
                    <tr><th>Waktu</th><th>Admin</th><th>Aksi</th><th>Entitas</th><th>IP</th></tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $log->new_values['_admin']['name'] ?? ($log->old_values['_admin']['name'] ?? 'sistem') }}</td>
                            <td><span class="badge text-bg-light border">{{ $log->action }}</span></td>
                            <td>{{ class_basename($log->auditable_type ?? '—') }} #{{ $log->auditable_id ?? '—' }}</td>
                            <td>{{ $log->ip_address ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada aktivitas tercatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="card-footer">{{ $logs->links() }}</div>
        @endif
    </div>
@endsection
