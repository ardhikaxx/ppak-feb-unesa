@extends('admin.layouts.app')

@section('title', 'Kurikulum')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Kurikulum</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Kurikulum & Mata Kuliah</h1>
        <a href="{{ route('admin.curricula.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah MK</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari kode / nama mata kuliah...">
                </div>
                <div class="col-md-4">
                    <select name="semester" class="form-select form-select-sm">
                        <option value="">Semua semester</option>
                        @foreach($semesters as $s)
                            <option value="{{ $s }}" @selected((string) request('semester') === (string) $s)>Semester {{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass me-1"></i>Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Kode</th><th>Mata Kuliah</th><th>Sem.</th><th>SKS</th><th>Jenis</th><th>Urutan</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($courses as $c)
                        <tr>
                            <td class="small fw-semibold">{{ $c->course_code }}</td>
                            <td class="fw-semibold">{{ $c->name_id }}</td>
                            <td>{{ $c->semester }}</td>
                            <td>{{ $c->credits }}</td>
                            <td><span class="badge text-bg-light border">{{ $c->course_type }}</span></td>
                            <td class="small">{{ $c->sort_order }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.curricula.edit', $c) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.curricula.destroy', $c) }}" data-message="Hapus mata kuliah {{ $c->name_id }}?"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada mata kuliah.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($courses->hasPages())
            <div class="card-footer">{{ $courses->links() }}</div>
        @endif
    </div>
@endsection
