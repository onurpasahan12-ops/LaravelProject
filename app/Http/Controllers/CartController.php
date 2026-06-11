<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Sepet Sayfasını Gösterir
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Sepete Ürün Ekler
    // Sepete Ürün Ekler
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "description" => $product->description
            ];
        }

        session()->put('cart', $cart);

        // back() yerine direkt ana sayfaya yönlendiriyoruz
        return redirect('/')->with('success', 'Ürün sepete eklendi!');
    }

    // Sepetten Ürün Çıkarır
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        // back() yerine direkt sepet sayfasına yönlendiriyoruz
        return redirect('/cart')->with('success', 'Ürün sepetten çıkarıldı!');
    }
    // Kullanıcıyı Ödeme ve Adres Formu Sayfasına Gönderir
    public function checkout()
    {
        $cart = session()->get('cart', []);

        // Eğer sepet boşsa ödeme sayfasına gitmesin, geri fırlatsın
        if(empty($cart)) {
            return redirect('/cart')->with('error', 'Sepetiniz boş olduğu için ödeme yapılamaz!');
        }

        return view('cart.checkout', compact('cart'));
    }

    // Siparişi Alır, Sepeti Boşaltır ve Başarılı Sayfasına Gönderir
    // Siparişi Alır, Stokları Düşer, Sepeti Boşaltır
    public function placeOrder(Request $request)
    {
        // Form doğrulama
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string'
        ]);

        $cart = session()->get('cart', []);

        // Eğer sepet boşsa işleme devam etmesin
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Sepetiniz boş!');
        }

        // 🌟 SİHİRLİ DOKUNUŞ: Sepetteki her ürün için veritabanında stok düşüyoruz
        foreach ($cart as $id => $details) {
            // Veritabanından ilgili ürünü buluyoruz
            $product = \App\Models\Product::find($id);

            if ($product) {
                // Eğer mevcut stok, istenen adetten azsa negatif stoğa düşmesin diye koruma
                if ($product->stock >= $details['quantity']) {
                    $product->stock = $product->stock - $details['quantity'];
                } else {
                    // Stok yetersiz kalırsa sıfıra eşitliyoruz
                    $product->stock = 0;
                }

                $product->save(); // Yeni stoğu veritabanına kaydet!
            }
        }

        // Sunum özeti için sipariş bilgilerini session'a alıyoruz
        $completedOrder = [
            'customer' => $request->name,
            'items' => $cart,
            'order_number' => 'ORD-' . rand(100000, 999999)
        ];

        session()->put('completed_order', $completedOrder);

        // Sepeti tamamen boşaltıyoruz
        session()->forget('cart');

        return view('cart.success');
    }
}
