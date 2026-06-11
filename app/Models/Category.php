<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 🌟 SİHİRLİ SATIR: Hangi alanların formdan topluca yüklenebileceğini izin veriyoruz
    protected $fillable = ['name', 'slug'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
