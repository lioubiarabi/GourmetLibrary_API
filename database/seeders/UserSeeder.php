<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Chef',
            'email' => 'admin@gmail.com',
            'phone' => '0600000000',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Reader Gourmand',
            'email' => 'reader@gmail.com',
            'phone' => '0611111111',
            'role' => 'reader',
            'password' => Hash::make('password'),
        ]);
    }
}
