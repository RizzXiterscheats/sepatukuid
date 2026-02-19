@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('page-description', 'Selamat datang, Admin Perusahaan')

@section('content')
    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-value">{{ number_format($totalProducts) }}</div>
            <div class="stat-title">Total Produk Sesuatu</div>
            <div class="stat-trend trend-down">
                <i class="fas fa-arrow-down"></i>
                {{ $productsDown }} produk turun
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-value">{{ $ordersToday }}</div>
            <div class="stat-title">Pesanan Hari Ini</div>
            <div class="stat-trend trend-up">
                <i class="fas fa-arrow-up"></i>
                {{ $ordersPending }} hari sesuaikan
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-value">{{ $customerSatisfaction }}%</div>
            <div class="stat-title">Kepuasan Pelanggan</div>
            <div class="stat-trend trend-up">
                <i class="fas fa-arrow-up"></i>
                {{ $satisfactionTarget }}% selesainya
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-value">Rp {{ number_format($monthlyRevenue/1000000, 0) }}jt</div>
            <div class="stat-title">Pendapatan Bulan Ini</div>
            <div class="stat-trend trend-up">
                <i class="fas fa-arrow-up"></i>
                {{ $revenuePercentage }}% dari total
            </div>
        </div>
    </div>

    <!-- Sales Chart Section -->
    <div class="content-section">
        <div class="section-header">
            <div>
                <div class="section-title">Statistik Penjualan Sepatu 30 Hari Terakhir</div>
                <div class="section-subtitle">Kategori Sepatu Tertulis</div>
            </div>
            <button class="btn-view-all" onclick="window.location.href='#'">Lihat Detail</button>
        </div>
        
        <!-- Chart Placeholder -->
        <div class="chart-container">
            <div class="chart-placeholder">
                <i class="fas fa-chart-line"></i>
                <div>Grafik Statistik Penjualan 30 Hari Terakhir</div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="two-column">
        <!-- Recent Orders -->
        <div class="content-section">
            <div class="section-header">
                <div>
                    <div class="section-title">Pesanan Terbaru</div>
                    <div class="section-subtitle">5 pesanan terakhir</div>
                </div>
                <button class="btn-view-all" onclick="window.location.href='#'">Lihat Semua</button>
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer }}</td>
                            <td>{{ $order->product }}</td>
                            <td><span class="status {{ $order->status_class }}">{{ $order->status }}</span></td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Top Products -->
        <div class="content-section">
            <div class="section-header">
                <div>
                    <div class="section-title">Produk Terlaris</div>
                    <div class="section-subtitle">Berdasarkan penjualan bulan ini</div>
                </div>
                <button class="btn-view-all" onclick="window.location.href='#'">Lihat Semua</button>
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Rating</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <span>{{ $product->rating }}</span>
                                </div>
                            </td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        © 2026 DEPUTYUKU DI DESKTOP • Selamat Mengelola Toko Sepatu Dusunwara Cuma | Versi 2.10
    </div>
@endsection

@push('scripts')
<script>
    // Additional scripts if needed
    console.log('Dashboard loaded');
</script>
@endpush