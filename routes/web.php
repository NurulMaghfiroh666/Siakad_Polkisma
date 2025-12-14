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
use App\Http\Controllers\Dosen\DashboardController as DosenDashboard;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Dosen Routes
    Route::prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenDashboard::class, 'index'])->name('dashboard');
        Route::get('/pesan', [DosenDashboard::class, 'pesan'])->name('pesan');
        Route::get('/jadwal', [DosenDashboard::class, 'jadwal'])->name('jadwal');
        Route::get('/mata-kuliah', [DosenDashboard::class, 'matakuliah'])->name('matakuliah');
        Route::get('/biodata', [DosenDashboard::class, 'biodata'])->name('biodata');
        
        // Profile & Password Routes
        Route::get('/profile/edit', [DosenDashboard::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [DosenDashboard::class, 'updateProfile'])->name('profile.update');
        Route::get('/password/edit', [DosenDashboard::class, 'editPassword'])->name('password.edit');
        Route::put('/password/update', [DosenDashboard::class, 'updatePassword'])->name('password.update');
    });

    // Mahasiswa Routes
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaDashboard::class, 'index'])->name('dashboard');
        Route::get('/pesan', [MahasiswaDashboard::class, 'pesan'])->name('pesan');
        Route::get('/jadwal', [MahasiswaDashboard::class, 'jadwal'])->name('jadwal');
        Route::get('/mata-kuliah', [MahasiswaDashboard::class, 'matakuliah'])->name('matakuliah');
        Route::get('/akademik', [MahasiswaDashboard::class, 'akademik'])->name('akademik');
        Route::get('/biodata', [MahasiswaDashboard::class, 'biodata'])->name('biodata');
    });
});
