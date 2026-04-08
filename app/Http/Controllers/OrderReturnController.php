<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\OrderReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderReturnController extends Controller
{
    /**
     * Store a newly created return request in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'reason' => 'required|string',
            'description' => 'required|string',
            'bank_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'bank_account_name' => 'required|string',
            'evidence_photos.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $item = OrderItem::with('order')->findOrFail($request->order_item_id);

        // Security check
        if ($item->order->user_id !== Auth::id()) {
            return back()->with('error', 'Akses ditolak.');
        }

        // Status check
        if ($item->order->status !== 'delivered' && $item->order->status !== 'completed') {
            return back()->with('error', 'Hanya pesanan yang sudah diterima yang dapat diajukan pengembalian.');
        }

        // Check if already returned
        if ($item->returnRequest) {
            return back()->with('error', 'Produk ini sudah diajukan pengembalian sebelumnya.');
        }

        $photoPaths = [];
        if ($request->hasFile('evidence_photos')) {
            foreach ($request->file('evidence_photos') as $photo) {
                $path = $photo->store('returns', 'public');
                $photoPaths[] = $path;
            }
        }

        $refundAmount = ($item->price - $item->discount) * $item->quantity;

        OrderReturn::create([
            'user_id' => Auth::id(),
            'order_item_id' => $item->id,
            'reason' => $request->reason,
            'description' => $request->description,
            'evidence_photos' => $photoPaths,
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_account_name' => $request->bank_account_name,
            'refund_amount' => $refundAmount,
            'status' => 'pending'
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Permohonan pengembalian dana berhasil dikirim! Mohon tunggu peninjauan admin.'
            ]);
        }

        return back()->with('success', 'Permohonan pengembalian dana berhasil dikirim! Mohon tunggu peninjauan admin.');
    }
}
