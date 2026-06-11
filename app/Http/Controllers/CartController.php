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
    public function placeOrder(Request $request)
    {
        // Basit bir adres formu doğrulaması
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string'
        ]);

        // Sunumda hocaya göstermek için sipariş özetini session'da geçici tutalım
        $completedOrder = [
            'customer' => $request->name,
            'items' => session()->get('cart', []),
            'order_number' => 'ORD-' . rand(100000, 999999)
        ];

        session()->put('completed_order', $completedOrder);

        // Sipariş tamamlandığı için sepeti tamamen temizliyoruz!
        session()->forget('cart');

        return view('cart.success');
    }
}
