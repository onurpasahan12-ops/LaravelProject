<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        // 🌟 SİPARİŞ ENTEGRASYONU: Kullanıcıların verdiği son siparişi hafızadan çekiyoruz
        // Sunumda her yeni sipariş verildiğinde bu liste güncellenecek
        $latestOrder = session()->get('completed_order');

        return view('admin.dashboard', compact('products', 'categories', 'latestOrder'));
    }
}
