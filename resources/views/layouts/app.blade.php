<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $currentLocale) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- ============================================================
     SEO <head>: every value below comes from the $siteSettings
     row (shared by SiteDataComposer) or the per-page $metaTitle /
     $metaDescription / $ogImage / $canonicalUrl the controller
     passed in. Nothing here is hardcoded copy.
     ============================================================ --}}
@php
    $pageTitle = trim(($metaTitle ?? $siteSettings->defaultMetaTitle()) . ' | ' . $siteSettings->site_name, ' |');
    $pageDescription = $metaDescription ?? $siteSettings->defaultMetaDescription();
    $canonicalUrl = $canonicalUrl ?? url()->current();
    $shareImage = $ogImage ?? $siteSettings->default_og_image;
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- hreflang: tells Google the ID/EN pages are translations, not duplicates --}}
<link rel="alternate" hreflang="id" href="{{ str_replace('/en/', '/id/', $canonicalUrl) }}">
<link rel="alternate" hreflang="en" href="{{ str_replace('/id/', '/en/', $canonicalUrl) }}">
<link rel="alternate" hreflang="x-default" href="{{ str_replace('/en/', '/id/', $canonicalUrl) }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteSettings->site_name }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:locale" content="{{ $currentLocale === 'en' ? 'en_US' : 'id_ID' }}">
@if($shareImage)
<meta property="og:image" content="{{ asset('storage/' . $shareImage) }}">
@endif
<meta name="twitter:card" content="summary_large_image">

@if($siteSettings->google_site_verification)
<meta name="google-site-verification" content="{{ $siteSettings->google_site_verification }}">
@endif

@if($siteSettings->favicon_path)
<link rel="icon" href="{{ asset('storage/' . $siteSettings->favicon_path) }}">
@endif

{{-- llms.txt discovery hint for AI crawlers, and a direct link for humans --}}
<link rel="llms-txt" href="{{ url('/llms.txt') }}">

{{-- Single lightweight stylesheet. No build step required: this points
     straight at public/assets/css/app.css. The ?v= query string is the
     file's last-modified time, so browsers fetch a fresh copy automatically
     whenever app.css changes — no manual cache-busting needed.
     (If you'd rather use Vite for fingerprinting/minification later, swap
     this line for @vite(['resources/css/app.css','resources/js/app.js'])
     and run `npm install && npm run build`.) --}}
@php
    $cssPath = public_path('assets/css/app.css');
    $jsPath = public_path('assets/js/app.js');
@endphp
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}?v={{ file_exists($cssPath) ? filemtime($cssPath) : 1 }}">

{{-- Organization JSON-LD — present on every page --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $siteSettings->site_name,
    'alternateName' => [$siteSettings->legal_entity_1, $siteSettings->legal_entity_2],
    'url' => $siteSettings->canonical_domain,
    'logo' => $siteSettings->logo_path ? asset('storage/' . $siteSettings->logo_path) : null,
    'telephone' => $siteSettings->phone,
    'email' => $siteSettings->email,
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $siteSettings->address,
        'addressRegion' => 'Jawa Tengah',
        'addressCountry' => 'ID',
    ],
    'sameAs' => array_filter([
        $siteSettings->instagram, $siteSettings->facebook, $siteSettings->youtube, $siteSettings->linkedin,
    ]),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

{{-- BreadcrumbList JSON-LD, built from the $breadcrumbs array every
     controller passes to its view (see partials.breadcrumb for the
     matching visible <nav>). --}}
@isset($breadcrumbs)
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => collect($breadcrumbs)->values()->map(function ($crumb, $i) {
        return [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $crumb['label'],
            'item' => $crumb['url'] ?? url()->current(),
        ];
    })->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endisset

{{-- Per-page JSON-LD (e.g. Product schema) pushed from child views --}}
@stack('json-ld')

{{-- Per-page extra <head> tags (og:image overrides, extra meta, etc.) --}}
@stack('head')

@if($siteSettings->gtm_id)
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $siteSettings->gtm_id }}');</script>
@endif
</head>
<body>
<a href="#main-content" class="skip-link">{{ $currentLocale === 'en' ? 'Skip to content' : 'Lewati ke konten' }}</a>

@if($siteSettings->gtm_id)
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $siteSettings->gtm_id }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endif

@include('partials.header')

<main id="main-content" class="scroll-shell">
    @isset($breadcrumbs)
        @include('partials.breadcrumb')
    @endisset

    @yield('content')
</main>

@include('partials.footer')

<script src="{{ asset('assets/js/app.js') }}?v={{ file_exists($jsPath) ? filemtime($jsPath) : 1 }}" defer></script>
@stack('scripts')
</body>
</html>
