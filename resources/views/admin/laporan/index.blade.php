@extends('layouts.admin')

@section('title', 'Laporan Penjualan')
@section('page-title', 'Laporan Penjualan')
@section('page-description', 'Ringkasan performa pendapatan dan transaksi berhasil toko Anda')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    

    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    /* Filter Bar */
    .filter-bar { background: var(--surface); padding: 20px 24px; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; border: 1px solid var(--surface-200); }
    .filter-info { display: flex; align-items: center; gap: 12px; }
    .filter-icon { width: 40px; height: 40px; border-radius: var(--radius-sm); background: rgba(79, 70, 229, 0.1); color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 18px; }
    .filter-text h4 { margin: 0 0 4px 0; font-size: 15px; font-weight: 800; color: var(--text-main); }
    .filter-text p { margin: 0; font-size: 13px; color: var(--text-muted); font-weight: 500; }

    .filter-form { display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap; }
    .form-group-date { display: flex; flex-direction: column; gap: 6px; }
    .form-group-date label { font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
    .date-input { padding: 10px 14px; border: 2px solid var(--surface-200); border-radius: var(--radius-sm); font-family: var(--font-family); font-size: 14px; font-weight: 600; color: var(--text-main); outline: none; transition: all 0.3s; background: var(--surface-50); }
    .date-input:focus { border-color: #818cf8; background: var(--surface); }

    .btn { display: inline-flex; align-items: center; gap: 8px; padding: 11px 20px; border-radius: var(--radius-sm); font-weight: 700; font-size: 14px; cursor: pointer; border: none; transition: all 0.3s; text-decoration: none; }
    .btn-primary { background: var(--primary-gradient); color: white; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(79, 70, 229, 0.4); }
    .btn-secondary { background: white; color: var(--text-main); border: 1px solid var(--surface-200); box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .btn-secondary:hover { background: var(--surface-50); border-color: #cbd5e1; }
    .btn-print { background: var(--success-gradient); color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
    .btn-print:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(16, 185, 129, 0.4); }

    /* Stats Grid */
    .premium-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .stat-card { background: var(--surface); border-radius: var(--radius-lg); padding: 24px; box-shadow: var(--shadow-md); transition: all 0.4s; position: relative; overflow: hidden; border: 1px solid rgba(255,255,255,0.8); display: flex; align-items: center; gap: 20px; z-index: 1; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }
    
    .stat-icon-wrapper { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 28px; color: white; box-shadow: var(--shadow-md); position: relative; flex-shrink: 0; }
    .icon-revenue { background: var(--success-gradient); }
    .icon-orders { background: var(--primary-gradient); }
    .icon-items { background: var(--warning-gradient); }
    .icon-avg { background: var(--info-gradient); }

    .stat-content { flex: 1; overflow: hidden; }
    .stat-value { font-size: 28px; font-weight: 800; line-height: 1.1; margin-bottom: 4px; letter-spacing: -0.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .stat-value.money { color: #059669; }
    .stat-label { font-size: 13px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }

    /* Main Container & Table */
    .premium-container { background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); border: 1px solid var(--surface-200); overflow: hidden; }
    .container-header { padding: 20px 24px; border-bottom: 1px solid var(--surface-200); background: var(--surface-50); display: flex; justify-content: space-between; align-items: center; }
    .container-title { font-size: 16px; font-weight: 800; color: var(--text-main); display: flex; align-items: center; gap: 8px; }
    
    .table-container { overflow-x: auto; }
    .premium-table { width: 100%; border-collapse: separate; border-spacing: 0; background: var(--surface); }
    .premium-table th { background: #f8fafc; padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 2px solid var(--surface-200); white-space: nowrap; }
    .premium-table td { padding: 16px 20px; border-bottom: 1px solid var(--surface-100); vertical-align: middle; font-size: 14px; font-weight: 500; }
    .premium-table tr:hover td { background-color: #f8fafc; }
    .premium-table tr:last-child td { border-bottom: none; }

    .info-cell { display: flex; flex-direction: column; gap: 4px; }
    .main-info { font-weight: 700; color: var(--text-main); }
    .sub-info { font-size: 12px; color: var(--text-muted); }

    .money-amount { font-weight: 800; color: var(--text-main); font-size: 14px; text-align: right; }

    .pagination-wrapper { padding: 20px 24px; border-top: 1px solid var(--surface-200); background: var(--surface-50); }

    /* Print Styles */
    @media print {
        .sidebar, .topbar, .filter-bar, .pagination-wrapper, .btn { display: none !important; }
        body, .premium-container, .stat-card { background: white; box-shadow: none; border: 1px solid #ddd; }
        .premium-table th { background: #eee !important; -webkit-print-color-adjust: exact; }
        .stat-icon-wrapper { box-shadow: none; -webkit-print-color-adjust: exact; }
    }

    @media (max-width: 768px) {
        .filter-bar { flex-direction: column; align-items: stretch; }
        .filter-form { width: 100%; justify-content: space-between; }
        .form-group-date, .date-input { width: 100%; }
        .form-group-date.btn-group { flex-direction: row; }
        .btn { flex: 1; justify-content: center; }
    }
</style>
@endpush

@section('content')
    <!-- Filter Section -->
    <div class="filter-bar">
        <div class="filter-info">
            <div class="filter-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="filter-text">
                <h4>Periode Laporan</h4>
                <p>{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} — {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
            </div>
        </div>

        <form action="{{ route('admin.laporan.index') }}" method="GET" class="filter-form">
            <div class="form-group-date">
                <label for="start_date">Dari Tanggal</label>
                <input type="date" id="start_date" name="start_date" class="date-input" value="{{ request('start_date', \Carbon\Carbon::parse($startDate)->format('Y-m-d')) }}">
            </div>
            
            <div class="form-group-date">
                <label for="end_date">Sampai Tanggal</label>
                <input type="date" id="end_date" name="end_date" class="date-input" value="{{ request('end_date', \Carbon\Carbon::parse($endDate)->format('Y-m-d')) }}">
            </div>
            
            <div class="form-group-date btn-group">
                <label>&nbsp;</label>
                <div style="display: flex; gap: 8px;">
                    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                    @if(request()->has('start_date'))
                        <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary" title="Reset ke Bulan Ini"><i class="fas fa-undo"></i></a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Key Performance Indicators (KPIs) -->
    <div class="premium-stats-grid">
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-revenue">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value money">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                <div class="stat-label">Total Pendapatan Bersih</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-orders">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($totalOrders) }}</div>
                <div class="stat-label">Pesanan Berhasil</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-items">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($totalItemsSold) }}</div>
                <div class="stat-label">Produk Terjual</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-avg">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">Rp {{ number_format($averageOrderValue, 0, ',', '.') }}</div>
                <div class="stat-label">Rata-rata Nilai Pesanan</div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="premium-container">
        <div class="container-header">
            <div class="container-title">
                <i class="fas fa-list-ul" style="color: var(--primary);"></i> Daftar Transaksi (Selesai)
            </div>
            <button onclick="window.print()" class="btn btn-print">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
        </div>

        <div class="table-container">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>No. Pesanan / Tanggal</th>
                        <th>Pelanggan</th>
                        <th style="text-align: center;">Jml Item</th>
                        <th style="text-align: right;">Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <div class="info-cell">
                                    <span class="main-info">#{{ $order->order_number }}</span>
                                    <span class="sub-info"><i class="far fa-clock"></i> {{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                                </div>
                            </td>
                            <td>
                                <div class="info-cell">
                                    <span class="main-info">{{ $order->user->name ?? 'Guest User' }}</span>
                                    <span class="sub-info">{{ $order->user->email ?? '-' }}</span>
                                </div>
                            </td>
                            <td style="text-align: center; font-weight: 700; color: var(--text-main);">
                                {{ $order->items->sum('quantity') ?? 0 }}
                            </td>
                            <td class="money-amount">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 60px 20px;">
                                <div style="font-size: 48px; color: var(--surface-200); margin-bottom: 16px;"><i class="fas fa-receipt"></i></div>
                                <div style="font-size: 18px; font-weight: 700; color: var(--text-main); margin-bottom: 8px;">Belum Ada Transaksi</div>
                                <div style="color: var(--text-muted);">Tidak ada pesanan yang berhasil/selesai dan lunas pada rentang tanggal ini.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="pagination-wrapper">
                {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
