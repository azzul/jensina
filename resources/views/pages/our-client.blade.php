@extends('layouts.app')

@section('content')
<section class="container" style="padding-block:40px 80px;">
    <div class="section-head">
        <span class="eyebrow">{{ __('nav.our_client') }}</span>
        <h1>{{ __('meta.clients_title') }}</h1>
        <p>{{ __('meta.clients_description') }}</p>
    </div>

    <div class="grid grid-4">
        @forelse($clients as $client)
            <div class="client-logo">
                @if($client->website)
                    <a href="{{ $client->website }}" target="_blank" rel="noopener nofollow">
                        <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" loading="lazy" width="140" height="48">
                    </a>
                @else
                    <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" loading="lazy" width="140" height="48">
                @endif
            </div>
        @empty
            <p>{{ $currentLocale === 'en' ? 'Client logos will appear here.' : 'Logo klien akan tampil di sini.' }}</p>
        @endforelse
    </div>
</section>
@endsection
