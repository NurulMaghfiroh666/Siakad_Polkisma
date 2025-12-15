<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Mahasiswa;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

class KrsController extends Controller
{
    // List KRS untuk semua mahasiswa
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $krsList = Krs::with(['mahasiswa', 'details.jadwal.matakuliah'])
            ->when($search, function($query) use ($search) {
                $query->whereHas('mahasiswa', function($q) use ($search) {
                    $q->where('NIM', 'like', "%{$search}%")
                      ->orWhere('Nama', 'like', "%{$search}%");
                });
            })
            ->orderBy('semester', 'desc')
            ->paginate(15);
        
        return view('admin.krs.index', compact('krsList'));
    }

    // Tampilkan detail KRS mahasiswa per semester
    public function show($krsId)
    {
        $krs = Krs::with(['mahasiswa', 'details.jadwal.matakuliah', 'details.jadwal.dosen'])
            ->findOrFail($krsId);
        
        // Get all available jadwal untuk ditambahkan
        $availableJadwals = Jadwal::with(['matakuliah', 'dosen'])
            ->whereNotIn('IdJadwal', $krs->details->pluck('jadwal_id'))
            ->get();
        
        return view('admin.krs.show', compact('krs', 'availableJadwals'));
    }

    // Tambah KRS baru untuk mahasiswa
    public function create()
    {
        $mahasiswas = Mahasiswa::orderBy('Nama')->get();
        return view('admin.krs.create', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'IdMahasiswa' => 'required|exists:mahasiswa,IdMahasiswa',
            'semester' => 'required|string|max:20',
        ]);

        $krs = Krs::create($validated);

        return redirect()->route('admin.krs.show', $krs->id)
            ->with('success', 'KRS berhasil dibuat!');
    }

    // Tambah mata kuliah ke KRS
    public function addMatakuliah(Request $request, $krsId)
    {
        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwal,IdJadwal',
        ]);

        $krs = Krs::findOrFail($krsId);

        // Check if already exists
        $exists = KrsDetail::where('krs_id', $krsId)
            ->where('jadwal_id', $validated['jadwal_id'])
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Mata kuliah sudah ada di KRS ini!');
        }

        KrsDetail::create([
            'krs_id' => $krsId,
            'jadwal_id' => $validated['jadwal_id'],
        ]);

        return redirect()->back()
            ->with('success', 'Mata kuliah berhasil ditambahkan ke KRS!');
    }

    // Hapus mata kuliah dari KRS
    public function removeMatakuliah($krsDetailId)
    {
        $detail = KrsDetail::findOrFail($krsDetailId);
        $detail->delete();

        return redirect()->back()
            ->with('success', 'Mata kuliah berhasil dihapus dari KRS!');
    }

    // Hapus KRS
    public function destroy($krsId)
    {
        $krs = Krs::findOrFail($krsId);
        $krs->details()->delete(); // Delete all details first
        $krs->delete();

        return redirect()->route('admin.krs.index')
            ->with('success', 'KRS berhasil dihapus!');
    }
}
