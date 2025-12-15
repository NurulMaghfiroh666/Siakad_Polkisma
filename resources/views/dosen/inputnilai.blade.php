@extends('layouts.dosen')

@section('title', 'Input Nilai')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Input Nilai Mahasiswa</h2>
        <p class="text-gray-600 mt-1">Pilih mata kuliah untuk menginput nilai mahasiswa</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
        <div class="flex">
            <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p class="text-green-700 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jadwals as $jadwal)
        <a href="{{ route('dosen.nilai.show', $jadwal->IdJadwal) }}" 
           class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-200 border-l-4 border-blue-500 group">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition">
                        {{ $jadwal->matakuliah->NamaMK ?? 'Mata Kuliah' }}
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Kode: {{ $jadwal->matakuliah->KodeMK ?? '-' }}
                    </p>
                    <p class="text-sm text-gray-600">
                        SKS: {{ $jadwal->matakuliah->SKS ?? '-' }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ $jadwal->Hari ?? '' }} • {{ $jadwal->JamMulai ?? '' }}-{{ $jadwal->JamSelesai ?? '' }}
                    </p>
                </div>
                <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>
        @empty
        <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada mata kuliah</h3>
            <p class="mt-1 text-sm text-gray-500">Anda belum memiliki jadwal mengajar untuk semester ini</p>
        </div>
        @endforelse
    </div>
</div>
@endsection