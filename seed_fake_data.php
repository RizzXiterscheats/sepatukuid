<?php

/**
 * Seeding script for SepatukuID:
 * 1. Create 7 realistic users.
 * 2. Create 1-2 orders per user.
 * 3. Create review for each order.
 */

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$usersData = [
    ['name' => 'Rizki Pratama', 'email' => 'rizki.pratama@gmail.com', 'phone' => '081234567890', 'city' => 'Jakarta Selatan', 'address' => 'Jl. Kemang Raya No. 10'],
    ['name' => 'Siti Aminah', 'email' => 'siti.aminah@yahoo.com', 'phone' => '082134567891', 'city' => 'Bandung', 'address' => 'Jl. Dago No. 15'],
    ['name' => 'Budi Santoso', 'email' => 'budi.santoso@outlook.com', 'phone' => '083134567892', 'city' => 'Surabaya', 'address' => 'Jl. Tunjungan No. 20'],
    ['name' => 'Dewi Lestari', 'email' => 'dewi.lestari@gmail.com', 'phone' => '084 134567893', 'city' => 'Yogyakarta', 'address' => 'Jl. Malioboro No. 5'],
    ['name' => 'Aditya Wijaya', 'email' => 'aditya.wijaya@gmail.com', 'phone' => '085134567894', 'city' => 'Semarang', 'address' => 'Jl. Pandanaran No. 12'],
    ['name' => 'Ananda Putri', 'email' => 'ananda.putri@yahoo.co.id', 'phone' => '086134567895', 'city' => 'Medan', 'address' => 'Jl. Medan Merdeka No. 8'],
    ['name' => 'Eko Kurniawan', 'email' => 'eko.kurniawan@gmail.com', 'phone' => '087134567896', 'city' => 'Makassar', 'address' => 'Jl. Pantai Losari No. 3'],
];

$password = Hash::make('password123');
$productIds = [3, 4, 5, 6, 7, 8, 9];
$comments = [
    "Sepatunya keren banget! Original dan pas di kaki.",
    "Bagus sekali, pengirimannya cepat dan packing aman.",
    "Sangat puas belanja di sini. Seller ramah dan responsif.",
    "Barang sampai sesuai pesanan, kualitas oke punya!",
    "Nyaman dipakai buat harian. Recommended seller!",
    "Kualitas bahan mantap, harga bersaing. Sukses terus!",
    "Desainnya cakep, warnanya juga sesuai foto. Mantap!",
];

echo "=== SEEDING FAKE USERS & REVIEWS ===\n";

foreach ($usersData as $data) {
    // 1. Create User
    $user = User::updateOrCreate(
        ['email' => $data['email']],
        [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'address' => $data['address'],
            'role' => 'user',
            'is_active' => 1,
            'password' => $password,
            'email_verified_at' => now(),
        ]
    );
    echo "User [{$user->id}] {$user->name} created/updated.\n";

    // 2. Create Order(s)
    $numOrders = rand(1, 2);
    for ($i = 0; $i < $numOrders; $i++) {
        $pId = $productIds[array_rand($productIds)];
        $product = Product::find($pId);
        
        if (!$product) continue;

        $orderNumber = 'ORD-' . strtoupper(Str::random(8));
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => $orderNumber,
            'total' => $product->price,
            'status' => 'completed',
            'payment_status' => 'paid',
            'payment_method' => 'BCA',
            'shipping_status' => 'shipped',
            'shipping_address' => $user->address . ', ' . $user->city,
            'created_at' => now()->subDays(rand(1, 30)),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
            'discount' => 0,
            'size' => rand(38, 44),
            'color' => 'Default',
        ]);

        // 3. Create Review
        Review::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'order_id' => $order->id,
            'rating' => rand(4, 5),
            'comment' => $comments[array_rand($comments)],
        ]);
        
        echo "  Created order [{$order->id}] and review for [{$product->name}].\n";
    }
}

echo "=== SEEDING COMPLETE ===\n";
