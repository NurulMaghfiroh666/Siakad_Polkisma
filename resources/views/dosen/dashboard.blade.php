@extends('layouts.dashboard')

@section('title', 'Dashboard Dosen')

@section('content')
<style>
    /* Header Area */
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
        color: #1e3a5f; /* Navy */
        width: 32px;
        height: 32px;
    }

    .user-pill {
        display: flex;
        align-items: center;
        background: white; /* Or transparent if on white bg? Image shows it cleanly. */
        padding: 8px 15px 8px 8px; /* Avatar on left */
        border-radius: 50px;
        gap: 12px;
        /* Box shadow optional if it looks floating */
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background-color: #ffffff; /* White circle if bg is colored? Image shows it white circle on possibly light grey? */
        /* Actually image 0: Title 'Beranda' is on the light grey background. User pill is on right. */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
    }
    
    .user-info {
        text-align: right;
        margin-right: 5px;
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

    /* Cards Section */
    .cards-section {
        display: flex;
        gap: 25px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .info-card {
        border-radius: 20px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        min-width: 240px;
        flex: 1;
    }

    /* Total Matakuliah Specifics */
    .card-blue {
        background-color: #dbeafe; /* Light blue like image */
        color: #1e3a5f;
    }
    
    .card-icon-large {
        width: 50px;
        height: 50px;
        /* Icon styling */
    }

    .card-value {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        margin-top: 5px;
    }

    .card-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #475569;
    }

    /* Jadwal Today Cards */
    .card-white {
        background-color: white;
        color: #334155;
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

    /* Table Section */
    .section-header {
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #334155;
    }

    .table-responsive {
        background: white;
        border-radius: 20px;
        padding: 20px; /* Outer padding like in image */
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .styled-table th {
        text-align: left;
        padding: 15px 20px;
        font-weight: 700;
        color: #334155;
    }

    .styled-table td {
        padding: 15px 20px;
        color: #475569;
        font-weight: 500;
    }

    /* Striped rows matching image */
    .styled-table tbody tr:nth-child(odd) {
        background-color: #eff6ff; /* Light blue stripes */
    }
    
    .styled-table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }
    
    .styled-table tbody tr:hover {
        background-color: #e0f2fe; /* Hover highlight */
    }

    /* Rounded corners for first/last cells in rows for aesthetics if needed, 
       but standard stripes are usually full width. 
       Image shows the colored rows have no border radius internal? 
       Actually image shows the blue row is rounded? No, standard table.
    */
</style>

<!-- Header -->
<div class="dashboard-header">
    <div class="page-title">
        <!-- Grid Icon -->
        <svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><rect x="3" y="3" width="7" height="7" rx="1"></rect><rect x="14" y="3" width="7" height="7" rx="1"></rect><rect x="14" y="14" width="7" height="7" rx="1"></rect><rect x="3" y="14" width="7" height="7" rx="1"></rect></svg>
        Beranda
    </div>
    
    <div class="user-pill">
        <div class="user-avatar">
            <!-- Simplified User Circle White -->
             <svg width="45" height="45" viewBox="0 0 45 45" fill="none">
                <circle cx="22.5" cy="22.5" r="22.5" fill="white"/>
            </svg>
        </div>
        <div class="user-info">
            <div class="user-name">{{ $user->name ?? 'Dr. Syauqi' }}</div>
            <div class="user-role">Dosen</div>
        </div>
        <div style="color: #475569; margin-left: 5px;">▼</div>
    </div>
</div>

<!-- Stats Cards -->
<div class="cards-section">
    <!-- Total MK -->
    <div class="info-card card-blue">
        <!-- Stack Icon -->
        <div style="opacity: 0.7;">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </div>
        <div>
            <div class="card-label">Total Matakuliah</div>
            <div class="card-value">{{ $totalMatakuliah ?? 4 }}</div>
        </div>
    </div>

    <!-- Jadwal Hari Ini 1 -->
    <!-- We iterate if multiple, but image shows 2 specific cards. Let's loop. -->
    @forelse($jadwalHariIni as $jadwal)
    <div class="info-card card-white">
        <div class="schedule-icon-box">
           <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </div>
        <div>
            <div class="schedule-label">Jadwal Hari Ini</div>
            <div class="schedule-time">{{ $jadwal->jam }}</div>
            <div class="schedule-subject">{{ $jadwal->matakuliah->nama }}</div>
        </div>
    </div>
    @empty
    <!-- Empty State -->
    <div class="info-card card-white">
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
<div class="section-header">
    <h3 class="section-title">Jadwal Mengajar</h3>
</div>

<div class="table-responsive">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Mata Kuliah</th>
                <th>sks</th>
                <th>Kelas</th>
                <th>Ruang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaJadwal as $jadwal)
            <tr>
                <td>{{ $jadwal->hari }}</td>
                <td>{{ $jadwal->jam }}</td>
                <td>{{ $jadwal->matakuliah->nama }}</td>
                <td>{{ $jadwal->matakuliah->sks }}</td>
                <td>{{ $jadwal->kelas ?? '-' }}</td>
                <td>{{ $jadwal->ruang ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #94a3b8; padding: 30px;">Belum ada jadwal mengajar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
