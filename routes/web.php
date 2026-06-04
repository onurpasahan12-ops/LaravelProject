<?php

use Illuminate\Support\Facades\Route;

// 1. Herkesin erişebileceği ana sayfa rotası
Route::get('/', function () {
    return view('welcome');
});

// 2. Sadece giriş yapmış (auth) VE 'admin' rolüne sahip kullanıcıların girebileceği korumalı grup
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin Paneli Ana Sayfası (Örn: /admin/dashboard)
    Route::get('/admin/dashboard', function () {
        return "Tebrikler! Admin paneline başarıyla giriş yaptınız.";
    })->name('admin.dashboard');

});
