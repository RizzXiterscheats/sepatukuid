<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sepatukuid - About Us</title>

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
      padding: 16px 36px;
      border: none;
      font-weight: 700;
      cursor: pointer;
      border-radius: 50px;
      transition: var(--transition);
      display: inline-flex;
      align-items: center;
      gap: 12px;
      font-size: 16px;
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

    /* NAVBAR */
    header {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(20px);
      position: sticky;
      top: 0;
      width: 100%;
      z-index: 1000;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08);
      padding: 18px 0;
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
      gap: 15px;
      font-weight: 900;
      color: var(--primary);
      font-size: 1.8rem;
      letter-spacing: -0.5px;
    }

    .logo i {
      font-size: 2.2rem;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .menu {
      display: flex;
      gap: 45px;
      font-weight: 600;
    }

    .menu a {
      position: relative;
      padding: 10px 0;
      font-size: 1.1rem;
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
      gap: 30px;
    }

    .nav-icons {
      display: flex;
      gap: 25px;
      font-size: 1.3rem;
    }

    .nav-icons i {
      cursor: pointer;
      padding: 12px;
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
      font-size: 0.8rem;
      min-width: 20px;
      height: 20px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      box-shadow: 0 3px 10px rgba(229, 57, 53, 0.3);
    }

    /* ABOUT HERO */
    .about-hero {
      padding: 140px 0 80px;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .about-hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 70%;
      height: 200%;
      background: radial-gradient(circle, rgba(229, 57, 53, 0.05) 0%, transparent 70%);
      transform: rotate(30deg);
    }

    .about-hero h1 {
      font-size: 4rem;
      font-weight: 900;
      margin-bottom: 20px;
      background: linear-gradient(45deg, var(--dark), var(--gray-dark), var(--primary));
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -1px;
    }

    .about-hero p {
      font-size: 1.3rem;
      color: var(--gray);
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.8;
    }

    /* OUR STORY */
    .story-section {
      padding: 100px 0;
      background: white;
    }

    .story-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
    }

    .story-content h2 {
      font-size: 2.5rem;
      font-weight: 900;
      margin-bottom: 30px;
      background: linear-gradient(45deg, var(--dark), var(--primary));
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .story-content p {
      color: var(--gray);
      font-size: 1.1rem;
      line-height: 1.8;
      margin-bottom: 25px;
    }

    .story-content .highlight {
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--primary);
      border-left: 4px solid var(--primary);
      padding-left: 20px;
      margin: 30px 0;
    }

    .story-image {
      position: relative;
      border-radius: 30px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transform: perspective(1500px) rotateY(5deg);
      transition: var(--transition);
    }

    .story-image:hover {
      transform: perspective(1500px) rotateY(0deg);
      box-shadow: var(--card-shadow-hover);
    }

    .story-image img {
      width: 100%;
      height: auto;
      display: block;
    }

    .story-image::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, rgba(229, 57, 53, 0.1), transparent);
      z-index: 1;
    }

    /* MISSION VISION */
    .mission-section {
      padding: 80px 0;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
    }

    .mission-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 40px;
    }

    .mission-card {
      background: white;
      border-radius: 30px;
      padding: 50px 40px;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }

    .mission-card:hover {
      transform: translateY(-15px);
      box-shadow: var(--card-shadow-hover);
    }

    .mission-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    .mission-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, rgba(229, 57, 53, 0.1), rgba(33, 150, 243, 0.1));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 30px;
      font-size: 2.2rem;
      color: var(--primary);
    }

    .mission-card h3 {
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 25px;
      color: var(--dark);
    }

    .mission-card p {
      color: var(--gray);
      font-size: 1.1rem;
      line-height: 1.8;
      margin-bottom: 20px;
    }

    .mission-list {
      list-style: none;
    }

    .mission-list li {
      padding: 12px 0;
      color: var(--gray-dark);
      display: flex;
      align-items: center;
      gap: 15px;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .mission-list li:last-child {
      border-bottom: none;
    }

    .mission-list i {
      color: var(--primary);
      font-size: 1.2rem;
    }

    /* VALUES SECTION */
    .values-section {
      padding: 100px 0;
      background: white;
    }

    .section-title {
      text-align: center;
      margin-bottom: 70px;
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

    .values-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
    }

    .value-card {
      text-align: center;
      padding: 40px 30px;
      background: white;
      border-radius: 25px;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .value-card:hover {
      transform: translateY(-15px);
      box-shadow: var(--card-shadow-hover);
    }

    .value-icon {
      width: 90px;
      height: 90px;
      background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 25px;
      color: white;
      font-size: 2.2rem;
    }

    .value-card h3 {
      font-size: 1.5rem;
      font-weight: 800;
      margin-bottom: 15px;
    }

    .value-card p {
      color: var(--gray);
      line-height: 1.7;
    }

    /* TEAM SECTION */
    .team-section {
      padding: 100px 0;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
    }

    .team-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 35px;
    }

    .team-card {
      background: white;
      border-radius: 25px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
    }

    .team-card:hover {
      transform: translateY(-15px);
      box-shadow: var(--card-shadow-hover);
    }

    .team-image {
      height: 300px;
      width: 100%;
      object-fit: cover;
      transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .team-card:hover .team-image {
      transform: scale(1.05);
    }

    .team-info {
      padding: 30px;
      text-align: center;
    }

    .team-info h3 {
      font-size: 1.5rem;
      font-weight: 800;
      margin-bottom: 10px;
    }

    .team-info .position {
      color: var(--primary);
      font-weight: 700;
      margin-bottom: 15px;
      font-size: 1rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .team-info p {
      color: var(--gray);
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .team-social {
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .team-social a {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--light);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: var(--transition);
      color: var(--gray-dark);
    }

    .team-social a:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-3px);
    }

    /* STATS SECTION */
    .stats-section {
      padding: 80px 0;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      position: relative;
      overflow: hidden;
    }

    .stats-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?q=80&w=1200') center/cover;
      opacity: 0.1;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 40px;
      position: relative;
      z-index: 2;
    }

    .stat-item {
      text-align: center;
    }

    .stat-number {
      font-size: 3.5rem;
      font-weight: 900;
      margin-bottom: 10px;
      line-height: 1;
    }

    .stat-label {
      font-size: 1.2rem;
      opacity: 0.9;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* TIMELINE */
    .timeline-section {
      padding: 100px 0;
      background: white;
    }

    .timeline {
      max-width: 800px;
      margin: 0 auto;
      position: relative;
    }

    .timeline::before {
      content: '';
      position: absolute;
      top: 0;
      bottom: 0;
      left: 50%;
      width: 3px;
      background: linear-gradient(180deg, var(--primary), var(--secondary));
      transform: translateX(-50%);
    }

    .timeline-item {
      position: relative;
      margin-bottom: 50px;
    }

    .timeline-item:nth-child(odd) {
      padding-right: calc(50% + 30px);
    }

    .timeline-item:nth-child(even) {
      padding-left: calc(50% + 30px);
    }

    .timeline-dot {
      position: absolute;
      top: 0;
      left: 50%;
      width: 20px;
      height: 20px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border-radius: 50%;
      transform: translateX(-50%);
      z-index: 2;
      box-shadow: 0 0 0 5px rgba(229, 57, 53, 0.2);
    }

    .timeline-content {
      background: white;
      padding: 30px;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .timeline-content .year {
      display: inline-block;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      padding: 8px 20px;
      border-radius: 50px;
      font-weight: 700;
      font-size: 1rem;
      margin-bottom: 15px;
    }

    .timeline-content h3 {
      font-size: 1.5rem;
      font-weight: 800;
      margin-bottom: 10px;
    }

    .timeline-content p {
      color: var(--gray);
      line-height: 1.7;
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
      .values-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .team-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 992px) {
      .menu {
        display: none;
      }
      
      .about-hero h1 {
        font-size: 3rem;
      }
      
      .story-grid {
        grid-template-columns: 1fr;
        gap: 40px;
      }
      
      .mission-grid {
        grid-template-columns: 1fr;
      }
      
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .timeline::before {
        left: 30px;
      }
      
      .timeline-item:nth-child(odd),
      .timeline-item:nth-child(even) {
        padding-left: 80px;
        padding-right: 0;
      }
      
      .timeline-dot {
        left: 30px;
      }
    }

    @media (max-width: 768px) {
      .about-hero {
        padding: 120px 0 60px;
      }
      
      .about-hero h1 {
        font-size: 2.5rem;
      }
      
      .values-grid {
        grid-template-columns: 1fr;
      }
      
      .team-grid {
        grid-template-columns: 1fr;
      }
      
      .stats-grid {
        grid-template-columns: 1fr;
        gap: 30px;
      }
      
      .stat-number {
        font-size: 2.5rem;
      }
    }

    @media (max-width: 576px) {
      .about-hero h1 {
        font-size: 2rem;
      }
      
      .about-hero p {
        font-size: 1.1rem;
      }
      
      .story-content h2 {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>

<header>
  <div class="container">
    <div class="nav">
      <a href="/" class="logo">
        <i class="fa-solid fa-shoe-prints"></i>
        SEPATUKUID
      </a>
      
      <nav class="menu">
        <a href="/">Home</a>
        <a href="/shop">Shop</a>
        <a href="/products">Products</a>
        <a href="/about" class="active">About Us</a>
        <a href="/contact">Contact</a>
      </nav>
      
      <div class="nav-actions">
        <div class="nav-icons">
          <i class="fa-solid fa-magnifying-glass"></i>
          <div style="position: relative;">
            <i class="fa-regular fa-user"></i>
          </div>
          <div style="position: relative;">
            <a href="/cart" style="color: inherit;">
              <i class="fa-solid fa-cart-shopping"></i>
              <span class="cart-count">3</span>
            </a>
          </div>
        </div>
        
        <a href="/login" style="padding: 10px 20px; background: var(--primary); color: white; border-radius: 5px; text-decoration: none; font-weight: 600;">
          Login
        </a>
      </div>
    </div>
  </div>
</header>

<section class="about-hero">
  <div class="container">
    <h1>Tentang Sepatukuid</h1>
    <p>Lebih dari sekadar toko sneakers, kami adalah rumah bagi para pecinta sneakers yang mengutamakan kualitas, kenyamanan, dan gaya.</p>
  </div>
</section>

<section class="story-section">
  <div class="container">
    <div class="story-grid">
      <div class="story-content">
        <h2>Our Story</h2>
        <p>Sepatukuid lahir dari kecintaan yang mendalam terhadap dunia sneakers. Berawal dari sebuah mimpi sederhana pada tahun 2020, kami memulai perjalanan sebagai kolektor sneakers yang ingin berbagi passion dengan komunitas yang lebih luas.</p>
        <p>Kami percaya bahwa sepasang sneakers bukan hanya alas kaki, tetapi juga cerminan kepribadian, gaya hidup, dan semangat. Setiap langkah yang diambil adalah pernyataan diri.</p>
        <p class="highlight">"Kualitas adalah prioritas, kepuasan pelanggan adalah misi kami."</p>
        <p>Dari koleksi pribadi hingga menjadi salah satu destinasi sneakers terpercaya di Indonesia, perjalanan kami diwarnai dengan dedikasi dan komitmen untuk selalu menghadirkan yang terbaik.</p>
        <a href="/shop" class="btn" style="margin-top: 20px;">
          <i class="fa-solid fa-shop"></i>
          Mulai Belanja
        </a>
      </div>
      
      <div class="story-image">
        <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=800" alt="Our Story">
      </div>
    </div>
  </div>
</section>

<section class="mission-section">
  <div class="container">
    <div class="mission-grid">
      <div class="mission-card">
        <div class="mission-icon">
          <i class="fa-solid fa-bullseye"></i>
        </div>
        <h3>Our Mission</h3>
        <p>Menjadi platform sneakers terdepan yang menyediakan produk original berkualitas tinggi dengan pengalaman berbelanja yang tak terlupakan.</p>
        <ul class="mission-list">
          <li><i class="fa-solid fa-check"></i> Menyediakan 100% produk original</li>
          <li><i class="fa-solid fa-check"></i> Memberikan harga terbaik untuk pelanggan</li>
          <li><i class="fa-solid fa-check"></i> Membangun komunitas sneakers yang solid</li>
          <li><i class="fa-solid fa-check"></i> Pelayanan cepat dan responsif</li>
        </ul>
      </div>
      
      <div class="mission-card">
        <div class="mission-icon">
          <i class="fa-solid fa-eye"></i>
        </div>
        <h3>Our Vision</h3>
        <p>Menjadi destinasi utama bagi pecinta sneakers di Indonesia dengan menghadirkan koleksi terlengkap dan pengalaman berbelanja terbaik.</p>
        <ul class="mission-list">
          <li><i class="fa-solid fa-check"></i> Ekspansi ke seluruh Indonesia</li>
          <li><i class="fa-solid fa-check"></i> Menjadi authorized retailer brand ternama</li>
          <li><i class="fa-solid fa-check"></i> Inovasi dalam layanan e-commerce</li>
          <li><i class="fa-solid fa-check"></i> Mendukung UKM lokal sneakers</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="stats-section">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item">
        <div class="stat-number">15K+</div>
        <div class="stat-label">Pelanggan</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">850+</div>
        <div class="stat-label">Produk</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">50+</div>
        <div class="stat-label">Brand</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">4.9★</div>
        <div class="stat-label">Rating</div>
      </div>
    </div>
  </div>
</section>

<section class="values-section">
  <div class="container">
    <div class="section-title">
      <h2>Our Core Values</h2>
      <p>Nilai-nilai yang menjadi fondasi setiap langkah kami</p>
    </div>
    
    <div class="values-grid">
      <div class="value-card">
        <div class="value-icon">
          <i class="fa-solid fa-medal"></i>
        </div>
        <h3>Originality</h3>
        <p>Kami hanya menjual produk 100% original dengan garansi keaslian. Tidak ada barang KW atau tiruan.</p>
      </div>
      
      <div class="value-card">
        <div class="value-icon">
          <i class="fa-solid fa-heart"></i>
        </div>
        <h3>Customer First</h3>
        <p>Kepuasan pelanggan adalah prioritas utama kami. Setiap masukan kami jadikan bahan evaluasi.</p>
      </div>
      
      <div class="value-card">
        <div class="value-icon">
          <i class="fa-solid fa-handshake"></i>
        </div>
        <h3>Integrity</h3>
        <p>Kejujuran dan transparansi dalam setiap transaksi. Tidak ada biaya tersembunyi.</p>
      </div>
      
      <div class="value-card">
        <div class="value-icon">
          <i class="fa-solid fa-rocket"></i>
        </div>
        <h3>Innovation</h3>
        <p>Selalu berinovasi untuk memberikan pengalaman berbelanja yang lebih baik.</p>
      </div>
    </div>
  </div>
</section>

<section class="timeline-section">
  <div class="container">
    <div class="section-title">
      <h2>Our Journey</h2>
      <p>Perjalanan Sepatukuid dari awal hingga sekarang</p>
    </div>
    
    <div class="timeline">
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-content">
          <span class="year">2020</span>
          <h3>Berdirinya Sepatukuid</h3>
          <p>Sepatukuid lahir sebagai toko sneakers online dengan koleksi terbatas dari koleksi pribadi founder.</p>
        </div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-content">
          <span class="year">2021</span>
          <h3>Ekspansi Koleksi</h3>
          <p>Menambah koleksi hingga 200+ produk dan bekerja sama dengan distributor resmi berbagai brand.</p>
        </div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-content">
          <span class="year">2022</span>
          <h3>10.000+ Pelanggan</h3>
          <p>Mencapai 10.000 pelanggan setia dengan rating kepuasan 4.8/5 dari ribuan review.</p>
        </div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-content">
          <span class="year">2023</span>
          <h3>Launching Website Baru</h3>
          <p>Meluncurkan website dengan tampilan modern dan fitur belanja yang lebih mudah.</p>
        </div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-content">
          <span class="year">2024</span>
          <h3>Authorized Retailer</h3>
          <p>Menjadi authorized retailer resmi untuk brand Nike, Adidas, Puma, dan New Balance.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="team-section">
  <div class="container">
    <div class="section-title">
      <h2>Meet Our Team</h2>
      <p>Tim profesional di balik Sepatukuid</p>
    </div>
    
    <div class="team-grid">
      <div class="team-card">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="team-image" alt="Founder">
        <div class="team-info">
          <h3>Rizky Pratama</h3>
          <div class="position">Founder & CEO</div>
          <p>Sneaker enthusiast sejak 2015, visioner di balik Sepatukuid dengan pengalaman di industri retail.</p>
          <div class="team-social">
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </div>
        </div>
      </div>
      
      <div class="team-card">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="team-image" alt="Operations">
        <div class="team-info">
          <h3>Sarah Wijaya</h3>
          <div class="position">Head of Operations</div>
          <p>Memastikan setiap pesanan diproses dengan cepat dan akurat. Ahli dalam manajemen inventory.</p>
          <div class="team-social">
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </div>
        </div>
      </div>
      
      <div class="team-card">
        <img src="https://randomuser.me/api/portraits/men/62.jpg" class="team-image" alt="Marketing">
        <div class="team-info">
          <h3>Andi Kurniawan</h3>
          <div class="position">Marketing Manager</div>
          <p>Kreatif dalam strategi marketing dan membangun komunitas sneakers yang solid.</p>
          <div class="team-social">
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </div>
        </div>
      </div>
      
      <div class="team-card">
        <img src="https://randomuser.me/api/portraits/women/68.jpg" class="team-image" alt="Customer Service">
        <div class="team-info">
          <h3>Diana Putri</h3>
          <div class="position">Customer Service Lead</div>
          <p>Siap membantu pelanggan 24/7 dengan senyuman dan solusi terbaik.</p>
          <div class="team-social">
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-column">
        <h4>Sepatukuid</h4>
        <p style="margin-bottom: 25px; font-size: 1rem; line-height: 1.7; color: #aaa;">
          Brand sneakers lokal dengan kualitas internasional. Komitmen kami memberikan pengalaman berbelanja terbaik dengan produk premium.
        </p>
        <div class="social-links">
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-tiktok"></i></a>
          <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
      
      <div class="footer-column">
        <h4>Quick Links</h4>
        <ul class="footer-links">
          <li><a href="/"><i class="fa-solid fa-chevron-right"></i> Home</a></li>
          <li><a href="/shop"><i class="fa-solid fa-chevron-right"></i> Shop</a></li>
          <li><a href="/products"><i class="fa-solid fa-chevron-right"></i> Products</a></li>
          <li><a href="/about"><i class="fa-solid fa-chevron-right"></i> About Us</a></li>
          <li><a href="/contact"><i class="fa-solid fa-chevron-right"></i> Contact</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Information</h4>
        <ul class="footer-links">
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Privacy Policy</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Terms & Conditions</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Shipping Info</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Returns Policy</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> FAQ</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Contact Us</h4>
        <p style="color: #aaa; margin-bottom: 15px;">
          <i class="fa-solid fa-envelope"></i> hello@sepatukuid.com<br>
          <i class="fa-solid fa-phone"></i> +62 812 3456 7890<br>
          <i class="fa-solid fa-location-dot"></i> Jakarta, Indonesia
        </p>
        <p style="color: #aaa;">
          <i class="fa-regular fa-clock"></i> Senin - Minggu<br>
          08:00 - 22:00 WIB
        </p>
      </div>
    </div>
    
    <div class="copyright">
      &copy; 2024 Sepatukuid. All rights reserved. | Designed for sneaker enthusiasts
    </div>
  </div>
</footer>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Animasi scroll untuk statistik
    const stats = document.querySelectorAll('.stat-number');
    
    // Value cards hover effect
    const valueCards = document.querySelectorAll('.value-card');
    valueCards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-15px)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
    
    // Team cards hover effect
    const teamCards = document.querySelectorAll('.team-card');
    teamCards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-15px)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
    
    // Mission cards hover effect
    const missionCards = document.querySelectorAll('.mission-card');
    missionCards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-15px)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
  });
</script>
</body>
</html>