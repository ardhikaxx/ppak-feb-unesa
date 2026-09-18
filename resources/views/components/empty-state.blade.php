@props(['title' => 'Belum ada data', 'message' => 'Data tidak tersedia saat ini.', 'icon' => 'fa-inbox'])
<div class="text-center py-5" {{ $attributes }}>
    <div class="mb-3">
        <i class="fa-solid {{ $icon }} text-muted" style="font-size: 2.5rem; opacity: 0.5;"></i>
    </div>
    <h4 class="h6 fw-bold text-navy mb-2">{{ $title }}</h4>
    <p class="small text-secondary mb-3">{{ $message }}</p>
    {{ $slot }}
</div>
