<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Giriş sayfasını kullanıcıya gösteren metod
    public function showLogin()
    {
        return view('login');
    }

    // 2. Formdan gelen verileri kontrol eden ve giriş yaptıran metod
    public function login(Request $request)
    {
        // Formdan gelen verileri doğruluyoruz
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Giriş bilgilerini veritabanıyla kontrol ediyoruz
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // KILAVUZDAKİ EN KRİTİK NOKTA: Kullanıcı rolüne göre yönlendirme
            if (Auth::user()->hasRole('admin')) {
                // Eğer admin ise doğruca admin paneline gönderiyoruz
                return redirect()->intended('/admin/dashboard');
            }

            // Normal kullanıcı ise ana sayfaya gönderiyoruz
            return redirect()->intended('/');
        }

        // Eğer bilgiler yanlışsa hata mesajıyla geri gönderiyoruz
        return back()->with('error', 'Girdiğiniz bilgiler veritabanımızla eşleşmedi.');
    }

    // 3. Sistemden çıkış yapma metodu
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
