@extends('layouts.app')

@php
    $metaTitle = $product->meta_title;
    $metaDescription = $product->meta_description;
    $ogImage = $product->thumbnail;
@endphp

@push('json-ld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->name,
    'description' => $product->excerpt,
    'image' => $product->thumbnail_url,
    'brand' => ['@type' => 'Brand', 'name' => $siteSettings->site_name],
    'category' => $product->category?->name,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<section class="container" style="padding-block:40px 60px;">
    <div class="product-hero">
        <div>
            <div class="gallery-main">
                <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" width="640" height="480" loading="eager">
            </div>
            @if(!empty($product->gallery))
                <div class="gallery-thumbs">
                    @foreach($product->gallery as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" loading="lazy">
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            @if($product->category)
                <span class="product-card__cat">{{ $product->category->name }}</span>
            @endif
            <h1>{{ $product->name }}</h1>
            <p style="color:var(--color-ink-soft);">{{ $product->excerpt }}</p>
            <div class="prose">{!! $product->description !!}</div>

            @if(!empty($product->specifications))
                <table class="spec-table">
                    <tbody>
                    @foreach($product->specifications as $spec)
                        <tr>
                            <th>{{ $currentLocale === 'en' ? ($spec['label_en'] ?? '') : ($spec['label_id'] ?? '') }}</th>
                            <td>{{ $spec['value'] ?? '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

            <div class="hero__cta" style="margin-top:26px;">
                <a href="{{ route('pages.contact', ['locale' => $currentLocale]) }}" class="btn btn-primary">{{ __('nav.get_quote') }}</a>
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $siteSettings->whatsapp ?: $siteSettings->phone) }}" class="btn btn-outline" rel="nofollow">WhatsApp</a>
            </div>
        </div>
    </div>
</section>

@if($related->isNotEmpty())
<section class="section-alt">
    <div class="container" style="padding-block:50px 70px;">
        <div class="section-head">
            <h2>{{ $currentLocale === 'en' ? 'Related products' : 'Produk terkait' }}</h2>
        </div>
        <div class="grid grid-3">
            @foreach($related as $item)
                <a href="{{ route('products.show', ['locale' => $currentLocale, 'slug' => $item->slug]) }}" class="product-card">
                    <div class="product-card__img">
                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->name }}" loading="lazy" width="400" height="300">
                    </div>
                    <div class="product-card__body">
                        <h3>{{ $item->name }}</h3>
                        <p>{{ $item->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
