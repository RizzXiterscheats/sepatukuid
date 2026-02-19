<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);

        // Buat user baru dengan role default 'user'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Langsung simpan plain text
            'role' => 'user', // Default role untuk pembeli
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        // Redirect ke home
        return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang.');
    }
}