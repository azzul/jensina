@extends('layouts.app')

@section('content')
<section class="container" style="padding-block:40px 80px;">
    <div class="section-head">
        <span class="eyebrow">{{ __('nav.products') }}</span>
        <h1>{{ __('meta.products_title') }}</h1>
        <p>{{ __('meta.products_description') }}</p>
    </div>

    <div class="filter-bar">
        <a href="{{ localized_route('products.index') }}"
           class="filter-chip" aria-current="{{ $activeCategory === '' ? 'true' : 'false' }}">
            {{ $currentLocale === 'en' ? 'All' : 'Semua' }}
        </a>
        @foreach($categories as $category)
            <a href="{{ localized_route('products.index', ['category' => $category->slug]) }}"
               class="filter-chip" aria-current="{{ $activeCategory === $category->slug ? 'true' : 'false' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-3">
        @forelse($products as $product)
            <a href="{{ localized_route('products.show', ['slug' => $product->slug]) }}" class="product-card">
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
            <p>{{ $currentLocale === 'en' ? 'No products found.' : 'Produk tidak ditemukan.' }}</p>
        @endforelse
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</section>
@endsection
