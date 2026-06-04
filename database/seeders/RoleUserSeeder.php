<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Rolleri oluşturuyoruz
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // 2. Test Admin Kullanıcısı Oluşturuyoruz
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@mysite.com',
            'password' => Hash::make('12345'), // Giriş şifremiz: 12345
        ]);
        // Admin kullanıcısına hem admin hem user rolünü bağlıyoruz
        $adminUser->roles()->attach([$adminRole->id, $userRole->id]);

        // 3. Normal Test Kullanıcısı Oluşturuyoruz
        $regularUser = User::create([
            'name' => 'Regular User',
            'email' => 'user@mysite.com',
            'password' => Hash::make('12345'), // Giriş şifremiz: 12345
        ]);
        // Normal kullanıcıya sadece user rolünü bağlıyoruz
        $regularUser->roles()->attach([$userRole->id]);
    }
}
