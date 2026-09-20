@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Galeri')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.galleries.index') }}">Galeri</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Foto' : 'Tambah Foto' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.galleries.update', $item) : route('admin.galleries.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="title">Judul / caption</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item->title) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="slug">Slug (unik)</label>
                    <input type="text" name="slug" id="slug" data-slug-from="#title" class="form-control" value="{{ old('slug', $item->slug) }}" required pattern="[a-z0-9\-]+">
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">— Tanpa kategori —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected((string) old('category_id', $item->category_id) === (string) $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold" for="event_date">Tanggal</label>
                        <input type="date" name="event_date" id="event_date" class="form-control" value="{{ old('event_date', $item->event_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach(['draft' => 'Draft', 'published' => 'Terbit', 'archived' => 'Arsip'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('status', $item->status ?? 'published') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold {{ $item->exists ? '' : 'required' }}" for="image">Foto (JPG/PNG/WebP, maks 5 MB)</label>
                    @if($item->image)
                        <div class="mb-2"><img src="{{ $item->image }}" alt="" class="img-fluid rounded" style="max-height:220px;"></div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png,.webp" @if(!$item->exists) required @endif>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
