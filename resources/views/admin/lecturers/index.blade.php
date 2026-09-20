@extends('admin.layouts.app')

@section('title', 'Kelola Dosen')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dosen</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Dosen / Pengajar</h1>
        <a href="{{ route('admin.lecturers.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Dosen</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari nama / bidang...">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua status</option>
                        <option value="active" @selected(request('status') === 'active')>Aktif</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">Semua bidang</option>
                        @foreach(['auditing' => 'Auditing', 'keuangan' => 'Keuangan', 'perpajakan' => 'Perpajakan', 'manajemen' => 'Manajemen'] as $val => $label)
                            <option value="{{ $val }}" @selected(request('kategori') === $val)>{{ $label }}</option>
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
                        <th style="width:56px;">Foto</th>
                        <th>Nama</th>
                        <th>Bidang</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th style="width:190px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lecturers as $item)
                        <tr @if($item->trashed()) class="table-light" @endif>
                            <td><img src="{{ $item->image ?? '/images/default-img.png' }}" alt="" class="rounded" style="width:44px;height:44px;object-fit:cover;"></td>
                            <td>
                                <div class="fw-semibold">{{ $item->gelar ?? $item->name }}</div>
                                <div class="small text-muted">{{ $item->role ?? '—' }}</div>
                            </td>
                            <td><span class="badge text-bg-light border">{{ $item->category_label ?? $item->category }}</span></td>
                            <td class="small">{{ $item->sort_order }}</td>
                            <td>
                                <span class="badge {{ $item->status === 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status === 'active' ? 'Aktif' : 'Nonaktif' }}</span>
                                @if($item->trashed()) <span class="badge text-bg-danger">Arsip</span> @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($item->trashed())
                                        <form method="POST" action="{{ route('admin.lecturers.restore', $item->id) }}">
                                            @csrf
                                            <button class="btn btn-outline-success" title="Pulihkan"><i class="fa-solid fa-rotate-left"></i></button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.lecturers.show', $item) }}" class="btn btn-outline-secondary" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('admin.lecturers.edit', $item) }}" class="btn btn-outline-primary" title="Ubah"><i class="fa-solid fa-pen"></i></a>
                                        <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.lecturers.destroy', $item) }}" title="Arsipkan"><i class="fa-solid fa-trash"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data dosen.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($lecturers->hasPages())
            <div class="card-footer">{{ $lecturers->links() }}</div>
        @endif
    </div>
@endsection
