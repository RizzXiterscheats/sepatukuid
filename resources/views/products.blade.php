<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sepatukuid - Semua Produk</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

  <style>
    /* Hero Alignment */
    .products-hero {
      padding: 140px 0 80px;
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
      font-size: 4rem;
      font-weight: 900;
      margin-bottom: 20px;
      background: linear-gradient(45deg, var(--dark), var(--gray-dark), var(--primary));
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -1px;
    }

    .products-hero p {
      font-size: 1.3rem;
      color: var(--gray);
      max-width: 700px;
      margin: 0 auto 40px;
      line-height: 1.8;
    }

    /* BANNER STATS (Same as Shop) */
    .products-banner {
      padding: 60px 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      position: relative;
      overflow: hidden;
    }

    .products-banner::before {
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

    .banner-stats {
      display: flex;
      justify-content: center;
      gap: 50px;
      margin-top: 10px;
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

    /* FEATURES */
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

    /* NEWSLETTER */
    .newsletter-section {
      padding: 100px 0;
      background: white;
    }

    .newsletter-box {
      background: linear-gradient(135deg, var(--dark) 0%, #000000 100%);
      border-radius: 30px;
      padding: 80px 40px;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .newsletter-form {
      display: flex;
      max-width: 600px;
      margin: 40px auto 0;
      gap: 15px;
    }

    .newsletter-form input {
      flex: 1;
      padding: 20px 30px;
      border-radius: 50px;
      border: none;
      font-size: 1.1rem;
    }

    .newsletter-form button {
      padding: 20px 40px;
      border-radius: 50px;
      background: var(--primary);
      color: white;
      font-weight: 700;
      border: none;
      cursor: pointer;
      transition: var(--transition);
    }

    /* Product Grid Styling Override */
    .products-section {
      padding: 80px 0;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 35px;
    }

    .product-card {
      background: white;
      border-radius: 25px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      position: relative;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .product-card:hover {
      transform: translateY(-15px) scale(1.03);
      box-shadow: var(--card-shadow-hover);
    }

    .product-image {
      height: 280px;
      width: 100%;
      object-fit: cover;
    }

    .product-info {
      padding: 30px;
    }

    .btn-detail {
      display: inline-block;
      width: 100%;
      text-align: center;
      padding: 15px;
      background: var(--dark);
      color: white;
      border-radius: 50px;
      font-weight: 700;
      margin-top: 15px;
    }
  </style>
</head>

<body>

<x-navbar />

<section class="products-hero">
  <div class="container">
    <h1>All Sneakers</h1>
    <p>Koleksi lengkap dari brand ternama kelas dunia hanya untuk Anda.</p>
  </div>
</section>

<section class="products-banner">
  <div class="container">
    <div class="banner-content">
      <div class="banner-stats">
        <div class="banner-stat-item">
          <div class="banner-stat-number">{{ count($products) }}+</div>
          <div class="banner-stat-label">Produk Pilihan</div>
        </div>
        <div class="banner-stat-item">
          <div class="banner-stat-number">{{ count($categories) }}</div>
          <div class="banner-stat-label">Kategori Brand</div>
        </div>
        <div class="banner-stat-item">
          <div class="banner-stat-number">100%</div>
          <div class="banner-stat-label">Original Guaranteed</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="products-section">
  <div class="container">
    <div class="section-title">
      <h2>Featured Collection</h2>
      <p>Pilih dari ratusan model sneakers yang sesuai dengan gaya Anda.</p>
    </div>

    <div class="product-grid">
      @forelse($products as $product)
      <div class="product-card">
        @if($product->discount_price)
          <span class="product-badge" style="position: absolute; top: 20px; left: 20px; background: var(--primary); color: white; padding: 10px 20px; border-radius: 50px; font-weight: 800; z-index: 2;">SALE</span>
        @elseif($product->is_featured)
          <span class="product-badge" style="position: absolute; top: 20px; left: 20px; background: var(--secondary); color: white; padding: 10px 20px; border-radius: 50px; font-weight: 800; z-index: 2;">FEATURED</span>
        @endif
        
        <a href="{{ route('products.show', $product->slug) }}">
          <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800' }}" class="product-image" alt="{{ $product->name }}">
        </a>
        
        <div class="product-info">
          <div class="product-category" style="color: var(--gray-light); text-transform: uppercase; font-size: 0.9rem; font-weight: 600; margin-bottom: 10px;">
            {{ $product->categoryModel->name ?? $product->category ?? 'Sneakers' }}
          </div>
          <h3 class="product-title" style="font-size: 1.5rem; font-weight: 800; margin-bottom: 15px; min-height: 65px;">{{ $product->name }}</h3>
          
          <div class="product-price" style="font-size: 1.6rem; font-weight: 900; color: var(--primary); display: flex; align-items: center; gap: 15px;">
            @if($product->discount_price)
              Rp {{ number_format($product->discount_price, 0, ',', '.') }}
              <span style="font-size: 1rem; color: var(--gray-light); text-decoration: line-through; font-weight: 600;">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            @else
              Rp {{ number_format($product->price, 0, ',', '.') }}
            @endif
          </div>

          <a href="{{ route('products.show', $product->slug) }}" class="btn-detail">
            Lihat Detail
          </a>
        </div>
      </div>
      @empty
        <div style="grid-column: span 4; text-align: center; padding: 50px;">
          <p>Belum ada produk untuk ditampilkan.</p>
        </div>
      @endforelse
    </div>

    <div class="pagination" style="margin-top: 50px; display: flex; justify-content: center;">
      {{ $products->links() }}
    </div>
  </div>
</section>

<section class="brands-section">
  <div class="container">
    <div class="section-title">
      <h2>Our Premium Brands</h2>
      <p>Bekerjasama dengan brand terbaik untuk kualitas maksimal.</p>
    </div>
    <div class="brands-grid">
      <div class="brand-item"><i class="fa-brands fa-nike"></i><h4>Nike</h4></div>
      <div class="brand-item"><i class="fa-brands fa-adidas"></i><h4>Adidas</h4></div>
      <div class="brand-item"><i class="fa-brands fa-puma"></i><h4>Puma</h4></div>
      <div class="brand-item"><i class="fa-brands fa-new-balance"></i><h4>New Balance</h4></div>
      <div class="brand-item"><i class="fa-brands fa-converse"></i><h4>Converse</h4></div>
      <div class="brand-item"><i class="fa-brands fa-vans"></i><h4>Vans</h4></div>
    </div>
  </div>
</section>

<section class="shop-features">
  <div class="container">
    <div class="features-grid">
      <div class="feature-item">
        <i class="fa-solid fa-truck-fast" style="font-size: 2.5rem; margin-bottom: 20px;"></i>
        <h3>Free Shipping</h3>
        <p>Gratis ongkir ke seluruh Indonesia.</p>
      </div>
      <div class="feature-item">
        <i class="fa-solid fa-shield-halved" style="font-size: 2.5rem; margin-bottom: 20px;"></i>
        <h3>100% Original</h3>
        <p>Garansi keaslian produk atau uang kembali.</p>
      </div>
      <div class="feature-item">
        <i class="fa-solid fa-rotate-left" style="font-size: 2.5rem; margin-bottom: 20px;"></i>
        <h3>Easy Return</h3>
        <p>Pengembalian barang dalam 30 hari.</p>
      </div>
      <div class="feature-item">
        <i class="fa-solid fa-headset" style="font-size: 2.5rem; margin-bottom: 20px;"></i>
        <h3>24/7 Support</h3>
        <p>Layanan bantuan kapanpun Anda butuhkan.</p>
      </div>
    </div>
  </div>
</section>

<section class="newsletter-section">
  <div class="container">
    <div class="newsletter-box">
      <h2 style="font-size: 3rem; font-weight: 900; margin-bottom: 20px;">Join The Squad</h2>
      <p style="font-size: 1.2rem; opacity: 0.9;">Dapatkan update produk terbaru dan promo eksklusif.</p>
      <form class="newsletter-form">
        <input type="email" placeholder="Email Address" required>
        <button type="submit">Subscribe</button>
      </form>
    </div>
  </div>
</section>

<x-footer />

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Hover Animation Logic
    const hoverElements = document.querySelectorAll('.product-card, .brand-item, .feature-item');
    hoverElements.forEach(el => {
      el.addEventListener('mouseenter', () => el.style.boxShadow = 'var(--card-shadow-hover)');
      el.addEventListener('mouseleave', () => el.style.boxShadow = 'var(--card-shadow)');
    });
  });
</script>

</body>
</html>