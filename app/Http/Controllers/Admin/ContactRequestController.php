<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ContactRequestController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(Response::HTTP_FORBIDDEN, 'Access denied');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $requests = ContactRequest::orderByDesc('created_at')->paginate(10);
        return view('admin.requests.index', compact('requests'));
    }

    public function clear()
    {
        $this->checkAdmin();
        ContactRequest::truncate();
        return redirect()->route('admin.requests.index')
            ->with('success', 'Всі заявки успішно видалені');
    }

}