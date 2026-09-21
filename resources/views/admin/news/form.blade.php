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

                {{-- SEO & METADATA CARD (CMS DYNAMIC SEO) --}}
                <div class="card mb-3 border-primary">
                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                        <span class="fw-bold text-navy"><i class="fa-solid fa-magnifying-glass-chart me-1 text-primary"></i> Optimasi SEO & Metadata</span>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Google & Social Ready</span>
                    </div>
                    <div class="card-body">
                        {{-- SERP Google Preview --}}
                        <div class="p-3 rounded-3 bg-white border mb-4">
                            <div class="small fw-bold text-secondary mb-2"><i class="fa-brands fa-google text-primary me-1"></i> Preview Tampilan Google Search (SERP)</div>
                            <div class="p-3 bg-light rounded-2 border">
                                <div class="text-muted small text-truncate" id="serpPreviewUrl">{{ rtrim(config('app.url'), '/') }}/informasi/berita/<span id="serpSlugText">{{ $article->slug ?? 'judul-berita' }}</span></div>
                                <div class="fs-5 fw-semibold text-primary text-truncate my-1" id="serpPreviewTitle" style="color: #1a0dab !important; cursor: pointer;">
                                    {{ $article->seo_title ?: ($article->title ?: 'Judul Berita') }} | PPAk FEB UNESA
                                </div>
                                <div class="small text-secondary" id="serpPreviewDesc" style="line-height: 1.4;">
                                    {{ $article->seo_description ?: ($article->excerpt ?: 'Ringkasan isi berita yang akan tampil di hasil pencarian Google...') }}
                                </div>
                            </div>
                        </div>

                        {{-- Social Open Graph Preview --}}
                        <div class="p-3 rounded-3 bg-white border mb-4">
                            <div class="small fw-bold text-secondary mb-2"><i class="fa-solid fa-share-nodes text-primary me-1"></i> Preview Media Sosial (WhatsApp / Facebook / X)</div>
                            <div class="p-3 bg-light rounded-2 border" style="max-width: 480px;">
                                <div class="bg-secondary-subtle rounded d-flex align-items-center justify-content-center text-muted mb-2 overflow-hidden" style="height: 140px;">
                                    @if($article->image)
                                        <img src="{{ $article->image }}" alt="OG Preview" id="ogPreviewImg" class="w-100 h-100 object-fit-cover">
                                    @else
                                        <span id="ogPreviewImgPlaceholder"><i class="fa-solid fa-image fs-1 opacity-25"></i></span>
                                    @endif
                                </div>
                                <div class="text-uppercase text-muted" style="font-size: 0.7rem;">PPAK.FEB.UNESA.AC.ID</div>
                                <div class="fw-bold text-dark text-truncate small" id="ogPreviewTitle">{{ $article->og_title ?: ($article->seo_title ?: ($article->title ?: 'Judul Berita')) }}</div>
                                <div class="text-muted small text-truncate" id="ogPreviewDesc">{{ $article->og_description ?: ($article->seo_description ?: ($article->excerpt ?: 'Ringkasan berita...')) }}</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="seo_title" class="form-label fw-semibold">Custom SEO Title</label>
                                <span class="badge bg-secondary-subtle text-secondary small" id="seoTitleCount">0 / 60</span>
                            </div>
                            <input type="text" name="seo_title" id="seo_title" class="form-control" maxlength="255"
                                   value="{{ old('seo_title', $article->seo_title) }}"
                                   placeholder="Kosongkan jika ingin memakai judul berita">
                            <div class="form-text">Rekomendasi: 50–60 karakter. Suffix brand <code>| PPAk FEB UNESA</code> ditambahkan otomatis.</div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="seo_description" class="form-label fw-semibold">Custom Meta Description</label>
                                <span class="badge bg-secondary-subtle text-secondary small" id="seoDescCount">0 / 160</span>
                            </div>
                            <textarea name="seo_description" id="seo_description" rows="2" maxlength="500"
                                      class="form-control"
                                      placeholder="Kosongkan jika ingin memakai excerpt berita">{{ old('seo_description', $article->seo_description) }}</textarea>
                            <div class="form-text">Rekomendasi: 140–160 karakter untuk deskripsi cuplikan pencarian yang ideal.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="og_title" class="form-label fw-semibold">Custom OG Title (Opsional)</label>
                                <input type="text" name="og_title" id="og_title" class="form-control" maxlength="255"
                                       value="{{ old('og_title', $article->og_title) }}" placeholder="Override judul kartu medsos">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="canonical_url" class="form-label fw-semibold">Custom Canonical URL (Opsional)</label>
                                <input type="url" name="canonical_url" id="canonical_url" class="form-control" maxlength="500"
                                       value="{{ old('canonical_url', $article->canonical_url) }}" placeholder="https://...">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="og_description" class="form-label fw-semibold">Custom OG Description (Opsional)</label>
                            <textarea name="og_description" id="og_description" rows="2" maxlength="500" class="form-control"
                                      placeholder="Override deskripsi kartu medsos">{{ old('og_description', $article->og_description) }}</textarea>
                        </div>

                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" role="switch" name="robots_index" id="robots_index" value="1"
                                   @checked(old('robots_index', $article->robots_index ?? true))>
                            <label class="form-check-label fw-semibold" for="robots_index">
                                Izinkan Mesin Pencari Mengindeks Berita Ini (Robots Indexable)
                            </label>
                            <div class="form-text">Matikan jika berita bersifat internal atau tidak ingin muncul di Google.</div>
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
                                @foreach(config('ppak.options.news_status_verbose') as $val => $label)
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const excerptInput = document.getElementById('excerpt');
    const seoTitleInput = document.getElementById('seo_title');
    const seoDescInput = document.getElementById('seo_description');
    const ogTitleInput = document.getElementById('og_title');
    const ogDescInput = document.getElementById('og_description');

    const serpSlugText = document.getElementById('serpSlugText');
    const serpPreviewTitle = document.getElementById('serpPreviewTitle');
    const serpPreviewDesc = document.getElementById('serpPreviewDesc');
    const ogPreviewTitle = document.getElementById('ogPreviewTitle');
    const ogPreviewDesc = document.getElementById('ogPreviewDesc');
    const seoTitleCount = document.getElementById('seoTitleCount');
    const seoDescCount = document.getElementById('seoDescCount');

    function updatePreview() {
        const title = titleInput.value.trim();
        const slug = slugInput.value.trim();
        const excerpt = excerptInput.value.trim();
        const seoTitle = seoTitleInput.value.trim();
        const seoDesc = seoDescInput.value.trim();
        const ogTitle = ogTitleInput.value.trim();
        const ogDesc = ogDescInput.value.trim();

        // SERP
        serpSlugText.textContent = slug || 'judul-berita';
        serpPreviewTitle.textContent = (seoTitle || title || 'Judul Berita') + ' | PPAk FEB UNESA';
        serpPreviewDesc.textContent = seoDesc || excerpt || 'Ringkasan isi berita yang akan tampil di hasil pencarian Google...';

        // OG
        ogPreviewTitle.textContent = ogTitle || seoTitle || title || 'Judul Berita';
        ogPreviewDesc.textContent = ogDesc || seoDesc || excerpt || 'Ringkasan berita...';

        // Counters
        if (seoTitleCount) {
            seoTitleCount.textContent = (seoTitle.length) + ' / 60';
            seoTitleCount.className = seoTitle.length > 60 ? 'badge bg-warning text-dark small' : 'badge bg-secondary-subtle text-secondary small';
        }
        if (seoDescCount) {
            seoDescCount.textContent = (seoDesc.length) + ' / 160';
            seoDescCount.className = seoDesc.length > 160 ? 'badge bg-warning text-dark small' : 'badge bg-secondary-subtle text-secondary small';
        }
    }

    [titleInput, slugInput, excerptInput, seoTitleInput, seoDescInput, ogTitleInput, ogDescInput].forEach(el => {
        if (el) el.addEventListener('input', updatePreview);
    });

    updatePreview();
});
</script>
@endpush

