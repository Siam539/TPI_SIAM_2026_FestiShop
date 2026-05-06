<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Kazi',
            'last_name' => 'Siam',
            'email' => 'kazi.siam08@gmail.com',
            'phone' => '+41786405091',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

         User::create([
            'first_name' => 'Manager',
            'last_name' => 'Livreur',
            'email' => 'kazi.siam09@gmail.com',
            'phone' => '+41786405092',
            'password' => bcrypt('12345678'),
            'role' => 'manutentionnaire',
        ]);
    }
}
