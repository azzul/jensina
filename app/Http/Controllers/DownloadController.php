<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function companyProfile(): StreamedResponse|RedirectResponse
    {
        $path = SiteSetting::current()->company_profile_pdf;

        if (! $path || ! Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->download($path, 'Company-Profile-Jensina-Group.pdf');
    }
}
