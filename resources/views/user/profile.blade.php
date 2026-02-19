<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Sepatukuid</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #E53935;
            --primary-dark: #C62828;
            --secondary: #2196F3;
            --dark: #121212;
            --gray: #666;
            --light: #f8f9fa;
            --success: #4CAF50;
            --card-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #f0f2f5 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 40px;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .page-header i {
            color: var(--primary);
        }
        
        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            flex-shrink: 0;
            box-shadow: 0 10px 30px rgba(229, 57, 53, 0.3);
        }
        
        .profile-info h2 {
            font-size: 1.8rem;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .profile-info p {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 10px;
        }
        
        .profile-role {
            display: inline-block;
            background: #FFF5F5;
            color: var(--primary);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 10px;
        }
        
        .form-section {
            margin-bottom: 30px;
        }
        
        .form-section h3 {
            font-size: 1.2rem;
            color: var(--dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-section h3 i {
            color: var(--secondary);
            font-size: 1.3rem;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-row.full {
            grid-template-columns: 1fr;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-group label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .form-group input,
        .form-group textarea {
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: var(--transition);
            background: #f8f9fa;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1);
        }
        
        .form-group input:disabled {
            background: #f0f0f0;
            color: var(--gray);
            cursor: not-allowed;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .info-display {
            padding: 12px 16px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid var(--secondary);
        }
        
        .info-display p {
            color: var(--dark);
            font-size: 0.95rem;
            margin: 0;
        }
        
        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }
        
        .btn {
            padding: 14px 28px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            flex: 1;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(229, 57, 53, 0.3);
        }
        
        .btn-secondary {
            background: #f0f0f0;
            color: var(--dark);
            flex: 1;
        }
        
        .btn-secondary:hover {
            background: #e0e0e0;
        }
        
        .btn-logout {
            background: #ffebee;
            color: var(--primary);
            flex: 1;
        }
        
        .btn-logout:hover {
            background: #ffcdd2;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 30px;
        }
        
        .stat-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #f0f2f5 100%);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            border: 1px solid #e0e0e0;
        }
        
        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
            font-weight: 500;
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
        }
        
        .alert-success {
            background: #e8f5e9;
            color: var(--success);
            border-left: 4px solid var(--success);
        }
        
        .alert-error {
            background: #ffebee;
            color: var(--primary);
            border-left: 4px solid var(--primary);
        }
        
        .edit-mode .form-group input,
        .edit-mode .form-group textarea {
            background: white;
            border-color: var(--secondary);
        }
        
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.8rem;
            }
            
            .profile-card {
                padding: 25px;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>
                <i class="fa-solid fa-user-circle"></i>
                Profil Saya
            </h1>
            <a href="{{ route('home') }}" style="color: var(--gray); text-decoration: none; display: flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        
        <div class="profile-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="profile-info">
                    <h2>{{ auth()->user()->name }}</h2>
                    <p><i class="fa-solid fa-envelope"></i> {{ auth()->user()->email }}</p>
                    @if(auth()->user()->phone)
                        <p><i class="fa-solid fa-phone"></i> {{ auth()->user()->phone }}</p>
                    @endif
                    <span class="profile-role">
                        <i class="fa-solid fa-badge"></i>
                        @if(auth()->user()->role === 'user')
                            Customer
                        @elseif(auth()->user()->role === 'admin')
                            Administrator
                        @elseif(auth()->user()->role === 'petugas')
                            Petugas
                        @endif
                    </span>
                </div>
            </div>
            
            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-value">5</div>
                    <div class="stat-label">Pesanan</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">3</div>
                    <div class="stat-label">Selesai</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">Rp 2.5jt</div>
                    <div class="stat-label">Total Belanja</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">⭐ 4.8</div>
                    <div class="stat-label">Rating</div>
                </div>
            </div>
        </div>
        
        <!-- Profile Information Form -->
        <div class="profile-card">
            <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="form-section">
                    <h3>
                        <i class="fa-solid fa-circle-info"></i>
                        Informasi Pribadi
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" disabled>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information Section -->
                <div class="form-section">
                    <h3>
                        <i class="fa-solid fa-phone"></i>
                        Informasi Kontak
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone ?? '' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" id="address" name="address" value="{{ auth()->user()->address ?? '' }}" disabled>
                        </div>
                    </div>
                </div>
                
                <!-- Account Information Section -->
                <div class="form-section">
                    <h3>
                        <i class="fa-solid fa-shield"></i>
                        Informasi Akun
                    </h3>
                    
                    <div class="form-row full">
                        <div class="info-display">
                            <p><strong>Tipe Akun:</strong> 
                                @if(auth()->user()->role === 'user')
                                    Customer
                                @elseif(auth()->user()->role === 'admin')
                                    Administrator
                                @elseif(auth()->user()->role === 'petugas')
                                    Petugas
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="form-row full">
                        <div class="info-display">
                            <p><strong>Status:</strong> 
                                <span style="color: var(--success);"><i class="fa-solid fa-check-circle"></i> Aktif</span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="form-row full">
                        <div class="info-display">
                            <p><strong>Bergabung Sejak:</strong> {{ auth()->user()->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="button-group">
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-home"></i> Beranda
                    </a>
                    <a href="{{ route('orders') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-box"></i> Pesanan Saya
                    </a>
                    <button type="button" class="btn btn-logout" id="logoutBtn" style="flex: 1;">
                        <i class="fa-solid fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Logout Form (Outside profile form) -->
    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <script>
        // Handle logout button
        document.getElementById('logoutBtn').addEventListener('click', function() {
            if (confirm('Yakin ingin logout?')) {
                document.getElementById('logoutForm').submit();
            }
        });
    </script>
</body>
</html>
