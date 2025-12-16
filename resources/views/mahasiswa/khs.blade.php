@extends('layouts.dashboard')

@section('title', 'KHS - Kartu Hasil Studi')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kartu Hasil Studi (KHS)</h2>
            <p class="text-gray-600 mt-1">Lihat nilai dan IP per semester</p>
        </div>
        
        @if($allSemesters->isNotEmpty())
        <div>
            <label class="text-sm font-medium text-gray-700 mr-2">Pilih Semester:</label>
            <select onchange="window.location.href='{{ route('mahasiswa.khs') }}/' + this.value" 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @foreach($allSemesters as $sem)
                <option value="{{ $sem }}" {{ $semester == $sem ? 'selected' : '' }}>
                    Semester {{ $sem }}
                </option>
                @endforeach
            </select>
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <p class="text-gray-500 text-sm font-medium uppercase">NIM</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">{{ $mahasiswa->NIM }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <p class="text-gray-500 text-sm font-medium uppercase">IP Semester</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($ipSemester, 2) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <p class="text-gray-500 text-sm font-medium uppercase">IPK (Kumulatif)</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($ipk, 2) }}</p>
        </div>
    </div>

    @if($krs)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
            <h3 class="text-lg font-semibold">Semester {{ $semester }}</h3>
        </div>
        
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kode MK</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Mata Kuliah</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">SKS</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Nilai Angka</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Nilai Huruf</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Bobot</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $totalBobot = 0;
                    $totalSks = 0;
                @endphp
                @foreach($krs->details as $idx => $detail)
                @php
                    $sks = $detail->jadwal->matakuliah->SKS ?? 0;
                    $gradePoint = 0;
                    if ($detail->nilai && $detail->nilai->nilai_huruf) {
                        $gradePoint = \App\Models\Nilai::hurufToGradePoint($detail->nilai->nilai_huruf);
                    }
                    $bobot = $sks * $gradePoint;
                    $totalBobot += $bobot;
                    $totalSks += $sks;
                @endphp
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
                        <span class="text-sm text-gray-600">{{ $sks }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="text-sm text-gray-600">{{ $detail->nilai->nilai_angka ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($detail->nilai && $detail->nilai->nilai_huruf)
                            @php
                                $colorClass = match($detail->nilai->nilai_huruf) {
                                    'A' => 'bg-green-500 text-white',
                                    'B' => 'bg-blue-500 text-white',
                                    'C' => 'bg-yellow-500 text-white',
                                    'D' => 'bg-orange-500 text-white',
                                    'E' => 'bg-red-500 text-white',
                                    default => 'bg-gray-200 text-gray-700'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $colorClass }}">
                                {{ $detail->nilai->nilai_huruf }}
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-700">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="text-sm text-gray-600">{{ number_format($bobot, 2) }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50 font-semibold">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right text-gray-800">Total:</td>
                    <td class="px-6 py-4 text-center text-gray-800">{{ $totalSks }}</td>
                    <td colspan="2" class="px-6 py-4 text-right text-gray-800">Total Bobot:</td>
                    <td class="px-6 py-4 text-center text-gray-800">{{ number_format($totalBobot, 2) }}</td>
                </tr>
                <tr class="bg-blue-50">
                    <td colspan="6" class="px-6 py-4 text-right text-blue-900 font-bold">IP Semester:</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold">
                            {{ number_format($ipSemester, 2) }}
                        </span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data KHS</h3>
        <p class="mt-1 text-sm text-gray-500">Belum ada nilai untuk semester yang dipilih</p>
    </div>
    @endif

    <div class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded">
        <h4 class="font-semibold text-purple-800 mb-2">Keterangan:</h4>
        <div class="text-sm text-purple-700 space-y-1">
            <p><strong>IP Semester:</strong> Total Bobot / Total SKS</p>
            <p><strong>IPK:</strong> Total Bobot Seluruh Semester / Total SKS Seluruh Semester</p>
            <p><strong>Bobot:</strong> SKS × Grade Point (A=4, B=3, C=2, D=1, E=0)</p>
        </div>
    </div>
</div>
@endsection
