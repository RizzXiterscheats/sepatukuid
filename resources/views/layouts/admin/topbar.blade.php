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
