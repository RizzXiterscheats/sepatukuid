<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sepatukuid - Sneakers Kekinian</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

  <style>
    /* Hero Section - Still page specific */
    .hero {
      padding: 200px 0 120px;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 70%;
      height: 200%;
      background: radial-gradient(circle, rgba(229, 57, 53, 0.05) 0%, transparent 70%);
      transform: rotate(30deg);
    }

    .hero-wrap {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: center;
    }

    .hero-content h1 {
      font-size: 4rem;
      font-weight: 900;
      line-height: 1.1;
      margin-bottom: 30px;
      background: linear-gradient(45deg, var(--dark), var(--gray-dark), var(--primary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -1px;
    }

    .hero-content p {
      font-size: 1.3rem;
      color: var(--gray);
      margin-bottom: 40px;
      max-width: 550px;
      line-height: 1.8;
    }

    .hero-stats {
      display: flex;
      gap: 50px;
      margin-top: 60px;
      padding-top: 30px;
      border-top: 2px solid rgba(0, 0, 0, 0.05);
    }

    .stat-item {
      text-align: center;
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 900;
      color: var(--primary);
      margin-bottom: 5px;
    }

    .stat-label {
      font-size: 1rem;
      color: var(--gray);
      font-weight: 600;
    }

    .hero-image {
      position: relative;
      border-radius: 30px;
      overflow: hidden;
      box-shadow: 0 40px 80px rgba(0, 0, 0, 0.15);
      transform: perspective(1500px) rotateY(-12deg);
      transition: var(--transition);
      border: 15px solid white;
    }

    .hero-image:hover {
      transform: perspective(1500px) rotateY(0deg);
      box-shadow: 0 50px 100px rgba(0, 0, 0, 0.2);
    }

    .hero-image::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, rgba(229, 57, 53, 0.1), transparent);
      z-index: 1;
    }

    /* MODEL SNEAKERS SECTION */
    .model-section {
      padding: 120px 0;
      background: linear-gradient(180deg, var(--light) 0%, #ffffff 100%);
      position: relative;
    }

    .model-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
    }

    .model-card {
      position: relative;
      overflow: hidden;
      border-radius: 25px;
      height: 450px;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: var(--card-shadow);
    }

    .model-card:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: var(--card-shadow-hover);
    }

    .model-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(0.85);
      transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .model-card:hover img {
      transform: scale(1.1);
      filter: brightness(1);
    }

    .model-content {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 35px;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
      color: white;
      z-index: 2;
    }

    .model-content h3 {
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 10px;
      letter-spacing: -0.5px;
    }

    .model-content p {
      opacity: 0.9;
      font-size: 1rem;
      font-weight: 400;
    }

    /* Model khusus untuk Clean Street Flex */
    .model-card.featured {
      grid-column: span 2;
      position: relative;
    }

    .model-card.featured .model-text-bg {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 13rem;
      font-weight: 900;
      color: rgba(255, 255, 255, 0.08);
      white-space: nowrap;
      z-index: 1;
      pointer-events: none;
      letter-spacing: 8px;
      text-transform: uppercase;
    }

    .model-card.featured .model-image-front {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 350px;
      height: 350px;
      object-fit: contain;
      z-index: 2;
      filter: brightness(1.1) drop-shadow(0 10px 30px rgba(0,0,0,0.3));
    }

    /* PENAWARAN BULANAN BANNER */
    .monthly-offer {
      padding: 120px 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      position: relative;
      overflow: hidden;
    }

    .monthly-offer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('https://images.unsplash.com/photo-1491553895911-0055eca6402d?q=80&w=1200') center/cover;
      opacity: 0.15;
      animation: bgMove 30s linear infinite;
    }

    @keyframes bgMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .offer-content {
      position: relative;
      z-index: 2;
      text-align: center;
      color: white;
    }

    .offer-badge {
      display: inline-block;
      background: linear-gradient(135deg, var(--primary), var(--warning));
      color: white;
      padding: 15px 40px;
      border-radius: 50px;
      font-size: 1.4rem;
      font-weight: 800;
      margin-bottom: 40px;
      transform: rotate(-5deg);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
      letter-spacing: 1px;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { transform: rotate(-5deg) scale(1); }
      50% { transform: rotate(-5deg) scale(1.05); }
      100% { transform: rotate(-5deg) scale(1); }
    }

    .offer-main {
      font-size: 12rem;
      font-weight: 900;
      line-height: 0.8;
      margin: 40px 0;
      text-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
      position: relative;
      display: inline-block;
      background: linear-gradient(135deg, #ffffff 0%, #ffeaa7 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .offer-main::after {
      content: 'DISKON';
      position: absolute;
      bottom: -30px;
      right: -80px;
      font-size: 2.5rem;
      font-weight: 800;
      background: rgba(255, 255, 255, 0.2);
      padding: 15px 30px;
      border-radius: 50px;
      transform: rotate(15deg);
      backdrop-filter: blur(10px);
    }

    .offer-subtitle {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 25px;
      letter-spacing: -1px;
    }

    .offer-desc {
      font-size: 1.4rem;
      opacity: 0.95;
      margin-bottom: 50px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.8;
    }

    .offer-btn {
      background: white;
      color: var(--primary);
      font-size: 1.4rem;
      padding: 22px 55px;
      border-radius: 50px;
      font-weight: 800;
      border: none;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
      letter-spacing: 1px;
      position: relative;
      overflow: hidden;
    }

    .offer-btn:hover {
      transform: translateY(-8px) scale(1.08);
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
      color: var(--primary-dark);
    }

    /* KEDATANGAN PRODUK BARU */
    .new-arrivals {
      padding: 120px 0;
      background: white;
      position: relative;
    }

    .arrivals-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 35px;
    }

    .arrival-card {
      background: white;
      border-radius: 25px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      position: relative;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .arrival-card:hover {
      transform: translateY(-15px) scale(1.03);
      box-shadow: var(--card-shadow-hover);
    }

    .new-badge {
      position: absolute;
      top: 20px;
      left: 20px;
      background: linear-gradient(135deg, var(--success), #2ECC71);
      color: white;
      padding: 12px 25px;
      border-radius: 50px;
      font-size: 1rem;
      font-weight: 800;
      z-index: 2;
      box-shadow: 0 10px 20px rgba(76, 175, 80, 0.3);
    }

    .arrival-image {
      height: 280px;
      width: 100%;
      object-fit: cover;
      transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .arrival-card:hover .arrival-image {
      transform: scale(1.1);
    }

    .arrival-info {
      padding: 30px;
      text-align: center;
    }

    .arrival-title {
      font-size: 1.5rem;
      font-weight: 800;
      margin-bottom: 20px;
      color: var(--dark);
      min-height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .arrival-price {
      font-size: 1.8rem;
      font-weight: 900;
      color: var(--primary);
      margin-bottom: 25px;
      position: relative;
      display: inline-block;
    }

    .arrival-price::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 3px;
      background: linear-gradient(90deg, var(--primary), transparent);
      border-radius: 2px;
    }

    /* PRODUCT GRID MODERN */
    .product-section {
      padding: 120px 0;
      background: linear-gradient(180deg, #ffffff 0%, var(--light) 100%);
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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

    .product-badge {
      position: absolute;
      top: 20px;
      left: 20px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      padding: 10px 20px;
      border-radius: 50px;
      font-size: 0.9rem;
      font-weight: 800;
      z-index: 1;
      box-shadow: 0 10px 20px rgba(229, 57, 53, 0.3);
    }

    .product-image {
      height: 280px;
      width: 100%;
      object-fit: cover;
      transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-card:hover .product-image {
      transform: scale(1.1);
    }

    .product-info {
      padding: 30px;
    }

    .product-category {
      color: var(--gray-light);
      font-size: 1rem;
      margin-bottom: 10px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .product-title {
      font-size: 1.5rem;
      font-weight: 800;
      margin-bottom: 15px;
      color: var(--dark);
      line-height: 1.3;
      min-height: 65px;
    }

    .product-price {
      font-size: 1.8rem;
      font-weight: 900;
      color: var(--primary);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .old-price {
      font-size: 1.3rem;
      color: var(--gray-light);
      text-decoration: line-through;
      font-weight: 600;
    }

    .product-rating {
      color: #FFD700;
      margin-bottom: 20px;
      font-size: 1.1rem;
    }

    /* FEATURES */
    .features {
      padding: 120px 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      position: relative;
    }

    .features::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?q=80&w=1200') center/cover;
      opacity: 0.1;
    }

    .section-title.features-title h2 {
      background: linear-gradient(45deg, #ffffff, #ffeaa7);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .section-title.features-title p {
      color: rgba(255, 255, 255, 0.9);
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 35px;
      position: relative;
      z-index: 2;
    }

    .feature-card {
      text-align: center;
      padding: 50px 35px;
      border-radius: 25px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      transition: var(--transition);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .feature-card:hover {
      transform: translateY(-15px) scale(1.05);
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }

    .feature-icon {
      width: 90px;
      height: 90px;
      background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.05));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 35px;
      color: white;
      font-size: 2rem;
      transition: var(--transition);
      border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .feature-card:hover .feature-icon {
      transform: rotateY(360deg);
      background: rgba(255, 255, 255, 0.3);
    }

    .feature-card h3 {
      font-size: 1.6rem;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .feature-card p {
      opacity: 0.9;
      font-size: 1.1rem;
      line-height: 1.7;
    }

    /* TESTIMONIAL PUTIH MODERN */
    .testimonial-section {
      padding: 120px 0;
      background: white;
      position: relative;
    }

    .testimonial-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--primary), transparent);
    }

    .testimonial-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 35px;
    }

    .testimonial-card {
      background: white;
      border-radius: 25px;
      padding: 50px 40px;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      border: 1px solid rgba(0, 0, 0, 0.05);
      position: relative;
      overflow: hidden;
    }

    .testimonial-card:hover {
      transform: translateY(-15px);
      box-shadow: var(--card-shadow-hover);
    }

    .testimonial-card::before {
      content: '"';
      position: absolute;
      top: 20px;
      right: 30px;
      font-size: 140px;
      font-family: Georgia, serif;
      color: var(--primary);
      opacity: 0.08;
      line-height: 1;
    }

    .testimonial-header {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 25px;
      position: relative;
      z-index: 2;
    }

    .testimonial-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid var(--primary);
      padding: 3px;
      box-shadow: 0 10px 20px rgba(229, 57, 53, 0.2);
    }

    .testimonial-info h4 {
      margin-bottom: 8px;
      font-size: 1.4rem;
      color: var(--dark);
      font-weight: 800;
    }

    .testimonial-info p {
      color: var(--gray);
      font-size: 1rem;
      font-weight: 600;
    }

    .testimonial-rating {
      color: #FFD700;
      margin: 20px 0 25px;
      font-size: 1.3rem;
    }

    .testimonial-text {
      color: var(--gray-dark);
      font-size: 1.2rem;
      line-height: 1.8;
      position: relative;
      z-index: 2;
      font-style: italic;
    }

    /* FOOTER MODERN */
    footer {
      background: linear-gradient(135deg, var(--dark) 0%, #000000 100%);
      color: #ccc;
      padding: 100px 0 50px;
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
      margin-bottom: 70px;
    }

    .footer-column h4 {
      color: white;
      font-size: 1.4rem;
      margin-bottom: 30px;
      position: relative;
      padding-bottom: 15px;
      font-weight: 800;
    }

    .footer-column h4::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 18px;
    }

    .footer-links a {
      color: #aaa;
      transition: var(--transition);
      font-size: 1.1rem;
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
      gap: 20px;
      margin-top: 30px;
    }

    .social-links a {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: var(--transition);
      font-size: 1.3rem;
    }

    .social-links a:hover {
      background: var(--primary);
      transform: translateY(-5px) scale(1.1);
    }

    .copyright {
      text-align: center;
      padding-top: 50px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: var(--gray-light);
      font-size: 1rem;
    }

    /* RESPONSIVE */
    @media (max-width: 1200px) {
      .offer-main {
        font-size: 10rem;
      }
      
      .arrivals-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 992px) {
      .hero-wrap {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 60px;
      }
      
      .hero-content h1 {
        font-size: 3.2rem;
      }
      
      .menu {
        display: none;
      }
      
      .hero-stats {
        justify-content: center;
      }
      
      .model-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .model-card.featured {
        grid-column: span 2;
      }
      
      .offer-main {
        font-size: 8rem;
      }
      
      .offer-subtitle {
        font-size: 2.5rem;
      }
    }

    @media (max-width: 768px) {
      .hero {
        padding: 180px 0 80px;
      }
      
      .hero-content h1 {
        font-size: 2.8rem;
      }
      
      .section-title h2 {
        font-size: 2.5rem;
      }
      
      .model-card.featured .model-text-bg {
        font-size: 9rem;
      }
      
      .model-card.featured .model-image-front {
        width: 250px;
        height: 250px;
      }
      
      .offer-main {
        font-size: 6rem;
      }
      
      .offer-main::after {
        font-size: 1.8rem;
        right: -40px;
        bottom: -20px;
      }
      
      .arrivals-grid {
        grid-template-columns: 1fr;
      }
      
      .features-grid,
      .testimonial-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 576px) {
      .btn {
        padding: 14px 28px;
        font-size: 15px;
      }
      
      .hero-stats {
        flex-direction: column;
        gap: 25px;
      }
      
      .model-grid {
        grid-template-columns: 1fr;
      }
      
      .model-card.featured {
        grid-column: span 1;
      }
      
      .model-card.featured .model-text-bg {
        font-size: 6rem;
      }
      
      .model-card.featured .model-image-front {
        width: 200px;
        height: 200px;
      }
      
      .offer-main {
        font-size: 5rem;
      }
      
      .offer-subtitle {
        font-size: 2rem;
      }
      
      .offer-btn {
        padding: 18px 35px;
        font-size: 1.2rem;
      }
      
      .product-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>

<x-navbar />
<section class="hero">
  <div class="container">
    <div class="hero-wrap">
      <div class="hero-content">
        <h1>Style Sneakers yang Mengubah Permainan Fashionmu</h1>
        <p>Koleksi sneakers premium dengan teknologi terbaru dan desain terkini. Kenyamanan maksimal, harga terjangkau, kualitas terjamin. Upgrade style harianmu sekarang!</p>
<a href="{{ route('products.index') }}" class="btn">
  <i class="fa-solid fa-bolt"></i>
  EXPLORE KOLEKSI
</a>
        
        <div class="hero-stats">
          <div class="stat-item">
            <div class="stat-number">850+</div>
            <div class="stat-label">Model Sneakers</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">15K+</div>
            <div class="stat-label">Pelanggan Setia</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">4.9★</div>
            <div class="stat-label">Rating Bintang</div>
          </div>
        </div>
      </div>
      
      <div class="hero-image">
        <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200" alt="Sneaker Premium Collection">
      </div>
    </div>
  </div>
</section>

<!-- Section Model Sneakers -->
<section class="model-section">
  <div class="container">
    <div class="section-title">
      <h2>Koleksi Model Sneakers</h2>
      <p>Pilih dari berbagai model sneakers terbaik dengan desain yang sesuai gaya hidupmu</p>
    </div>
    
    <div class="model-grid">
      <!-- Clean Street Flex dengan text besar di belakang -->
      <div class="model-card featured" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="model-text-bg">CLEAN STREET FLEX</div>
        <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?q=80&w=800" class="model-image-front" alt="Clean Street Flex">
        <div class="model-content">
          <h3>Clean Street Flex</h3>
          <p>Desain minimalis dengan kenyamanan maksimal untuk gaya urban</p>
        </div>
      </div>
      
      <div class="model-card">
        <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=800" alt="Nike Superrep Go">
        <div class="model-content">
          <h3>Nike Superrep Go</h3>
          <p>Perform maksimal untuk gaya aktif sehari-hari</p>
        </div>
      </div>
      
      <div class="model-card">
        <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?q=80&w=800" alt="High Street Motion">
        <div class="model-content">
          <h3>High Street Motion</h3>
          <p>Kombinasi sempurna antara style dan performa</p>
        </div>
      </div>
      
      <div class="model-card">
        <img src="https://images.unsplash.com/photo-1605348532760-6753d2c43329?q=80&w=800" alt="Everyday Trail">
        <div class="model-content">
          <h3>Everyday Trail</h3>
          <p>Semangat petualangan urban dalam setiap langkah</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section Pilih Produk -->
<section class="product-section">
  <div class="container">
    <div class="section-title">
      <h2>Pilih Produk Terbaik</h2>
      <p>Temukan sneakers favoritmu dari koleksi premium kami dengan harga terbaik</p>
    </div>
    
    <div class="product-grid">
      @forelse($featuredProducts as $product)
      <div class="product-card">
        @if($product->is_featured)
          <span class="product-badge">UNGGULAN</span>
        @endif
        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800' }}" class="product-image" alt="{{ $product->name }}">
        <div class="product-info">
          <div class="product-category">{{ $product->categoryModel->name ?? $product->category ?? 'Sneakers' }}</div>
          <h3 class="product-title">{{ $product->name }}</h3>
          <div class="product-rating">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half"></i>
            <span style="color: var(--gray); margin-left: 10px;">(4.5)</span>
          </div>
          <div class="product-price">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </div>
          <a href="{{ route('products.show', $product->slug) }}" class="btn" style="width: 100%;">
            <i class="fa-solid fa-cart-plus"></i>
            Lihat Detail
          </a>
        </div>
      </div>
      @empty
        <div style="grid-column: span 4; text-align: center; padding: 40px;">
          <p>Belum ada produk tersedia.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

<!-- PENAWARAN BULANAN -->
<section class="monthly-offer">
  <div class="container">
    <div class="offer-content">
      <div class="offer-badge">PENAWARAN SPESIAL BULANAN</div>
      <div class="offer-main">90%</div>
      <h2 class="offer-subtitle">Diskon Meriah Sneakers Terlaris</h2>
      <p class="offer-desc">Best seller dengan potongan harga luar biasa! Kualitas premium dengan harga terjangkau. Stok terbatas, jangan sampai kehabisan kesempatan ini!</p>
<a href="{{ route('login') }}" class="offer-btn">
  <i class="fa-solid fa-gift"></i>
  DAPATKAN PROMO SEKARANG
</a>
    </div>
  </div>
</section>

<!-- KEDATANGAN PRODUK BARU -->
<section class="new-arrivals">
  <div class="container">
    <div class="section-title">
      <h2>Produk Baru Tiba!</h2>
      <p>Jangan lewatkan koleksi sneakers terbaru yang baru saja tiba di toko kami</p>
    </div>
    
    <div class="arrivals-grid">
      @forelse($featuredProducts->take(4) as $product)
      <div class="arrival-card">
        <span class="new-badge">NEW ARRIVAL</span>
        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=800' }}" class="arrival-image" alt="{{ $product->name }}">
        <div class="arrival-info">
          <h3 class="arrival-title">{{ $product->name }}</h3>
          <div class="arrival-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
          <a href="{{ route('products.show', $product->slug) }}" class="btn-view">
            <i class="fa-solid fa-eye"></i>
            Lihat Detail
          </a>
        </div>
      </div>
      @empty
        <div style="grid-column: span 4; text-align: center; padding: 40px;">
          <p>Belum ada produk baru.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

<section class="features">
  <div class="container">
    <div class="section-title features-title">
      <h2>Keunggulan Sepatukuid</h2>
      <p>Alasan mengapa ribuan pelanggan memilih kami sebagai tempat belanja sneakers terpercaya</p>
    </div>
    
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fa-solid fa-truck-fast"></i>
        </div>
        <h3>Gratis Ongkir & Cepat</h3>
        <p>Gratis pengiriman ke seluruh Indonesia untuk semua pesanan di atas Rp 500.000 dengan estimasi 2-4 hari</p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fa-solid fa-shield-halved"></i>
        </div>
        <h3>Garansi 100% Original</h3>
        <p>Semua produk kami 100% original dengan garansi resmi dan sertifikat keaslian dari brand</p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fa-solid fa-rotate-left"></i>
        </div>
        <h3>Garansi 30 Hari</h3>
        <p>Garansi pengembalian 30 hari jika barang tidak sesuai atau ada cacat produksi</p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fa-solid fa-headset"></i>
        </div>
        <h3>Customer Service 24/7</h3>
        <p>Tim customer service kami siap membantu 24 jam sehari, 7 hari seminggu via chat, telepon, atau email</p>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIAL PUTIH -->
<section class="testimonial-section">
  <div class="container">
    <div class="section-title">
      <h2>Testimonial Pelanggan</h2>
      <p>Lihat apa yang dikatakan oleh pelanggan setia kami tentang pengalaman berbelanja di Sepatukuid</p>
    </div>
    
    <div class="testimonial-grid">
      <div class="testimonial-card">
        <div class="testimonial-header">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" class="testimonial-avatar" alt="Customer">
          <div class="testimonial-info">
            <h4>Rizal A.</h4>
            <p>Jakarta • Pembeli Setia</p>
          </div>
        </div>
        <div class="testimonial-rating">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <p class="testimonial-text">"Sneakersnya ringan, nyaman, dan kualitasnya premium banget! Pengiriman super cepat dan packaging sangat rapi. Sudah beli 5 pasang di sini dan semuanya memuaskan. Recommended banget!"</p>
      </div>
      
      <div class="testimonial-card">
        <div class="testimonial-header">
          <img src="https://randomuser.me/api/portraits/women/44.jpg" class="testimonial-avatar" alt="Customer">
          <div class="testimonial-info">
            <h4>Dina P.</h4>
            <p>Bandung • Fashion Enthusiast</p>
          </div>
        </div>
        <div class="testimonial-rating">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star-half"></i>
        </div>
        <p class="testimonial-text">"Cocok banget dipakai seharian kerja, dari pagi sampai malam tetap nyaman. Desainnya simple tapi elegant, bikin outfit jadi lebih stylish. Sudah koleksi 3 pasang dari sini dan selalu puas!"</p>
      </div>
      
      <div class="testimonial-card">
        <div class="testimonial-header">
          <img src="https://randomuser.me/api/portraits/women/68.jpg" class="testimonial-avatar" alt="Customer">
          <div class="testimonial-info">
            <h4>Carolyn S.</h4>
            <p>Surabaya • Sneaker Collector</p>
          </div>
        </div>
        <div class="testimonial-rating">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <p class="testimonial-text">"Desainnya cakep banget! Kualitas bahan benar-benar premium dan harga sangat worth it untuk kualitas yang diberikan. Customer service responsif banget. Aku langsung jadi langganan tetap!"</p>
      </div>
    </div>
  </div>
</section>

<x-footer />
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Add hover effect to all cards
    const allCards = document.querySelectorAll('.product-card, .arrival-card, .model-card, .testimonial-card, .feature-card');
    allCards.forEach(card => {
      card.addEventListener('mouseenter', () => {
        card.style.transform = card.classList.contains('model-card') || card.classList.contains('product-card') || card.classList.contains('arrival-card') ? 
          'translateY(-15px) scale(1.03)' : 'translateY(-15px)';
      });
      card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0) scale(1)';
      });
    });
    
    // Smooth scroll for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
    
    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.btn');
    addToCartButtons.forEach(button => {
      if (button.textContent.includes('Beli Sekarang')) {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          const cartCount = document.querySelector('.cart-count');
          let count = parseInt(cartCount.textContent);
          cartCount.textContent = count + 1;
          
          // Animation feedback
          const originalHTML = this.innerHTML;
          this.innerHTML = '<i class="fa-solid fa-check"></i> Ditambahkan!';
          this.style.background = 'linear-gradient(135deg, #4CAF50 0%, #2ECC71 100%)';
          
          // Create floating notification
          const notification = document.createElement('div');
          notification.innerHTML = '<i class="fa-solid fa-check-circle"></i> Produk berhasil ditambahkan ke keranjang!';
          notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #4CAF50 0%, #2ECC71 100%);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            z-index: 10000;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: slideIn 0.3s ease;
            font-weight: 600;
          `;
          document.body.appendChild(notification);
          
          setTimeout(() => {
            this.innerHTML = originalHTML;
            this.style.background = '';
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
          }, 2000);
        });
      }
    });
    
    // View product functionality
    const viewButtons = document.querySelectorAll('.btn-view');
    viewButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Animation feedback
        const originalHTML = this.innerHTML;
        this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Loading...';
        
        setTimeout(() => {
          this.innerHTML = originalHTML;
          // In real app, this would navigate to product detail page
          window.location.href = '#';
        }, 1000);
      });
    });
    
    // Monthly offer button
    const offerButton = document.querySelector('.offer-btn');
    if (offerButton) {
      offerButton.addEventListener('click', function() {
        const originalHTML = this.innerHTML;
        this.innerHTML = '<i class="fa-solid fa-gift"></i> PROMO DICLAIM!';
        this.style.background = 'linear-gradient(135deg, #4CAF50 0%, #2ECC71 100%)';
        
        setTimeout(() => {
          this.innerHTML = originalHTML;
          this.style.background = 'white';
          alert('Selamat! Anda mendapatkan promo 90% off. Kode promo telah dikirim ke email Anda.');
        }, 2000);
      });
    }
    
    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
      @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
      }
      @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
      }
    `;
    document.head.appendChild(style);
  });
</script>

</body>
</html>