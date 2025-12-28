@extends('layouts.dashboard')

@section('title', 'Dashboard Dosen - SIAKAD POLKISMA')

@section('sidebar-menu')
<li class="nav-item">
    <a href="{{ route('dosen.dashboard') }}" class="nav-link {{ request()->routeIs('dosen.dashboard') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        </span> 
        Beranda
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dosen.nilai.index') }}" class="nav-link {{ request()->routeIs('dosen.nilai.*') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
        </span> 
        Isi Nilai
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dosen.jadwal') }}" class="nav-link {{ request()->routeIs('dosen.jadwal') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </span> 
        Jadwal Mengajar
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dosen.matakuliah') }}" class="nav-link {{ request()->routeIs('dosen.matakuliah') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </span> 
        Mata Kuliah
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dosen.biodata') }}" class="nav-link {{ request()->routeIs('dosen.biodata') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </span> 
        Biodata Dosen
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

    .page-title svg {
        color: #1e3a5f;
        width: 32px;
        height: 32px;
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

    .schedule-icon-box {
        background-color: #eff6ff;
        color: #2563eb;
        padding: 12px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .schedule-time {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 2px;
    }

    .schedule-label {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .schedule-subject {
        font-weight: 600;
        color: #334155;
    }

    .section-header {
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #334155;
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
            {{ strtoupper(substr(auth()->user()->name ?? 'D', 0, 1)) }}
        </div>
        <div class="user-info">
            <div class="user-name">{{ auth()->user()->name ?? 'Dosen' }}</div>
            <div class="user-role">Dosen</div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="cards-section fade-in">
    <!-- Total MK -->
    <div class="stats-card blue">
        <div class="stats-icon">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </div>
        <div class="stats-content">
            <div class="stats-label">Total Matakuliah</div>
            <div class="stats-value">{{ $totalMatakuliah ?? 0 }}</div>
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    @forelse($jadwalHariIni ?? [] as $jadwal)
    <div class="stats-card white">
        <div class="schedule-icon-box">
           <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </div>
        <div>
            <div class="schedule-label">Jadwal Hari Ini</div>
            <div class="schedule-time">{{ $jadwal->jam ?? '-' }}</div>
            <div class="schedule-subject">{{ $jadwal->matakuliah->nama ?? '-' }}</div>
        </div>
    </div>
    @empty
    <div class="stats-card white">
        <div class="schedule-icon-box">
           <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        </div>
        <div>
            <div class="schedule-label">Jadwal Hari Ini</div>
            <div class="schedule-subject" style="color: #94a3b8;">Tidak ada jadwal</div>
        </div>
    </div>
    @endforelse
</div>

<!-- Table Section -->
<div class="section-header fade-in">
    <h3 class="section-title">Jadwal Mengajar</h3>
</div>

<div class="table-container fade-in">
    <table class="table">
        <thead>
            <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Kelas</th>
                <th>Ruang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaJadwal ?? [] as $jadwal)
            <tr>
                <td>{{ $jadwal->hari }}</td>
                <td>{{ $jadwal->jam }}</td>
                <td>{{ $jadwal->matakuliah->nama ?? '-' }}</td>
                <td>{{ $jadwal->matakuliah->sks ?? '-' }}</td>
                <td>{{ $jadwal->kelas ?? '-' }}</td>
                <td>{{ $jadwal->ruang ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="table-empty">Belum ada jadwal mengajar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
