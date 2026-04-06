<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Saya - Sepatukuid</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root { --primary: #E53935; --dark: #121212; --gray: #666; --light: #f8f9fa; }
        body { font-family: 'Inter', sans-serif; background: #f5f7fa; min-height: 100vh; padding: 40px 20px; margin: 0; }
        .container { max-width: 1000px; margin: 0 auto; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { font-size: 2rem; color: var(--dark); display: flex; align-items: center; gap: 10px; margin: 0; }

        .btn-back { display: inline-flex; align-items: center; gap: 8px; color: var(--dark); background: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; }
        .product-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); position: relative; transition: transform 0.3s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        
        .product-img { width: 100%; height: 220px; object-fit: cover; }
        .product-info { padding: 15px; }
        .product-title { font-weight: 700; color: var(--dark); margin: 0 0 5px 0; font-size: 1.1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none; display: block; }
        .product-price { color: var(--primary); font-weight: 800; }
        
        .btn-remove { position: absolute; top: 10px; right: 10px; width: 35px; height: 35px; border-radius: 50%; background: white; color: var(--primary); display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2); transition: 0.3s; }
        .btn-remove:hover { background: #fee2e2; }

        .empty-state { text-align: center; padding: 80px 20px; background: white; border-radius: 15px; grid-column: 1 / -1; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fa-solid fa-heart" style="color: var(--primary);"></i> Wishlist Saya</h1>
            <a href="{{ route('shop') }}" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Lanjut Belanja</a>
        </div>

        <div class="product-grid">
            @forelse($wishlists as $wishlist)
                @if($wishlist->product)
                <div class="product-card" id="wishlist-item-{{ $wishlist->product->id }}">
                    <a href="{{ route('products.show', $wishlist->product->slug) }}">
                        <img src="{{ asset('storage/' . $wishlist->product->image) }}" class="product-img" alt="{{ $wishlist->product->name }}">
                    </a>
                    <button class="btn-remove" onclick="toggleWishlist({{ $wishlist->product->id }})" title="Hapus dari Wishlist">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                    <div class="product-info">
                        <a href="{{ route('products.show', $wishlist->product->slug) }}" class="product-title">{{ $wishlist->product->name }}</a>
                        <div class="product-price">Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}</div>
                    </div>
                </div>
                @endif
            @empty
                <div class="empty-state">
                    <i class="fa-regular fa-heart" style="font-size: 4rem; color: #cbd5e1; margin-bottom: 20px;"></i>
                    <h2 style="margin-bottom: 10px; color: var(--gray);">Belum ada produk favorit</h2>
                    <p style="color: #94a3b8; font-size: 0.95rem; margin-bottom: 25px;">Yuk, telusuri katalog dan simpan sepatu impian Anda di sini!</p>
                    <a href="{{ route('shop') }}" class="btn-back" style="background: var(--primary); color: white;"><i class="fa-solid fa-shop"></i> Lihat Katalog Utama</a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Script to toggle wishlist -->
    <script>
        function toggleWishlist(productId) {
            fetch("{{ route('wishlist.toggle') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'removed') {
                    // Remove the card from the UI
                    const card = document.getElementById('wishlist-item-' + productId);
                    if (card) {
                        card.style.transform = 'scale(0.8)';
                        card.style.opacity = '0';
                        setTimeout(() => { card.remove(); }, 300);
                    }
                }
            })
            .catch(error => console.error('Error toggling wishlist:', error));
        }
    </script>
</body>
</html>
