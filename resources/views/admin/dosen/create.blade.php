@extends('admin.layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
<div class="space-y-6">
    <div class="flex items-center">
        <a href="{{ route('admin.dosen.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Dosen Baru</h2>
            <p class="text-gray-600 mt-1">Masukkan data dosen baru</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.dosen.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="NIP" class="block text-sm font-medium text-gray-700 mb-2">NIP *</label>
                    <input type="text" name="NIP" id="NIP" value="{{ old('NIP') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('NIP') border-red-500 @enderror">
                    @error('NIP')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="Nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" name="Nama" id="Nama" value="{{ old('Nama') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('Nama') border-red-500 @enderror">
                    @error('Nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="Email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="Email" id="Email" value="{{ old('Email') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('Email') border-red-500 @enderror">
                    @error('Email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="NoTelpon" class="block text-sm font-medium text-gray-700 mb-2">No Telpon *</label>
                    <input type="text" name="NoTelpon" id="NoTelpon" value="{{ old('NoTelpon') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('NoTelpon') border-red-500 @enderror">
                    @error('NoTelpon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                <a href="{{ route('admin.dosen.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
        <div class="flex">
            <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <p class="text-green-700 text-sm">Password default untuk dosen adalah NIP yang didaftarkan</p>
        </div>
    </div>
</div>
@endsection
