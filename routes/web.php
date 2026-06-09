<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

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


// 🔐 SADECE GİRİŞ YAPMIŞ VE ADMIN OLANLARIN ERİŞEBİLECEĞİ GÜVENLİ ALAN
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin Panel Ana Sayfası (DashboardController'a bağladık ki veritabanından ürünleri çeksin)
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Ürün Ekleme Sayfasını Gösteren Rota (Form Sayfası)
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');

    // Formdan Gelen Ürün Verilerini Veritabanına Kaydeden POST Rota
    Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');

});
