@extends('admin.layouts.app')

@section('title', 'Pengaturan Website')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Pengaturan Website</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-1">Pengaturan Website & SEO</h1>
    <p class="text-muted small mb-3">Satu sumber kebenaran untuk informasi global (nama, kontak, sosmed, SEO). Perubahan langsung berlaku.</p>

    <form method="POST" action="{{ route('admin.site-settings.update') }}">
        @csrf
        @method('PUT')

        @foreach($groups as $groupKey => $groupLabel)
            @if(isset($settings[$groupKey]))
                <div class="card mb-3">
                    <div class="card-header">{{ $groupLabel }}</div>
                    <div class="card-body">
                        @foreach($settings[$groupKey] as $setting)
                            <div class="mb-3">
                                <label class="form-label fw-semibold" for="setting_{{ $setting->key }}">
                                    {{ $setting->label ?? $setting->key }}
                                    <span class="text-muted fw-normal">({{ $setting->key }})</span>
                                </label>
                                @if($setting->type === 'textarea')
                                    <textarea name="settings[{{ $setting->key }}]" id="setting_{{ $setting->key }}" rows="2" class="form-control">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                                @else
                                    <input type="{{ $setting->type === 'email' ? 'email' : 'text' }}" name="settings[{{ $setting->key }}]"
                                           id="setting_{{ $setting->key }}" class="form-control" value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                           @if($setting->type === 'url') placeholder="https://..." @endif>
                                @endif
                                @if($setting->description)<div class="form-text">{{ $setting->description }}</div>@endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        <div class="d-grid d-md-block">
            <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan Semua Pengaturan</button>
        </div>
    </form>
@endsection
