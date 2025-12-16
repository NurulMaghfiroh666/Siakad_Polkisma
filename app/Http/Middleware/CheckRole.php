<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $user = Auth::user();
        
        if ($user->Role !== $role) {
            // Redirect based on actual role
            return match($user->Role) {
                'admin' => redirect()->route('admin.dashboard')->with('error', 'Akses ditolak!'),
                'dosen' => redirect()->route('dosen.dashboard')->with('error', 'Akses ditolak!'),
                'mahasiswa' => redirect()->route('mahasiswa.dashboard')->with('error', 'Akses ditolak!'),
                default => redirect()->route('login')->with('error', 'Role tidak valid!'),
            };
        }

        return $next($request);
    }
}
