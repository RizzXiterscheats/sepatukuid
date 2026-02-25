<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with('user')->orderBy('created_at', 'desc');

        // Filter by Search (Order Number or User Name)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by Payment Status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->paginate(15)->withQueryString();

        // Calculate Statistics
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $unpaidOrders = Order::where('payment_status', 'unpaid')->count();

        // Define available statuses for filter
        $statuses = [
            'pending' => 'Menunggu Konfirmasi',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $paymentStatuses = [
            'unpaid' => 'Belum Dibayar',
            'paid' => 'Lunas',
            'failed' => 'Gagal',
            'refunded' => 'Dikembalikan',
        ];

        return view('admin.pesanan.index', compact(
            'orders', 'totalOrders', 'pendingOrders', 'processingOrders', 'unpaidOrders', 'statuses', 'paymentStatuses'
        ));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Eager load related user, order items and their products
        $order->load(['user', 'items.product']);

        $statuses = [
            'pending' => 'Menunggu Konfirmasi',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $paymentStatuses = [
            'unpaid' => 'Belum Dibayar',
            'paid' => 'Lunas',
            'failed' => 'Gagal',
            'refunded' => 'Dikembalikan',
        ];

        return view('admin.pesanan.show', compact('order', 'statuses', 'paymentStatuses'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    /**
     * Update the order payment status.
     */
    public function updatePayment(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:unpaid,paid,failed,refunded'
        ]);

        $order->update(['payment_status' => $validated['payment_status']]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }
}
