<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Sepatukuid</title>
    
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
        .password-toggle { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #999; cursor: pointer; font-size: 1.1rem; }
        .btn-login { width: 100%; padding: 16px; background: linear-gradient(135deg, #E53935, #C62828); color: white; border: none; border-radius: 12px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(229, 57, 53, 0.3); }
        .auth-footer { text-align: center; margin-top: 25px; color: #666; font-size: 0.95rem; }
        .auth-footer a { color: #E53935; font-weight: 600; text-decoration: none; }
        .auth-footer a:hover { text-decoration: underline; }

        /* Demo hint box */
        .demo-hint { background: linear-gradient(135deg, #fff8e1, #fff3cd); border: 1px dashed #f59e0b; border-radius: 12px; padding: 12px 16px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .demo-hint i { color: #f59e0b; font-size: 1.1rem; flex-shrink: 0; }
        .demo-hint p { font-size: 0.85rem; color: #78350f; margin: 0; }
        .demo-hint strong { color: #92400e; font-size: 1rem; letter-spacing: 2px; }

        /* SUCCESS POPUP OVERLAY */
        .popup-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); display: flex; align-items: center; justify-content: center; z-index: 9999; animation: overlayIn 0.3s ease; }
        @keyframes overlayIn { from { opacity: 0; } to { opacity: 1; } }

        .popup-card { background: white; border-radius: 24px; padding: 48px 40px; max-width: 400px; width: 90%; text-align: center; box-shadow: 0 30px 60px rgba(0,0,0,0.3); animation: popupIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); }
        @keyframes popupIn { from { opacity: 0; transform: scale(0.7) translateY(30px); } to { opacity: 1; transform: scale(1) translateY(0); } }

        .popup-icon-wrap { width: 90px; height: 90px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; animation: iconPop 0.5s 0.2s cubic-bezier(0.34, 1.56, 0.64, 1) both; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4); }
        @keyframes iconPop { from { transform: scale(0) rotate(-30deg); } to { transform: scale(1) rotate(0deg); } }
        .popup-icon-wrap i { font-size: 40px; color: white; }

        .popup-title { font-size: 1.6rem; font-weight: 800; color: #1a1a2e; margin-bottom: 10px; }
        .popup-desc { color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 28px; }

        .popup-progress { height: 5px; background: #e0e0e0; border-radius: 99px; overflow: hidden; margin-bottom: 16px; }
        .popup-progress-bar { height: 100%; background: linear-gradient(135deg, #10b981, #059669); border-radius: 99px; width: 100%; animation: shrink 3s linear forwards; }
        @keyframes shrink { from { width: 100%; } to { width: 0%; } }

        .popup-countdown { font-size: 0.85rem; color: #999; }
        .popup-btn { margin-top: 20px; display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: all 0.3s; text-decoration: none; }
        .popup-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4); color: white; }
    </style>
</head>
<body>
    <!-- SUCCESS POPUP (tampil jika reset berhasil) -->
    @if(session('reset_success'))
    <div class="popup-overlay" id="successPopup">
        <div class="popup-card">
            <div class="popup-icon-wrap">
                <i class="fas fa-check"></i>
            </div>
            <div class="popup-title">Password Berhasil Direset!</div>
            <div class="popup-desc">
                Password akun Anda telah berhasil diperbarui.<br>
                Silakan login kembali menggunakan password baru Anda.
            </div>
            <div class="popup-progress">
                <div class="popup-progress-bar"></div>
            </div>
            <div class="popup-countdown">Mengalihkan ke halaman login dalam <span id="countdown">3</span> detik...</div>
            <br>
            <a href="{{ route('login') }}" class="popup-btn">
                <i class="fas fa-sign-in-alt"></i> Login Sekarang
            </a>
        </div>
    </div>
    @endif

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <i class="fa-solid fa-shoe-prints"></i>
                    <span>SEPATUKUID</span>
                </div>
                <h1>VERIFIKASI OTP</h1>
                <p>Masukkan kode OTP 6-digit yang telah dikirim ke <strong>{{ $email ?? '' }}</strong> beserta password baru Anda.</p>
            </div>

            <!-- Demo Hint -->
            <div class="demo-hint">
                <i class="fas fa-flask"></i>
                <p>Mode Tester: Gunakan kode demo <strong>072007</strong> jika belum menerima email OTP.</p>
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
            
            <form method="POST" action="{{ route('password.reset-post') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                
                <div class="form-group">
                    <label for="otp">Kode OTP</label>
                    <div class="input-group">
                        <i class="fa-solid fa-key"></i>
                        <input type="text" id="otp" name="otp" required autofocus placeholder="Masukkan 6 digit kode OTP" maxlength="6">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Minimal 4 karakter" required>
                        <i class="fa-regular fa-eye password-toggle" onclick="togglePassword('password', this)"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" required>
                        <i class="fa-regular fa-eye password-toggle" onclick="togglePassword('password_confirmation', this)"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-check-circle"></i>
                    Reset Password
                </button>
            </form>
            
            <div class="auth-footer">
                <a href="{{ route('password.request') }}">Kirim Ulang Kode OTP</a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, icon) {
            const passwordInput = document.getElementById(inputId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Auto redirect setelah popup muncul
        @if(session('reset_success'))
        (function() {
            let count = 3;
            const el = document.getElementById('countdown');
            const interval = setInterval(function() {
                count--;
                if (el) el.textContent = count;
                if (count <= 0) {
                    clearInterval(interval);
                    window.location.href = '{{ route("login") }}';
                }
            }, 1000);
        })();
        @endif
    </script>
</body>
</html>
