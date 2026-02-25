<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC PAGES ====================
Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('home');

Route::get('/shop', [\App\Http\Controllers\FrontendController::class, 'shop'])->name('shop');

Route::get('/about', [\App\Http\Controllers\FrontendController::class, 'about'])->name('about');

Route::get('/contact', [\App\Http\Controllers\FrontendController::class, 'contact'])->name('contact');

// Products (Redirect to shop)
Route::get('/products', [\App\Http\Controllers\FrontendController::class, 'products'])->name('products.index');

Route::get('/products/{slug}', [\App\Http\Controllers\FrontendController::class, 'show'])->name('products.show');

// ==================== AUTH ROUTES ====================
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    
    // Register
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==================== USER SHOPPING ROUTES (BUTUH LOGIN) ====================
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
    
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/payment/{id}', [CheckoutController::class, 'paymentForm'])->name('checkout.payment');
    Route::post('/checkout/payment/{id}/upload', [CheckoutController::class, 'uploadPayment'])->name('checkout.payment.upload');
    
    // Orders (history pesanan user)
    Route::get('/orders', [App\Http\Controllers\ProfileController::class, 'orders'])->name('orders');
    
    // Profile user
    Route::get('/profile', function () {
        return view('user.profile');  // resources/views/user/profile.blade.php
    })->name('profile');
    
    // Profile update
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ==================== ADMINISTRATIVE ROUTES (ADMIN & PETUGAS) ====================
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    // Admin Prefix
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Product CRUD
        Route::resource('produk', AdminProductController::class);
        Route::patch('produk/{produk}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('produk.toggle-status');
        Route::patch('produk/{produk}/toggle-featured', [AdminProductController::class, 'toggleFeatured'])->name('produk.toggle-featured');
        
        // Order Routes
        Route::get('pesanan', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('pesanan.index');
        Route::get('pesanan/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('pesanan.show');
        Route::patch('pesanan/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('pesanan.update-status');
        Route::patch('pesanan/{order}/payment', [\App\Http\Controllers\Admin\OrderController::class, 'updatePayment'])->name('pesanan.update-payment');

        // Customer Routes
        Route::get('pelanggan', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('pelanggan.index');
        Route::get('pelanggan/{customer}', [\App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('pelanggan.show');
    });

    // Petugas Prefix (Redirect to Admin Dashboard)
    Route::prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
});

// ==================== ADMIN ONLY ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Staff Management
    Route::resource('petugas', \App\Http\Controllers\Admin\StaffController::class)->except(['show']);

    // Customer deletion (Admin only)
    Route::delete('pelanggan/{customer}', [\App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('pelanggan.destroy');

    // Settings
    Route::get('pengaturan', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('pengaturan.index');
    Route::put('pengaturan', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('pengaturan.update');

    // Reports
    Route::get('laporan', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('laporan.index');
});

// ==================== CONTACT FORM SUBMISSION ====================
Route::post('/contact/send', function (Request $request) {
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
    
    return redirect()->route('contact')->with('success', 'Pesan Anda telah terkirim. Tim kami akan segera merespons.');
})->name('contact.send');

// ==================== TEST ROUTE ====================
Route::get('/test', function () {
    return 'Laravel is working!';
});