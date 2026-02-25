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

    /* Detail Specific Styles */
    .detail-container {
      max-width: 1200px;
      margin: 140px auto 80px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      padding: 0 20px;
    }

    /* Image Gallery */
    .product-gallery { position: sticky; top: 120px; }
    .main-image { width: 100%; border-radius: 20px; background: var(--light); overflow: hidden; }
    .main-image img { width: 100%; height: auto; display: block; }

    /* Product Info */
    .product-info h1 { font-size: 3rem; font-weight: 800; margin-bottom: 10px; letter-spacing: -1px; }
    .category-badge { display: inline-block; padding: 6px 12px; background: var(--light); border-radius: 50px; font-size: 0.9rem; font-weight: 600; margin-bottom: 20px; }
    .price { font-size: 2rem; font-weight: 700; color: var(--primary); margin-bottom: 30px; }
    .description { color: var(--gray); font-size: 1.1rem; margin-bottom: 40px; }

    /* Options */
    .option-group { margin-bottom: 30px; }
    .option-label { font-weight: 700; margin-bottom: 15px; display: block; }
    .size-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(60px, 1fr)); gap: 10px; }
    .size-btn { padding: 12px; border: 1px solid var(--border); border-radius: 12px; text-align: center; cursor: pointer; transition: var(--transition); font-weight: 600; }
    .size-btn:hover { border-color: var(--dark); }
    .size-btn.active { background: var(--dark); color: #fff; border-color: var(--dark); }

    /* Action Buttons */
    .action-group { display: flex; gap: 20px; margin-top: 40px; }
    .btn-add { flex: 1; padding: 18px; background: var(--primary); color: #fff; border: none; border-radius: 15px; font-size: 1.1rem; font-weight: 700; cursor: pointer; transition: var(--transition); }
    .btn-add:hover { background: var(--primary-dark); transform: translateY(-2px); }
    .btn-wishlist { padding: 18px; border: 1px solid var(--border); border-radius: 15px; background: #fff; cursor: pointer; transition: var(--transition); }
    .btn-wishlist:hover { border-color: var(--dark); }

    /* Related Products */
    .related-section { padding: 80px 0; border-top: 1px solid var(--border); }
    .related-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; }
    .related-card { border-radius: 15px; overflow: hidden; transition: var(--transition); }
    .related-card:hover { transform: translateY(-10px); }
    .related-card img { width: 100%; height: 250px; object-fit: cover; background: var(--light); }
    .related-info { padding: 20px; }
    .related-title { font-weight: 700; margin-bottom: 5px; }
    .related-price { color: var(--primary); font-weight: 600; }

    @media (max-width: 992px) {
      .detail-container { grid-template-columns: 1fr; }
      .product-info h1 { font-size: 2.5rem; }
    }
  </style>
</head>
<body>


      <div class="product-info">
        <span class="category-badge">{{ $product->categoryModel->name ?? $product->category ?? 'Sneakers' }}</span>
        <h1>{{ $product->name }}</h1>
        <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
        
        <p class="description">
          {{ $product->description ?? 'Nikmati kenyamanan dan gaya maksimal dengan ' . $product->name . '. Didesain khusus untuk para pecinta sneakers yang mengutamakan kualitas dan estetika modern.' }}
        </p>

        <form action="{{ route('cart.add') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          
          <div class="option-group">
            <span class="option-label">Pilih Ukuran (EUR)</span>
            <div class="size-grid">
              @foreach([38, 39, 40, 41, 42, 43, 44] as $size)
                <div class="size-btn" onclick="selectSize(this, {{ $size }})">{{ $size }}</div>
              @endforeach
            </div>
            <input type="hidden" name="size" id="selected-size" required>
          </div>

          <div class="option-group">
            <span class="option-label">Jumlah</span>
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" style="padding: 12px; border: 1px solid var(--border); border-radius: 12px; width: 80px; font-weight: 600;">
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
</script>

</body>
</html>
