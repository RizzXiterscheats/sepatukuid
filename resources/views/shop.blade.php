<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sepatukuid - Shop</title>

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
      padding: 16px 36px;
      border: none;
      font-weight: 700;
      cursor: pointer;
      border-radius: 50px;
      transition: var(--transition);
      display: inline-flex;
      align-items: center;
      gap: 12px;
      font-size: 16px;
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

    /* NAVBAR */
    header {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(20px);
      position: sticky;
      top: 0;
      width: 100%;
      z-index: 1000;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08);
      padding: 18px 0;
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
      gap: 15px;
      font-weight: 900;
      color: var(--primary);
      font-size: 1.8rem;
      letter-spacing: -0.5px;
    }

    .logo i {
      font-size: 2.2rem;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .menu {
      display: flex;
      gap: 45px;
      font-weight: 600;
    }

    .menu a {
      position: relative;
      padding: 10px 0;
      font-size: 1.1rem;
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
      gap: 30px;
    }

    .nav-icons {
      display: flex;
      gap: 25px;
      font-size: 1.3rem;
    }

    .nav-icons i {
      cursor: pointer;
      padding: 12px;
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
      font-size: 0.8rem;
      min-width: 20px;
      height: 20px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      box-shadow: 0 3px 10px rgba(229, 57, 53, 0.3);
    }

    /* SHOP HERO */
    .shop-hero {
      padding: 140px 0 80px;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .shop-hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 70%;
      height: 200%;
      background: radial-gradient(circle, rgba(229, 57, 53, 0.05) 0%, transparent 70%);
      transform: rotate(30deg);
    }

    .shop-hero h1 {
      font-size: 4rem;
      font-weight: 900;
      margin-bottom: 20px;
      background: linear-gradient(45deg, var(--dark), var(--gray-dark), var(--primary));
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -1px;
    }

    .shop-hero p {
      font-size: 1.3rem;
      color: var(--gray);
      max-width: 700px;
      margin: 0 auto 40px;
      line-height: 1.8;
    }

    /* SHOP BANNER */
    .shop-banner {
      padding: 60px 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      position: relative;
      overflow: hidden;
    }

    .shop-banner::before {
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

    .banner-content h2 {
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 20px;
    }

    .banner-content p {
      font-size: 1.2rem;
      max-width: 600px;
      margin: 0 auto 30px;
      opacity: 0.95;
    }

    .banner-stats {
      display: flex;
      justify-content: center;
      gap: 50px;
      margin-top: 40px;
    }

    .banner-stat-item {
      text-align: center;
    }

    .banner-stat-number {
      font-size: 2rem;
      font-weight: 900;
      margin-bottom: 5px;
    }

    .banner-stat-label {
      font-size: 1rem;
      opacity: 0.9;
    }

    /* CATEGORIES SECTION */
    .categories-section {
      padding: 80px 0;
      background: white;
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
      background-clip: text;
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
      font-size: 1.2rem;
      max-width: 700px;
      margin: 20px auto 0;
      line-height: 1.8;
    }

    .categories-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
    }

    .category-card {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      height: 300px;
      cursor: pointer;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
    }

    .category-card:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: var(--card-shadow-hover);
    }

    .category-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .category-card:hover img {
      transform: scale(1.1);
    }

    .category-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 30px;
      color: white;
    }

    .category-overlay h3 {
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 10px;
    }

    .category-overlay p {
      font-size: 1.1rem;
      opacity: 0.9;
      margin-bottom: 20px;
    }

    .category-link {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      color: white;
      font-weight: 600;
      transition: var(--transition);
    }

    .category-link:hover {
      gap: 15px;
      color: var(--primary);
    }

    /* FEATURED COLLECTIONS */
    .featured-section {
      padding: 80px 0;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
    }

    .collections-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
    }

    .collection-card {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      height: 400px;
      cursor: pointer;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
    }

    .collection-card:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: var(--card-shadow-hover);
    }

    .collection-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .collection-card:hover img {
      transform: scale(1.1);
    }

    .collection-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg, rgba(229,57,53,0.3), rgba(0,0,0,0.7));
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
      padding: 30px;
    }

    .collection-overlay h3 {
      font-size: 2.5rem;
      font-weight: 900;
      margin-bottom: 15px;
    }

    .collection-overlay p {
      font-size: 1.2rem;
      margin-bottom: 25px;
      max-width: 400px;
    }

    .collection-badge {
      position: absolute;
      top: 30px;
      right: 30px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      padding: 10px 20px;
      border-radius: 50px;
      font-weight: 700;
      font-size: 1rem;
      z-index: 2;
    }

    /* BRANDS SECTION */
    .brands-section {
      padding: 60px 0;
      background: white;
    }

    .brands-grid {
      display: grid;
      grid-template-columns: repeat(6, 1fr);
      gap: 30px;
      align-items: center;
    }

    .brand-item {
      text-align: center;
      padding: 20px;
      background: var(--light);
      border-radius: 15px;
      transition: var(--transition);
      cursor: pointer;
    }

    .brand-item:hover {
      transform: translateY(-5px);
      box-shadow: var(--card-shadow);
    }

    .brand-item i {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 10px;
    }

    .brand-item h4 {
      font-size: 1.1rem;
      font-weight: 700;
    }

    /* FEATURES SHOP */
    .shop-features {
      padding: 80px 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      position: relative;
    }

    .shop-features::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?q=80&w=1200') center/cover;
      opacity: 0.1;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
      position: relative;
      z-index: 2;
    }

    .feature-item {
      text-align: center;
      padding: 40px 30px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      transition: var(--transition);
    }

    .feature-item:hover {
      transform: translateY(-10px);
      background: rgba(255, 255, 255, 0.2);
    }

    .feature-icon {
      width: 80px;
      height: 80px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 2rem;
    }

    .feature-item h3 {
      font-size: 1.3rem;
      margin-bottom: 10px;
    }

    .feature-item p {
      opacity: 0.9;
      font-size: 0.95rem;
    }

    /* NEWSLETTER */
    .newsletter-section {
      padding: 80px 0;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
    }

    .newsletter-box {
      max-width: 600px;
      margin: 0 auto;
      text-align: center;
      padding: 60px;
      background: white;
      border-radius: 30px;
      box-shadow: var(--card-shadow);
    }

    .newsletter-box h3 {
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 15px;
    }

    .newsletter-box p {
      color: var(--gray);
      margin-bottom: 30px;
    }

    .newsletter-form {
      display: flex;
      gap: 10px;
    }

    .newsletter-form input {
      flex: 1;
      padding: 16px 20px;
      border: 2px solid var(--light);
      border-radius: 50px;
      font-size: 1rem;
      transition: var(--transition);
    }

    .newsletter-form input:focus {
      outline: none;
      border-color: var(--primary);
    }

    .newsletter-form button {
      padding: 16px 30px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      border: none;
      border-radius: 50px;
      font-weight: 700;
      cursor: pointer;
      transition: var(--transition);
    }

    .newsletter-form button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(229,57,53,0.3);
    }

    /* FOOTER */
    footer {
      background: linear-gradient(135deg, var(--dark) 0%, #000000 100%);
      color: #ccc;
      padding: 80px 0 30px;
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
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 50px;
      margin-bottom: 50px;
    }

    .footer-column h4 {
      color: white;
      font-size: 1.3rem;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 15px;
      font-weight: 800;
    }

    .footer-column h4::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 15px;
    }

    .footer-links a {
      color: #aaa;
      transition: var(--transition);
      font-size: 1rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .footer-links a:hover {
      color: white;
      padding-left: 10px;
    }

    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 25px;
    }

    .social-links a {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: var(--transition);
      font-size: 1.2rem;
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
      .brands-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 992px) {
      .menu {
        display: none;
      }
      
      .shop-hero h1 {
        font-size: 3rem;
      }
      
      .categories-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .collections-grid {
        grid-template-columns: 1fr;
      }
      
      .features-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .shop-hero {
        padding: 120px 0 60px;
      }
      
      .shop-hero h1 {
        font-size: 2.5rem;
      }
      
      .banner-stats {
        flex-direction: column;
        gap: 20px;
      }
      
      .brands-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .newsletter-form {
        flex-direction: column;
      }
    }

    @media (max-width: 576px) {
      .shop-hero h1 {
        font-size: 2rem;
      }
      
      .categories-grid {
        grid-template-columns: 1fr;
      }
      
      .features-grid {
        grid-template-columns: 1fr;
      }
      
      .newsletter-box {
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>

<header>
  <div class="container">
    <div class="nav">
      <a href="/" class="logo">
        <i class="fa-solid fa-shoe-prints"></i>
        SEPATUKUID
      </a>
      
      <nav class="menu">
        <a href="/">Home</a>
        <a href="/shop" class="active">Shop</a>
        <a href="/products">Products</a>
        <a href="/about">About Us</a>
        <a href="/contact">Contact</a>
      </nav>
      
      <div class="nav-actions">
        <div class="nav-icons">
          <i class="fa-solid fa-magnifying-glass"></i>
          <div style="position: relative;">
            <i class="fa-regular fa-user"></i>
          </div>
          <div style="position: relative;">
            <a href="/cart" style="color: inherit;">
              <i class="fa-solid fa-cart-shopping"></i>
              <span class="cart-count">3</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="shop-hero">
  <div class="container">
    <h1>Shopping Experience</h1>
    <p>Temukan berbagai koleksi sneakers premium dari brand-brand ternama. Dengan pilihan terlengkap dan harga terbaik, belanja kebutuhan sneakersmu hanya di Sepatukuid.</p>
    <a href="#categories" class="btn">
      <i class="fa-solid fa-shop"></i>
      Mulai Belanja
    </a>
  </div>
</section>

<section class="shop-banner">
  <div class="container">
    <div class="banner-content">
      <h2>Special Offer for You!</h2>
      <p>Dapatkan diskon hingga 50% untuk pembelian pertama di Sepatukuid. Gratis ongkir ke seluruh Indonesia!</p>
      <a href="/products" class="btn btn-outline" style="color: white; border-color: white;">
        <i class="fa-solid fa-gift"></i>
        Claim Voucher
      </a>
      
      <div class="banner-stats">
        <div class="banner-stat-item">
          <div class="banner-stat-number">50+</div>
          <div class="banner-stat-label">Brand Ternama</div>
        </div>
        <div class="banner-stat-item">
          <div class="banner-stat-number">850+</div>
          <div class="banner-stat-label">Produk</div>
        </div>
        <div class="banner-stat-item">
          <div class="banner-stat-number">15K+</div>
          <div class="banner-stat-label">Pelanggan</div>
        </div>
        <div class="banner-stat-item">
          <div class="banner-stat-number">4.9★</div>
          <div class="banner-stat-label">Rating</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="categories-section" id="categories">
  <div class="container">
    <div class="section-title">
      <h2>Shop by Categories</h2>
      <p>Jelajahi koleksi sneakers berdasarkan kategori yang kamu sukai</p>
    </div>
    
    <div class="categories-grid">
      <div class="category-card">
        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800" alt="Running Shoes">
        <div class="category-overlay">
          <h3>Running</h3>
          <p>Performance terbaik untuk lari</p>
          <a href="/products?category=running" class="category-link">
            Shop Now <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
      
      <div class="category-card">
        <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?q=80&w=800" alt="Lifestyle">
        <div class="category-overlay">
          <h3>Lifestyle</h3>
          <p>Gaya sehari-hari yang stylish</p>
          <a href="/products?category=lifestyle" class="category-link">
            Shop Now <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
      
      <div class="category-card">
        <img src="https://images.unsplash.com/photo-1597045566677-8cf032ed6634?q=80&w=800" alt="Casual">
        <div class="category-overlay">
          <h3>Casual</h3>
          <p>Santai dan nyaman dipakai</p>
          <a href="/products?category=casual" class="category-link">
            Shop Now <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
      
      <div class="category-card">
        <img src="https://images.unsplash.com/photo-1605348532760-6753d2c43329?q=80&w=800" alt="Sports">
        <div class="category-overlay">
          <h3>Sports</h3>
          <p>Aktivitas olahraga maksimal</p>
          <a href="/products?category=sports" class="category-link">
            Shop Now <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="featured-section">
  <div class="container">
    <div class="section-title">
      <h2>Featured Collections</h2>
      <p>Koleksi pilihan yang sedang tren saat ini</p>
    </div>
    
    <div class="collections-grid">
      <div class="collection-card">
        <span class="collection-badge">Limited Edition</span>
        <img src="https://images.unsplash.com/photo-1556909212-d5b604d0c90d?q=80&w=800" alt="Summer Collection">
        <div class="collection-overlay">
          <h3>Summer Vibes</h3>
          <p>Koleksi sneakers warna-warni untuk musim panas</p>
          <a href="/products?collection=summer" class="btn" style="background: white; color: var(--primary);">
            Explore
          </a>
        </div>
      </div>
      
      <div class="collection-card">
        <span class="collection-badge">New Arrival</span>
        <img src="https://images.unsplash.com/photo-1587563871167-f11eaf1b3fa4?q=80&w=800" alt="Urban Collection">
        <div class="collection-overlay">
          <h3>Urban Street</h3>
          <p>Tampil stylish dengan gaya urban masa kini</p>
          <a href="/products?collection=urban" class="btn" style="background: white; color: var(--primary);">
            Explore
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="brands-section">
  <div class="container">
    <div class="section-title">
      <h2>Top Brands</h2>
      <p>Brand-brand ternama yang tersedia di Sepatukuid</p>
    </div>
    
    <div class="brands-grid">
      <div class="brand-item">
        <i class="fa-brands fa-nike"></i>
        <h4>Nike</h4>
      </div>
      
      <div class="brand-item">
        <i class="fa-brands fa-adidas"></i>
        <h4>Adidas</h4>
      </div>
      
      <div class="brand-item">
        <i class="fa-brands fa-puma"></i>
        <h4>Puma</h4>
      </div>
      
      <div class="brand-item">
        <i class="fa-brands fa-new-balance"></i>
        <h4>New Balance</h4>
      </div>
      
      <div class="brand-item">
        <i class="fa-brands fa-converse"></i>
        <h4>Converse</h4>
      </div>
      
      <div class="brand-item">
        <i class="fa-brands fa-vans"></i>
        <h4>Vans</h4>
      </div>
    </div>
  </div>
</section>

<section class="shop-features">
  <div class="container">
    <div class="features-grid">
      <div class="feature-item">
        <div class="feature-icon">
          <i class="fa-solid fa-truck-fast"></i>
        </div>
        <h3>Free Shipping</h3>
        <p>Gratis ongkir untuk pembelian di atas Rp 500.000</p>
      </div>
      
      <div class="feature-item">
        <div class="feature-icon">
          <i class="fa-solid fa-shield-halved"></i>
        </div>
        <h3>100% Original</h3>
        <p>Garansi produk original atau uang kembali</p>
      </div>
      
      <div class="feature-item">
        <div class="feature-icon">
          <i class="fa-solid fa-rotate-left"></i>
        </div>
        <h3>Easy Return</h3>
        <p>Pengembalian barang dalam 30 hari</p>
      </div>
      
      <div class="feature-item">
        <div class="feature-icon">
          <i class="fa-solid fa-headset"></i>
        </div>
        <h3>24/7 Support</h3>
        <p>Customer service siap membantu</p>
      </div>
    </div>
  </div>
</section>

<section class="newsletter-section">
  <div class="container">
    <div class="newsletter-box">
      <h3>Subscribe Newsletter</h3>
      <p>Dapatkan informasi terbaru tentang produk dan promo spesial langsung ke emailmu</p>
      <form class="newsletter-form">
        <input type="email" placeholder="Masukkan email kamu" required>
        <button type="submit">
          <i class="fa-solid fa-paper-plane"></i>
          Subscribe
        </button>
      </form>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-column">
        <h4>Sepatukuid</h4>
        <p style="margin-bottom: 25px; font-size: 1rem; line-height: 1.7; color: #aaa;">
          Brand sneakers lokal dengan kualitas internasional. Komitmen kami memberikan pengalaman berbelanja terbaik dengan produk premium.
        </p>
        <div class="social-links">
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-tiktok"></i></a>
          <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
      
      <div class="footer-column">
        <h4>Shop</h4>
        <ul class="footer-links">
          <li><a href="/products?category=running"><i class="fa-solid fa-chevron-right"></i> Running</a></li>
          <li><a href="/products?category=lifestyle"><i class="fa-solid fa-chevron-right"></i> Lifestyle</a></li>
          <li><a href="/products?category=casual"><i class="fa-solid fa-chevron-right"></i> Casual</a></li>
          <li><a href="/products?category=sports"><i class="fa-solid fa-chevron-right"></i> Sports</a></li>
          <li><a href="/products?category=sale"><i class="fa-solid fa-chevron-right"></i> Sale</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Information</h4>
        <ul class="footer-links">
          <li><a href="/about"><i class="fa-solid fa-chevron-right"></i> About Us</a></li>
          <li><a href="/contact"><i class="fa-solid fa-chevron-right"></i> Contact</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Privacy Policy</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Terms & Conditions</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> FAQ</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Contact Us</h4>
        <p style="color: #aaa; margin-bottom: 15px;">
          <i class="fa-solid fa-envelope"></i> hello@sepatukuid.com<br>
          <i class="fa-solid fa-phone"></i> +62 812 3456 7890<br>
          <i class="fa-solid fa-location-dot"></i> Jakarta, Indonesia
        </p>
        <p style="color: #aaa;">
          <i class="fa-regular fa-clock"></i> Senin - Minggu<br>
          08:00 - 22:00 WIB
        </p>
      </div>
    </div>
    
    <div class="copyright">
      &copy; 2026 Sepatukuid. All rights reserved. | Designed for sneaker enthusiasts
    </div>
  </div>
</footer>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Category card hover effect
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-15px) scale(1.02)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
      });
    });
    
    // Collection card hover effect
    const collectionCards = document.querySelectorAll('.collection-card');
    collectionCards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-15px) scale(1.02)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
      });
    });
    
    // Brand item hover effect
    const brandItems = document.querySelectorAll('.brand-item');
    brandItems.forEach(item => {
      item.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
      });
      
      item.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
    
    // Newsletter form submission
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
      newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        if (email) {
          alert('Terima kasih telah berlangganan newsletter kami!');
          this.reset();
        }
      });
    }
  });
</script>
</body>
</html>