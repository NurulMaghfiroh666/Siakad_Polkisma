@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="dashboard-container">
    <header style="background: white; padding: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h3>SIAKAD Mahasiswa</h3>
        <div class="user-info">
            <span>{{ Auth::user()->name }} ({{ Auth::user()->mahasiswa->nim ?? 'NIM' }})</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #d81b60; cursor: pointer; margin-left: 15px;">Keluar</button>
            </form>
        </div>
    </header>

    <main style="padding: 40px; max-width: 1200px; margin: 0 auto;">
        <h1 style="color: #333; margin-bottom: 30px;">Selamat Datang, {{ Auth::user()->name }}</h1>

        <div class="menu-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <!-- KRS -->
            <div class="menu-card" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div class="icon" style="font-size: 40px; color: #d81b60; margin-bottom: 15px;">📋</div>
                <h3>KRS Online</h3>
            </div>

            <!-- KHS/Transkrip -->
            <div class="menu-card" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div class="icon" style="font-size: 40px; color: #d81b60; margin-bottom: 15px;">📊</div>
                <h3>Transkrip & KHS</h3>
            </div>

            <!-- Jadwal -->
            <div class="menu-card" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div class="icon" style="font-size: 40px; color: #d81b60; margin-bottom: 15px;">📅</div>
                <h3>Jadwal Kuliah</h3>
            </div>
            
            <!-- Keuangan -->
            <div class="menu-card" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div class="icon" style="font-size: 40px; color: #d81b60; margin-bottom: 15px;">💰</div>
                <h3>Keuangan</h3>
            </div>
        </div>
    </main>
</div>
@endsection
