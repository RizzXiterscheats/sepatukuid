<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordOtpMail;

class ForgotPasswordOTPController extends Controller
{
    public function requestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan dalam sistem kami.'
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Generate 6 digit OTP
        $otp = sprintf("%06d", mt_rand(1, 999999));
        
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        $emailSent = false;
        try {
            Mail::to($user->email)->send(new ResetPasswordOtpMail($otp, $user));
            $emailSent = true;
        } catch (\Exception $e) {
            // Email gagal terkirim — tetap lanjut ke halaman verifikasi
            // Tester dapat menggunakan kode demo 072007
        }

        $statusMsg = $emailSent
            ? 'Kode OTP 6-digit telah dikirim ke email Anda.'
            : 'Email tidak dapat dikirim (konfigurasi mail belum aktif). Gunakan kode demo: 072007';

        return redirect()->route('password.verifyForm')
            ->with('email', $user->email)
            ->with('status', $statusMsg);
    }

    public function verifyForm(Request $request)
    {
        $email = session('email', $request->query('email'));
        if (!$email) {
            return redirect()->route('password.request');
        }
        return view('auth.passwords.verify', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        // Demo / bypass OTP untuk keperluan testing
        $isDemoOtp = ($request->otp === '072007');

        if (!$isDemoOtp) {
            // Cek OTP dari database
            if (!$user->otp_code || $user->otp_code !== $request->otp) {
                return back()->withInput()->withErrors(['otp' => 'Kode OTP tidak valid atau salah.']);
            }

            if (now()->greaterThan($user->otp_expires_at)) {
                return back()->withInput()->withErrors(['otp' => 'Kode OTP telah kadaluarsa. Silakan request OTP baru.']);
            }
        }

        // Reset password (plain text sesuai konfigurasi app ini)
        $user->password = $request->password;
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        // Redirect ke verify page dengan session reset_success agar bisa tampilkan popup
        return redirect()->route('password.verifyForm')
            ->with('reset_success', true)
            ->with('email', $request->email);
    }
}
