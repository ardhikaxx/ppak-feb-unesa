@props([
    'name',
    'id' => null,
    'label' => '',
    'labelClass' => '',
    'icon' => null,
    'autocomplete' => 'new-password',
    'placeholder' => '••••••••',
    'required' => false,
    'value' => '',
])

@php($fieldId = $id ?? $name)

<div>
    @if($label)
        <label for="{{ $fieldId }}" class="form-label fw-semibold {{ $labelClass }}">{!! $label !!}</label>
    @endif
    <div class="input-group @error($name) has-validation @enderror">
        @if($icon)
            <span class="input-group-text"><i class="fa-solid {{ $icon }}"></i></span>
        @endif
        <input type="password" name="{{ $name }}" id="{{ $fieldId }}"
               class="form-control @error($name) is-invalid @enderror"
               value="{{ $value }}" autocomplete="{{ $autocomplete }}"
               placeholder="{{ $placeholder }}" data-password-input
               @if($required) required @endif>
        <button type="button" class="btn btn-outline-secondary" data-password-toggle
                aria-label="Tampilkan password" title="Tampilkan/sembunyikan password">
            <i class="fa-solid fa-eye"></i>
        </button>
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- Toggle tampil/sembunyi password (delegasi, aman dipakai banyak instance) --}}
<script>
if (!window.__ppakPwToggle) {
    window.__ppakPwToggle = true;
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-password-toggle]');
        if (!btn) return;
        var input = btn.closest('.input-group').querySelector('[data-password-input]');
        if (!input) return;
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        var icon = btn.querySelector('i');
        if (icon) {
            icon.classList.toggle('fa-eye', !show);
            icon.classList.toggle('fa-eye-slash', show);
        }
        btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
    });
}
</script>
