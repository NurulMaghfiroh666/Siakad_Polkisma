@extends('layouts.dashboard')

@section('title', 'Akademik - Dashboard Mahasiswa')

@section('sidebar-menu')
<li class="nav-item">
    <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        </span> 
        Beranda
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.pesan') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        </span> 
        Pesan
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.jadwal') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </span> 
        Jadwal
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.matakuliah') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </span> 
        Mata Kuliah
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.akademik') }}" class="nav-link active">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
        </span> 
        Akademik
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.biodata') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </span> 
        Biodata
    </a>
</li>
@endsection

@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-title {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1.8rem;
        font-weight: 700;
        color: #334155;
    }

    .akademik-menu {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .menu-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        border-left: 4px solid #3b82f6;
    }

    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .menu-icon {
        width: 60px;
        height: 60px;
        background: #eff6ff;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: #3b82f6;
    }

    .menu-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .menu-desc {
        font-size: 0.875rem;
        color: #64748b;
        line-height: 1.5;
    }
</style>

<div class="page-header fade-in">
    <div class="page-title">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
        Akademik
    </div>
</div>

<div class="akademik-menu fade-in">
    <!-- KRS -->
    <div class="menu-card" onclick="window.location.href='#krs'">
        <div class="menu-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
        </div>
        <div class="menu-title">KRS (Kartu Rencana Studi)</div>
        <div class="menu-desc">Lihat dan kelola rencana studi Anda untuk semester ini</div>
    </div>

    <!-- KHS -->
    <div class="menu-card" onclick="window.location.href='#khs'">
        <div class="menu-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line></svg>
        </div>
        <div class="menu-title">KHS (Kartu Hasil Studi)</div>
        <div class="menu-desc">Lihat hasil studi dan nilai per semester</div>
    </div>

    <!-- Transkrip -->
    <div class="menu-card" onclick="window.location.href='#transkrip'">
        <div class="menu-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="12" y1="9" x2="8" y2="9"></line></svg>
        </div>
        <div class="menu-title">Transkrip Nilai</div>
        <div class="menu-desc">Lihat transkrip nilai keseluruhan studi Anda</div>
    </div>
</div>

<!-- KRS Section -->
<div id="krs" class="card fade-in" style="margin-bottom: 30px;">
    <div class="card-header">
        <h3 class="card-title">Kartu Rencana Studi (KRS)</h3>
        <p class="card-subtitle">Semester Ganjil 2024/2025</p>
    </div>
    <div class="table-container" style="box-shadow: none; padding: 0;">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Kelas</th>
                    <th>Dosen</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krs ?? [] as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->KodeMK ?? '-' }}</td>
                    <td><strong>{{ $item->matakuliah->Nama ?? '-' }}</strong></td>
                    <td>{{ $item->matakuliah->SKS ?? '-' }}</td>
                    <td>{{ $item->Kelas ?? '-' }}</td>
                    <td>{{ $item->dosen->Nama ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="table-empty">Belum ada KRS untuk semester ini</td>
                </tr>
                @endforelse
            </tbody>
            @if(isset($krs) && count($krs) > 0)
            <tfoot>
                <tr style="background: #f8f9fa; font-weight: 700;">
                    <td colspan="3" style="text-align: right;">Total SKS:</td>
                    <td>{{ $krs->sum(function($item) { return $item->matakuliah->SKS ?? 0; }) }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

<!-- KHS Section -->
<div id="khs" class="card fade-in" style="margin-bottom: 30px;">
    <div class="card-header">
        <h3 class="card-title">Kartu Hasil Studi (KHS)</h3>
        <p class="card-subtitle">Pilih semester untuk melihat hasil studi</p>
    </div>
    <div style="margin-bottom: 20px;">
        <select class="form-control" style="max-width: 300px;">
            <option>Semester Ganjil 2024/2025</option>
            <option>Semester Genap 2023/2024</option>
            <option>Semester Ganjil 2023/2024</option>
        </select>
    </div>
    <div class="table-container" style="box-shadow: none; padding: 0;">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Nilai Angka</th>
                    <th>Nilai Huruf</th>
                    <th>Mutu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($khs ?? [] as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->KodeMK ?? '-' }}</td>
                    <td><strong>{{ $item->matakuliah->Nama ?? '-' }}</strong></td>
                    <td>{{ $item->matakuliah->SKS ?? '-' }}</td>
                    <td>{{ $item->NilaiAngka ?? '-' }}</td>
                    <td><span class="badge badge-info">{{ $item->NilaiHuruf ?? '-' }}</span></td>
                    <td>{{ $item->Mutu ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="table-empty">Belum ada nilai untuk semester ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
