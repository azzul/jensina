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
| ("/en", "/en/produk", "/en/tentang-kami").
|
| IMPORTANT: this is done by registering the SAME set of routes TWICE —
| once unprefixed (id) and once under prefix('en')->name('en.') — rather
| than a single route with an optional {locale?} parameter at the start
| of the URI. An optional parameter followed by required literal segments
| (e.g. "{locale?}/produk") is not reliably matched by Laravel/Symfony's
| route compiler beyond the bare "/" route — that was the cause of every
| Indonesian page except the homepage 404ing. Two plain route
| registrations avoids that edge case entirely and is the standard,
| well-supported pattern for this "default locale unprefixed" scheme.
|
| Route names: Indonesian keeps the plain name ("home", "products.index"),
| English gets an "en." prefix ("en.home", "en.products.index"). Use the
| localized_route() helper (app/Support/helpers.php) everywhere instead of
| route() directly — it picks the right name for the current locale
| automatically.
|--------------------------------------------------------------------------
*/

// Company profile PDF download - locale-agnostic, not a "page" for SEO.
Route::get('/download/company-profile', DownloadController::class . '@companyProfile')
    ->name('download.company-profile');

$registerLocaleRoutes = function () {
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
    Route::get('/artikel/{slug}', [PageController::class, 'custom'])->name('pages.custom');
};

// Indonesian — default, no prefix, no name prefix.
Route::middleware('setlocale:id')->group($registerLocaleRoutes);

// English — /en prefix, "en." name prefix.
Route::prefix('en')->name('en.')->middleware('setlocale:en')->group($registerLocaleRoutes);
