<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Anniversaire',
                'slug' => 'anniversaire',
            ],
            [
                'name' => 'Mariage',
                'slug' => 'mariage',
            ],
            [
                'name' => 'Halloween',
                'slug' => 'halloween',
            ],
            [
                'name' => 'Noël',
                'slug' => 'noel',
            ],
            [
                'name' => 'Prenatal',
                'slug' => 'prenatal',
            ],
            
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
