<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sepatukuid - Hubungi Kami</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

  <style>
    /* Contact Specific Styles */
    .contact-hero {
      padding: 140px 0 80px;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .contact-hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 70%;
      height: 200%;
      background: radial-gradient(circle, rgba(229, 57, 53, 0.05) 0%, transparent 70%);
      transform: rotate(30deg);
    }

    .contact-hero h1 {
      font-size: 3rem;
      font-weight: 900;
      margin-bottom: 15px;
      background: linear-gradient(45deg, var(--dark), var(--gray-dark), var(--primary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -1px;
    }

    .contact-hero p {
      font-size: 1.1rem;
      color: var(--gray);
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.7;
    }

    /* CONTACT INFO SECTION */
    .contact-info-section {
      padding: 60px 0 30px;
      background: white;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 25px;
    }

    .info-card {
      background: white;
      border-radius: 20px;
      padding: 30px 25px;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      text-align: center;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .info-card:hover {
      transform: translateY(-10px);
      box-shadow: var(--card-shadow-hover);
    }

    .info-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, rgba(229, 57, 53, 0.1), rgba(33, 150, 243, 0.1));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 1.8rem;
      color: var(--primary);
    }

    .info-card h3 {
      font-size: 1.3rem;
      font-weight: 800;
      margin-bottom: 10px;
    }

    .info-card p {
      color: var(--gray);
      font-size: 0.95rem;
      line-height: 1.6;
    }

    .info-card a {
      color: var(--primary);
      font-weight: 600;
    }

    .info-card a:hover {
      text-decoration: underline;
    }

    /* CONTACT FORM SECTION */
    .contact-form-section {
      padding: 40px 0 80px;
      background: white;
    }

    .contact-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: start;
    }

    /* MAP */
    .map-container {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      height: 450px;
    }

    .map-container iframe {
      width: 100%;
      height: 100%;
      border: 0;
    }

    /* FORM */
    .form-container {
      background: white;
      border-radius: 20px;
      padding: 35px;
      box-shadow: var(--card-shadow);
    }

    .form-title {
      font-size: 1.5rem;
      font-weight: 800;
      margin-bottom: 25px;
      color: var(--dark);
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
      padding: 14px 18px;
      border: 2px solid var(--light);
      border-radius: 12px;
      font-size: 0.95rem;
      transition: var(--transition);
      font-family: 'Inter', sans-serif;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1);
    }

    .form-group textarea {
      min-height: 120px;
      resize: vertical;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }

    .btn-submit {
      width: 100%;
      justify-content: center;
      margin-top: 10px;
    }

    /* FAQ SECTION */
    .faq-section {
      padding: 60px 0 80px;
      background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
    }

    .faq-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 25px;
      max-width: 1000px;
      margin: 0 auto;
    }

    .faq-item {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .faq-item:hover {
      transform: translateY(-5px);
      box-shadow: var(--card-shadow-hover);
    }

    .faq-question {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 15px;
    }

    .faq-icon {
      width: 40px;
      height: 40px;
      background: rgba(229, 57, 53, 0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      font-size: 1.2rem;
    }

    .faq-question h3 {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--dark);
    }

    .faq-answer {
      color: var(--gray);
      font-size: 0.95rem;
      line-height: 1.6;
      padding-left: 55px;
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

    /* ALERT */
    .alert {
      padding: 15px 20px;
      border-radius: 10px;
      margin-bottom: 25px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .alert-success {
      background: #e8f5e9;
      color: #2e7d32;
      border: 1px solid #a5d6a7;
    }

    .alert-error {
      background: #ffebee;
      color: #c62828;
      border: 1px solid #ffcdd2;
    }

    /* RESPONSIVE */
    @media (max-width: 1200px) {
      .info-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 992px) {
      .menu {
        display: none;
      }
      
      .contact-container {
        grid-template-columns: 1fr;
      }
      
      .map-container {
        height: 350px;
      }
      
      .faq-grid {
        grid-template-columns: 1fr;
      }
      
      .footer-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .contact-hero h1 {
        font-size: 2.5rem;
      }
    }

    @media (max-width: 768px) {
      .contact-hero {
        padding: 100px 0 40px;
      }
      
      .contact-hero h1 {
        font-size: 2rem;
      }
      
      .info-grid {
        grid-template-columns: 1fr;
      }
      
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

<x-navbar />
<section class="contact-hero">
  <div class="container">
    <h1>Hubungi Kami</h1>
    <p>Punya pertanyaan atau butuh bantuan? Tim kami siap membantu Anda 24/7.</p>
  </div>
</section>

<section class="contact-info-section">
  <div class="container">
    <div class="info-grid">
      
      <div class="info-card">
        <div class="info-icon">
          <i class="fa-solid fa-map-location-dot"></i>
        </div>
        <h3>Alamat</h3>
        <p>Jl. Sudirman No. 123<br>Jakarta Pusat 10220<br>Indonesia</p>
      </div>
      
      <div class="info-card">
        <div class="info-icon">
          <i class="fa-solid fa-phone"></i>
        </div>
        <h3>Telepon</h3>
        <p><a href="tel:+6281234567890">+62 812 3456 7890</a><br><a href="tel:+6282198765432">+62 821 9876 5432</a></p>
        <p style="font-size: 0.8rem; color: var(--gray-light);">(Senin - Minggu, 08:00 - 22:00)</p>
      </div>
      
      <div class="info-card">
        <div class="info-icon">
          <i class="fa-solid fa-envelope"></i>
        </div>
        <h3>Email</h3>
        <p><a href="mailto:hello@sepatukuid.com">hello@sepatukuid.com</a><br><a href="mailto:support@sepatukuid.com">support@sepatukuid.com</a></p>
      </div>
      
      <div class="info-card">
        <div class="info-icon">
          <i class="fa-solid fa-clock"></i>
        </div>
        <h3>Jam Operasional</h3>
        <p>Senin - Jumat: 08:00 - 21:00<br>Sabtu - Minggu: 09:00 - 22:00<br>Hari Libur: Tetap Buka</p>
      </div>
      
    </div>
  </div>
</section>

<section class="contact-form-section">
  <div class="container">
    <div class="contact-container">
      
      <!-- Google Maps -->
      <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.536234213659!2d106.826951!3d-6.186564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f43c7b1a7b8d%3A0x3b9b7b7b7b7b7b7b!2sJl.%20Sudirman%20No.123%2C%20RT.1%2FRW.4%2C%20Karet%20Tengsin%2C%20Kec.%20Tanah%20Abang%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2010220!5e0!3m2!1sid!2sid!4v1623456789012!5m2!1sid!2sid" allowfullscreen="" loading="lazy"></iframe>
      </div>
      
      <!-- Contact Form -->
      <div class="form-container">
        <h3 class="form-title">Kirim Pesan</h3>
        
        <!-- Alert Sukses (contoh) -->
        <!--
        <div class="alert alert-success">
          <i class="fa-solid fa-circle-check"></i>
          Pesan Anda telah terkirim. Tim kami akan segera merespon.
        </div>
        -->
        
        <!-- Alert Error (contoh) -->
        <!--
        <div class="alert alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          Terjadi kesalahan. Silakan coba lagi.
        </div>
        -->
        
        <form method="POST" action="{{ route('contact.send') }}">
          @csrf
          
          <div class="form-row">
            <div class="form-group">
              <label for="name">Nama Lengkap</label>
              <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
            </div>
            
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Masukkan email" required>
            </div>
          </div>
          
          <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="tel" id="phone" name="phone" placeholder="Masukkan nomor telepon">
          </div>
          
          <div class="form-group">
            <label for="subject">Subjek</label>
            <select id="subject" name="subject" required>
              <option value="" disabled selected>Pilih subjek pesan</option>
              <option value="informasi">Informasi Produk</option>
              <option value="pesanan">Status Pesanan</option>
              <option value="pengiriman">Pengiriman</option>
              <option value="retur">Retur & Pengembalian</option>
              <option value="kerjasama">Kerjasama</option>
              <option value="lainnya">Lainnya</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="message">Pesan</label>
            <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini..." required></textarea>
          </div>
          
          <button type="submit" class="btn btn-submit">
            <i class="fa-solid fa-paper-plane"></i>
            Kirim Pesan
          </button>
        </form>
      </div>
      
    </div>
  </div>
</section>

<section class="faq-section">
  <div class="container">
    <div class="section-title">
      <h2>Pertanyaan Umum</h2>
      <p>Jawaban untuk pertanyaan yang sering diajukan</p>
    </div>
    
    <div class="faq-grid">
      
      <div class="faq-item">
        <div class="faq-question">
          <div class="faq-icon">
            <i class="fa-solid fa-question"></i>
          </div>
          <h3>Bagaimana cara memesan produk?</h3>
        </div>
        <div class="faq-answer">
          Anda dapat memesan produk dengan memilih produk yang diinginkan, klik "Tambah ke Keranjang", lalu lanjutkan ke halaman checkout dan ikuti instruksi pembayaran.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <div class="faq-icon">
            <i class="fa-solid fa-truck"></i>
          </div>
          <h3>Berapa lama waktu pengiriman?</h3>
        </div>
        <div class="faq-answer">
          Pengiriman ke Jakarta dan sekitarnya 1-2 hari kerja. Luar Jawa 3-5 hari kerja. Seluruh Indonesia 5-7 hari kerja.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <div class="faq-icon">
            <i class="fa-solid fa-rotate-left"></i>
          </div>
          <h3>Bagaimana kebijakan retur?</h3>
        </div>
        <div class="faq-answer">
          Kami menerima retur dalam 14 hari setelah barang diterima dengan syarat barang dalam kondisi baik, belum dipakai, dan label masih utuh.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <div class="faq-icon">
            <i class="fa-solid fa-credit-card"></i>
          </div>
          <h3>Metode pembayaran apa saja?</h3>
        </div>
        <div class="faq-answer">
          Kami menerima pembayaran melalui transfer bank (BCA, Mandiri, BNI, BRI), kartu kredit, GoPay, OVO, Dana, dan ShopeePay.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <div class="faq-icon">
            <i class="fa-solid fa-ruler"></i>
          </div>
          <h3>Bagaimana memilih ukuran yang tepat?</h3>
        </div>
        <div class="faq-answer">
          Setiap produk memiliki size chart yang bisa dilihat di halaman detail produk. Jika ragu, hubungi customer service kami.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <div class="faq-icon">
            <i class="fa-solid fa-tag"></i>
          </div>
          <h3>Apakah ada promo khusus?</h3>
        </div>
        <div class="faq-answer">
          Ikuti Instagram dan subscribe newsletter kami untuk mendapatkan informasi promo terbaru dan diskon spesial.
        </div>
      </div>
      
    </div>
  </div>
</section>

<x-footer />
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Form submission animation
    const contactForm = document.querySelector('form');
    if (contactForm) {
      contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
        submitBtn.disabled = true;
        
        // Simulasi pengiriman (untuk demo)
        setTimeout(() => {
          // Buat alert sukses
          const alertDiv = document.createElement('div');
          alertDiv.className = 'alert alert-success';
          alertDiv.innerHTML = '<i class="fa-solid fa-circle-check"></i> Pesan Anda telah terkirim. Tim kami akan segera merespon.';
          
          const formContainer = document.querySelector('.form-container');
          formContainer.insertBefore(alertDiv, contactForm);
          
          submitBtn.innerHTML = originalText;
          submitBtn.disabled = false;
          
          // Reset form
          contactForm.reset();
          
          // Hapus alert setelah 5 detik
          setTimeout(() => {
            alertDiv.remove();
          }, 5000);
        }, 1500);
      });
    }
    
    // FAQ item hover effect
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
      item.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
      });
      
      item.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
    
    // Info card hover effect
    const infoCards = document.querySelectorAll('.info-card');
    infoCards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
  });
</script>
</body>
</html>