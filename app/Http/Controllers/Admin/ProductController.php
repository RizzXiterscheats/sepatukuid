<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products with search, filter, and pagination.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search by name or SKU
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Filter by featured
        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured === '1');
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $sortDir = $request->get('dir', 'desc');
        $allowedSorts = ['name', 'price', 'stock', 'created_at', 'sku'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir === 'asc' ? 'asc' : 'desc');
        }

        $products = $query->paginate(10)->withQueryString();

        // Stats
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $lowStockProducts = Product::where('stock', '<=', 5)->where('is_active', true)->count();
        $featuredProducts = Product::where('is_featured', true)->count();

        // Get unique categories and brands for filter dropdown
        $categories = Product::whereNotNull('category')->distinct()->pluck('category');
        $brands = Product::whereNotNull('brand')->distinct()->pluck('brand');

        return view('admin.produk.index', compact(
            'products',
            'totalProducts',
            'activeProducts',
            'lowStockProducts',
            'featuredProducts',
            'categories',
            'brands'
        ));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.produk.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'brand' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'category' => 'nullable|string|max:255',
            'sizes' => 'nullable|string',
            'colors' => 'nullable|string',
            'specifications' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'nullable',
            'is_active' => 'nullable',
        ]);

        // Cast stock to integer
        $validated['stock'] = (int) $validated['stock'];

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

        // Ensure slug is unique
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        // Parse sizes and colors from comma-separated string to array
        if (!empty($validated['sizes'])) {
            $validated['sizes'] = array_map('trim', explode(',', $validated['sizes']));
        }
        if (!empty($validated['colors'])) {
            $validated['colors'] = array_map('trim', explode(',', $validated['colors']));
        }

        // Handle boolean defaults
        $validated['is_featured'] = $request->has('is_featured') ? true : false;
        $validated['is_active'] = $request->has('is_active') ? true : false;

        // If category_id is provided, also sync the category name for compatibility
        if ($request->filled('category_id')) {
            $category = Category::find($request->category_id);
            if ($category) {
                $validated['category'] = $category->name;
            }
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $produk)
    {
        return view('admin.produk.show', ['product' => $produk]);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $produk)
    {
        $categories = Category::active()->get();
        return view('admin.produk.edit', ['product' => $produk, 'categories' => $categories]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $produk)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $produk->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'brand' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'category' => 'nullable|string|max:255',
            'sizes' => 'nullable|string',
            'colors' => 'nullable|string',
            'specifications' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'nullable',
            'is_active' => 'nullable',
        ]);

        // Cast stock to integer
        $validated['stock'] = (int) $validated['stock'];

        // Update slug if name changed
        if ($produk->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
            $originalSlug = $validated['slug'];
            $count = 1;
            while (Product::where('slug', $validated['slug'])->where('id', '!=', $produk->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count++;
            }
        }

        // Parse sizes and colors
        if (!empty($validated['sizes'])) {
            $validated['sizes'] = array_map('trim', explode(',', $validated['sizes']));
        } else {
            $validated['sizes'] = null;
        }
        if (!empty($validated['colors'])) {
            $validated['colors'] = array_map('trim', explode(',', $validated['colors']));
        } else {
            $validated['colors'] = null;
        }

        // Handle boolean defaults
        $validated['is_featured'] = $request->has('is_featured') ? true : false;
        $validated['is_active'] = $request->has('is_active') ? true : false;

        // Sync category name if category_id changed
        if ($request->filled('category_id')) {
            $category = Category::find($request->category_id);
            if ($category) {
                $validated['category'] = $category->name;
            }
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($produk->image) {
                Storage::disk('public')->delete($produk->image);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $produk->update($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $produk)
    {
        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Toggle active status via AJAX.
     */
    public function toggleStatus(Product $produk)
    {
        $produk->update(['is_active' => !$produk->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $produk->is_active,
            'message' => $produk->is_active ? 'Produk diaktifkan' : 'Produk dinonaktifkan'
        ]);
    }

    /**
     * Toggle featured status via AJAX.
     */
    public function toggleFeatured(Product $produk)
    {
        $produk->update(['is_featured' => !$produk->is_featured]);

        return response()->json([
            'success' => true,
            'is_featured' => $produk->is_featured,
            'message' => $produk->is_featured ? 'Produk ditandai featured' : 'Produk dihapus dari featured'
        ]);
    }
}
