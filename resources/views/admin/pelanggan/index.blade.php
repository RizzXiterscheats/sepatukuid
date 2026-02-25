@extends('layouts.admin')

@section('title', 'Manajemen Pelanggan')
@section('page-title', 'Pelanggan')
@section('page-description', 'Kelola data pelanggan dan riwayat aktivitas mereka')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    

    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    /* Stats Grid */
    .premium-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 32px; }
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
    .icon-new { background: var(--success-gradient); }

    .stat-content { flex: 1; }
    .stat-value { font-size: 32px; font-weight: 800; line-height: 1.1; margin-bottom: 4px; letter-spacing: -0.5px; }
    .stat-label { font-size: 14px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }

    /* Main Container */
    .premium-container { background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); padding: 28px; border: 1px solid var(--surface-200); }
    
    /* Toolbar */
    .premium-toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; background: var(--surface-50); padding: 16px; border-radius: var(--radius-md); border: 1px solid var(--surface-200); }
    
    .search-group { position: relative; width: 400px; max-width: 100%; }
    .search-group i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 16px; transition: color 0.3s; }
    .search-input { width: 100%; padding: 12px 16px 12px 48px; border: 2px solid transparent; border-radius: var(--radius-md);
        background: var(--surface); color: var(--text-main); font-size: 14px; font-weight: 500; outline: none; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.3s ease; }
    .search-input:focus { border-color: #818cf8; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    .search-input:focus + i { color: #4f46e5; }
    
    .btn-reset { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: var(--radius-md); background: white; border: 1px solid #e2e8f0; color: #475569; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s; text-decoration: none; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .btn-reset:hover { background: #f8fafc; color: #ef4444; border-color: #fca5a5; }

    /* Table */
    .table-container { overflow-x: auto; border-radius: var(--radius-md); border: 1px solid var(--surface-200); }
    .premium-table { width: 100%; border-collapse: separate; border-spacing: 0; background: var(--surface); }
    .premium-table th { background: #f8fafc; padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 2px solid var(--surface-200); white-space: nowrap; }
    .premium-table td { padding: 16px 20px; border-bottom: 1px solid var(--surface-100); vertical-align: middle; font-size: 14px; font-weight: 500; transition: background-color 0.2s; }
    .premium-table tr:hover td { background-color: #f8fafc; }
    .premium-table tr:last-child td { border-bottom: none; }

    /* User Cell Info */
    .user-profile { display: flex; align-items: center; gap: 12px; }
    .user-avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--primary-gradient); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; flex-shrink: 0; box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2); }
    .user-info-text .name { font-weight: 700; color: var(--text-main); font-size: 15px; margin-bottom: 2px; }
    .user-info-text .email { font-size: 13px; color: var(--text-muted); }

    .date-joined { font-size: 13px; color: var(--text-muted); font-weight: 600; }
    .date-joined span { display: block; font-size: 12px; color: var(--text-light); }

    /* Stats Cells */
    .metric-badge { padding: 6px 12px; background: var(--surface-50); border: 1px solid var(--surface-200); border-radius: 20px; font-weight: 700; font-size: 13px; color: var(--text-main); display: inline-block; }
    .amount-cell { font-weight: 800; color: #10b981; font-size: 15px; }

    /* Actions */
    .action-group { display: flex; gap: 8px; justify-content: center; }
    .action-btn { width: 36px; height: 36px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; background: var(--surface-50); color: var(--text-muted); border: 1px solid var(--surface-200); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none; cursor: pointer; }
    .btn-view:hover { background: #4f46e5; color: white; border-color: #4f46e5; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
    .btn-delete:hover { background: #ef4444; color: white; border-color: #ef4444; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }

    /* Empty State */
    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-icon { font-size: 64px; color: var(--surface-200); margin-bottom: 20px; display: inline-block; animation: float 6s ease-in-out infinite; }
    .empty-title { font-size: 20px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; }
    .empty-desc { color: var(--text-muted); font-size: 14px; max-width: 400px; margin: 0 auto; line-height: 1.6; }

    /* Alerts */
    .premium-alert { display: flex; align-items: center; gap: 12px; padding: 16px 20px; border-radius: var(--radius-md); margin-bottom: 24px; font-weight: 600; font-size: 14px; animation: slideDown 0.4s ease-out; }
    .alert-success { background: rgba(16, 185, 129, 0.1); color: #065f46; border-left: 4px solid #10b981; }
    .alert-danger { background: rgba(239, 68, 68, 0.1); color: #991b1b; border-left: 4px solid #ef4444; }

    @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-10px); } 100% { transform: translateY(0px); } }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    /* Pagination */
    .pagination-wrapper { display: flex; justify-content: space-between; align-items: center; margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--surface-200); flex-wrap: wrap; gap: 15px; }
    .page-info { font-size: 14px; font-weight: 600; color: var(--text-muted); }

    @media (max-width: 768px) {
        .premium-toolbar { flex-direction: column; align-items: stretch; }
        .search-group { width: 100%; }
        .btn-reset { justify-content: center; }
    }
</style>
@endpush

@section('content')
    <!-- Premium Stats -->
    <div class="premium-stats-grid">
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-total">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($totalCustomers) }}</div>
                <div class="stat-label">Total Pelanggan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-new">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($newCustomersThisMonth) }}</div>
                <div class="stat-label">Pengguna Baru Bulan Ini</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="premium-alert alert-success">
            <i class="fas fa-check-circle" style="font-size: 20px;"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="premium-alert alert-danger">
            <i class="fas fa-exclamation-triangle" style="font-size: 20px;"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="premium-container">
        <form method="GET" action="{{ route('admin.pelanggan.index') }}" class="premium-toolbar">
            <div class="search-group">
                <input type="text" name="search" class="search-input" placeholder="Cari nama, email, atau no. telepon..." value="{{ request('search') }}">
                <i class="fas fa-search"></i>
            </div>
            
            @if(request('search'))
                <a href="{{ route('admin.pelanggan.index') }}" class="btn-reset">
                    <i class="fas fa-undo"></i> Reset
                </a>
            @endif
        </form>

        <div class="table-container">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>No Telepon</th>
                        <th>Tgl Bergabung</th>
                        <th style="text-align: center;">Total Pesanan</th>
                        <th style="text-align: right;">Total Belanja</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>
                                <div class="user-profile">
                                    <div class="user-avatar">{{ strtoupper(substr($customer->name, 0, 2)) }}</div>
                                    <div class="user-info-text">
                                        <div class="name">{{ $customer->name }}</div>
                                        <div class="email">{{ $customer->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: var(--text-main);">
                                    @if($customer->phone)
                                        <i class="fas fa-phone-alt" style="color: var(--text-muted); font-size: 12px; margin-right: 6px;"></i> {{ $customer->phone }}
                                    @else
                                        <span style="color: var(--text-muted); font-style: italic;">Belum diisi</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="date-joined">
                                    {{ $customer->created_at->format('d M Y') }}
                                    <span>{{ $customer->created_at->diffForHumans() }}</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span class="metric-badge">{{ number_format($customer->orders_count) }}x</span>
                            </td>
                            <td class="amount-cell" style="text-align: right;">
                                Rp {{ number_format($customer->total_spent, 0, ',', '.') }}
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.pelanggan.show', $customer) }}" class="action-btn btn-view" title="Lihat Profil & Riwayat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.pelanggan.destroy', $customer) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini? Perhatian: Anda tidak dapat menghapus pelanggan jika mereka sudah memiliki riwayat transaksi.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete" title="Hapus Pelanggan">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-users-slash"></i>
                                    </div>
                                    <div class="empty-title">Tidak Ada Pelanggan</div>
                                    <div class="empty-desc">
                                        @if(request('search'))
                                            Pencarian Anda tidak menemukan hasil apa pun. Coba gunakan kata kunci yang berbeda.
                                        @else
                                            Belum ada pengguna biasa (pelanggan) yang terdaftar di sistem.
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($customers->hasPages())
            <div class="pagination-wrapper">
                <div class="page-info">
                    Menampilkan <span style="color: var(--text-main);">{{ $customers->firstItem() ?? 0 }}</span> - <span style="color: var(--text-main);">{{ $customers->lastItem() ?? 0 }}</span> dari <span style="color: var(--text-main);">{{ $customers->total() }}</span> pelanggan
                </div>
                <div>
                    {{ $customers->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
@endsection
