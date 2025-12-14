@extends('layouts.dashboard')

@section('title', 'Biodata Dosen - Dashboard Dosen')

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
    <a href="{{ route('dosen.jadwal') }}" class="nav-link">
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
    <a href="{{ route('dosen.biodata') }}" class="nav-link active">
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

    .profile-container {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 25px;
    }

    .profile-sidebar {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        font-weight: 700;
    }

    .profile-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .profile-nip {
        font-size: 0.875rem;
        color: #64748b;
        margin-bottom: 20px;
    }

    .profile-main {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e5e7eb;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 1rem;
        color: #1e293b;
        font-weight: 500;
    }
</style>

<div class="page-header fade-in">
    <div class="page-title">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        Biodata Dosen
    </div>
    <a href="{{ route('dosen.profile.edit') }}" class="btn btn-primary">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        Edit Profile
    </a>
</div>

<div class="profile-container fade-in">
    <!-- Sidebar -->
    <div class="profile-sidebar">
        <div class="profile-photo">
            {{ strtoupper(substr($dosen->name ?? 'D', 0, 1)) }}
        </div>
        <div class="profile-name">{{ $dosen->name ?? 'Nama Dosen' }}</div>
        <div class="profile-nip">NIP: {{ $dosen->nip ?? '-' }}</div>
        
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
            <button class="btn btn-secondary" style="width: 100%; margin-bottom: 10px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                Download CV
            </button>
            <a href="{{ route('dosen.password.edit') }}" class="btn btn-secondary" style="width: 100%;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                Ganti Password
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="profile-main">
        <!-- Data Pribadi -->
        <div class="section-title">Data Pribadi</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value">{{ $dosen->name ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">NIP</div>
                <div class="info-value">{{ $dosen->nip ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">NIDN</div>
                <div class="info-value">{{ $dosen->nidn ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Tempat, Tanggal Lahir</div>
                <div class="info-value">{{ $dosen->tempat_lahir ?? '-' }}, {{ $dosen->tanggal_lahir ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Jenis Kelamin</div>
                <div class="info-value">{{ $dosen->jenis_kelamin ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Agama</div>
                <div class="info-value">{{ $dosen->agama ?? '-' }}</div>
            </div>
        </div>

        <!-- Data Kontak -->
        <div class="section-title">Data Kontak</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $dosen->email ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">No. Telepon</div>
                <div class="info-value">{{ $dosen->telepon ?? '-' }}</div>
            </div>
            <div class="info-item" style="grid-column: 1 / -1;">
                <div class="info-label">Alamat</div>
                <div class="info-value">{{ $dosen->alamat ?? '-' }}</div>
            </div>
        </div>

        <!-- Data Akademik -->
        <div class="section-title">Data Akademik</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Pendidikan Terakhir</div>
                <div class="info-value">{{ $dosen->pendidikan_terakhir ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Jabatan Fungsional</div>
                <div class="info-value">{{ $dosen->jabatan ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Program Studi</div>
                <div class="info-value">{{ $dosen->prodi ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Status Kepegawaian</div>
                <div class="info-value">{{ $dosen->status_kepegawaian ?? '-' }}</div>
            </div>
        </div>
    </div>
</div>

@endsection
