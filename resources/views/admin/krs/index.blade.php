@extends('admin.layouts.app')

@section('title', 'Kelola KRS Mahasiswa')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kelola KRS Mahasiswa</h2>
            <p class="text-gray-600 mt-1">Kelola Kartu Rencana Studi mahasiswa</p>
        </div>
        <a href="{{ route('admin.krs.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Buat KRS Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
        <p class="text-green-700 font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-4">
        <form method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mahasiswa (NIM, Nama)..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cari</button>
            @if(request('search'))
            <a href="{{ route('admin.krs.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Reset</a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-700">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">NIM</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Nama Mahasiswa</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Semester</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase">Total SKS</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($krsList as $idx => $krs)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $krsList->firstItem() + $idx }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $krs->mahasiswa->NIM }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $krs->mahasiswa->Nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $krs->semester }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                            {{ $krs->details->sum(function($d) { return $d->jadwal->matakuliah->SKS ?? 0; }) }} SKS
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('admin.krs.show', $krs->id) }}" class="text-blue-600 hover:text-blue-800" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.krs.destroy', $krs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus KRS ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
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
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Belum ada KRS yang terdaftar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($krsList->hasPages())
    <div class="flex justify-between items-center">
        <div class="text-sm text-gray-600">
            Menampilkan {{ $krsList->firstItem() }} - {{ $krsList->lastItem() }} dari {{ $krsList->total() }} KRS
        </div>
        <div>{{ $krsList->links() }}</div>
    </div>
    @endif
</div>
@endsection
