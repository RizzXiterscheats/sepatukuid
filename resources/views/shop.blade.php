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

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

  <style>
    /* Shop Specific Styles */
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

    /* PRODUCT GRID */
    .product-section {
      padding: 80px 0;
      background: #f8f9fa;
    }
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }
    .product-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      border: 1px solid rgba(0,0,0,0.05);
    }
    .product-card:hover {
      transform: translateY(-10px);
      box-shadow: var(--card-shadow-hover);
    }
    .product-image {
      height: 250px;
      width: 100%;
      object-fit: cover;
    }
    .product-info {
      padding: 25px;
    }
    .product-category {
      font-size: 0.9rem;
      color: var(--gray-light);
      margin-bottom: 8px;
      text-transform: uppercase;
      font-weight: 600;
    }
    .product-title {
      font-size: 1.4rem;
      font-weight: 800;
      margin-bottom: 12px;
      color: var(--dark);
    }
    .product-price {
      font-size: 1.5rem;
      font-weight: 900;
      color: var(--primary);
      margin-bottom: 20px;
    }
    .pagination {
      margin-top: 50px;
      display: flex;
      justify-content: center;
      gap: 10px;
    }
    .pagination .page-link {
      padding: 10px 20px;
      border-radius: 10px;
      background: white;
      border: 1px solid #ddd;
      color: var(--dark);
      font-weight: 600;
    }
    .pagination .page-link.active {
      background: var(--primary);
      color: white;
      border-color: var(--primary);
    }
    
    .search-filter {
      margin-bottom: 40px;
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }
    .search-filter input {
      flex: 1;
      min-width: 250px;
      padding: 15px 25px;
      border-radius: 50px;
      border: 1px solid #ddd;
    }
    .search-filter button {
      padding: 10px 30px;
      border-radius: 50px;
      background: var(--dark);
      color: white;
      font-weight: 700;
      border: none;
      cursor: pointer;
    }
  </style>
</head>

<body>

<x-navbar />
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
      @foreach($categories as $category)
      <div class="category-card" onclick="window.location.href='{{ route('shop', ['category' => $category->slug]) }}'">
        <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800' }}" alt="{{ $category->name }}">
        <div class="category-overlay">
          <h3>{{ $category->name }}</h3>
          <p>{{ $category->description ?? 'Koleksi ' . $category->name }}</p>
          <a href="{{ route('shop', ['category' => $category->slug]) }}" class="category-link">
            Shop Now <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="product-section" id="products">
  <div class="container">
    <div class="section-title">
      <h2>All Products</h2>
      <p>Temukan koleksi lengkap sneakers kami</p>
    </div>

    <div class="search-filter">
      <form action="{{ route('shop') }}" method="GET" style="display: flex; width: 100%; gap: 15px; flex-wrap: wrap;">
        <input type="text" name="search" placeholder="Cari sneakers..." value="{{ request('search') }}" style="flex: 1; min-width: 250px; padding: 15px 25px; border-radius: 50px; border: 1px solid #ddd;">
        <select name="category" style="padding: 15px 25px; border-radius: 50px; border: 1px solid #ddd;">
          <option value="">Semua Kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
        <button type="submit" style="padding: 10px 30px; border-radius: 50px; background: var(--dark); color: white; font-weight: 700; border: none; cursor: pointer;">Filter</button>
      </form>
    </div>

    <div class="product-grid">
      @forelse($products as $product)
      <div class="product-card">
        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800' }}" class="product-image" alt="{{ $product->name }}">
        <div class="product-info">
          <div class="product-category">{{ $product->categoryModel->name ?? $product->category ?? 'Sneakers' }}</div>
          <h3 class="product-title">{{ $product->name }}</h3>
          <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
          <a href="{{ route('products.show', $product->slug) }}" class="btn" style="width: 100%;">Lihat Detail</a>
        </div>
      </div>
      @empty
        <div style="grid-column: span 3; text-align: center; padding: 50px;">
          <p>Produk tidak ditemukan.</p>
        </div>
      @endforelse
    </div>

    <div class="pagination" style="margin-top: 50px; display: flex; justify-content: center; gap: 10px;">
      {{ $products->appends(request()->query())->links() }}
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

<x-footer />
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