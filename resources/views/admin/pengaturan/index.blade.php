@extends('layouts.admin')

@section('title', 'Pengaturan Toko')
@section('page-title', 'Pengaturan Toko')
@section('page-description', 'Pusat konfigurasi informasi identitas, kontak, dan kontak toko Anda')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    

    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    .setting-container { display: grid; grid-template-columns: 280px 1fr; gap: 32px; align-items: start; }

    /* Sidebar Nav */
    .setting-nav { background: var(--surface); border-radius: var(--radius-lg); padding: 16px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); border: 1px solid var(--surface-200); position: sticky; top: 24px; }
    .nav-head { font-size: 11px; font-weight: 800; text-transform: uppercase; color: var(--text-muted); letter-spacing: 1px; margin-bottom: 12px; padding: 0 12px; }
    
    .setting-link { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: var(--radius-md); color: var(--text-main); font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.3s; margin-bottom: 4px; }
    .setting-link i { font-size: 16px; width: 20px; text-align: center; color: var(--text-muted); transition: color 0.3s; }
    
    .setting-link:hover { background: var(--surface-50); color: var(--primary); }
    .setting-link:hover i { color: var(--primary); }
    
    .setting-link.active { background: rgba(79, 70, 229, 0.1); color: var(--primary); }
    .setting-link.active i { color: var(--primary); }

    /* Form Area */
    .setting-content { display: flex; flex-direction: column; gap: 24px; }
    
    .setting-card { background: var(--surface); border-radius: var(--radius-lg); box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); border: 1px solid var(--surface-200); overflow: hidden; scroll-margin-top: 24px; }
    .card-header { padding: 20px 24px; border-bottom: 1px solid var(--surface-100); display: flex; align-items: center; gap: 12px; background: rgba(248, 250, 252, 0.5); }
    .card-icon { width: 40px; height: 40px; border-radius: var(--radius-sm); background: rgba(79, 70, 229, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 18px; }
    .card-title-group h3 { margin: 0 0 4px 0; font-size: 16px; font-weight: 800; color: var(--text-main); }
    .card-title-group p { margin: 0; font-size: 13px; color: var(--text-muted); }
    
    .card-body { padding: 24px; }

    /* Forms */
    .form-group { margin-bottom: 24px; }
    .form-group:last-child { margin-bottom: 0; }
    .form-label { display: block; font-size: 13px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
    .form-label .required { color: #ef4444; margin-left: 4px; }
    
    .input-wrapper { position: relative; display: flex; align-items: center; }
    .input-prefix { position: absolute; left: 16px; color: var(--text-muted); font-size: 14px; }
    
    .premium-input { width: 100%; padding: 14px 16px; border: 2px solid var(--surface-200); border-radius: var(--radius-md); background: var(--surface-50); color: var(--text-main); font-size: 15px; font-weight: 500; font-family: var(--font-family); transition: all 0.3s; }
    .premium-input.has-prefix { padding-left: 44px; }
    .premium-input:focus { outline: none; border-color: #818cf8; background: var(--surface); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    
    textarea.premium-input { min-height: 100px; resize: vertical; line-height: 1.5; }

    .invalid-feedback { display: block; color: #ef4444; font-size: 13px; margin-top: 6px; font-weight: 500; }

    /* Save Bar (Floating) */
    .save-bar { position: fixed; bottom: 32px; left: 50%; transform: translateX(-50%); background: var(--text-main); padding: 16px 24px; border-radius: 50px; display: flex; align-items: center; gap: 24px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2); z-index: 100; transition: all 0.3s; animation: slideUp 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
    .save-text { color: white; font-size: 14px; font-weight: 600; }
    .btn-submit { background: var(--primary-gradient); color: white; border: none; padding: 10px 24px; border-radius: 30px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(79, 70, 229, 0.4); }

    /* Alerts */
    .premium-alert { display: flex; align-items: center; gap: 12px; padding: 16px 20px; border-radius: var(--radius-md); margin-bottom: 24px; font-weight: 600; font-size: 14px; animation: slideDown 0.4s ease-out; }
    .alert-success { background: rgba(16, 185, 129, 0.1); color: #065f46; border-left: 4px solid #10b981; }

    @keyframes slideUp { from { opacity: 0; transform: translate(-50%, 50px); } to { opacity: 1; transform: translate(-50%, 0); } }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    @media (max-width: 1024px) {
        .setting-container { grid-template-columns: 1fr; }
        .setting-nav { position: static; display: flex; overflow-x: auto; padding: 12px; gap: 8px; }
        .nav-head { display: none; }
        .setting-link { white-space: nowrap; margin: 0; }
    }
</style>
@endpush

@section('content')
    @if(session('success'))
        <div class="premium-alert alert-success">
            <i class="fas fa-check-circle" style="font-size: 20px;"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <form action="{{ route('admin.pengaturan.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="setting-container">
            <!-- Navigation -->
            <nav class="setting-nav">
                <div class="nav-head">Menu Pengaturan</div>
                <a href="#umum" class="setting-link active" onclick="setActive(this)">
                    <i class="fas fa-store"></i> Informasi Umum
                </a>
                <a href="#kontak" class="setting-link" onclick="setActive(this)">
                    <i class="fas fa-address-book"></i> Kontak & Alamat
                </a>
                <a href="#sosial" class="setting-link" onclick="setActive(this)">
                    <i class="fas fa-share-alt"></i> Sosial Media
                </a>
            </nav>

            <!-- Contents -->
            <div class="setting-content">
                
                <!-- Section: UMUM -->
                <div id="umum" class="setting-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-store"></i></div>
                        <div class="card-title-group">
                            <h3>Informasi Toko Umum</h3>
                            <p>Detail bisnis yang akan terlihat oleh pelanggan</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="store_name">Nama Toko / Bisnis <span class="required">*</span></label>
                            <input type="text" id="store_name" name="settings[store_name]" class="premium-input" value="{{ old('settings.store_name', $settings['store_name']) }}" required>
                            @error('settings.store_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="store_description">Slogan / Deskripsi Singkat</label>
                            <textarea id="store_description" name="settings[store_description]" class="premium-input">{{ old('settings.store_description', $settings['store_description']) }}</textarea>
                            <div style="font-size: 12px; color: var(--text-muted); margin-top: 6px;">Deskripsi ini akan digunakan untuk SEO pada pencarian Google.</div>
                        </div>
                    </div>
                </div>

                <!-- Section: KONTAK & ALAMAT -->
                <div id="kontak" class="setting-card">
                    <div class="card-header">
                        <div class="card-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;"><i class="fas fa-address-book"></i></div>
                        <div class="card-title-group">
                            <h3>Kontak & Alamat Cabang</h3>
                            <p>Informasi bagi pelanggan untuk menghubungi atau mengirim barang</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="store_phone">Nomor Telepon / WhatsApp CS</label>
                            <div class="input-wrapper">
                                <i class="fas fa-phone input-prefix"></i>
                                <input type="text" id="store_phone" name="settings[store_phone]" class="premium-input has-prefix" value="{{ old('settings.store_phone', $settings['store_phone']) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="store_email">Alamat Email Dukungan</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope input-prefix"></i>
                                <input type="email" id="store_email" name="settings[store_email]" class="premium-input has-prefix" value="{{ old('settings.store_email', $settings['store_email']) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="store_address">Alamat Pengiriman (Asal Gudang)</label>
                            <textarea id="store_address" name="settings[store_address]" class="premium-input">{{ old('settings.store_address', $settings['store_address']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section: SOSIAL MEDIA -->
                <div id="sosial" class="setting-card">
                    <div class="card-header">
                        <div class="card-icon" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;"><i class="fas fa-heart"></i></div>
                        <div class="card-title-group">
                            <h3>Tautan Sosial Media</h3>
                            <p>Tingkatkan interaksi dengan pelanggan melalui platform sosial</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="social_instagram">Instagram (URL Profil)</label>
                            <div class="input-wrapper">
                                <i class="fab fa-instagram input-prefix" style="color: #e1306c;"></i>
                                <input type="url" id="social_instagram" name="settings[social_instagram]" class="premium-input has-prefix" value="{{ old('settings.social_instagram', $settings['social_instagram']) }}" placeholder="https://instagram.com/username">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="social_facebook">Facebook (URL Halaman)</label>
                            <div class="input-wrapper">
                                <i class="fab fa-facebook input-prefix" style="color: #1877f2;"></i>
                                <input type="url" id="social_facebook" name="settings[social_facebook]" class="premium-input has-prefix" value="{{ old('settings.social_facebook', $settings['social_facebook']) }}" placeholder="https://facebook.com/username">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Floating Submit Button -->
        <div class="save-bar">
            <span class="save-text">Ada perubahan yang belum disimpan?</span>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Pengaturan
            </button>
        </div>
    </form>

    <script>
        function setActive(ele) {
            document.querySelectorAll('.setting-link').forEach(l => l.classList.remove('active'));
            ele.classList.add('active');
        }

        // Simple scroll spy behavior
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    document.querySelectorAll('.setting-link').forEach(l => {
                        l.classList.remove('active');
                        if(l.getAttribute('href') === '#' + id) {
                            l.classList.add('active');
                        }
                    });
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.setting-card').forEach(section => {
            observer.observe(section);
        });
    </script>
@endsection
