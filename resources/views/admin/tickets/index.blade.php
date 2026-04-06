@extends('layouts.admin')

@section('title', 'Manajemen Tiket Bantuan')
@section('page-title', 'Helpdesk Tiket')
@section('page-description', 'Kelola keluhan dan pertanyaan dari pelanggan')

@push('styles')
<style>
    .kpi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
    .kpi-card { background: white; padding: 25px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--primary); }
    .kpi-card h3 { color: var(--text-muted); font-size: 14px; text-transform: uppercase; margin-bottom: 5px; }
    .kpi-card .number { font-size: 32px; font-weight: 800; color: var(--text-main); }
    
    .table-container { background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; min-width: 800px; }
    th { background: #f8fafc; padding: 16px 20px; text-align: left; font-size: 13px; font-weight: 700; color: var(--text-muted); border-bottom: 1px solid #e2e8f0; }
    td { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; font-size: 14px; vertical-align: middle; }
    
    .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; display: inline-block; }
    .status-open { background: #fee2e2; color: #dc2626; }
    .status-in_progress { background: #e0f2fe; color: #0284c7; }
    .status-closed { background: #dcfce3; color: #166534; }
    
    .btn-action { padding: 8px 12px; border-radius: var(--radius-md); font-weight: 600; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap; }
    .btn-view { background: #eff6ff; color: #3b82f6; }

    @media (max-width: 768px) {
        .kpi-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    <div class="kpi-grid">
        <div class="kpi-card" style="border-color: #dc2626;">
            <div><h3>Tiket Masuk (Open)</h3><div class="number">{{ $openTicketsCount }}</div></div>
            <i class="fa-solid fa-envelope-open-text" style="font-size: 40px; color: #fee2e2;"></i>
        </div>
        <div class="kpi-card" style="border-color: #0284c7;">
            <div><h3>Sedang Diproses</h3><div class="number">{{ $inProgressCount }}</div></div>
            <i class="fa-solid fa-comments" style="font-size: 40px; color: #e0f2fe;"></i>
        </div>
        <div class="kpi-card" style="border-color: #4f46e5;">
            <div><h3>Total Tiket Keseluruhan</h3><div class="number">{{ $tickets->total() }}</div></div>
            <i class="fa-solid fa-ticket" style="font-size: 40px; color: #e0e7ff;"></i>
        </div>
    </div>

    @if(session('success'))
        <div style="padding: 15px; background: #dcfce3; color: #166534; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Tiket</th>
                    <th>Pengirim</th>
                    <th>Subjek / Kendala</th>
                    <th>Kategori</th>
                    <th>Waktu (Dibuat)</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                <tr>
                    <td><strong>{{ $ticket->ticket_number }}</strong></td>
                    <td>{{ $ticket->user->name ?? 'Guest' }}<br><small style="color: #94a3b8;">{{ $ticket->user->email ?? '' }}</small></td>
                    <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $ticket->subject }}
                    </td>
                    <td><span style="background: #f1f5f9; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">{{ ucfirst($ticket->category) }}</span></td>
                    <td>{{ $ticket->created_at->diffForHumans() }}</td>
                    <td><span class="status-badge status-{{ $ticket->status }}">{{ str_replace('_', ' ', $ticket->status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn-action btn-view">
                            <i class="fa-solid fa-reply"></i> Balas
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center; padding: 30px; color: #94a3b8;">Belum ada antrean tiket saat ini.</td></tr>
                @endforelse
            </tbody>
        </table>
        
        <div style="padding: 20px;">
            {{ $tickets->links() }}
        </div>
    </div>
@endsection
