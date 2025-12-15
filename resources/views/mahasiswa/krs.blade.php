@extends('layouts.mahasiswa')

@section('title', 'KRS - Kartu Rencana Studi')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Kartu Rencana Studi (KRS)</h2>
        <p class="text-gray-600 mt-1">Semester: {{ $krs->semester ?? '-' }}</p>
    </div>

    @if($krs)
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-lg p-6 text-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-blue-100 text-sm">NIM</p>
                <p class="text-lg font-semibold">{{ $mahasiswa->NIM }}</p>
            </div>
            <div>
                <p class="text-blue-100 text-sm">Nama</p>
                <p class="text-lg font-semibold">{{ $mahasiswa->Nama }}</p>
            </div>
            <div>
                <p class="text-blue-100 text-sm">Total SKS</p>
                <p class="text-lg font-semibold">{{ $krs->total_sks }} SKS</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-700">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kode MK</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Mata Kuliah</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">SKS</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Dosen</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Jadwal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($krs->details as $idx => $detail)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $idx + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-900">{{ $detail->jadwal->matakuliah->KodeMK ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-gray-900">{{ $detail->jadwal->matakuliah->NamaMK ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                            {{ $detail->jadwal->matakuliah->SKS ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-600">{{ $detail->jadwal->dosen->Nama ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-600">
                            {{ $detail->jadwal->Hari ?? '' }} • 
                            {{ $detail->jadwal->JamMulai ?? '' }}-{{ $detail->jadwal->JamSelesai ?? '' }}
                            <br>
                            <span class="text-xs">Ruang: {{ $detail->jadwal->Ruang ?? '-' }}</span>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right font-semibold text-gray-800">Total SKS:</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold">
                            {{ $krs->total_sks }} SKS
                        </span>
                    </td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada KRS</h3>
        <p class="mt-1 text-sm text-gray-500">Anda belum mengisi KRS untuk semester ini</p>
    </div>
    @endif
</div>
@endsection
