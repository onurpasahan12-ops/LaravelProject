<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Veritabanına toplu olarak kaydedilmesine izin verdiğimiz sütunlar:
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description'
    ];
}
