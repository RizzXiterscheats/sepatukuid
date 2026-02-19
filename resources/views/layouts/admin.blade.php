<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - SepatuWara</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Semua CSS Anda di sini (copy dari kode Anda) */
        :root {
            --primary: #e50914;
            --primary-light: #ff4d4d;
            --primary-dark: #b2070a;
            --secondary: #1a1a1a;
            --accent: #00b4d8;
            --success: #2ecc71;
            --warning: #f39c12;
            --danger: #e74c3c;
            --light: #f8f9fa;
            --dark: #121212;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --card-bg: #ffffff;
            --sidebar-width: 240px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f5f7fa;
            color: #333;
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: var(--secondary);
            color: white;
            position: fixed;
            height: 100vh;
            padding: 20px 0;
            z-index: 1000;
            overflow-y: auto;
        }

        .logo-area {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 700;
            text-decoration: none;
            color: white;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0 15px;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(229, 9, 20, 0.15);
            color: white;
        }

        .nav-link.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 3px 8px rgba(229, 9, 20, 0.2);
        }

        .nav-icon {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .badge {
            margin-left: auto;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .header-left h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 5px;
        }

        .header-left p {
            color: var(--gray);
            font-size: 13px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .dashboard-content {
            padding: 5px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--secondary);
            line-height: 1;
        }

        .stat-title {
            font-size: 14px;
            color: var(--gray);
            margin-top: 10px;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            font-size: 13px;
            padding-top: 10px;
            border-top: 1px solid var(--gray-light);
        }

        .trend-up {
            color: var(--success);
        }

        .trend-down {
            color: var(--danger);
        }

        .trend-neutral {
            color: var(--gray);
        }

        .stat-trend i {
            margin-right: 5px;
        }

        .content-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 5px;
        }

        .section-subtitle {
            color: var(--gray);
            font-size: 13px;
        }

        .chart-container {
            height: 300px;
            background: #f8f9fa;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            margin-top: 15px;
            position: relative;
            overflow: hidden;
        }

        .chart-placeholder {
            text-align: center;
        }

        .chart-placeholder i {
            font-size: 60px;
            margin-bottom: 15px;
            color: var(--primary-light);
            opacity: 0.5;
        }

        .table-container {
            overflow-x: auto;
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 15px;
            color: var(--gray);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--gray-light);
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--gray-light);
            font-size: 14px;
            color: var(--secondary);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(229, 9, 20, 0.03);
        }

        .status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-lunas {
            background: rgba(46, 204, 113, 0.15);
            color: var(--success);
        }

        .status-pending {
            background: rgba(243, 156, 18, 0.15);
            color: var(--warning);
        }

        .status-ditandatangani {
            background: rgba(52, 152, 219, 0.15);
            color: #2980b9;
        }

        .status-proses {
            background: rgba(155, 89, 182, 0.15);
            color: #8e44ad;
        }

        .product-rating {
            display: flex;
            align-items: center;
            color: #f1c40f;
        }

        .product-rating span {
            color: var(--secondary);
            margin-left: 5px;
            font-weight: 600;
            font-size: 13px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 9, 20, 0.3);
        }

        .btn-outline {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background: rgba(229, 9, 20, 0.05);
        }

        .btn-view-all {
            background: rgba(229, 9, 20, 0.1);
            color: var(--primary);
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-view-all:hover {
            background: rgba(229, 9, 20, 0.2);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: var(--secondary);
        }

        .user-role {
            font-size: 12px;
            color: var(--gray);
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: var(--gray);
            font-size: 12px;
            border-top: 1px solid var(--gray-light);
            margin-top: 30px;
        }

        .two-column {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        @media (max-width: 1200px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
                font-size: 20px;
                cursor: pointer;
                color: var(--secondary);
            }
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .two-column {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .header-right {
                flex-direction: column;
            }
            
            .main-content {
                padding: 15px;
            }
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--secondary);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-area">
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <div class="logo-icon"><i class="fas fa-shoe-prints"></i></div>
                    <span>SepatuWara</span>
                </a>
            </div>
            
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-shoe-prints nav-icon"></i>
                        <span>Produk</span>
                        <span class="badge">{{ $totalProducts ?? '0' }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <span>Pesanan</span>
                        <span class="badge">{{ $ordersToday ?? '0' }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <span>Pelanggan</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <div style="padding: 10px 15px; font-size: 11px; color: rgba(255, 255, 255, 0.5); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 10px;">
                        Admin Management
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-cog nav-icon"></i>
                        <span>Kelola Petugas</span>
                        <span class="badge">5</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog nav-icon"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
            </ul>
            
            <div style="padding: 20px 15px 0; margin-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="user-profile">
                    <div class="user-avatar">{{ substr(Auth::user()->name ?? 'AP', 0, 2) }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="user-role">Role: {{ Auth::user()->role ?? 'Administrator' }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="width: 100%; margin-top: 15px; color: white; border-color: rgba(255, 255, 255, 0.3);">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <div class="menu-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1>@yield('page-title', 'Dashboard Admin')</h1>
                    <p>@yield('page-description', 'Selamat datang, Admin')</p>
                </div>
                
                <div class="header-right">
                    <div class="user-profile">
                        <div class="user-info" style="text-align: right;">
                            <div class="user-name">{{ Auth::user()?->name ?? 'Admin' }}</div>
                            <div class="user-role">Terakhir login: {{ Auth::user()?->updated_at?->format('d M Y') ?? '-' }}</div>
                        </div>
                        <div class="user-avatar">{{ substr(Auth::user()?->name ?? 'AP', 0, 2) }}</div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Mobile menu toggle
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Setup mobile menu
            function checkResponsive() {
                if (window.innerWidth <= 1200) {
                    document.querySelector('.menu-toggle').style.display = 'block';
                } else {
                    document.querySelector('.menu-toggle').style.display = 'none';
                    document.querySelector('.sidebar').classList.remove('active');
                }
            }
            
            checkResponsive();
            window.addEventListener('resize', checkResponsive);
        });
    </script>
    @stack('scripts')
</body>
</html>