@extends('layouts.admin')

@section('title', 'Edit Ulasan')
@section('page-title', 'Edit Ulasan')
@section('page-description', 'Ubah rating dan komentar pelanggan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    body { font-family: var(--font-family); color: var(--text-main); background-color: #f3f4f6; }

    .top-toolbar { margin-bottom: 24px; }
    .btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: var(--radius-md); font-weight: 600; font-size: 14px; background: var(--surface); color: var(--text-main); border: 1px solid var(--surface-200); text-decoration: none; transition: all 0.3s; }
    .btn-back:hover { background: var(--surface-50); transform: translateX(-4px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

    .premium-form-container { background: var(--surface); border-radius: var(--radius-lg); box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden; max-width: 800px; border: 1px solid var(--surface-200); }
    .form-header { background: var(--surface-50); padding: 24px 32px; border-bottom: 1px solid var(--surface-200); display: flex; align-items: center; gap: 16px; }
    .header-icon { width: 48px; height: 48px; border-radius: var(--radius-md); background: rgba(245, 158, 11, 0.1); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .header-text h3 { margin: 0 0 4px 0; font-size: 18px; font-weight: 800; color: var(--text-main); }
    .header-text p { margin: 0; font-size: 13px; color: var(--text-muted); }

    .form-body { padding: 32px; }
    .form-group { margin-bottom: 24px; }

    .form-label { display: block; font-size: 13px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
    .form-label .required { color: var(--danger); margin-left: 4px; }

    .premium-input, .premium-textarea, .premium-select {
        width: 100%; padding: 14px 16px; border: 2px solid var(--surface-200);
        border-radius: var(--radius-md); background: var(--surface-50); color: var(--text-main);
        font-size: 15px; font-weight: 500; font-family: var(--font-family); transition: all 0.3s;
    }
    .premium-input:focus, .premium-textarea:focus, .premium-select:focus { outline: none; border-color: #f59e0b; background: var(--surface); box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); }
    .premium-textarea { min-height: 120px; resize: vertical; }

    .info-card { background: var(--surface-50); border: 1px solid var(--surface-200); border-radius: var(--radius-md); padding: 16px 20px; margin-bottom: 24px; }
    .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--surface-100); font-size: 14px; }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: var(--text-muted); font-weight: 600; }
    .info-value { color: var(--text-main); font-weight: 700; }

    /* Star Rating Selector */
    .star-selector { display: flex; gap: 8px; flex-direction: row-reverse; justify-content: flex-end; }
    .star-selector input { display: none; }
    .star-selector label { font-size: 32px; color: #e0e0e0; cursor: pointer; transition: all 0.2s; }
    .star-selector label:hover, .star-selector label:hover ~ label, .star-selector input:checked ~ label { color: #f59e0b; transform: scale(1.1); }

    .invalid-feedback { display: block; color: var(--danger); font-size: 13px; margin-top: 6px; font-weight: 500; }
    .is-invalid { border-color: var(--danger) !important; }

    .form-footer { padding: 24px 32px; background: var(--surface-50); border-top: 1px solid var(--surface-200); display: flex; justify-content: space-between; gap: 12px; }
    .btn-submit { padding: 12px 28px; border-radius: var(--radius-md); font-weight: 700; font-size: 14px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3); display: inline-flex; align-items: center; gap: 8px; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(245, 158, 11, 0.4); }
    .btn-danger { padding: 12px 28px; border-radius: var(--radius-md); font-weight: 700; font-size: 14px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); display: inline-flex; align-items: center; gap: 8px; }
    .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(239, 68, 68, 0.4); }

    @media (max-width: 640px) {
        .form-footer { flex-direction: column; }
    }
</style>
@endpush

@section('content')
    <div class="top-toolbar">
        <a href="{{ route('admin.ulasan.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Ulasan
        </a>
    </div>

    <div class="premium-form-container">
        <div class="form-header">
            <div class="header-icon"><i class="fas fa-star"></i></div>
            <div class="header-text">
                <h3>Edit Ulasan</h3>
                <p>Ubah rating bintang dan komentar dari pelanggan</p>
            </div>
        </div>

        {{-- Info Ulasan --}}
        <div class="form-body" style="padding-bottom: 0;">
            <div class="info-card">
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-user" style="margin-right: 6px;"></i> Pelanggan</span>
                    <span class="info-value">{{ $review->user->name ?? 'User Terhapus' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-shoe-prints" style="margin-right: 6px;"></i> Produk</span>
                    <span class="info-value">{{ $review->product->name ?? 'Produk Terhapus' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-receipt" style="margin-right: 6px;"></i> Order</span>
                    <span class="info-value">{{ $review->order->order_number ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-calendar" style="margin-right: 6px;"></i> Ditulis</span>
                    <span class="info-value">{{ $review->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.ulasan.update', $review) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-body" style="padding-top: 0;">
                <div class="form-group">
                    <label class="form-label">Rating Bintang <span class="required">*</span></label>
                    <div class="star-selector">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'checked' : '' }}>
                            <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                        @endfor
                    </div>
                    @error('rating') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="comment">Komentar / Feedback <span class="required">*</span></label>
                    <textarea id="comment" name="comment" class="premium-textarea @error('comment') is-invalid @enderror" placeholder="Tulis komentar pelanggan...">{{ old('comment', $review->comment) }}</textarea>
                    @error('comment') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-footer">
                <div>
                    <!-- Delete form is separate -->
                </div>
                <button type="submit" class="btn-submit">
                    Simpan Perubahan <i class="fas fa-check"></i>
                </button>
            </div>
        </form>

        {{-- Separate Delete Form --}}
        <div style="padding: 0 32px 24px;">
            <form action="{{ route('admin.ulasan.destroy', $review) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini secara permanen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger" style="width: 100%;">
                    <i class="fas fa-trash-alt"></i> Hapus Ulasan Ini
                </button>
            </form>
        </div>
    </div>
@endsection
