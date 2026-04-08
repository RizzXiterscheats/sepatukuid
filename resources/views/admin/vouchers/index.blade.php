@extends('layouts.admin')

@section('title', 'Kelola Voucher')
@section('page-title', 'Kelola Voucher')
@section('page-description', 'Management kode promo dan diskon untuk pelanggan')

@push('styles')
<style>
    .voucher-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    .voucher-stat-card {
        background: white;
        border-radius: 15px;
        padding: 22px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--primary);
    }
    .stat-label { font-size: 13px; color: var(--gray); font-weight: 500; }
    .stat-number { font-size: 28px; font-weight: 700; color: var(--secondary); }

    .voucher-table-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }
    .table-custom { width: 100%; border-collapse: collapse; }
    .table-custom th { text-align: left; padding: 15px; border-bottom: 2px solid #f0f2f5; color: var(--gray); font-size: 13px; text-transform: uppercase; }
    .table-custom td { padding: 15px; border-bottom: 1px solid #f0f2f5; font-size: 14px; vertical-align: middle; }
    
    .code-badge {
        background: rgba(229, 57, 53, 0.1);
        color: var(--primary);
        padding: 5px 12px;
        border-radius: 6px;
        font-family: monospace;
        font-weight: 700;
        font-size: 15px;
    }

    .badge-status {
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
    }
    .status-active { background: #e8f5e9; color: #2e7d32; }
    .status-inactive { background: #ffebee; color: #c62828; }

    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-edit { background: #e3f2fd; color: #1976d2; }
    .btn-delete { background: #ffebee; color: #c62828; border: none; cursor: pointer; }
</style>
@endpush

@section('content')
    @if(session('success'))
        <div class="alert-custom alert-success" style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="voucher-stats">
        <div class="voucher-stat-card">
            <div class="stat-label">Total Voucher</div>
            <div class="stat-number">{{ $vouchers->total() }}</div>
        </div>
        <div class="voucher-stat-card" style="border-left-color: #2e7d32;">
            <div class="stat-label">Voucher Aktif</div>
            <div class="stat-number">{{ \App\Models\Voucher::where('is_active', true)->count() }}</div>
        </div>
        <div class="voucher-stat-card" style="border-left-color: #f39c12;">
            <div class="stat-label">Total Penggunaan</div>
            <div class="stat-number">{{ \App\Models\Voucher::sum('used_count') }}</div>
        </div>
    </div>

    <div class="voucher-table-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-weight: 800;">Daftar Voucher</h3>
            <a href="{{ route('admin.vouchers.create') }}" class="btn-add-product" style="text-decoration: none; background: var(--primary); color: white; padding: 10px 20px; border-radius: 10px; font-weight: 600;">
                <i class="fas fa-plus"></i> Tambah Voucher
            </a>
        </div>

        <table class="table-custom">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tipe</th>
                    <th>Nilai</th>
                    <th>Min. Belanja</th>
                    <th>Berlaku Sampai</th>
                    <th>Penggunaan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vouchers as $voucher)
                <tr>
                    <td><span class="code-badge">{{ $voucher->code }}</span></td>
                    <td>{{ ucfirst($voucher->type) }}</td>
                    <td>
                        @if($voucher->type == 'percent')
                            {{ number_format($voucher->value, 0) }}%
                        @else
                            Rp {{ number_format($voucher->value, 0, ',', '.') }}
                        @endif
                    </td>
                    <td>Rp {{ number_format($voucher->min_purchase, 0, ',', '.') }}</td>
                    <td>{{ $voucher->expires_at ? $voucher->expires_at->format('d M Y') : 'Tanpa Batas' }}</td>
                    <td>{{ $voucher->used_count }} / {{ $voucher->usage_limit ?? '∞' }}</td>
                    <td>
                        <form action="{{ route('admin.vouchers.toggle', $voucher) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                <span class="badge-status {{ $voucher->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $voucher->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </button>
                        </form>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="btn-action btn-edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" onsubmit="return confirm('Hapus voucher ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: var(--gray);">Belum ada voucher.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $vouchers->links() }}
        </div>
    </div>
@endsection
