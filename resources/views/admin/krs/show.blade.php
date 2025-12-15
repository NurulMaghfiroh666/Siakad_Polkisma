@extends('admin.layouts.app')

@section('title', 'Detail KRS')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('admin.krs.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Detail KRS</h2>
                <p class="text-gray-600 mt-1">{{ $krs->mahasiswa->Nama }} - Semester {{ $krs->semester }}</p>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
        <p class="text-green-700 font-medium">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
        <p class="text-red-700 font-medium">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Info Mahasiswa -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-lg p-6 text-white">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <p class="text-blue-100 text-sm">NIM</p>
                <p class="text-lg font-semibold">{{ $krs->mahasiswa->NIM }}</p>
            </div>
            <div>
                <p class="text-blue-100 text-sm">Nama</p>
                <p class="text-lg font-semibold">{{ $krs->mahasiswa->Nama }}</p>
            </div>
            <div>
                <p class="text-blue-100 text-sm">Semester</p>
                <p class="text-lg font-semibold">{{ $krs->semester }}</p>
            </div>
            <div>
                <p class="text-blue-100 text-sm">Total SKS</p>
                <p class="text-lg font-semibold">{{ $krs->total_sks }} SKS</p>
            </div>
        </div>
    </div>

    <!-- Form Tambah Mata Kuliah -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Mata Kuliah</h3>
        <form action="{{ route('admin.krs.add', $krs->id) }}" method="POST" class="flex gap-4">
            @csrf
            <select name="jadwal_id" required class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach($availableJadwals as $jadwal)
                <option value="{{ $jadwal->IdJadwal }}">
                    {{ $jadwal->matakuliah->KodeMK }} - {{ $jadwal->matakuliah->NamaMK }} 
                    ({{ $jadwal->matakuliah->SKS }} SKS) - {{ $jadwal->dosen->Nama }}
                </option>
                @endforeach
            </select>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Tambah
            </button>
        </form>
    </div>

    <!-- Daftar Mata Kuliah -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
            <h3 class="text-lg font-semibold">Daftar Mata Kuliah</h3>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Kode MK</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama Makul</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">SKS</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Dosen</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Jadwal</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($krs->details as $idx => $detail)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $idx + 1 }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $detail->jadwal->matakuliah->KodeMK }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $detail->jadwal->matakuliah->NamaMK }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                            {{ $detail->jadwal->matakuliah->SKS }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $detail->jadwal->dosen->Nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $detail->jadwal->Hari }}, {{ $detail->jadwal->JamMulai }}-{{ $detail->jadwal->JamSelesai }}
                        <br><span class="text-xs">Ruang: {{ $detail->jadwal->Ruang }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.krs.remove', $detail->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        Belum ada mata kuliah di KRS ini
                    </td>
                </tr>
                @endforelse
            </tbody>
            @if($krs->details->isNotEmpty())
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right font-semibold text-gray-800">Total SKS:</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold">{{ $krs->total_sks }} SKS</span>
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection
