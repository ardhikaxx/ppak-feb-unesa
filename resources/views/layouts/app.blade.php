<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO - defaults dari Site Settings (CMS), fallback ke config, overridable per page --}}
    <title>@yield('title', ($siteContact['site_title'] ?? null) ?: config('ppak.seo.default_title'))</title>
    <meta name="description" content="@yield('meta_description', ($siteContact['meta_description'] ?? null) ?: config('ppak.seo.default_description'))">
    <meta name="keywords" content="@yield('meta_keywords', config('ppak.seo.default_keywords'))">
    <meta name="author" content="PPAk FEB UNESA">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:title" content="@yield('og_title', View::hasSection('title') ? trim($__env->yieldContent('title')) : config('ppak.seo.default_title'))">
    <meta property="og:description" content="@yield('og_description', View::hasSection('meta_description') ? trim($__env->yieldContent('meta_description')) : config('ppak.seo.default_description'))">
    <meta property="og:image" content="@yield('og_image', asset(ltrim(($siteContact['og_image'] ?? null) ?: config('ppak.seo.default_image'), '/')))">
    <meta property="og:site_name" content="PPAk FEB UNESA">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', View::hasSection('title') ? trim($__env->yieldContent('title')) : config('ppak.seo.default_title'))">
    <meta name="twitter:description" content="@yield('twitter_description', View::hasSection('meta_description') ? trim($__env->yieldContent('meta_description')) : config('ppak.seo.default_description'))">
    <meta name="twitter:image" content="@yield('twitter_image', asset(ltrim(($siteContact['og_image'] ?? null) ?: config('ppak.seo.default_image'), '/')) )">

    {{-- Preconnect to CDN for performance (Bootstrap, Font Awesome) --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">

    {{-- Bootstrap 5.3.3 via CDN - version locked, CDN-ready to local fallback --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Font Awesome 6.6.0 via CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Design System CSS - cache-busted, CDN-ready via asset URL --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ file_exists(public_path('css/app.css')) ? filemtime(public_path('css/app.css')) : time() }}">

    {{-- Structured Data (Organization) --}}
    <script type="application/ld+json">{!! json_encode(\App\Services\SeoService::organizationJsonLd(), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Skip link --}}
    <a href="#main-content" class="visually-hidden-focusable p-3 bg-white text-primary position-absolute top-0 start-0 z-3">Lewati ke konten utama</a>

    @include('partials.topbar')
    @include('partials.navbar')

    <main id="main-content" class="flex-grow-1">
        @yield('content')
    </main>

    @unless(View::hasSection('hide_cta'))
        @include('partials.cta-banner')
    @endunless

    @include('partials.footer')

    {{-- Bootstrap bundle - deferred, not blocking LCP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    @stack('scripts')
</body>
</html>
