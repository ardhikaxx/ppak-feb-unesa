@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Testimoni')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimoni</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Testimoni' : 'Tambah Testimoni' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.testimonials.update', $item) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning small"><i class="fa-solid fa-triangle-exclamation me-1"></i>Hanya cantumkan testimoni resmi yang terverifikasi dan disetujui alumni bersangkutan.</div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="role">Peran / angkatan</label>
                        <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $item->role) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="company">Instansi / perusahaan</label>
                        <input type="text" name="company" id="company" class="form-control" value="{{ old('company', $item->company) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold" for="year">Tahun</label>
                        <input type="text" name="year" id="year" class="form-control" value="{{ old('year', $item->year) }}" maxlength="10">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold" for="sort_order">Urutan</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach(['draft' => 'Draft', 'unpublished' => 'Tidak terbit', 'published' => 'Terbit'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('status', $item->status ?? 'draft') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="quote">Isi testimoni</label>
                    <textarea name="quote" id="quote" rows="4" class="form-control" required>{{ old('quote', $item->quote) }}</textarea>
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold" for="avatar">Foto (maks 2 MB)</label>
                    <input type="file" name="avatar" id="avatar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
