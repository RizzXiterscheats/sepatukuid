<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Dashboard - Sepatukuid</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #FF9800;
            --primary-light: #FFB74D;
            --primary-dark: #F57C00;
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

        /* SIDEBAR */
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
            background: rgba(255, 152, 0, 0.15);
            color: white;
        }

        .nav-link.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 3px 8px rgba(255, 152, 0, 0.2);
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

        /* MAIN CONTENT */
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

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-left .menu-toggle {
            background: none;
            border: none;
            font-size: 24px;
            color: #666;
            cursor: pointer;
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

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .user-role {
            color: #999;
            font-size: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* STATS */
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

        .stat-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .stat-icon.pending { color: var(--warning); }
        .stat-icon.shipped { color: var(--primary); }
        .stat-icon.delivered { color: var(--success); }
        .stat-icon.total { color: var(--accent); }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--secondary);
            line-height: 1;
        }

        .stat-label {
            color: var(--gray);
            font-size: 13px;
            margin-top: 5px;
        }

        /* MENU CARDS */
        .menu-container {
            margin-bottom: 30px;
        }

        .menu-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .menu-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .menu-card-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .menu-card-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .menu-card-desc {
            font-size: 12px;
            color: #999;
        }

        /* FOOTER */
        .dashboard-footer {
            padding: 20px;
            text-align: center;
            color: #999;
            font-size: 13px;
        }

        .logout-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="logo-area">
                <a href="{{ route('petugas.dashboard') }}" class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <span>Petugas</span>
                </a>
            </div>

            <nav>
                <ul class="sidebar-nav">
                    <li class="nav-item">
                        <a href="{{ route('petugas.dashboard') }}" class="nav-link active">
                            <span class="nav-icon"><i class="fas fa-gauge"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                            <span>Pesanan</span>
                            <span class="badge">12</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-truck"></i></span>
                            <span>Pengiriman</span>
                            <span class="badge">5</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-boxes"></i></span>
                            <span>Stok</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-users"></i></span>
                            <span>Pelanggan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- HEADER -->
            <header class="header">
                <div class="header-left">
                    <button class="menu-toggle" onclick="this.parentElement.parentElement.parentElement.parentElement.querySelector('.sidebar').style.display = this.parentElement.parentElement.parentElement.parentElement.querySelector('.sidebar').style.display === 'none' ? 'block' : 'none'">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1>Dashboard Petugas</h1>
                        <p>Kelola pesanan dan pengiriman dengan mudah</p>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="user-profile">
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()?->name ?? 'Petugas' }}</div>
                            <div class="user-role">{{ Auth::user()?->role ?? 'petugas' }}</div>
                        </div>
                        <div class="user-avatar">{{ substr(Auth::user()?->name ?? 'P', 0, 1) }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- STATS -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="fas fa-hourglass-start"></i>
                    </div>
                    <div class="stat-value">8</div>
                    <div class="stat-label">Pesanan Tertunda</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon shipped">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Dalam Pengiriman</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon delivered">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value">156</div>
                    <div class="stat-label">Terkirim</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-value">176</div>
                    <div class="stat-label">Total Pesanan</div>
                </div>
            </div>

            <!-- MENU -->
            <div class="menu-container">
                <div class="menu-title">Menu Utama</div>
                <div class="menu-grid">
                    <div class="menu-card">
                        <div class="menu-card-icon">📋</div>
                        <div class="menu-card-title">Lihat Pesanan</div>
                        <div class="menu-card-desc">Kelola semua pesanan pelanggan</div>
                    </div>
                    <div class="menu-card">
                        <div class="menu-card-icon">🚚</div>
                        <div class="menu-card-title">Proses Pengiriman</div>
                        <div class="menu-card-desc">Update status pengiriman</div>
                    </div>
                    <div class="menu-card">
                        <div class="menu-card-icon">📦</div>
                        <div class="menu-card-title">Cek Stok</div>
                        <div class="menu-card-desc">Pantau ketersediaan produk</div>
                    </div>
                    <div class="menu-card">
                        <div class="menu-card-icon">👥</div>
                        <div class="menu-card-title">Data Pelanggan</div>
                        <div class="menu-card-desc">Lihat informasi pelanggan</div>
                    </div>
                </div>
            </div>

            <footer class="dashboard-footer">
                <p>&copy; 2026 Sepatukuid. All rights reserved. | Last updated: {{ now()->format('d M Y H:i') }}</p>
            </footer>
        </main>
    </div>
</body>
</html>