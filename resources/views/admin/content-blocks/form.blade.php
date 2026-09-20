@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Blok Konten')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.content-blocks.index', ['group' => $item->group]) }}">Blok Konten</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Blok Konten' : 'Tambah Blok Konten' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.content-blocks.update', $item) : route('admin.content-blocks.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="group">Grup</label>
                        <select name="group" id="group" class="form-select" required>
                            @foreach(\App\Models\ContentBlock::GROUPS as $key => $label)
                                <option value="{{ $key }}" @selected(old('group', $item->group) === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="sort_order">Urutan tampil</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="published" @selected(old('status', $item->status ?? 'published') === 'published')>Terbit (tampil)</option>
                            <option value="draft" @selected(old('status', $item->status) === 'draft')>Draft</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="title">Judul / teks baris</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item->title) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $item->description) }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="icon">Ikon (Font Awesome, khusus grup karier)</label>
                        <input type="text" name="icon" id="icon" class="form-control" value="{{ old('icon', $item->icon) }}" placeholder="fa-certificate" maxlength="100">
                    </div>
                    <div class="col-md-6 mb-0">
                        <label class="form-label fw-semibold" for="link_url">Tautan (opsional)</label>
                        <input type="url" name="link_url" id="link_url" class="form-control" value="{{ old('link_url', $item->link_url) }}" placeholder="https://...">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.content-blocks.index', ['group' => $item->group]) }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
