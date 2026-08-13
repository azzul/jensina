<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $breadcrumbs = [
            ['label' => __('nav.home'), 'url' => route('home', ['locale' => app()->getLocale()])],
            ['label' => __('nav.contact'), 'url' => null],
        ];

        return view('pages.contact', [
            'breadcrumbs' => $breadcrumbs,
            'metaTitle' => __('meta.contact_title'),
            'metaDescription' => __('meta.contact_description'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
            // Honeypot: real users never fill this, bots usually do.
            'website' => ['prohibited'],
        ]);

        ContactMessage::create([
            ...collect($validated)->except('website')->toArray(),
            'locale' => app()->getLocale(),
            'ip_address' => $request->ip(),
        ]);

        return back()->with('status', __('contact.success'));
    }
}
