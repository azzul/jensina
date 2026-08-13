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
                <a href="{{ localized_route('products.index', ['category' => $category->slug]) }}" class="service-card reveal">
                    <div class="service-card__img">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" loading="lazy" width="400" height="300">
                    </div>
                    <div class="service-card__body">
                        <h3>{{ $category->name }}</h3>
                        <p>{{ $category->description }}</p>
                        <span class="service-card__link">
                            {{ $currentLocale === 'en' ? 'View services' : 'Lihat layanan' }}
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </span>
                    </div>
                </a>
            @empty
                <p>{{ $currentLocale === 'en' ? 'Service categories will appear here.' : 'Kategori layanan akan tampil di sini.' }}</p>
            @endforelse
        </div>
    </div>
</section>

<section class="snap-section">
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">{{ $currentLocale === 'en' ? 'Why Jensina Group' : 'Kenapa Memilih Kami' }}</span>
            <h2>{{ $currentLocale === 'en' ? 'Built for projects that can\'t afford delays' : 'Dibangun untuk proyek yang tak boleh molor' }}</h2>
        </div>
        <div class="grid grid-4">
            @php
                $whyUs = $currentLocale === 'en' ? [
                    ['title' => 'Construction + logistics, one group', 'text' => 'Material and equipment delivery schedules are coordinated directly with on-site progress — no separate vendor to chase.'],
                    ['title' => 'Experienced crews & operators', 'text' => 'Field teams and equipment operators who understand workplace-safety standards on active project sites.'],
                    ['title' => 'Two legal entities, one point of contact', 'text' => 'CV Anugerah Jensina Sejahtera and PT Maju Jensina Jaya work under one coordinated team for your project.'],
                    ['title' => 'Central Java coverage', 'text' => 'Based in Karanganyar, serving projects across Karanganyar and the wider Central Java region.'],
                ] : [
                    ['title' => 'Konstruksi + logistik, satu grup', 'text' => 'Jadwal pengiriman material dan alat berat diselaraskan langsung dengan progres di lapangan — tanpa perlu koordinasi ke vendor terpisah.'],
                    ['title' => 'Tim & operator berpengalaman', 'text' => 'Tim lapangan dan operator alat berat yang memahami standar keselamatan kerja di lokasi proyek aktif.'],
                    ['title' => 'Dua badan usaha, satu koordinasi', 'text' => 'CV Anugerah Jensina Sejahtera dan PT Maju Jensina Jaya bekerja dalam satu tim terkoordinasi untuk proyek Anda.'],
                    ['title' => 'Jangkauan Jawa Tengah', 'text' => 'Berbasis di Karanganyar, melayani proyek di Karanganyar dan wilayah Jawa Tengah lainnya.'],
                ];
            @endphp
            @foreach($whyUs as $i => $item)
                <div class="card reveal">
                    <div class="card__icon" aria-hidden="true">{{ $i + 1 }}</div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="snap-section section-alt">
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">{{ $currentLocale === 'en' ? 'Our Process' : 'Cara Kami Bekerja' }}</span>
            <h2>{{ $currentLocale === 'en' ? 'From first call to handover' : 'Dari konsultasi awal hingga serah terima' }}</h2>
        </div>
        <div class="process-steps">
            @php
                $steps = $currentLocale === 'en' ? [
                    ['title' => 'Needs consultation', 'text' => 'We discuss project scope, location, and timeline — by phone, WhatsApp, or in person.'],
                    ['title' => 'Planning & scheduling', 'text' => 'A work plan is drawn up together, including material/equipment delivery scheduling where relevant.'],
                    ['title' => 'Execution & supervision', 'text' => 'Work proceeds under a dedicated project lead with regular quality and safety checks.'],
                    ['title' => 'Handover & follow-up', 'text' => 'Completed work is handed over with documentation; we stay available for after-project questions.'],
                ] : [
                    ['title' => 'Konsultasi kebutuhan', 'text' => 'Kami diskusikan lingkup proyek, lokasi, dan target waktu — via telepon, WhatsApp, atau bertemu langsung.'],
                    ['title' => 'Perencanaan & penjadwalan', 'text' => 'Rencana kerja disusun bersama, termasuk penjadwalan pengiriman material/alat berat bila diperlukan.'],
                    ['title' => 'Pelaksanaan & pengawasan', 'text' => 'Pekerjaan berjalan di bawah penanggung jawab proyek dengan pengecekan mutu dan keselamatan berkala.'],
                    ['title' => 'Serah terima & tindak lanjut', 'text' => 'Hasil pekerjaan diserahterimakan dengan dokumentasi; kami tetap terbuka untuk pertanyaan purnaproyek.'],
                ];
            @endphp
            @foreach($steps as $i => $step)
                <div class="process-step reveal">
                    <div class="process-step__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <h3>{{ $step['title'] }}</h3>
                    <p>{{ $step['text'] }}</p>
                </div>
            @endforeach
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
