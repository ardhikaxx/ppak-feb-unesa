@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Biaya')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.tuition-fees.index') }}">Biaya Pendidikan</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Biaya' : 'Tambah Periode Biaya' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.tuition-fees.update', $item) : route('admin.tuition-fees.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="program_name">Nama program</label>
                        <input type="text" name="program_name" id="program_name" class="form-control" value="{{ old('program_name', $item->program_name ?? 'Pendidikan Profesi Akuntan') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="fee_type">Jenis biaya</label>
                        <input type="text" name="fee_type" id="fee_type" class="form-control" value="{{ old('fee_type', $item->fee_type ?? 'UKT') }}" required maxlength="50">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="amount">Nominal (Rp)</label>
                        <input type="number" name="amount" id="amount" class="form-control" min="0" value="{{ old('amount', $item->amount) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="period">Periode berlaku</label>
                        <input type="text" name="period" id="period" class="form-control" value="{{ old('period', $item->period ?? 'Per Semester') }}" maxlength="30">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="academic_year">Tahun akademik</label>
                        <input type="text" name="academic_year" id="academic_year" class="form-control" value="{{ old('academic_year', $item->academic_year ?? '2026/2027') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="description">Deskripsi / catatan</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $item->description) }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="source_name">Nama sumber</label>
                        <input type="text" name="source_name" id="source_name" class="form-control" value="{{ old('source_name', $item->source_name) }}">
                    </div>
                    <div class="col-md-6 mb-0">
                        <label class="form-label fw-semibold" for="source_url">URL sumber</label>
                        <input type="url" name="source_url" id="source_url" class="form-control" value="{{ old('source_url', $item->source_url) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.tuition-fees.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
