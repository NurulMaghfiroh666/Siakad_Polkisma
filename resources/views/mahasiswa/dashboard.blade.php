@extends('layouts.dashboard')

@section('title', 'Dashboard Mahasiswa - SIAKAD POLKISMA')

@section('sidebar-menu')
<li class="nav-item">
    <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        </span> 
        Beranda
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.pesan') }}" class="nav-link {{ request()->routeIs('mahasiswa.pesan') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        </span> 
        Pesan
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.jadwal') }}" class="nav-link {{ request()->routeIs('mahasiswa.jadwal') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </span> 
        Jadwal
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.matakuliah') }}" class="nav-link {{ request()->routeIs('mahasiswa.matakuliah') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </span> 
        Mata Kuliah
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.akademik') }}" class="nav-link {{ request()->routeIs('mahasiswa.akademik') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
        </span> 
        Akademik
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.biodata') }}" class="nav-link {{ request()->routeIs('mahasiswa.biodata') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </span> 
        Biodata
    </a>
</li>
@endsection

@section('content')
<style>
    .dashboard-header {
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

    .user-pill {
        display: flex;
        align-items: center;
        background: white;
        padding: 8px 15px 8px 8px;
        border-radius: 50px;
        gap: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    .user-info {
        text-align: left;
    }

    .user-name {
        font-weight: 700;
        font-size: 1rem;
        color: #1e293b;
    }

    .user-role {
        font-size: 0.8rem;
        color: #64748b;
    }

    .cards-section {
        display: flex;
        gap: 25px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }
</style>

<!-- Header -->
<div class="dashboard-header fade-in">
    <div class="page-title">
        <svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><rect x="3" y="3" width="7" height="7" rx="1"></rect><rect x="14" y="3" width="7" height="7" rx="1"></rect><rect x="14" y="14" width="7" height="7" rx="1"></rect><rect x="3" y="14" width="7" height="7" rx="1"></rect></svg>
        Beranda
    </div>
    
    <div class="user-pill">
        <div class="user-avatar">
            {{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 1)) }}
        </div>
        <div class="user-info">
            <div class="user-name">{{ auth()->user()->name ?? 'Mahasiswa' }}</div>
            <div class="user-role">Mahasiswa</div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="cards-section fade-in">
    <!-- IPK -->
    <div class="stats-card blue">
        <div class="stats-icon">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
        </div>
        <div class="stats-content">
            <div class="stats-label">IPK</div>
            <div class="stats-value">{{ number_format($ipk ?? 0, 2) }}</div>
        </div>
    </div>

    <!-- Total SKS -->
    <div class="stats-card white">
        <div class="stats-icon">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </div>
        <div class="stats-content">
            <div class="stats-label">Total SKS</div>
            <div class="stats-value">{{ $totalSks ?? 0 }}</div>
        </div>
    </div>

    <!-- Semester -->
    <div class="stats-card white">
        <div class="stats-icon">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </div>
        <div class="stats-content">
            <div class="stats-label">Semester</div>
            <div class="stats-value">{{ $semester ?? '-' }}</div>
        </div>
    </div>
</div>

<!-- Jadwal Hari Ini -->
<div class="section-header fade-in">
    <h3 class="section-title">Jadwal Hari Ini</h3>
</div>

<div class="table-container fade-in">
    <table class="table">
        <thead>
            <tr>
                <th>Jam</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Ruang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwalHariIni ?? [] as $jadwal)
            <tr>
                <td>{{ $jadwal->Jam ?? '-' }}</td>
                <td><strong>{{ $jadwal->matakuliah->Nama ?? '-' }}</strong></td>
                <td>{{ $jadwal->dosen->Nama ?? '-' }}</td>
                <td>{{ $jadwal->Ruang ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="table-empty">Tidak ada jadwal hari ini</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
