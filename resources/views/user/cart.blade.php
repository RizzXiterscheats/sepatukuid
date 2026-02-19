<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sepatukuid - Keranjang Belanja</title>

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

    .btn-secondary {
      background: transparent;
      border: 2px solid var(--gray-light);
      color: var(--gray-dark);
      padding: 12px 24px;
      font-weight: 600;
      border-radius: 50px;
      transition: var(--transition);
    }

    .btn-secondary:hover {
      background: var(--gray-dark);
      color: white;
      border-color: var(--gray-dark);
      transform: translateY(-2px);
    }

    .btn-danger {
      background: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
      padding: 10px 20px;
      font-weight: 600;
      border-radius: 50px;
      transition: var(--transition);
    }

    .btn-danger:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-2px);
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

    /* CART HERO */
    .cart-hero {
      padding: 100px 0 40px;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .cart-hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 70%;
      height: 200%;
      background: radial-gradient(circle, rgba(229, 57, 53, 0.05) 0%, transparent 70%);
      transform: rotate(30deg);
    }

    .cart-hero h1 {
      font-size: 2.5rem;
      font-weight: 900;
      margin-bottom: 10px;
      background: linear-gradient(45deg, var(--dark), var(--primary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -1px;
    }

    .cart-hero p {
      font-size: 1rem;
      color: var(--gray);
    }

    /* CART SECTION */
    .cart-section {
      padding: 40px 0 80px;
      background: white;
    }

    .cart-container {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 30px;
    }

    /* CART ITEMS */
    .cart-items {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
    }

    .cart-header {
      display: grid;
      grid-template-columns: 3fr 1fr 1fr 1fr 0.5fr;
      padding: 20px;
      background: var(--light);
      font-weight: 700;
      color: var(--gray-dark);
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .cart-row {
      display: grid;
      grid-template-columns: 3fr 1fr 1fr 1fr 0.5fr;
      padding: 20px;
      align-items: center;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      transition: var(--transition);
    }

    .cart-row:hover {
      background: rgba(0, 0, 0, 0.02);
    }

    .cart-product {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .cart-product-image {
      width: 80px;
      height: 80px;
      border-radius: 10px;
      overflow: hidden;
    }

    .cart-product-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .cart-product-info h3 {
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .cart-product-info p {
      font-size: 0.8rem;
      color: var(--gray);
    }

    .cart-price {
      font-weight: 700;
      color: var(--primary);
    }

    .cart-quantity {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .quantity-btn {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: var(--light);
      border: none;
      cursor: pointer;
      transition: var(--transition);
      font-weight: 700;
    }

    .quantity-btn:hover {
      background: var(--primary);
      color: white;
    }

    .quantity-input {
      width: 40px;
      text-align: center;
      border: 1px solid var(--light);
      border-radius: 5px;
      padding: 5px;
    }

    .cart-subtotal {
      font-weight: 700;
      color: var(--primary);
    }

    .cart-remove {
      color: var(--gray-light);
      cursor: pointer;
      transition: var(--transition);
      font-size: 1.1rem;
    }

    .cart-remove:hover {
      color: var(--primary);
      transform: scale(1.1);
    }

    /* CART SUMMARY */
    .cart-summary {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 30px;
      position: sticky;
      top: 100px;
    }

    .summary-title {
      font-size: 1.3rem;
      font-weight: 800;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--light);
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
      color: var(--gray);
    }

    .summary-row.total {
      font-size: 1.2rem;
      font-weight: 800;
      color: var(--dark);
      margin-top: 20px;
      padding-top: 20px;
      border-top: 2px solid var(--light);
    }

    .summary-total-price {
      color: var(--primary);
    }

    .summary-actions {
      margin-top: 30px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .summary-actions .btn {
      width: 100%;
      justify-content: center;
    }

    .clear-cart {
      text-align: center;
      margin-top: 20px;
      padding-top: 20px;
      border-top: 1px solid var(--light);
    }

    .clear-cart a {
      color: var(--primary);
      font-size: 0.9rem;
      font-weight: 600;
    }

    .clear-cart a:hover {
      text-decoration: underline;
    }

    /* EMPTY CART */
    .empty-cart {
      text-align: center;
      padding: 60px 20px;
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
    }

    .empty-cart i {
      font-size: 5rem;
      color: var(--gray-light);
      margin-bottom: 20px;
    }

    .empty-cart h3 {
      font-size: 1.5rem;
      font-weight: 800;
      margin-bottom: 10px;
    }

    .empty-cart p {
      color: var(--gray);
      margin-bottom: 30px;
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
    @media (max-width: 992px) {
      .menu {
        display: none;
      }
      
      .cart-container {
        grid-template-columns: 1fr;
      }
      
      .cart-summary {
        position: static;
      }
      
      .footer-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .cart-header {
        display: none;
      }
      
      .cart-row {
        grid-template-columns: 1fr;
        gap: 15px;
        position: relative;
      }
      
      .cart-product {
        grid-column: 1 / -1;
      }
      
      .cart-price, .cart-quantity, .cart-subtotal {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 95px;
      }
      
      .cart-price::before {
        content: "Harga: ";
        font-weight: 600;
        color: var(--gray);
      }
      
      .cart-quantity::before {
        content: "Jumlah: ";
        font-weight: 600;
        color: var(--gray);
      }
      
      .cart-subtotal::before {
        content: "Subtotal: ";
        font-weight: 600;
        color: var(--gray);
      }
      
      .cart-remove {
        position: absolute;
        top: 20px;
        right: 20px;
      }
    }

    @media (max-width: 576px) {
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
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('shop') }}">Shop</a>
        <a href="{{ route('products.index') }}">Products</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('contact') }}">Contact</a>
      </nav>
      
      <div class="nav-actions">
        <div class="nav-icons">
          <i class="fa-solid fa-magnifying-glass"></i>
          <a href="{{ route('login') }}" style="color: inherit;">
            <div style="position: relative;">
              <i class="fa-regular fa-user"></i>
            </div>
          </a>
          <a href="{{ route('user.cart') }}" style="color: inherit;">
            <div style="position: relative;">
              <i class="fa-solid fa-cart-shopping"></i>
              <span class="cart-count">3</span>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="cart-hero">
  <div class="container">
    <h1>Keranjang Belanja</h1>
    <p>Review dan checkout produk pilihanmu</p>
  </div>
</section>

<section class="cart-section">
  <div class="container">
    
    <!-- Jika keranjang kosong (tampilkan ini) -->
    <!-- 
    <div class="empty-cart">
      <i class="fa-solid fa-cart-shopping"></i>
      <h3>Keranjang Belanjamu Kosong</h3>
      <p>Yuk, isi dengan produk-produk favoritmu!</p>
      <a href="{{ route('products.index') }}" class="btn">
        <i class="fa-solid fa-shop"></i>
        Mulai Belanja
      </a>
    </div>
    -->
    
    <!-- Jika keranjang ada isi (tampilkan ini) -->
    <div class="cart-container">
      
      <!-- Daftar Produk di Keranjang -->
      <div class="cart-items">
        <div class="cart-header">
          <div>Produk</div>
          <div>Harga</div>
          <div>Jumlah</div>
          <div>Subtotal</div>
          <div></div>
        </div>
        
        <!-- Cart Item 1 -->
        <div class="cart-row">
          <div class="cart-product">
            <div class="cart-product-image">
              <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800" alt="Nike Air Max">
            </div>
            <div class="cart-product-info">
              <h3>Nike Air Max 270 React</h3>
              <p>Running Shoes • Hitam/Merah</p>
              <p>Size: 42</p>
            </div>
          </div>
          <div class="cart-price">Rp 1.299.000</div>
          <div class="cart-quantity">
            <button class="quantity-btn" onclick="decrementQty(this)">-</button>
            <input type="text" class="quantity-input" value="1" readonly>
            <button class="quantity-btn" onclick="incrementQty(this)">+</button>
          </div>
          <div class="cart-subtotal">Rp 1.299.000</div>
          <div class="cart-remove" onclick="removeItem(this)">
            <i class="fa-solid fa-trash-can"></i>
          </div>
        </div>
        
        <!-- Cart Item 2 -->
        <div class="cart-row">
          <div class="cart-product">
            <div class="cart-product-image">
              <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?q=80&w=800" alt="Adidas Ultraboost">
            </div>
            <div class="cart-product-info">
              <h3>Adidas Ultraboost 22</h3>
              <p>Lifestyle • Putih/Hitam</p>
              <p>Size: 43</p>
            </div>
          </div>
          <div class="cart-price">Rp 1.499.000</div>
          <div class="cart-quantity">
            <button class="quantity-btn" onclick="decrementQty(this)">-</button>
            <input type="text" class="quantity-input" value="1" readonly>
            <button class="quantity-btn" onclick="incrementQty(this)">+</button>
          </div>
          <div class="cart-subtotal">Rp 1.499.000</div>
          <div class="cart-remove" onclick="removeItem(this)">
            <i class="fa-solid fa-trash-can"></i>
          </div>
        </div>
        
        <!-- Cart Item 3 -->
        <div class="cart-row">
          <div class="cart-product">
            <div class="cart-product-image">
              <img src="https://images.unsplash.com/photo-1597045566677-8cf032ed6634?q=80&w=800" alt="Converse Chuck Taylor">
            </div>
            <div class="cart-product-info">
              <h3>Converse Chuck Taylor All Star</h3>
              <p>Casual • Hitam</p>
              <p>Size: 40</p>
            </div>
          </div>
          <div class="cart-price">Rp 699.000</div>
          <div class="cart-quantity">
            <button class="quantity-btn" onclick="decrementQty(this)">-</button>
            <input type="text" class="quantity-input" value="2" readonly>
            <button class="quantity-btn" onclick="incrementQty(this)">+</button>
          </div>
          <div class="cart-subtotal">Rp 1.398.000</div>
          <div class="cart-remove" onclick="removeItem(this)">
            <i class="fa-solid fa-trash-can"></i>
          </div>
        </div>
        
        <!-- Cart Item 4 -->
        <div class="cart-row">
          <div class="cart-product">
            <div class="cart-product-image">
              <img src="https://images.unsplash.com/photo-1605348532760-6753d2c43329?q=80&w=800" alt="New Balance">
            </div>
            <div class="cart-product-info">
              <h3>New Balance 574 Core</h3>
              <p>Casual • Abu-abu</p>
              <p>Size: 41</p>
            </div>
          </div>
          <div class="cart-price">Rp 1.099.000</div>
          <div class="cart-quantity">
            <button class="quantity-btn" onclick="decrementQty(this)">-</button>
            <input type="text" class="quantity-input" value="1" readonly>
            <button class="quantity-btn" onclick="incrementQty(this)">+</button>
          </div>
          <div class="cart-subtotal">Rp 1.099.000</div>
          <div class="cart-remove" onclick="removeItem(this)">
            <i class="fa-solid fa-trash-can"></i>
          </div>
        </div>
        
      </div>
      
      <!-- Ringkasan Belanja -->
      <div class="cart-summary">
        <h3 class="summary-title">Ringkasan Belanja</h3>
        
        <div class="summary-row">
          <span>Total Harga (4 produk)</span>
          <span>Rp 5.295.000</span>
        </div>
        
        <div class="summary-row">
          <span>Biaya Pengiriman</span>
          <span>Rp 50.000</span>
        </div>
        
        <div class="summary-row">
          <span>Biaya Layanan</span>
          <span>Rp 5.000</span>
        </div>
        
        <div class="summary-row total">
          <span>Total Pembayaran</span>
          <span class="summary-total-price">Rp 5.350.000</span>
        </div>
        
        <div class="summary-actions">
          <a href="{{ route('checkout') }}" class="btn">
            <i class="fa-solid fa-credit-card"></i>
            Checkout
          </a>
          
          <a href="{{ route('products.index') }}" class="btn-secondary" style="text-align: center;">
            <i class="fa-solid fa-arrow-left"></i>
            Continue Shopping
          </a>
        </div>
        
        <div class="clear-cart">
          <a href="#" onclick="clearCart()">
            <i class="fa-regular fa-trash-can"></i>
            Kosongkan Keranjang
          </a>
        </div>
      </div>
      
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
  // Fungsi untuk menambah quantity
  function incrementQty(btn) {
    const input = btn.parentElement.querySelector('.quantity-input');
    let value = parseInt(input.value);
    input.value = value + 1;
    updateSubtotal(btn);
    updateSummary();
  }
  
  // Fungsi untuk mengurangi quantity
  function decrementQty(btn) {
    const input = btn.parentElement.querySelector('.quantity-input');
    let value = parseInt(input.value);
    if (value > 1) {
      input.value = value - 1;
      updateSubtotal(btn);
      updateSummary();
    }
  }
  
  // Fungsi untuk update subtotal per item
  function updateSubtotal(element) {
    const row = element.closest('.cart-row');
    const priceText = row.querySelector('.cart-price').innerText;
    const price = parseInt(priceText.replace(/[^0-9]/g, ''));
    const qty = parseInt(row.querySelector('.quantity-input').value);
    const subtotal = price * qty;
    row.querySelector('.cart-subtotal').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
  }
  
  // Fungsi untuk menghapus item
  function removeItem(element) {
    if (confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
      const row = element.closest('.cart-row');
      row.remove();
      updateSummary();
      
      // Cek apakah keranjang kosong
      const cartRows = document.querySelectorAll('.cart-row');
      if (cartRows.length === 0) {
        location.reload(); // Refresh untuk menampilkan empty cart
      }
    }
  }
  
  // Fungsi untuk mengosongkan semua keranjang
  function clearCart() {
    if (confirm('Apakah Anda yakin ingin mengosongkan seluruh keranjang belanja?')) {
      location.reload(); // Refresh untuk menampilkan empty cart
    }
  }
  
  // Fungsi untuk update ringkasan belanja
  function updateSummary() {
    const subtotals = document.querySelectorAll('.cart-subtotal');
    let total = 0;
    
    subtotals.forEach(item => {
      const subtotalText = item.innerText;
      const subtotal = parseInt(subtotalText.replace(/[^0-9]/g, ''));
      total += subtotal;
    });
    
    // Update total harga
    const totalElement = document.querySelector('.summary-row:first-child span:last-child');
    if (totalElement) {
      totalElement.innerText = 'Rp ' + total.toLocaleString('id-ID');
    }
    
    // Update total pembayaran (total + ongkir + layanan)
    const finalTotal = total + 50000 + 5000;
    const finalTotalElement = document.querySelector('.summary-total-price');
    if (finalTotalElement) {
      finalTotalElement.innerText = 'Rp ' + finalTotal.toLocaleString('id-ID');
    }
    
    // Update jumlah produk
    const cartRows = document.querySelectorAll('.cart-row');
    const productCountElement = document.querySelector('.summary-row:first-child span:first-child');
    if (productCountElement) {
      productCountElement.innerText = `Total Harga (${cartRows.length} produk)`;
    }
  }
  
  // Inisialisasi
  document.addEventListener('DOMContentLoaded', function() {
    updateSummary();
  });
</script>

</body>
</html>