<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('auth.admin-login');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['Username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            
            if ($user->Role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('admin/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun ini bukan akun Admin.',
                ]);
            }
        }

        return back()->withErrors([
            'username' => 'Username atau Password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
