<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkademikController extends Controller
{
    /**
     * Display KRS (Kartu Rencana Studi) for current semester
     */
    public function krs()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        
        if (!$mahasiswa) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Data mahasiswa tidak ditemukan!');
        }

        // Get KRS untuk semester aktif (misal semester terbaru)
        $krs = Krs::where('IdMahasiswa', $mahasiswa->IdMahasiswa)
            ->with(['details.jadwal.matakuliah', 'details.jadwal.dosen'])
            ->orderBy('semester', 'desc')
            ->first();
        
        return view('mahasiswa.krs', compact('krs', 'mahasiswa'));
    }

    /**
     * Display KHS (Kartu Hasil Studi) for specific semester
     */
    public function khs($semester = null)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        
        if (!$mahasiswa) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Data mahasiswa tidak ditemukan!');
        }

        // Get all semesters
        $allSemesters = Krs::where('IdMahasiswa', $mahasiswa->IdMahasiswa)
            ->orderBy('semester', 'desc')
            ->pluck('semester');
        
        // Default to latest semester if not specified
        if (!$semester && $allSemesters->isNotEmpty()) {
            $semester = $allSemesters->first();
        }

        // Get KRS for selected semester
        $krs = null;
        $ipSemester = 0;
        
        if ($semester) {
            $krs = Krs::where('IdMahasiswa', $mahasiswa->IdMahasiswa)
                ->where('semester', $semester)
                ->with(['details.jadwal.matakuliah', 'details.nilai'])
                ->first();
            
            if ($krs) {
                $ipSemester = $krs->ip_semester;
            }
        }

        // Calculate IPK
        $ipk = $mahasiswa->ipk;
        
        return view('mahasiswa.khs', compact('krs', 'mahasiswa', 'allSemesters', 'semester', 'ipSemester', 'ipk'));
    }
}
