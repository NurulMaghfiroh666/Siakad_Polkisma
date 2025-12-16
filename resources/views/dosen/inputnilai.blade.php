@extends('layouts.dashboard')

@section('title', 'Input Nilai - Dashboard Dosen')

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
    <a href="{{ route('dosen.nilai.index') }}" class="nav-link active">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
        </span> 
        Input Nilai
    </a>
</li>
@endsection

@section('content')
<style>
    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 0.95rem;
    }

    .mk-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
    }

    .mk-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 4px solid #7c3aed;
        cursor: pointer;
    }

    .mk-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }

    .mk-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mk-icon {
        width: 40px;
        height: 40px;
        background: #f5f3ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7c3aed;
    }

    .mk-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e2e8f0;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-label {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 0.95rem;
        color: #1e293b;
        font-weight: 600;
    }

    .badge-sks {
        display: inline-block;
        padding: 4px 12px;
        background: #ddd6fe;
        color: #6d28d9;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }
</style>

<div class="page-header">
    <h1 class="page-title">Input Nilai Mahasiswa</h1>
    <p class="page-subtitle">Pilih mata kuliah untuk menginput nilai mahasiswa</p>
</div>

@if(session('success'))
<div style="background: #d1fae5; border-left: 4px solid #10b981; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
    <p style="color: #065f46; font-weight: 600; margin: 0;">✅ {{ session('success') }}</p>
</div>
@endif

<div class="mk-grid">
    @forelse($jadwals as $jadwal)
    <a href="{{ route('dosen.nilai.show', $jadwal->IdJadwal) }}" style="text-decoration: none; color: inherit;">
        <div class="mk-card">
            <div class="mk-title">
                <div class="mk-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                </div>
                {{ $jadwal->matakuliah->NamaMK ?? 'Mata Kuliah' }}
            </div>

            <div class="mk-info">
                <div class="info-item">
                    <span class="info-label">Kode MK</span>
                    <span class="info-value">{{ $jadwal->matakuliah->KodeMK ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">SKS</span>
                    <span class="badge-sks">{{ $jadwal->matakuliah->SKS ?? '-' }} SKS</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Kelas</span>
                    <span class="info-value">{{ $jadwal->Kelas ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jadwal</span>
                    <span class="info-value">{{ $jadwal->Hari ?? '-' }} • {{ $jadwal->Jam ?? '-' }}</span>
                </div>
            </div>
        </div>
    </a>
    @empty
    <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: white; border-radius: 16px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 20px; opacity: 0.3; color: #7c3aed;">
            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
            <polyline points="2 17 12 22 22 17"></polyline>
            <polyline points="2 12 12 17 22 12"></polyline>
        </svg>
        <h3 style="color: #94a3b8; margin-bottom: 10px; font-size: 1.25rem;">Belum ada jadwal mengajar</h3>
        <p style="color: #cbd5e1; font-size: 0.95rem;">Anda belum memiliki jadwal mengajar untuk semester ini</p>
    </div>
    @endforelse
</div>

@endsection