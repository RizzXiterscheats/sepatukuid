  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
</head>

<body>

<x-navbar />
<section class="shop-hero">
  <div class="container">
    <h1>Koleksi Sneakers Premium</h1>
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
      <h2>Penawaran Khusus Untuk Anda!</h2>
      <p>Dapatkan diskon hingga 50% untuk pembelian pertama di Sepatukuid. Gratis ongkir ke seluruh Indonesia!</p>
      <a href="/products" class="btn btn-outline" style="color: white; border-color: white;">
        <i class="fa-solid fa-gift"></i>
        Ambil Voucher
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
      <h2>Pilihan Kategori</h2>
      <p>Jelajahi koleksi sneakers berdasarkan kategori yang kamu sukai</p>
    </div>
    
    <div class="categories-grid">
      @foreach($categories as $category)
      <div class="category-card" onclick="window.location.href='{{ route('shop', ['category' => $category->slug]) }}'">
        <img src="{{ $category->image ? (str_starts_with($category->image, 'http') ? $category->image : asset('storage/' . $category->image)) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600' }}" alt="{{ $category->name }}" loading="lazy">
        <div class="category-overlay">
          <h3>{{ $category->name }}</h3>
          <p>{{ $category->description ?? 'Koleksi ' . $category->name }}</p>
          <a href="{{ route('shop', ['category' => $category->slug]) }}" class="category-link">
            Belanja Sekarang <i class="fa-solid fa-arrow-right"></i>
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
      <h2>Semua Produk</h2>
      <p>Temukan koleksi lengkap sneakers kami</p>
    </div>

    <div class="search-filter">
      <form action="{{ route('shop') }}" method="GET" class="filter-form">
        <div class="filter-group">
          <label>Cari Produk</label>
          <input type="text" name="search" class="filter-input" placeholder="Apa yang Anda cari hari ini?" value="{{ request('search') }}">
        </div>

        <div class="filter-group">
          <label>Kategori</label>
          <select name="category" class="filter-input">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="filter-group">
          <label>Gender</label>
          <select name="gender" class="filter-input">
            <option value="">Semua Gender</option>
            <option value="pria" {{ request('gender') == 'pria' ? 'selected' : '' }}>Pria</option>
            <option value="wanita" {{ request('gender') == 'wanita' ? 'selected' : '' }}>Wanita</option>
            <option value="unisex" {{ request('gender') == 'unisex' ? 'selected' : '' }}>Unisex</option>
          </select>
        </div>

        <button type="submit" class="btn-filter">
          <i class="fa-solid fa-sliders"></i> Filter
        </button>
      </form>
    </div>

    <div class="product-grid">
      @forelse($products as $product)
      <div class="product-card">
        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600' }}" class="product-image" alt="{{ $product->name }}" loading="lazy">
        <div class="product-info">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <div class="product-category">{{ $product->categoryModel->name ?? $product->category ?? 'Sneakers' }}</div>
            <div class="product-sold">
              <i class="fa-solid fa-fire"></i> Terjual {{ $product->total_sold ?? 0 }}
            </div>
          </div>
          <h3 class="product-title">{{ $product->name }}</h3>
          <div class="product-price">
            @if($product->discount_price)
              Rp {{ number_format($product->discount_price, 0, ',', '.') }}
              <span class="old-price" style="font-size: 0.9rem; color: var(--gray-light); text-decoration: line-through; margin-left: 10px; font-weight: 500;">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            @else
              Rp {{ number_format($product->price, 0, ',', '.') }}
            @endif
          </div>
          <div class="product-stock" style="font-size: 0.85rem; color: var(--gray); margin-bottom: 15px; font-weight: 600;">
            <i class="fa-solid fa-box-open" style="font-size: 0.8rem; margin-right: 5px; opacity: 0.7;"></i> Stok: {{ $product->stock }}
          </div>
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
      <h2>Koleksi Unggulan</h2>
      <p>Koleksi pilihan yang sedang tren saat ini</p>
    </div>
    
    <div class="collections-grid">
      <div class="collection-card">
        <span class="collection-badge">Edisi Terbatas</span>
        <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=800" alt="Summer Collection">
        <div class="collection-overlay">
          <h3>Summer Vibes</h3>
          <p>Koleksi sneakers warna-warni untuk musim panas</p>
          <a href="/products?collection=summer" class="btn" style="background: white; color: var(--primary);">
            Jelajahi
          </a>
        </div>
      </div>
      
      <div class="collection-card">
        <span class="collection-badge">Produk Terbaru</span>
        <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=800" alt="Urban Collection">
        <div class="collection-overlay">
          <h3>Urban Street</h3>
          <p>Tampil stylish dengan gaya urban masa kini</p>
          <a href="/products?collection=urban" class="btn" style="background: white; color: var(--primary);">
            Jelajahi
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
        <img src="{{ asset('img/brands/nike.png') }}" alt="Nike">
        <h4>Nike</h4>
      </div>
      
      <div class="brand-item">
        <img src="{{ asset('img/brands/adidas.png') }}" alt="Adidas">
        <h4>Adidas</h4>
      </div>
      
      <div class="brand-item">
        <img src="{{ asset('img/brands/puma.png') }}" alt="Puma">
        <h4>Puma</h4>
      </div>
      
      <div class="brand-item">
        <img src="{{ asset('img/brands/new-balance.png') }}" alt="New Balance">
        <h4>New Balance</h4>
      </div>
      
      <div class="brand-item">
        <img src="{{ asset('img/brands/converse.png') }}" alt="Converse">
        <h4>Converse</h4>
      </div>
      
      <div class="brand-item">
        <img src="{{ asset('img/brands/vans.png') }}" alt="Vans">
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
      <h3>Informasi Langganan</h3>
      <p>Dapatkan informasi terbaru tentang produk dan promo spesial langsung ke emailmu</p>
      <form class="newsletter-form">
        <input type="email" placeholder="Masukkan email kamu" required>
        <button type="submit">
          <i class="fa-solid fa-paper-plane"></i>
          Daftar
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
          alert('Terima kasih telah berlangganan dengan kami!');
          this.reset();
        }
      });
    }
  });
</script>
</body>
</html>