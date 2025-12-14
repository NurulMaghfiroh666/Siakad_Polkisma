<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $dosen = $user->dosen;

        if (!$dosen) {
            // Fallback if user is not linked to a Dosen record yet, for safety
            return view('dosen.dashboard', [
                'totalMatakuliah' => 0,
                'jadwalHariIni' => collect(),
                'semuaJadwal' => collect(),
                'user' => $user
            ]);
        }

        // Mapping Days
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        $hariIni = $days[date('l')];

        // Total Matakuliah (Unique subjects taught)
        $totalMatakuliah = \App\Models\Jadwal::where('IdDosen', $dosen->IdDosen)
            ->distinct('KodeMK')
            ->count('KodeMK');

        // Jadwal Hari Ini
        $jadwalHariIni = \App\Models\Jadwal::with('matakuliah')
            ->where('IdDosen', $dosen->IdDosen)
            ->where('Hari', $hariIni)
            ->orderBy('Jam', 'asc')
            ->get();

        // Semua Jadwal
        $semuaJadwal = \App\Models\Jadwal::with('matakuliah')
            ->where('IdDosen', $dosen->IdDosen)
            ->get()
            ->sort(function ($a, $b) {
                $days = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];
                $dayA = $days[$a->Hari] ?? 8;
                $dayB = $days[$b->Hari] ?? 8;
                
                if ($dayA === $dayB) {
                    return strcmp($a->Jam, $b->Jam);
                }
                return $dayA <=> $dayB;
            });

        return view('dosen.dashboard', compact('user', 'dosen', 'totalMatakuliah', 'jadwalHariIni', 'semuaJadwal'));
    }

    public function pesan()
    {
        // TODO: Implement message functionality
        $messages = [];
        
        return view('dosen.pesan', compact('messages'));
    }

    public function jadwal()
    {
        $user = auth()->user();
        $dosen = $user->dosen;
        
        if (!$dosen) {
            return view('dosen.jadwal-mengajar', ['jadwal' => collect()]);
        }

        $jadwal = \App\Models\Jadwal::with('matakuliah')
            ->where('IdDosen', $dosen->IdDosen)
            ->get()
            ->sort(function ($a, $b) {
                $days = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];
                $dayA = $days[$a->Hari] ?? 8;
                $dayB = $days[$b->Hari] ?? 8;
                
                if ($dayA === $dayB) {
                    return strcmp($a->Jam, $b->Jam);
                }
                return $dayA <=> $dayB;
            });

        return view('dosen.jadwal-mengajar', compact('jadwal'));
    }

    public function matakuliah()
    {
        $user = auth()->user();
        $dosen = $user->dosen;
        
        if (!$dosen) {
            return view('dosen.mata-kuliah', ['matakuliah' => collect()]);
        }

        // Get unique matakuliah from jadwal
        $matakuliah = \App\Models\Jadwal::with('matakuliah')
            ->where('IdDosen', $dosen->IdDosen)
            ->get()
            ->unique('KodeMK')
            ->map(function ($jadwal) {
                return $jadwal->matakuliah;
            })
            ->filter();

        return view('dosen.mata-kuliah', compact('matakuliah'));
    }

    public function biodata()
    {
        $user = auth()->user();
        $dosen = $user->dosen;
        
        if (!$dosen) {
            $dosen = new \App\Models\Dosen();
            $dosen->Nama = $user->name;
            $dosen->NIP = $user->login_id;
        }

        return view('dosen.biodata', compact('dosen'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $dosen = $user->dosen;

        return view('dosen.edit-profile', compact('dosen'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $dosen = $user->dosen;

        // Update Dosen table
        if ($dosen) {
            $dosen->Email = $request->email;
            $dosen->Telepon = $request->telepon;
            $dosen->Alamat = $request->alamat;
            $dosen->save();
        }

        // Update User table email if needed
        $user->email = $request->email;
        $user->save();

        return redirect()->route('dosen.biodata')->with('success', 'Profil berhasil diperbarui.');
    }

    public function editPassword()
    {
        return view('dosen.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return redirect()->route('dosen.biodata')->with('success', 'Password berhasil diperbarui.');
    }
}

