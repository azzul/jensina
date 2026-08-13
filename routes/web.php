<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Locale scheme: Indonesian is the default and carries NO url prefix
| ("/", "/produk", "/tentang-kami"); English is prefixed with /en
| ("/en", "/en/produk", "/en/tentang-kami"). This is done with a single
| OPTIONAL {locale?} route parameter constrained to only ever match the
| literal "en" — when the first path segment isn't "en", the parameter is
| simply skipped and the route matches straight through as Indonesian.
| One route definition therefore serves both locales; no routes are
| duplicated. See app/Http/Middleware/SetLocale.php for how the parameter
| is turned into app()->setLocale(), and localized_route() (in
| app/Support/helpers.php) for building links that respect this scheme
| from controllers and Blade views.
|--------------------------------------------------------------------------
*/

// Company profile PDF download - locale-agnostic, not a "page" for SEO.
Route::get('/download/company-profile', DownloadController::class . '@companyProfile')
    ->name('download.company-profile');

Route::prefix('{locale?}')
    ->where(['locale' => 'en'])
    ->middleware('setlocale')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
        Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

        Route::get('/tentang-kami', [PageController::class, 'about'])->name('pages.about');
        Route::get('/klien-kami', [ClientController::class, 'index'])->name('pages.our-client');

        Route::get('/kontak', [ContactController::class, 'index'])->name('pages.contact');
        Route::post('/kontak', [ContactController::class, 'store'])->name('pages.contact.store');

        Route::get('/kebijakan-privasi', [PageController::class, 'privacy'])->name('pages.privacy');
        Route::get('/syarat-ketentuan', [PageController::class, 'terms'])->name('pages.terms');

        // Free-form SEO landing pages, e.g. /artikel/jasa-sewa-alat-berat-karanganyar
        // or /en/artikel/jasa-sewa-alat-berat-karanganyar
        Route::get('/artikel/{slug}', [PageController::class, 'custom'])->name('pages.custom');
    });
