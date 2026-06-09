<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Ürün modeliyle konuşabilmek için üste ekledik

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }

    // Formdan gelen ürün verilerini veritabanına kaydeden yeni metod
    public function store(Request $request)
    {
        // 1. Gelen verileri doğruluyoruz
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        // 2. Veritabanına yeni ürünü kayıt ediyoruz
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        // 3. İşlem bitince admin paneline başarı mesajıyla geri gönderiyoruz
        return redirect('/admin/dashboard')->with('success', 'Ürün başarıyla eklendi!');
    }
}
