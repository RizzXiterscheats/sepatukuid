<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-column">
        <h4>SepatuKuid</h4>
        <p style="margin-bottom: 25px; font-size: 1.1rem; line-height: 1.8; color: #aaa;">Brand sneakers lokal dengan kualitas internasional. Kami berkomitmen memberikan pengalaman berbelanja terbaik dengan produk premium dan pelayanan terbaik untuk Anda.</p>
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
          <li><a href="{{ route('products.index') }}?category=limited"><i class="fa-solid fa-chevron-right"></i> Sneakers Limited Edition</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Bantuan & Support</h4>
        <ul class="footer-links">
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> FAQ & Bantuan</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Info Pengiriman</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Returns & Exchanges</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Size Guide</a></li>
          <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Cara Pemesanan</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Hubungi Kami</h4>
        <ul class="footer-links">
          <li><a href="#"><i class="fa-solid fa-envelope"></i> hello@sepatukuid.com</a></li>
          <li><a href="#"><i class="fa-solid fa-phone"></i> +62 812 3456 7890</a></li>
          <li><a href="#"><i class="fa-solid fa-location-dot"></i> Jl. Sudirman No. 123, Jakarta</a></li>
          <li><a href="#"><i class="fa-solid fa-clock"></i> Senin - Minggu: 08:00 - 22:00 WIB</a></li>
        </ul>
      </div>
    </div>
    
    <div class="copyright">
      &copy; {{ date('Y') }} SepatuKuid. All rights reserved. | Designed with <i class="fa-solid fa-heart" style="color: var(--primary); margin: 0 5px;"></i> for sneaker lovers
    </div>
  </div>
</footer>
