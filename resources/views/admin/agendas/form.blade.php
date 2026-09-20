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
            </div>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">Status & Kategori</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold required">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                @foreach(['upcoming' => 'Mendatang', 'ongoing' => 'Berlangsung', 'completed' => 'Selesai', 'cancelled' => 'Batal'] as $val => $label)
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
