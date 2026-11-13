<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Render the single-page portfolio with all sections.
     */
    public function index(): View
    {
        $portfolio = config('portfolio');
        $resumePath = public_path($portfolio['resume_pdf']);

        return view('home', [
            'portfolio' => $portfolio,
            'resumeAvailable' => File::isFile($resumePath),
            'recaptchaSiteKey' => (string) config('services.recaptcha.site_key', ''),
        ]);
    }
}
