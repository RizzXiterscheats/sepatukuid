<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index(Request $request)
    {
        // Hanya ambil user dengan role 'user'
        $query = User::where('role', 'user')
                    ->withCount('orders')
                    ->orderBy('created_at', 'desc');

        // Filter berdasarkan pencarian (Nama atau Email)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Ambil data pelanggan berserta total spent dari order yang lunas atau selesai (opsional)
        $customers = $query->paginate(15)->withQueryString();

        // Hitung total belanja masing-masing pelanggan
        foreach ($customers as $customer) {
            $customer->total_spent = $customer->orders()
                ->whereIn('status', ['processing', 'shipped', 'delivered'])
                ->sum('total');
        }

        // Statistik
        $totalCustomers = User::where('role', 'user')->count();
        $newCustomersThisMonth = User::where('role', 'user')
                                    ->whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->count();

        return view('admin.pelanggan.index', compact('customers', 'totalCustomers', 'newCustomersThisMonth'));
    }

    /**
     * Display the specified customer & their order history.
     */
    public function show(User $customer)
    {
        // Pastikan ini adalah user biasa
        if ($customer->role !== 'user') {
            abort(404, 'Pelanggan tidak ditemukan.');
        }

        // Ambil riwayat pesanan pelanggan ini
        $orders = $customer->orders()->orderBy('created_at', 'desc')->paginate(10);
        
        // Total Belanja & Total Order
        $totalOrders = $customer->orders()->count();
        $totalSpent = $customer->orders()
                            ->whereIn('status', ['processing', 'shipped', 'delivered'])
                            ->sum('total');

        return view('admin.pelanggan.show', compact('customer', 'orders', 'totalOrders', 'totalSpent'));
    }

    /**
     * Remove the specified customer from database.
     */
    public function destroy(User $customer)
    {
        if ($customer->role !== 'user') {
            return back()->with('error', 'Hanya akun pelanggan yang dapat dihapus.');
        }

        // Opsional: Periksa jika ada pesanan terkait, hentikan penghapusan
        if ($customer->orders()->count() > 0) {
            return back()->with('error', 'Pelanggan ini memiliki riwayat pesanan. Tidak dapat menghapus demi integritas data laporan.');
        }

        $customer->delete();
        return redirect()->route('admin.pelanggan.index')->with('success', 'Akun pelanggan berhasil dihapus.');
    }
}
