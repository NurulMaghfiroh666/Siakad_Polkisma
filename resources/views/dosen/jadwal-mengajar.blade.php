@extends('layouts.dashboard')

@section('title', 'Jadwal Mengajar - Dashboard Dosen')

@section('sidebar-menu')
<li class="nav-item">
    <a href="{{ route('dosen.dashboard') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        </span> 
        Beranda
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dosen.pesan') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        </span> 
        Pesan
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dosen.jadwal') }}" class="nav-link active">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </span> 
        Jadwal Mengajar
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dosen.matakuliah') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </span> 
        Mata Kuliah
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dosen.biodata') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </span> 
        Biodata Dosen
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

    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 16px;
        margin-bottom: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .filter-group {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .filter-label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
    }
</style>

<div class="page-header fade-in">
    <div class="page-title">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        Jadwal Mengajar
    </div>
</div>

<!-- Filter -->
<div class="filter-section fade-in">
    <div class="filter-group">
        <span class="filter-label">Filter:</span>
        <select class="form-control" style="width: 200px;">
            <option>Semua Hari</option>
            <option>Senin</option>
            <option>Selasa</option>
            <option>Rabu</option>
            <option>Kamis</option>
            <option>Jumat</option>
            <option>Sabtu</option>
        </select>
        <select class="form-control" style="width: 200px;">
            <option>Semester Ganjil 2024/2025</option>
            <option>Semester Genap 2023/2024</option>
        </select>
    </div>
</div>

<!-- Jadwal Table -->
<div class="table-container fade-in">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Mata Kuliah</th>
                <th>Kode MK</th>
                <th>SKS</th>
                <th>Kelas</th>
                <th>Ruang</th>
                <th>Jumlah Mahasiswa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal ?? [] as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->hari }}</td>
                <td>{{ $item->jam }}</td>
                <td><strong>{{ $item->matakuliah->nama ?? '-' }}</strong></td>
                <td>{{ $item->matakuliah->kode ?? '-' }}</td>
                <td>{{ $item->matakuliah->sks ?? '-' }}</td>
                <td>{{ $item->kelas ?? '-' }}</td>
                <td>{{ $item->ruang ?? '-' }}</td>
                <td>{{ $item->jumlah_mahasiswa ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="table-empty">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 15px; display: block; opacity: 0.3;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Belum ada jadwal mengajar
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
