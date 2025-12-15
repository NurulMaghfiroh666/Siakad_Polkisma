<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    /**
     * Display a listing of dosen
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $dosen = Dosen::query()
            ->when($search, function ($query, $search) {
                return $query->where('Nama', 'like', "%{$search}%")
                    ->orWhere('NIP', 'like', "%{$search}%")
                    ->orWhere('Email', 'like', "%{$search}%");
            })
            ->orderBy('Nama', 'asc')
            ->paginate(10);
        
        return view('admin.dosen.index', compact('dosen'));
    }

    /**
     * Show the form for creating a new dosen
     */
    public function create()
    {
        return view('admin.dosen.create');
    }

    /**
     * Store a newly created dosen
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NIP' => 'required|unique:dosen,NIP',
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:dosen,Email',
            'NoTelpon' => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            // Create dosen
            $dosen = Dosen::create($validated);

            // Create user account for dosen (using correct column names)
            User::create([
                'IdDosen' => $dosen->IdDosen,
                'Username' => $validated['NIP'], // Username = NIP
                'Password' => Hash::make($validated['NIP']), // Default password is NIP
                'Role' => 'dosen'
            ]);

            DB::commit();
            
            return redirect()->route('admin.dosen.index')
                ->with('success', 'Data dosen berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing dosen
     */
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified dosen
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        
        $validated = $request->validate([
            'NIP' => 'required|unique:dosen,NIP,' . $id . ',IdDosen',
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:dosen,Email,' . $id . ',IdDosen',
            'NoTelpon' => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            $dosen->update($validated);

            // Update user account if exists (using correct column names)
            if ($dosen->user) {
                $dosen->user->update([
                    'Username' => $validated['NIP'],
                ]);
            }

            DB::commit();
            
            return redirect()->route('admin.dosen.index')
                ->with('success', 'Data dosen berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified dosen
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $dosen = Dosen::findOrFail($id);
            
            // Delete user account if exists
            if ($dosen->user) {
                $dosen->user->delete();
            }
            
            $dosen->delete();
            
            DB::commit();
            
            return redirect()->route('admin.dosen.index')
                ->with('success', 'Data dosen berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
