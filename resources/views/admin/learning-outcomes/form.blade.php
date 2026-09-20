@extends('admin.layouts.app')

@section('title', ($outcome->exists ? 'Ubah' : 'Tambah') . ' CPL')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.learning-outcomes.index') }}">CPL</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $outcome->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $outcome->exists ? 'Ubah CPL' : 'Tambah CPL' }}</h1>

    <form method="POST" action="{{ $outcome->exists ? route('admin.learning-outcomes.update', $outcome) : route('admin.learning-outcomes.store') }}">
        @csrf
        @if($outcome->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold required" for="code">Kode (unik)</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $outcome->code) }}" required maxlength="20" placeholder="CPL-1">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="title">Judul</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $outcome->title) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold" for="sort_order">Urutan tampil</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', $outcome->sort_order ?? 0) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="category">Kategori</label>
                    <input type="text" name="category" id="category" class="form-control" maxlength="50" value="{{ old('category', $outcome->category) }}" placeholder="Sikap & Nilai">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold required" for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $outcome->description) }}</textarea>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.learning-outcomes.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
