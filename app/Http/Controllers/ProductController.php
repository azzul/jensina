<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::active()->get();

        $products = Product::active()
            ->with('category')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $request->string('category')));
            })
            ->orderBy('sort_order')
            ->paginate(9)
            ->withQueryString();

        $breadcrumbs = [
            ['label' => __('nav.home'), 'url' => localized_route('home')],
            ['label' => __('nav.products'), 'url' => null],
        ];

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'activeCategory' => $request->string('category')->toString(),
            'breadcrumbs' => $breadcrumbs,
            'metaTitle' => __('meta.products_title'),
            'metaDescription' => __('meta.products_description'),
        ]);
    }

    public function show(string $slug): View
    {
        $product = Product::active()
            ->with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Product::active()
            ->where('id', '!=', $product->id)
            ->when($product->category_id, fn ($q) => $q->where('category_id', $product->category_id))
            ->limit(3)
            ->get();

        $breadcrumbs = [
            ['label' => __('nav.home'), 'url' => localized_route('home')],
            ['label' => __('nav.products'), 'url' => localized_route('products.index')],
            ['label' => $product->name, 'url' => null],
        ];

        return view('products.show', [
            'product' => $product,
            'related' => $related,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
