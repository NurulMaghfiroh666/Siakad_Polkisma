@extends('admin.layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="space-y-6">
    <div class="flex items-center">
        <a href="{{ route('admin.matakuliah.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Mata Kuliah</h2>
            <p class="text-gray-600 mt-1">Update data mata kuliah</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.matakuliah.update', $matakuliah->KodeMK) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="KodeMK" class="block text-sm font-medium text-gray-700 mb-2">Kode Mata Kuliah *</label>
                    <input type="text" name="KodeMK" id="KodeMK" value="{{ old('KodeMK', $matakuliah->KodeMK) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('KodeMK') border-red-500 @enderror">
                    @error('KodeMK')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="SKS" class="block text-sm font-medium text-gray-700 mb-2">SKS *</label>
                    <input type="number" name="SKS" id="SKS" value="{{ old('SKS', $matakuliah->SKS) }}" required min="1" max="6"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('SKS') border-red-500 @enderror">
                    @error('SKS')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="NamaMK" class="block text-sm font-medium text-gray-700 mb-2">Nama Mata Kuliah *</label>
                    <input type="text" name="NamaMK" id="NamaMK" value="{{ old('NamaMK', $matakuliah->NamaMK) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('NamaMK') border-red-500 @enderror">
                    @error('NamaMK')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="IdJurusan" class="block text-sm font-medium text-gray-700 mb-2">Jurusan *</label>
                    <select name="IdJurusan" id="IdJurusan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('IdJurusan') border-red-500 @enderror">
                        <option value="">Pilih Jurusan</option>
                        <option value="1" {{ old('IdJurusan', $matakuliah->IdJurusan) == 1 ? 'selected' : '' }}>Teknik Informatika</option>
                        <option value="2" {{ old('IdJurusan', $matakuliah->IdJurusan) == 2 ? 'selected' : '' }}>Sistem Informasi</option>
                    </select>
                    @error('IdJurusan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                <a href="{{ route('admin.matakuliah.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>

    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
        <div class="flex">
            <svg class="h-5 w-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <p class="text-yellow-700 text-sm">Perubahan kode MK akan mempengaruhi data jadwal dan KRS yang sudah ada</p>
        </div>
    </div>
</div>
@endsection
