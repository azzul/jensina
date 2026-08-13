@extends('layouts.app')

@php
    $metaTitle = $page->meta_title;
    $metaDescription = $page->meta_description;
    $ogImage = $page->hero_image;
@endphp

@section('content')
<section class="container" style="padding-block:40px 70px;">
    <div class="section-head">
        <h1>{{ $page->title }}</h1>
    </div>

    @if($page->hero_image)
        <div class="hero__art" style="margin-bottom:32px;max-width:900px;">
            <img src="{{ asset('storage/' . $page->hero_image) }}" alt="{{ $page->title }}" loading="lazy">
        </div>
    @endif

    <div class="prose">
        {!! $page->content !!}
    </div>

    @if($page->type === 'about')
        <div class="grid grid-3" style="margin-top:48px;">
            <div class="card">
                <h3>{{ $siteSettings->legal_entity_1 }}</h3>
                <p>{{ $currentLocale === 'en' ? 'Construction unit of Jensina Group.' : 'Unit konstruksi Jensina Group.' }}</p>
            </div>
            <div class="card">
                <h3>{{ $siteSettings->legal_entity_2 }}</h3>
                <p>{{ $currentLocale === 'en' ? 'Expedition & heavy-equipment transport unit.' : 'Unit ekspedisi & angkutan alat berat.' }}</p>
            </div>
            <div class="card">
                <h3>{{ $currentLocale === 'en' ? 'Head office' : 'Kantor Pusat' }}</h3>
                <p>{{ $siteSettings->address }}</p>
            </div>
        </div>
    @endif
</section>
@endsection
