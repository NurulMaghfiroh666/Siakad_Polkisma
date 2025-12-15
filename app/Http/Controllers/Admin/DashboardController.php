<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matakuliah;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMatakuliah = Matakuliah::count();

        return view('admin.dashboard', compact('totalMahasiswa', 'totalDosen', 'totalMatakuliah'));
    }
}
