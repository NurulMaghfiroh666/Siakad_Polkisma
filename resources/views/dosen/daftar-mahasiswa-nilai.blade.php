@extends('layouts.dosen')

@section('title', 'Input Nilai - ' . ($jadwal->matakuliah->NamaMK ?? 'Mata Kuliah'))

@section('content')
<div class="space-y-6">
    <div class="flex items-center">
        <a href="{{ route('dosen.nilai.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $jadwal->matakuliah->NamaMK ?? 'Mata Kuliah' }}</h2>
            <p class="text-gray-600 mt-1">Kode: {{ $jadwal->matakuliah->KodeMK ?? '-' }} • SKS: {{ $jadwal->matakuliah->SKS ?? '-' }}</p>
        </div>
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

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form action="{{ route('dosen.nilai.store') }}" method="POST" id="nilaiForm">
            @csrf
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Mahasiswa</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Nilai Angka (0-100)</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Nilai Huruf</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($krsDetails as $idx => $detail)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $idx + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-gray-900">{{ $detail->krs->mahasiswa->NIM ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-gray-900">{{ $detail->krs->mahasiswa->Nama ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <input type="hidden" name="nilai[{{ $idx }}][krs_detail_id]" value="{{ $detail->id }}">
                            <input type="number" 
                                   name="nilai[{{ $idx }}][nilai_angka]" 
                                   min="0" 
                                   max="100" 
                                   step="0.01"
                                   value="{{ $detail->nilai->nilai_angka ?? '' }}"
                                   class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center nilai-angka"
                                   data-index="{{ $idx }}"
                                   placeholder="0-100">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold nilai-huruf" id="huruf-{{ $idx }}">
                                {{ $detail->nilai->nilai_huruf ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Belum ada mahasiswa yang mengambil mata kuliah ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($krsDetails->isNotEmpty())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Nilai
                </button>
            </div>
            @endif
        </form>
    </div>

    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <h4 class="font-semibold text-blue-800 mb-2">Konversi Nilai:</h4>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-sm text-blue-700">
            <div><span class="font-bold">A:</span> 85-100</div>
            <div><span class="font-bold">B:</span> 70-84</div>
            <div><span class="font-bold">C:</span> 60-69</div>
            <div><span class="font-bold">D:</span> 50-59</div>
            <div><span class="font-bold">E:</span> 0-49</div>
        </div>
    </div>
</div>

<script>
// Auto-convert nilai angka to huruf
document.querySelectorAll('.nilai-angka').forEach(input => {
    input.addEventListener('input', function() {
        const nilai = parseFloat(this.value) || 0;
        const index = this.dataset.index;
        const hurufSpan = document.getElementById(`huruf-${index}`);
        
        let huruf  = '-';
        let colorClass = 'bg-gray-200 text-gray-700';
        
        if (nilai >= 85) {
            huruf = 'A';
            colorClass = 'bg-green-500 text-white';
        } else if (nilai >= 70) {
            huruf = 'B';
            colorClass = 'bg-blue-500 text-white';
        } else if (nilai >= 60) {
            huruf = 'C';
            colorClass = 'bg-yellow-500 text-white';
        } else if (nilai >= 50) {
            huruf = 'D';
            colorClass = 'bg-orange-500 text-white';
        } else if (nilai > 0) {
            huruf = 'E';
            colorClass = 'bg-red-500 text-white';
        }
        
        hurufSpan.textContent = huruf;
        hurufSpan.className = `px-3 py-1 rounded-full text-sm font-semibold ${colorClass}`;
    });
    
    // Trigger on load for existing values
    if (input.value) {
        input.dispatchEvent(new Event('input'));
    }
});
</script>
@endsection
