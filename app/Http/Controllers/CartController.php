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
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Eğer ürün sepette zaten varsa miktarını artır
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Yoksa yeni ürün olarak ekle
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "description" => $product->description
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Ürün sepete başarıyla eklendi!');
    }

    // Sepetten Ürün Çıkarır
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı!');
    }
}
