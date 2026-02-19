<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Dashboard - Sepatukuid</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        h1 {
            color: #333;
        }
        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            text-align: center;
        }
        .card h2 {
            color: #E53935;
            margin-bottom: 15px;
        }
        .btn-logout {
            background: #E53935;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard Petugas (CS)</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
        
        <div class="card">
            <h2>Selamat datang, {{ Auth::user()->name }}!</h2>
            <p><i class="fa-solid fa-envelope"></i> {{ Auth::user()->email }}</p>
            <p><i class="fa-solid fa-tag"></i> Role: <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>
            <p style="margin-top: 20px; color: #666;">Ini adalah halaman dashboard petugas (Customer Service). Hanya petugas yang bisa mengakses halaman ini.</p>
        </div>
    </div>
</body>
</html>