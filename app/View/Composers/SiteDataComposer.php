<?php

namespace App\View\Composers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class SiteDataComposer
{
    public function compose(View $view): void
    {
        $settings = SiteSetting::current();
        $currentLocale = app()->getLocale();
        $otherLocale = $currentLocale === 'id' ? 'en' : 'id';

        $localeUrls = [
            'id' => $this->urlFor('id'),
            'en' => $this->urlFor('en'),
        ];

        $view->with([
            'siteSettings' => $settings,
            'currentLocale' => $currentLocale,
            'otherLocale' => $otherLocale,
            'localeUrls' => $localeUrls,
            'alternateLocaleUrl' => $localeUrls[$otherLocale],
        ]);
    }

    /**
     * Build the equivalent URL for a given locale on the CURRENT page, by
     * taking the current route's name (stripping the "en." prefix if
     * present) and current route + query parameters, then regenerating the
     * URL under the target locale's route name. Far more reliable than
     * string-manipulating the current URL, and it's what powers both the
     * hreflang tags and the header's ID/EN language switch links.
     */
    private function urlFor(string $locale): string
    {
        $routeName = Route::currentRouteName();

        if (! $routeName) {
            // No matched route (e.g. a 404 page) — fall back to that
            // locale's homepage rather than erroring.
            return $locale === 'en' ? route('en.home') : route('home');
        }

        $baseName = str_starts_with($routeName, 'en.') ? substr($routeName, 3) : $routeName;
        $targetName = $locale === 'en' ? 'en.' . $baseName : $baseName;

        $params = array_merge(
            request()->route()?->parameters() ?? [],
            request()->query()
        );

        return route($targetName, $params);
    }
}
