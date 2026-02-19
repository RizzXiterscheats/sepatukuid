<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC PAGES ====================
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Products
Route::get('/products', function () {
    return view('products');
})->name('products.index');

Route::get('/products/{slug}', function ($slug) {
    return view('product-detail', ['slug' => $slug]);
})->name('products.show');

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
    // Cart - mengarah ke file di folder user
    Route::get('/cart', function () {
        return view('user.cart');  // resources/views/user/cart.blade.php
    })->name('cart');
    
    // Checkout - mengarah ke file di folder user
    Route::get('/checkout', function () {
        return view('user.checkout');  // resources/views/user/checkout.blade.php
    })->name('checkout');
    
    // Orders (history pesanan user)
    Route::get('/orders', function () {
        return view('user.orders');  // resources/views/user/orders.blade.php
    })->name('orders');
    
    // Profile user
    Route::get('/profile', function () {
        return view('user.profile');  // resources/views/user/profile.blade.php
    })->name('profile');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Route admin lainnya
});

// ==================== PETUGAS ROUTES ====================
Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    })->name('dashboard');
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

// Admin dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Petugas dashboard
Route::get('/petugas/dashboard', function () {
    return view('petugas.dashboard');
})->name('petugas.dashboard');