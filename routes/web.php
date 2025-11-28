<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

//admin

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


// user
Route::get('/', [HomeController::class, 'index'])->name('home');