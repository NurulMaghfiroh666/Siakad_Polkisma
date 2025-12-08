@extends('layouts.app')

@section('title', 'Login - SIAKAD POLKISMA')

@section('content')
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow-x: hidden;
    }
    .login-wrapper {
        display: flex;
        width: 100%;
        height: 100vh;
        background-color: #fff;
    }
    /* Left Side - Image & Branding */
    .login-image-section {
        width: 65%; /* Adjusted width as per design visual */
        position: relative;
        background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=2572&auto=format&fit=crop'); /* Modern University Building */
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 60px;
        color: white;
    }
    .login-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(10, 25, 47, 0.7); /* Dark Blue Overlay */
        z-index: 1;
    }
    .brand-content {
        position: relative;
        z-index: 2;
        max-width: 600px;
    }
    .brand-logo {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        font-size: 1.5rem;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .brand-logo img { /* Placeholder for logo icon */
        width: 40px;
        height: 40px;
        margin-right: 15px;
        filter: invert(1); /* White logo */
    }
    .brand-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
    }
    .brand-subtitle {
        font-size: 1.1rem;
        line-height: 1.6;
        opacity: 0.9;
        font-weight: 300;
    }

    /* Right Side - Login Form */
    .login-form-section {
        width: 35%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa; /* Very subtle grey background for form area contrast */
        padding: 40px;
    }
    .login-card {
        width: 100%;
        max-width: 400px;
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); /* Soft shadow */
    }
    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .form-title {
        color: #333;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    
    /* Role Toggle Switch */
    .role-toggle {
        display: flex;
        justify-content: center;
        margin-bottom: 25px;
        background: #f1f3f5;
        border-radius: 50px;
        padding: 5px;
        position: relative;
    }
    .role-option {
        flex: 1;
        text-align: center;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 50px;
        font-weight: 600;
        color: #666;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }
    .role-option.active {
        color: #2c3e50; /* Darker text for active */
    }
    /* Simple visual toggle indicator */
    .role-input {
        display: none;
    }
    .role-option input:checked + span {
        font-color: #000;
    }
    
    /* Input Styling */
    .input-group {
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 15px;
        background: #eef2f5;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        color: #333;
        transition: all 0.3s;
        box-sizing: border-box; /* Fix padding issues */
    }
    .form-control:focus {
        outline: none;
        background: #e3e8ed;
        box-shadow: 0 0 0 2px rgba(216, 27, 96, 0.2);
    }
    .form-control::placeholder {
        color: #adb5bd;
    }

    /* Button */
    .btn-login {
        width: 100%;
        padding: 15px;
        background: #2c3e50; /* Navy Blue from design */
        color: white;
        border: none;
        border-radius: 30px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-login:hover {
        background: #34495e;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Helpers */
    .text-danger {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 5px;
        list-style: none;
        padding: 0;
    }
    .note-text {
        text-align: center;
        margin-top: 20px;
        font-size: 0.8rem;
        color: #aaa;
    }

    /* Radio Button Logic for Styling */
    input[type="radio"] {
        display: none;
    }
    input[id="role-dosen"]:checked ~ .slider {
        transform: translateX(0%);
    }
    input[id="role-mahasiswa"]:checked ~ .slider {
        transform: translateX(100%);
    }
    .toggle-container {
        display: flex;
        background: #fff;
        border: 2px solid #eef2f5;
        border-radius: 30px;
        overflow: hidden;
        margin-bottom: 25px;
    }
    .toggle-label {
        flex: 1;
        text-align: center;
        padding: 10px;
        cursor: pointer;
        font-weight: 600;
        color: #95a5a6;
        transition: 0.3s;
    }
    .toggle-input:checked + .toggle-label {
        background: #2c3e50;
        color: white;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .login-image-section { display: none; }
        .login-form-section { width: 100%; background: #fff; }
        .login-card { box-shadow: none; padding: 20px; }
    }
</style>

<div class="login-wrapper">
    <!-- Left Section -->
    <div class="login-image-section">
        <div class="login-overlay"></div>
        <div class="brand-content">
            <div class="brand-logo">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 15px;"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                POLKISMA
            </div>
            <div class="brand-title">
                SIAKAD<br>
                POLITEKNIK<br>
                PAKIS<br>
                MALANG
            </div>
            <div class="brand-subtitle">
                Hi!, Siap belajar hari ini? Sistem terpadu ini membantu memudahkan seluruh aktivitas akademikmu.
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="login-form-section">
        <div class="login-card">
            @if ($errors->any())
                <ul class="text-danger" style="margin-bottom: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-header">
                    <div class="form-title">LOGIN SIAKAD</div>
                    <!-- Role Toggle -->
                    <div class="toggle-container">
                        <input type="radio" id="dosen" name="role" value="dosen" class="toggle-input" checked onchange="updatePlaceholder()">
                        <label for="dosen" class="toggle-label">Dosen</label>
                        
                        <input type="radio" id="mahasiswa" name="role" value="mahasiswa" class="toggle-input" onchange="updatePlaceholder()">
                        <label for="mahasiswa" class="toggle-label">Mahasiswa</label>
                    </div>
                </div>

                <div class="input-group">
                    <input type="text" id="login_id_input" name="login_id" class="form-control" placeholder="NIP..." value="{{ old('login_id') }}" required autofocus>
                </div>
                
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Kata Sandi..." required>
                </div>

                <button type="submit" class="btn-login">MASUK</button>
            </form>

            <p class="note-text">Belum Punya Akun? Hubungi Administrasi Kampus.</p>
        </div>
    </div>
</div>

<script>
    function updatePlaceholder() {
        const isDosen = document.getElementById('dosen').checked;
        const input = document.getElementById('login_id_input');
        if (isDosen) {
            input.placeholder = "NIP...";
        } else {
            input.placeholder = "NIM...";
        }
    }
</script>
@endsection
