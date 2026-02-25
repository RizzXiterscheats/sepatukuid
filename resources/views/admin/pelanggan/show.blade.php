@extends('layouts.admin')

@section('title', 'Profil Pelanggan - ' . $customer->name)
@section('page-title', 'Profil Pelanggan')
@section('page-description', 'Detail Pelanggan & Riwayat Pemesanan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    

    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    /* Top Actions */
    .top-toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    
    .btn-action { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: var(--radius-md); font-weight: 600; font-size: 14px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none; cursor: pointer; border: none; }
    .btn-back { background: var(--surface); color: var(--text-main); border: 1px solid var(--surface-200); box-shadow: 0 2px 4px rgb(0 0 0 / 0.02); }
    .btn-back:hover { background: var(--surface-50); transform: translateX(-4px); box-shadow: var(--shadow-md); }

    /* Layout */
    .premium-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 24px; align-items: start; }
    
    /* Cards */
    .premium-card { background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); overflow: hidden; margin-bottom: 24px; border: 1px solid rgba(255,255,255,0.8); }
    
    /* Profile Section */
    .profile-header { background: var(--primary-gradient); padding: 40px 24px 24px; text-align: center; color: white; position: relative; }
    .profile-avatar { width: 90px; height: 90px; border-radius: 50%; background: white; color: #4f46e5; display: inline-flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 800; border: 4px solid rgba(255,255,255,0.2); box-shadow: 0 8px 16px rgba(0,0,0,0.1); margin-bottom: 16px; position: relative; z-index: 2; }
    .profile-name { font-size: 22px; font-weight: 800; margin-bottom: 4px; }
    .profile-email { font-size: 14px; opacity: 0.9; margin-bottom: 16px; font-weight: 500; }
    
    .profile-joined { display: inline-block; background: rgba(0,0,0,0.2); padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; letter-spacing: 0.5px; }

    .profile-details { padding: 24px; }
    .detail-group { margin-bottom: 20px; display: flex; align-items: flex-start; gap: 16px; }
    .detail-group:last-child { margin-bottom: 0; }
    .detail-icon { width: 40px; height: 40px; border-radius: 12px; background: var(--surface-50); color: var(--text-muted); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .detail-content { flex: 1; }
    .detail-label { font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .detail-value { font-size: 15px; font-weight: 600; color: var(--text-main); line-height: 1.5; }

    /* Lifetime Stats */
    .stats-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 24px; padding-top: 24px; border-top: 1px dashed var(--surface-200); }
    .stat-box { background: var(--surface-50); padding: 16px; border-radius: var(--radius-md); text-align: center; border: 1px solid var(--surface-200); }
    .stat-box-value { font-size: 24px; font-weight: 800; color: #4f46e5; margin-bottom: 4px; }
    .stat-box-label { font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; }

    /* Order History Container */
    .history-header { padding: 20px 24px; border-bottom: 1px solid var(--surface-100); display: flex; justify-content: space-between; align-items: center; background: rgba(248, 250, 252, 0.5); }
    .history-title { font-size: 16px; font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 10px; }
    .history-title i { color: #4f46e5; }
    
    .table-container { overflow-x: auto; padding: 0 24px 24px; }
    .premium-table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 16px; }
    .premium-table th { padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid var(--surface-100); }
    .premium-table td { padding: 16px; border-bottom: 1px solid var(--surface-50); vertical-align: middle; font-size: 14px; font-weight: 500; }
    .premium-table tr:hover td { background-color: var(--surface-50); }
    .premium-table tr:last-child td { border-bottom: none; }

    .order-id { font-weight: 800; color: #4f46e5; text-decoration: none; font-size: 15px; }
    .order-id:hover { text-decoration: underline; }
    .order-date { font-size: 13px; color: var(--text-muted); margin-top: 4px; }

    /* Badges */
    .badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-flex; align-items: center; gap: 4px; }
    .status-pending { background: #fef3c7; color: #d97706; }
    .status-processing { background: #dbeafe; color: #2563eb; }
    .status-shipped { background: #ede9fe; color: #7c3aed; }
    .status-delivered { background: #d1fae5; color: #059669; }
    .status-cancelled { background: #fee2e2; color: #dc2626; }

    /* Empty state */
    .empty-history { text-align: center; padding: 60px 20px; }
    .empty-icon { font-size: 48px; color: var(--surface-200); margin-bottom: 16px; }

    .pagination-wrapper { margin-top: 20px; }

    @media (max-width: 1024px) {
        .premium-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    <div class="top-toolbar">
        <a href="{{ route('admin.pelanggan.index') }}" class="btn-action btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="premium-grid">
        <!-- Kiri: Info Profil Lengkap -->
        <div>
            <div class="premium-card">
                <div class="profile-header">
                    <div class="profile-avatar">{{ strtoupper(substr($customer->name, 0, 2)) }}</div>
                    <div class="profile-name">{{ $customer->name }}</div>
                    <div class="profile-email"><i class="fas fa-envelope" style="opacity: 0.7;"></i> {{ $customer->email }}</div>
                    <div class="profile-joined">
                        Bergabung sejak {{ $customer->created_at->format('M Y') }}
                    </div>
                </div>

                <div class="profile-details">
                    <div class="detail-group">
                        <div class="detail-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="detail-content">
                            <div class="detail-label">Nomor WhatsApp / TLp</div>
                            <div class="detail-value">{{ $customer->phone ?? 'Belum ditambahkan' }}</div>
                        </div>
                    </div>

                    <div class="detail-group">
                        <div class="detail-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="detail-content">
                            <div class="detail-label">Alamat Utama</div>
                            <div class="detail-value">
                                @if($customer->address)
                                    {!! nl2br(e($customer->address)) !!}
                                @else
                                    <span style="color: var(--text-muted); font-style: italic;">Belum menambahkan alamat default.</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="stats-row">
                        <div class="stat-box">
                            <div class="stat-box-value">{{ number_format($totalOrders) }}</div>
                            <div class="stat-box-label">Total Pesanan</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-box-value" style="color: #10b981; font-size: 18px; line-height: 28px;">Rp {{ number_format($totalSpent, 0, ',', '.') }}</div>
                            <div class="stat-box-label">Total Belanja</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="premium-card" style="padding: 24px;">
                <h4 style="font-size: 14px; font-weight: 700; color: var(--danger); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;"><i class="fas fa-exclamation-triangle"></i> Zona Berbahaya</h4>
                <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 16px; line-height: 1.5;">Menghapus pelanggan secara permanen. Pastikan pelanggan ini sudah tidak memiliki tanggungan transaksi aktif.</p>
                <form action="{{ route('admin.pelanggan.destroy', $customer) }}" method="POST" onsubmit="return confirm('Tindakan ini permanen. Yakin menghapus pengguna?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action" style="background: rgba(239, 68, 68, 0.1); color: var(--danger); width: 100%; border: 1px solid rgba(239, 68, 68, 0.2); justify-content: center;">
                        <i class="fas fa-user-times"></i> Hapus Akun Pelanggan
                    </button>
                </form>
            </div>
        </div>

        <!-- Kanan: Histori Pesanan Pelanggan -->
        <div>
            <div class="premium-card">
                <div class="history-header">
                    <div class="history-title">
                        <i class="fas fa-shopping-bag"></i> Riwayat Pemesanan Pelanggan
                    </div>
                </div>
                
                <div class="table-container">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th style="text-align: right;">Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.pesanan.show', $order) }}" class="order-id">#{{ $order->order_number }}</a>
                                        <div class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700;">{{ $order->items->count() ?? 0 }} Produk</div>
                                        <div style="font-size: 12px; color: var(--text-muted);">{{ strtoupper($order->payment_method ?? 'MANUAL') }}</div>
                                    </td>
                                    <td style="text-align: right; font-weight: 800; color: var(--text-main);">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <div style="display: flex; flex-direction: column; gap: 6px; align-items: flex-start;">
                                            <span class="badge status-{{ $order->status }}">
                                                {{ $order->status == 'pending' ? 'Menunggu' : ($order->status == 'processing' ? 'Diproses' : ($order->status == 'shipped' ? 'Dikirim' : ($order->status == 'delivered' ? 'Selesai' : 'Batal'))) }}
                                            </span>
                                            @if($order->payment_status === 'paid')
                                                <span style="font-size: 11px; font-weight: 700; color: #10b981;"><i class="fas fa-check-circle"></i> LUNAS</span>
                                            @elseif($order->payment_status === 'unpaid')
                                                <span style="font-size: 11px; font-weight: 700; color: #ef4444;"><i class="fas fa-times-circle"></i> BELUM DIBAYAR</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-history">
                                            <div class="empty-icon">
                                                <i class="fas fa-box-open"></i>
                                            </div>
                                            <div style="font-weight: 700; color: var(--text-main); font-size: 16px; margin-bottom: 4px;">Belum Ada Riwayat</div>
                                            <div style="color: var(--text-muted); font-size: 14px;">Pelanggan ini belum melakukan pembelian apapun.</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($orders->hasPages())
                        <div class="pagination-wrapper">
                            {{ $orders->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
