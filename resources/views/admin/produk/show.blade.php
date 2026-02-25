@extends('layouts.admin')

@section('title', 'Detail Produk - ' . $product->name)
@section('page-title', 'Detail Produk')
@section('page-description', $product->name)

@push('styles')
<style>
    .detail-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .detail-header-actions { display: flex; gap: 10px; }
    .btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 8px 18px; border-radius: 10px; background: var(--gray-light); color: var(--secondary); text-decoration: none; font-weight: 600; font-size: 13px; transition: all 0.3s; }
    .btn-back:hover { background: #d5d8dc; }
    .btn-edit { display: inline-flex; align-items: center; gap: 8px; padding: 8px 18px; border-radius: 10px; background: linear-gradient(135deg, var(--warning), #e67e22); color: white; text-decoration: none; font-weight: 600; font-size: 13px; transition: all 0.3s; }
    .btn-edit:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(243,156,18,0.3); }

    .detail-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 25px; margin-bottom: 30px; }
    .detail-card { background: white; border-radius: 15px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); padding: 25px; }
    .detail-card-title { font-size: 16px; font-weight: 700; color: var(--secondary); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; padding-bottom: 12px; border-bottom: 2px solid var(--gray-light); }
    .detail-card-title i { color: var(--primary); font-size: 15px; }

    .detail-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 12px 0; border-bottom: 1px solid #f0f2f5; }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { font-size: 13px; color: var(--gray); font-weight: 500; min-width: 120px; }
    .detail-value { font-size: 14px; color: var(--secondary); font-weight: 500; text-align: right; max-width: 60%; }

    .price-display { font-size: 24px; font-weight: 700; color: var(--primary); }
    .price-display .original { text-decoration: line-through; color: var(--gray); font-size: 16px; font-weight: 400; display: block; margin-bottom: 2px; }
    .price-display .discount-badge { display: inline-block; background: rgba(229,9,20,0.1); color: var(--primary); padding: 3px 10px; border-radius: 6px; font-size: 12px; margin-left: 8px; }

    .status-badge { padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .status-active { background: rgba(46,204,113,0.12); color: var(--success); }
    .status-inactive { background: rgba(231,76,60,0.12); color: var(--danger); }
    .status-featured { background: rgba(243,156,18,0.12); color: var(--warning); }

    .tag-list { display: flex; flex-wrap: wrap; gap: 6px; justify-content: flex-end; }
    .tag { background: rgba(0,180,216,0.1); color: var(--accent); padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }

    .stock-indicator { display: flex; align-items: center; gap: 8px; }
    .stock-bar { flex: 1; height: 8px; background: var(--gray-light); border-radius: 4px; overflow: hidden; min-width: 80px; }
    .stock-fill { height: 100%; border-radius: 4px; transition: width 0.5s ease; }
    .stock-fill.high { background: var(--success); }
    .stock-fill.medium { background: var(--warning); }
    .stock-fill.low { background: var(--danger); }

    .description-content { font-size: 14px; color: #555; line-height: 1.7; white-space: pre-wrap; }
    .spec-content { font-size: 14px; color: #555; line-height: 1.7; white-space: pre-wrap; background: #f8f9fa; padding: 15px; border-radius: 10px; }

    .meta-info { font-size: 12px; color: var(--gray); margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--gray-light); }
    .meta-info span { margin-right: 20px; }

    @media (max-width: 992px) { .detail-grid { grid-template-columns: 1fr; } }
    @media (max-width: 768px) { .detail-header { flex-direction: column; gap: 15px; align-items: stretch; } .detail-header-actions { justify-content: center; } }
</style>
@endpush

@section('content')
    <div class="detail-header">
        <a href="{{ route('admin.produk.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Daftar</a>
        <div class="detail-header-actions">
            <a href="{{ route('admin.produk.edit', $product) }}" class="btn-edit"><i class="fas fa-edit"></i> Edit Produk</a>
        </div>
    </div>

    <div class="detail-grid">
        <!-- Main Info -->
        <div>
            <div class="detail-card" style="margin-bottom: 25px;">
                <div class="detail-card-title"><i class="fas fa-info-circle"></i> Informasi Produk</div>
                <div class="detail-row">
                    <span class="detail-label">Nama Produk</span>
                    <span class="detail-value" style="font-weight: 700;">{{ $product->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Slug</span>
                    <span class="detail-value" style="font-family: monospace; font-size: 13px;">{{ $product->slug }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">SKU</span>
                    <span class="detail-value">{{ $product->sku ?? '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Brand</span>
                    <span class="detail-value">{{ $product->brand ?? '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Kategori</span>
                    <span class="detail-value">
                        @if($product->category)
                            <span class="tag">{{ $product->category }}</span>
                        @else - @endif
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Ukuran</span>
                    <span class="detail-value">
                        @if($product->sizes && count($product->sizes))
                            <div class="tag-list">
                                @foreach($product->sizes as $size)
                                    <span class="tag">{{ $size }}</span>
                                @endforeach
                            </div>
                        @else - @endif
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Warna</span>
                    <span class="detail-value">
                        @if($product->colors && count($product->colors))
                            <div class="tag-list">
                                @foreach($product->colors as $color)
                                    <span class="tag" style="background: rgba(155,89,182,0.1); color: #8e44ad;">{{ $color }}</span>
                                @endforeach
                            </div>
                        @else - @endif
                    </span>
                </div>
            </div>

            <!-- Description -->
            <div class="detail-card" style="margin-bottom: 25px;">
                <div class="detail-card-title"><i class="fas fa-align-left"></i> Deskripsi</div>
                @if($product->description)
                    <div class="description-content">{{ $product->description }}</div>
                @else
                    <p style="color: var(--gray); font-size: 14px;">Belum ada deskripsi</p>
                @endif
            </div>

            <!-- Specifications -->
            @if($product->specifications)
            <div class="detail-card">
                <div class="detail-card-title"><i class="fas fa-clipboard-list"></i> Spesifikasi</div>
                <div class="spec-content">{{ $product->specifications }}</div>
            </div>
            @endif
        </div>

        <!-- Sidebar Info -->
        <div>
            <!-- Price Card -->
            <div class="detail-card" style="margin-bottom: 25px;">
                <div class="detail-card-title"><i class="fas fa-tag"></i> Harga</div>
                <div class="price-display">
                    @if($product->has_discount)
                        <span class="original">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                        @php $disc = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                        <span class="discount-badge">-{{ $disc }}%</span>
                    @else
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    @endif
                </div>
            </div>

            <!-- Stock Card -->
            <div class="detail-card" style="margin-bottom: 25px;">
                <div class="detail-card-title"><i class="fas fa-cubes"></i> Stok</div>
                <div style="text-align: center; padding: 10px 0;">
                    <div style="font-size: 36px; font-weight: 700; color: {{ $product->stock > 10 ? 'var(--success)' : ($product->stock > 0 ? 'var(--warning)' : 'var(--danger)') }};">
                        {{ $product->stock }}
                    </div>
                    <div style="font-size: 13px; color: var(--gray); margin-top: 5px;">unit tersedia</div>
                </div>
                <div class="stock-indicator" style="margin-top: 10px;">
                    <div class="stock-bar">
                        @php $stockPerc = min(100, ($product->stock / max(100, $product->stock)) * 100); @endphp
                        <div class="stock-fill {{ $product->stock > 10 ? 'high' : ($product->stock > 0 ? 'medium' : 'low') }}" style="width: {{ $stockPerc }}%;"></div>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="detail-card">
                <div class="detail-card-title"><i class="fas fa-toggle-on"></i> Status</div>
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="status-badge {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Featured</span>
                    <span class="status-badge {{ $product->is_featured ? 'status-featured' : 'status-inactive' }}">
                        {{ $product->is_featured ? 'Ya' : 'Tidak' }}
                    </span>
                </div>

                <div class="meta-info">
                    <span><i class="fas fa-calendar"></i> Dibuat: {{ $product->created_at?->format('d M Y H:i') ?? '-' }}</span><br>
                    <span><i class="fas fa-clock"></i> Update: {{ $product->updated_at?->format('d M Y H:i') ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">© 2026 SepatuWara Admin • Detail Produk</div>
@endsection
