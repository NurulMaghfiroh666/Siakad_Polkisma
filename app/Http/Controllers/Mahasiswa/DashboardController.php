<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // TODO: Get real data from database
        $ipk = 3.75;
        $totalSks = 120;
        $semester = 5;
        $jadwalHariIni = collect();
        
        return view('mahasiswa.dashboard', compact('ipk', 'totalSks', 'semester', 'jadwalHariIni'));
    }

    public function pesan()
    {
        // TODO: Implement message functionality
        $messages = [];
        
        return view('mahasiswa.pesan', compact('messages'));
    }

    public function jadwal()
    {
        // TODO: Get real jadwal from database
        $jadwal = collect();
        
        return view('mahasiswa.jadwal', compact('jadwal'));
    }

    public function matakuliah()
    {
        // TODO: Get real matakuliah from database
        $matakuliah = collect();
        
        return view('mahasiswa.mata-kuliah', compact('matakuliah'));
    }

    public function akademik()
    {
        // TODO: Get real KRS and KHS from database
        $krs = collect();
        $khs = collect();
        
        return view('mahasiswa.akademik', compact('krs', 'khs'));
    }

    public function biodata()
    {
        $user = auth()->user();
        
        // TODO: Get real mahasiswa data from database
        $mahasiswa = new \stdClass();
        $mahasiswa->name = $user->name;
        $mahasiswa->nim = $user->login_id;
        
        return view('mahasiswa.biodata', compact('mahasiswa'));
    }
}
