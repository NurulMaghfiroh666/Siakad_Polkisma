<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of mata kuliah
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $matakuliah = Matakuliah::query()
            ->when($search, function ($query, $search) {
                return $query->where('NamaMK', 'like', "%{$search}%")
                    ->orWhere('KodeMK', 'like', "%{$search}%");
            })
            ->orderBy('KodeMK', 'asc')
            ->paginate(15);
        
        return view('admin.matakuliah.index', compact('matakuliah'));
    }

    /**
     * Show the form for creating a new mata kuliah
     */
    public function create()
    {
        return view('admin.matakuliah.create');
    }

    /**
     * Store a newly created mata kuliah
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'KodeMK' => 'required|unique:matakuliah,KodeMK|max:20',
            'NamaMK' => 'required|string|max:255',
            'SKS' => 'required|integer|min:1|max:6',
            'IdJurusan' => 'required|integer',
        ]);

        Matakuliah::create($validated);
        
        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    /**
     * Show the form for editing mata kuliah
     */
    public function edit($kodeMK)
    {
        $matakuliah = Matakuliah::where('KodeMK', $kodeMK)->firstOrFail();
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    /**
     * Update the specified mata kuliah
     */
    public function update(Request $request, $kodeMK)
    {
        $matakuliah = Matakuliah::where('KodeMK', $kodeMK)->firstOrFail();
        
        $validated = $request->validate([
            'KodeMK' => 'required|max:20|unique:matakuliah,KodeMK,' . $kodeMK . ',KodeMK',
            'NamaMK' => 'required|string|max:255',
            'SKS' => 'required|integer|min:1|max:6',
            'IdJurusan' => 'required|integer',
        ]);

        $matakuliah->update($validated);
        
        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil diupdate!');
    }

    /**
     * Remove the specified mata kuliah
     */
    public function destroy($kodeMK)
    {
        try {
            $matakuliah = Matakuliah::where('KodeMK', $kodeMK)->firstOrFail();
            $matakuliah->delete();
            
            return redirect()->route('admin.matakuliah.index')
                ->with('success', 'Mata kuliah berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus mata kuliah. Mungkin masih digunakan di jadwal atau KRS.');
        }
    }
}
