@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <span class="stat-title">Total Produk</span>
            </div>
            <div class="stat-number">{{ number_format($totalProducts) }}</div>
            <div class="stat-change positive">
                <i class="fa-solid fa-arrow-down"></i>
                <span>{{ $productsDown }} produk turun</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <span class="stat-title">Pesanan Hari Ini</span>
            </div>
            <div class="stat-number">{{ $ordersToday }}</div>
            <div class="stat-change negative">
                <i class="fa-solid fa-arrow-up"></i>
                <span>{{ $ordersPending }} pesanan pending</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-solid fa-face-smile"></i>
                </div>
                <span class="stat-title">Kepuasan Pelanggan</span>
            </div>
            <div class="stat-number">{{ $customerSatisfaction }}%</div>
            <div class="stat-change positive">
                <i class="fa-solid fa-arrow-up"></i>
                <span>{{ $satisfactionTarget }}% dari target</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-solid fa-money-bill"></i>
                </div>
                <span class="stat-title">Pendapatan Bulan Ini</span>
            </div>
            <div class="stat-number">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</div>
            <div class="stat-change positive">
                <i class="fa-solid fa-arrow-up"></i>
                <span>{{ $revenuePercentage }}% dari total</span>
            </div>
        </div>
    </div>
    
    <!-- Chart Section -->
    <div class="chart-section">
        <div class="chart-header">
            <h2>Statistik Penjualan Sepatu 30 Hari Terakhir</h2>
            <div class="chart-categories">
                <span class="category-badge active">Kategori Sepatu</span>
                <span class="category-badge">Running</span>
                <span class="category-badge">Basket</span>
                <span class="category-badge">Casual</span>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
    
    <!-- Tables Grid -->
    <div class="tables-grid">
        <!-- Recent Orders Table -->
        <div class="table-card">
            <div class="table-header">
                <h2>Pesanan Terbaru</h2>
                <span class="view-all">Lihat Semua <i class="fa-solid fa-arrow-right"></i></span>
            </div>
            
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
                        <td>
                            @php
                                $statusClass = '';
                                switch($order->status) {
                                    case 'Pending':
                                        $statusClass = 'status-pending';
                                        break;
                                    case 'Disetujui':
                                        $statusClass = 'status-approved';
                                        break;
                                    case 'Dikirim':
                                        $statusClass = 'status-shipped';
                                        break;
                                    default:
                                        $statusClass = 'status-other';
                                }
                            @endphp
                            <span class="status-badge {{ $statusClass }}">{{ $order->status }}</span>
                        </td>
                        <td class="price">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Top Products Table -->
        <div class="table-card">
            <div class="table-header">
                <h2>Produk Terlaris</h2>
                <span class="view-all">Lihat Semua <i class="fa-solid fa-arrow-right"></i></span>
            </div>
            
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
                            <span class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product->rating))
                                        <i class="fa-solid fa-star"></i>
                                    @elseif($i - $product->rating < 1 && $i - $product->rating > 0)
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                                {{ $product->rating }}
                            </span>
                        </td>
                        <td class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [
                    {
                        label: 'Running',
                        data: {!! json_encode($runningData) !!},
                        borderColor: '#E53935',
                        backgroundColor: 'rgba(229, 57, 53, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Basket',
                        data: {!! json_encode($basketData) !!},
                        borderColor: '#2196F3',
                        backgroundColor: 'rgba(33, 150, 243, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Casual',
                        data: {!! json_encode($casualData) !!},
                        borderColor: '#4CAF50',
                        backgroundColor: 'rgba(76, 175, 80, 0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // Category badge click
        const badges = document.querySelectorAll('.category-badge');
        badges.forEach(badge => {
            badge.addEventListener('click', function() {
                badges.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Di sini bisa ditambahkan logic untuk filter chart
                // alert('Filter: ' + this.textContent);
            });
        });
    });
</script>
@endpush