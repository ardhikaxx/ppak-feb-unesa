@extends('admin.layouts.app')

@section('title', ($accreditation->exists ? 'Ubah' : 'Tambah') . ' Akreditasi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.accreditations.index') }}">Akreditasi</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $accreditation->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $accreditation->exists ? 'Ubah Akreditasi' : 'Tambah Akreditasi' }}</h1>

    <form method="POST" action="{{ $accreditation->exists ? route('admin.accreditations.update', $accreditation) : route('admin.accreditations.store') }}" enctype="multipart/form-data">
        @csrf
        @if($accreditation->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="program_name">Nama program</label>
                        <input type="text" name="program_name" id="program_name" class="form-control" value="{{ old('program_name', $accreditation->program_name ?? 'Pendidikan Profesi Akuntan') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold required" for="agency">Lembaga</label>
                        <input type="text" name="agency" id="agency" class="form-control" value="{{ old('agency', $accreditation->agency ?? 'LAMEMBA') }}" required maxlength="100">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status</label>
                        <input type="text" name="status" id="status" class="form-control" value="{{ old('status', $accreditation->status ?? 'Baik') }}" required maxlength="50">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="decree_number">Nomor SK</label>
                        <input type="text" name="decree_number" id="decree_number" class="form-control" value="{{ old('decree_number', $accreditation->decree_number) }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold" for="decree_date">Tanggal SK</label>
                        <input type="date" name="decree_date" id="decree_date" class="form-control" value="{{ old('decree_date', $accreditation->decree_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold" for="effective_from">Berlaku dari</label>
                        <input type="date" name="effective_from" id="effective_from" class="form-control" value="{{ old('effective_from', $accreditation->effective_from?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold" for="effective_until">Berlaku sampai</label>
                        <input type="date" name="effective_until" id="effective_until" class="form-control" value="{{ old('effective_until', $accreditation->effective_until?->format('Y-m-d')) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="certificate_file">Salinan SK (PDF, maks 10 MB)</label>
                    <input type="file" name="certificate_file" id="certificate_file" class="form-control" accept=".pdf">
                    @if($accreditation->certificate_file)<div class="form-text">File saat ini: {{ $accreditation->certificate_file }}</div>@endif
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="source_name">Nama sumber</label>
                        <input type="text" name="source_name" id="source_name" class="form-control" value="{{ old('source_name', $accreditation->source_name) }}">
                    </div>
                    <div class="col-md-6 mb-0">
                        <label class="form-label fw-semibold" for="source_url">URL sumber</label>
                        <input type="url" name="source_url" id="source_url" class="form-control" value="{{ old('source_url', $accreditation->source_url) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.accreditations.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
