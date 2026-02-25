@extends('layouts.admin')

@section('title', 'Edit Profil - ' . $staff->name)
@section('page-title', 'Edit Profil Tim')
@section('page-description', 'Perbarui data diri dan hak akses kolega')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    /* Menggunakan standar desain yang sama dengan create.blade.php */
    

    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    .top-toolbar { margin-bottom: 24px; }
    .btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: var(--radius-md); font-weight: 600; font-size: 14px; background: var(--surface); color: var(--text-main); border: 1px solid var(--surface-200); text-decoration: none; transition: all 0.3s; }
    .btn-back:hover { background: var(--surface-50); transform: translateX(-4px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

    .premium-form-container { background: var(--surface); border-radius: var(--radius-lg); box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden; max-width: 800px; border: 1px solid var(--surface-200); }
    .form-header { background: var(--surface-50); padding: 24px 32px; border-bottom: 1px solid var(--surface-200); display: flex; align-items: center; gap: 16px; }
    .header-icon { width: 48px; height: 48px; border-radius: var(--radius-md); background: rgba(79, 70, 229, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .header-text h3 { margin: 0 0 4px 0; font-size: 18px; font-weight: 800; color: var(--text-main); }
    .header-text p { margin: 0; font-size: 13px; color: var(--text-muted); }

    .form-body { padding: 32px; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .form-group { margin-bottom: 24px; }
    .form-group.full { grid-column: 1 / -1; }
    
    .form-label { display: block; font-size: 13px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
    .form-label .required { color: var(--danger); margin-left: 4px; }
    
    .premium-input { width: 100%; padding: 14px 16px; border: 2px solid var(--surface-200); border-radius: var(--radius-md); background: var(--surface-50); color: var(--text-main); font-size: 15px; font-weight: 500; font-family: var(--font-family); transition: all 0.3s; }
    .premium-input:focus { outline: none; border-color: #818cf8; background: var(--surface); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    
    .role-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .role-card { border: 2px solid var(--surface-200); border-radius: var(--radius-md); padding: 16px; cursor: pointer; transition: all 0.3s; position: relative; }
    .role-card:hover { border-color: #cbd5e1; background: var(--surface-50); }
    .role-input { position: absolute; opacity: 0; cursor: pointer; }
    .role-input:checked + .role-card-content::before { content: '\f058'; font-family: 'Font Awesome 6 Free'; font-weight: 900; position: absolute; top: 16px; right: 16px; color: var(--primary); font-size: 20px; }
    .role-input:checked + .role-card-content { border-color: var(--primary); }
    .role-card:has(input:checked) { border-color: var(--primary); background: rgba(79, 70, 229, 0.05); }
    .role-card.disabled { opacity: 0.6; cursor: not-allowed; }
    .role-card.disabled:hover { background: transparent; border-color: var(--surface-200); }
    .role-card.disabled:has(input:checked) { border-color: var(--primary); background: rgba(79, 70, 229, 0.05); }
    
    .role-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-bottom: 12px; }
    .role-admin .role-icon { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .role-petugas .role-icon { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .role-title { font-weight: 800; font-size: 15px; margin-bottom: 4px; color: var(--text-main); }
    .role-desc { font-size: 12px; color: var(--text-muted); line-height: 1.5; }

    .invalid-feedback { display: block; color: var(--danger); font-size: 13px; margin-top: 6px; font-weight: 500; }
    .is-invalid { border-color: var(--danger) !important; background: rgba(239, 68, 68, 0.02) !important; }

    .alert-warning { background: rgba(245, 158, 11, 0.1); border-left: 4px solid var(--warning); padding: 16px; border-radius: var(--radius-md); margin-bottom: 24px; font-size: 14px; font-weight: 600; color: #92400e; display: flex; align-items: flex-start; gap: 12px; }

    .form-footer { padding: 24px 32px; background: var(--surface-50); border-top: 1px solid var(--surface-200); display: flex; justify-content: flex-end; gap: 12px; border-radius: 0 0 var(--radius-lg) var(--radius-lg); }
    .btn-submit { padding: 12px 28px; border-radius: var(--radius-md); font-weight: 700; font-size: 14px; background: var(--primary-gradient); color: white; border: none; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); display: inline-flex; align-items: center; gap: 8px; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(79, 70, 229, 0.4); }

    @media (max-width: 640px) {
        .form-grid, .role-cards { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    <div class="top-toolbar">
        <a href="{{ route('admin.petugas.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($staff->id === auth()->id())
        <div class="alert-warning">
            <i class="fas fa-exclamation-triangle" style="font-size: 20px;"></i>
            <div>
                Anda sedang mengedit akun milik Anda sendiri. Perubahan Hak Akses (Role) dinonaktifkan untuk mencegah sistem kehilangan Administrator.
            </div>
        </div>
    @endif

    <div class="premium-form-container">
        <div class="form-header">
            <div class="header-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;"><i class="fas fa-user-edit"></i></div>
            <div class="header-text">
                <h3>Edit Profil: {{ $staff->name }}</h3>
                <p>Ubah informasi personal atau ganti kata sandi akun</p>
            </div>
        </div>

        <form action="{{ route('admin.petugas.update', $staff) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="name">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" id="name" name="name" class="premium-input @error('name') is-invalid @enderror" value="{{ old('name', $staff->name) }}" required>
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Alamat Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" class="premium-input @error('email') is-invalid @enderror" value="{{ old('email', $staff->email) }}" required>
                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone">Nomor Tlp / WhatsApp</label>
                        <input type="text" id="phone" name="phone" class="premium-input @error('phone') is-invalid @enderror" value="{{ old('phone', $staff->phone) }}">
                        @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Ubah Kata Sandi (Opsional)</label>
                        <input type="password" id="password" name="password" class="premium-input @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak mau diganti" minlength="4">
                        <div style="font-size: 12px; color: var(--text-muted); margin-top: 6px;"><i class="fas fa-info-circle"></i> Biarkan kosong jika tidak ingin mengubah password lama.</div>
                        @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group full">
                        <label class="form-label">Peran & Hak Akses (Role) <span class="required">*</span></label>
                        <div class="role-cards">
                            <label class="role-card role-admin {{ $staff->id === auth()->id() ? 'disabled' : '' }}">
                                <input type="radio" name="role" value="admin" class="role-input" 
                                    {{ (old('role', $staff->role) == 'admin') ? 'checked' : '' }} 
                                    {{ $staff->id === auth()->id() ? 'disabled' : '' }} required>
                                <div class="role-card-content">
                                    <div class="role-icon"><i class="fas fa-shield-alt"></i></div>
                                    <div class="role-title">Admin Utama</div>
                                    <div class="role-desc">Akses penuh ke seluruh sistem. Termasuk mengelola produk, pengguna, dan pengaturan.</div>
                                </div>
                            </label>

                            <label class="role-card role-petugas {{ $staff->id === auth()->id() ? 'disabled' : '' }}">
                                <input type="radio" name="role" value="petugas" class="role-input" 
                                    {{ (old('role', $staff->role) == 'petugas') ? 'checked' : '' }} 
                                    {{ $staff->id === auth()->id() ? 'disabled' : '' }} required>
                                <div class="role-card-content">
                                    <div class="role-icon"><i class="fas fa-user-check"></i></div>
                                    <div class="role-title">Petugas</div>
                                    <div class="role-desc">Akses terbatas. Umumnya hanya dapat melihat pesanan dan tidak dapat mengubah pengaturan toko.</div>
                                </div>
                            </label>
                        </div>
                        
                        @if($staff->id === auth()->id())
                            <input type="hidden" name="role" value="admin">
                        @endif
                        
                        @error('role') <span class="invalid-feedback" style="margin-top: 12px;">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit">
                    Simpan Perubahan <i class="fas fa-check"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
