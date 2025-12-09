<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login_id' => ['required'],
            'password' => ['required'],
            'role' => ['required', 'in:dosen,mahasiswa'],
        ]);

        $user = null;

        if ($request->role === 'dosen') {
            $dosen = \App\Models\Dosen::where('NIP', $request->login_id)->first();
            if ($dosen) {
                $user = $dosen->user;
            }
        } elseif ($request->role === 'mahasiswa') {
            $mahasiswa = \App\Models\Mahasiswa::where('NIM', $request->login_id)->first();
            if ($mahasiswa) {
                $user = $mahasiswa->user;
            }
        }

        if ($user && Auth::attempt(['Username' => $user->Username, 'password' => $request->password])) {
            $request->session()->regenerate();

            if ($user->Role === 'dosen') {
                return redirect()->intended('dosen/dashboard');
            } elseif ($user->Role === 'mahasiswa') {
                return redirect()->intended('mahasiswa/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login_id' => 'NIP/NIM atau Kata Sandi salah.',
        ])->onlyInput('login_id', 'role');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
