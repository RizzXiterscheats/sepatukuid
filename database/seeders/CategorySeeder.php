<?php

namespace Database\Seeders;

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
                'name' => 'Lifestyle', 
                'slug' => 'lifestyle', 
                'description' => 'Sepatu kasual untuk gaya hidup sehari-hari', 
                'image' => 'https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=800',
                'is_active' => true
            ],
            [
                'name' => 'Running', 
                'slug' => 'running', 
                'description' => 'Sepatu khusus lari dengan performa tinggi', 
                'image' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=800',
                'is_active' => true
            ],
            [
                'name' => 'Basketball', 
                'slug' => 'basketball', 
                'description' => 'Sepatu basket dengan dukungan ankle maksimal', 
                'image' => 'https://images.unsplash.com/photo-1518002171953-a080ee817e1f?q=80&w=800',
                'is_active' => true
            ],
            [
                'name' => 'Training', 
                'slug' => 'training', 
                'description' => 'Sepatu untuk gym dan fitness', 
                'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=800',
                'is_active' => true
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
