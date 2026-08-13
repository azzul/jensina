@extends('layouts.app')

@section('content')

<section class="snap-section hero">
    <div class="container hero__grid">
        <div class="hero-in-text">
            <h1>{{ $currentLocale === 'en'
                ? 'Construction & Heavy-Equipment Expedition, Done Right'
                : 'Jasa Konstruksi & Angkutan Alat Berat, Terpercaya' }}</h1>
            <p class="hero__lede">
                {{ $currentLocale === 'en'
                    ? 'Jensina Group brings together building construction and building-material / heavy-equipment hauling under one reliable roof, serving projects across Central Java.'
                    : 'Jensina Group memadukan layanan konstruksi bangunan dan jasa angkutan bahan bangunan / alat berat dalam satu atap yang dapat diandalkan, melayani proyek di seluruh Jawa Tengah.' }}
            </p>
            <div class="hero__cta">
                <a href="{{ localized_route('pages.contact') }}" class="btn btn-primary">{{ __('nav.get_quote') }}</a>
                <a href="{{ localized_route('products.index') }}" class="btn btn-outline">{{ __('nav.products') }}</a>
            </div>
            <div class="hero__badges">
                <div class="hero__badge"><b>2</b>&nbsp;{{ $currentLocale === 'en' ? 'legal entities' : 'badan usaha' }}</div>
                <div class="hero__badge"><b>{{ $categories->count() }}+</b>&nbsp;{{ $currentLocale === 'en' ? 'service lines' : 'lini layanan' }}</div>
                <div class="hero__badge"><b>{{ $clients->count() }}+</b>&nbsp;{{ __('nav.our_client') }}</div>
            </div>
        </div>
        <div class="hero__art hero-in-image">
            <img src="{{ asset('assets/img/hero-construction.jpg') }}" alt="{{ $siteSettings->site_name }}" loading="eager" width="640" height="480">
        </div>
    </div>
</section>

<section class="snap-section section-alt">
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">{{ $currentLocale === 'en' ? 'What we do' : 'Layanan Kami' }}</span>
            <h2>{{ $currentLocale === 'en' ? 'Two entities, one dependable partner' : 'Dua badan usaha, satu mitra andalan' }}</h2>
            <p>{{ $siteSettings->legal_entity_1 }} &amp; {{ $siteSettings->legal_entity_2 }}</p>
        </div>
        <div class="grid grid-3">
            @forelse($categories as $category)
                <div class="card reveal">
                    <div class="card__icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M6 21V9l6-4 6 4v12M10 21v-6h4v6"/></svg>
                    </div>
                    <h3>{{ $category->name }}</h3>
                    <p>{{ $category->description }}</p>
                </div>
            @empty
                <p>{{ $currentLocale === 'en' ? 'Service categories will appear here.' : 'Kategori layanan akan tampil di sini.' }}</p>
            @endforelse
        </div>
    </div>
</section>

<section class="snap-section">
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">{{ __('nav.products') }}</span>
            <h2>{{ $currentLocale === 'en' ? 'Featured products & services' : 'Produk & layanan unggulan' }}</h2>
        </div>
        <div class="grid grid-3">
            @forelse($featuredProducts as $product)
                <a href="{{ localized_route('products.show', ['slug' => $product->slug]) }}" class="product-card reveal">
                    <div class="product-card__img">
                        <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" loading="lazy" width="400" height="300">
                    </div>
                    <div class="product-card__body">
                        @if($product->category)
                            <span class="product-card__cat">{{ $product->category->name }}</span>
                        @endif
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->excerpt }}</p>
                    </div>
                </a>
            @empty
                <p>{{ $currentLocale === 'en' ? 'Featured products will appear here.' : 'Produk unggulan akan tampil di sini.' }}</p>
            @endforelse
        </div>
    </div>
</section>

@if($clients->isNotEmpty())
<section class="snap-section section-alt">
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">{{ __('nav.our_client') }}</span>
            <h2>{{ $currentLocale === 'en' ? 'Trusted by teams across Central Java' : 'Dipercaya oleh berbagai proyek di Jawa Tengah' }}</h2>
        </div>
        <div class="grid grid-4">
            @foreach($clients as $client)
                <div class="client-logo reveal">
                    <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" loading="lazy" width="140" height="48">
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="snap-section">
    <div class="container">
        <div class="cta-band reveal">
            <h2>{{ $currentLocale === 'en' ? "Have a project or shipment coming up?" : 'Ada proyek atau kebutuhan angkutan?' }}</h2>
            <p>{{ $currentLocale === 'en' ? 'Tell us the scope — we\'ll get back with a straightforward plan.' : 'Ceritakan kebutuhan Anda — tim kami akan merespons dengan solusi yang jelas.' }}</p>
            <a href="{{ localized_route('pages.contact') }}" class="btn btn-primary">{{ __('nav.get_quote') }}</a>
        </div>
    </div>
</section>

@endsection
