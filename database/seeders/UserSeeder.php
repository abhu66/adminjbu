<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Gojo Satoru',
            'email' => 'gojo@mail.com',
            'password' => Hash::make('admin123'), // Password yang sudah di-hash
        ]);
    }
}
