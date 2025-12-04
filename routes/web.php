<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
<<<<<<< HEAD
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
    
    // Profile Routes - FIXED: Gunakan name yang benar
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    });
    
    // Permintaan Routes
    Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');
});

// ===== ADMIN ROUTES  =====
Route::middleware(['auth.check', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

=======
use App\Http\Controllers\AdminController;

//admin

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


// user
Route::get('/', [HomeController::class, 'index'])->name('home');
>>>>>>> e9ebf2e08163f7bdafeadb8ea2fdc815a2b6c61d
