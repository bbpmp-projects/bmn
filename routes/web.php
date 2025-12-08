<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\ProfileController;

// ===== PUBLIC ROUTES (Tidak perlu login) =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin-register', [AdminController::class, 'showAdminRegister'])->name('admin.register.form');
Route::post('/admin-register', [AdminController::class, 'storeAdmin'])->name('admin.register.store');

// ===== GUEST ROUTES (Hanya untuk yang BELUM login) =====
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('/forgot-password', 'showForgotPasswordForm')->name('password.request');
        Route::post('/forgot-password', 'forgotPassword')->name('password.email');
    });

    // Register Routes
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register');
        
        // AJAX validation routes (optional)
        Route::post('/check-username', 'checkUsername')->name('check.username');
        Route::post('/check-email', 'checkEmail')->name('check.email');
        Route::post('/check-nip', 'checkNip')->name('check.nip');
    });
});

// ===== AUTHENTICATED ROUTES USERS =====
Route::middleware('auth.check')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    });
    
    // Permintaan Routes
    Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');
    Route::get('/api/barang-by-kategori/{id_kategori}', [PermintaanController::class, 'getBarangByKategori']);
    Route::post('/api/search-barang', [PermintaanController::class, 'searchBarang']);
    Route::post('/permintaan/submit', [PermintaanController::class, 'submitPermintaan'])->name('permintaan.submit');
    
    // Status dan Riwayat Permintaan
    Route::get('/permintaan/status', [PermintaanController::class, 'statusPermintaan'])->name('permintaan.status');
    
    // API untuk mendapatkan data detail permintaan (untuk modal)
    Route::get('/permintaan/detail-data/{id}', [PermintaanController::class, 'getDetailPermintaan'])->name('permintaan.detail.data');
    
    // Route halaman detail (optional - bisa dihapus atau dipertahankan untuk akses langsung)
    Route::get('/permintaan/detail/{kode_permintaan}', [PermintaanController::class, 'detailPermintaan'])->name('permintaan.detail');
    Route::get('/permintaan/riwayat', [PermintaanController::class, 'riwayatPermintaan'])->name('permintaan.riwayat');

    // Daftar Barang
    Route::get('/barang/daftar', [PermintaanController::class, 'daftarBarang'])->name('barang.daftar');
    Route::get('/api/barang/daftar', [PermintaanController::class, 'getDaftarBarang'])->name('api.barang.daftar');
});

// ===== ADMIN ROUTES =====
Route::middleware(['auth.check', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});