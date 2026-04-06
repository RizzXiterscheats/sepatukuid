<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())
            ->with(['product' => function($q) {
                $q->active(); // Pastikan produk masih aktif
            }])
            ->latest()
            ->get();

        return view('user.wishlist', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Silakan login terlebih dahulu.'], 401);
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $userId = Auth::id();
        $productId = $validated['product_id'];

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Produk dihapus dari wishlist'
            ]);
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Produk ditambahkan ke wishlist'
            ]);
        }
    }
}
