<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class StaticPageController extends Controller
{
    public function privacyPolicy(): View
    {
        $meta_title = 'Privacy Policy | M&H Construction and Design';
        $meta_description = 'Learn how M&H Construction and Design protects your personal data and respects your privacy.';

        return view('privacy-policy', compact('meta_title', 'meta_description'));
    }

    public function termsOfUse(): View
    {
        $meta_title = 'Terms of Use | M&H Construction and Design';
        $meta_description = 'Read the terms and conditions for using the M&H Construction and Design website.';

        return view('terms-of-use', compact('meta_title', 'meta_description'));
    }
}
