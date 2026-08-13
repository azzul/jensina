<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public const SUPPORTED = ['id', 'en'];

    /**
     * Indonesian has NO url prefix (it's the default) — "/", "/produk",
     * "/tentang-kami". English is prefixed — "/en", "/en/produk". The
     * {locale?} route parameter therefore only ever carries "en" (see the
     * `where` constraint in routes/web.php); anything else means the
     * segment wasn't present at all, so we're on the Indonesian route.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale') === 'en' ? 'en' : 'id';

        app()->setLocale($locale);

        return $next($request);
    }
}
