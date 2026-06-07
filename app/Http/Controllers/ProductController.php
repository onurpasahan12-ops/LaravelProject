<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Ürün ekleme sayfasını (formu) kullanıcıya gösteren metod
    public function create()
    {
        // resources/views/admin/create.blade.php dosyasını açar
        return view('admin.create');
    }
}
