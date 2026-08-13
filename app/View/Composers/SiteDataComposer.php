<?php

namespace App\View\Composers;

use App\Http\Middleware\SetLocale;
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

        // Swap only the leading /{locale} segment so "switch language" keeps
        // the visitor on the exact same page (needed for hreflang + UX).
        $segments = explode('/', trim(Request::path(), '/'));
        if (! in_array($segments[0] ?? null, SetLocale::SUPPORTED, true)) {
            array_unshift($segments, $currentLocale);
        }

        $localeUrls = [];
        foreach (SetLocale::SUPPORTED as $locale) {
            $swapped = $segments;
            $swapped[0] = $locale;
            $localeUrls[$locale] = url(implode('/', $swapped));
        }

        $view->with([
            'siteSettings' => $settings,
            'currentLocale' => $currentLocale,
            'otherLocale' => $otherLocale,
            'localeUrls' => $localeUrls,
            'alternateLocaleUrl' => $localeUrls[$otherLocale],
        ]);
    }
}
