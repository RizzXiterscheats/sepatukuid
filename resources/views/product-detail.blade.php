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

  <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
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

      <div style="display: flex; gap: 15px; margin-bottom: 25px; flex-wrap: wrap;">
        <div class="stock-status" style="padding: 8px 15px; background: #f8f9fa; border-radius: 8px; display: inline-flex; align-items: center; gap: 10px; font-weight: 700; font-size: 0.95rem; border: 1px solid #eee;">
          <i class="fa-solid fa-boxes-stacked" style="color: var(--primary);"></i>
          <span style="color: var(--gray-dark);">Stok Tersedia:</span>
          <span style="color: var(--dark);">{{ $product->stock }} produk</span>
        </div>
        <div class="sold-status" style="padding: 8px 15px; background: rgba(255, 152, 0, 0.05); border-radius: 8px; display: inline-flex; align-items: center; gap: 10px; font-weight: 700; font-size: 0.95rem; border: 1px solid rgba(255, 152, 0, 0.1);">
          <i class="fa-solid fa-fire" style="color: #FF9800;"></i>
          <span style="color: var(--gray-dark);">Total Terjual:</span>
          <span style="color: var(--dark);">{{ $product->total_sold ?? 0 }} produk</span>
        </div>
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
          <i class="fa-solid fa-fire-flame-curved"></i> Segera pesan! Stok terbatas, hanya tersisa {{ $product->stock }} produk.
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
          <button type="button" class="btn-wishlist" onclick="toggleWishlist({{ $product->id }}, this)">
            <i class="fa-solid fa-heart" id="wishlist-icon" style="color: {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists() ? 'var(--primary)' : 'var(--gray)' }};"></i>
          </button>
        </div>
      </form>

      <div class="product-tabs">
        <div class="tab-nav">
          <div class="tab-link active" onclick="switchTab(this, 'spec')">Spesifikasi</div>
          <div class="tab-link" onclick="switchTab(this, 'reviews')">Ulasan ({{ count($reviews) }})</div>
        </div>
        <div id="tab-spec" class="tab-content" style="font-size: 0.95rem; color: var(--gray-dark); line-height: 1.8;">
          @if($product->specifications)
            {!! nl2br(e($product->specifications)) !!}
          @else
            • Material: High Quality Synthetic & Mesh<br>
            • Sole: Rubber Construction for comfort<br>
            • Style: Modern Lifestyle / Sporty<br>
            • 100% Original Brand Lokal
          @endif
        </div>
        
        <div id="tab-reviews" class="tab-content" style="display: none;">
          @if(count($reviews) > 0)
            <div class="rating-summary">
              <div class="avg-rating">{{ number_format($reviews->avg('rating'), 1) }}</div>
              <div>
                <div class="review-stars">
                  @for($i = 1; $i <= 5; $i++)
                    <i class="fa-{{ $i <= round($reviews->avg('rating')) ? 'solid' : 'regular' }} fa-star"></i>
                  @endfor
                </div>
                <div style="font-size: 0.9rem; color: var(--gray); margin-top: 5px;">Berdasarkan {{ count($reviews) }} ulasan</div>
              </div>
            </div>

            @foreach($reviews as $review)
              <div class="review-item">
                <div class="review-header">
                  <div class="review-user">{{ $review->user->name }}</div>
                  <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                </div>
                <div class="review-stars" style="margin-bottom: 10px;">
                  @for($i = 1; $i <= 5; $i++)
                    <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                  @endfor
                </div>
                <div class="review-comment">{{ $review->comment }}</div>
              </div>
            @endforeach
          @else
            <div class="no-reviews">
              <i class="fa-regular fa-comment-dots" style="font-size: 3rem; margin-bottom: 15px; display: block; opacity: 0.2;"></i>
              Belum ada ulasan untuk produk ini.
            </div>
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

  function switchTab(el, tabId) {
    document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.style.display = 'none');
    
    el.classList.add('active');
    document.getElementById('tab-' + tabId).style.display = 'block';
  }

  function toggleWishlist(productId, btn) {
    fetch('{{ route("wishlist.toggle") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => {
        if(response.status === 401) {
            window.location.href = "{{ route('login') }}";
            return;
        }
        return response.json();
    })
    .then(data => {
        if (data) {
            const icon = btn.querySelector('i');
            if (data.status === 'added') {
                icon.style.color = 'var(--primary)';
                Swal.fire({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, icon: 'success', title: data.message });
            } else if (data.status === 'removed') {
                icon.style.color = 'var(--gray)';
                Swal.fire({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, icon: 'info', title: data.message });
            }
        }
    })
    .catch(error => console.error('Error:', error));
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
