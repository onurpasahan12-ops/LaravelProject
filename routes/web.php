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
// KAYIT İŞLEMLERİ ROTALARI
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Sadece Giriş Yapmış ve Admin Olanların Rotaları
Route::middleware(['auth', 'admin'])->group(function () {

    // Düz yazı yerine artık admin klasörünün altındaki dashboard dosyasını açıyoruz
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

});
