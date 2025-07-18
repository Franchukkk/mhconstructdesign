<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Додаємо умову is_admin
        if (Auth::attempt(array_merge($credentials, ['is_admin' => true]))) {
            return redirect()->intended('/admin/projects');
        }

        return back()->withErrors([
            'email' => 'Невірний логін або пароль.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
