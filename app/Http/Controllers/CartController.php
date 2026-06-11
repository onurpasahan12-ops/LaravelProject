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
}
