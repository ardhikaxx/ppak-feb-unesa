@extends('admin.layouts.app')

@section('title', ($article->exists ? 'Ubah' : 'Tambah') . ' Berita')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Berita</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $article->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $article->exists ? 'Ubah Berita' : 'Tambah Berita' }}</h1>

    <form method="POST" action="{{ $article->exists ? route('admin.news.update', $article) : route('admin.news.store') }}" enctype="multipart/form-data">
        @csrf
        @if($article->exists) @method('PUT') @endif

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold required">Judul</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $article->title) }}" required maxlength="255">
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label fw-semibold required">Slug (otomatis, unik)</label>
                            <input type="text" name="slug" id="slug" data-slug-from="#title" class="form-control @error('slug') is-invalid @enderror"
                                   value="{{ old('slug', $article->slug) }}" required pattern="[a-z0-9\-]+">
                            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="excerpt" class="form-label fw-semibold required">Excerpt (ringkasan)</label>
                            <textarea name="excerpt" id="excerpt" rows="3" maxlength="500" required
                                      class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $article->excerpt) }}</textarea>
                            @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-0">
                            <label for="content" class="form-label fw-semibold required">Isi berita</label>
                            <textarea name="content" id="content" rows="12" required
                                      class="form-control @error('content') is-invalid @enderror">{{ old('content', $article->content) }}</textarea>
                            <div class="form-text">HTML dasar diizinkan (p, strong, ul, a). Script otomatis dibersihkan saat tampil.</div>
                            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">Publikasi</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold required">Status</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                @foreach(['draft' => 'Draft (tidak tampil di publik)', 'published' => 'Terbit', 'scheduled' => 'Terjadwal', 'archived' => 'Arsip'] as $val => $label)
                                    <option value="{{ $val }}" @selected(old('status', $article->status ?? 'draft') === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-semibold">Kategori</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">— Tanpa kategori —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected((string) old('category_id', $article->category_id) === (string) $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="published_at" class="form-label fw-semibold">Tanggal publikasi</label>
                            <input type="datetime-local" name="published_at" id="published_at" class="form-control"
                                   value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}">
                        </div>
                        <div class="mb-3">
                            <label for="read_time" class="form-label fw-semibold">Estimasi baca</label>
                            <input type="text" name="read_time" id="read_time" class="form-control" maxlength="50"
                                   value="{{ old('read_time', $article->read_time) }}" placeholder="3 Menit Baca">
                        </div>
                        <div class="mb-0">
                            <label for="tags" class="form-label fw-semibold">Tag (pisahkan koma)</label>
                            <input type="text" name="tags" id="tags" class="form-control" maxlength="255"
                                   value="{{ old('tags', is_array($article->tags) ? implode(', ', $article->tags) : $article->tags) }}">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">Gambar utama</div>
                    <div class="card-body">
                        @if($article->image)
                            <img src="{{ $article->image }}" alt="" class="img-fluid rounded mb-2">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="remove_image">
                                <label class="form-check-label small" for="remove_image">Hapus gambar saat ini</label>
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                        <div class="form-text">JPG/PNG/WebP, maks 5 MB.</div>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-light border">Batal</a>
                </div>
            </div>
        </div>
    </form>
@endsection
