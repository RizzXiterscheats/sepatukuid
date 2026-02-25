<header>
  <div class="container">
    <div class="nav">
      <a href="{{ route('home') }}" class="logo">
        <i class="fa-solid fa-shoe-prints"></i>
        SEPATUKUID
      </a>
      
      <nav class="menu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">Shop</a>
        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}">Products</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
      </nav>
      
      <div class="nav-actions">
        <div class="nav-icons">
          <i class="fa-solid fa-magnifying-glass"></i>
          
          <!-- User Icon -->
          @auth
            @if(Auth::user()->role == 'admin')
              <a href="{{ route('admin.dashboard') }}" title="Admin Dashboard">
                <i class="fa-regular fa-user"></i>
              </a>
            @elseif(Auth::user()->role == 'petugas')
              <a href="{{ route('petugas.dashboard') }}" title="Staff Dashboard">
                <i class="fa-regular fa-user"></i>
              </a>
            @else
              <a href="{{ route('profile') }}" title="My Profile">
                <i class="fa-regular fa-user"></i>
              </a>
            @endif
          @else
            <a href="{{ route('login') }}" title="Login/Register">
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
    </div>
  </div>
</header>
