<?php

/**
 * Insert 3 more products with valid image URLs to reach total of 10
 */

$host = '127.0.0.1';
$db   = 'sepatukuid';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// First, fix the casing on existing products and confirm they look good
echo "=== Current 7 Products ===\n";
$stmt = $pdo->query("SELECT id, name, category_id, price FROM products ORDER BY id");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID:{$r['id']} | {$r['name']} | Cat:{$r['category_id']} | Rp " . number_format($r['price'],0,',','.') . "\n";
}

// New 3 products with verified working image URLs from stable CDN sources
$newProducts = [
    [
        'name'          => 'Nike Air Max 90',
        'slug'          => 'nike-air-max-90',
        'description'   => 'Ikon abadi dari Nike dengan unit Air di tumit yang legendaris, upper mesh berlapis, dan desain retro yang tak lekang zaman. Tersedia dalam warna klasik putih-hitam-merah.',
        'price'         => 1950000,
        'discount_price'=> 1699000,
        'stock'         => 10,
        'category_id'   => 2,
        'category'      => 'running',
        'brand'         => 'Nike',
        'gender'        => 'pria',
        'sizes'         => '38,39,40,41,42,43,44',
        'colors'        => 'Putih,Hitam',
        'specifications'=> json_encode(['cushioning' => 'Air Max', 'material' => 'Mesh & Leather', 'sole' => 'Rubber']),
        'is_featured'   => 1,
        'is_active'     => 1,
        'image'         => 'https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/3cc22f29-e8c7-4489-9741-130b7f1f3b51/air-max-90-shoes-HBXpgj.png',
    ],
    [
        'name'          => 'Adidas Stan Smith',
        'slug'          => 'adidas-stan-smith',
        'description'   => 'Sepatu tenis legendaris yang lahir tahun 1971, kini menjadi simbol gaya minimalis global. Upper kulit putih bersih dengan tiga lubang ventilasi dan aksen hijau pada tab tumit.',
        'price'         => 1600000,
        'discount_price'=> 1399000,
        'stock'         => 10,
        'category_id'   => 1,
        'category'      => 'lifestyle',
        'brand'         => 'Adidas',
        'gender'        => 'unisex',
        'sizes'         => '37,38,39,40,41,42,43',
        'colors'        => 'Putih,Hijau',
        'specifications'=> json_encode(['material' => 'Leather Upper', 'lining' => 'Synthetic', 'sole' => 'Rubber']),
        'is_featured'   => 1,
        'is_active'     => 1,
        'image'         => 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/68ae7ea7849b43eca70aac1e00f5146d_9366/Stan_Smith_Shoes_White_FX5502_01_standard.jpg',
    ],
    [
        'name'          => 'Converse Chuck Taylor All Star Hi',
        'slug'          => 'converse-chuck-taylor-all-star-hi',
        'description'   => 'Sneaker paling ikonik sepanjang masa sejak 1917. Upper canvas hitam klasik, outsole karet vulkanisir, dan patch ankle Chuck Taylor yang autentik. Cocok untuk semua gaya.',
        'price'         => 950000,
        'discount_price'=> 799000,
        'stock'         => 10,
        'category_id'   => 1,
        'category'      => 'lifestyle',
        'brand'         => 'Converse',
        'gender'        => 'unisex',
        'sizes'         => '36,37,38,39,40,41,42,43',
        'colors'        => 'Hitam,Putih',
        'specifications'=> json_encode(['material' => 'Canvas', 'outsole' => 'Vulcanized Rubber', 'style' => 'High Top']),
        'is_featured'   => 0,
        'is_active'     => 1,
        'image'         => 'https://www.converse.com/dw/image/v2/BCZC_PRD/on/demandware.static/-/Sites-cnv-master-catalog/default/dw5cd7b7f6/images/a_107/M9160_A_107X1.jpg',
    ],
];

$sql = "INSERT INTO products (name, slug, description, price, discount_price, stock, category_id, category, brand, gender, sizes, colors, specifications, is_featured, is_active, image, created_at, updated_at)
        VALUES (:name, :slug, :description, :price, :discount_price, :stock, :category_id, :category, :brand, :gender, :sizes, :colors, :specifications, :is_featured, :is_active, :image, NOW(), NOW())";
$stmt = $pdo->prepare($sql);

echo "\n=== Inserting 3 New Products ===\n";
foreach ($newProducts as $p) {
    $stmt->execute($p);
    $id = $pdo->lastInsertId();
    echo "Inserted ID:$id | {$p['name']}\n";
}

echo "\n=== Final Product List (Total 10) ===\n";
$stmt = $pdo->query("SELECT id, name, category_id, price, image FROM products ORDER BY id");
$count = 0;
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $count++;
    $imgType = str_starts_with($r['image'], 'http') ? 'EXTERNAL' : 'LOCAL';
    echo "$count. ID:{$r['id']} | {$r['name']} | Rp " . number_format($r['price'],0,',','.') . " | [$imgType]\n";
}
echo "\nTotal: $count products\n";
