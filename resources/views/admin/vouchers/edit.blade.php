@extends('layouts.admin')

@section('title', 'Edit Voucher')
@section('page-title', 'Edit Voucher')
@section('page-description', 'Ubah detail kode promo ' . $voucher->code)

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);">
        <form action="{{ route('admin.vouchers.update', $voucher) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px;">Kode Voucher <span style="color: var(--primary);">*</span></label>
                    <input type="text" name="code" class="filter-input" placeholder="Contoh: HEMAT50" value="{{ old('code', $voucher->code) }}" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    @error('code') <small style="color: var(--primary);">{{ $message }}</small> @enderror
                </div>
                
                <div class="form-group">
                    <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px;">Tipe Diskon <span style="color: var(--primary);">*</span></label>
                    <select name="type" class="filter-input" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; appearance: auto;">
                        <option value="fixed" {{ old('type', $voucher->type) == 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
                        <option value="percent" {{ old('type', $voucher->type) == 'percent' ? 'selected' : '' }}>Persentase (%)</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px;">Nilai Diskon <span style="color: var(--primary);">*</span></label>
                    <input type="number" name="value" class="filter-input" placeholder="Contoh: 50000 atau 10" value="{{ old('value', $voucher->value) }}" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                
                <div class="form-group">
                    <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px;">Minimal Belanja</label>
                    <input type="number" name="min_purchase" class="filter-input" placeholder="0" value="{{ old('min_purchase', $voucher->min_purchase) }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px;">Maksimal Diskon (Hanya untuk %)</label>
                    <input type="number" name="max_discount" class="filter-input" placeholder="Opsional" value="{{ old('max_discount', $voucher->max_discount) }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                
                <div class="form-group">
                    <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px;">Batas Penggunaan</label>
                    <input type="number" name="usage_limit" class="filter-input" placeholder="Kosongkan jika tidak terbatas" value="{{ old('usage_limit', $voucher->usage_limit) }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 30px;">
                <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px;">Tanggal Kadaluarsa</label>
                <input type="date" name="expires_at" class="filter-input" value="{{ old('expires_at', $voucher->expires_at ? $voucher->expires_at->format('Y-m-d') : '') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end; border-top: 1px solid #eee; padding-top: 20px;">
                <a href="{{ route('admin.vouchers.index') }}" style="padding: 12px 25px; border-radius: 10px; background: #f0f2f5; color: var(--secondary); font-weight: 600; text-decoration: none;">Batal</a>
                <button type="submit" style="padding: 12px 35px; border-radius: 10px; background: var(--primary); color: white; border: none; font-weight: 700; cursor: pointer; box-shadow: 0 4px 15px rgba(229, 57, 53, 0.2);">Perbarui Voucher</button>
            </div>
        </form>
    </div>
</div>
@endsection
