@props(['title' => '', 'badge' => null, 'lead' => null, 'breadcrumbs' => []])

{{--
    Implementasi tunggal header halaman ada di partials/page-header
    (dipakai 21 halaman lain via @include). Komponen ini hanya pembungkus
    agar tag <x-page-header ... /> tetap dapat dipakai tanpa duplikasi markup.
--}}
@include('partials.page-header', [
    'title' => $title,
    'badge' => $badge,
    'lead' => $lead,
    'breadcrumbs' => $breadcrumbs,
    'slot' => $slot ?? null,
])
