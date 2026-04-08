<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect()->route('shop')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $total = 0;
        foreach ($cart as $key => &$item) {
            $product = Product::find($item['id']);
            if ($product) {
                $item['price'] = $product->final_price;
                $item['image_url'] = $product->image_url;
                $total += $item['price'] * $item['quantity'];
            }
        }
        
        session()->put('cart', $cart);

        return view('user.checkout', compact('cart', 'total'));
    }

    /**
     * Proses pembuatan pesanan
     */
    public function process(Request $request)
    {
        // Jika user memilih untuk menggunakan alamat tersimpan, kita ambil datanya dari profil
        if ($request->use_saved_address == "1" && Auth::check()) {
            $user = Auth::user();
            $request->merge([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'province' => $user->province,
                'city' => $user->city,
                'district' => $user->district,
                'postal_code' => $user->postal_code,
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'shipping_method' => 'required|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
            'voucher_code' => 'nullable|string|exists:vouchers,code',
        ]);

        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect()->route('shop')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Hitung subtotal dan sinkronisasi harga terbaru
        $subtotal = 0;
        foreach ($cart as $key => &$item) {
            $product = Product::find($item['id']);
            if ($product) {
                $item['price'] = $product->final_price;
                $subtotal += $item['price'] * $item['quantity'];
            }
        }
        
        session()->put('cart', $cart);

        // Tentukan biaya pengiriman
        $shippingCosts = [
            'JNE' => 25000,
            'J&T' => 22000,
            'Sicepat' => 20000,
            'Grab/Gojek' => 50000,
        ];
        $shippingCost = $shippingCosts[$request->shipping_method] ?? 0;

        // Kerjakan logika voucher jika ada
        $discountAmount = 0;
        if ($request->voucher_code) {
            $voucher = Voucher::where('code', $request->voucher_code)->where('is_active', true)->first();
            if ($voucher && $voucher->isValid($subtotal)) {
                $discountAmount = $voucher->calculateDiscount($subtotal);
            }
        }

        // Total akhir
        $total = ($subtotal + $shippingCost) - $discountAmount;
        $total = max(0, $total); // Ensure total is not negative

        // Gabungkan alamat
        $fullAddress = sprintf(
            "%s, %s, %s, %s, %s\nTelepon: %s\nNama: %s",
            $request->address,
            $request->district,
            $request->city,
            $request->province,
            $request->postal_code,
            $request->phone,
            $request->name
        );

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pending',
                'voucher_code' => $request->voucher_code,
                'discount_amount' => $discountAmount,
                'payment_method' => $request->payment_method,
                'payment_status' => 'unpaid',
                'shipping_address' => $fullAddress,
                'shipping_method' => $request->shipping_method,
                'notes' => $request->notes,
            ]);

            // Increment used count if voucher used
            if ($request->voucher_code && $discountAmount > 0) {
                Voucher::where('code', $request->voucher_code)->increment('used_count');
            }

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $details['id'],
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                // Kurangi stok produk dan tambah total terjual
                $product = Product::find($details['id']);
                if ($product) {
                    $product->decrement('stock', $details['quantity']);
                    $product->increment('total_sold', $details['quantity']);
                }
            }

            DB::commit();
            session()->forget('cart');

            // Simpan detail alamat ke user jika belum ada atau berubah
            if (Auth::check()) {
                $user = Auth::user();
                $user->update([
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'province' => $request->province,
                    'city' => $request->city,
                    'district' => $request->district,
                    'postal_code' => $request->postal_code,
                ]);
            }

            return redirect()->route('checkout.payment', $order->id)->with('success', 'Pesanan berhasil dibuat! Silakan upload bukti pembayaran untuk memverifikasi pesanan Anda.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan form upload bukti pembayaran
     */
    public function paymentForm($id)
    {
        $order = Order::findOrFail($id);
        
        // Pastikan hanya pemilik pesanan yang bisa akses
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.payment-upload', compact('order'));
    }

    /**
     * Proses upload bukti pembayaran
     */
    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $order = Order::findOrFail($id);

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = 'proof-' . $order->order_number . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('payment_proofs', $filename, 'public');

            $order->update([
                'payment_proof' => $path,
                'payment_status' => 'pending_verification'
            ]);

            return redirect()->route('orders')->with('success', 'Bukti pembayaran berhasil diupload. Kami akan segera memverifikasi pesanan Anda.');
        }
        return back()->with('error', 'Gagal upload bukti pembayaran.');
    }

    /**
     * AJAX: Validasi voucher
     */
    public function applyVoucher(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'subtotal' => 'required|numeric'
        ]);

        $voucher = Voucher::where('code', $request->code)->where('is_active', true)->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Kode voucher tidak valid.'
            ]);
        }

        if (!$voucher->isValid($request->subtotal)) {
            // Check specific reasons
            if ($voucher->expires_at && $voucher->expires_at->isPast()) {
                $msg = 'Voucher sudah kadaluarsa.';
            } elseif ($voucher->usage_limit && $voucher->used_count >= $voucher->usage_limit) {
                $msg = 'Batas penggunaan voucher telah tercapai.';
            } elseif ($request->subtotal < $voucher->min_purchase) {
                $msg = 'Minimal belanja untuk voucher ini adalah Rp ' . number_format($voucher->min_purchase, 0, ',', '.');
            } else {
                $msg = 'Voucher tidak dapat digunakan.';
            }

            return response()->json([
                'success' => false,
                'message' => $msg
            ]);
        }

        $discount = $voucher->calculateDiscount($request->subtotal);

        return response()->json([
            'success' => true,
            'code' => $voucher->code,
            'discount' => $discount,
            'message' => 'Voucher berhasil diterapkan.'
        ]);
    }
}
