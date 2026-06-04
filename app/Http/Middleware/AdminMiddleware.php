<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kullanıcı giriş yapmış mı ve giriş yapan kullanıcının 'admin' rolü var mı kontrol et
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request); // Eğer admin ise geçişe izin ver
        }

        // 2. Eğer admin değilse, ana sayfaya geri gönder ve hata mesajı ver
        return redirect('/')->with('error', 'Bu sayfaya erişim yetkiniz bulunmamaktadır.');
    }
}
