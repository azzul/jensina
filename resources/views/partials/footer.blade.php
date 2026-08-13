<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <div class="brand" style="color:#fff;margin-bottom:14px;">
                @if($siteSettings->logo_path)
                    <img src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="{{ $siteSettings->site_name }}" width="40" height="40">
                @endif
                <span>{{ $siteSettings->site_name }}</span>
            </div>
            <p style="max-width:32ch;font-size:.88rem;">{{ $siteSettings->tagline() }}</p>
            <p style="font-size:.8rem;color:#8fb1ba;">
                {{ $siteSettings->legal_entity_1 }}<br>
                {{ $siteSettings->legal_entity_2 }}
            </p>
        </div>

        <div>
            <h4>{{ __('nav.products') }}</h4>
            <ul>
                <li><a href="{{ localized_route('products.index') }}">{{ __('nav.products') }}</a></li>
                <li><a href="{{ localized_route('pages.about') }}">{{ __('nav.about') }}</a></li>
                <li><a href="{{ localized_route('pages.our-client') }}">{{ __('nav.our_client') }}</a></li>
            </ul>
        </div>

        <div>
            <h4>{{ $currentLocale === 'en' ? 'Legal' : 'Legalitas' }}</h4>
            <ul>
                <li><a href="{{ localized_route('pages.privacy') }}">{{ __('nav.privacy') }}</a></li>
                <li><a href="{{ localized_route('pages.terms') }}">{{ __('nav.terms') }}</a></li>
                <li><a href="{{ route('download.company-profile') }}">{{ __('nav.download_profile') }}</a></li>
            </ul>
        </div>

        <div>
            <h4>{{ __('nav.contact') }}</h4>
            <ul>
                <li>{{ $siteSettings->address }}</li>
                <li><a href="tel:{{ $siteSettings->phone }}">{{ $siteSettings->phone }}</a></li>
                <li><a href="mailto:{{ $siteSettings->email }}">{{ $siteSettings->email }}</a></li>
            </ul>
        </div>
    </div>

    <div class="container footer-bottom">
        <span>&copy; {{ date('Y') }} {{ $siteSettings->site_name }}. {{ $currentLocale === 'en' ? 'All rights reserved.' : 'Seluruh hak cipta dilindungi.' }}</span>
        <span>{{ $siteSettings->legal_entity_1 }} &middot; {{ $siteSettings->legal_entity_2 }}</span>
    </div>
</footer>
