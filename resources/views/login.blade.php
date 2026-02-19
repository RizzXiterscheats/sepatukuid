<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sepatukuid</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .auth-container {
            width: 100%;
            max-width: 450px;
        }
        
        .auth-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .auth-header .logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 2rem;
            font-weight: 900;
            color: #E53935;
            margin-bottom: 20px;
        }
        
        .auth-header .logo i {
            font-size: 2.2rem;
            background: linear-gradient(135deg, #E53935, #C62828);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .auth-header h1 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 10px;
        }
        
        .auth-header p {
            color: #666;
            font-size: 0.95rem;
        }
        
        /* Role Selection Tabs */
        .role-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .role-tab {
            flex: 1;
            padding: 12px 16px;
            background: #f5f5f5;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            color: #666;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }
        
        .role-tab i {
            font-size: 1.2rem;
        }
        
        .role-tab:hover {
            border-color: #E53935;
            background: #fff5f5;
            color: #E53935;
        }
        
        .role-tab.active {
            background: linear-gradient(135deg, #E53935, #C62828);
            color: white;
            border-color: #C62828;
            box-shadow: 0 5px 15px rgba(229, 57, 53, 0.3);
        }
        
        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        .alert-success {
            background: #e8f5e9;
            color: #10b981;
            border: 1px solid #a5d6a7;
        }
        
        .alert-error {
            background: #ffebee;
            color: #ef4444;
            border: 1px solid #ffcdd2;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.input-group i:first-child {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    z-index: 1;
}

.input-group input {
    width: 100%;
    padding: 15px 45px 15px 45px;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s;
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    cursor: pointer;
    z-index: 1;
}
        
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #E53935;
        }
        
        .remember-me span {
            color: #666;
            font-size: 0.95rem;
        }
        
        .forgot-password {
            color: #E53935;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #E53935, #C62828);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(229, 57, 53, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 0.95rem;
        }
        
        .auth-footer a {
            color: #E53935;
            font-weight: 600;
            text-decoration: none;
        }
        
        .auth-footer a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        /* Test credentials */
        .test-credentials {
            margin-top: 30px;
            padding: 20px;
            background: #f5f7fa;
            border-radius: 12px;
            font-size: 0.9rem;
        }
        
        .test-credentials h4 {
            margin-bottom: 15px;
            color: #333;
            font-size: 1rem;
            font-weight: 700;
        }
        
        .test-credentials ul {
            list-style: none;
        }
        
        .test-credentials li {
            padding: 8px 0;
            color: #666;
            border-bottom: 1px dashed #ddd;
        }
        
        .test-credentials li:last-child {
            border-bottom: none;
        }
        
        .test-credentials strong {
            color: #E53935;
            font-weight: 700;
        }
        
        @media (max-width: 480px) {
            .auth-card {
                padding: 30px 20px;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
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
                <h1>MASUK AKUN</h1>
                <p>Pilih tipe akun kemudian login</p>
            </div>
            
            <!-- Role Selection Tabs -->
            <div class="role-tabs">
                <button type="button" class="role-tab active" data-role="user" onclick="switchRole('user')">
                    <i class="fa-solid fa-user"></i>
                    <span>Customer</span>
                </button>
                <button type="button" class="role-tab" data-role="petugas" onclick="switchRole('petugas')">
                    <i class="fa-solid fa-users"></i>
                    <span>Petugas</span>
                </button>
                <button type="button" class="role-tab" data-role="admin" onclick="switchRole('admin')">
                    <i class="fa-solid fa-crown"></i>
                    <span>Admin</span>
                </button>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                </div>
            @endif
   <form method="POST" action="{{ route('login') }}">
    @csrf
    
    <!-- Hidden role input -->
    <input type="hidden" id="role" name="role" value="user">
    
    <div class="form-group">
        <label for="email">Email</label>
        <div class="input-group">
            <i class="fa-regular fa-envelope"></i>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required autofocus>
        </div>
    </div>
    
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            <i class="fa-regular fa-eye password-toggle" onclick="togglePassword()"></i>
        </div>
    </div>
    
    <div class="form-options">
        <label class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <span>Ingat saya</span>
        </label>
        <a href="#" class="forgot-password">Lupa password?</a>
    </div>
    
    <button type="submit" class="btn-login">
        <i class="fa-solid fa-right-to-bracket"></i>
        Login
    </button>
</form>
            
            <div class="auth-footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
            </div>
            
            <!-- Akun Testing -->
            <div class="test-credentials">
                <h4><i class="fa-solid fa-flask"></i> Akun Testing</h4>
                <ul>
                    <li><strong>Admin:</strong> admin@sepatuku.id / admin123</li>
                    <li><strong>Petugas:</strong> petugas@sepatuku.id / petugas123</li>
                    <li><strong>Customer:</strong> customer@sepatuku.id / customer123</li>
                </ul>
            </div>
        </div>
    </div>
    
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.password-toggle');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
    
    function switchRole(role) {
        // Update hidden role input
        document.getElementById('role').value = role;
        
        // Update active tab styling
        const tabs = document.querySelectorAll('.role-tab');
        tabs.forEach(tab => {
            tab.classList.remove('active');
            if (tab.getAttribute('data-role') === role) {
                tab.classList.add('active');
            }
        });
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan event listener untuk toggle password
        const toggleBtn = document.querySelector('.password-toggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', togglePassword);
        }
    });
</script>
</body>
</html>