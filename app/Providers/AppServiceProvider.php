<?php

namespace App\Providers;

use App\View\Composers\SiteDataComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once app_path('Support/helpers.php');
    }

    public function boot(): void
    {
        // Shares $siteSettings / $currentLocale / $otherLocale / $localeUrls /
        // $alternateLocaleUrl with EVERY view, not just layouts.app.
        //
        // Why '*' and not 'layouts.app': with @extends, Blade renders the
        // CHILD view (e.g. home.index) first to build the @section content,
        // and only that child view instance gets the composed data — the
        // parent layout composer never fires for variables used inside a
        // @section block. Composing on 'layouts.app' alone left
        // $currentLocale undefined in every page that uses it inside
        // @section('content'). Wildcard composition fixes that everywhere
        // at once instead of listing every view name here.
        View::composer('*', SiteDataComposer::class);
    }
}
