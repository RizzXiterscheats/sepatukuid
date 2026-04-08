<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sepatukuid</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .auth-container { width: 100%; max-width: 450px; }
        .auth-card { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3); animation: fadeIn 0.5s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        .auth-header { text-align: center; margin-bottom: 30px; }
        .auth-header .logo { display: inline-flex; align-items: center; gap: 10px; font-size: 2rem; font-weight: 900; color: #E53935; margin-bottom: 20px; }
        .auth-header .logo i { font-size: 2.2rem; background: linear-gradient(135deg, #E53935, #C62828); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .auth-header h1 { font-size: 1.8rem; color: #333; margin-bottom: 10px; }
        .auth-header p { color: #666; font-size: 0.95rem; }
        .alert { padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; }
        .alert-success { background: #e8f5e9; color: #10b981; border: 1px solid #a5d6a7; }
        .alert-error { background: #ffebee; color: #ef4444; border: 1px solid #ffcdd2; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #333; font-weight: 600; font-size: 0.9rem; }
        .input-group { position: relative; }
        .input-group i:first-child { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #999; font-size: 1.1rem; }
        .input-group input { width: 100%; padding: 15px 15px 15px 45px; border: 2px solid #e0e0e0; border-radius: 12px; font-size: 1rem; transition: all 0.3s; }
        .input-group input:focus { outline: none; border-color: #E53935; box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1); }
        .btn-login { width: 100%; padding: 16px; background: linear-gradient(135deg, #E53935, #C62828); color: white; border: none; border-radius: 12px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(229, 57, 53, 0.3); }
        .auth-footer { text-align: center; margin-top: 25px; color: #666; font-size: 0.95rem; }
        .auth-footer a { color: #E53935; font-weight: 600; text-decoration: none; }
        .auth-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <i class="fa-solid fa-shoe-prints"></i>
                    <span>SEPATUKUID</span>
                </div>
                <h1>LUPA PASSWORD</h1>
                <p>Masukkan alamat email Anda untuk menerima kode OTP reset password.</p>
            </div>
            
            @if(session('status'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.email-post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-group">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@sepatukuid.com" required autofocus>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-paper-plane"></i>
                    Kirim Kode OTP
                </button>
            </form>
            
            <div class="auth-footer">
                Kembali ke <a href="{{ route('login') }}">Halaman Login</a>
            </div>
        </div>
    </div>
</body>
</html>
