@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->order_number)
@section('page-title', 'Detail Pesanan')
@section('page-description', 'Informasi Lengkap Transaksi #' . $order->order_number)

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    

    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    /* Top Actions */
    .top-toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    
    .btn-action { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: var(--radius-md); font-weight: 600; font-size: 14px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none; cursor: pointer; border: none; box-shadow: var(--shadow-sm); }
    .btn-back { background: var(--surface); color: var(--text-main); border: 1px solid var(--surface-200); }
    .btn-back:hover { background: var(--surface-50); transform: translateX(-4px); box-shadow: var(--shadow-md); }
    .btn-print { background: var(--primary-gradient); color: white; }
    .btn-print:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3); }

    /* Layout */
    .premium-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start; }
    
    /* Cards */
    .premium-card { background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); overflow: hidden; margin-bottom: 24px; border: 1px solid rgba(255,255,255,0.8); }
    .card-header { padding: 20px 24px; border-bottom: 1px solid var(--surface-100); display: flex; justify-content: space-between; align-items: center; background: rgba(248, 250, 252, 0.5); }
    .card-title { font-size: 16px; font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 10px; }
    .card-title-icon { display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: var(--radius-sm); background: var(--primary-light); color: #4f46e5; }
    .card-body { padding: 24px; }

    /* Quick Info Header Card */
    .order-header-card { background: var(--primary-gradient); color: white; padding: 32px; border-radius: var(--radius-lg); margin-bottom: 24px; position: relative; overflow: hidden; box-shadow: var(--shadow-lg); }
    .order-header-card::before { content: ''; position: absolute; top: 0; right: 0; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%); transform: translate(30%, -30%); }
    .order-status-large { font-size: 36px; font-weight: 800; line-height: 1.1; margin-bottom: 8px; }
    .order-meta { display: flex; gap: 24px; font-size: 14px; opacity: 0.9; margin-top: 20px; font-weight: 500; }
    .order-meta div { display: flex; align-items: center; gap: 8px; }

    /* Customer Details Grid */
    .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; }
    .info-group { display: flex; flex-direction: column; gap: 6px; }
    .info-label { font-size: 13px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
    .info-value { font-size: 15px; font-weight: 600; color: var(--text-main); line-height: 1.5; }
    
    .address-box { margin-top: 24px; padding: 16px; background: var(--surface-50); border-radius: var(--radius-md); border: 1px dashed var(--surface-200); }
    .notes-box { margin-top: 16px; padding: 16px 16px 16px 20px; background: var(--warning-light); border-radius: var(--radius-md); border-left: 4px solid var(--warning); color: #92400e; font-size: 14px; font-weight: 500; font-style: italic; }

    /* Products Table */
    .product-list { width: 100%; border-collapse: separate; border-spacing: 0; }
    .product-list th { padding: 0 16px 16px 16px; text-align: left; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; border-bottom: 2px solid var(--surface-100); }
    .product-list td { padding: 20px 16px; border-bottom: 1px solid var(--surface-50); vertical-align: middle; }
    .product-list tr:last-child td { border-bottom: none; }

    .product-item { display: flex; align-items: center; gap: 16px; }
    .product-img { width: 72px; height: 72px; border-radius: var(--radius-md); background: var(--surface-100); display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--text-muted); box-shadow: inset 0 2px 4px rgba(0,0,0,0.05); }
    .product-img img { width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-md); }
    .product-name { font-weight: 700; color: var(--text-main); font-size: 15px; margin-bottom: 6px; }
    .product-meta { font-size: 13px; color: var(--text-muted); font-weight: 500; display: inline-flex; align-items: center; gap: 6px; background: var(--surface-50); padding: 4px 8px; border-radius: 6px; }

    .price-col { text-align: right; }
    .price-original { font-size: 12px; text-decoration: line-through; color: var(--text-muted); margin-bottom: 2px; }
    .price-final { font-weight: 700; color: var(--text-main); font-size: 14px; }
    .subtotal-final { font-weight: 800; color: #4f46e5; font-size: 15px; }

    /* Summary Box */
    .summary-section { background: var(--surface-50); border-radius: var(--radius-lg); padding: 24px; border: 1px solid var(--surface-200); }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 14px; font-weight: 600; color: var(--text-muted); }
    .summary-row.total { border-top: 2px dashed var(--surface-200); padding-top: 20px; margin-top: 20px; margin-bottom: 0; font-size: 18px; color: var(--text-main); font-weight: 800; }
    .summary-row.total .value { color: #4f46e5; font-size: 24px; }

    /* Status Timelines */
    .timeline-item { display: flex; gap: 16px; margin-bottom: 24px; position: relative; }
    .timeline-item:last-child { margin-bottom: 0; }
    .timeline-item:not(:last-child)::after { content: ''; position: absolute; left: 19px; top: 40px; bottom: -24px; width: 2px; background: var(--surface-200); }
    
    .timeline-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; z-index: 1; flex-shrink: 0; }
    .icon-completed { background: var(--success-light); color: var(--success); }
    .icon-current { background: var(--primary-light); color: #4f46e5; box-shadow: 0 0 0 4px white, 0 0 0 6px var(--primary-light); }
    .icon-pending { background: var(--surface-100); color: var(--text-muted); }

    .timeline-content { flex: 1; padding-top: 8px; }
    .timeline-title { font-weight: 700; color: var(--text-main); font-size: 14px; margin-bottom: 4px; }
    .timeline-desc { font-size: 13px; color: var(--text-muted); font-weight: 500; }

    /* Forms */
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-size: 13px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
    .premium-select { width: 100%; padding: 14px 16px; border: 2px solid var(--surface-200); border-radius: var(--radius-md); background-color: var(--surface); background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-position: right 16px center; background-repeat: no-repeat; background-size: 16px; appearance: none; font-size: 14px; font-weight: 600; color: var(--text-main); transition: all 0.3s; box-shadow: var(--shadow-sm); cursor: pointer; }
    .premium-select:focus { outline: none; border-color: #818cf8; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    
    .btn-submit { width: 100%; background: var(--text-main); color: white; border: none; padding: 14px; border-radius: var(--radius-md); font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
    .btn-submit:hover { background: #000; transform: translateY(-2px); box-shadow: 0 8px 16px rgba(0,0,0,0.15); }
    .btn-submit-success { background: var(--success); }
    .btn-submit-success:hover { background: #059669; box-shadow: 0 8px 16px rgba(16,185,129,0.3); }

    /* Badges */
    .badge { padding: 8px 16px; border-radius: 30px; font-size: 13px; font-weight: 800; display: inline-flex; align-items: center; gap: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
    .badge-paid { background: var(--success-light); color: var(--success); }
    .badge-unpaid { background: var(--danger-light); color: var(--danger); }
    .badge-refunded { background: var(--surface-200); color: var(--text-muted); }
    
    /* Alerts */
    .premium-alert { display: flex; align-items: center; gap: 12px; padding: 16px 20px; border-radius: var(--radius-md); margin-bottom: 24px; font-weight: 600; font-size: 14px; animation: slideDown 0.4s ease-out; }
    .alert-success { background: var(--success-light); color: #065f46; border-left: 4px solid var(--success); }
    .alert-danger { background: var(--danger-light); color: #991b1b; border-left: 4px solid var(--danger); }

    /* Modal Proof */
    .proof-preview { margin-top: 15px; border-radius: var(--radius-md); border: 1px solid var(--surface-200); overflow: hidden; cursor: pointer; transition: transform 0.3s; position: relative; }
    .proof-preview:hover { transform: scale(1.02); }
    .proof-preview img { width: 100%; height: auto; display: block; }
    .proof-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; color: white; opacity: 0; transition: opacity 0.3s; }
    .proof-preview:hover .proof-overlay { opacity: 1; }

    @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    /* Print Styles */
    @media print {
        .sidebar, .top-toolbar, form, .btn-action { display: none !important; }
        .premium-grid { grid-template-columns: 1fr; }
        body { background: white; }
        .premium-card { box-shadow: none; border: 1px solid #ddd; }
        .order-header-card { background: white; color: black; border: 2px solid #000; }
    }
    
    @media (max-width: 1024px) { .premium-grid { grid-template-columns: 1fr; } }
    @media (max-width: 640px) { .info-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
    <div class="top-toolbar">
        <a href="{{ route('admin.pesanan.index') }}" class="btn-action btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
        <button onclick="window.print()" class="btn-action btn-print">
            <i class="fas fa-print"></i> Cetak Invoice
        </button>
    </div>

    @if(session('success'))
        <div class="premium-alert alert-success">
            <i class="fas fa-check-circle" style="font-size: 20px;"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif
    @if($errors->any())
        <div class="premium-alert alert-danger">
            <i class="fas fa-exclamation-triangle" style="font-size: 20px;"></i>
            <div>Terjadi kesalahan sistem saat memperbarui status pesanan.</div>
        </div>
    @endif

    <!-- Awesome Header -->
    <div class="order-header-card">
        <div style="font-size: 14px; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; margin-bottom: 8px; opacity: 0.8;">PESANAN</div>
        <div class="order-status-large">#{{ $order->order_number }}</div>
        
        <div class="order-meta">
            <div><i class="fas fa-calendar-alt"></i> {{ $order->created_at->format('d M Y, H:i') }}</div>
            <div><i class="fas fa-money-check-alt"></i> {{ strtoupper($order->payment_method ?? 'MANUAL') }}</div>
        </div>
    </div>

    <div class="premium-grid">
        <!-- Kolom Kiri: Detail & Produk -->
        <div>
            <!-- Info Pelanggan -->
            <div class="premium-card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-title-icon"><i class="fas fa-user"></i></div>
                        Informasi Pelanggan
                    </div>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-group">
                            <span class="info-label">Nama Pelanggan</span>
                            <span class="info-value">{{ $order->user->name ?? 'Guest User' }}</span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Alamat Email</span>
                            <span class="info-value">{{ $order->user->email ?? '-' }}</span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Nomor WhatsApp / Tlp</span>
                            <span class="info-value">{{ $order->user->phone ?? '-' }}</span>
                        </div>
                    </div>
                    
                    <div class="address-box">
                        <div class="info-label" style="margin-bottom: 8px; display: flex; align-items: center; gap: 6px;">
                            <i class="fas fa-map-marker-alt" style="color: #ef4444;"></i> ALAMAT PENGIRIMAN
                        </div>
                        <div class="info-value" style="font-weight: 500; line-height: 1.6;">
                            {!! nl2br(e($order->shipping_address ?? 'Alamat tidak tersedia')) !!}
                        </div>
                    </div>

                    @if($order->notes)
                    <div class="notes-box">
                        <i class="fas fa-quote-left" style="opacity: 0.5; margin-right: 8px;"></i>
                        {{ $order->notes }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- List Produk -->
            <div class="premium-card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-title-icon"><i class="fas fa-box-open"></i></div>
                        Daftar ProdukPesanan
                    </div>
                    <div style="font-size: 14px; font-weight: 700; color: var(--text-muted); padding: 4px 12px; background: var(--surface-100); border-radius: 20px;">
                        {{ $order->items->count() ?? 0 }} Item
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    <div style="overflow-x: auto; padding: 24px;">
                        <table class="product-list">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th style="text-align: right;">Harga</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: right;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $calcTotal = 0; @endphp
                                @forelse($order->items as $item)
                                    @php 
                                        $itemSubtotal = ($item->price - $item->discount) * $item->quantity; 
                                        $calcTotal += $itemSubtotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="product-item">
                                                <div class="product-img">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="Img">
                                                    @else
                                                        <i class="fas fa-shoe-prints"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="product-name">{{ $item->product->name ?? 'Produk Dihapus' }}</div>
                                                    <div style="display: flex; gap: 8px;">
                                                        @if($item->size)
                                                            <span class="product-meta"><i class="fas fa-ruler-horizontal"></i> {{ $item->size }}</span>
                                                        @endif
                                                        @if($item->color)
                                                            <span class="product-meta"><i class="fas fa-palette"></i> {{ $item->color }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price-col">
                                            @if($item->discount > 0)
                                                <div class="price-original">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                            @endif
                                            <div class="price-final">Rp {{ number_format($item->price - $item->discount, 0, ',', '.') }}</div>
                                        </td>
                                        <td style="text-align: center; font-weight: 700;">{{ $item->quantity }}</td>
                                        <td class="price-col subtotal-final">
                                            Rp {{ number_format($itemSubtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-muted); font-weight: 600;">
                                            Tidak ada data produk ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="summary-section">
                            <div class="summary-row">
                                <span>Subtotal Produk</span>
                                <span>Rp {{ number_format($calcTotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Biaya Pengiriman</span>
                                <span>Gratis</span>
                            </div>
                            <div class="summary-row">
                                <span>Kode Unik / Diskon</span>
                                <span>-</span>
                            </div>
                            <div class="summary-row total">
                                <span>TOTAL PEMBAYARAN</span>
                                <span class="value">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Actions -->
        <div>
            <!-- Status Pengiriman -->
            <div class="premium-card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-title-icon"><i class="fas fa-truck-fast"></i></div>
                        Status Pengiriman
                    </div>
                </div>
                <div class="card-body">
                    <!-- Timeline Visual -->
                    <div style="margin-bottom: 32px;">
                        @php
                            $stepPending = in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']);
                            $stepProcessing = in_array($order->status, ['processing', 'shipped', 'delivered']);
                            $stepShipped = in_array($order->status, ['shipped', 'delivered']);
                            $stepDelivered = $order->status === 'delivered';
                            $isCancelled = $order->status === 'cancelled';
                        @endphp

                        @if($isCancelled)
                            <div class="timeline-item">
                                <div class="timeline-icon icon-completed" style="background: var(--danger-light); color: var(--danger);"><i class="fas fa-ban"></i></div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Pesanan Dibatalkan</div>
                                    <div class="timeline-desc">Transaksi ini telah dibatalkan.</div>
                                </div>
                            </div>
                        @else
                            <div class="timeline-item">
                                <div class="timeline-icon {{ $stepPending ? ($order->status == 'pending' ? 'icon-current' : 'icon-completed') : 'icon-pending' }}">
                                    @if($stepProcessing) <i class="fas fa-check"></i> @else 1 @endif
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Menunggu Konfirmasi</div>
                                    <div class="timeline-desc">Pesanan baru masuk & belum diproses.</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon {{ $stepProcessing ? ($order->status == 'processing' ? 'icon-current' : 'icon-completed') : 'icon-pending' }}">
                                    @if($stepShipped) <i class="fas fa-check"></i> @else 2 @endif
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Diproses</div>
                                    <div class="timeline-desc">Pesanan sedang disiapkan.</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon {{ $stepShipped ? ($order->status == 'shipped' ? 'icon-current' : 'icon-completed') : 'icon-pending' }}">
                                    @if($stepDelivered) <i class="fas fa-check"></i> @else 3 @endif
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Dikirim</div>
                                    <div class="timeline-desc">Pesanan dalam perjalanan kurir.</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon {{ $stepDelivered ? 'icon-completed' : 'icon-pending' }}">
                                    @if($stepDelivered) <i class="fas fa-check"></i> @else 4 @endif
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Selesai</div>
                                    <div class="timeline-desc">Pesanan diterima oleh pelanggan.</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('admin.pesanan.update-status', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="form-label" for="status">Update Status Pengiriman</label>
                            <select name="status" id="status" class="premium-select">
                                @foreach($statuses as $value => $label)
                                    <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn-submit">
                            Simpan Perubahan <i class="fas fa-save"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Status Pembayaran -->
            <div class="premium-card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-title-icon" style="background: var(--success-light); color: var(--success);"><i class="fas fa-wallet"></i></div>
                        Status Pembayaran
                    </div>
                </div>
                <div class="card-body">
                    <div style="margin-bottom: 24px;">
                        <span class="badge badge-{{ $order->payment_status }}">
                            @if($order->payment_status == 'paid') <i class="fas fa-check-circle" style="font-size: 16px;"></i> @endif
                            {{ strtoupper($paymentStatuses[$order->payment_status] ?? $order->payment_status) }}
                        </span>
                    </div>

                    @if($order->payment_proof)
                        <div class="form-label" style="margin-bottom: 15px;">Bukti Pembayaran</div>
                        <div class="proof-preview" onclick="window.open('{{ asset('storage/' . $order->payment_proof) }}', '_blank')">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran">
                            <div class="proof-overlay">
                                <i class="fas fa-search-plus"></i> &nbsp; Lihat Ukuran Penuh
                            </div>
                        </div>
                        <p style="font-size: 11px; color: var(--text-muted); margin-top: 8px; text-align: center;">
                            Klik gambar untuk memperbesar di tab baru
                        </p>
                        <hr style="margin: 24px 0; border: 0; border-top: 1px solid var(--surface-100);">
                    @else
                        <div style="padding: 20px; background: var(--surface-50); border-radius: var(--radius-md); border: 1px dashed var(--surface-200); text-align: center; margin-bottom: 24px;">
                            <i class="fas fa-image-slash" style="font-size: 24px; color: var(--text-muted); opacity: 0.5; margin-bottom: 8px; display: block;"></i>
                            <span style="font-size: 13px; color: var(--text-muted); font-weight: 600;">Belum ada bukti pembayaran</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.pesanan.update-payment', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="form-label" for="payment_status">Ubah Status Pembayaran</label>
                            <select name="payment_status" id="payment_status" class="premium-select">
                                @foreach($paymentStatuses as $value => $label)
                                    <option value="{{ $value }}" {{ $order->payment_status === $value ? 'selected' : '' }}>
                                        {{ strtoupper($label) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn-submit btn-submit-success">
                            Update Pembayaran <i class="fas fa-check-double"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
