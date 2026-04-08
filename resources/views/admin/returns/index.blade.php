@extends('layouts.admin')

@section('title', 'Daftar Pengembalian Dana')
@section('page-title', 'Manajemen Pengembalian')
@section('page-description', 'Tinjau dan kelola permohonan return dari pelanggan')

@section('content')
<div class="content-section">
    <div class="section-header">
        <div>
            <h2 class="section-title">Semua Permohonan Return</h2>
            <p class="section-subtitle">Total {{ $returns->total() }} permohonan ditemukan</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background: var(--success); color: white; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Total Refund</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($returns as $return)
                <tr>
                    <td><strong>#REF-{{ $return->id }}</strong></td>
                    <td>
                        <div style="font-weight: 700;">{{ $return->user->name }}</div>
                        <div style="font-size: 12px; color: var(--gray);">{{ $return->user->email }}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600;">{{ $return->item->product->name ?? 'Produk Dihapus' }}</div>
                        <div style="font-size: 11px; color: var(--gray);">Order: #{{ $return->item->order->order_number }}</div>
                    </td>
                    <td style="color: var(--primary); font-weight: 700;">
                        Rp {{ number_format($return->refund_amount, 0, ',', '.') }}
                    </td>
                    <td>
                        <span style="font-size: 13px;">{{ $return->reason }}</span>
                    </td>
                    <td>
                        @php
                            $statusClass = [
                                'pending' => 'status-pending',
                                'approved' => 'status-proses',
                                'refunded' => 'status-lunas',
                                'rejected' => 'status-ditandatangani', // Using existing CSS classes for simplicity
                            ][$return->status] ?? 'status-pending';
                        @endphp
                        <span class="status {{ $statusClass }}">
                            @if($return->status == 'pending') <i class="fas fa-clock"></i> 
                            @elseif($return->status == 'approved') <i class="fas fa-check"></i>
                            @elseif($return->status == 'refunded') <i class="fas fa-money-bill-wave"></i>
                            @else <i class="fas fa-times"></i> @endif
                            {{ ucfirst($return->status) }}
                        </span>
                    </td>
                    <td>{{ $return->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.returns.show', $return) }}" class="btn-view-all">
                            Tinjau <i class="fas fa-chevron-right"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $returns->links() }}
    </div>
</div>
@endsection
