@extends('layouts.app')

@section('title', 'SIAKAD POLKISMA')

@section('content')
<div class="login-container" style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #fce4ec; flex-direction: column;">
    <div class="login-box" style="text-align: center; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <h2 style="color: #d81b60; margin-bottom: 30px;">SIAKAD <br> POLITEKNIK PAKIS MALANG</h2>
        <p style="margin-bottom: 30px; color: #666;">Selamat Datang di Sistem Informasi Akademik</p>
        
        <a href="{{ route('login') }}" class="btn-primary" style="background-color: #d81b60; color: white; border: none; padding: 12px 30px; border-radius: 25px; text-decoration: none; display: inline-block;">LOGIN SEKARANG</a>
    </div>
</div>
@endsection
