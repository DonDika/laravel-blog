
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 6rem;
            margin-bottom: 0.5rem;
            color: #ef4444;
        }
        p {
            font-size: 1.5rem;
        }
        a {
            display: inline-block;
            margin-top: 1.5rem;
            text-decoration: none;
            color: #3b82f6;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>403</h1>
        <p>Anda tidak diizinkan untuk akses ke halaman ini.</p>
        {{-- <a href="{{ url('/') }}">Kembali ke Beranda</a> --}}
    </div>
</body>
</html>
