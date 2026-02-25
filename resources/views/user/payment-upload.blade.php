<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Konfirmasi Pembayaran - Sepatukuid</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>
    :root {
      --primary: #E53935;
      --primary-dark: #C62828;
      --dark: #121212;
      --light: #f8f9fa;
      --success: #4CAF50;
      --border-radius: 20px;
      --transition: all 0.3s ease;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f4f7f6;
      color: var(--dark);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      padding: 20px;
    }

    .upload-container {
      background: white;
      max-width: 500px;
      width: 100%;
      padding: 40px;
      border-radius: var(--border-radius);
      box-shadow: 0 20px 50px rgba(0,0,0,0.1);
      text-align: center;
    }

    .icon-box {
      width: 80px;
      height: 80px;
      background: rgba(229, 57, 53, 0.1);
      color: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      margin: 0 auto 25px;
    }

    h1 {
      font-size: 1.8rem;
      font-weight: 800;
      margin-bottom: 10px;
    }

    p {
      color: #666;
      margin-bottom: 30px;
      line-height: 1.6;
    }

    .order-info {
      background: var(--light);
      padding: 20px;
      border-radius: 15px;
      margin-bottom: 30px;
      text-align: left;
    }

    .order-info div {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      font-size: 0.95rem;
    }

    .order-info div:last-child {
      margin-bottom: 0;
      font-weight: 700;
      color: var(--primary);
    }

    .upload-area {
      border: 2px dashed #ddd;
      padding: 30px;
      border-radius: 15px;
      cursor: pointer;
      transition: var(--transition);
      margin-bottom: 30px;
      position: relative;
    }

    .upload-area:hover {
      border-color: var(--primary);
      background: rgba(229, 57, 53, 0.02);
    }

    .upload-area input {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: pointer;
    }

    .upload-area i {
      font-size: 2rem;
      color: #aaa;
      margin-bottom: 10px;
    }

    .upload-area span {
      display: block;
      color: #999;
      font-size: 0.9rem;
    }

    .preview-img {
      max-width: 100%;
      max-height: 200px;
      border-radius: 10px;
      margin-top: 20px;
      display: none;
    }

    .btn-submit {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      width: 100%;
      padding: 16px;
      border: none;
      border-radius: 50px;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: 0 10px 20px rgba(229, 57, 53, 0.3);
    }

    .btn-submit:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 30px rgba(229, 57, 53, 0.4);
    }

    .btn-skip:hover {
      color: var(--dark);
    }

    /* INSTRUCTION CARDS */
    .instruction-card {
      background: #fff;
      border: 1px solid #eee;
      border-radius: 15px;
      padding: 20px;
      margin-bottom: 25px;
      text-align: left;
    }

    .instruction-card h4 {
      font-size: 1rem;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--dark);
    }

    .qris-container {
      text-align: center;
      margin: 15px 0;
    }

    .qris-code {
      width: 200px;
      height: 200px;
      margin: 0 auto;
      background: #eee;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      border: 1px solid #ddd;
    }

    .va-number {
      font-family: 'Courier New', Courier, monospace;
      font-size: 1.2rem;
      font-weight: 800;
      color: var(--primary);
      background: #fdf2f2;
      padding: 10px;
      border-radius: 8px;
      display: block;
      margin: 10px 0;
      text-align: center;
      letter-spacing: 2px;
    }

    .instruction-steps {
      padding-left: 20px;
      font-size: 0.9rem;
      color: #666;
    }

    .instruction-steps li {
      margin-bottom: 8px;
    }
</style>
</head>
<body>

