@extends('layouts.dashboard')

@section('title', 'Mata Kuliah - Dashboard Mahasiswa')

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
        Jadwal Mengajar
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.matakuliah') }}" class="nav-link active">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </span> 
        Mata Kuliah
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('mahasiswa.biodata') }}" class="nav-link">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </span> 
        Biodata Mahasiswa
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

    .mk-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
    }

    .mk-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border-left: 4px solid #3b82f6;
    }

    .mk-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .mk-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 15px;
    }

    .mk-code {
        background: #eff6ff;
        color: #3b82f6;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .mk-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .mk-info {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        font-size: 0.875rem;
        color: #64748b;
    }

    .mk-info-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .mk-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
    }

    .mk-stat {
        text-align: center;
    }

    .mk-stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
    }

    .mk-stat-label {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 2px;
    }

    .mk-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
</style>

<div class="page-header fade-in">
    <div class="page-title">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        Mata Kuliah
    </div>
</div>

<div class="mk-grid fade-in">
    @forelse($matakuliah ?? [] as $mk)
    <div class="mk-card">
        <div class="mk-header">
            <div>
                <div class="mk-code">{{ $mk->kode ?? 'MK-001' }}</div>
            </div>
        </div>
        
        <div class="mk-title">{{ $mk->nama ?? 'Nama Mata Kuliah' }}</div>
        
        <div class="mk-info">
            <div class="mk-info-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <span>{{ $mk->sks ?? 3 }} SKS</span>
            </div>
            <div class="mk-info-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span>Kelas {{ $mk->kelas ?? 'A' }}</span>
            </div>
        </div>

        <div class="mk-stats">
            <div class="mk-stat">
                <div class="mk-stat-value">{{ $mk->jumlah_mahasiswa ?? 30 }}</div>
                <div class="mk-stat-label">Mahasiswa</div>
            </div>
            <div class="mk-stat">
                <div class="mk-stat-value">{{ $mk->pertemuan ?? 14 }}</div>
                <div class="mk-stat-label">Pertemuan</div>
            </div>
        </div>

        <div class="mk-actions">
            <a href="#" class="btn btn-primary btn-sm" style="flex: 1;">Detail</a>
            <a href="#" class="btn btn-secondary btn-sm" style="flex: 1;">Input Nilai</a>
        </div>
    </div>
    @empty
    <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 20px; opacity: 0.3;"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        <h3 style="color: #94a3b8; margin-bottom: 10px;">Belum ada mata kuliah</h3>
        <p style="color: #cbd5e1;">Mata kuliah yang Anda ampu akan ditampilkan di sini</p>
    </div>
    @endforelse
</div>

@endsection
