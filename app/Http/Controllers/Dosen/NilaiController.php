<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\KrsDetail;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Display list of mata kuliah yang diampu dosen
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu!');
        }
        
        $dosen = $user->dosen;
        
        if (!$dosen) {
            return redirect()->route('login')
                ->with('error', 'Akses ditolak! Anda bukan dosen.');
        }

        // Get jadwal/mata kuliah yang diampu dosen ini
        $jadwals = Jadwal::where('IdDosen', $dosen->IdDosen)
            ->with('matakuliah')
            ->get();
        
        return view('dosen.inputnilai', compact('jadwals'));
    }

    /**
     * Show mahasiswa in specific mata kuliah for grade input
     */
    public function show($jadwalId)
    {
        $user = Auth::user();
        $dosen = $user->dosen;
        
        $jadwal = Jadwal::with('matakuliah')
            ->where('IdJadwal', $jadwalId)
            ->where('IdDosen', $dosen->IdDosen)
            ->firstOrFail();

        // Get mahasiswa yang mengambil mata kuliah ini
        $krsDetails = KrsDetail::where('jadwal_id', $jadwalId)
            ->with(['krs.mahasiswa', 'nilai'])
            ->get();
        
        return view('dosen.daftar-mahasiswa-nilai', compact('jadwal', 'krsDetails'));
    }

    /**
     * Store or update nilai for students
     */
    public function store(\App\Http\Requests\StoreNilaiRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            foreach ($validated['nilai'] as $nilaiData) {
                $krsDetailId = $nilaiData['krs_detail_id'];
                $nilaiAngka = $nilaiData['nilai_angka'] ?? null;
                
                if ($nilaiAngka !== null) {
                    // Convert to huruf
                    $nilaiHuruf = Nilai::nilaiToHuruf($nilaiAngka);
                    
                    // Update or create nilai
                    Nilai::updateOrCreate(
                        ['krs_detail_id' => $krsDetailId],
                        [
                            'nilai_angka' => $nilaiAngka,
                            'nilai_huruf' => $nilaiHuruf
                        ]
                    );
                }
            }

            DB::commit();
            
            return redirect()->back()
                ->with('success', 'Nilai berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
