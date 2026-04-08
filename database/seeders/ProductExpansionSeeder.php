<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductExpansionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Nike Air Jordan 1 Low',
                'slug' => 'nike-air-jordan-1-low',
                'price' => 2100000,
                'discount_price' => 1850000,
                'gender' => 'pria',
                'category' => 'Lifestyle',
                'brand' => 'NIKE',
            ],
            [
                'name' => 'Nike Air Force 1 07 LV8',
                'slug' => 'nike-af1-07-lv8',
                'price' => 1700000,
                'discount_price' => 1450000,
                'gender' => 'unisex',
                'category' => 'Lifestyle',
                'brand' => 'NIKE',
            ],
            [
                'name' => 'Adidas Samba OG',
                'slug' => 'adidas-samba-og',
                'price' => 2200000,
                'discount_price' => 1950000,
                'gender' => 'unisex',
                'category' => 'Lifestyle',
                'brand' => 'ADIDAS',
            ],
            [
                'name' => 'Adidas Ultraboost 1.0',
                'slug' => 'adidas-ultraboost-1-0',
                'price' => 3100000,
                'discount_price' => 2650000,
                'gender' => 'wanita',
                'category' => 'Running',
                'brand' => 'ADIDAS',
            ],
            [
                'name' => 'New Balance 550',
                'slug' => 'nb-550',
                'price' => 2000000,
                'discount_price' => 1750000,
                'gender' => 'pria',
                'category' => 'Lifestyle',
                'brand' => 'NEW BALANCE',
            ],
            [
                'name' => 'New Balance 327',
                'slug' => 'nb-327',
                'price' => 1600000,
                'discount_price' => 1350000,
                'gender' => 'wanita',
                'category' => 'Lifestyle',
                'brand' => 'NEW BALANCE',
            ],
            [
                'name' => 'Puma Suede Classic',
                'slug' => 'puma-suede-classic',
                'price' => 1200000,
                'discount_price' => 950000,
                'gender' => 'unisex',
                'category' => 'Lifestyle',
                'brand' => 'PUMA',
            ],
            [
                'name' => 'Vans Old Skool Core Classics',
                'slug' => 'vans-old-skool-core',
                'price' => 950000,
                'discount_price' => 800000,
                'gender' => 'unisex',
                'category' => 'Lifestyle',
                'brand' => 'VANS',
            ],
            [
                'name' => 'Converse Chuck Taylor High',
                'slug' => 'converse-ct-high',
                'price' => 1000000,
                'discount_price' => 850000,
                'gender' => 'unisex',
                'category' => 'Lifestyle',
                'brand' => 'CONVERSE',
            ],
            [
                'name' => 'Nike ZoomX Vaporfly Next 3',
                'slug' => 'nike-vaporfly-next-3',
                'price' => 4200000,
                'discount_price' => 3850000,
                'gender' => 'pria',
                'category' => 'Running',
                'brand' => 'NIKE',
            ],
            [
                'name' => 'Nike Air Max 270',
                'slug' => 'nike-air-max-270',
                'price' => 2300000,
                'discount_price' => 1950000,
                'gender' => 'wanita',
                'category' => 'Lifestyle',
                'brand' => 'NIKE',
            ],
            [
                'name' => 'Asics Gel-Kayano 30',
                'slug' => 'asics-gel-kayano-30',
                'price' => 2600000,
                'discount_price' => 2350000,
                'gender' => 'pria',
                'category' => 'Running',
                'brand' => 'ASICS',
            ]
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['slug' => $p['slug']], array_merge($p, [
                'stock' => 10,
                'is_active' => true,
                'description' => 'Premium sneakers for your lifestyle. High quality materials and comfort. Suitable for daily wear.',
                'sizes' => ['39', '40', '41', '42', '43', '44'],
                'colors' => ['Hitam', 'Putih', 'Abu-abu'],
            ]));
        }
    }
}
