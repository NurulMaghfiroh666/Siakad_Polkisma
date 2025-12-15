@extends('admin.layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="space-y-6">
    <div class="flex items-center">
        <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Mahasiswa</h2>
            <p class="text-gray-600 mt-1">Update data mahasiswa</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.mahasiswa.update', $mahasiswa->IdMahasiswa) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="NIM" class="block text-sm font-medium text-gray-700 mb-2">NIM *</label>
                    <input type="text" name="NIM" id="NIM" value="{{ old('NIM', $mahasiswa->NIM) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('NIM') border-red-500 @enderror">
                    @error('NIM')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="Nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" name="Nama" id="Nama" value="{{ old('Nama', $mahasiswa->Nama) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('Nama') border-red-500 @enderror">
                    @error('Nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="Email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="Email" id="Email" value="{{ old('Email', $mahasiswa->Email) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('Email') border-red-500 @enderror">
                    @error('Email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="NoTelpon" class="block text-sm font-medium text-gray-700 mb-2">No Telpon *</label>
                    <input type="text" name="NoTelpon" id="NoTelpon" value="{{ old('NoTelpon', $mahasiswa->NoTelpon) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('NoTelpon') border-red-500 @enderror">
                    @error('NoTelpon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="TahunMasuk" class="block text-sm font-medium text-gray-700 mb-2">Tahun Masuk *</label>
                    <input type="number" name="TahunMasuk" id="TahunMasuk" value="{{ old('TahunMasuk', $mahasiswa->TahunMasuk) }}" required min="2000" max="2100"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('TahunMasuk') border-red-500 @enderror">
                    @error('TahunMasuk')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="IdJurusan" class="block text-sm font-medium text-gray-700 mb-2">Jurusan *</label>
                    <select name="IdJurusan" id="IdJurusan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('IdJurusan') border-red-500 @enderror">
                        <option value="">Pilih Jurusan</option>
                        <option value="1" {{ old('IdJurusan', $mahasiswa->IdJurusan) == 1 ? 'selected' : '' }}>Teknik Informatika</option>
                        <option value="2" {{ old('IdJurusan', $mahasiswa->IdJurusan) == 2 ? 'selected' : '' }}>Sistem Informasi</option>
                    </select>
                    @error('IdJurusan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                <a href="{{ route('admin.mahasiswa.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
