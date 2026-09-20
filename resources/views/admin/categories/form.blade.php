@extends('admin.layouts.app')

@section('title', ($category->exists ? 'Ubah' : 'Tambah') . ' Kategori')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Kategori</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $category->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $category->exists ? 'Ubah Kategori' : 'Tambah Kategori' }}</h1>

    <form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
        @csrf
        @if($category->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="name">Nama kategori</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="slug">Slug (unik)</label>
                        <input type="text" name="slug" id="slug" data-slug-from="#name" class="form-control" value="{{ old('slug', $category->slug) }}" required pattern="[a-z0-9\-]+">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="type">Tipe</label>
                        <select name="type" id="type" class="form-select" required>
                            @foreach(['news' => 'Berita', 'agenda' => 'Agenda', 'document' => 'Dokumen', 'gallery' => 'Galeri'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('type', $category->type ?? 'news') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="color">Warna (badge)</label>
                        <input type="text" name="color" id="color" class="form-control" value="{{ old('color', $category->color) }}" placeholder="#0d6efd" maxlength="20">
                    </div>
                    <div class="col-md-4 mb-0">
                        <label class="form-label fw-semibold" for="sort_order">Urutan</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
