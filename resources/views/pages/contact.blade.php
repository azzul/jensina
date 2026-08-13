@extends('layouts.app')

@section('content')
<section class="container" style="padding-block:40px 80px;">
    <div class="section-head">
        <span class="eyebrow">{{ __('nav.contact') }}</span>
        <h1>{{ __('meta.contact_title') }}</h1>
        <p>{{ __('meta.contact_description') }}</p>
    </div>

    <div class="hero__grid" style="align-items:flex-start;">
        <div>
            @if(session('status'))
                <div class="alert-success" role="status">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ localized_route('pages.contact.store') }}" class="form-grid" novalidate>
                @csrf
                <input type="text" name="website" class="honeypot" tabindex="-1" autocomplete="off" aria-hidden="true">

                <div class="field">
                    <label for="name">{{ __('contact.form_name') }}</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                    @error('name') <small style="color:#c0392b;">{{ $message }}</small> @enderror
                </div>
                <div class="field">
                    <label for="email">{{ __('contact.form_email') }}</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                    @error('email') <small style="color:#c0392b;">{{ $message }}</small> @enderror
                </div>
                <div class="field">
                    <label for="phone">{{ __('contact.form_phone') }}</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}">
                </div>
                <div class="field">
                    <label for="subject">{{ __('contact.form_subject') }}</label>
                    <input id="subject" name="subject" type="text" value="{{ old('subject') }}">
                </div>
                <div class="field full">
                    <label for="message">{{ __('contact.form_message') }}</label>
                    <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                    @error('message') <small style="color:#c0392b;">{{ $message }}</small> @enderror
                </div>
                <div class="field full">
                    <button type="submit" class="btn btn-primary">{{ __('contact.form_submit') }}</button>
                </div>
            </form>
        </div>

        <div>
            <div class="card" style="margin-bottom:18px;">
                <h3>{{ __('nav.contact') }}</h3>
                <p>{{ $siteSettings->address }}</p>
                <p><a href="tel:{{ $siteSettings->phone }}">{{ $siteSettings->phone }}</a></p>
                <p><a href="mailto:{{ $siteSettings->email }}">{{ $siteSettings->email }}</a></p>
            </div>
            @if($siteSettings->map_lat && $siteSettings->map_lng)
                <div class="hero__art">
                    <iframe
                        title="{{ $siteSettings->site_name }} map"
                        src="https://www.google.com/maps?q={{ $siteSettings->map_lat }},{{ $siteSettings->map_lng }}&output=embed"
                        width="100%" height="280" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
