@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' PKM')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.community-services.index') }}">Pengabdian</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Kegiatan PKM' : 'Tambah Kegiatan PKM' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.community-services.update', $item) : route('admin.community-services.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="title">Judul kegiatan</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item->title) }}" required>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="leader_name">Ketua pelaksana</label>
                        <input type="text" name="leader_name" id="leader_name" class="form-control" value="{{ old('leader_name', $item->leader_name) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="location">Lokasi</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $item->location) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold" for="year">Tahun</label>
                        <input type="number" name="year" id="year" class="form-control" min="2000" max="2100" value="{{ old('year', $item->year) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach(config('ppak.options.research_status') as $val => $label)
                                <option value="{{ $val }}" @selected(old('status', $item->status ?? 'draft') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="target_audience">Sasaran / audiens</label>
                    <input type="text" name="target_audience" id="target_audience" class="form-control" value="{{ old('target_audience', $item->target_audience) }}">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold" for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $item->description) }}</textarea>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.community-services.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
