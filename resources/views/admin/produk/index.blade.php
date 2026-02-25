@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')
@section('page-description', 'Management produk sepatu toko Anda')

@push('styles')
<style>
    /* Product Page Specific Styles */
    .product-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .product-stat-card {
        background: white;
        border-radius: 15px;
        padding: 22px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
        border-left: 4px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .product-stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 60px;
        border-radius: 0 0 0 60px;
        opacity: 0.08;
    }

    .product-stat-card:nth-child(1) { border-left-color: var(--primary); }
    .product-stat-card:nth-child(1)::after { background: var(--primary); }
    .product-stat-card:nth-child(2) { border-left-color: var(--success); }
    .product-stat-card:nth-child(2)::after { background: var(--success); }
    .product-stat-card:nth-child(3) { border-left-color: var(--warning); }
    .product-stat-card:nth-child(3)::after { background: var(--warning); }
    .product-stat-card:nth-child(4) { border-left-color: var(--accent); }
    .product-stat-card:nth-child(4)::after { background: var(--accent); }

    .product-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 12px;
    }

    .product-stat-card:nth-child(1) .stat-icon { background: rgba(229, 9, 20, 0.12); color: var(--primary); }
    .product-stat-card:nth-child(2) .stat-icon { background: rgba(46, 204, 113, 0.12); color: var(--success); }
    .product-stat-card:nth-child(3) .stat-icon { background: rgba(243, 156, 18, 0.12); color: var(--warning); }
    .product-stat-card:nth-child(4) .stat-icon { background: rgba(0, 180, 216, 0.12); color: var(--accent); }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: var(--secondary);
        line-height: 1;
    }

    .stat-label {
        font-size: 13px;
        color: var(--gray);
        margin-top: 6px;
        font-weight: 500;
    }

    /* Toolbar */
    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .toolbar-left {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        min-width: 280px;
    }

    .search-box input {
        width: 100%;
        padding: 10px 15px 10px 42px;
        border: 2px solid var(--gray-light);
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        transition: all 0.3s;
        background: white;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(229, 9, 20, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        font-size: 14px;
    }

    .filter-select {
        padding: 10px 35px 10px 15px;
        border: 2px solid var(--gray-light);
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236c757d' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(229, 9, 20, 0.1);
    }

    .btn-add-product {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        border: none;
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        text-decoration: none;
        font-family: 'Inter', sans-serif;
        white-space: nowrap;
    }

    .btn-add-product:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(229, 9, 20, 0.35);
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .card-image-wrapper {
        position: relative;
        height: 220px;
        background: #f8f9fa;
        overflow: hidden;
    }

    .card-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .product-card:hover .card-image-wrapper img {
        transform: scale(1.1);
    }

    .card-badges {
        position: absolute;
        top: 15px;
        left: 15px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        z-index: 2;
    }

    .badge-item {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .badge-active { background: #2ecc71; color: white; }
    .badge-inactive { background: #95a5a6; color: white; }
    .badge-featured { background: #f1c40f; color: #544403; }

    .card-actions-overlay {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.3s ease;
        z-index: 2;
    }

    .product-card:hover .card-actions-overlay {
        opacity: 1;
        transform: translateX(0);
    }

    .btn-action-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--secondary);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        transition: all 0.2s;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-action-circle:hover {
        background: var(--primary);
        color: white;
        transform: scale(1.1);
    }

    .card-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-category {
        font-size: 12px;
        color: var(--primary);
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }

    .card-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--secondary);
        margin-bottom: 10px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 46px;
    }

    .card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f2f5;
    }

    .card-price-box {
        display: flex;
        flex-direction: column;
    }

    .price-main {
        font-size: 18px;
        font-weight: 900;
        color: var(--secondary);
    }

    .price-discount {
        color: var(--primary);
    }

    .price-old {
        font-size: 12px;
        text-decoration: line-through;
        color: var(--gray);
    }

    .card-stock {
        text-align: right;
    }

    .stock-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-ok-pill { background: rgba(46, 204, 113, 0.1); color: #27ae60; }
    .stock-low-pill { background: rgba(243, 156, 18, 0.1); color: #d35400; }
    .stock-empty-pill { background: rgba(231, 76, 60, 0.1); color: #c0392b; }

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 10px;
    }

    .toggle-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px;
        border-top: 1px solid #f0f2f5;
    }

    .pagination-info {
        font-size: 13px;
        color: var(--gray);
    }

    .pagination-links {
        display: flex;
        gap: 5px;
    }

    .pagination-links .page-link {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        border: 1px solid var(--gray-light);
        color: var(--secondary);
        text-decoration: none;
        transition: all 0.2s;
        background: white;
    }

    .pagination-links .page-link:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .pagination-links .page-link.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .pagination-links .page-link.disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Alert Messages */
    .alert-custom {
        padding: 14px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 500;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .alert-success {
        background: rgba(46, 204, 113, 0.12);
        color: #1a9d54;
        border: 1px solid rgba(46, 204, 113, 0.25);
    }

    .alert-danger {
        background: rgba(231, 76, 60, 0.12);
        color: #c0392b;
        border: 1px solid rgba(231, 76, 60, 0.25);
    }

    .alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
        opacity: 0.5;
        transition: opacity 0.2s;
        color: inherit;
    }

    .alert-close:hover {
        opacity: 1;
    }

    /* Delete Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal-box {
        background: white;
        border-radius: 18px;
        padding: 35px;
        max-width: 420px;
        width: 90%;
        text-align: center;
        animation: modalPop 0.3s ease;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    .modal-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(231, 76, 60, 0.12);
        color: var(--danger);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin: 0 auto 18px;
    }

    .modal-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 8px;
    }

    .modal-text {
        font-size: 14px;
        color: var(--gray);
        margin-bottom: 25px;
        line-height: 1.5;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
    }

    .modal-btn {
        padding: 10px 28px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
    }

    .modal-btn-cancel {
        background: var(--gray-light);
        color: var(--secondary);
    }

    .modal-btn-cancel:hover {
        background: #d5d8dc;
    }

    .modal-btn-delete {
        background: var(--danger);
        color: white;
    }

    .modal-btn-delete:hover {
        background: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 50px;
        color: var(--gray-light);
        margin-bottom: 15px;
    }

    .empty-state h3 {
        font-size: 18px;
        color: var(--secondary);
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--gray);
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* Category Badge */
    .category-badge {
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        background: rgba(0, 180, 216, 0.1);
        color: var(--accent);
        display: inline-block;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .product-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .product-stats {
            grid-template-columns: 1fr;
        }

        .toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .toolbar-left {
            flex-direction: column;
        }

        .search-box {
            min-width: unset;
            width: 100%;
        }

        .filter-select {
            width: 100%;
        }

        .products-table-wrapper {
            overflow-x: auto;
        }
    }
</style>
@endpush

@section('content')
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert-custom alert-success" id="alertSuccess">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-custom alert-danger" id="alertError">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="product-stats">
        <div class="product-stat-card">
            <div class="stat-icon"><i class="fas fa-shoe-prints"></i></div>
            <div class="stat-number">{{ number_format($totalProducts) }}</div>
            <div class="stat-label">Total Produk</div>
        </div>
        <div class="product-stat-card">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-number">{{ number_format($activeProducts) }}</div>
            <div class="stat-label">Produk Aktif</div>
        </div>
        <div class="product-stat-card">
            <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-number">{{ number_format($lowStockProducts) }}</div>
            <div class="stat-label">Stok Rendah (≤5)</div>
        </div>
        <div class="product-stat-card">
            <div class="stat-icon"><i class="fas fa-star"></i></div>
            <div class="stat-number">{{ number_format($featuredProducts) }}</div>
            <div class="stat-label">Produk Featured</div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="toolbar-left">
            <form method="GET" action="{{ route('admin.produk.index') }}" id="filterForm" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" placeholder="Cari produk, SKU, brand..." value="{{ request('search') }}">
                </div>
                <select name="category" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                <select name="status" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </form>
        </div>
        <a href="{{ route('admin.produk.create') }}" class="btn-add-product">
            <i class="fas fa-plus"></i>
            Tambah Produk
        </a>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="card-image-wrapper">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #eee; color: #ccc;">
                                <i class="fas fa-shoe-prints fa-4x"></i>
                            </div>
                        @endif
                        
                        <div class="card-badges">
                            @if($product->is_active)
                                <span class="badge-item badge-active">Aktif</span>
                            @else
                                <span class="badge-item badge-inactive">Nonaktif</span>
                            @endif
                            @if($product->is_featured)
                                <span class="badge-item badge-featured">Featured</span>
                            @endif
                        </div>

                        <div class="card-actions-overlay">
                            <a href="{{ route('admin.produk.show', $product) }}" class="btn-action-circle" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.produk.edit', $product) }}" class="btn-action-circle" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')" class="btn-action-circle" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-content">
                        <span class="card-category">{{ $product->category ?? 'Tanpa Kategori' }}</span>
                        <h3 class="card-title">{{ $product->name }}</h3>
                        
                        <div class="card-meta">
                            <div class="card-price-box">
                                @if($product->discount_price && $product->discount_price < $product->price)
                                    <span class="price-old">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="price-main price-discount">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                @else
                                    <span class="price-main">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <div class="card-stock">
                                @if($product->stock <= 0)
                                    <span class="stock-pill stock-empty-pill"><i class="fas fa-times-circle"></i> Habis</span>
                                @elseif($product->stock <= 5)
                                    <span class="stock-pill stock-low-pill"><i class="fas fa-exclamation-triangle"></i> Terbatas: {{ $product->stock }}</span>
                                @else
                                    <span class="stock-pill stock-ok-pill"><i class="fas fa-check-circle"></i> Stok: {{ $product->stock }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <label class="toggle-label">
                                Status
                                <label class="toggle-switch">
                                    <input type="checkbox" {{ $product->is_active ? 'checked' : '' }} onchange="toggleStatus({{ $product->id }}, this)">
                                    <span class="toggle-slider"></span>
                                </label>
                            </label>
                            <label class="toggle-label">
                                Featured
                                <label class="toggle-switch featured">
                                    <input type="checkbox" {{ $product->is_featured ? 'checked' : '' }} onchange="toggleFeatured({{ $product->id }}, this)">
                                    <span class="toggle-slider"></span>
                                </label>
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper" style="background: white; border-radius: 15px; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);">
            <div class="pagination-info">
                Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
            </div>
            <div class="pagination-links">
                @if($products->onFirstPage())
                    <span class="page-link disabled"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="page-link"><i class="fas fa-chevron-left"></i></a>
                @endif

                @foreach($products->links()->elements[0] ?? [] as $page => $url)
                    @if($page == $products->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach

                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="page-link"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="page-link disabled"><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>Belum ada produk</h3>
            <p>Mulai tambah produk sepatu pertama Anda</p>
            <a href="{{ route('admin.produk.create') }}" class="btn-add-product" style="display: inline-flex;">
                <i class="fas fa-plus"></i>
                Tambah Produk Pertama
            </a>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon">
                <i class="fas fa-trash-alt"></i>
            </div>
            <div class="modal-title">Hapus Produk?</div>
            <div class="modal-text">
                Apakah Anda yakin ingin menghapus produk <strong id="deleteProductName"></strong>? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-btn modal-btn-delete">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2026 SEPATUKU.ID Admin • Kelola Produk Sepatu Anda
    </div>
@endsection

@push('scripts')
<script>
    // Auto-dismiss alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert-custom');
        alerts.forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            alert.style.transition = 'all 0.3s';
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);

    // Toggle Status
    function toggleStatus(productId, el) {
        fetch(`{{ url('admin/produk') }}/${productId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                el.checked = !el.checked;
            }
        })
        .catch(() => {
            el.checked = !el.checked;
        });
    }

    // Toggle Featured
    function toggleFeatured(productId, el) {
        fetch(`{{ url('admin/produk') }}/${productId}/toggle-featured`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                el.checked = !el.checked;
            }
        })
        .catch(() => {
            el.checked = !el.checked;
        });
    }

    // Delete Confirmation
    function confirmDelete(productId, productName) {
        document.getElementById('deleteProductName').textContent = productName;
        document.getElementById('deleteForm').action = `{{ url('admin/produk') }}/${productId}`;
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('show');
    }

    // Close modal on overlay click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
@endpush
