@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Kalender')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.academic-calendars.index') }}">Kalender Akademik</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Kegiatan' : 'Tambah Kegiatan' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.academic-calendars.update', $item) : route('admin.academic-calendars.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold required" for="academic_year">Tahun akademik</label>
                        <input type="text" name="academic_year" id="academic_year" class="form-control" value="{{ old('academic_year', $item->academic_year ?? $latestYear) }}" required placeholder="2026/2027">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold required" for="semester">Semester</label>
                        <select name="semester" id="semester" class="form-select" required>
                            @foreach(['Gasal', 'Genap'] as $s)
                                <option value="{{ $s }}" @selected(old('semester', $item->semester ?? 'Gasal') === $s)>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold" for="category">Kategori</label>
                        <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $item->category ?? 'Akademik') }}" maxlength="50">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold" for="sort_order">Urutan</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="activity">Nama kegiatan</label>
                    <input type="text" name="activity" id="activity" class="form-control" value="{{ old('activity', $item->activity) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="period_label">Label periode semester (cth: 1 Agustus 2026 – 31 Januari 2027)</label>
                    <input type="text" name="period_label" id="period_label" class="form-control" value="{{ old('period_label', $item->period_label) }}" maxlength="100">
                    <div class="form-text">Ditampilkan sebagai periode Gasal/Genap di website. Kosongkan untuk hitung otomatis dari tanggal.</div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="start_date">Tanggal mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $item->start_date?->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="end_date">Tanggal selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $item->end_date?->format('Y-m-d')) }}">
                    </div>
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold" for="decree_info">Info SK penetapan</label>
                    <input type="text" name="decree_info" id="decree_info" class="form-control" value="{{ old('decree_info', $item->decree_info) }}" placeholder="Surat Nomor B/2322/UN38.I/TU.00.02/2026">
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.academic-calendars.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
