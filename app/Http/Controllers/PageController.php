<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Fixed-slug pages (about-us, privacy-policy, terms-condition) each get
     * their own route + method so URLs stay clean, but all three (plus any
     * number of free-form "custom content" SEO pages) share one query and
     * one Blade template — only the `type` column changes what extra block
     * pages/show.blade.php renders (e.g. the org-structure section on about).
     */
    public function about(): View
    {
        return $this->renderBySlug('about-us');
    }

    public function privacy(): View
    {
        return $this->renderBySlug('privacy-policy');
    }

    public function terms(): View
    {
        return $this->renderBySlug('terms-condition');
    }

    public function custom(string $slug): View
    {
        return $this->renderBySlug($slug);
    }

    private function renderBySlug(string $slug): View
    {
        $page = Page::active()->published()->where('slug', $slug)->firstOrFail();

        $breadcrumbs = [
            ['label' => __('nav.home'), 'url' => route('home', ['locale' => app()->getLocale()])],
            ['label' => $page->title, 'url' => null],
        ];

        return view('pages.show', [
            'page' => $page,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
