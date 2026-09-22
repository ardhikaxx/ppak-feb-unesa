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
                    <tr><th>Waktu</th><th>Admin</th><th>Aksi</th><th>Entitas</th><th>IP</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        @php
                            $oldValues = collect($log->old_values ?? [])->filter(fn($v, $k) => !str_starts_with($k, '_'));
                            $newValues = collect($log->new_values ?? [])->filter(fn($v, $k) => !str_starts_with($k, '_'));
                            $hasDiff = $oldValues->isNotEmpty() || $newValues->isNotEmpty();
                        @endphp
                        <tr>
                            <td>{{ \App\Support\Tanggal::datetime($log->created_at) }}</td>
                            <td>{{ $log->new_values['_admin']['name'] ?? ($log->old_values['_admin']['name'] ?? 'sistem') }}</td>
                            <td><span class="badge text-bg-light border">{{ $log->action }}</span></td>
                            <td>{{ class_basename($log->auditable_type ?? '—') }} #{{ $log->auditable_id ?? '—' }}</td>
                            <td>{{ $log->ip_address ?? '—' }}</td>
                            <td>
                                @if($hasDiff)
                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#diffModal{{ $log->id }}" title="Lihat Perubahan">
                                        <i class="fa-solid fa-code-compare"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada aktivitas tercatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="card-footer">{{ $logs->links() }}</div>
        @endif
    </div>

    {{-- Diff Modals --}}
    @foreach($logs as $log)
        @php
            $oldValues = collect($log->old_values ?? [])->filter(fn($v, $k) => !str_starts_with($k, '_'));
            $newValues = collect($log->new_values ?? [])->filter(fn($v, $k) => !str_starts_with($k, '_'));
            $hasDiff = $oldValues->isNotEmpty() || $newValues->isNotEmpty();
        @endphp
        @if($hasDiff)
        <div class="modal fade" id="diffModal{{ $log->id }}" tabindex="-1" aria-labelledby="diffModalLabel{{ $log->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title fw-bold" id="diffModalLabel{{ $log->id }}">
                            <i class="fa-solid fa-code-compare me-1"></i>
                            Perubahan — {{ class_basename($log->auditable_type ?? '') }} #{{ $log->auditable_id ?? '' }}
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="small text-muted mb-3">
                            {{ \App\Support\Tanggal::datetime($log->created_at) }} &middot;
                            {{ $log->action }} &middot;
                            {{ $log->new_values['_admin']['name'] ?? ($log->old_values['_admin']['name'] ?? 'sistem') }}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm small mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 25%;">Field</th>
                                        <th style="width: 37.5%;">Sebelum</th>
                                        <th style="width: 37.5%;">Sesudah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $allKeys = $oldValues->keys()->merge($newValues->keys())->unique()->sort();
                                    @endphp
                                    @forelse($allKeys as $key)
                                        @php
                                            $old = $oldValues->get($key, '—');
                                            $new = $newValues->get($key, '—');
                                            if (is_array($old)) $old = json_encode($old);
                                            if (is_array($new)) $new = json_encode($new);
                                            $changed = $old !== $new;
                                        @endphp
                                        <tr class="{{ $changed ? 'table-warning' : '' }}">
                                            <td class="fw-semibold">{{ $key }}</td>
                                            <td>
                                                @if($changed && $oldValues->has($key))
                                                    <span class="text-danger text-decoration-line-through">{{ Str::limit((string) $old, 120) }}</span>
                                                @else
                                                    {{ Str::limit((string) $old, 120) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($changed && $newValues->has($key))
                                                    <span class="text-success fw-semibold">{{ Str::limit((string) $new, 120) }}</span>
                                                @else
                                                    {{ Str::limit((string) $new, 120) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="text-center text-muted">Tidak ada perubahan field.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
@endsection
