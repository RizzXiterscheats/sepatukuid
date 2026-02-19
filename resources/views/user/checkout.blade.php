<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sepatukuid - Checkout</title>

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

    /* CHECKOUT HERO */
    .checkout-hero {
      padding: 80px 0 30px;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
      text-align: center;
    }

    .checkout-hero h1 {
      font-size: 2.2rem;
      font-weight: 900;
      margin-bottom: 10px;
      background: linear-gradient(45deg, var(--dark), var(--primary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* CHECKOUT SECTION */
    .checkout-section {
      padding: 30px 0 80px;
      background: white;
    }

    .checkout-container {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 30px;
    }

    /* FORM SECTION */
    .checkout-form {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 30px;
    }

    .form-title {
      font-size: 1.3rem;
      font-weight: 800;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--light);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      font-size: 0.9rem;
      color: var(--gray-dark);
    }

    .form-group input, 
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid var(--light);
      border-radius: 10px;
      font-size: 0.95rem;
      transition: var(--transition);
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--primary);
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }

    /* PAYMENT METHODS */
    .payment-methods {
      margin: 30px 0;
    }

    .payment-option {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 15px;
      border: 2px solid var(--light);
      border-radius: 10px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: var(--transition);
    }

    .payment-option:hover {
      border-color: var(--primary);
    }

    .payment-option.selected {
      border-color: var(--primary);
      background: rgba(229, 57, 53, 0.05);
    }

    .payment-option input[type="radio"] {
      width: 20px;
      height: 20px;
      accent-color: var(--primary);
    }

    .payment-option img {
      width: 50px;
      height: auto;
    }

    .payment-option span {
      font-weight: 600;
    }

    /* ORDER SUMMARY */
    .order-summary {
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

    .order-item {
      display: flex;
      gap: 15px;
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--light);
    }

    .order-item-image {
      width: 70px;
      height: 70px;
      border-radius: 10px;
      overflow: hidden;
    }

    .order-item-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .order-item-info {
      flex: 1;
    }

    .order-item-info h4 {
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .order-item-info p {
      font-size: 0.8rem;
      color: var(--gray);
      margin-bottom: 5px;
    }

    .order-item-price {
      font-weight: 700;
      color: var(--primary);
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

    .btn-payment {
      width: 100%;
      justify-content: center;
      margin-top: 20px;
    }

    .back-to-cart {
      text-align: center;
      margin-top: 20px;
    }

    .back-to-cart a {
      color: var(--primary);
      font-size: 0.9rem;
      font-weight: 600;
    }

    .back-to-cart a:hover {
      text-decoration: underline;
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
      
      .checkout-container {
        grid-template-columns: 1fr;
      }
      
      .order-summary {
        position: static;
      }
      
      .footer-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .form-row {
        grid-template-columns: 1fr;
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

<section class="checkout-hero">
  <div class="container">
    <h1>Informasi Pembayaran</h1>
    <p>Lengkapi data diri dan pilih metode pembayaran</p>
  </div>
</section>

<section class="checkout-section">
  <div class="container">
    <div class="checkout-container">
      
      <!-- Form Informasi -->
      <div class="checkout-form">
        <h3 class="form-title">Informasi Pengiriman</h3>
        
        <form>
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" placeholder="Masukkan nama lengkap" value="Raki Aranda">
          </div>
          
          <div class="form-group">
            <label>Email</label>
            <input type="email" placeholder="Masukkan email" value="raki@example.com">
          </div>
          
          <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="tel" placeholder="Masukkan nomor telepon" value="081234567890">
          </div>
          
          <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea rows="3" placeholder="Masukkan alamat lengkap">Jl. Sudirman No. 123, Jakarta Pusat</textarea>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label>Provinsi</label>
              <select>
                <option>DKI Jakarta</option>
                <option>Jawa Barat</option>
                <option>Jawa Tengah</option>
                <option>Jawa Timur</option>
              </select>
            </div>
            
            <div class="form-group">
              <label>Kota/Kabupaten</label>
              <select>
                <option>Jakarta Pusat</option>
                <option>Jakarta Selatan</option>
                <option>Jakarta Utara</option>
                <option>Jakarta Timur</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label>Kecamatan</label>
              <input type="text" placeholder="Kecamatan" value="Menteng">
            </div>
            
            <div class="form-group">
              <label>Kode Pos</label>
              <input type="text" placeholder="Kode Pos" value="10310">
            </div>
          </div>
          
          <h3 class="form-title" style="margin-top: 30px;">Metode Pembayaran</h3>
          
          <div class="payment-methods">
            <label class="payment-option selected">
              <input type="radio" name="payment" checked>
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA" style="width: 50px;">
              <span>Bank BCA - Virtual Account</span>
            </label>
            
            <label class="payment-option">
              <input type="radio" name="payment">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Bank_Mandiri_logo.svg" alt="Mandiri" style="width: 50px;">
              <span>Bank Mandiri - Virtual Account</span>
            </label>
            
            <label class="payment-option">
              <input type="radio" name="payment">
              <img src="https://upload.wikimedia.org/wikipedia/commons/9/93/BNI_logo.svg" alt="BNI" style="width: 50px;">
              <span>Bank BNI - Virtual Account</span>
            </label>
            
            <label class="payment-option">
              <input type="radio" name="payment">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/BRI_logo.svg" alt="BRI" style="width: 50px;">
              <span>Bank BRI - Virtual Account</span>
            </label>
            
            <label class="payment-option">
              <input type="radio" name="payment">
              <i class="fa-brands fa-cc-visa" style="font-size: 2rem; color: #1a1f71;"></i>
              <span>Kartu Kredit / Debit</span>
            </label>
            
            <label class="payment-option">
              <input type="radio" name="payment">
              <i class="fa-brands fa-google-pay" style="font-size: 2rem;"></i>
              <span>Google Pay / Gopay</span>
            </label>
          </div>
          
          <button type="submit" class="btn btn-payment">
            <i class="fa-solid fa-lock"></i>
            Proses Pembayaran
          </button>
        </form>
      </div>
      
      <!-- Ringkasan Pesanan -->
      <div class="order-summary">
        <h3 class="summary-title">Ringkasan Pesanan</h3>
        
        <div class="order-item">
          <div class="order-item-image">
            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800" alt="Nike Air Max">
          </div>
          <div class="order-item-info">
            <h4>Nike Air Max 270 React</h4>
            <p>Hitam/Merah • 42</p>
            <p>1 x Rp 1.299.000</p>
            <div class="order-item-price">Rp 1.299.000</div>
          </div>
        </div>
        
        <div class="order-item">
          <div class="order-item-image">
            <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?q=80&w=800" alt="Adidas Ultraboost">
          </div>
          <div class="order-item-info">
            <h4>Adidas Ultraboost 22</h4>
            <p>Putih/Hitam • 43</p>
            <p>1 x Rp 1.499.000</p>
            <div class="order-item-price">Rp 1.499.000</div>
          </div>
        </div>
        
        <div class="order-item">
          <div class="order-item-image">
            <img src="https://images.unsplash.com/photo-1597045566677-8cf032ed6634?q=80&w=800" alt="Converse">
          </div>
          <div class="order-item-info">
            <h4>Converse Chuck Taylor All Star</h4>
            <p>Hitam • 40</p>
            <p>2 x Rp 699.000</p>
            <div class="order-item-price">Rp 1.398.000</div>
          </div>
        </div>
        
        <div class="summary-row">
          <span>Subtotal (4 produk)</span>
          <span>Rp 4.196.000</span>
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
          <span class="summary-total-price">Rp 4.251.000</span>
        </div>
        
        <div class="back-to-cart">
          <a href="{{ route('user.cart') }}">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Keranjang
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
  document.addEventListener('DOMContentLoaded', function() {
    // Payment option selection
    const paymentOptions = document.querySelectorAll('.payment-option');
    paymentOptions.forEach(option => {
      option.addEventListener('click', function() {
        paymentOptions.forEach(opt => opt.classList.remove('selected'));
        this.classList.add('selected');
        this.querySelector('input[type="radio"]').checked = true;
      });
    });
  });
</script>

</body>
</html>