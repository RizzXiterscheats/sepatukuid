<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan - Sepatukuid</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary: #E53935;
            --primary-dark: #C62828;
            --secondary: #2196F3;
            --dark: #121212;
            --gray: #666;
            --light: #f8f9fa;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { font-size: 2rem; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        .btn { padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; border: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(229,57,53,0.3); }
        .btn-back { background: white; color: var(--dark); border: 1px solid #ddd; }

        .ticket-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; border-left: 4px solid var(--primary); transition: transform 0.3s; text-decoration: none; color: inherit; }
        .ticket-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        
        .ticket-info h3 { font-size: 1.1rem; margin-bottom: 5px; color: var(--dark); }
        .ticket-meta { font-size: 0.85rem; color: var(--gray); display: flex; gap: 15px; }
        
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; }
        .status-open { background: #fee2e2; color: #dc2626; }
        .status-in_progress { background: #e0f2fe; color: #0284c7; }
        .status-closed { background: #dcfce3; color: #166534; }

        /* Modal Form */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 1000; }
        .modal { background: white; border-radius: 15px; padding: 30px; width: 100%; max-width: 500px; box-shadow: 0 20px 50px rgba(0,0,0,0.2); }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem; }
        .form-control { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-family: inherit; }
        .form-control:focus { border-color: var(--primary); outline: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fa-solid fa-headset"></i> Pusat Bantuan</h1>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('home') }}" class="btn btn-back">Kembali</a>
                <button onclick="document.getElementById('ticketModal').style.display='flex'" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Tiket Baru
                </button>
            </div>
        </div>

        @if(session('success'))
            <script>
                Swal.fire({ icon: 'success', title: 'Berhasil', text: '{{ session("success") }}' });
            </script>
        @endif

        @forelse($tickets as $ticket)
            <a href="{{ route('tickets.show', $ticket->id) }}" class="ticket-card">
                <div class="ticket-info">
                    <h3>{{ $ticket->subject }}</h3>
                    <div class="ticket-meta">
                        <span><i class="fa-solid fa-hashtag"></i> {{ $ticket->ticket_number }}</span>
                        <span><i class="fa-solid fa-tag"></i> {{ ucfirst($ticket->category) }}</span>
                        <span><i class="fa-regular fa-clock"></i> {{ $ticket->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
                <div>
                    <span class="status-badge status-{{ $ticket->status }}">{{ str_replace('_', ' ', $ticket->status) }}</span>
                    <i class="fa-solid fa-chevron-right" style="color: #ccc; margin-left: 15px;"></i>
                </div>
            </a>
        @empty
            <div style="text-align: center; padding: 50px; background: white; border-radius: 12px;">
                <i class="fa-regular fa-comments" style="font-size: 3rem; color: #ccc; margin-bottom: 15px;"></i>
                <h3 style="color: var(--gray);">Belum Ada Tiket Bantuan</h3>
                <p style="color: #999;">Jika Anda memiliki kendala pesanan atau pembayaran, jangan ragu untuk membuat tiket keluhan baru.</p>
            </div>
        @endforelse
    </div>

    <!-- Modal Buat Tiket -->
    <div class="modal-overlay" id="ticketModal">
        <div class="modal">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="font-size: 1.5rem;">Buat Tiket Baru</h2>
                <i class="fa-solid fa-xmark" style="cursor: pointer; font-size: 1.2rem;" onclick="document.getElementById('ticketModal').style.display='none'"></i>
            </div>
            
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Masalah / Kebutuhan</label>
                    <select name="category" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="pesanan">Kendala Pesanan / Order</option>
                        <option value="pembayaran">Konfirmasi Pembayaran</option>
                        <option value="retur">Permintaan Retur / Tukar Ukuran</option>
                        <option value="bug">Kesalahan Website (Bug)</option>
                        <option value="lainnya">Pertanyaan Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Subjek / Judul</label>
                    <input type="text" name="subject" class="form-control" placeholder="Contoh: Pesanan saya belum berubah status" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Lengkap</label>
                    <textarea name="message" class="form-control" rows="4" placeholder="Jelaskan kendala Anda selengkapnya..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Kirim Tiket</button>
            </form>
        </div>
    </div>
</body>
</html>
