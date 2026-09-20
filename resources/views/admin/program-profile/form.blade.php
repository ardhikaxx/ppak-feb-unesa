@extends('admin.layouts.app')

@section('title', 'Profil Program')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Profil Program</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">Profil Program PPAk</h1>
    <p class="text-muted small">Satu sumber kebenaran identitas program. Perubahan langsung tampil di seluruh website.</p>

    <form method="POST" action="{{ route('admin.program-profile.update') }}">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">Identitas Resmi</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold required" for="program_code">Kode prodi</label>
                                <input type="text" name="program_code" id="program_code" class="form-control" value="{{ old('program_code', $profile->program_code) }}" required maxlength="20">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label fw-semibold required" for="program_name">Nama resmi</label>
                                <input type="text" name="program_name" id="program_name" class="form-control" value="{{ old('program_name', $profile->program_name) }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold" for="short_name">Nama singkat</label>
                                <input type="text" name="short_name" id="short_name" class="form-control" value="{{ old('short_name', $profile->short_name) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold" for="level">Jenjang</label>
                                <input type="text" name="level" id="level" class="form-control" value="{{ old('level', $profile->level) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="faculty">Fakultas</label>
                            <input type="text" name="faculty" id="faculty" class="form-control" value="{{ old('faculty', $profile->faculty) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="university">Universitas</label>
                            <input type="text" name="university" id="university" class="form-control" value="{{ old('university', $profile->university) }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold" for="established_date">Tanggal berdiri</label>
                                <input type="date" name="established_date" id="established_date" class="form-control" value="{{ old('established_date', $profile->established_date?->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold" for="coordinator_name">Koordinator prodi</label>
                                <input type="text" name="coordinator_name" id="coordinator_name" class="form-control" value="{{ old('coordinator_name', $profile->coordinator_name) }}">
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold" for="tagline">Tagline</label>
                            <textarea name="tagline" id="tagline" rows="2" class="form-control">{{ old('tagline', $profile->tagline) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">Kontak & Layanan</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="address">Alamat</label>
                            <textarea name="address" id="address" rows="2" class="form-control">{{ old('address', $profile->address) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold" for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $profile->email) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold" for="phone">Telepon</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $profile->phone) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold" for="whatsapp">WhatsApp</label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $profile->whatsapp) }}">
                            </div>
                            <div class="col-md-6 mb-0">
                                <label class="form-label fw-semibold" for="office_hours">Jam layanan</label>
                                <input type="text" name="office_hours" id="office_hours" class="form-control" value="{{ old('office_hours', $profile->office_hours) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">Media Sosial (URL lengkap)</div>
                    <div class="card-body">
                        @php $socials = $profile->social_links ?? []; @endphp
                        @foreach(['instagram' => 'Instagram UNESA', 'instagram_feb' => 'Instagram FEB', 'youtube' => 'YouTube', 'tiktok' => 'TikTok', 'facebook' => 'Facebook', 'linkedin' => 'LinkedIn'] as $key => $label)
                            <div class="mb-2">
                                <label class="form-label small fw-semibold" for="social_{{ $key }}">{{ $label }}</label>
                                <input type="url" name="social_{{ $key }}" id="social_{{ $key }}" class="form-control form-control-sm"
                                       value="{{ old('social_' . $key, $socials[$key] ?? '') }}" placeholder="https://...">
                            </div>
                        @endforeach
                        <div class="row mt-3">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-semibold" for="source_name">Nama sumber</label>
                                <input type="text" name="source_name" id="source_name" class="form-control form-control-sm" value="{{ old('source_name', $profile->source_name) }}">
                            </div>
                            <div class="col-md-6 mb-0">
                                <label class="form-label small fw-semibold" for="source_url">URL sumber</label>
                                <input type="url" name="source_url" id="source_url" class="form-control form-control-sm" value="{{ old('source_url', $profile->source_url) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan Profil</button>
                </div>
            </div>
        </div>
    </form>
@endsection
