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
    // 4. Kayıt olma sayfasını kullanıcıya gösteren metod
    public function showRegister()
    {
        return view('register');
    }

    // 5. Formdan gelen verilerle yeni kullanıcı oluşturan metod
    public function register(\Illuminate\Http\Request $request)
    {
        // Form verilerini doğruluyoruz (Şifrelerin eşleşmesi ve e-postanın benzersiz olması dahil)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'], // 'confirmed' otomatik olarak password_confirmation alanı ile eşleştirir
        ]);

        // Yeni kullanıcıyı veritabanına kaydediyoruz
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password), // Şifreyi güvenli bir şekilde hash'liyoruz
        ]);

        // KILAVUZDAKİ EN KRİTİK NOKTA: Yeni kayıt olan kullanıcıya varsayılan olarak 'user' rolünü bağlıyoruz
        // (Dün veritabanında oluşturduğumuz 'user' rolünün ID'si 2 idi)
        $user->roles()->attach(2);

        // Kayıt işleminden sonra kullanıcıyı otomatik olarak sisteme giriş yaptırıyoruz
        \Illuminate\Support\Facades\Auth::login($user);

        // Kullanıcıyı ana sayfaya başarıyla yönlendiriyoruz
        return redirect('/')->with('success', 'Hesabınız başarıyla oluşturuldu ve giriş yapıldı!');
    }
}
