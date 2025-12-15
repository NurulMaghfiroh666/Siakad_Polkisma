@extends('admin.layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="space-y-6">
    <div class="flex items-center">
        <a href="{{ route('admin.jadwal.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Jadwal Baru</h2>
            <p class="text-gray-600 mt-1">Buat jadwal mata kuliah dan assign dosen</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="KodeMK" class="block text-sm font-medium text-gray-700 mb-2">Mata Kuliah *</label>
                    <select name="KodeMK" id="KodeMK" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('KodeMK') border-red-500 @enderror">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->KodeMK }}" {{ old('KodeMK') == $mk->KodeMK ? 'selected' : '' }}>
                            {{ $mk->KodeMK }} - {{ $mk->NamaMK }} ({{ $mk->SKS }} SKS)
                        </option>
                        @endforeach
                    </select>
                    @error('KodeMK')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="IdDosen" class="block text-sm font-medium text-gray-700 mb-2">Dosen Pengampu *</label>
                    <select name="IdDosen" id="IdDosen" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('IdDosen') border-red-500 @enderror">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosens as $dosen)
                        <option value="{{ $dosen->IdDosen }}" {{ old('IdDosen') == $dosen->IdDosen ? 'selected' : '' }}>
                            {{ $dosen->Nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('IdDosen')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="Hari" class="block text-sm font-medium text-gray-700 mb-2">Hari *</label>
                    <select name="Hari" id="Hari" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('Hari') border-red-500 @enderror">
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin" {{ old('Hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ old('Hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ old('Hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ old('Hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ old('Hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ old('Hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    </select>
                    @error('Hari')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="Ruang" class="block text-sm font-medium text-gray-700 mb-2">Ruang *</label>
                    <input type="text" name="Ruang" id="Ruang" value="{{ old('Ruang') }}" required placeholder="Contoh: A301" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('Ruang') border-red-500 @enderror">
                    @error('Ruang')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="JamMulai" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai *</label>
                    <input type="time" name="JamMulai" id="JamMulai" value="{{ old('JamMulai') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('JamMulai') border-red-500 @enderror">
                    @error('JamMulai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="JamSelesai" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai *</label>
                    <input type="time" name="JamSelesai" id="JamSelesai" value="{{ old('JamSelesai') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('JamSelesai') border-red-500 @enderror">
                    @error('JamSelesai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                <a href="{{ route('admin.jadwal.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
