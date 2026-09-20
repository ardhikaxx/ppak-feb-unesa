@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Publikasi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.publications.index') }}">Publikasi</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Publikasi' : 'Tambah Publikasi' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.publications.update', $item) : route('admin.publications.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="title">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item->title) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="authors">Penulis</label>
                    <input type="text" name="authors" id="authors" class="form-control" value="{{ old('authors', $item->authors) }}" required>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="publication_type">Jenis</label>
                        <input type="text" name="publication_type" id="publication_type" class="form-control" value="{{ old('publication_type', $item->publication_type) }}" maxlength="50">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="publish_date">Tanggal terbit</label>
                        <input type="date" name="publish_date" id="publish_date" class="form-control" value="{{ old('publish_date', $item->publish_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="year">Tahun</label>
                        <input type="text" name="year" id="year" class="form-control" value="{{ old('year', $item->year) }}" maxlength="10">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="journal_or_publisher">Jurnal / penerbit</label>
                    <input type="text" name="journal_or_publisher" id="journal_or_publisher" class="form-control" value="{{ old('journal_or_publisher', $item->journal_or_publisher) }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="doi_or_url">DOI / URL</label>
                        <input type="text" name="doi_or_url" id="doi_or_url" class="form-control" value="{{ old('doi_or_url', $item->doi_or_url) }}">
                    </div>
                    <div class="col-md-6 mb-0">
                        <label class="form-label fw-semibold" for="lecturer_name">Nama dosen terkait</label>
                        <input type="text" name="lecturer_name" id="lecturer_name" class="form-control" value="{{ old('lecturer_name', $item->lecturer_name) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.publications.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
