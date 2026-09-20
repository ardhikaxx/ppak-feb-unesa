@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Gelombang')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.admission-schedules.index') }}">Gelombang Pendaftaran</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Gelombang' : 'Tambah Gelombang' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.admission-schedules.update', $item) : route('admin.admission-schedules.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="academic_year">Tahun akademik</label>
                        <input type="text" name="academic_year" id="academic_year" class="form-control" value="{{ old('academic_year', $item->academic_year ?? '2026/2027') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="wave_name">Nama gelombang</label>
                        <input type="text" name="wave_name" id="wave_name" class="form-control" value="{{ old('wave_name', $item->wave_name) }}" required placeholder="Gelombang 1">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status periode</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach(['active' => 'Aktif — sedang dibuka', 'upcoming' => 'Segera dibuka', 'archived' => 'Arsip'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('status', $item->status ?? 'archived') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="period_label">Label periode (tampil di website)</label>
                    <input type="text" name="period_label" id="period_label" class="form-control" value="{{ old('period_label', $item->period_label) }}" placeholder="10 Februari – 30 April 2026">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="start_date">Pendaftaran mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $item->start_date?->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="end_date">Pendaftaran selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $item->end_date?->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="exam_date">Tanggal seleksi</label>
                        <input type="date" name="exam_date" id="exam_date" class="form-control" value="{{ old('exam_date', $item->exam_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="announcement_date">Tanggal pengumuman</label>
                        <input type="date" name="announcement_date" id="announcement_date" class="form-control" value="{{ old('announcement_date', $item->announcement_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-0">
                        <label class="form-label fw-semibold" for="registration_deadline">Batas daftar ulang</label>
                        <input type="date" name="registration_deadline" id="registration_deadline" class="form-control" value="{{ old('registration_deadline', $item->registration_deadline?->format('Y-m-d')) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.admission-schedules.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
