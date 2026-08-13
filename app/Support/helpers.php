<?php

use Illuminate\Support\Facades\App;

if (! function_exists('localized_route')) {
    /**
     * Build a URL for a named route under the "id has no prefix, en is
     * prefixed with /en" locale scheme. Indonesian routes keep their plain
     * name ("home", "products.index"); English routes are registered with
     * an "en." name prefix ("en.home", "en.products.index") — see
     * routes/web.php. This helper picks the right one automatically so
     * callers never have to remember the naming convention.
     */
    function localized_route(string $name, array $parameters = [], ?string $locale = null): string
    {
        $locale = $locale ?? App::getLocale();
        $routeName = $locale === 'en' ? 'en.' . $name : $name;

        return route($routeName, $parameters);
    }
}
