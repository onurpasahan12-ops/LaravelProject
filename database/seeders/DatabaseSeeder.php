<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Bizim oluşturduğumuz RoleUserSeeder'ı buraya çağırıyoruz
        $this->call(RoleUserSeeder::class);
    }
}
