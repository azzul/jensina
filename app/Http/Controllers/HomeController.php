<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::active()->get();

        $featuredProducts = Product::active()
            ->featured()
            ->with('category')
            ->limit(6)
            ->get();

        $clients = Client::active()->limit(12)->get();

        return view('home.index', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'clients' => $clients,
        ]);
    }
}
