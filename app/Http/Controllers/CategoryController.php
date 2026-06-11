<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Kategorileri Listeler
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Kategori Ekleme Sayfası
    public function create()
    {
        return view('admin.categories.create');
    }

    // Kategoriyi Veritabanına Kaydeder
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Otomatik slug üretir
        ]);

        return redirect('/admin/categories')->with('success', 'Kategori başarıyla eklendi!');
    }

    // Kategoriyi Siler
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/admin/categories')->with('success', 'Kategori silindi!');
    }
}
