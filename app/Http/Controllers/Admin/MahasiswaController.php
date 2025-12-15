<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of mahasiswa
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $mahasiswa = Mahasiswa::query()
            ->when($search, function ($query, $search) {
                return $query->where('Nama', 'like', "%{$search}%")
                    ->orWhere('NIM', 'like', "%{$search}%")
                    ->orWhere('Email', 'like', "%{$search}%");
            })
            ->orderBy('Nama', 'asc')
            ->paginate(10);
        
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new mahasiswa
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Store a newly created mahasiswa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NIM' => 'required|unique:mahasiswa,NIM',
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:mahasiswa,Email',
            'NoTelpon' => 'required|string|max:20',
            'TahunMasuk' => 'required|integer|min:2000|max:2100',
            'IdJurusan' => 'required|integer',
        ]);

        DB::beginTransaction();
        try {
            // Create mahasiswa
            $mahasiswa = Mahasiswa::create($validated);

            // Create user account for mahasiswa (using correct column names)
            User::create([
                'IdMahasiswa' => $mahasiswa->IdMahasiswa,
                'Username' => $validated['NIM'], // Username = NIM
                'Password' => Hash::make($validated['NIM']), // Default password is NIM
                'Role' => 'mahasiswa'
            ]);

            DB::commit();
            
            return redirect()->route('admin.mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing mahasiswa
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified mahasiswa
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        $validated = $request->validate([
            'NIM' => 'required|unique:mahasiswa,NIM,' . $id . ',IdMahasiswa',
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:mahasiswa,Email,' . $id . ',IdMahasiswa',
            'NoTelpon' => 'required|string|max:20',
            'TahunMasuk' => 'required|integer|min:2000|max:2100',
            'IdJurusan' => 'required|integer',
        ]);

        DB::beginTransaction();
        try {
            $mahasiswa->update($validated);

            // Update user account if exists (using correct column names)
            if ($mahasiswa->user) {
                $mahasiswa->user->update([
                    'Username' => $validated['NIM'],
                ]);
            }

            DB::commit();
            
            return redirect()->route('admin.mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified mahasiswa
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            
            // Delete user account if exists
            if ($mahasiswa->user) {
                $mahasiswa->user->delete();
            }
            
            $mahasiswa->delete();
            
            DB::commit();
            
            return redirect()->route('admin.mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
