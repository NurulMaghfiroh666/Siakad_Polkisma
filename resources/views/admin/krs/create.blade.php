@extends('admin.layouts.app')

@section('title', 'Buat KRS Baru')

@section('content')
<div class="space-y-6">
    <div class="flex items-center">
        <a href="{{ route('admin.krs.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Buat KRS Baru</h2>
            <p class="text-gray-600 mt-1">Tambahkan KRS untuk mahasiswa</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.krs.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="IdMahasiswa" class="block text-sm font-medium text-gray-700 mb-2">Pilih Mahasiswa *</label>
                    <select name="IdMahasiswa" id="IdMahasiswa" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('IdMahasiswa') border-red-500 @enderror">
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach($mahasiswas as $mhs)
                        <option value="{{ $mhs->IdMahasiswa }}" {{ old('IdMahasiswa') == $mhs->IdMahasiswa ? 'selected' : '' }}>
                            {{ $mhs->NIM }} - {{ $mhs->Nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('IdMahasiswa')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">Semester *</label>
                    <input type="text" name="semester" id="semester" value="{{ old('semester') }}" required placeholder="Contoh: 2023/2024 Ganjil" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('semester') border-red-500 @enderror">
                    @error('semester')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                <a href="{{ route('admin.krs.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
