<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    // List semua jadwal
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $jadwals = Jadwal::with(['matakuliah', 'dosen'])
            ->when($search, function($query) use ($search) {
                $query->whereHas('matakuliah', function($q) use ($search) {
                    $q->where('NamaMK', 'like', "%{$search}%")
                      ->orWhere('KodeMK', 'like', "%{$search}%");
                })->orWhereHas('dosen', function($q) use ($search) {
                    $q->where('Nama', 'like', "%{$search}%");
                });
            })
            ->orderBy('Hari')
            ->paginate(15);
        
        return view('admin.jadwal.index', compact('jadwals'));
    }

    // Form tambah jadwal baru
    public function create()
    {
        $matakuliahs = Matakuliah::orderBy('NamaMK')->get();
        $dosens = Dosen::orderBy('Nama')->get();
        
        return view('admin.jadwal.create', compact('matakuliahs', 'dosens'));
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'KodeMK' => 'required|exists:matakuliah,KodeMK',
            'IdDosen' => 'required|exists:dosen,IdDosen',
            'Hari' => 'required|string',
            'JamMulai' => 'required',
            'JamSelesai' => 'required',
            'Ruang' => 'required|string|max:50',
        ]);

        Jadwal::create($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // Form edit jadwal
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $matakuliahs = Matakuliah::orderBy('NamaMK')->get();
        $dosens = Dosen::orderBy('Nama')->get();
        
        return view('admin.jadwal.edit', compact('jadwal', 'matakuliahs', 'dosens'));
    }

    // Update jadwal
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        
        $validated = $request->validate([
            'KodeMK' => 'required|exists:matakuliah,KodeMK',
            'IdDosen' => 'required|exists:dosen,IdDosen',
            'Hari' => 'required|string',
            'JamMulai' => 'required',
            'JamSelesai' => 'required',
            'Ruang' => 'required|string|max:50',
        ]);

        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diupdate!');
    }

    // Hapus jadwal
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        
        // Check if jadwal is used in KRS
        if ($jadwal->krsDetails()->exists()) {
            return redirect()->back()
                ->with('error', 'Jadwal tidak bisa dihapus karena sudah digunakan di KRS mahasiswa!');
        }
        
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}
