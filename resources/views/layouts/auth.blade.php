<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logos.svg') }}">
    <link rel="alternate icon" href="{{ asset('images/icon.png') }}">
    <title>BMN BBPMP Provinsi Jawa Barat</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* Hapus overflow: hidden untuk memungkinkan scroll */
        html, body {
            height: 100%;
        }
        
        /* Untuk desktop, kita bisa batasi overflow */
        @media (min-width: 1024px) {
            html, body {
                overflow: hidden;
            }
        }
    </style>
</head>
<body class="h-full">
    @yield('content')
    
    @stack('scripts')
</body>
</html>