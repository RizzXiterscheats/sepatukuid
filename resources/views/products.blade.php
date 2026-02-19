<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sepatukuid - Semua Produk Sepatu</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>
    :root {
      --primary: #E53935;
      --primary-light: #FF5252;
      --primary-dark: #C62828;
      --secondary: #2196F3;
      --dark: #121212;
      --gray-dark: #333;
      --gray: #666;
      --gray-light: #999;
      --light: #f8f9fa;
      --bg: #ffffff;
      --success: #4CAF50;
      --warning: #FF9800;
      --card-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
      --card-shadow-hover: 0 25px 60px rgba(0, 0, 0, 0.15);
      --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      --border-radius: 20px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--dark);
      background: var(--bg);
      line-height: 1.6;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }

    img {
      max-width: 100%;
      display: block;
    }

    a {
      text-decoration: none;
      color: inherit;
      transition: var(--transition);
    }

    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .btn {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      padding: 14px 28px;
      border: none;
      font-weight: 700;
      cursor: pointer;
      border-radius: 50px;
      transition: var(--transition);
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 15px;
      letter-spacing: 0.5px;
      position: relative;
      overflow: hidden;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: 0.5s;
    }

    .btn:hover::before {
      left: 100%;
    }

    .btn:hover {
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 15px 30px rgba(229, 57, 53, 0.3);
    }

    .btn-outline {
      background: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
    }

    .btn-outline:hover {
      background: var(--primary);
      color: white;
    }

    .btn-view {
      background: transparent;
      border: 2px solid var(--gray-light);
      color: var(--gray-dark);
      padding: 10px 20px;
      font-weight: 600;
      border-radius: 50px;
      transition: var(--transition);
      font-size: 14px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-view:hover {
      background: var(--gray-dark);
      color: white;
      border-color: var(--gray-dark);
      transform: translateY(-2px);
    }

    .btn-filter {
      padding: 10px 20px;
      background: var(--light);
      border: none;
      border-radius: 50px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      font-size: 14px;
    }

    .btn-filter:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-2px);
    }

    .btn-filter.active {
      background: var(--primary);
      color: white;
    }

    .section-title {
      text-align: center;
      margin-bottom: 50px;
      position: relative;
    }

    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 900;
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
      background: linear-gradient(45deg, var(--dark), var(--primary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -0.5px;
    }

    .section-title h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
    }

    .section-title p {
      color: var(--gray);
      font-size: 1.1rem;
      max-width: 700px;
      margin: 15px auto 0;
      line-height: 1.7;
    }

    /* NAVBAR */
    header {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(20px);
      position: sticky;
      top: 0;
      width: 100%;
      z-index: 1000;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08);
      padding: 15px 0;
      box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
    }

    .nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 900;
      color: var(--primary);
      font-size: 1.6rem;
      letter-spacing: -0.5px;
    }

    .logo i {
      font-size: 2rem;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .menu {
      display: flex;
      gap: 35px;
      font-weight: 600;
    }

    .menu a {
      position: relative;
      padding: 8px 0;
      font-size: 1rem;
    }

    .menu a.active {
      color: var(--primary);
    }

    .menu a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
      transition: var(--transition);
    }

    .menu a:hover::after,
    .menu a.active::after {
      width: 100%;
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .nav-icons {
      display: flex;
      gap: 20px;
      font-size: 1.2rem;
    }

    .nav-icons i {
      cursor: pointer;
      padding: 10px;
      border-radius: 50%;
      transition: var(--transition);
      background: var(--light);
    }

    .nav-icons i:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-3px);
    }

    .cart-count {
      position: absolute;
      top: -5px;
      right: -5px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      font-size: 0.7rem;
      min-width: 18px;
      height: 18px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      box-shadow: 0 3px 10px rgba(229, 57, 53, 0.3);
    }

    /* PRODUCTS HERO */
    .products-hero {
      padding: 120px 0 60px;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .products-hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 70%;
      height: 200%;
      background: radial-gradient(circle, rgba(229, 57, 53, 0.05) 0%, transparent 70%);
      transform: rotate(30deg);
    }

    .products-hero h1 {
      font-size: 3rem;
      font-weight: 900;
      margin-bottom: 15px;
      background: linear-gradient(45deg, var(--dark), var(--gray-dark), var(--primary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -1px;
    }

    .products-hero p {
      font-size: 1.1rem;
      color: var(--gray);
      max-width: 600px;
      margin: 0 auto 30px;
      line-height: 1.7;
    }

    /* FILTER BAR */
    .filter-bar {
      padding: 25px 0;
      background: white;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .filter-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
    }

    .filter-left {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .filter-right {
      display: flex;
      gap: 15px;
      align-items: center;
    }

    .sort-select {
      padding: 10px 20px;
      border: 2px solid var(--light);
      border-radius: 50px;
      font-weight: 500;
      background: white;
      cursor: pointer;
      font-size: 14px;
    }

    .sort-select:focus {
      outline: none;
      border-color: var(--primary);
    }

    .result-count {
      font-size: 0.9rem;
      color: var(--gray);
      font-weight: 500;
    }

    /* PRODUCTS GRID */
    .products-section {
      padding: 50px 0 80px;
      background: white;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 25px;
      margin-bottom: 40px;
    }

    .product-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      position: relative;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .product-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: var(--card-shadow-hover);
    }

    .product-badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      padding: 6px 15px;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 800;
      z-index: 1;
      box-shadow: 0 5px 15px rgba(229, 57, 53, 0.3);
    }

    .product-badge.new {
      background: linear-gradient(135deg, var(--success), #2ECC71);
    }

    .product-badge.sale {
      background: linear-gradient(135deg, var(--warning), #FFB74D);
    }

    .product-image {
      height: 220px;
      width: 100%;
      object-fit: cover;
      transition: transform 0.6s ease;
    }

    .product-card:hover .product-image {
      transform: scale(1.05);
    }

    .product-info {
      padding: 20px;
    }

    .product-category {
      color: var(--gray-light);
      font-size: 0.8rem;
      margin-bottom: 8px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .product-title {
      font-size: 1.2rem;
      font-weight: 800;
      margin-bottom: 10px;
      color: var(--dark);
      line-height: 1.3;
      min-height: 50px;
    }

    .product-rating {
      color: #FFD700;
      margin-bottom: 10px;
      font-size: 0.9rem;
    }

    .rating-count {
      color: var(--gray);
      margin-left: 5px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .product-price {
      font-size: 1.4rem;
      font-weight: 900;
      color: var(--primary);
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .old-price {
      font-size: 1rem;
      color: var(--gray-light);
      text-decoration: line-through;
      font-weight: 500;
    }

    .product-actions {
      display: flex;
      gap: 10px;
    }

    .btn-cart {
      flex: 1;
      padding: 10px;
      font-size: 0.9rem;
    }

    .btn-detail {
      padding: 10px 15px;
      font-size: 0.9rem;
    }

    /* PAGINATION */
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      margin-top: 40px;
    }

    .pagination a {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: var(--light);
      color: var(--gray-dark);
      font-weight: 600;
      transition: var(--transition);
      font-size: 0.9rem;
    }

    .pagination a.active {
      background: var(--primary);
      color: white;
    }

    .pagination a:hover:not(.disabled) {
      background: var(--primary);
      color: white;
      transform: translateY(-2px);
    }

    .pagination a.disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    /* FEATURED BANNER */
    .featured-banner {
      margin: 40px 0;
      padding: 40px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 25px;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .featured-banner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?q=80&w=1200') center/cover;
      opacity: 0.1;
    }

    .banner-content {
      position: relative;
      z-index: 2;
      text-align: center;
    }

    .banner-content h3 {
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 15px;
    }

    .banner-content p {
      font-size: 1.1rem;
      max-width: 500px;
      margin: 0 auto 20px;
      opacity: 0.95;
    }

    /* FOOTER */
    footer {
      background: linear-gradient(135deg, var(--dark) 0%, #000000 100%);
      color: #ccc;
      padding: 60px 0 30px;
      position: relative;
    }

    footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    .footer-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
      margin-bottom: 40px;
    }

    .footer-column h4 {
      color: white;
      font-size: 1.2rem;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
      font-weight: 800;
    }

    .footer-column h4::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 3px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 12px;
    }

    .footer-links a {
      color: #aaa;
      transition: var(--transition);
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .footer-links a:hover {
      color: white;
      padding-left: 8px;
    }

    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }

    .social-links a {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: var(--transition);
      font-size: 1.1rem;
    }

    .social-links a:hover {
      background: var(--primary);
      transform: translateY(-5px) scale(1.1);
    }

    .copyright {
      text-align: center;
      padding-top: 30px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: var(--gray-light);
      font-size: 0.9rem;
    }

    /* RESPONSIVE */
    @media (max-width: 1200px) {
      .products-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 992px) {
      .menu {
        display: none;
      }
      
      .products-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .footer-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .products-hero h1 {
        font-size: 2.5rem;
      }
    }

    @media (max-width: 768px) {
      .products-hero {
        padding: 100px 0 40px;
      }
      
      .products-hero h1 {
        font-size: 2rem;
      }
      
      .filter-container {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .filter-right {
        width: 100%;
        justify-content: space-between;
      }
      
      .products-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }
    }

    @media (max-width: 576px) {
      .filter-left {
        width: 100%;
        overflow-x: auto;
        padding-bottom: 10px;
      }
      
      .btn-filter {
        white-space: nowrap;
      }
      
      .footer-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>

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
          <a href="{{ route('login') }}" style="color: inherit;">
            <div style="position: relative;">
              <i class="fa-regular fa-user"></i>
            </div>
          </a>
@auth
    @if(Auth::user()->role === 'user')
    <a href="{{ route('user.cart') }}" style="color: inherit;">
        <div style="position: relative;">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="cart-count">3</span>
        </div>
    </a>
    @else
    <a href="#" onclick="alert('Halaman ini hanya untuk user')" style="color: inherit;">
        <div style="position: relative;">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="cart-count">3</span>
        </div>
    </a>
    @endif
@else
<a href="{{ route('login') }}" style="color: inherit;">
    <div style="position: relative;">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="cart-count">0</span>
    </div>
</a>
@endauth
        </div>
      </div>
    </div>
  </div>
</header>

<section class="products-hero">
  <div class="container">
    <h1>Koleksi Produk Sepatu</h1>
    <p>Temukan berbagai pilihan sepatu berkualitas untuk segala aktivitasmu. Dari running, lifestyle, hingga casual.</p>
  </div>
</section>

<section class="filter-bar">
  <div class="container">
    <div class="filter-container">
      <div class="filter-left">
        <button class="btn-filter active">Semua Produk</button>
        <button class="btn-filter">Running</button>
        <button class="btn-filter">Lifestyle</button>
        <button class="btn-filter">Casual</button>
        <button class="btn-filter">Basket</button>
        <button class="btn-filter">Training</button>
        <button class="btn-filter">Hiking</button>
      </div>
      
      <div class="filter-right">
        <span class="result-count">Menampilkan 24 dari 124 produk</span>
        <select class="sort-select">
          <option>Terpopuler</option>
          <option>Harga: Rendah ke Tinggi</option>
          <option>Harga: Tinggi ke Rendah</option>
          <option>Terbaru</option>
          <option>Rating Tertinggi</option>
        </select>
      </div>
    </div>
  </div>
</section>

<section class="products-section">
  <div class="container">
    <div class="products-grid">
      
      <!-- Produk 1: Nike Air Max 270 -->
      <div class="product-card">
        <span class="product-badge new">NEW</span>
        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800" class="product-image" alt="Nike Air Max 270">
        <div class="product-info">
          <div class="product-category">Running</div>
          <h3 class="product-title">Nike Air Max 270 React</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half"></i>
            <span class="rating-count">(428)</span>
          </div>
          <div class="product-price">
            Rp 1.299.000
            <span class="old-price">Rp 1.599.000</span>
          </div>
          <div class="product-actions">
           <!-- Untuk user yang sudah login (role user) -->
@auth
    @if(Auth::user()->role === 'user')
        <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
    @else
        <a href="#" onclick="alert('Silakan login sebagai pembeli untuk menambah ke keranjang')" class="btn btn-cart">Tambah</a>
    @endif
@else
    <a href="{{ route('login') }}" class="btn btn-cart">Tambah</a>
@endauth
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 2: Adidas Ultraboost -->
      <div class="product-card">
        <span class="product-badge">BEST SELLER</span>
        <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?q=80&w=800" class="product-image" alt="Adidas Ultraboost">
        <div class="product-info">
          <div class="product-category">Lifestyle</div>
          <h3 class="product-title">Adidas Ultraboost 22</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <span class="rating-count">(312)</span>
          </div>
          <div class="product-price">
            Rp 1.499.000
            <span class="old-price">Rp 1.799.000</span>
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 3: Converse Chuck Taylor -->
      <div class="product-card">
        <span class="product-badge sale">SALE</span>
        <img src="https://images.unsplash.com/photo-1597045566677-8cf032ed6634?q=80&w=800" class="product-image" alt="Converse Chuck Taylor">
        <div class="product-info">
          <div class="product-category">Casual</div>
          <h3 class="product-title">Converse Chuck Taylor All Star</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <span class="rating-count">(567)</span>
          </div>
          <div class="product-price">
            Rp 699.000
            <span class="old-price">Rp 999.000</span>
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 4: Nike Air Force 1 -->
      <div class="product-card">
        <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=800" class="product-image" alt="Nike Air Force 1">
        <div class="product-info">
          <div class="product-category">Lifestyle</div>
          <h3 class="product-title">Nike Air Force 1 '07 Premium</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half"></i>
            <span class="rating-count">(389)</span>
          </div>
          <div class="product-price">
            Rp 1.499.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 5: New Balance 574 -->
      <div class="product-card">
        <span class="product-badge new">NEW</span>
        <img src="https://images.unsplash.com/photo-1605348532760-6753d2c43329?q=80&w=800" class="product-image" alt="New Balance 574">
        <div class="product-info">
          <div class="product-category">Casual</div>
          <h3 class="product-title">New Balance 574 Core</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <span class="rating-count">(245)</span>
          </div>
          <div class="product-price">
            Rp 1.099.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 6: Puma RS-X -->
      <div class="product-card">
        <span class="product-badge sale">SALE</span>
        <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=800" class="product-image" alt="Puma RS-X">
        <div class="product-info">
          <div class="product-category">Lifestyle</div>
          <h3 class="product-title">Puma RS-X Reinvention</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half"></i>
            <span class="rating-count">(178)</span>
          </div>
          <div class="product-price">
            Rp 849.000
            <span class="old-price">Rp 1.099.000</span>
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 7: Asics Gel-Kayano -->
      <div class="product-card">
        <img src="https://images.unsplash.com/photo-1539185441755-769473a23570?q=80&w=800" class="product-image" alt="Asics Gel-Kayano">
        <div class="product-info">
          <div class="product-category">Running</div>
          <h3 class="product-title">Asics Gel-Kayano 29</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <span class="rating-count">(156)</span>
          </div>
          <div class="product-price">
            Rp 1.899.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 8: Vans Old Skool -->
      <div class="product-card">
        <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=800" class="product-image" alt="Vans Old Skool">
        <div class="product-info">
          <div class="product-category">Casual</div>
          <h3 class="product-title">Vans Old Skool Black</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <span class="rating-count">(423)</span>
          </div>
          <div class="product-price">
            Rp 899.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 9: Reebok Classic -->
      <div class="product-card">
        <span class="product-badge">BEST SELLER</span>
        <img src="https://images.unsplash.com/photo-1543508282-6319a3e2621f?q=80&w=800" class="product-image" alt="Reebok Classic">
        <div class="product-info">
          <div class="product-category">Lifestyle</div>
          <h3 class="product-title">Reebok Classic Leather</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half"></i>
            <span class="rating-count">(289)</span>
          </div>
          <div class="product-price">
            Rp 1.099.000
            <span class="old-price">Rp 1.299.000</span>
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 10: Hoka One One -->
      <div class="product-card">
        <span class="product-badge new">NEW</span>
        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=800" class="product-image" alt="Hoka One One">
        <div class="product-info">
          <div class="product-category">Running</div>
          <h3 class="product-title">Hoka One One Clifton 8</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <span class="rating-count">(98)</span>
          </div>
          <div class="product-price">
            Rp 1.799.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 11: Saucony Triumph -->
      <div class="product-card">
        <img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=800" class="product-image" alt="Saucony Triumph">
        <div class="product-info">
          <div class="product-category">Running</div>
          <h3 class="product-title">Saucony Triumph 19</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half"></i>
            <span class="rating-count">(134)</span>
          </div>
          <div class="product-price">
            Rp 1.599.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 12: Diadora N9000 -->
      <div class="product-card">
        <span class="product-badge">LIMITED</span>
        <img src="https://images.unsplash.com/photo-1587563871167-f11eaf1b3fa4?q=80&w=800" class="product-image" alt="Diadora N9000">
        <div class="product-info">
          <div class="product-category">Lifestyle</div>
          <h3 class="product-title">Diadora N9000 Made in Italy</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <span class="rating-count">(67)</span>
          </div>
          <div class="product-price">
            Rp 2.499.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 13: Brooks Ghost -->
      <div class="product-card">
        <img src="https://images.unsplash.com/photo-1575537302964-96cd47c06b1b?q=80&w=800" class="product-image" alt="Brooks Ghost">
        <div class="product-info">
          <div class="product-category">Running</div>
          <h3 class="product-title">Brooks Ghost 14</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <span class="rating-count">(203)</span>
          </div>
          <div class="product-price">
            Rp 1.399.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 14: Fila Disruptor -->
      <div class="product-card">
        <span class="product-badge sale">SALE</span>
        <img src="https://images.unsplash.com/photo-1575537302964-96cd47c06b1b?q=80&w=800" class="product-image" alt="Fila Disruptor">
        <div class="product-info">
          <div class="product-category">Lifestyle</div>
          <h3 class="product-title">Fila Disruptor II Premium</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half"></i>
            <span class="rating-count">(312)</span>
          </div>
          <div class="product-price">
            Rp 799.000
            <span class="old-price">Rp 1.099.000</span>
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 15: On Running Cloud -->
      <div class="product-card">
        <span class="product-badge new">NEW</span>
        <img src="https://images.unsplash.com/photo-1556909211-36987daf7b4d?q=80&w=800" class="product-image" alt="On Running Cloud">
        <div class="product-info">
          <div class="product-category">Running</div>
          <h3 class="product-title">On Running Cloudswift</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <span class="rating-count">(87)</span>
          </div>
          <div class="product-price">
            Rp 2.199.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
      <!-- Produk 16: Salomon XT-6 -->
      <div class="product-card">
        <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?q=80&w=800" class="product-image" alt="Salomon XT-6">
        <div class="product-info">
          <div class="product-category">Hiking</div>
          <h3 class="product-title">Salomon XT-6 Advanced</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <span class="rating-count">(156)</span>
          </div>
          <div class="product-price">
            Rp 1.899.000
          </div>
          <div class="product-actions">
            <a href="{{ route('user.cart') }}" class="btn btn-cart">Tambah</a>
            <a href="{{ route('login') }}" class="btn-view btn-detail">Detail</a>
          </div>
        </div>
      </div>
      
    </div>
    
    <!-- Featured Banner -->
    <div class="featured-banner">
      <div class="banner-content">
        <h3>Special Collection</h3>
        <p>Dapatkan diskon spesial untuk koleksi sepatu running terbaru</p>
        <a href="{{ route('products.index') }}" class="btn" style="background: white; color: var(--primary);">Shop Now</a>
      </div>
    </div>
    
    <!-- Pagination -->
    <div class="pagination">
      <a href="#" class="disabled">
        <i class="fa-solid fa-chevron-left"></i>
      </a>
      <a href="#" class="active">1</a>
      <a href="#">2</a>
      <a href="#">3</a>
      <a href="#">4</a>
      <a href="#">5</a>
      <a href="#">
        <i class="fa-solid fa-chevron-right"></i>
      </a>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-column">
        <h4>SepatuKuid</h4>
        <p style="margin-bottom: 20px; font-size: 0.95rem; line-height: 1.6; color: #aaa;">Brand sneakers lokal dengan kualitas internasional. Kami berkomitmen memberikan pengalaman berbelanja terbaik.</p>
        <div class="social-links">
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-twitter"></i></a>
          <a href="#"><i class="fa-brands fa-tiktok"></i></a>
          <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
      
      <div class="footer-column">
        <h4>Kategori Produk</h4>
        <ul class="footer-links">
          <li><a href="{{ route('products.index') }}?category=running"><i class="fa-solid fa-chevron-right"></i> Sneakers Running</a></li>
          <li><a href="{{ route('products.index') }}?category=lifestyle"><i class="fa-solid fa-chevron-right"></i> Sneakers Lifestyle</a></li>
          <li><a href="{{ route('products.index') }}?category=casual"><i class="fa-solid fa-chevron-right"></i> Sneakers Casual</a></li>
          <li><a href="{{ route('products.index') }}?category=sport"><i class="fa-solid fa-chevron-right"></i> Sneakers Sport</a></li>
          <li><a href="{{ route('products.index') }}?category=hiking"><i class="fa-solid fa-chevron-right"></i> Sneakers Hiking</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Bantuan & Support</h4>
        <ul class="footer-links">
          <li><a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right"></i> FAQ & Bantuan</a></li>
          <li><a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right"></i> Info Pengiriman</a></li>
          <li><a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right"></i> Returns & Exchanges</a></li>
          <li><a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right"></i> Size Guide</a></li>
          <li><a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right"></i> Cara Pemesanan</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Hubungi Kami</h4>
        <ul class="footer-links">
          <li><a href="mailto:hello@sepatukuid.com"><i class="fa-solid fa-envelope"></i> hello@sepatukuid.com</a></li>
          <li><a href="tel:+6281234567890"><i class="fa-solid fa-phone"></i> +62 812 3456 7890</a></li>
          <li><a href="#"><i class="fa-solid fa-location-dot"></i> Jl. Sudirman No. 123, Jakarta</a></li>
          <li><i class="fa-solid fa-clock"></i> Senin - Minggu: 08:00 - 22:00</li>
        </ul>
      </div>
    </div>
    
    <div class="copyright">
      &copy; 2026 SepatuKuid. All rights reserved. | Designed for sneaker lovers
    </div>
  </div>
</footer>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Filter buttons functionality
    const filterButtons = document.querySelectorAll('.btn-filter');
    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        filterButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
      });
    });
    
    // Product card hover effect
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px) scale(1.02)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
      });
    });
    
    // Add to cart animation
    const addToCartButtons = document.querySelectorAll('.btn-cart');
    addToCartButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const cartCount = document.querySelector('.cart-count');
        let count = parseInt(cartCount.textContent);
        cartCount.textContent = count + 1;
        
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fa-solid fa-check"></i> Ditambah';
        this.style.background = 'linear-gradient(135deg, #4CAF50 0%, #2ECC71 100%)';
        
        setTimeout(() => {
          this.innerHTML = originalText;
          this.style.background = '';
          
          // Redirect to cart page
          window.location.href = '{{ route("user.cart") }}';
        }, 1000);
      });
    });
  });
</script>
</body>
</html>