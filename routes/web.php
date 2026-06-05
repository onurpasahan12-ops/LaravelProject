<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Ana Sayfa
Route::get('/', function () {
    return view('welcome');
});

// GİRİŞ İŞLEMLERİ ROTALARI
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Sadece Giriş Yapmış ve Admin Olanların Rotaları
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "Tebrikler! Admin paneline başarıyla giriş yaptınız.";
    })->name('admin.dashboard');
});
