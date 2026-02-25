<aside class="sidebar">
    <div class="logo-area">
        <a href="{{ route('admin.dashboard') }}" class="logo">
            <div class="logo-icon"><i class="fas fa-shoe-prints"></i></div>
            <span>SEPATUKU.ID</span>
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
            <a href="{{ route('admin.produk.index') }}" class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                <i class="fas fa-shoe-prints nav-icon"></i>
                <span>Produk</span>
                <span class="badge">{{ \App\Models\Product::count() ?? '0' }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pesanan.index') }}" class="nav-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart nav-icon"></i>
                <span>Pesanan</span>
                <span class="badge" style="background: var(--warning); color: white;">{{ \App\Models\Order::whereDate('created_at', today())->count() ?? '0' }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pelanggan.index') }}" class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                <i class="fas fa-users nav-icon"></i>
                <span>Pelanggan</span>
                <span class="badge" style="background: var(--info); color: white;">{{ \App\Models\User::where('role', 'user')->count() ?? '0' }}</span>
            </a>
        </li>
        
        @if(Auth::user()->role === 'admin')
        <li class="nav-item">
            <div style="padding: 10px 15px; font-size: 11px; color: rgba(255, 255, 255, 0.5); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 10px;">
                Admin Management
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.petugas.index') }}" class="nav-link {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                <i class="fas fa-user-cog nav-icon"></i>
                <span>Kelola Petugas</span>
                <span class="badge" style="background: var(--primary); color: white;">{{ \App\Models\User::whereIn('role', ['admin', 'petugas'])->count() ?? '0' }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar nav-icon"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pengaturan.index') }}" class="nav-link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
                <i class="fas fa-cog nav-icon"></i>
                <span>Pengaturan</span>
            </a>
        </li>
        @endif
    </ul>
    
    <div style="padding: 20px 15px 0; margin-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="user-profile">
            <div class="user-avatar">{{ substr(Auth::user()->name ?? 'AP', 0, 2) }}</div>
            <div class="user-info">
                <div class="user-name ">{{ Auth::user()->name ?? 'Admin' }}</div>
                <div class="user-role">Role: {{ Auth::user()->role ?? 'Administrator' }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn" style="width: 100%; margin-top: 15px; background: #e50914; color: white; border: none; justify-content: center; box-shadow: 0 4px 6px rgba(229, 9, 20, 0.2);">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>
