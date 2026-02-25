@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')
@section('page-title', 'Tambah Produk Baru')
@section('page-description', 'Tambahkan produk sepatu baru ke toko Anda')

@push('styles')
<style>
    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 30px;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--gray-light);
    }

    .form-header h2 {
        font-size: 18px;
        font-weight: 700;
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-header h2 i {
        color: var(--primary);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        border-radius: 10px;
        background: var(--gray-light);
        color: var(--secondary);
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #d5d8dc;
        transform: translateY(-1px);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 22px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .form-label .required {
        color: var(--danger);
    }

    .form-label .label-hint {
        font-weight: 400;
        color: var(--gray);
        font-size: 12px;
    }

    .form-input,
    .form-select,
    .form-textarea {
        padding: 11px 15px;
        border: 2px solid var(--gray-light);
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        transition: all 0.3s;
        background: white;
        color: var(--secondary);
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(229, 9, 20, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-select {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236c757d' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 35px;
        cursor: pointer;
    }

    .form-input-group {
        position: relative;
    }

    .form-input-group .input-prefix {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
        font-weight: 600;
        color: var(--gray);
    }

    .form-input-group .form-input {
        padding-left: 38px;
    }

    .form-error {
        color: var(--danger);
        font-size: 12px;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .form-help {
        color: var(--gray);
        font-size: 12px;
        margin-top: 5px;
    }

    /* Toggle Group */
    .toggle-group {
        display: flex;
        gap: 30px;
        margin-top: 5px;
    }

    .toggle-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .toggle-item-label {
        font-size: 14px;
        font-weight: 500;
        color: var(--secondary);
    }

    .toggle-switch {
        position: relative;
        width: 44px;
        height: 24px;
        display: inline-block;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background: #ccc;
        border-radius: 24px;
        transition: all 0.3s;
    }

    .toggle-slider::before {
        content: '';
        position: absolute;
        width: 18px; height: 18px;
        left: 3px; bottom: 3px;
        background: white;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .toggle-switch input:checked + .toggle-slider {
        background: var(--success);
    }

    .toggle-switch input:checked + .toggle-slider::before {
        transform: translateX(20px);
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 35px;
        padding-top: 25px;
        border-top: 2px solid var(--gray-light);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Inter', sans-serif;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(229, 9, 20, 0.35);
    }

    .btn-cancel {
        background: var(--gray-light);
        color: var(--secondary);
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Inter', sans-serif;
    }

    .btn-cancel:hover {
        background: #d5d8dc;
    }

    /* Premium Image Upload */
    .upload-box {
        border: 2px dashed var(--gray-light);
        border-radius: 15px;
        padding: 40px 20px;
        text-align: center;
        background: #fdfdfd;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .upload-box:hover, .upload-box.dragging {
        border-color: var(--primary);
        background: rgba(229, 9, 20, 0.02);
    }

    .upload-icon {
        font-size: 40px;
        color: var(--gray);
        transition: all 0.3s;
    }

    .upload-box:hover .upload-icon {
        color: var(--primary);
        transform: scale(1.1);
    }

    .upload-text {
        font-size: 14px;
        color: var(--secondary);
        font-weight: 600;
    }

    .upload-hint {
        font-size: 12px;
        color: var(--gray);
    }

    #product_image {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

    .image-preview-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 5;
    }

    .image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .remove-image-preview {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: rgba(229, 9, 20, 0.9);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        transition: all 0.2s;
    }

    .remove-image-preview:hover {
        transform: scale(1.1);
        background: var(--primary);
    }

    /* Alert */
    .alert-errors {
        background: rgba(231, 76, 60, 0.08);
        border: 1px solid rgba(231, 76, 60, 0.2);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 25px;
    }

    .alert-errors h4 {
        color: var(--danger);
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .alert-errors ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .alert-errors ul li {
        font-size: 13px;
        color: #c0392b;
        padding: 3px 0;
    }

    .section-divider {
        font-size: 15px;
        font-weight: 700;
        color: var(--secondary);
        padding: 15px 0 5px;
        grid-column: 1 / -1;
        border-top: 1px solid var(--gray-light);
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-divider i {
        color: var(--primary);
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .toggle-group {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>
@endpush

@section('content')
    <div class="form-container">
        <div class="form-header">
            <h2><i class="fas fa-plus-circle"></i> Form Tambah Produk</h2>
            <a href="{{ route('admin.produk.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="alert-errors">
                <h4><i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan pada input:</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <!-- Basic Info Section -->
                <div class="section-divider"><i class="fas fa-info-circle"></i> Informasi Dasar</div>

                <div class="form-group">
                    <label class="form-label">
                        Nama Produk <span class="required">*</span>
                    </label>
                    <input type="text" name="name" class="form-input" placeholder="Contoh: Running Shoes Pro 2026" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        SKU <span class="label-hint">(Stock Keeping Unit)</span>
                    </label>
                    <input type="text" name="sku" class="form-input" placeholder="Contoh: RSP-2026-001" value="{{ old('sku') }}">
                    @error('sku')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-input" placeholder="Contoh: Nike, Adidas, dll." value="{{ old('brand') }}">
                    @error('brand')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Produk <span class="label-hint">(Pilih gambar sepatu terbaik)</span></label>
                    
                    <div class="upload-box" id="upload_box">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <span class="upload-text">Klik atau tarik gambar ke sini</span>
                        <span class="upload-hint">PNG, JPG atau WebP (Maks. 2MB)</span>
                        <input type="file" name="image" id="product_image" accept="image/*" onchange="previewImage(this)">
                        
                        <div id="image_preview_container" class="image-preview-container">
                            <img id="image_preview" src="#" alt="Preview">
                            <div class="remove-image-preview" onclick="event.preventDefault(); removePreview();" title="Hapus Gambar">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>

                    @error('image')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Pricing Section -->
                <div class="section-divider"><i class="fas fa-tag"></i> Harga & Stok</div>

                <div class="form-group">
                    <label class="form-label">
                        Harga <span class="required">*</span>
                    </label>
                    <div class="form-input-group">
                        <span class="input-prefix">Rp</span>
                        <input type="number" name="price" class="form-input" placeholder="0" value="{{ old('price') }}" min="0" step="1000" required>
                    </div>
                    @error('price')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Harga Diskon <span class="label-hint">(opsional)</span>
                    </label>
                    <div class="form-input-group">
                        <span class="input-prefix">Rp</span>
                        <input type="number" name="discount_price" class="form-input" placeholder="0" value="{{ old('discount_price') }}" min="0" step="1000">
                    </div>
                    @error('discount_price')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Stok <span class="required">*</span>
                    </label>
                    <input type="number" name="stock" class="form-input" placeholder="0" value="{{ old('stock', 0) }}" min="0" required>
                    @error('stock')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Variants Section -->
                <div class="section-divider"><i class="fas fa-palette"></i> Varian Produk</div>

                <div class="form-group">
                    <label class="form-label">
                        Ukuran <span class="label-hint">(pisahkan dengan koma)</span>
                    </label>
                    <input type="text" name="sizes" class="form-input" placeholder="Contoh: 39, 40, 41, 42, 43" value="{{ old('sizes') }}">
                    <div class="form-help">Masukkan ukuran yang tersedia, pisahkan dengan koma</div>
                    @error('sizes')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Warna <span class="label-hint">(pisahkan dengan koma)</span>
                    </label>
                    <input type="text" name="colors" class="form-input" placeholder="Contoh: Hitam, Putih, Merah" value="{{ old('colors') }}">
                    <div class="form-help">Masukkan warna yang tersedia, pisahkan dengan koma</div>
                    @error('colors')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Description Section -->
                <div class="section-divider"><i class="fas fa-align-left"></i> Deskripsi</div>

                <div class="form-group full-width">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="description" class="form-textarea" placeholder="Tuliskan deskripsi produk sepatu...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Spesifikasi</label>
                    <textarea name="specifications" class="form-textarea" placeholder="Material: Mesh breathable&#10;Sole: Rubber&#10;Weight: 280g">{{ old('specifications') }}</textarea>
                    @error('specifications')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Section -->
                <div class="section-divider"><i class="fas fa-toggle-on"></i> Status</div>

                <div class="form-group full-width">
                    <div class="toggle-group">
                        <div class="toggle-item">
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-item-label">Produk Aktif</span>
                        </div>
                        <div class="toggle-item">
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-item-label">Produk Featured</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.produk.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Produk
                </button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2026 Sepatukuid Admin • Tambah Produk Baru
    </div>

    <script>
        const uploadBox = document.getElementById('upload_box');
        const fileInput = document.getElementById('product_image');

        // Drag and Drop Visual Support
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadBox.addEventListener(eventName, (e) => {
                e.preventDefault();
                uploadBox.classList.add('dragging');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadBox.addEventListener(eventName, (e) => {
                e.preventDefault();
                uploadBox.classList.remove('dragging');
            });
        });

        function previewImage(input) {
            const preview = document.getElementById('image_preview');
            const container = document.getElementById('image_preview_container');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.style.display = 'flex';
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removePreview() {
            const input = document.getElementById('product_image');
            const preview = document.getElementById('image_preview');
            const container = document.getElementById('image_preview_container');
            
            input.value = '';
            preview.src = '#';
            container.style.display = 'none';
        }
    </script>
@endsection
