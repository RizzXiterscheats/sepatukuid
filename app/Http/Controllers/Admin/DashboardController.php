<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Data statistik (bisa diambil dari database nanti)
        $data = [
            'totalProducts' => 1248,
            'productsDown' => 45,
            'ordersToday' => 32,
            'ordersPending' => 123,
            'customerSatisfaction' => 94,
            'satisfactionTarget' => 80,
            'monthlyRevenue' => 24000000,
            'revenuePercentage' => 16,
            
            // Pesanan terbaru
            'recentOrders' => [
                (object)[
                    'id' => 'WNV001',
                    'customer' => 'Raki Aranda',
                    'product' => 'Running Shoes Pro',
                    'status' => 'Lunas',
                    'status_class' => 'status-lunas',
                    'total' => 1450000
                ],
                (object)[
                    'id' => 'WHV002',
                    'customer' => 'Andi Pratama',
                    'product' => 'Basketball Elite',
                    'status' => 'Pending',
                    'status_class' => 'status-pending',
                    'total' => 1850000
                ],
                (object)[
                    'id' => 'HTNV003',
                    'customer' => 'Sinta Wijaya',
                    'product' => 'Casual Sneakers',
                    'status' => 'Ditandatangani',
                    'status_class' => 'status-ditandatangani',
                    'total' => 780000
                ],
                (object)[
                    'id' => 'WNV004',
                    'customer' => 'Budi Santoso',
                    'product' => 'Training Pro',
                    'status' => 'Lunas',
                    'status_class' => 'status-lunas',
                    'total' => 890000
                ],
                (object)[
                    'id' => 'WNV005',
                    'customer' => 'Cici Amelia',
                    'product' => 'Running Shoes Lite',
                    'status' => 'Diproses',
                    'status_class' => 'status-proses',
                    'total' => 1250000
                ],
            ],
            
            // Produk terlaris
            'topProducts' => [
                (object)[
                    'name' => 'Running Shoes Pro 2023',
                    'category' => 'Running',
                    'stock' => 42,
                    'rating' => 4.8,
                    'price' => 1450000
                ],
                (object)[
                    'name' => 'Basketball Elite',
                    'category' => 'Basket',
                    'stock' => 28,
                    'rating' => 4.7,
                    'price' => 1850000
                ],
                (object)[
                    'name' => 'Training Pro',
                    'category' => 'Training',
                    'stock' => 65,
                    'rating' => 4.5,
                    'price' => 890000
                ],
                (object)[
                    'name' => 'Casual Sneakers',
                    'category' => 'Casual',
                    'stock' => 38,
                    'rating' => 4.6,
                    'price' => 780000
                ],
                (object)[
                    'name' => 'Hiking Boots',
                    'category' => 'Outdoor',
                    'stock' => 22,
                    'rating' => 4.9,
                    'price' => 1250000
                ],
            ]
        ];

        return view('admin.dashboard', $data);
    }
}