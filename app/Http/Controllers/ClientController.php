<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $clients = Client::active()->get();

        $breadcrumbs = [
            ['label' => __('nav.home'), 'url' => localized_route('home')],
            ['label' => __('nav.our_client'), 'url' => null],
        ];

        return view('pages.our-client', [
            'clients' => $clients,
            'breadcrumbs' => $breadcrumbs,
            'metaTitle' => __('meta.clients_title'),
            'metaDescription' => __('meta.clients_description'),
        ]);
    }
}
