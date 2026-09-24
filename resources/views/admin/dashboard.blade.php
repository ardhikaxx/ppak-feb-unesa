@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">Dashboard CMS PPAk FEB UNESA</h1>
            <p class="text-muted mb-0 small">Ringkasan konten website dari database aktual. Login sebagai <strong>{{ auth('admin')->user()->name }}</strong>.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus me-1"></i>Tulis Berita
        </a>
    </div>

    <div class="row g-3 mb-4">
        @foreach($stats as $stat)
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                <a href="{{ $stat['url'] }}" class="text-decoration-none">
                    <div class="card stat-tile {{ $stat['class'] }} h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="fs-3 text-secondary"><i class="fa-solid {{ $stat['icon'] }}"></i></div>
                            <div>
                                <div class="fs-4 fw-bold text-dark">{{ $stat['value'] }}</div>
                                <div class="small text-muted">{{ $stat['label'] }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header"><i class="fa-solid fa-layer-group me-1"></i>Periode & Status</div>
                <div class="card-body small">
                    <div class="mb-3">
                        <div class="fw-semibold">Berita: {{ $newsPublished }} terbit / {{ $newsDraft }} draft / {{ $newsTotal }} total</div>
                        <div class="progress mt-1" style="height:8px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $newsTotal ? round($newsPublished / $newsTotal * 100) : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <span class="fw-semibold">Tahun akademik (kalender):</span>
                        {{ empty($periods['Tahun akademik kalender']) ? '—' : implode(', ', $periods['Tahun akademik kalender']) }}
                    </div>
                    <div class="mb-2">
                        <span class="fw-semibold">Gelombang admisi aktif:</span> {{ $periods['Gelombang admisi aktif'] }}
                    </div>
                    <div>
                        <span class="fw-semibold">Periode biaya:</span>
                        {{ empty($periods['Periode biaya']) ? '—' : implode(', ', $periods['Periode biaya']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header"><i class="fa-solid fa-pen-to-square me-1"></i>Konten Terakhir Diubah</div>
                <ul class="list-group list-group-flush small">
                    @forelse($lastUpdates as $u)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $u['entity'] }}</span>
                            <span class="text-muted">{{ $u['at'] ? \Carbon\Carbon::parse($u['at'])->diffForHumans() : '—' }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Belum ada data.</li>
                    @endforelse
                </ul>
                <div class="card-header border-top"><i class="fa-solid fa-newspaper me-1"></i>Berita Terbaru</div>
                <ul class="list-group list-group-flush small">
                    @forelse($recentNews as $n)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="text-truncate me-2">{{ $n->title }}</span>
                            <span class="badge {{ $n->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $n->status }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Belum ada berita.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header"><i class="fa-solid fa-clock-rotate-left me-1"></i>Aktivitas Perubahan Terakhir</div>
                <ul class="list-group list-group-flush small">
                    @forelse($recentLogs as $log)
                        <li class="list-group-item">
                            <span class="badge text-bg-light border">{{ $log->action }}</span>
                            <span class="text-muted">{{ class_basename($log->auditable_type ?? '—') }} #{{ $log->auditable_id ?? '—' }}</span>
                            <div class="text-muted">{{ $log->created_at->diffForHumans() }} &bull; {{ $log->new_values['_admin']['name'] ?? 'sistem' }}</div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Belum ada aktivitas tercatat.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header"><i class="fa-solid fa-bolt me-1"></i>Akses Cepat</div>
        <div class="card-body d-flex flex-wrap gap-2">
            @if(auth('admin')->user()->isSuperAdmin())
                <a href="{{ route('admin.program-profile.edit') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-building-columns me-1"></i>Profil Program</a>
                <a href="{{ route('admin.site-settings.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-gear me-1"></i>Pengaturan Website</a>
            @endif
            <a href="{{ route('admin.lecturers.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Dosen</a>
            <a href="{{ route('admin.agendas.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Agenda</a>
            <a href="{{ route('admin.documents.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-upload me-1"></i>Upload Dokumen</a>
            <a href="{{ route('admin.galleries.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image me-1"></i>Tambah Galeri</a>
        </div>
    </div>
@endsection
