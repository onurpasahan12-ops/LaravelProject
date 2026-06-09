<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Veritabanındaki ürünleri çekip arayüze gönderiyoruz
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }
}
