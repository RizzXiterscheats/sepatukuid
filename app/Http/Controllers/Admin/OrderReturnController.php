<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderReturn;
use Illuminate\Http\Request;

class OrderReturnController extends Controller
{
    /**
     * Display a listing of return requests.
     */
    public function index()
    {
        $returns = OrderReturn::with(['user', 'item.product', 'item.order'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.returns.index', compact('returns'));
    }

    /**
     * Display the specified return request.
     */
    public function show(OrderReturn $orderReturn)
    {
        $orderReturn->load(['user', 'item.product', 'item.order']);
        
        return view('admin.returns.show', compact('orderReturn'));
    }

    /**
     * Update the status of the return request.
     */
    public function updateStatus(Request $request, OrderReturn $orderReturn)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected,refunded',
            'admin_note' => 'nullable|string',
            'refund_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('refund_proof')) {
            $path = $request->file('refund_proof')->store('refunds', 'public');
            $validated['refund_proof'] = $path;
        }

        $orderReturn->update($validated);

        return back()->with('success', 'Status pengembalian berhasil diperbarui!');
    }
}
