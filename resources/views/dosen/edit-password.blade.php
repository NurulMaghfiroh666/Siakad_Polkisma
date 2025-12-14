@extends('layouts.dashboard')

@section('title', 'Ganti Password - Dashboard Dosen')

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
<div class="page-header fade-in">
    <div class="page-title">
        <a href="{{ route('dosen.biodata') }}" style="color: inherit; text-decoration: none; display: flex; align-items: center; gap: 10px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"></path><path d="M12 19l-7-7 7-7"></path></svg>
            Ganti Password
        </a>
    </div>
</div>

<div class="card fade-in" style="max-width: 600px; margin: 0 auto; padding: 30px;">
    <form action="{{ route('dosen.password.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-4">
            <label for="current_password" class="form-label">Password Lama</label>
            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
            @error('current_password')
                <div class="invalid-feedback" style="color: #ef4444; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="new_password" class="form-label">Password Baru</label>
            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
            @error('new_password')
                <div class="invalid-feedback" style="color: #ef4444; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
            <small class="text-muted">Minimal 8 karakter.</small>
        </div>

        <div class="form-group mb-4">
            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('dosen.biodata') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
        </div>
    </form>
</div>
@endsection
