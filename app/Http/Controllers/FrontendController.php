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

        $categories = Category::active()->get();

        return view('home', compact('featuredProducts', 'categories'));
    }

    /**
     * Halaman Katalog Utama (Shop)
     */
    public function shop(Request $request)
    {
        $query = Product::with('categoryModel')->active();

        // Pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by Kategori
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by Gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filter by Brand (Opsi tambahan jika ada)
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        $products = $query->paginate(12);
        $categories = Category::active()->get();

        return view('shop', compact('products', 'categories'));
    }

    /**
     * Detail Produk Spesifik
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->active()->firstOrFail();
        
        // Produk terkait
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->take(4)
            ->get();
            
        // Load reviews with user
        $reviews = $product->reviews()->with('user')->latest()->get();

        return view('product-detail', compact('product', 'relatedProducts', 'reviews'));
    }

    public function products(Request $request)
    {
        $query = Product::with('categoryModel')->active();

        // Pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by Kategori
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by Gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        $products = $query->paginate(24);
        $categories = Category::active()->get();
        return view('products', compact('products', 'categories'));
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
