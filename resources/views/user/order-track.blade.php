<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pesanan #{{ $order->order_number }} - Sepatukuid</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #E53935;
            --primary-dark: #C62828;
            --secondary: #2196F3;
            --dark: #121212;
            --gray: #666;
            --light: #f8f9fa;
            --success: #4CAF50;
            --warning: #FF9800;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #f0f2f5 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .order-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
            margin-top: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 25px;
        }

        .timeline-icon {
            position: absolute;
            left: -39px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--light);
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: transparent;
        }

        .timeline-item.active .timeline-icon {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 0 0 4px rgba(229, 57, 53, 0.2);
        }

        .timeline-item.done .timeline-icon {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .timeline-content {
            background: var(--light);
            padding: 15px 20px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .timeline-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .timeline-desc {
            color: var(--gray);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .timeline-time {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 8px;
            font-weight: 600;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            background: var(--dark);
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('orders') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Pesanan
        </a>

        <div class="order-card">
            <h2>Lacak Pesanan #{{ $order->order_number }}</h2>
            <p style="color: var(--gray); margin-top: 5px;">Status Saat Ini: <span style="font-weight: 700; color: var(--primary);">{{ strtoupper($order->status) }}</span></p>

            <div class="timeline">
                @forelse($order->tracks as $index => $track)
                    <div class="timeline-item {{ $index == 0 ? 'active' : 'done' }}">
                        <div class="timeline-icon">
                            @if($index == 0) <i class="fa-solid fa-location-dot"></i> @else <i class="fa-solid fa-check"></i> @endif
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">{{ $track->status_title }}</div>
                            <div class="timeline-desc">{{ $track->description ?: '-' }}</div>
                            <div class="timeline-time"><i class="fa-regular fa-clock"></i> {{ $track->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px; color: var(--gray);">
                        <i class="fa-solid fa-box-open" style="font-size: 3rem; color: #ddd; margin-bottom: 15px; display: block;"></i>
                        Belum ada riwayat pelacakan rinci dari admin. Silakan tunggu beberapa saat atau hubungi kami.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
