@extends('layouts.app')

@section('content')
<section class="container" style="padding-block:40px 20px;">
    <div class="section-head">
        <span class="eyebrow">{{ __('nav.our_client') }}</span>
        <h1>{{ __('meta.clients_title') }}</h1>
        <p>{{ __('meta.clients_description') }}</p>
    </div>

    <div class="prose" style="margin-bottom:40px;">
        @if($currentLocale === 'en')
            <p>Jensina Group's construction and expedition services have supported a mix of national construction contractors and shipping/logistics companies. On the construction side, our team has worked alongside major infrastructure and building contractors on material supply and site-support needs; on the expedition side, PT Maju Jensina Jaya handles container and material hauling that supports shipping-line clients moving cargo through the region.</p>
            <p>We don't publish project values or contract details out of respect for client confidentiality — the list below reflects companies we have worked with, not an exhaustive project history.</p>
        @else
            <p>Layanan konstruksi dan ekspedisi Jensina Group telah mendukung kebutuhan berbagai kontraktor konstruksi nasional maupun perusahaan pelayaran dan logistik. Di sisi konstruksi, tim kami pernah mendukung kebutuhan material dan pekerjaan lapangan untuk kontraktor infrastruktur dan bangunan skala besar; di sisi ekspedisi, PT Maju Jensina Jaya menangani angkutan kontainer dan material yang mendukung kebutuhan klien di sektor pelayaran dalam mendistribusikan muatan di wilayah ini.</p>
            <p>Kami tidak mempublikasikan nilai proyek atau detail kontrak demi menjaga kerahasiaan klien — daftar di bawah ini mencerminkan perusahaan yang pernah bekerja sama dengan kami, bukan riwayat proyek yang lengkap.</p>
        @endif
    </div>
</section>

<section class="container" style="padding-block:0 80px;">
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
