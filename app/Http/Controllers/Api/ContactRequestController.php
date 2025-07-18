<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactRequest;

class ContactRequestController extends Controller
{
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
            'gclid' => 'nullable|string|max:255',
            'client_id' => 'nullable|string|max:255',
            'referrer' => 'nullable|string|max:2048',
            'page_url' => 'nullable|string|max:2048',
        ]);

        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        $contact = ContactRequest::create($validated);

        return response()->json([
            'message' => 'Contact request saved successfully',
            'data' => $contact
        ], 201);
    }

}
