<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sepatukuid</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #E53935;
            --primary-dark: #C62828;
            --dark: #121212;
            --gray: #666;
            --light: #f8f9fa;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f9f9f9, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .register-container {
            width: 100%;
            max-width: 500px;
        }
        
        .register-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        
        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), #2196F3);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo a {
            color: var(--primary);
            font-size: 2rem;
            font-weight: 900;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        h1 {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .subtitle {
            text-align: center;
            color: var(--gray);
            margin-bottom: 25px;
            font-size: 0.9rem;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }
        
        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .input-icon {
            position: absolute;
            left: 12px;
            color: var(--gray);
        }
        
        input, textarea {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }
        
        input:focus, textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1);
        }
        
        .toggle-password {
            position: absolute;
            right: 12px;
            color: var(--gray);
            cursor: pointer;
        }
        
        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(229, 57, 53, 0.3);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .back-home {
            text-align: center;
            margin-top: 15px;
        }
        
        .back-home a {
            color: var(--gray);
            text-decoration: none;
            font-size: 0.85rem;
        }
        
        .error-message {
            color: var(--primary);
            font-size: 0.8rem;
            margin-top: 5px;
        }
        
        @media (max-width: 480px) {
            .register-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="logo">
                <a href="/">
                    <i class="fa-solid fa-shoe-prints"></i>
                    SEPATUKUID
                </a>
            </div>
            
            <h1>Daftar Akun Baru</h1>
            <p class="subtitle">Buat akun untuk mulai berbelanja</p>
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i> 
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-group">
                        <i class="fa-regular fa-user input-icon"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <i class="fa-regular fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="phone">Nomor Telepon (Opsional)</label>
                    <div class="input-group">
                        <i class="fa-solid fa-phone input-icon"></i>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Masukkan nomor telepon">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
                        <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('password')"></i>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                        <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('password_confirmation')"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address">Alamat (Opsional)</label>
                    <div class="input-group">
                        <i class="fa-solid fa-location-dot input-icon"></i>
                        <textarea id="address" name="address" rows="2" placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                    </div>
                </div>
                
                <button type="submit" class="btn-register">
                    <i class="fa-solid fa-user-plus"></i> Daftar
                </button>
            </form>
            
            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
            
            <div class="back-home">
                <a href="/">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Home
                </a>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling;
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>