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
      --primary: #E50914;
      --primary-dark: #b20710;
      --dark: #141414;
      --light: #f5f5f7;
      --gray: #86868b;
      --border: #d2d2d7;
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      --card-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #fff; color: var(--dark); line-height: 1.5; }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    a { text-decoration: none; color: inherit; }

    header { padding: 20px 0; border-bottom: 1px solid var(--border); position: sticky; top: 0; background: #fff; z-index: 100; }
    .nav { display: flex; justify-content: space-between; align-items: center; }
    .logo { font-size: 1.5rem; font-weight: 900; color: var(--primary); display: flex; align-items: center; gap: 10px; }
    
    .cart-section { padding: 60px 0; }
    .cart-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }

    .cart-items { border-radius: 20px; border: 1px solid var(--border); overflow: hidden; }
    .cart-header { display: grid; grid-template-columns: 3fr 1fr 1fr 1fr 0.5fr; padding: 20px; background: var(--light); font-weight: 700; border-bottom: 1px solid var(--border); }
    .cart-row { display: grid; grid-template-columns: 3fr 1fr 1fr 1fr 0.5fr; padding: 20px; align-items: center; border-bottom: 1px solid var(--border); }
    .cart-row:last-child { border-bottom: none; }

    .product-info { display: flex; align-items: center; gap: 20px; }
    .product-image { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; background: var(--light); }
    .product-details h3 { font-size: 1.1rem; font-weight: 700; }
    .product-details p { font-size: 0.9rem; color: var(--gray); }

    .quantity-control { display: flex; align-items: center; gap: 10px; }
    .qty-input { width: 50px; padding: 8px; border: 1px solid var(--border); border-radius: 8px; text-align: center; }
    
    .btn-remove { color: var(--gray); cursor: pointer; transition: var(--transition); border: none; background: none; font-size: 1.1rem; }
    .btn-remove:hover { color: var(--primary); }

    .cart-summary { background: var(--light); padding: 30px; border-radius: 20px; height: fit-content; }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-weight: 600; }
    .summary-total { font-size: 1.4rem; font-weight: 800; border-top: 2px solid var(--border); padding-top: 15px; margin-top: 15px; }

    .btn-checkout { display: block; width: 100%; padding: 18px; background: var(--primary); color: #fff; text-align: center; border-radius: 15px; font-weight: 700; font-size: 1.1rem; margin-top: 30px; transition: var(--transition); cursor: pointer; border: none; }
    .btn-checkout:hover { background: var(--primary-dark); transform: translateY(-2px); }

    .empty-cart { text-align: center; padding: 100px 0; }
    .empty-cart i { font-size: 4rem; color: var(--border); margin-bottom: 20px; }

    @media (max-width: 992px) {
      .cart-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<header>
  <div class="container">
    <div class="nav">
      <a href="{{ route('home') }}" class="logo">
        <i class="fa-solid fa-shoe-prints"></i> SEPATUKUID
      </a>
      <a href="{{ route('shop') }}" style="font-weight: 600;">Lanjut Belanja</a>
    </div>
  </div>
</header>

<main class="container cart-section">
  <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 40px; letter-spacing: -1px;">Keranjang Belanja</h1>

  @if(count($cart) > 0)
    <div class="cart-grid">
      <div class="cart-items">
        <div class="cart-header">
          <div>Produk</div>
          <div>Harga</div>
          <div>Jumlah</div>
          <div>Total</div>
          <div></div>
        </div>

        @foreach($cart as $id => $details)
          <div class="cart-row" data-id="{{ $id }}">
            <div class="product-info">
              <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800' }}" class="product-image">
              <div class="product-details">
                <h3>{{ $details['name'] }}</h3>
                <p>Ukuran: {{ $details['size'] }}</p>
              </div>
            </div>
            <div class="price">Rp {{ number_format($details['price'], 0, ',', '.') }}</div>
            <div class="quantity-control">
              <input type="number" value="{{ $details['quantity'] }}" class="qty-input update-cart" min="1">
            </div>
            <div class="subtotal">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</div>
            <div>
              <button class="btn-remove remove-from-cart"><i class="fa-solid fa-trash-can"></i></button>
            </div>
          </div>
        @endforeach
      </div>

      <div class="cart-summary">
        <h2 style="margin-bottom: 25px;">Ringkasan Belanja</h2>
        <div class="summary-row">
          <span>Total Produk</span>
          <span>{{ count($cart) }} Item</span>
        </div>
        <div class="summary-row summary-total">
          <span>Total Harga</span>
          <span style="color: var(--primary);">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
        <a href="{{ route('checkout') }}" class="btn-checkout">Lanjut ke Pembayaran</a>
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('cart.clear') }}" style="color: var(--gray); font-size: 0.9rem;">Kosongkan Keranjang</a>
        </div>
      </div>
    </div>
  @else
    <div class="empty-cart">
      <i class="fa-solid fa-bag-shopping"></i>
      <h3>Keranjangmu masih kosong</h3>
      <p style="color: var(--gray); margin-bottom: 30px;">Cari sepatu impianmu sekarang di katalog kami.</p>
      <a href="{{ route('shop') }}" class="btn-checkout" style="display: inline-block; width: auto; padding: 15px 40px;">Mulai Belanja</a>
    </div>
  @endif
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Update Quantity
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('cart.update') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents(".cart-row").attr("data-id"), 
                quantity: ele.val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    // Remove Item
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
            $.ajax({
                url: '{{ route('cart.remove') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents(".cart-row").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>

</body>
</html>