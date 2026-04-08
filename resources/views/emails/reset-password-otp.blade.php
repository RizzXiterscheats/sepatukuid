<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password OTP</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; color: #333; }
        .container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background: #E53935; padding: 25px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 600; }
        .content { padding: 30px; line-height: 1.6; }
        .otp-container { text-align: center; margin: 30px 0; }
        .otp-code { font-size: 36px; font-weight: bold; letter-spacing: 5px; color: #E53935; background: #ffebee; padding: 15px 30px; border-radius: 8px; display: inline-block; border: 2px dashed #ef9a9a; }
        .footer { background: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #888; border-top: 1px solid #eee; }
        p { margin: 0 0 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Permintaan Reset Password</h1>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $user->name }}</strong>,</p>
            <p>Kami menerima permintaan untuk mereset password akun Sepatukuid Anda. Berikut adalah kode OTP 6-digit Anda:</p>
            
            <div class="otp-container">
                <div class="otp-code">{{ $otp }}</div>
            </div>
            
            <p>Kode ini hanya berlaku selama <strong>15 menit</strong>. Jangan berikan kode ini kepada siapapun demi keamanan akun Anda.</p>
            <p>Jika Anda tidak merasa melakukan permintaan reset password, silakan abaikan email ini.</p>
            <p>Terima kasih,<br>Tim {{ config('app.name', 'Sepatukuid') }}</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name', 'Sepatukuid') }}. Semua hak dilindungi undang-undang.
        </div>
    </div>
</body>
</html>
