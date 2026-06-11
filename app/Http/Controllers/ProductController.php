<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }

    // Formdan gelen ürün verilerini veritabanına kaydeden metod
    public function store(Request $request)
    {
        // 1. Gelen verileri doğruluyoruz (category_id eklendi)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'], // 🌟 Kategori kontrolü
        ]);

        // 2. Veritabanına yeni ürünü kayıt ediyoruz (category_id eklendi)
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'category_id' => $request->category_id, // 🌟 Veritabanına yazılıyor
        ]);

        // 3. İşlem bitince admin paneline başarı mesajıyla geri gönderiyoruz
        return redirect('/admin/dashboard')->with('success', 'Ürün başarıyla eklendi!');
    }

    // Veritabanından ürünü silen metod
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/admin/dashboard')->with('success', 'Ürün başarıyla silindi!');
    }

    // Düzenleme sayfasını (formunu) mevcut ürün bilgileriyle açan metod
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // 🌟 Düzenleme formunda da kategoriler listelenebilsin diye çektik

        return view('admin.edit', compact('product', 'categories'));
    }

    // Formdan gelen yeni verilerle veritabanını güncelleyen metod
    public function update(Request $request, $id)
    {
        // Güncelleme yaparken de kategoriyi doğruluyoruz
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'], // 🌟 Kategori kontrolü
        ]);

        $product = Product::findOrFail($id);

        // Ürünü güncelliyoruz
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'category_id' => $request->category_id, // 🌟 Kategori güncelleniyor
        ]);

        return redirect('/admin/dashboard')->with('success', 'Ürün başarıyla güncellendi!');
    }
}
