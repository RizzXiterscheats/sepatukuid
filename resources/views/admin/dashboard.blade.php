@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Pusat Kendali Utama Toko SepatuWara')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    /* Menggunakan variabel root yang sekarang tersentralisasi di admin.blade.php */
    
    body { font-family: var(--font-family, 'Plus Jakarta Sans', sans-serif); color: var(--text-main); background-color: var(--surface-100); }

    /* Welcome Banner */
    .welcome-banner { background: var(--primary-gradient); border-radius: var(--radius-lg); padding: 32px; color: white; display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3); position: relative; overflow: hidden; }
    .welcome-banner::before { content: ''; position: absolute; right: 0; top: 0; bottom: 0; width: 50%; background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,0.05)' fill-rule='evenodd'/%3E%3C/svg%3E"); }
    .welcome-text { position: relative; z-index: 1; }
    .welcome-text h2 { margin: 0 0 8px 0; font-size: 28px; font-weight: 800; letter-spacing: -0.5px; }
    .welcome-text p { margin: 0; font-size: 15px; opacity: 0.9; }
    .welcome-actions { display: flex; gap: 12px; position: relative; z-index: 1; }
    .btn-glass { padding: 12px 20px; border-radius: var(--radius-sm); font-weight: 700; font-size: 14px; color: white; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-glass:hover { background: rgba(255, 255, 255, 0.3); transform: translateY(-2px); }

    /* KPI Cards */
    .premium-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .stat-card { background: var(--surface); border-radius: var(--radius-lg); padding: 24px; box-shadow: var(--shadow-md); transition: all 0.4s; position: relative; overflow: hidden; border: 1px solid var(--surface-200); display: flex; align-items: center; gap: 20px; z-index: 1; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); border-color: var(--primary); }
    .stat-icon-wrapper { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 28px; color: white; box-shadow: var(--shadow-md); position: relative; flex-shrink: 0; }
    .icon-revenue { background: var(--success-gradient); }
    .icon-orders { background: var(--primary-gradient); }
    .icon-customers { background: var(--info-gradient); }
    .icon-products { background: var(--warning-gradient); }
    .stat-content { flex: 1; overflow: hidden; }
    .stat-value { font-size: 26px; font-weight: 800; line-height: 1.1; margin-bottom: 4px; letter-spacing: -0.5px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; }
    .stat-label { font-size: 13px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }

    /* Main Dashboard Grid */
    .dashboard-grid { display: flex; flex-direction: column; gap: 24px; }

    /* Premium Card / Panels */
    .panel { background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); border: 1px solid var(--surface-200); display: flex; flex-direction: column; overflow: hidden; }
    .panel-header { padding: 20px 24px; border-bottom: 1px solid var(--surface-100); background: var(--surface-50); display: flex; justify-content: space-between; align-items: center; }
    .panel-title { font-size: 16px; font-weight: 800; color: var(--text-main); display: flex; align-items: center; gap: 10px; }
    .panel-title i { color: var(--primary); }
    
    /* Chart Container */
    .chart-container-custom { padding: 24px; min-height: 350px; width: 100%; position: relative; }

    /* Recent Orders List */
    .recent-list { list-style: none; padding: 0; margin: 0; }
    .recent-item { padding: 16px 24px; border-bottom: 1px solid var(--surface-100); display: flex; align-items: center; justify-content: space-between; transition: background 0.2s; }
    .recent-item:hover { background: var(--surface-50); }
    .recent-item:last-child { border-bottom: none; }
    
    .ri-info { display: flex; flex-direction: column; gap: 4px; overflow: hidden; }
    .ri-title { font-weight: 700; color: var(--text-main); font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .ri-subtitle { font-size: 12px; color: var(--text-muted); }
    
    .ri-meta { display: flex; flex-direction: column; align-items: flex-end; gap: 6px; flex-shrink: 0; }
    .ri-amount { font-weight: 800; color: var(--success); font-size: 14px; }
    
    .badge-custom { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
    .bc-paid { background: rgba(16, 185, 129, 0.1); color: #059669; border: 1px solid rgba(16, 185, 129, 0.2); }
    .bc-unpaid { background: rgba(239, 68, 68, 0.1); color: #dc2626; border: 1px solid rgba(239, 68, 68, 0.2); }
    .bc-pending { background: rgba(245, 158, 11, 0.1); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.2); }

    .btn-sm-action { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: var(--surface-100); color: var(--text-muted); text-decoration: none; transition: all 0.2s; }
    .btn-sm-action:hover { background: var(--primary); color: white; }
    .ri-actions { display: flex; gap: 8px; align-items: center; margin-top: 4px; }

    @media (max-width: 1024px) {
        .dashboard-grid { grid-template-columns: 1fr; }
        .welcome-banner { flex-direction: column; align-items: flex-start; gap: 24px; }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-text">
            <h2>Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}! 👋</h2>
            <p>Berikut adalah ringkasan singkat statistik toko Anda hari ini.</p>
        </div>
        <div class="welcome-actions">
            <!-- Asumsikan rute tambah produk ada (misal di halaman katalog) -->
            <a href="{{ route('admin.produk.index') }}" class="btn-glass"><i class="fas fa-box"></i> Kelola Produk</a>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.laporan.index') }}" class="btn-glass"><i class="fas fa-chart-line"></i> Lihat Laporan</a>
            @endif
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="premium-stats-grid">
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-revenue">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" style="color: var(--success);">Rp {{ number_format($totalRevenueThisMonth, 0, ',', '.') }}</div>
                <div class="stat-label">Pendapatan Lunas (Bulan Ini)</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-orders">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($newOrdersToday) }}</div>
                <div class="stat-label">Pesanan Hari Ini</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-customers">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($totalCustomers) }}</div>
                <div class="stat-label">Total Pelanggan Aktif</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-products">
                <i class="fas fa-shoe-prints"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($totalActiveProducts) }}</div>
                <div class="stat-label">Produk Aktif Terdaftar</div>
            </div>
        </div>
    </div>

    <!-- Main Dash Grid -->
    <div class="dashboard-grid">
        
        <!-- Chart.js Graph Panel -->
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title"><i class="fas fa-chart-area"></i> Trend Penjualan (7 Hari Terakhir)</div>
            </div>
            <div class="chart-container-custom">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
        
        <!-- Recent Orders Panel -->
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title"><i class="fas fa-bell" style="color: var(--warning);"></i> Pesanan Terbaru</div>
                <a href="{{ route('admin.pesanan.index') }}" style="font-size: 13px; font-weight: 700; color: var(--primary); text-decoration: none;">Lihat Semua</a>
            </div>
            <ul class="recent-list">
                @forelse($recentOrders as $order)
                    <li class="recent-item">
                        <div class="ri-info">
                            <div class="ri-title">#{{ $order->order_number }} - {{ $order->user->name ?? 'Guest User' }}</div>
                            <div class="ri-subtitle"><i class="far fa-clock"></i> {{ $order->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="ri-meta">
                            <div class="ri-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                            <div class="ri-actions">
                                <span class="badge-custom {{ $order->payment_status === 'paid' ? 'bc-paid' : ($order->payment_status === 'unpaid' ? 'bc-unpaid' : 'bc-pending') }}">
                                    {{ strtoupper($order->payment_status) }}
                                </span>
                                <a href="{{ route('admin.pesanan.show', $order) }}" class="btn-sm-action" title="Lihat Detail">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                @empty
                    <li style="padding: 40px 24px; text-align: center; color: var(--text-muted); font-weight: 500;">
                        <div style="font-size: 32px; color: var(--surface-200); margin-bottom: 12px;"><i class="fas fa-box-open"></i></div>
                        Belum ada riwayat pesanan apa pun.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Chart Instance Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            
            // Elegant Gradient Fill for the Line Chart
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(229, 9, 20, 0.5)'); // Red #e50914
            gradient.addColorStop(1, 'rgba(229, 9, 20, 0.0)'); // Transparent

            const chartDataRaw = @json($chartData);
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartDataRaw.labels,
                    datasets: [{
                        label: 'Pendapatan Harian (Rp)',
                        data: chartDataRaw.data,
                        borderColor: '#e50914',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#e50914',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                            bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 14, weight: 'bold' },
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    let value = context.parsed.y;
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4], color: '#e2e8f0', drawBorder: false },
                            ticks: { 
                                font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                                color: '#64748b',
                                callback: function(value) {
                                    if (value >= 1000000) return 'Rp ' + (value / 1000000) + 'M';
                                    if (value >= 1000) return 'Rp ' + (value / 1000) + 'k';
                                    return 'Rp ' + value;
                                }
                            }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { family: "'Plus Jakarta Sans', sans-serif", size: 12 }, color: '#64748b' }
                        }
                    },
                    interaction: { intersect: false, mode: 'index' }
                }
            });
        });
    </script>
@endsection