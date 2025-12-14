@extends('layouts.dashboard')

@section('title', 'Pesan - Dashboard Mahasiswa')

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
    <a href="{{ route('mahasiswa.pesan') }}" class="nav-link active">
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
    <a href="{{ route('mahasiswa.matakuliah') }}" class="nav-link">
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

    .messages-container {
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 20px;
        height: calc(100vh - 200px);
    }

    .message-list {
        background: white;
        border-radius: 20px;
        padding: 20px;
        overflow-y: auto;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .message-item {
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }

    .message-item:hover {
        background: #f8f9fa;
    }

    .message-item.active {
        background: #eff6ff;
        border-left-color: #3b82f6;
    }

    .message-item.unread {
        background: #f0f9ff;
        font-weight: 600;
    }

    .message-sender {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .message-preview {
        font-size: 0.875rem;
        color: #64748b;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .message-time {
        font-size: 0.75rem;
        color: #94a3b8;
        margin-top: 5px;
    }

    .message-detail {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
    }

    .message-header {
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 20px;
    }

    .message-subject {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .message-meta {
        display: flex;
        gap: 20px;
        font-size: 0.875rem;
        color: #64748b;
    }

    .message-body {
        flex: 1;
        overflow-y: auto;
        line-height: 1.6;
        color: #475569;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #94a3b8;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
        opacity: 0.5;
    }
</style>

<div class="page-header fade-in">
    <div class="page-title">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        Pesan
    </div>
    <button class="btn btn-primary">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Pesan Baru
    </button>
</div>

<div class="messages-container fade-in">
    <!-- Message List -->
    <div class="message-list">
        <h3 style="margin-bottom: 20px; font-size: 1.1rem; font-weight: 700; color: #334155;">Kotak Masuk</h3>
        
        @forelse($messages ?? [] as $message)
        <div class="message-item {{ $loop->first ? 'active' : '' }} {{ $message->is_read ? '' : 'unread' }}">
            <div class="message-sender">{{ $message->sender_name ?? 'Admin' }}</div>
            <div class="message-preview">{{ Str::limit($message->subject ?? 'Tidak ada subjek', 50) }}</div>
            <div class="message-time">{{ $message->created_at ? $message->created_at->diffForHumans() : 'Baru saja' }}</div>
        </div>
        @empty
        <div style="text-align: center; padding: 40px 20px; color: #94a3b8;">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 15px;"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
            <p>Belum ada pesan</p>
        </div>
        @endforelse
    </div>

    <!-- Message Detail -->
    <div class="message-detail">
        @if(isset($messages) && count($messages) > 0)
        <div class="message-header">
            <div class="message-subject">{{ $messages[0]->subject ?? 'Selamat Datang di SIAKAD' }}</div>
            <div class="message-meta">
                <span><strong>Dari:</strong> {{ $messages[0]->sender_name ?? 'Admin SIAKAD' }}</span>
                <span><strong>Tanggal:</strong> {{ $messages[0]->created_at ? $messages[0]->created_at->format('d M Y, H:i') : date('d M Y, H:i') }}</span>
            </div>
        </div>
        <div class="message-body">
            <p>{{ $messages[0]->body ?? 'Selamat datang di Sistem Informasi Akademik POLKISMA. Gunakan menu di sebelah kiri untuk mengakses fitur-fitur yang tersedia.' }}</p>
        </div>
        @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
            <h3>Pilih pesan untuk melihat detail</h3>
            <p>Pesan yang Anda pilih akan ditampilkan di sini</p>
        </div>
        @endif
    </div>
</div>

@endsection
