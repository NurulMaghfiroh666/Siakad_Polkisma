@extends('admin.layouts.app')

@section('title', 'Kelola Jadwal')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kelola Jadwal Mata Kuliah</h2>
            <p class="text-gray-600 mt-1">Atur jadwal dan assign dosen</p>
        </div>
        <a href="{{ route('admin.jadwal.create') }}" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 shadow-md hover:shadow-lg transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Jadwal
        </a>
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

    <div class="bg-white rounded-lg shadow-md p-4">
        <form method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mata kuliah atau dosen..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Cari</button>
            @if(request('search'))
            <a href="{{ route('admin.jadwal.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Reset</a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-green-600 to-green-700">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Kode MK</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Mata Kuliah</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase">SKS</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Dosen</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Jadwal</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Ruang</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($jadwals as $idx => $jadwal)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $jadwals->firstItem() + $idx }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $jadwal->matakuliah->KodeMK }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $jadwal->matakuliah->NamaMK }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                            {{ $jadwal->matakuliah->SKS }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $jadwal->dosen->Nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <span class="font-medium">{{ $jadwal->Hari }}</span><br>
                        {{ $jadwal->JamMulai }} - {{ $jadwal->JamSelesai }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $jadwal->Ruang }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('admin.jadwal.edit', $jadwal->IdJadwal) }}" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.jadwal.destroy', $jadwal->IdJadwal) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        Belum ada jadwal yang terdaftar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($jadwals->hasPages())
    <div class="flex justify-between items-center">
        <div class="text-sm text-gray-600">
            Menampilkan {{ $jadwals->firstItem() }} - {{ $jadwals->lastItem() }} dari {{ $jadwals->total() }} jadwal
        </div>
        <div>{{ $jadwals->links() }}</div>
    </div>
    @endif
</div>
@endsection
