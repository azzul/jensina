<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public const SUPPORTED = ['id', 'en'];

    /**
     * The locale is now passed as a static middleware parameter from
     * routes/web.php ("setlocale:id" / "setlocale:en") rather than read
     * from a route segment — each locale's routes are registered
     * separately (see routes/web.php), so there's no ambiguity to resolve
     * at request time.
     */
    public function handle(Request $request, Closure $next, string $locale = 'id'): Response
    {
        app()->setLocale(in_array($locale, self::SUPPORTED, true) ? $locale : 'id');

        return $next($request);
    }
}
