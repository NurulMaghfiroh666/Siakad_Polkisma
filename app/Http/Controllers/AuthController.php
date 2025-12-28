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
            // Try to find dosen by NIP first
            $dosen = \App\Models\Dosen::where('NIP', $request->login_id)->first();
            if ($dosen) {
                $user = $dosen->user;
            }
            
            // If not found by NIP, try by Username
            if (!$user) {
                $user = \App\Models\User::where('Username', $request->login_id)
                    ->where('Role', 'dosen')
                    ->first();
            }
        } elseif ($request->role === 'mahasiswa') {
            // Try to find mahasiswa by NIM first
            $mahasiswa = \App\Models\Mahasiswa::where('NIM', $request->login_id)->first();
            if ($mahasiswa) {
                $user = $mahasiswa->user;
            }
            
            // If not found by NIM, try by Username
            if (!$user) {
                $user = \App\Models\User::where('Username', $request->login_id)
                    ->where('Role', 'mahasiswa')
                    ->first();
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
            'login_id' => 'NIP/NIM/Username atau Kata Sandi salah.',
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
