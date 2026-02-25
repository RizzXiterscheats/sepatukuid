<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $product->name }} - Sepatukuid</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

  <style>
    :root {
      --primary: #E50914; /* Red theme */
      --primary-dark: #b20710;
      --dark: #141414;
      --light: #f5f5f7;
      --gray: #86868b;
      --border: #d2d2d7;
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #fff; color: var(--dark); line-height: 1.5; }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    a { text-decoration: none; color: inherit; }

    /* Detailed Layout Improvements */
    .detail-container {
      max-width: 1200px;
      margin: 120px auto 80px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      padding: 0 20px;
    }

    .back-nav {
      margin-bottom: 30px;
      grid-column: 1 / -1;
    }

    .btn-back-shop {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      color: var(--gray);
      font-weight: 600;
      font-size: 0.95rem;
      transition: var(--transition);
      padding: 10px 0;
    }

    .btn-back-shop:hover {
      color: var(--primary);
      transform: translateX(-5px);
    }

    /* Image Gallery */
    .product-gallery { position: sticky; top: 120px; }
    .main-image { width: 100%; border-radius: 20px; background: #fafafa; overflow: hidden; border: 1px solid var(--border); }
    .main-image img { width: 100%; height: auto; display: block; mix-blend-mode: multiply; }

    /* Product Info */
    .product-info h1 { font-size: 2.8rem; font-weight: 800; margin-bottom: 5px; letter-spacing: -1px; line-height: 1.1; }
    .sku-code { color: var(--gray); font-size: 0.85rem; margin-bottom: 20px; display: block; font-weight: 500; }
    .category-badge { display: inline-block; padding: 6px 16px; background: rgba(229, 9, 20, 0.05); color: var(--primary); border-radius: 50px; font-size: 0.85rem; font-weight: 700; margin-bottom: 15px; }
    .price-container { display: flex; align-items: baseline; gap: 15px; margin-bottom: 30px; }
    .price { font-size: 2.2rem; font-weight: 800; color: var(--primary); }
    .original-price { font-size: 1.2rem; color: var(--gray); text-decoration: line-through; }
    .description { color: var(--gray-dark); font-size: 1.05rem; margin-bottom: 35px; line-height: 1.7; }

    /* Options */
    .option-group { margin-bottom: 35px; }
    .option-label { font-size: 0.95rem; font-weight: 800; margin-bottom: 15px; display: block; color: var(--dark); text-transform: uppercase; letter-spacing: 0.5px; }
    .size-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(65px, 1fr)); gap: 12px; }
    .size-btn { padding: 14px; border: 2px solid #eee; border-radius: 12px; text-align: center; cursor: pointer; transition: var(--transition); font-weight: 700; font-size: 0.9rem; background: #fff; }
    .size-btn:hover { border-color: var(--primary); color: var(--primary); }
    .size-btn.active { background: var(--dark); color: #fff; border-color: var(--dark); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }

    /* Action Buttons */
    .action-group { display: flex; gap: 15px; margin-top: 40px; }
    .btn-add { flex: 1; padding: 20px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: #fff; border: none; border-radius: 50px; font-size: 1.05rem; font-weight: 700; cursor: pointer; transition: var(--transition); display: flex; align-items: center; justify-content: center; gap: 12px; box-shadow: 0 10px 25px rgba(229, 9, 20, 0.2); }
    .btn-add:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(229, 9, 20, 0.3); }
    .btn-wishlist { width: 64px; height: 64px; border: 2px solid #eee; border-radius: 50%; background: #fff; cursor: pointer; transition: var(--transition); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: var(--gray); }
    .btn-wishlist:hover { border-color: var(--primary); color: var(--primary); background: #fff5f5; }

    /* Information Tabs */
    .product-tabs { margin-top: 50px; padding-top: 40px; border-top: 1px solid #eee; }
    .tab-nav { display: flex; gap: 30px; margin-bottom: 25px; border-bottom: 1px solid #eee; }
    .tab-link { padding: 15px 0; font-weight: 700; font-size: 1rem; color: var(--gray); cursor: pointer; position: relative; }
    .tab-link.active { color: var(--dark); }
    .tab-link.active::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 2px; background: var(--primary); }

    /* Related Products */
    .related-section { padding: 100px 0; border-top: 1px solid #eee; }
    .related-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; }
    .related-card { border-radius: 20px; overflow: hidden; transition: var(--transition); background: #fff; border: 1px solid #f0f0f0; }
    .related-card:hover { transform: translateY(-10px); box-shadow: var(--card-shadow); border-color: transparent; }
    .related-card img { width: 100%; height: 280px; object-fit: cover; background: #fafafa; }
    .related-info { padding: 20px; }
    .related-title { font-weight: 700; margin-bottom: 8px; font-size: 1.1rem; color: var(--dark); }
    .related-price { color: var(--primary); font-weight: 800; font-size: 1rem; }

    @media (max-width: 992px) {
      .detail-container { grid-template-columns: 1fr; margin-top: 100px; gap: 30px; }
      .product-info h1 { font-size: 2.2rem; }
      .related-grid { grid-template-columns: repeat(2, 1fr); }
    }
  </style>
</head>
<body>

<x-navbar />

<main class="container">
  <section class="detail-container">
    <!-- Breadcrumb / Back button -->
    <div class="back-nav">
      <a href="{{ route('shop') }}" class="btn-back-shop">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Toko
      </a>
    </div>

    <!-- Left: Image Gallery -->
    <div class="product-gallery">
      <div class="main-image">
        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800' }}" alt="{{ $product->name }}" id="mainProductImage">
      </div>
    </div>

    <!-- Right: Product Info -->
    <div class="product-info">
      <span class="category-badge">{{ $product->categoryModel->name ?? $product->category ?? 'Sneakers' }}</span>
      <h1>{{ $product->name }}</h1>
      <span class="sku-code">SKU: {{ $product->sku ?? 'SPK-' . $product->id }}</span>

      <div class="price-container">
        @if($product->discount_price)
          <div class="price">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</div>
          <div class="original-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
        @else
          <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
        @endif
      </div>

      <div class="description" style="margin-bottom: 30px;">
        @if($product->description)
          {!! nl2br(e($product->description)) !!}
        @else
          Nikmati kenyamanan dan gaya maksimal dengan {{ $product->name }}. Didesain khusus untuk para pecinta sneakers yang mengutamakan kualitas dan estetika modern.
        @endif
      </div>

      @if($product->stock > 0 && $product->stock <= 5)
        <div style="background: rgba(229, 9, 20, 0.05); color: var(--primary); padding: 12px 20px; border-radius: 12px; font-weight: 700; font-size: 0.9rem; margin-bottom: 30px; display: flex; align-items: center; gap: 10px;">
          <i class="fa-solid fa-fire-flame-curved"></i> Hurry up, only {{ $product->stock }} item left in stock.
        </div>
      @endif

      <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        
        <div class="option-group">
          <span class="option-label">Pilih Ukuran (EUR)</span>
          <div class="size-grid">
            @php
              $sizes = is_array($product->sizes) ? $product->sizes : (strpos($product->sizes, ',') !== false ? explode(',', $product->sizes) : [38, 39, 40, 41, 42, 43, 44]);
            @endphp
            @foreach($sizes as $size)
              <div class="size-btn" onclick="selectSize(this, '{{ trim($size) }}')">{{ trim($size) }}</div>
            @endforeach
          </div>
          <input type="hidden" name="size" id="selected-size" required>
        </div>

        <div class="option-group">
          <div style="display: flex; align-items: center; gap: 20px;">
            <div>
              <span class="option-label">Jumlah</span>
              <div style="display: flex; align-items: center; border: 2px solid #eee; border-radius: 50px; padding: 5px; width: fit-content;">
                <button type="button" onclick="updateQty(-1)" style="border: none; background: none; width: 35px; height: 35px; cursor: pointer; font-size: 1.2rem; color: var(--gray); font-weight: 700;">-</button>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" style="border: none; width: 45px; text-align: center; font-weight: 700; background: transparent; pointer-events: none;">
                <button type="button" onclick="updateQty(1)" style="border: none; background: none; width: 35px; height: 35px; cursor: pointer; font-size: 1.2rem; color: var(--gray); font-weight: 700;">+</button>
              </div>
            </div>
            <div style="margin-top: 15px;">
              <span style="font-size: 0.85rem; color: var(--gray); display: block; font-weight: 600;">Stok Tersedia: <span style="color: var(--dark);">{{ $product->stock }}</span></span>
            </div>
          </div>
        </div>

        <div class="action-group">
          <button type="submit" class="btn-add">
            <i class="fa-solid fa-cart-plus"></i> Tambah ke Keranjang
          </button>
          <button type="button" class="btn-wishlist">
            <i class="fa-regular fa-heart"></i>
          </button>
        </div>
      </form>

      <div class="product-tabs">
        <div class="tab-nav">
          <div class="tab-link active">Spesifikasi</div>
        </div>
        <div class="tab-content" style="font-size: 0.95rem; color: var(--gray-dark); line-height: 1.8;">
          @if($product->specifications)
            {!! nl2br(e($product->specifications)) !!}
          @else
            • Material: High Quality Synthetic & Mesh<br>
            • Sole: Rubber Construction for comfort<br>
            • Style: Modern Lifestyle / Sporty<br>
            • 100% Original Brand Lokal
          @endif
        </div>
      </div>
    </div>
  </section>

  @if($relatedProducts->count() > 0)
  <section class="related-section">
    <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 40px;">Mungkin Anda Juga Suka</h2>
    <div class="related-grid">
      @foreach($relatedProducts as $related)
      <a href="{{ route('products.show', $related->slug) }}" class="related-card">
        <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800' }}" alt="{{ $related->name }}">
        <div class="related-info">
          <div class="related-title">{{ $related->name }}</div>
          <div class="related-price">Rp {{ number_format($related->price, 0, ',', '.') }}</div>
        </div>
      </a>
      @endforeach
    </div>
  </section>
  @endif
</main>

<x-footer />

<script>
  function selectSize(btn, size) {
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('selected-size').value = size;
  }

  function updateQty(delta) {
    const input = document.getElementById('quantity');
    const newVal = parseInt(input.value) + delta;
    if (newVal >= 1 && newVal <= {{ $product->stock }}) {
      input.value = newVal;
    }
  }

  // Session Notifications
  @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: "{{ session('success') }}",
      timer: 3000,
      showConfirmButton: false,
      timerProgressBar: true
    });
  @endif

  @if(session('error'))
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "{{ session('error') }}",
    });
  @endif
</script>

</body>
</html>
