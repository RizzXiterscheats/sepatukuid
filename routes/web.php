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
    return "Product detail: " . $slug . " - Coming Soon";
})->name('products.show');

// ==================== AUTH ROUTES ====================
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Register
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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

// ==================== USER ROUTES ====================
Route::prefix('user')->name('user.')->middleware(['auth', 'user.only'])->group(function () {
    Route::get('/cart', function () {
        return view('user.cart');
    })->name('cart');
    
    Route::get('/checkout', function () {
        return view('user.checkout');
    })->name('checkout');
    
    Route::get('/orders', function () {
        return view('user.orders');
    })->name('orders');
    
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');
});

// ==================== TEST ROUTE ====================
Route::get('/test', function () {
    return 'Laravel is working!';
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
    
    // Di sini Anda bisa mengirim email atau menyimpan ke database
    // Untuk sementara, kita tampilkan pesan sukses
    
    return redirect()->route('contact')->with('success', 'Pesan Anda telah terkirim. Tim kami akan segera merespons.');
})->name('contact.send');