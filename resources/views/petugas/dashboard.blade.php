<!DOCTYPE html>
<html>
<head>
    <title>Petugas Dashboard - Sepatuku.id</title>
    <style>
        body { font-family: Arial; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: orange; color: white; padding: 25px; border-radius: 10px; margin-bottom: 20px; }
        .menu { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .menu-list { list-style: none; padding: 0; }
        .menu-list li { padding: 12px 0; border-bottom: 1px solid #eee; }
        .menu-list a { color: #333; text-decoration: none; font-size: 16px; }
        .menu-list a:hover { color: orange; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Petugas Dashboard - Sepatuku.id</h1>
            <p>Welcome, {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>
        </div>
        
        <div class="menu">
            <h2>Menu Petugas:</h2>
            <ul class="menu-list">
                <li><a href="#">📋 Lihat Pesanan</a></li>
                <li><a href="#">🚚 Proses Pengiriman</a></li>
                <li><a href="#">📦 Cek Stok</a></li>
                <li><a href="#">👥 Data Pelanggan</a></li>
            </ul>
            
            <div style="margin-top: 20px;">
                <a href="{{ route('home') }}" style="color: #666; margin-right: 15px;">🏠 Kembali ke Home</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: orange; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>