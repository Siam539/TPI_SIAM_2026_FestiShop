<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Crée les comptes de test : un admin et un manutentionnaire.
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Main',
            'email' => 'admin@gmail.com',
            'phone' => '+41786405091',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

         User::create([
            'first_name' => 'Manager',
            'last_name' => 'Livreur',
            'email' => 'manager@gmail.com',
            'phone' => '+41786405092',
            'password' => bcrypt('12345678'),
            'role' => 'manutentionnaire',
        ]);
    }
}
