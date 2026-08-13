@php
    $navLinks = [
        ['route' => 'home', 'label' => __('nav.home')],
        ['route' => 'pages.about', 'label' => __('nav.about')],
        ['route' => 'products.index', 'label' => __('nav.products')],
        ['route' => 'pages.our-client', 'label' => __('nav.our_client')],
        ['route' => 'pages.contact', 'label' => __('nav.contact')],
    ];
@endphp
<header class="site-header">
    <div class="container site-header__inner">
        <a href="{{ route('home', ['locale' => $currentLocale]) }}" class="brand">
            @if($siteSettings->logo_path)
                <img src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="{{ $siteSettings->site_name }}" width="42" height="42">
            @endif
            <span>
                {{ $siteSettings->site_name_short }}
                <small>{{ $siteSettings->tagline() }}</small>
            </span>
        </a>

        <nav class="main-nav" data-main-nav aria-label="Main navigation">
            @foreach($navLinks as $link)
                @php $isActive = request()->routeIs($link['route']); @endphp
                <a href="{{ route($link['route'], ['locale' => $currentLocale]) }}"
                   @if($isActive) aria-current="page" @endif>
                    {{ $link['label'] }}
                </a>
            @endforeach

            <a href="{{ route('download.company-profile') }}" class="btn btn-outline">
                {{ __('nav.download_profile') }}
            </a>
        </nav>

        <div class="header-actions">
            <div class="lang-switch" aria-label="Language switch">
                <a href="{{ $localeUrls['id'] }}" aria-current="{{ $currentLocale === 'id' ? 'true' : 'false' }}">ID</a>
                <a href="{{ $localeUrls['en'] }}" aria-current="{{ $currentLocale === 'en' ? 'true' : 'false' }}">EN</a>
            </div>
            <a href="tel:{{ $siteSettings->phone }}" class="btn btn-primary">{{ __('nav.call_now') }}</a>
            <button type="button" class="nav-toggle" data-nav-toggle aria-label="Toggle menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>
