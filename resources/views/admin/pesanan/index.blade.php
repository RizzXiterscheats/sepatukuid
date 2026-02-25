@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')
@section('page-title', 'Manajemen Pesanan')
@section('page-description', 'Pusat kontrol transaksi dan pesanan pelanggan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    

    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    /* Stats Grid */
    .premium-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .stat-card {
        background: var(--surface); border-radius: var(--radius-lg); padding: 24px;
        box-shadow: var(--shadow-md); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative; overflow: hidden; border: 1px solid rgba(255,255,255,0.8);
        display: flex; align-items: center; gap: 20px; z-index: 1;
    }
    .stat-card::before {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(120deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.05) 100%);
        z-index: -1; opacity: 0; transition: opacity 0.4s;
    }
    .stat-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }
    .stat-card:hover::before { opacity: 1; }
    
    .stat-icon-wrapper {
        width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center;
        font-size: 28px; color: white; box-shadow: var(--shadow-md); position: relative;
    }
    .stat-icon-wrapper::after {
        content: ''; position: absolute; inset: -5px; border-radius: 22px; background: inherit; filter: blur(10px); opacity: 0.4; z-index: -1;
    }
    .icon-total { background: var(--primary-gradient); }
    .icon-pending { background: var(--warning-gradient); }
    .icon-processing { background: var(--info-gradient); }
    .icon-unpaid { background: var(--danger-gradient); }

    .stat-content { flex: 1; }
    .stat-value { font-size: 32px; font-weight: 800; line-height: 1.1; margin-bottom: 4px; letter-spacing: -0.5px; }
    .stat-label { font-size: 14px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }

    /* Main Container */
    .premium-container { background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); padding: 28px; border: 1px solid var(--surface-200); }
    
    /* Toolbar */
    .premium-toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; background: var(--surface-50); padding: 16px; border-radius: var(--radius-md); border: 1px solid var(--surface-200); }
    
    .search-group { position: relative; width: 380px; }
    .search-group i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 16px; transition: color 0.3s; }
    .search-input { width: 100%; padding: 12px 16px 12px 48px; border: 2px solid transparent; border-radius: var(--radius-md);
        background: var(--surface); color: var(--text-main); font-size: 14px; font-weight: 500; outline: none; box-shadow: var(--shadow-sm); transition: all 0.3s ease; }
    .search-input:focus { border-color: #818cf8; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    .search-input:focus + i { color: #4f46e5; }
    .search-input::placeholder { color: #94a3b8; font-weight: 400; }

    .filters-group { display: flex; gap: 12px; }
    .premium-select { padding: 12px 36px 12px 16px; border: 1px solid var(--surface-200); border-radius: var(--radius-md); background-color: var(--surface); background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-position: right 12px center; background-repeat: no-repeat; background-size: 16px; appearance: none; font-size: 14px; font-weight: 600; color: var(--text-main); cursor: pointer; box-shadow: var(--shadow-sm); transition: all 0.3s; }
    .premium-select:hover { border-color: #cbd5e1; }
    .premium-select:focus { outline: none; border-color: #818cf8; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

    .btn-reset { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: var(--radius-md); background: white; border: 1px solid #e2e8f0; color: #475569; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s; text-decoration: none; box-shadow: var(--shadow-sm); }
    .btn-reset:hover { background: #f8fafc; color: #ef4444; border-color: #fca5a5; }

    /* Table */
    .table-container { overflow-x: auto; border-radius: var(--radius-md); border: 1px solid var(--surface-200); }
    .premium-table { width: 100%; border-collapse: separate; border-spacing: 0; background: var(--surface); }
    .premium-table th { background: #f8fafc; padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 2px solid var(--surface-200); white-space: nowrap; }
    .premium-table td { padding: 18px 20px; border-bottom: 1px solid var(--surface-100); vertical-align: middle; font-size: 14px; font-weight: 500; transition: background-color 0.2s; }
    .premium-table tr:hover td { background-color: #f8fafc; }
    .premium-table tr:last-child td { border-bottom: none; }

    /* Cells info */
    .order-id a { color: #4f46e5; font-weight: 700; text-decoration: none; font-size: 15px; position: relative; display: inline-block; }
    .order-id a::after { content: ''; position: absolute; width: 100%; transform: scaleX(0); height: 2px; bottom: -2px; left: 0; background-color: #4f46e5; transform-origin: bottom right; transition: transform 0.25s ease-out; }
    .order-id a:hover::after { transform: scaleX(1); transform-origin: bottom left; }
    
    .date-time { font-size: 13px; color: var(--text-muted); font-weight: 500; }
    
    .customer-info .name { font-weight: 700; color: var(--text-main); margin-bottom: 3px; }
    .customer-info .email { font-size: 13px; color: var(--text-muted); display: flex; align-items: center; gap: 5px; }

    .amount-cell { font-weight: 800; color: var(--text-main); font-size: 15px; }

    /* Badges */
    .badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap; }
    
    .status-pending { background: #fef3c7; color: #d97706; }
    .status-processing { background: #dbeafe; color: #2563eb; }
    .status-shipped { background: #ede9fe; color: #7c3aed; }
    .status-delivered { background: #d1fae5; color: #059669; }
    .status-cancelled { background: #fee2e2; color: #dc2626; }

    .payment-paid { color: #059669; }
    .payment-unpaid { color: #dc2626; }
    .payment-failed { color: #9f1239; }
    .payment-refunded { color: #64748b; }

    /* Actions */
    .action-btn { width: 38px; height: 38px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; background: var(--surface-50); color: var(--text-muted); border: 1px solid var(--surface-200); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none; cursor: pointer; }
    .action-btn:hover { background: #4f46e5; color: white; border-color: #4f46e5; transform: translateY(-3px) scale(1.05); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }

    /* Empty State */
    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-icon { font-size: 64px; color: var(--surface-200); margin-bottom: 20px; display: inline-block; animation: float 6s ease-in-out infinite; }
    .empty-title { font-size: 20px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; }
    .empty-desc { color: var(--text-muted); font-size: 14px; max-width: 400px; margin: 0 auto; line-height: 1.6; }

    /* Pagination */
    .pagination-wrapper { display: flex; justify-content: space-between; align-items: center; margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--surface-200); flex-wrap: wrap; gap: 15px; }
    .page-info { font-size: 14px; font-weight: 600; color: var(--text-muted); }

    @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-10px); } 100% { transform: translateY(0px); } }

    @media (max-width: 1024px) {
        .premium-toolbar { flex-direction: column; align-items: stretch; }
        .search-group { width: 100%; }
        .filters-group { flex-wrap: wrap; }
        .premium-select { flex: 1; min-width: 150px; }
    }
</style>
@endpush

@section('content')
    <!-- Premium Stats -->
    <div class="premium-stats-grid">
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-total">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalOrders }}</div>
                <div class="stat-label">Total Pesanan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $pendingOrders }}</div>
                <div class="stat-label">Menunggu Konfirmasi</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-processing">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $processingOrders }}</div>
                <div class="stat-label">Sedang Diproses</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-unpaid">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $unpaidOrders }}</div>
                <div class="stat-label">Belum Dibayar</div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="premium-container">
        <form method="GET" action="{{ route('admin.pesanan.index') }}" class="premium-toolbar">
            <div class="search-group">
                <input type="text" name="search" class="search-input" placeholder="Cari No. Pesanan atau Detail Pelanggan..." value="{{ request('search') }}">
                <i class="fas fa-search"></i>
            </div>
            
            <div class="filters-group">
                <select name="status" class="premium-select" onchange="this.form.submit()">
                    <option value="">Status Pengiriman</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                
                <select name="payment_status" class="premium-select" onchange="this.form.submit()">
                    <option value="">Status Pembayaran</option>
                    @foreach($paymentStatuses as $key => $label)
                        <option value="{{ $key }}" {{ request('payment_status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                
                @if(request('search') || request('status') || request('payment_status'))
                    <a href="{{ route('admin.pesanan.index') }}" class="btn-reset">
                        <i class="fas fa-undo"></i> Reset Filter
                    </a>
                @endif
            </div>
        </form>

        <div class="table-container">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Status Bayar</th>
                        <th>Waktu</th>
                        <th>Status Kirim</th>
                        <th style="text-align: right;">Total</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="order-id">
                                <a href="{{ route('admin.pesanan.show', $order) }}">
                                    #{{ $order->order_number }}
                                </a>
                                <div style="font-size: 11px; margin-top: 4px; color: var(--text-muted); font-weight: 600;">{{ $order->items->count() ?? 0 }} ITEM</div>
                            </td>
                            <td class="customer-info">
                                <div class="name">{{ $order->user->name ?? 'Guest User' }}</div>
                                <div class="email"><i class="fas fa-envelope" style="opacity: 0.5;"></i> {{ $order->user->email ?? '-' }}</div>
                            </td>
                            <td>
                                @if($order->payment_status === 'paid')
                                    <div class="badge" style="background: transparent; padding: 0;">
                                        <i class="fas fa-check-circle payment-paid" style="font-size: 16px;"></i>
                                        <span class="payment-paid">LUNAS</span>
                                    </div>
                                @elseif($order->payment_status === 'unpaid')
                                    <div class="badge" style="background: transparent; padding: 0;">
                                        <i class="fas fa-times-circle payment-unpaid" style="font-size: 16px;"></i>
                                        <span class="payment-unpaid">BELUM DIBAYAR</span>
                                    </div>
                                @else
                                    <div class="badge" style="background: transparent; padding: 0;">
                                        <i class="fas fa-info-circle payment-refunded" style="font-size: 16px;"></i>
                                        <span class="payment-refunded">{{ strtoupper($paymentStatuses[$order->payment_status] ?? $order->payment_status) }}</span>
                                    </div>
                                @endif
                                <div style="font-size: 11px; color: var(--text-muted); margin-top: 4px; font-weight: 700;">
                                    VIA {{ strtoupper($order->payment_method ?? 'MANUAL') }}
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: var(--text-main);">{{ $order->created_at->format('d M Y') }}</div>
                                <div class="date-time">{{ $order->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <span class="badge status-{{ $order->status }}">
                                    @if($order->status == 'pending') <i class="fas fa-clock"></i>
                                    @elseif($order->status == 'processing') <i class="fas fa-box-open"></i>
                                    @elseif($order->status == 'shipped') <i class="fas fa-truck"></i>
                                    @elseif($order->status == 'delivered') <i class="fas fa-check-double"></i>
                                    @elseif($order->status == 'cancelled') <i class="fas fa-ban"></i>
                                    @endif
                                    {{ $statuses[$order->status] ?? ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="amount-cell" style="text-align: right;">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.pesanan.show', $order) }}" class="action-btn" title="Lihat Detail Pesanan">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <div class="empty-title">Tidak Ada Pesanan</div>
                                    <div class="empty-desc">
                                        @if(request('search') || request('status') || request('payment_status'))
                                            Tidak ditemukan pesanan yang sesuai dengan filter pencarian Anda. Silakan ubah atau reset filter.
                                        @else
                                            Belum ada pesanan yang masuk ke sistem saat ini.
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="pagination-wrapper">
                <div class="page-info">
                    Menampilkan <span style="color: var(--text-main);">{{ $orders->firstItem() ?? 0 }}</span> - <span style="color: var(--text-main);">{{ $orders->lastItem() ?? 0 }}</span> dari <span style="color: var(--text-main);">{{ $orders->total() }}</span> pesanan
                </div>
                <div>
                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
@endsection
