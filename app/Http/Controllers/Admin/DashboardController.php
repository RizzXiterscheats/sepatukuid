<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama dasbor admin dengan metrik analitik.
     */
    public function index()
    {
        // 1. KPI Cards (Statistik Cerdas Hari / Bulan Ini)
        $startOfMonth = Carbon::now()->startOfMonth();
        
        $totalRevenueThisMonth = Order::where('payment_status', 'paid')
                                     ->where('status', 'delivered')
                                     ->where('created_at', '>=', $startOfMonth)
                                     ->sum('total');

        $newOrdersToday = Order::whereDate('created_at', Carbon::today())->count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalActiveProducts = Product::count();

        // 2. Data Grafik Penjualan (7 Hari Terakhir)
        $chartData = $this->getWeeklySalesChart();

        // 3. Pesanan Terbaru Saja (5 Data Teratas)
        $recentOrders = Order::with('user')
                            ->orderBy('created_at', 'desc')
                            ->take(6)
                            ->get();

        return view('admin.dashboard', compact(
            'totalRevenueThisMonth',
            'newOrdersToday',
            'totalCustomers',
            'totalActiveProducts',
            'chartData',
            'recentOrders'
        ));
    }

    /**
     * Membangkitkan array data untuk Chart.js (Penjualan 7 Hari Terakhir).
     */
    private function getWeeklySalesChart()
    {
        $labels = [];
        $data = [];
        
        // Looping mundur 6 hari sampai hari ini (Total 7 Hari)
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            // Format Label X-Axis
            $labels[] = $date->format('d M'); 
            
            // Total penjualan gross pada hari tersebut
            $dailySales = Order::whereDate('created_at', $date->format('Y-m-d'))
                               ->where('payment_status', 'paid')
                               ->sum('total');
            
            $data[] = $dailySales;
        }

        return [
            'labels' => $labels,
            'data'   => $data,
        ];
    }
}