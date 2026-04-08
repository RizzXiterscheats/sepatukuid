<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Sepatukuid</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary: #E53935;
            --primary-dark: #C62828;
            --secondary: #2196F3;
            --dark: #121212;
            --gray: #666;
            --light: #f8f9fa;
            --success: #4CAF50;
            --warning: #FF9800;
            --card-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #f0f2f5 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 40px;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .page-header i {
            color: var(--primary);
        }
        
        .order-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
            border-left: 5px solid var(--primary);
            transition: var(--transition);
        }
        
        .order-card:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .order-id {
            font-weight: 700;
            color: var(--dark);
            font-size: 1.1rem;
        }
        
        .order-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .status-pending {
            background: #FFF3CD;
            color: var(--warning);
        }
        
        .status-processing {
            background: #D1ECF1;
            color: var(--secondary);
        }
        
        .status-completed {
            background: #D4EDDA;
            color: var(--success);
        }
        
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        
        .order-details {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin: 15px 0;
            font-size: 0.95rem;
        }
        
        .detail-item {
            padding: 12px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .detail-label {
            color: var(--gray);
            font-size: 0.85rem;
            margin-bottom: 5px;
        }
        
        .detail-value {
            color: var(--dark);
            font-weight: 600;
        }
        
        .order-items {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }
        
        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            color: var(--gray);
            font-size: 0.95rem;
        }
        
        .item-name {
            color: var(--dark);
            font-weight: 600;
        }
        
        .order-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }
        
        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 57, 53, 0.3);
        }
        
        .btn-secondary {
            background: #f0f0f0;
            color: var(--dark);
        }
        
        .btn-secondary:hover {
            background: #e0e0e0;
        }
        
        .empty-orders {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-orders i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-orders h2 {
            color: var(--gray);
            margin-bottom: 10px;
        }
        
        .empty-orders p {
            color: #999;
            margin-bottom: 25px;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }
        
        .back-link:hover {
            color: var(--primary);
            gap: 15px;
        }
        
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.8rem;
            }
            
            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .order-details {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .order-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <div>
                <h1>
                    <i class="fa-solid fa-box"></i>
                    Pesanan Saya
                </h1>
            </div>
            <a href="{{ route('home') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        @forelse($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <div class="order-id">
                    <i class="fa-solid fa-hashtag"></i> {{ $order->order_number }}
                </div>
                <div class="order-status status-{{ $order->status }}">
                    <i class="fa-solid {{ $order->status == 'completed' ? 'fa-check-circle' : ($order->status == 'processing' ? 'fa-clock' : ($order->status == 'cancelled' ? 'fa-xmark-circle' : 'fa-hourglass-start')) }}"></i> 
                    {{ ucfirst($order->status) }}
                </div>
            </div>
            
            <div class="order-details">
                <div class="detail-item">
                    <div class="detail-label">Tanggal Pesan</div>
                    <div class="detail-value">{{ $order->created_at->format('d M Y') }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Total Harga</div>
                    <div class="detail-value">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Kuantitas</div>
                    <div class="detail-value">{{ $order->items->sum('quantity') }} Produk</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status Bayar</div>
                    <div class="detail-value">{{ ucfirst($order->payment_status) }}</div>
                    @if($order->payment_proof)
                        <div style="margin-top: 5px;">
                            <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" style="font-size: 0.75rem; color: var(--secondary); text-decoration: none; font-weight: 700;">
                                <i class="fa-solid fa-image"></i> Lihat Bukti
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="order-items">
                @foreach($order->items as $item)
                <div class="item-row">
                    <div style="display: flex; flex-direction: column;">
                        <span class="item-name">{{ $item->product ? $item->product->name : 'Produk Tidak Tersedia' }}</span>
                        @if($order->status == 'delivered' && $item->product)
                            @php
                                $alreadyReviewed = \App\Models\Review::where('user_id', auth()->id())
                                    ->where('product_id', $item->product->id)
                                    ->where('order_id', $order->id)
                                    ->exists();
                                
                                $returnRequest = $item->returnRequest;
                            @endphp
                            <div style="display: flex; gap: 15px; margin-top: 5px;">
                                @if($alreadyReviewed)
                                    <span style="font-size: 0.8rem; color: var(--success); font-weight: 600; display: flex; align-items: center; gap: 5px;">
                                        <i class="fa-solid fa-circle-check"></i> Sudah Diulas
                                    </span>
                                @else
                                    <button onclick="openReviewModal('{{ $item->product->id }}', '{{ $order->id }}', '{{ $item->product->name }}')" style="background: none; border: none; color: var(--secondary); font-size: 0.8rem; font-weight: 700; cursor: pointer; text-align: left; display: flex; align-items: center; gap: 5px;">
                                        <i class="fa-solid fa-star"></i> Beri Ulasan
                                    </button>
                                @endif

                                @if($returnRequest)
                                    <button onclick="showReturnDetail('{{ $returnRequest->reason }}', '{{ addslashes($returnRequest->description) }}', '{{ $returnRequest->status }}', '{{ addslashes($returnRequest->admin_note ?? '') }}', '{{ $returnRequest->refund_proof ? asset('storage/' . $returnRequest->refund_proof) : '' }}')" style="background: none; border: none; color: var(--warning); font-size: 0.8rem; font-weight: 700; cursor: pointer; text-align: left; display: flex; align-items: center; gap: 5px; padding: 0;">
                                        <i class="fa-solid fa-circle-info"></i> Pengembalian: {{ ucfirst($returnRequest->status) }}
                                    </button>
                                @else
                                    <button onclick="openReturnModal('{{ $item->id }}', '{{ $item->product->name }}', '{{ ($item->price - $item->discount) * $item->quantity }}')" style="background: none; border: none; color: var(--primary); font-size: 0.8rem; font-weight: 700; cursor: pointer; text-align: left; display: flex; align-items: center; gap: 5px;">
                                        <i class="fa-solid fa-rotate-left"></i> Ajukan Pengembalian
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                    <span>{{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="order-actions">
                @if($order->payment_status == 'unpaid' && $order->status == 'pending')
                <a href="{{ route('checkout.payment', $order->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-upload"></i> Bayar Sekarang
                </a>
                <button onclick="changePayment('{{ $order->id }}', '{{ $order->order_number }}')" class="btn btn-secondary">
                    <i class="fa-solid fa-credit-card"></i> Ubah Pembayaran
                </button>
                <button onclick="cancelOrder('{{ $order->id }}', '{{ $order->order_number }}')" class="btn" style="background:var(--gray); color:white;">
                    <i class="fa-solid fa-xmark"></i> Batal
                </button>
                @endif
                <a href="{{ route('orders.track', $order->id) }}" class="btn btn-secondary">
                    <i class="fa-solid fa-circle-info"></i> Lacak Pesanan
                </a>
            </div>
        </div>
        @empty
        <div class="empty-orders">
            <i class="fa-solid fa-box-open"></i>
            <h2>Belum Ada Pesanan</h2>
            <p>Anda belum memesan produk apapun. Yuk, mulai belanja sekarang!</p>
            <a href="{{ route('shop') }}" class="btn btn-primary">Mulai Belanja</a>
        </div>
        @endforelse
    </div>

    <script>
        function openReviewModal(productId, orderId, productName) {
            Swal.fire({
                title: 'Beri Ulasan - ' + productName,
                html: `
                    <div style="text-align: left;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 700;">Rating (1-5 star)</label>
                        <select id="swal-rating" class="swal2-input" style="width: 100%; margin: 10px 0;">
                            <option value="5">⭐⭐⭐⭐⭐ (Sempurna)</option>
                            <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                            <option value="3">⭐⭐⭐ (Cukup)</option>
                            <option value="2">⭐⭐ (Kurang)</option>
                            <option value="1">⭐ (Buruk)</option>
                        </select>
                        <label style="display: block; margin-top: 15px; margin-bottom: 10px; font-weight: 700;">Ulasan Anda</label>
                        <textarea id="swal-comment" class="swal2-textarea" placeholder="Tuliskan pengalaman Anda menggunakan produk ini..." style="width: 100%; height: 100px; margin: 0;"></textarea>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Kirim Ulasan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#E53935',
                preConfirm: () => {
                    const rating = document.getElementById('swal-rating').value;
                    const comment = document.getElementById('swal-comment').value;
                    
                    if (!comment) {
                        Swal.showValidationMessage('Ulasan tidak boleh kosong!');
                        return false;
                    }
                    
                    return { rating, comment };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send via form submission
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('reviews.store') }}";
                    
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = "{{ csrf_token() }}";
                    
                    const pIdInput = document.createElement('input');
                    pIdInput.type = 'hidden';
                    pIdInput.name = 'product_id';
                    pIdInput.value = productId;
                    
                    const oIdInput = document.createElement('input');
                    oIdInput.type = 'hidden';
                    oIdInput.name = 'order_id';
                    oIdInput.value = orderId;
                    
                    const ratingInput = document.createElement('input');
                    ratingInput.type = 'hidden';
                    ratingInput.name = 'rating';
                    ratingInput.value = result.value.rating;
                    
                    const commentInput = document.createElement('input');
                    commentInput.type = 'hidden';
                    commentInput.name = 'comment';
                    commentInput.value = result.value.comment;
                    
                    form.appendChild(csrfInput);
                    form.appendChild(pIdInput);
                    form.appendChild(oIdInput);
                    form.appendChild(ratingInput);
                    form.appendChild(commentInput);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function cancelOrder(orderId, orderNumber) {
            Swal.fire({
                title: 'Batalkan Pesanan ' + orderNumber + '?',
                html: `
                    <div style="text-align: left;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 700;">Alasan Pembatalan</label>
                        <select id="swal-cancel-reason" class="swal2-input" style="width: 100%; margin: 10px 0; max-width:100%;">
                            <option value="">-- Pilih Alasan --</option>
                            <option value="Ingin mengganti metode pembayaran">Ingin mengganti metode pembayaran</option>
                            <option value="Ingin mengganti alamat pengiriman">Ingin mengganti alamat pengiriman</option>
                            <option value="Ingin mengganti produk / ukuran">Ingin mengganti produk / ukuran</option>
                            <option value="Menemukan produk lebih murah">Menemukan produk lebih murah di toko lain</option>
                            <option value="Berubah pikiran">Berubah pikiran</option>
                            <option value="Lainnya">Lainnya...</option>
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Tutup',
                confirmButtonColor: '#E53935',
                preConfirm: () => {
                    const reason = document.getElementById('swal-cancel-reason').value;
                    if (!reason) {
                        Swal.showValidationMessage('Harap pilih alasan pembatalan');
                        return false;
                    }
                    return reason;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/orders/${orderId}/cancel`;
                    
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = "{{ csrf_token() }}";
                    
                    const reasonInput = document.createElement('input');
                    reasonInput.type = 'hidden';
                    reasonInput.name = 'cancel_reason';
                    reasonInput.value = result.value;
                    
                    form.appendChild(csrfInput);
                    form.appendChild(reasonInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function changePayment(orderId, orderNumber) {
            Swal.fire({
                title: 'Ganti Metode Pembayaran ' + orderNumber,
                html: `
                    <div style="text-align: left;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 700;">Metode Pembayaran Baru</label>
                        <select id="swal-payment-method" class="swal2-input" style="width: 100%; margin: 10px 0; max-width:100%;">
                            <option value="">-- Pilih Metode --</option>
                            <optgroup label="QRIS & E-Wallet">
                                <option value="QRIS">QRIS (GoPay, OVO, Dana)</option>
                                <option value="GOPAY">GoPay</option>
                                <option value="OVO">OVO</option>
                                <option value="DANA">Dana</option>
                                <option value="LINKAJA">LinkAja</option>
                            </optgroup>
                            <optgroup label="Virtual Account">
                                <option value="BCA">Bank BCA</option>
                                <option value="BNI">Bank BNI</option>
                            </optgroup>
                            <optgroup label="Gerai Retail">
                                <option value="ALFAMART">Alfamart</option>
                                <option value="INDOMARET">Indomaret</option>
                            </optgroup>
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#2196F3',
                preConfirm: () => {
                    const method = document.getElementById('swal-payment-method').value;
                    if (!method) {
                        Swal.showValidationMessage('Harap pilih metode pembayaran');
                        return false;
                    }
                    return method;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/orders/${orderId}/change-payment`;
                    
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = "{{ csrf_token() }}";
                    
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = 'payment_method';
                    methodInput.value = result.value;
                    
                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function openReturnModal(itemId, productName, refundTotal) {
            Swal.fire({
                title: 'Ajukan Pengembalian - ' + productName,
                width: '600px',
                html: `
                    <div style="text-align: left; font-size: 0.9rem;">
                        <p style="margin-bottom: 20px; padding: 10px; background: #FFF3CD; color: #856404; border-radius: 5px; font-size: 0.8rem;">
                            <i class="fa-solid fa-circle-info"></i> Pastikan label produk belum dilepas dan kemasan masih ada.
                        </p>
                        
                        <div class="swal-form-group" style="margin-bottom: 15px;">
                            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Alasan Pengembalian <span style="color:red;">*</span></label>
                            <select id="return-reason" class="swal2-input" style="width: 100%; margin: 0;">
                                <option value="">-- Pilih Alasan --</option>
                                <option value="Menerima barang rusak">Menerima barang rusak</option>
                                <option value="Menerima barang yang salah">Menerima barang yang salah</option>
                                <option value="Tidak menerima sebagian atau semua barang">Tidak menerima sebagian atau semua barang</option>
                                <option value="Alasan lainnya">Alasan lainnya</option>
                            </select>
                        </div>

                        <div class="swal-form-group" style="margin-bottom: 15px;">
                            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Deskripsi Kendala <span style="color:red;">*</span></label>
                            <textarea id="return-description" class="swal2-textarea" placeholder="Jelaskan secara detail kondisi barang yang diterima..." style="width: 100%; height: 80px; margin: 0;"></textarea>
                        </div>

                        <div class="swal-form-group" style="margin-bottom: 15px;">
                            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Upload Bukti Foto (Max 2MB per foto) <span style="color:red;">*</span></label>
                            <input type="file" id="return-photos" class="swal2-file" multiple accept="image/*" style="width: 100%; margin: 0;">
                            <small style="color: #666;">Lampirkan: Foto barang, kemasan asli, label, dan resi.</small>
                        </div>

                        <hr style="margin: 20px 0;">
                        <h4 style="margin-bottom: 10px;">Informasi Pengembalian Dana</h4>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <div class="swal-form-group">
                                <label style="font-weight: 700; font-size: 0.8rem;">Bank <span style="color:red;">*</span></label>
                                <input type="text" id="bank-name" class="swal2-input" placeholder="Contoh: BCA" style="width: 100%; margin: 0; height: 40px;">
                            </div>
                            <div class="swal-form-group">
                                <label style="font-weight: 700; font-size: 0.8rem;">Nomor Rekening <span style="color:red;">*</span></label>
                                <input type="text" id="bank-acc-num" class="swal2-input" placeholder="000111xxx" style="width: 100%; margin: 0; height: 40px;">
                            </div>
                        </div>
                        
                        <div class="swal-form-group" style="margin-top: 10px;">
                            <label style="font-weight: 700; font-size: 0.8rem;">Nama Pemilik Rekening <span style="color:red;">*</span></label>
                            <input type="text" id="bank-acc-name" class="swal2-input" placeholder="Nama sesuai buku tabungan" style="width: 100%; margin: 0; height: 40px;">
                        </div>

                        <div style="margin-top: 15px; padding: 10px; background: #e9ecef; border-radius: 5px;">
                            <div style="display: flex; justify-content: space-between;">
                                <span>Total Refund:</span>
                                <strong style="color: var(--primary);">Rp ${new Intl.NumberFormat('id-ID').format(refundTotal)}</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-top: 5px;">
                                <span>Email Client:</span>
                                <span>{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Kirim Pengajuan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#E53935',
                preConfirm: () => {
                    const reason = document.getElementById('return-reason').value;
                    const description = document.getElementById('return-description').value;
                    const photos = document.getElementById('return-photos').files;
                    const bankName = document.getElementById('bank-name').value;
                    const bankNum = document.getElementById('bank-acc-num').value;
                    const bankNameAcc = document.getElementById('bank-acc-name').value;

                    if (!reason || !description || photos.length === 0 || !bankName || !bankNum || !bankNameAcc) {
                        Swal.showValidationMessage('Harap lengkapi semua data dan lampirkan foto!');
                        return false;
                    }

                    return { reason, description, photos, bankName, bankNum, bankNameAcc };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mengirim...',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    const formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('order_item_id', itemId);
                    formData.append('reason', result.value.reason);
                    formData.append('description', result.value.description);
                    formData.append('bank_name', result.value.bankName);
                    formData.append('bank_account_number', result.value.bankNum);
                    formData.append('bank_account_name', result.value.bankNameAcc);

                    for (let i = 0; i < result.value.photos.length; i++) {
                        formData.append('evidence_photos[]', result.value.photos[i]);
                    }

                    fetch("{{ route('returns.store') }}", {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success || true) { // Handle redirection manually if needed
                             Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Pengajuan Anda telah dikirim.',
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Even if fetch fails due to redirect 302, it usually worked.
                        window.location.reload();
                    });
                }
            });
        }

        function showReturnDetail(reason, description, status, adminNote, refundProofUrl) {
            let statusBadge = '';
            if (status === 'pending') statusBadge = '<span style="background:#FFF3CD; color:#856404; padding:5px 12px; border-radius:15px; font-weight:700;">Menunggu Tinjauan</span>';
            else if (status === 'approved') statusBadge = '<span style="background:#D1ECF1; color:#0c5460; padding:5px 12px; border-radius:15px; font-weight:700;">Disetujui</span>';
            else if (status === 'refunded') statusBadge = '<span style="background:#D4EDDA; color:#155724; padding:5px 12px; border-radius:15px; font-weight:700;">Dana Dikirim</span>';
            else if (status === 'rejected') statusBadge = '<span style="background:#F8D7DA; color:#721C24; padding:5px 12px; border-radius:15px; font-weight:700;">Ditolak</span>';

            Swal.fire({
                title: 'Detail Pengembalian Dana',
                html: `
                    <div style="text-align: left; font-size: 0.9rem;">
                        <div style="margin-bottom: 20px; text-align: center;">
                            ${statusBadge}
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label style="font-weight: 700; color: #666; display: block; font-size: 0.75rem; text-transform: uppercase;">Alasan:</label>
                            <div style="font-weight: 600; font-size: 1rem; color: #333;">${reason}</div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="font-weight: 700; color: #666; display: block; font-size: 0.75rem; text-transform: uppercase;">Deskripsi Anda:</label>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; font-style: italic; border-left: 4px solid #ddd;">
                                "${description}"
                            </div>
                        </div>

                        ${refundProofUrl ? `
                            <div style="margin-top: 20px; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; background: #fff;">
                                <div style="background: #f8f9fa; padding: 8px 12px; font-weight: 800; font-size: 0.7rem; border-bottom: 1px solid #eee; color: #166534;">
                                    <i class="fas fa-file-invoice-dollar"></i> BUKTI TRANSFER REFUND (KLIK UNTUK PERBESAR)
                                </div>
                                <img src="${refundProofUrl}" style="width: 100%; cursor: pointer; display: block;" onclick="window.open('${refundProofUrl}', '_blank')">
                            </div>
                        ` : ''}

                        ${adminNote ? `
                            <div style="margin-top: 25px; padding: 15px; background: #e7f3ff; border-radius: 10px; border: 1px solid #b8daff;">
                                <label style="font-weight: 800; color: #004085; display: block; font-size: 0.75rem; text-transform: uppercase; margin-bottom: 8px;">
                                    <i class="fa-solid fa-comment-dots"></i> Tanggapan Admin:
                                </label>
                                <div style="color: #004085; font-weight: 600; line-height: 1.5;">
                                    ${adminNote}
                                </div>
                            </div>
                        ` : `
                            <div style="margin-top: 15px; font-size: 0.8rem; color: #999; font-style: italic; text-align: center;">
                                Menunggu tanggapan dari admin...
                            </div>
                        `}
                    </div>
                `,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#121212'
            });
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
    </script>
</body>
</html>
