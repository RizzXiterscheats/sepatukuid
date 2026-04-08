<header>
  <div class="container">
    <div class="nav">
      <a href="{{ route('home') }}" class="logo">
        <i class="fa-solid fa-shoe-prints"></i>
        SEPATUKUID
      </a>
      
      <nav class="menu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">Katalog</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
        @auth
          <a href="{{ route('tickets.index') }}" class="{{ request()->routeIs('tickets.*') ? 'active' : '' }}">Ticket Bantuan</a>
        @else
          <a href="{{ route('login') }}">Ticket Bantuan</a>
        @endauth
      </nav>
      
      <div class="nav-actions">
        <div class="nav-icons">
          <!-- Search Form -->
          <div class="search-wrapper">
            <form action="{{ route('shop') }}" method="GET" id="search-form">
              <input type="text" name="search" id="search-input" placeholder="Cari sneakers favorit Anda..." value="{{ request('search') }}">
              <button type="submit" id="search-submit" style="background: none; border: none; padding: 0;">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </form>
          </div>
          
          <!-- User Icon -->
          @auth
            @if(Auth::user()->role == 'admin')
              <a href="{{ route('admin.dashboard') }}" title="Panel Admin">
                <i class="fa-regular fa-user"></i>
              </a>
            @elseif(Auth::user()->role == 'petugas')
              <a href="{{ route('petugas.dashboard') }}" title="Panel Petugas">
                <i class="fa-regular fa-user"></i>
              </a>
            @else
              <a href="{{ route('profile') }}" title="Profil Saya"><i class="fa-solid fa-user-gear"></i></a>
              <a href="{{ route('orders') }}" title="Pesanan Saya"><i class="fa-solid fa-box"></i></a>
              <a href="{{ route('wishlist.index') }}" title="Wishlist Saya"><i class="fa-solid fa-heart"></i></a>
            @endif
          @else
            <a href="{{ route('login') }}" title="Masuk atau Daftar">
              <i class="fa-regular fa-user"></i>
            </a>
          @endauth
          
          <!-- Cart Icon -->
          <div style="position: relative;">
            <a href="{{ route('cart') }}">
              <i class="fa-solid fa-cart-shopping"></i>
              <span class="cart-count">{{ count(session('cart', [])) }}</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Hamburger Menu for Mobile -->
      <button class="hamburger-btn" id="hamburger-btn">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('search-form').addEventListener('submit', function(e) {
      const input = document.getElementById('search-input');
      if (!input.value.trim() && document.activeElement !== input) {
        e.preventDefault();
        input.focus();
      }
    });

    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mainMenu = document.querySelector('.menu');
    
    if(hamburgerBtn && mainMenu) {
        hamburgerBtn.addEventListener('click', function() {
            mainMenu.classList.toggle('show-mobile');
        });
    }
  });
</script>
