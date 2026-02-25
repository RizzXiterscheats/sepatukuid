<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display the sales report.
     */
    public function index(Request $request)
    {
        // 1. Tentukan Rentang Waktu (Default: Bulan Ini)
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::now()->endOfDay();

        // 2. Query Dasar: Hanya transaksi LUNAS dan SELESAI
        $baseQuery = Order::where('payment_status', 'paid')
                        ->where('status', 'delivered')
                        ->whereBetween('created_at', [$startDate, $endDate]);

        // 3. Hitung Statistik (KPIs)
        $totalRevenue = (clone $baseQuery)->sum('total');
        $totalOrders = (clone $baseQuery)->count();
        
        // Menghitung jumlah produk unik yang terjual dan total item
        $totalItemsSold = 0;
        $ordersCounted = (clone $baseQuery)->with('items')->get();
        foreach ($ordersCounted as $order) {
            $totalItemsSold += $order->items->sum('quantity');
        }

        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // 4. Ambil Daftar Transaksi untuk Tabel
        $orders = (clone $baseQuery)->with('user')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(20)
                                    ->withQueryString();

        return view('admin.laporan.index', compact(
            'startDate', 
            'endDate', 
            'totalRevenue', 
            'totalOrders', 
            'totalItemsSold', 
            'averageOrderValue', 
            'orders'
        ));
    }
}
