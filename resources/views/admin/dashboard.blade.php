@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Message -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-lg p-6 text-white">
        <h1 class="text-2xl font-bold">Selamat Datang, {{ optional(Auth::user()->admin)->Nama ?? Auth::user()->Username ?? 'Admin' }}!</h1>
        <p class="text-blue-100 mt-1">Kelola data akademik dengan mudah melalui dashboard admin</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Mahasiswa Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Total Mahasiswa</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalMahasiswa }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.mahasiswa.index') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-medium text-sm">
                Lihat Semua →
            </a>
        </div>

        <!-- Total Dosen Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Total Dosen</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalDosen }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                  </svg>
                </div>
            </div>
            <a href="{{ route('admin.dosen.index') }}" class="inline-block mt-4 text-green-600 hover:text-green-800 font-medium text-sm">
                Lihat Semua →
            </a>
        </div>

        <!-- Total Mata Kuliah Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Total Mata Kuliah</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalMatakuliah }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.matakuliah.index') }}" class="inline-block mt-4 text-purple-600 hover:text-purple-800 font-medium text-sm">
                Lihat Semua →
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.mahasiswa.create') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group">
                <div class="bg-blue-100 group-hover:bg-blue-200 p-3 rounded-lg mr-4">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Tambah Mahasiswa Baru</p>
                    <p class="text-sm text-gray-500">Daftarkan mahasiswa baru ke sistem</p>
                </div>
            </a>

            <a href="{{ route('admin.dosen.create') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition group">
                <div class="bg-green-100 group-hover:bg-green-200 p-3 rounded-lg mr-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Tambah Dosen Baru</p>
                    <p class="text-sm text-gray-500">Daftarkan dosen baru ke sistem</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
