@extends('admin.layouts.app')

@section('title', 'Detail Dosen')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.lecturers.index') }}">Dosen</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Detail Dosen</h1>
        <a href="{{ route('admin.lecturers.edit', $lecturer) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen me-1"></i>Ubah</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-3">
                    <img src="{{ $lecturer->image ?? '/images/default-img.png' }}" alt="" class="img-fluid rounded">
                </div>
                <div class="col-md-9">
                    <h2 class="h5 fw-bold">{{ $lecturer->gelar ?? $lecturer->name }}</h2>
                    <p class="text-muted">{{ $lecturer->role ?? '—' }}</p>
                    <dl class="row small mb-0">
                        <dt class="col-sm-3">Kategori</dt><dd class="col-sm-9">{{ $lecturer->category_label ?? $lecturer->category }}</dd>
                        <dt class="col-sm-3">Bidang</dt><dd class="col-sm-9">{{ $lecturer->bidang ?? '—' }}</dd>
                        <dt class="col-sm-3">Mata kuliah</dt><dd class="col-sm-9">{{ $lecturer->matkul ? implode(', ', (array) $lecturer->matkul) : '—' }}</dd>
                        <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $lecturer->email ?? '—' }}</dd>
                        <dt class="col-sm-3">Sertifikasi</dt><dd class="col-sm-9">{{ $lecturer->sertifikasi ? implode(', ', (array) $lecturer->sertifikasi) : '—' }}</dd>
                        <dt class="col-sm-3">Status / Urutan</dt><dd class="col-sm-9">{{ $lecturer->status }} / {{ $lecturer->sort_order }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
