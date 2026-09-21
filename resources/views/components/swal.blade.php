{{--
    Sistem notifikasi & konfirmasi global PPAk FEB UNESA (SweetAlert2 via CDN).
    - Satu-satunya sumber CDN SweetAlert2 di aplikasi (v11.26.25, pin eksplisit).
    - Partial ini di-include SATU KALI per layout (admin, publik, login).
    - Toast otomatis dari Laravel flash: success/error/warning/info.
    - Satu toast peringatan global bila $errors->any() (detail tetap di field).
    - Konfirmasi hapus (.btn-delete) + form [data-swal-confirm] (mis. logout).
    - Tidak mengubah business logic, redirect, CSRF, maupun validasi existing.
--}}
@php($swalFlash = ['success' => session('success'), 'error' => session('error'), 'warning' => session('warning'), 'info' => session('info')])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.25/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.25/dist/sweetalert2.all.min.js"></script>
<script>
(function () {
    if (window.__ppakSwalInit || typeof window.Swal === 'undefined') return;
    window.__ppakSwalInit = true;

    var Toast = window.Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        showCloseButton: true,
        didOpen: function (toast) {
            toast.addEventListener('mouseenter', window.Swal.stopTimer);
            toast.addEventListener('mouseleave', window.Swal.resumeTimer);
        },
    });

    // Helper global: PpakSwal.toast('success'|'error'|'warning'|'info'|'question', 'Pesan')
    // dan PpakSwal.confirm({title, text, confirmText, icon}) -> Promise<boolean>.
    window.PpakSwal = {
        toast: function (type, message) {
            if (!message) return;
            var icon = type === 'question' ? 'question' : type;
            if (['success', 'error', 'warning', 'info', 'question'].indexOf(icon) === -1) icon = 'info';
            Toast.fire({ icon: icon, title: message });
        },
        confirm: function (opts) {
            opts = opts || {};
            return window.Swal.fire({
                title: opts.title || 'Apakah Anda yakin?',
                text: opts.text || '',
                icon: opts.icon || 'warning',
                showCancelButton: true,
                confirmButtonText: opts.confirmText || 'Ya, Lanjutkan',
                cancelButtonText: opts.cancelText || 'Batal',
                confirmButtonColor: opts.confirmColor || '#0b409c',
                cancelButtonColor: '#6c757d',
                focusCancel: true,
                reverseButtons: true,
            }).then(function (result) {
                return result.isConfirmed;
            });
        },
    };

    // 1. Flash session Laravel -> toast (sekali tampil, hilang setelah redirect).
    var flash = @json($swalFlash ?? []);
    Object.keys(flash).forEach(function (type) {
        if (flash[type]) window.PpakSwal.toast(type, flash[type]);
    });

    // 2. Validation error global: SATU toast saja, detail tetap pada tiap field.
    @if($errors->any())
    window.PpakSwal.toast('warning', 'Periksa kembali data yang Anda masukkan.');
    @endif

    // 3. Konfirmasi hapus: tombol .btn-delete[data-url][data-message?].
    //    Request DELETE tetap via form + CSRF + method spoofing existing.
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.btn-delete');
        if (!btn || !btn.dataset.url) return;
        e.preventDefault();
        window.PpakSwal.confirm({
            title: 'Konfirmasi Hapus',
            text: btn.dataset.message || 'Data yang dihapus masuk ke arsip (soft delete) dan dapat dipulihkan. Lanjutkan?',
            confirmText: 'Ya, Hapus',
            confirmColor: '#dc3545',
        }).then(function (ok) {
            if (!ok) return;
            var form = document.getElementById('confirmDeleteForm');
            if (!form) return;
            form.setAttribute('action', btn.dataset.url);
            form.submit();
        });
    });

    // 4. Konfirmasi generik untuk form penting: <form data-swal-confirm
    //    data-confirm-title="..." data-confirm-text="..." data-confirm-confirm-text="...">.
    document.addEventListener('submit', function (e) {
        var form = e.target.closest('form[data-swal-confirm]');
        if (!form || form.dataset.swalConfirmed === 'true') return;
        e.preventDefault();
        window.PpakSwal.confirm({
            title: form.dataset.confirmTitle || 'Konfirmasi',
            text: form.dataset.confirmText || 'Apakah Anda yakin ingin melanjutkan?',
            confirmText: form.dataset.confirmConfirmText || 'Ya, Lanjutkan',
            icon: form.dataset.confirmIcon || 'question',
        }).then(function (ok) {
            if (!ok) return;
            form.dataset.swalConfirmed = 'true';
            form.submit();
        });
    });
})();
</script>
