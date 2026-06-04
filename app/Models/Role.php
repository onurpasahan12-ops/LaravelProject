<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    // Veritabanına toplu veri eklenebilmesi için bu alana izin veriyoruz
    protected $fillable = ['name'];

    // Bir rolün birden fazla kullanıcısı olabilir (Çoka-Çok / Many-to-Many ilişkisi)
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
