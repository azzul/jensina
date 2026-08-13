<?php

namespace App\View\Composers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class SiteDataComposer
{
    public function compose(View $view): void
    {
        $settings = SiteSetting::current();
        $currentLocale = app()->getLocale();
        $otherLocale = $currentLocale === 'id' ? 'en' : 'id';

        // Indonesian has no url segment, English is prefixed with "en" —
        // strip a leading "en" if present to get the locale-agnostic rest
        // of the path, then rebuild both versions from that.
        $path = trim(Request::path(), '/');
        $segments = $path === '' ? [] : explode('/', $path);

        if (($segments[0] ?? null) === 'en') {
            $rest = array_slice($segments, 1);
        } else {
            $rest = $segments;
        }

        $idPath = implode('/', $rest);
        $enPath = implode('/', array_merge(['en'], $rest));

        $localeUrls = [
            'id' => rtrim(url($idPath), '/') ?: url('/'),
            'en' => url($enPath),
        ];

        $view->with([
            'siteSettings' => $settings,
            'currentLocale' => $currentLocale,
            'otherLocale' => $otherLocale,
            'localeUrls' => $localeUrls,
            'alternateLocaleUrl' => $localeUrls[$otherLocale],
        ]);
    }
}