<div class="upload-container">
  <div class="icon-box">
    <i class="fa-solid fa-receipt"></i>
  </div>
  
  <h1>Verifikasi Pembayaran</h1>
  <p>Terima kasih atas pesanan Anda! Silakan upload struk atau bukti transfer untuk mempercepat proses verifikasi.</p>

  <div class="order-info">
    <div>
      <span>No. Pesanan:</span>
      <span>{{ $order->order_number }}</span>
    </div>
    <div>
      <span>Metode:</span>
      <span style="font-weight: 800; color: var(--dark);">{{ $order->payment_method }}</span>
    </div>
    <div>
      <span>Total Bayar:</span>
      <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
    </div>
  </div>

  @if($order->payment_method == 'QRIS')
    <div class="instruction-card">
      <h4><i class="fa-solid fa-qrcode"></i> Scan QRIS</h4>
      <div class="qris-container">
        <div class="qris-code" style="height: auto; padding: 15px; background: white; border: 2px solid #eee;">
          <img src="{{ asset('img/qris.png') }}" alt="QRIS" onerror="this.src='https://rizzxiterscheats.my.id/qr.png';" style="max-width: 100%; height: auto; display: block; filter: contrast(1.1) brightness(1.1);">
        </div>
        <p style="font-size: 0.8rem; margin-top: 10px;">Scan dengan GoPay, OVO, Dana, ShopeePay, atau LinkAja</p>
      </div>
      <ul class="instruction-steps">
        <li>Buka aplikasi pembayaran pilihan Anda</li>
        <li>Pilih menu "Scan" atau "Pay"</li>
        <li>Scan kode QR di atas</li>
        <li>Selesaikan pembayaran dan simpan buktinya</li>
      </ul>
    </div>
  @elseif(in_array($order->payment_method, ['GOPAY', 'OVO', 'DANA', 'SHOPEEPAY', 'LINKAJA']))
    <div class="instruction-card">
      <h4><i class="fa-solid fa-mobile-screen"></i> Pembayaran {{ $order->payment_method }}</h4>
      <p style="font-size: 0.9rem;">Silakan arahkan pembayaran ke nomor berikut:</p>
      <span class="va-number">0812-3456-7890</span>
      <p style="font-size: 0.8rem; color: var(--gray);">Atas Nama: <strong>SEPATUKUID OFFICIAL</strong></p>
      <ul class="instruction-steps" style="margin-top:15px;">
        <li>Transfer nominal yang sesuai</li>
        <li>Pastikan nama penerima benar</li>
        <li>Selesaikan transaksi di aplikasi Anda</li>
      </ul>
    </div>
  @elseif(in_array($order->payment_method, ['ALFAMART', 'INDOMARET']))
    <div class="instruction-card">
      <h4><i class="fa-solid fa-shop"></i> Pembayaran di {{ $order->payment_method == 'ALFAMART' ? 'Alfamart' : 'Indomaret' }}</h4>
      <p style="font-size: 0.9rem;">Tunjukkan kode bayar berikut ke kasir:</p>
      <span class="va-number">SPK-ORD-{{ $order->id + 1000 }}</span>
      <p style="font-size: 0.8rem; color: var(--gray);">Sebutkan untuk pembayaran: <strong>SEPATUKUID</strong></p>
      <ul class="instruction-steps" style="margin-top:15px;">
        <li>Kunjungi gerai terdekat</li>
        <li>Informasikan kepada kasir untuk bayar SEPATUKUID</li>
        <li>Tunjukkan nomor di atas</li>
        <li>Bayar sesuai nominal dan simpan struknya</li>
      </ul>
    </div>
  @else
    <div class="instruction-card">
      <h4><i class="fa-solid fa-building-columns"></i> Virtual Account / Transfer {{ $order->payment_method }}</h4>
      <p style="font-size: 0.9rem;">Detail Rekening {{ $order->payment_method }}:</p>
      <span class="va-number">8801 0812 3456 7890</span>
      <p style="font-size: 0.8rem; color: var(--gray);">Atas Nama: <strong>SEPATUKUID OFFICIAL</strong></p>
      <ul class="instruction-steps" style="margin-top:15px;">
        <li>Gunakan ATM atau Mobile Banking</li>
        <li>Pilih Menu Transfer / Virtual Account</li>
        <li>Masukkan nomor di atas</li>
        <li>Simpan struk pembayaran Anda</li>
      </ul>
    </div>
  @endif

  <form action="{{ route('checkout.payment.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="upload-area" id="drop-area">
      <i class="fa-solid fa-cloud-arrow-up"></i>
      <span id="file-label">Klik atau drop file di sini</span>
      <input type="file" name="payment_proof" id="file-input" accept="image/*" required onchange="previewFile()">
      <img id="preview" class="preview-img" src="" alt="Preview">
    </div>

    <button type="submit" class="btn-submit">
      <i class="fa-solid fa-check-circle"></i> KIRIM KONFIRMASI
    </button>
  </form>

  <a href="{{ route('orders') }}" class="btn-skip">Nanti Saja (Cek Pesanan)</a>
</div>

<script>
  function previewFile() {
    const preview = document.getElementById('preview');
    const file = document.getElementById('file-input').files[0];
    const label = document.getElementById('file-label');
    const reader = new FileReader();

    reader.onloadend = function () {
      preview.src = reader.result;
      preview.style.display = 'block';
      label.innerText = file.name;
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
      preview.style.display = 'none';
      label.innerText = "Klik atau drop file di sini";
    }
  }
</script>

</body>
</html>
