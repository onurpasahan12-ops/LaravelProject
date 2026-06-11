<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;

// Ana Sayfa - Ürünleri veritabanından çekip vitrine gönderir
Route::get('/', function () {
    $products = \App\Models\Product::all();
    return view('welcome', compact('products'));
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

    // Admin Panel Ana Sayfası
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Ürün Ekleme Sayfasını Gösteren Rota
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');

    // Formdan Gelen Ürün Verilerini Veritabanına Kaydeden POST Rota
    Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');

    // Ürün silme işlemini gerçekleştiren DELETE rotası
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Ürün düzenleme sayfasını açan GET rotası
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

    // Ürün bilgilerini güncelleyen PUT rotası
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('products.update');

}); // <--- ADMIN GRUBU BURADA TERTEMİZ KAPANDI!


// 🛒 SEPET ROTALARI - HERKESE AÇIK, ÖZGÜR VE EN ALTTA
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);
// routes/web.php en alt kısım:
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);

// YENİ EKLENEN SİPARİŞ ROTALARI
Route::get('/checkout', [CartController::class, 'checkout']);
Route::post('/order/place', [CartController::class, 'placeOrder']);
