<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Http;

class ContactRequestController extends Controller
{
    public function index()
    {
        $meta_title = 'Contact Us | M&H Construction and Design';
        $meta_description = 'Get in touch with M&H Construction and Design for your custom design, construction, and renovation needs. We are here to help you bring your vision to life.';

        return view('contact-request', compact('meta_title', 'meta_description'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'how_heard' => 'nullable|string|max:255',
            'services_selected' => 'nullable|array',
            'services_selected.*' => 'string|max:255',
            'project_details' => 'nullable|string',
            'timeframe_flexibility' => 'nullable|string|max:255',
            'design_style_description' => 'nullable|string|max:255',
            'gclid' => 'nullable|string|max:255',
            'client_id' => 'nullable|string|max:255',
            'referrer' => 'nullable|string|max:2048',
            'page_url' => 'nullable|string|max:2048',
        ]);


        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        ContactRequest::create($validated);

        return redirect()->back()->with('success', 'Your request has been successfully sent!');
    }

}
