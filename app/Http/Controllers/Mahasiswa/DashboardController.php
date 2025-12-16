<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getMahasiswa()
    {
        $user = auth()->user();
        if (!$user->mahasiswa) {
            // Fallback user implementation or redirect if not linked
            return null;
        }
        return $user->mahasiswa;
    }

    public function index()
    {
        $mahasiswa = $this->getMahasiswa();
        
        if (!$mahasiswa) {
            return view('mahasiswa.dashboard', [
                'ipk' => 0.00,
                'totalSks' => 0,
                'semester' => 1,
                'jadwalHariIni' => collect()
            ]);
        }

        // Calculate IPK & Total SKS
        $allKrs = $mahasiswa->krs()->with('details.nilai', 'details.jadwal.matakuliah')->get();
        
        $totalMutu = 0;
        $totalSksLulus = 0;
        $maxSemester = 1;

        foreach ($allKrs as $krs) {
            if ($krs->semester > $maxSemester) {
                $maxSemester = $krs->semester;
            }

            foreach ($krs->details as $detail) {
                if ($detail->nilai) {
                    $sks = $detail->jadwal->matakuliah->SKS ?? 0;
                    $nilaiAngka = $detail->nilai->nilai_angka ?? 0;
                    
                    // Asumsi lulus jika nilai angka > 0 (D atau E mungkin 0/1 depending on logic, adjust as needed)
                    // For now, count all with valid numeric grade
                    if ($nilaiAngka > 0) {
                        $totalMutu += ($nilaiAngka * $sks);
                        $totalSksLulus += $sks;
                    }
                }
            }
        }

        $ipk = $totalSksLulus > 0 ? number_format($totalMutu / $totalSksLulus, 2) : 0.00;

        // Jadwal Hari Ini
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

        // Get active KRS (assuming max semester is current)
        $activeKrs = $mahasiswa->krs()->where('semester', $maxSemester)->first();
        $jadwalHariIni = collect();

        if ($activeKrs) {
            $jadwalHariIni = \App\Models\KrsDetail::where('krs_id', $activeKrs->id)
                ->with(['jadwal.matakuliah', 'jadwal.dosen'])
                ->get()
                ->map(function ($detail) {
                    return $detail->jadwal;
                })
                ->filter(function ($jadwal) use ($hariIni) {
                    return $jadwal && $jadwal->Hari === $hariIni;
                })
                ->sortBy('Jam');
        }

        return view('mahasiswa.dashboard', [
            'ipk' => $ipk,
            'totalSks' => $totalSksLulus,
            'semester' => $maxSemester,
            'jadwalHariIni' => $jadwalHariIni,
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function pesan()
    {
        // Placeholder for messages
        $messages = [];
        return view('mahasiswa.pesan', compact('messages'));
    }

    public function jadwal()
    {
        $mahasiswa = $this->getMahasiswa();
        if (!$mahasiswa) return redirect()->route('login');

        // Get active KRS
        $activeKrs = $mahasiswa->krs()->orderBy('semester', 'desc')->first();
        $jadwal = collect();

        if ($activeKrs) {
            $jadwal = \App\Models\KrsDetail::where('krs_id', $activeKrs->id)
                ->with(['jadwal.matakuliah', 'jadwal.dosen'])
                ->get()
                ->map(function ($detail) {
                    return $detail->jadwal;
                })
                ->sort(function ($a, $b) {
                    $days = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];
                    $dayA = $days[$a->Hari] ?? 8;
                    $dayB = $days[$b->Hari] ?? 8;
                    
                    if ($dayA === $dayB) {
                        return strcmp($a->Jam, $b->Jam);
                    }
                    return $dayA <=> $dayB;
                });
        }

        return view('mahasiswa.jadwal', compact('jadwal'));
    }

    public function matakuliah()
    {
        $mahasiswa = $this->getMahasiswa();
        if (!$mahasiswa) return redirect()->route('login');

        // Get currently taken courses (from active KRS)
        $activeKrs = $mahasiswa->krs()->orderBy('semester', 'desc')->first();
        $matakuliah = collect();

        if ($activeKrs) {
            $matakuliah = \App\Models\KrsDetail::where('krs_id', $activeKrs->id)
                ->with(['jadwal.matakuliah'])
                ->get()
                ->map(function ($detail) {
                    return $detail->jadwal->matakuliah;
                })
                ->unique('KodeMK');
        }

        return view('mahasiswa.mata-kuliah', compact('matakuliah'));
    }

    public function akademik()
    {
        $mahasiswa = $this->getMahasiswa();
        if (!$mahasiswa) return redirect()->route('login');

        // KRS Data (Active Semester) - Get jadwal items directly
        $activeKrs = $mahasiswa->krs()->orderBy('semester', 'desc')->first();
        $krs = collect(); // Empty collection by default
        
        if ($activeKrs) {
            $krs = \App\Models\KrsDetail::where('krs_id', $activeKrs->id)
                ->with(['jadwal.matakuliah', 'jadwal.dosen'])
                ->get()
                ->map(function($detail) {
                    // Map to match view expectations
                    return (object) [
                        'KodeMK' => $detail->jadwal->matakuliah->KodeMK ?? '-',
                        'matakuliah' => (object) [
                            'Nama' => $detail->jadwal->matakuliah->NamaMK ?? '-',
                            'SKS' => $detail->jadwal->matakuliah->SKS ?? 0,
                        ],
                        'Kelas' => $detail->jadwal->Kelas ?? '-',
                        'dosen' => (object) [
                            'Nama' => $detail->jadwal->dosen->Nama ?? '-',
                        ],
                    ];
                });
        }

        // KHS Data - Not yet implemented
        $khs = collect();

        return view('mahasiswa.akademik', compact('krs', 'khs'));
    }

    public function biodata()
    {
        $mahasiswa = $this->getMahasiswa();
        if (!$mahasiswa) {
            // Fallback for demo if not logged in correctly
            $mahasiswa = new \stdClass();
            $mahasiswa->Nama = auth()->user()->name ?? 'Mahasiswa';
            $mahasiswa->NIM = auth()->user()->login_id ?? '00000000';
        }
        
        return view('mahasiswa.biodata', compact('mahasiswa'));
    }
}
