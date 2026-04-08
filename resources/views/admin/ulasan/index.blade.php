@extends('layouts.admin')

@section('title', 'Manajemen Ulasan')
@section('page-title', 'Ulasan Pelanggan')
@section('page-description', 'Kelola semua ulasan dan feedback dari pelanggan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    /* Stats Grid */
    .premium-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .stat-card {
        background: var(--surface); border-radius: var(--radius-lg); padding: 24px;
        box-shadow: var(--shadow-md); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative; overflow: hidden; border: 1px solid rgba(255,255,255,0.8);
        display: flex; align-items: center; gap: 20px; z-index: 1;
    }
    .stat-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }
    .stat-icon-wrapper {
        width: 56px; height: 56px; border-radius: var(--radius-md); display: flex;
        align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    }
    .stat-value { font-size: 28px; font-weight: 800; line-height: 1; margin-bottom: 4px; }
    .stat-label { font-size: 13px; font-weight: 600; color: var(--text-muted); }

    /* Table Container */
    .premium-table-container {
        background: var(--surface); border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md); overflow: hidden; border: 1px solid var(--surface-200);
    }
    .table-header-bar {
        padding: 20px 24px; border-bottom: 1px solid var(--surface-200);
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;
    }
    .table-title { font-size: 18px; font-weight: 800; color: var(--text-main); display: flex; align-items: center; gap: 10px; }
    .table-title i { color: #f59e0b; }

    /* Search & Filter */
    .search-filter-bar { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
    .search-input-wrapper { position: relative; }
    .search-input-wrapper i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 14px; }
    .search-input { padding: 10px 16px 10px 40px; border: 2px solid var(--surface-200); border-radius: var(--radius-md); background: var(--surface-50); font-size: 14px; font-weight: 500; min-width: 250px; transition: all 0.3s; }
    .search-input:focus { outline: none; border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1); }
    .filter-select { padding: 10px 16px; border: 2px solid var(--surface-200); border-radius: var(--radius-md); background: var(--surface-50); font-size: 14px; font-weight: 500; cursor: pointer; }

    /* Table */
    .premium-table { width: 100%; border-collapse: collapse; }
    .premium-table thead th { padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); background: var(--surface-50); border-bottom: 2px solid var(--surface-200); }
    .premium-table tbody td { padding: 16px 20px; border-bottom: 1px solid var(--surface-100); font-size: 14px; vertical-align: middle; }
    .premium-table tbody tr { transition: background 0.2s; }
    .premium-table tbody tr:hover { background: var(--surface-50); }

    /* Review Items */
    .reviewer-info { display: flex; align-items: center; gap: 12px; }
    .reviewer-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; flex-shrink: 0; }
    .reviewer-name { font-weight: 700; color: var(--text-main); font-size: 14px; }
    .reviewer-email { font-size: 12px; color: var(--text-muted); }

    .product-badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: rgba(79, 70, 229, 0.08); color: #4f46e5; border-radius: 6px; font-size: 12px; font-weight: 600; max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    .stars { color: #f59e0b; font-size: 13px; letter-spacing: 1px; }
    .stars-muted { color: #e0e0e0; }

    .comment-text { font-size: 13px; color: var(--text-main); line-height: 1.5; max-width: 280px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

    .review-date { font-size: 12px; color: var(--text-muted); white-space: nowrap; }

    /* Actions */
    .action-group { display: flex; gap: 8px; justify-content: center; }
    .action-btn { width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; background: var(--surface-50); color: var(--text-muted); border: 1px solid var(--surface-200); transition: all 0.3s; text-decoration: none; cursor: pointer; font-size: 13px; }
    .btn-edit:hover { background: #3b82f6; color: white; border-color: #3b82f6; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
    .btn-delete:hover { background: #ef4444; color: white; border-color: #ef4444; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }

    /* Empty */
    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-icon { width: 80px; height: 80px; border-radius: 50%; background: var(--surface-50); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 32px; color: var(--text-muted); }
    .empty-title { font-size: 18px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; }
    .empty-desc { font-size: 14px; color: var(--text-muted); }

    /* Pagination */
    .pagination-wrapper { padding: 20px 24px; display: flex; justify-content: center; }

    @media (max-width: 768px) {
        .table-header-bar { flex-direction: column; align-items: stretch; }
        .search-filter-bar { flex-direction: column; }
        .search-input { min-width: 100%; }
        .premium-table { font-size: 12px; }
    }
</style>
@endpush

@section('content')
    {{-- Statistics --}}
    <div class="premium-stats-grid">
        <div class="stat-card">
            <div class="stat-icon-wrapper" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                <i class="fas fa-star"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalReviews }}</div>
                <div class="stat-label">Total Ulasan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <div class="stat-value">{{ $avgRating ? number_format($avgRating, 1) : '0' }}</div>
                <div class="stat-label">Rata-rata Rating</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper" style="background: rgba(79, 70, 229, 0.1); color: #4f46e5;">
                <i class="fas fa-award"></i>
            </div>
            <div>
                <div class="stat-value">{{ $fiveStarCount }}</div>
                <div class="stat-label">Ulasan Bintang 5</div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="premium-table-container">
        <div class="table-header-bar">
            <div class="table-title">
                <i class="fas fa-star"></i> Daftar Ulasan
            </div>
            <form method="GET" class="search-filter-bar">
                <div class="search-input-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="search-input" placeholder="Cari ulasan, user, produk..." value="{{ request('search') }}">
                </div>
                <select name="rating" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Rating</option>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                    @endfor
                </select>
            </form>
        </div>

        @if($reviews->count() > 0)
        <div style="overflow-x: auto;">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td>
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">{{ strtoupper(substr($review->user->name ?? 'U', 0, 2)) }}</div>
                                <div>
                                    <div class="reviewer-name">{{ $review->user->name ?? 'User Terhapus' }}</div>
                                    <div class="reviewer-email">{{ $review->user->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="product-badge">
                                <i class="fas fa-shoe-prints"></i>
                                {{ $review->product->name ?? 'Produk Terhapus' }}
                            </span>
                        </td>
                        <td>
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star {{ $i > $review->rating ? 'stars-muted' : '' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td>
                            <div class="comment-text">{{ $review->comment }}</div>
                        </td>
                        <td>
                            <span class="review-date">{{ $review->created_at->format('d M Y') }}</span>
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.ulasan.edit', $review) }}" class="action-btn btn-edit" title="Edit Ulasan">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.ulasan.destroy', $review) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Hapus Ulasan">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($reviews->hasPages())
        <div class="pagination-wrapper">
            {{ $reviews->links('pagination::bootstrap-4') }}
        </div>
        @endif

        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="far fa-comment-dots"></i></div>
            <div class="empty-title">Belum Ada Ulasan</div>
            <div class="empty-desc">Ulasan dari pelanggan akan muncul di sini setelah mereka menyelesaikan pesanan.</div>
        </div>
        @endif
    </div>
@endsection
