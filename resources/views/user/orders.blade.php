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
                    <i class="fa-solid {{ $order->status == 'completed' ? 'fa-check-circle' : ($order->status == 'processing' ? 'fa-clock' : 'fa-hourglass-start') }}"></i> 
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
                    <span class="item-name">{{ $item->product ? $item->product->name : 'Produk Tidak Tersedia' }}</span>
                    <span>{{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="order-actions">
                @if($order->payment_status == 'unpaid')
                <a href="{{ route('checkout.payment', $order->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-upload"></i> Upload Bukti Pembayaran
                </a>
                @endif
                <button class="btn btn-secondary">
                    <i class="fa-solid fa-circle-info"></i> Lacak Pesanan
                </button>
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
</body>
</html>
