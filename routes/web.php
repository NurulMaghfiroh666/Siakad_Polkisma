<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\KrsController as AdminKrsController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboard;
use App\Http\Controllers\Dosen\NilaiController as DosenNilaiController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use App\Http\Controllers\Mahasiswa\AkademikController as MahasiswaAkademikController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Mahasiswa Management
    Route::resource('mahasiswa', AdminMahasiswaController::class);
    
    // Dosen Management
    Route::resource('dosen', AdminDosenController::class);
    
    // Mata Kuliah Management
    Route::resource('matakuliah', \App\Http\Controllers\Admin\MatakuliahController::class, ['parameters' => ['matakuliah' => 'kodeMK']]);
    
    // KRS Management
    Route::get('/krs', [AdminKrsController::class, 'index'])->name('krs.index');
    Route::get('/krs/create', [AdminKrsController::class, 'create'])->name('krs.create');
    Route::post('/krs', [AdminKrsController::class, 'store'])->name('krs.store');
    Route::get('/krs/{id}', [AdminKrsController::class, 'show'])->name('krs.show');
    Route::post('/krs/{id}/add', [AdminKrsController::class, 'addMatakuliah'])->name('krs.add');
    Route::delete('/krs/detail/{id}', [AdminKrsController::class, 'removeMatakuliah'])->name('krs.remove');
    Route::delete('/krs/{id}', [AdminKrsController::class, 'destroy'])->name('krs.destroy');
    
    // Jadwal Management
    Route::resource('jadwal', AdminJadwalController::class);
});

Route::middleware(['auth'])->group(function () {
    // Dosen Routes
    Route::middleware(['role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenDashboard::class, 'index'])->name('dashboard');
        Route::get('/pesan', [DosenDashboard::class, 'pesan'])->name('pesan');
        Route::get('/jadwal', [DosenDashboard::class, 'jadwal'])->name('jadwal');
        Route::get('/mata-kuliah', [DosenDashboard::class, 'matakuliah'])->name('matakuliah');
        Route::get('/biodata', [DosenDashboard::class, 'biodata'])->name('biodata');
        
        // Input Nilai Routes
        Route::get('/nilai', [DosenNilaiController::class, 'index'])->name('nilai.index');
        Route::get('/nilai/{jadwal}', [DosenNilaiController::class, 'show'])->name('nilai.show');
        Route::post('/nilai/store', [DosenNilaiController::class, 'store'])->name('nilai.store');
        
        // Profile & Password Routes
        Route::get('/profile/edit', [DosenDashboard::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [DosenDashboard::class, 'updateProfile'])->name('profile.update');
        Route::get('/password/edit', [DosenDashboard::class, 'editPassword'])->name('password.edit');
        Route::put('/password/update', [DosenDashboard::class, 'updatePassword'])->name('password.update');
    });

    // Mahasiswa Routes
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaDashboard::class, 'index'])->name('dashboard');
        Route::get('/pesan', [MahasiswaDashboard::class, 'pesan'])->name('pesan');
        Route::get('/jadwal', [MahasiswaDashboard::class, 'jadwal'])->name('jadwal');
        Route::get('/mata-kuliah', [MahasiswaDashboard::class, 'matakuliah'])->name('matakuliah');
        Route::get('/akademik', [MahasiswaDashboard::class, 'akademik'])->name('akademik');
        Route::get('/biodata', [MahasiswaDashboard::class, 'biodata'])->name('biodata');
        
        // KRS & KHS Routes
        Route::get('/krs', [MahasiswaAkademikController::class, 'krs'])->name('krs');
        Route::get('/khs/{semester?}', [MahasiswaAkademikController::class, 'khs'])->name('khs');
    });
});
