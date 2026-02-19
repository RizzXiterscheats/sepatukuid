<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:user,petugas,admin',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ])->onlyInput('email');
        }

        if ($credentials['password'] !== $user->password) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ])->onlyInput('email');
        }

        // Validasi role user
        if ($user->role !== $credentials['role']) {
            return back()->withErrors([
                'email' => 'Akun ini tidak sesuai dengan role yang dipilih. Silakan pilih role yang benar.',
            ])->onlyInput('email');
        }

        Auth::login($user, $request->has('remember'));
        $request->session()->regenerate();

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Selamat datang Admin ' . $user->name);
        } elseif ($user->role === 'petugas') {
            return redirect()->intended(route('petugas.dashboard'))->with('success', 'Selamat datang Petugas ' . $user->name);
        } else {
            // User biasa langsung ke halaman home
            return redirect()->intended(route('home'))->with('success', 'Selamat datang ' . $user->name);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil');
    }
}