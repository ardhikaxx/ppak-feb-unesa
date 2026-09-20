@extends('admin.layouts.app')

@section('title', ($course->exists ? 'Ubah' : 'Tambah') . ' Mata Kuliah')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.curricula.index') }}">Kurikulum</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $course->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $course->exists ? 'Ubah Mata Kuliah' : 'Tambah Mata Kuliah' }}</h1>

    <form method="POST" action="{{ $course->exists ? route('admin.curricula.update', $course) : route('admin.curricula.store') }}">
        @csrf
        @if($course->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold required" for="course_code">Kode MK</label>
                        <input type="text" name="course_code" id="course_code" class="form-control" value="{{ old('course_code', $course->course_code) }}" required maxlength="30">
                    </div>
                    <div class="col-md-9 mb-3">
                        <label class="form-label fw-semibold required" for="name_id">Nama mata kuliah</label>
                        <input type="text" name="name_id" id="name_id" class="form-control" value="{{ old('name_id', $course->name_id) }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="name_en">Nama (Inggris)</label>
                    <input type="text" name="name_en" id="name_en" class="form-control" value="{{ old('name_en', $course->name_en) }}">
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold required" for="semester">Semester</label>
                        <input type="number" name="semester" id="semester" class="form-control" min="1" max="8" value="{{ old('semester', $course->semester ?? 1) }}" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold required" for="credits">SKS</label>
                        <input type="number" name="credits" id="credits" class="form-control" min="0" max="12" value="{{ old('credits', $course->credits ?? 3) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="course_type">Jenis</label>
                        <select name="course_type" id="course_type" class="form-select" required>
                            @foreach(['Wajib' => 'Wajib', 'Pilihan' => 'Pilihan', 'Paket Magang' => 'Paket Magang'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('course_type', $course->course_type ?? 'Wajib') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold" for="sort_order">Urutan</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', $course->sort_order ?? 0) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold" for="curriculum_year">Tahun kurikulum</label>
                        <input type="text" name="curriculum_year" id="curriculum_year" class="form-control" value="{{ old('curriculum_year', $course->curriculum_year ?? '2025/2026') }}" maxlength="20">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $course->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pemetaan CPL</label>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach($cpls as $cpl)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="cpl_mapping[]" value="{{ $cpl->code }}" id="cpl_{{ $cpl->code }}"
                                       @checked(in_array($cpl->code, old('cpl_mapping', $course->cpl_mapping ?? [])))>
                                <label class="form-check-label small" for="cpl_{{ $cpl->code }}">{{ $cpl->code }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold" for="instructors">Pengampu (pisahkan koma/baris baru)</label>
                    <textarea name="instructors" id="instructors" rows="2" class="form-control">{{ old('instructors', is_array($course->instructors) ? implode(', ', $course->instructors) : $course->instructors) }}</textarea>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.curricula.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
