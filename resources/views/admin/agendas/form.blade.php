@extends('admin.layouts.app')

@section('title', ($agenda->exists ? 'Ubah' : 'Tambah') . ' Agenda')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.agendas.index') }}">Agenda</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $agenda->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $agenda->exists ? 'Ubah Agenda' : 'Tambah Agenda' }}</h1>

    <form method="POST" action="{{ $agenda->exists ? route('admin.agendas.update', $agenda) : route('admin.agendas.store') }}">
        @csrf
        @if($agenda->exists) @method('PUT') @endif

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold required">Nama kegiatan</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $agenda->title) }}" required maxlength="255">
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label fw-semibold required">Slug (unik)</label>
                            <input type="text" name="slug" id="slug" data-slug-from="#title" class="form-control @error('slug') is-invalid @enderror"
                                   value="{{ old('slug', $agenda->slug) }}" required pattern="[a-z0-9\-]+">
                            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="event_date" class="form-label fw-semibold required">Tanggal mulai</label>
                                <input type="date" name="event_date" id="event_date" class="form-control @error('event_date') is-invalid @enderror"
                                       value="{{ old('event_date', $agenda->event_date?->format('Y-m-d')) }}" required>
                                @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="event_end_date" class="form-label fw-semibold">Tanggal selesai</label>
                                <input type="date" name="event_end_date" id="event_end_date" class="form-control @error('event_end_date') is-invalid @enderror"
                                       value="{{ old('event_end_date', $agenda->event_end_date?->format('Y-m-d')) }}">
                                @error('event_end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label fw-semibold">Waktu</label>
                                <input type="text" name="time" id="time" class="form-control" maxlength="100"
                                       value="{{ old('time', $agenda->time) }}" placeholder="08.00 - Selesai WIB">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="venue" class="form-label fw-semibold">Lokasi</label>
                                <input type="text" name="venue" id="venue" class="form-control" maxlength="255"
                                       value="{{ old('venue', $agenda->venue) }}" placeholder="Gedung G6 FEB Kampus Ketintang">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="speaker" class="form-label fw-semibold">Pembicara / narasumber</label>
                            <input type="text" name="speaker" id="speaker" class="form-control" maxlength="255" value="{{ old('speaker', $agenda->speaker) }}">
                        </div>
                        <div class="mb-0">
                            <label for="description" class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', $agenda->description) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- SEO & METADATA CARD (CMS DYNAMIC SEO) --}}
                <div class="card mt-3 mb-3 border-primary">
                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                        <span class="fw-bold text-navy"><i class="fa-solid fa-magnifying-glass-chart me-1 text-primary"></i> Optimasi SEO & Metadata</span>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Event SEO</span>
                    </div>
                    <div class="card-body">
                        {{-- SERP Google Preview --}}
                        <div class="p-3 rounded-3 bg-white border mb-4">
                            <div class="small fw-bold text-secondary mb-2"><i class="fa-brands fa-google text-primary me-1"></i> Preview Google Search (SERP)</div>
                            <div class="p-3 bg-light rounded-2 border">
                                <div class="text-muted small text-truncate">{{ rtrim(config('app.url'), '/') }}/informasi/agenda</div>
                                <div class="fs-5 fw-semibold text-primary text-truncate my-1" id="serpPreviewTitle" style="color: #1a0dab !important;">
                                    {{ $agenda->seo_title ?: ($agenda->title ?: 'Nama Kegiatan') }} | PPAk FEB UNESA
                                </div>
                                <div class="small text-secondary" id="serpPreviewDesc" style="line-height: 1.4;">
                                    {{ $agenda->seo_description ?: ($agenda->description ?: 'Deskripsi kegiatan seminar / workshop akademik...') }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="seo_title" class="form-label fw-semibold">Custom SEO Title</label>
                                <span class="badge bg-secondary-subtle text-secondary small" id="seoTitleCount">0 / 60</span>
                            </div>
                            <input type="text" name="seo_title" id="seo_title" class="form-control" maxlength="255"
                                   value="{{ old('seo_title', $agenda->seo_title) }}"
                                   placeholder="Kosongkan jika ingin memakai nama kegiatan">
                            <div class="form-text">Rekomendasi: 50–60 karakter. Suffix brand <code>| PPAk FEB UNESA</code> ditambahkan otomatis.</div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="seo_description" class="form-label fw-semibold">Custom Meta Description</label>
                                <span class="badge bg-secondary-subtle text-secondary small" id="seoDescCount">0 / 160</span>
                            </div>
                            <textarea name="seo_description" id="seo_description" rows="2" maxlength="500"
                                      class="form-control"
                                      placeholder="Kosongkan jika ingin memakai deskripsi acara">{{ old('seo_description', $agenda->seo_description) }}</textarea>
                            <div class="form-text">Rekomendasi: 140–160 karakter untuk deskripsi cuplikan pencarian.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="og_title" class="form-label fw-semibold">Custom OG Title (Opsional)</label>
                                <input type="text" name="og_title" id="og_title" class="form-control" maxlength="255"
                                       value="{{ old('og_title', $agenda->og_title) }}" placeholder="Override judul media sosial">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="canonical_url" class="form-label fw-semibold">Custom Canonical URL (Opsional)</label>
                                <input type="url" name="canonical_url" id="canonical_url" class="form-control" maxlength="500"
                                       value="{{ old('canonical_url', $agenda->canonical_url) }}" placeholder="https://...">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="og_description" class="form-label fw-semibold">Custom OG Description (Opsional)</label>
                            <textarea name="og_description" id="og_description" rows="2" maxlength="500" class="form-control"
                                      placeholder="Override deskripsi media sosial">{{ old('og_description', $agenda->og_description) }}</textarea>
                        </div>

                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" role="switch" name="robots_index" id="robots_index" value="1"
                                   @checked(old('robots_index', $agenda->robots_index ?? true))>
                            <label class="form-check-label fw-semibold" for="robots_index">
                                Izinkan Mesin Pencari Mengindeks Event Ini (Robots Indexable)
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">Status & Kategori</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold required">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                @foreach(config('ppak.options.agenda_status') as $val => $label)
                                    <option value="{{ $val }}" @selected(old('status', $agenda->status ?? 'upcoming') === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_upcoming" value="1" id="is_upcoming"
                                   @checked(old('is_upcoming', $agenda->is_upcoming ?? true))>
                            <label class="form-check-label" for="is_upcoming">Tandai sebagai event mendatang</label>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-semibold">Kategori</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">— Tanpa kategori —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected((string) old('category_id', $agenda->category_id) === (string) $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="source_name" class="form-label fw-semibold">Sumber</label>
                            <input type="text" name="source_name" id="source_name" class="form-control" maxlength="255" value="{{ old('source_name', $agenda->source_name) }}">
                        </div>
                        <div class="mb-0">
                            <label for="source_url" class="form-label fw-semibold">URL sumber</label>
                            <input type="url" name="source_url" id="source_url" class="form-control" maxlength="500" value="{{ old('source_url', $agenda->source_url) }}">
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                    <a href="{{ route('admin.agendas.index') }}" class="btn btn-light border">Batal</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const descInput = document.getElementById('description');
    const seoTitleInput = document.getElementById('seo_title');
    const seoDescInput = document.getElementById('seo_description');

    const serpPreviewTitle = document.getElementById('serpPreviewTitle');
    const serpPreviewDesc = document.getElementById('serpPreviewDesc');
    const seoTitleCount = document.getElementById('seoTitleCount');
    const seoDescCount = document.getElementById('seoDescCount');

    function updatePreview() {
        const title = titleInput.value.trim();
        const desc = descInput.value.trim();
        const seoTitle = seoTitleInput.value.trim();
        const seoDesc = seoDescInput.value.trim();

        serpPreviewTitle.textContent = (seoTitle || title || 'Nama Kegiatan') + ' | PPAk FEB UNESA';
        serpPreviewDesc.textContent = seoDesc || desc || 'Deskripsi kegiatan seminar / workshop akademik...';

        if (seoTitleCount) {
            seoTitleCount.textContent = (seoTitle.length) + ' / 60';
            seoTitleCount.className = seoTitle.length > 60 ? 'badge bg-warning text-dark small' : 'badge bg-secondary-subtle text-secondary small';
        }
        if (seoDescCount) {
            seoDescCount.textContent = (seoDesc.length) + ' / 160';
            seoDescCount.className = seoDesc.length > 160 ? 'badge bg-warning text-dark small' : 'badge bg-secondary-subtle text-secondary small';
        }
    }

    [titleInput, descInput, seoTitleInput, seoDescInput].forEach(el => {
        if (el) el.addEventListener('input', updatePreview);
    });

    updatePreview();
});
</script>
@endpush

