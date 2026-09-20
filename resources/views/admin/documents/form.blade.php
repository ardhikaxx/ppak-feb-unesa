@extends('admin.layouts.app')

@section('title', ($document->exists ? 'Ubah' : 'Upload') . ' Dokumen')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.documents.index') }}">Dokumen</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $document->exists ? 'Ubah' : 'Upload' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $document->exists ? 'Ubah Dokumen' : 'Upload Dokumen Baru' }}</h1>

    <form method="POST" action="{{ $document->exists ? route('admin.documents.update', $document) : route('admin.documents.store') }}" enctype="multipart/form-data">
        @csrf
        @if($document->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="title">Nama dokumen</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $document->title) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="slug">Slug (unik)</label>
                    <input type="text" name="slug" id="slug" data-slug-from="#title" class="form-control" value="{{ old('slug', $document->slug) }}" required pattern="[a-z0-9\-]+">
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">— Tanpa kategori —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected((string) old('category_id', $document->category_id) === (string) $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="year">Tahun</label>
                        <input type="number" name="year" id="year" class="form-control" min="2000" max="2100" value="{{ old('year', $document->year ?? date('Y')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach(['draft' => 'Draft', 'published' => 'Terbit', 'archived' => 'Arsip'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('status', $document->status ?? 'published') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold {{ $document->exists ? '' : 'required' }}" for="file">File (PDF/DOC/XLS/PPT/ZIP, maks 10 MB)</label>
                    @if($document->exists)
                        <div class="form-text mb-2">File saat ini: <strong>{{ $document->filename }}</strong>. Upload file baru untuk mengganti (file lama tetap tersimpan sebagai arsip).</div>
                    @endif
                    <input type="file" name="file" id="file" class="form-control" @if(!$document->exists) required @endif>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="source_name">Nama sumber / instansi</label>
                        <input type="text" name="source_name" id="source_name" class="form-control" value="{{ old('source_name', $document->source_name) }}">
                    </div>
                    <div class="col-md-6 mb-0">
                        <label class="form-label fw-semibold" for="source_url">URL sumber</label>
                        <input type="url" name="source_url" id="source_url" class="form-control" value="{{ old('source_url', $document->source_url) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.documents.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
