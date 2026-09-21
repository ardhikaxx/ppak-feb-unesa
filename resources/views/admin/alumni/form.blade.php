@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Alumni')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.alumni.index') }}">Alumni</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Data Alumni' : 'Tambah Data Alumni' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.alumni.update', $item) : route('admin.alumni.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning small"><i class="fa-solid fa-triangle-exclamation me-1"></i>Gunakan data resmi. Jangan membuat nama, jabatan, atau perusahaan fiktif.</div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="full_name">Nama lengkap</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name', $item->full_name) }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold" for="graduation_year">Tahun lulus</label>
                        <input type="text" name="graduation_year" id="graduation_year" class="form-control" value="{{ old('graduation_year', $item->graduation_year) }}" maxlength="10">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach(config('ppak.options.research_status') as $val => $label)
                                <option value="{{ $val }}" @selected(old('status', $item->status ?? 'draft') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="current_company">Instansi / perusahaan</label>
                        <input type="text" name="current_company" id="current_company" class="form-control" value="{{ old('current_company', $item->current_company) }}">
                    </div>
                    <div class="col-md-6 mb-0">
                        <label class="form-label fw-semibold" for="current_position">Jabatan</label>
                        <input type="text" name="current_position" id="current_position" class="form-control" value="{{ old('current_position', $item->current_position) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
