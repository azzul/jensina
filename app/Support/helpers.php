<?php

use Illuminate\Support\Facades\App;

if (! function_exists('localized_route')) {
    /**
     * Build a URL for a named route under the "id has no prefix, en is
     * prefixed with /en" locale scheme, so callers never have to remember
     * to add or drop the `locale` route parameter by hand — pass it the
     * route name and any OTHER parameters, and it figures out the locale
     * segment from the current (or given) locale automatically.
     */
    function localized_route(string $name, array $parameters = [], ?string $locale = null): string
    {
        $locale = $locale ?? App::getLocale();

        if ($locale === 'en') {
            $parameters['locale'] = 'en';
        } else {
            unset($parameters['locale']);
        }

        return route($name, $parameters);
    }
}
