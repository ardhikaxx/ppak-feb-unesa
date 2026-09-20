@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Mitra')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.partnerships.index') }}">Kerja Sama</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Mitra' : 'Tambah Mitra' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.partnerships.update', $item) : route('admin.partnerships.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="partner_name">Nama mitra</label>
                    <input type="text" name="partner_name" id="partner_name" class="form-control" value="{{ old('partner_name', $item->partner_name) }}" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="partner_category">Kategori</label>
                        <input type="text" name="partner_category" id="partner_category" class="form-control" value="{{ old('partner_category', $item->partner_category) }}" placeholder="KAP / Korporasi / Asosiasi Profesi">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="collaboration_type">Jenis kerja sama</label>
                        <input type="text" name="collaboration_type" id="collaboration_type" class="form-control" value="{{ old('collaboration_type', $item->collaboration_type) }}" placeholder="MoU / MoA / Magang">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="valid_from">Berlaku dari</label>
                        <input type="date" name="valid_from" id="valid_from" class="form-control" value="{{ old('valid_from', $item->valid_from?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="valid_until">Berlaku sampai</label>
                        <input type="date" name="valid_until" id="valid_until" class="form-control" value="{{ old('valid_until', $item->valid_until?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach(['draft' => 'Draft', 'unpublished' => 'Tidak tampil', 'active' => 'Aktif (tampil)', 'archived' => 'Arsip'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('status', $item->status ?? 'draft') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold" for="logo">Logo (maks 2 MB)</label>
                    <input type="file" name="logo" id="logo" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                    @if($item->logo)<div class="form-text">Logo saat ini: {{ $item->logo }}</div>@endif
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.partnerships.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
