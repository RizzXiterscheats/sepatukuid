@extends('layouts.admin')

@section('title', 'Manajemen Petugas & Admin')
@section('page-title', 'Kelola Petugas')
@section('page-description', 'Pusat pengaturan akses dan data tim manajemen sistem')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    

    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    /* Stats Grid */
    .premium-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .stat-card {
        background: var(--surface); border-radius: var(--radius-lg); padding: 24px;
        box-shadow: var(--shadow-md); transition: all 0.4s; position: relative; overflow: hidden; 
        border: 1px solid rgba(255,255,255,0.8); display: flex; align-items: center; gap: 20px; z-index: 1;
    }
    .stat-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }
    
    .stat-icon-wrapper {
        width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center;
        font-size: 28px; color: white; box-shadow: var(--shadow-md); position: relative;
    }
    .icon-total { background: var(--primary-gradient); }
    .icon-admin { background: var(--admin-gradient); }
    .icon-petugas { background: var(--petugas-gradient); }

    .stat-content { flex: 1; }
    .stat-value { font-size: 32px; font-weight: 800; line-height: 1.1; margin-bottom: 4px; letter-spacing: -0.5px; }
    .stat-label { font-size: 14px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }

    /* Main Container */
    .premium-container { background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); padding: 28px; border: 1px solid var(--surface-200); }
    
    /* Toolbar */
    .premium-toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; background: var(--surface-50); padding: 16px; border-radius: var(--radius-md); border: 1px solid var(--surface-200); }
    
    .search-group { position: relative; width: 400px; max-width: 100%; display: flex; gap: 12px; }
    .search-input-wrapper { position: relative; flex: 1; }
    .search-input-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 16px; transition: color 0.3s; }
    .search-input { width: 100%; padding: 12px 16px 12px 48px; border: 2px solid transparent; border-radius: var(--radius-md);
        background: var(--surface); color: var(--text-main); font-size: 14px; font-weight: 500; outline: none; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.3s ease; }
    .search-input:focus { border-color: #818cf8; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    
    .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 20px; border-radius: var(--radius-md); font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s; text-decoration: none; border: none; }
    .btn-create { background: var(--primary-gradient); color: white; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
    .btn-create:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(79, 70, 229, 0.4); color: white; }
    .btn-reset { background: white; border: 1px solid #e2e8f0; color: #475569; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .btn-reset:hover { background: #f8fafc; color: #ef4444; border-color: #fca5a5; }

    /* Table */
    .table-container { overflow-x: auto; border-radius: var(--radius-md); border: 1px solid var(--surface-200); }
    .premium-table { width: 100%; border-collapse: separate; border-spacing: 0; background: var(--surface); }
    .premium-table th { background: #f8fafc; padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 2px solid var(--surface-200); white-space: nowrap; }
    .premium-table td { padding: 16px 20px; border-bottom: 1px solid var(--surface-100); vertical-align: middle; font-size: 14px; font-weight: 500; transition: background-color 0.2s; }
    .premium-table tr:hover td { background-color: #f8fafc; }
    .premium-table tr:last-child td { border-bottom: none; }

    /* User Profile */
    .user-profile { display: flex; align-items: center; gap: 12px; }
    .user-avatar { width: 44px; height: 44px; border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; flex-shrink: 0; }
    .avatar-admin { background: var(--admin-gradient); box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2); }
    .avatar-petugas { background: var(--petugas-gradient); box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2); }
    .user-info-text .name { font-weight: 800; color: var(--text-main); font-size: 15px; margin-bottom: 2px; display: flex; align-items: center; gap: 8px; }
    .user-info-text .email { font-size: 13px; color: var(--text-muted); }

    .role-badge { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
    .role-admin { background: rgba(239, 68, 68, 0.1); color: #dc2626; border: 1px solid rgba(239, 68, 68, 0.2); }
    .role-petugas { background: rgba(59, 130, 246, 0.1); color: #2563eb; border: 1px solid rgba(59, 130, 246, 0.2); }
    
    .its-you { background: rgba(16, 185, 129, 0.1); color: #059669; font-size: 10px; padding: 2px 6px; border-radius: 4px; font-weight: 800; letter-spacing: 0.5px; }

    /* Actions */
    .action-group { display: flex; gap: 8px; justify-content: center; }
    .action-btn { width: 36px; height: 36px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; background: var(--surface-50); color: var(--text-muted); border: 1px solid var(--surface-200); transition: all 0.3s; text-decoration: none; cursor: pointer; }
    .btn-edit:hover { background: #3b82f6; color: white; border-color: #3b82f6; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
    .btn-delete:hover { background: #ef4444; color: white; border-color: #ef4444; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }
    .btn-disabled { opacity: 0.5; cursor: not-allowed; }
    .btn-disabled:hover { transform: none; box-shadow: none; background: var(--surface-50); color: var(--text-muted); border-color: var(--surface-200); }

    /* Alerts */
    .premium-alert { display: flex; align-items: center; gap: 12px; padding: 16px 20px; border-radius: var(--radius-md); margin-bottom: 24px; font-weight: 600; font-size: 14px; animation: slideDown 0.4s ease-out; }
    .alert-success { background: rgba(16, 185, 129, 0.1); color: #065f46; border-left: 4px solid #10b981; }
    .alert-error { background: rgba(239, 68, 68, 0.1); color: #991b1b; border-left: 4px solid #ef4444; }

    @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    .pagination-wrapper { margin-top: 24px; }
</style>
@endpush

@section('content')
    <!-- Statistics -->
    <div class="premium-stats-grid">
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-total">
                <i class="fas fa-users-cog"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($totalStaff) }}</div>
                <div class="stat-label">Total Anggota Tim</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-admin">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($totalAdmin) }}</div>
                <div class="stat-label">Admin Utama</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrapper icon-petugas">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($totalPetugas) }}</div>
                <div class="stat-label">Petugas</div>
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
        <div class="premium-alert alert-error">
            <i class="fas fa-exclamation-triangle" style="font-size: 20px;"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <div class="premium-container">
        <!-- Toolbar -->
        <div class="premium-toolbar">
            <form method="GET" action="{{ route('admin.petugas.index') }}" class="search-group">
                <div class="search-input-wrapper">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama anggota tim..." value="{{ request('search') }}">
                    <i class="fas fa-search"></i>
                </div>
                @if(request('search'))
                    <a href="{{ route('admin.petugas.index') }}" class="btn btn-reset" title="Hapus Pencarian">
                        <i class="fas fa-undo"></i>
                    </a>
                @endif
                <button type="submit" style="display: none;"></button>
            </form>

            <a href="{{ route('admin.petugas.create') }}" class="btn btn-create">
                <i class="fas fa-plus"></i> Tambah Anggota
            </a>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Anggota Tim</th>
                        <th>WhatsApp/Telepon</th>
                        <th>Peran (Role)</th>
                        <th>Bergabung Pada</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staffs as $staff)
                        <tr style="{{ auth()->id() == $staff->id ? 'background-color: rgba(16, 185, 129, 0.02);' : '' }}">
                            <td>
                                <div class="user-profile">
                                    <div class="user-avatar {{ $staff->role == 'admin' ? 'avatar-admin' : 'avatar-petugas' }}">
                                        {{ strtoupper(substr($staff->name, 0, 2)) }}
                                    </div>
                                    <div class="user-info-text">
                                        <div class="name">
                                            {{ $staff->name }}
                                            @if($staff->id === auth()->id())
                                                <span class="its-you">ANDA</span>
                                            @endif
                                        </div>
                                        <div class="email">{{ $staff->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 600;">
                                    @if($staff->phone)
                                        <i class="fas fa-phone" style="font-size: 12px; color: var(--text-muted); margin-right: 4px;"></i> {{ $staff->phone }}
                                    @else
                                        <span style="color: var(--text-muted); font-style: italic;">Tidak ada</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="role-badge role-{{ $staff->role }}">
                                    @if($staff->role == 'admin')
                                        <i class="fas fa-shield-alt" style="margin-right: 4px;"></i> ADMIN UTAMA
                                    @else
                                        <i class="fas fa-user-check" style="margin-right: 4px;"></i> PETUGAS
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 600;">{{ $staff->created_at->format('d M Y') }}</div>
                                <div style="font-size: 12px; color: var(--text-muted);">{{ $staff->created_at->diffForHumans() }}</div>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.petugas.edit', $staff) }}" class="action-btn btn-edit" title="Edit Profil">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.petugas.destroy', $staff) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mencabut hak akses pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete {{ $staff->id === auth()->id() ? 'btn-disabled' : '' }}" {{ $staff->id === auth()->id() ? 'disabled' : '' }} title="{{ $staff->id === auth()->id() ? 'Anda tidak bisa menghapus diri sendiri' : 'Hapus Akses' }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 60px 20px;">
                                <div style="font-size: 48px; color: var(--surface-200); margin-bottom: 16px;"><i class="fas fa-users-slash"></i></div>
                                <div style="font-size: 18px; font-weight: 700; color: var(--text-main); margin-bottom: 8px;">Tidak Ada Data Ditemukan</div>
                                <div style="color: var(--text-muted);">Gagal menemukan anggota tim yang sesuai dengan pencarian Anda.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($staffs->hasPages())
            <div class="pagination-wrapper">
                {{ $staffs->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
