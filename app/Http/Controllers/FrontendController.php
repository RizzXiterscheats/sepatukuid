<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontendController extends Controller
{
    /**
     * Halaman Beranda
     */
    public function index()
    {
        // Ambil 8 produk terbaru yang aktif
        $featuredProducts = Product::with('categoryModel')
            ->active()
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('featuredProducts'));
    }

    /**
     * Halaman Katalog Utama (Shop)
     */
    public function shop(Request $request)
    {
        $query = Product::with('categoryModel')->active();

        // Pencarian (opsional)
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by Kategori (opsional)
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('shop', compact('products', 'categories'));
    }

    /**
     * Detail Produk Spesifik
     */
    public function show($slug)
    {
        $product = Product::with('categoryModel')->where('slug', $slug)->active()->firstOrFail();
        
        // Produk terkait
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->take(4)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
    }

    public function products()
    {
        return redirect()->route('shop');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
