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
| Root redirect
|--------------------------------------------------------------------------
| "/" is not a real page — send visitors to their remembered/default
| locale so every real URL always carries a /id or /en prefix (clean for
| hreflang + avoids duplicate-content across two URLs for one page).
*/
Route::get('/', function () {
    return redirect('/' . session('locale', 'id'));
})->name('root');

// Company profile PDF download - locale-agnostic, not a "page" for SEO.
Route::get('/download/company-profile', DownloadController::class . '@companyProfile')
    ->name('download.company-profile');

Route::prefix('{locale}')
    ->where(['locale' => 'id|en'])
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

        // Free-form SEO landing pages, e.g. /id/artikel/jasa-sewa-alat-berat-karanganyar
        Route::get('/artikel/{slug}', [PageController::class, 'custom'])->name('pages.custom');
    });
