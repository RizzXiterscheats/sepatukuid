@extends('layouts.admin')

@section('title', 'Tinjau Pengembalian Dana #REF-' . $orderReturn->id)
@section('page-title', 'Detail Permohonan Pengembalian')
@section('page-description', 'Tinjau bukti dan perbarui status pengembalian')

@section('content')
<div class="top-toolbar" style="margin-bottom: 24px;">
    <a href="{{ route('admin.returns.index') }}" class="btn-action btn-back" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 15px; background: white; border-radius: 8px; text-decoration: none; color: #333; border: 1px solid #ddd;">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="premium-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    <!-- Kolom Kiri: Bukti & Info Produk -->
    <div>
        <div class="premium-card" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); margin-bottom: 24px;">
            <div class="card-header" style="border-bottom: 1px solid #eee; margin-bottom: 20px; padding-bottom: 15px;">
                <h3 style="font-size: 18px; font-weight: 700;"><i class="fas fa-box-open"></i> Produk yang Dikembalikan</h3>
            </div>
            <div style="display: flex; gap: 20px; align-items: center;">
                <div style="width: 100px; height: 100px; background: #f8f9fa; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    @if($orderReturn->item->product && $orderReturn->item->product->image)
                        <img src="{{ asset('storage/' . $orderReturn->item->product->image) }}" style="max-width: 100%; border-radius: 8px;">
                    @else
                        <i class="fas fa-shoe-prints" style="font-size: 32px; color: #ccc;"></i>
                    @endif
                </div>
                <div>
                    <h4 style="font-size: 18px; margin-bottom: 5px;">{{ $orderReturn->item->product->name ?? 'Produk Dihapus' }}</h4>
                    <p style="color: var(--gray); font-size: 14px;">Order #{{ $orderReturn->item->order->order_number }} | Qty: {{ $orderReturn->item->quantity }} | Size: {{ $orderReturn->item->size }}</p>
                    <div style="margin-top: 10px; font-size: 16px; font-weight: 700; color: var(--primary);">
                        Refund: Rp {{ number_format($orderReturn->refund_amount, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="premium-card" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 3px 10px rgba(0,0,0,0.05);">
            <div class="card-header" style="border-bottom: 1px solid #eee; margin-bottom: 20px; padding-bottom: 15px;">
                <h3 style="font-size: 18px; font-weight: 700;"><i class="fas fa-camera"></i> Bukti dari Pelanggan</h3>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #555;">ALASAN PENGEMBALIAN:</label>
                <div style="padding: 12px; background: #FEF3C7; color: #92400E; border-radius: 8px; font-weight: 600;">
                    {{ $orderReturn->reason }}
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #555;">DESKRIPSI KENDALA:</label>
                <div style="padding: 15px; background: #f8f9fa; border-radius: 8px; font-style: italic; color: #333; line-height: 1.6;">
                    "{{ $orderReturn->description }}"
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #555;">FOTO BUKTI (Klik untuk perbesar):</label>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                    @if(is_array($orderReturn->evidence_photos))
                        @foreach($orderReturn->evidence_photos as $photo)
                            <a href="{{ asset('storage/' . $photo) }}" target="_blank" style="border: 2px solid #eee; border-radius: 10px; overflow: hidden; display: block; height: 180px;">
                                <img src="{{ asset('storage/' . $photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </a>
                        @endforeach
                    @else
                        <p style="color: var(--gray);">Tidak ada bukti foto.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Actions & Bank -->
    <div>
        <div class="premium-card" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); margin-bottom: 24px;">
            <div class="card-header" style="border-bottom: 1px solid #eee; margin-bottom: 20px; padding-bottom: 15px;">
                <h3 style="font-size: 18px; font-weight: 700;"><i class="fas fa-university"></i> Rekening Refund</h3>
            </div>
            <div style="padding: 15px; background: #f0fdf4; border-radius: 8px; border: 1px solid #bbf7d0;">
                <div style="font-size: 12px; color: #166534; font-weight: 700; text-transform: uppercase;">BANK</div>
                <div style="font-size: 18px; font-weight: 800; color: #14532d; margin-bottom: 10px;">{{ $orderReturn->bank_name }}</div>
                
                <div style="font-size: 12px; color: #166534; font-weight: 700; text-transform: uppercase;">NOMOR REKENING</div>
                <div style="font-size: 20px; font-weight: 800; color: #14532d; letter-spacing: 1px; margin-bottom: 10px;">{{ $orderReturn->bank_account_number }}</div>
                
                <div style="font-size: 12px; color: #166534; font-weight: 700; text-transform: uppercase;">ATAS NAMA</div>
                <div style="font-size: 16px; font-weight: 700; color: #14532d;">{{ $orderReturn->bank_account_name }}</div>
            </div>
            <p style="font-size: 12px; color: var(--gray); margin-top: 15px; text-align: center;">
                Pelanggan: <br><strong>{{ $orderReturn->user->name }}</strong> ({{ $orderReturn->user->email }})
            </p>
        </div>

        <div class="premium-card" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 3px 10px rgba(0,0,0,0.05);">
            <div class="card-header" style="border-bottom: 1px solid #eee; margin-bottom: 20px; padding-bottom: 15px;">
                <h3 style="font-size: 18px; font-weight: 700;"><i class="fas fa-cogs"></i> Update Status</h3>
            </div>
            
            <div style="margin-bottom: 15px; padding: 10px; border-radius: 8px; text-align: center; font-weight: 700; background: #eee;">
                Status Saat Ini: {{ ucfirst($orderReturn->status) }}
            </div>

            <form action="{{ route('admin.returns.update-status', $orderReturn) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 700; margin-bottom: 8px; font-size: 13px;">Ubah Status:</label>
                    <select name="status" class="swal2-select" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; font-weight: 600;">
                        <option value="pending" {{ $orderReturn->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu Tinjauan)</option>
                        <option value="approved" {{ $orderReturn->status == 'approved' ? 'selected' : '' }}>Approved (Setuju - Barang Dikirim)</option>
                        <option value="refunded" {{ $orderReturn->status == 'refunded' ? 'selected' : '' }}>Refunded (Dana Sudah Dikirim)</option>
                        <option value="rejected" {{ $orderReturn->status == 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 700; margin-bottom: 8px; font-size: 13px;">Catatan Admin (Opsional):</label>
                    <textarea name="admin_note" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; height: 80px; resize: none;" placeholder="Alasan penolakan atau catatan tambahan...">{{ $orderReturn->admin_note }}</textarea>
                </div>

                <div id="refund-proof-container" style="margin-bottom: 20px; {{ $orderReturn->status == 'refunded' ? '' : 'display:none;' }}">
                    <label style="display: block; font-weight: 700; margin-bottom: 8px; font-size: 13px;">Bukti Transfer Refund:</label>
                    <input type="file" name="refund_proof" style="width: 100%; padding: 10px; border: 1px dashed #ddd; border-radius: 8px;">
                    @if($orderReturn->refund_proof)
                        <div style="margin-top: 10px;">
                            <a href="{{ asset('storage/' . $orderReturn->refund_proof) }}" target="_blank" style="font-size: 11px; color: var(--primary); font-weight: 700;">
                                <i class="fas fa-image"></i> Lihat Bukti Terunggah
                            </a>
                        </div>
                    @endif
                </div>

                <button type="submit" style="width: 100%; padding: 15px; background: var(--primary); color: white; border: none; border-radius: 10px; font-weight: 700; cursor: pointer;">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelector('select[name="status"]').addEventListener('change', function() {
        const container = document.getElementById('refund-proof-container');
        if (this.value === 'refunded') {
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    });
</script>
@endpush
