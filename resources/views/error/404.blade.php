<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* CSS Kustom untuk Animasi Lampu Polisi */
        @keyframes pulse-glow {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.3;
            }

            50% {
                transform: scale(1.5);
                opacity: 0.6;
            }
        }

        .animate-pulse-blue {
            animation: pulse-glow 4s ease-in-out infinite;
        }

        .animate-pulse-red {
            animation: pulse-glow 4s ease-in-out infinite;
            animation-delay: 2s;
            /* Delay agar kedipnya tidak bersamaan */
        }
    </style>
</head>

<body class="bg-slate-900 text-white overflow-hidden">

    <div class="relative flex items-center justify-center min-h-screen">

        <div
            class="absolute top-0 left-0 w-72 h-72 bg-blue-600 rounded-full mix-blend-screen filter blur-3xl opacity-50 animate-pulse-blue">
        </div>
        <div
            class="absolute bottom-0 right-0 w-72 h-72 bg-red-600 rounded-full mix-blend-screen filter blur-3xl opacity-50 animate-pulse-red">
        </div>

        <div class="relative text-center p-8 z-10">

            <h1 class="text-6xl md:text-8xl font-extrabold text-white drop-shadow-md">404</h1>

            <p class="mt-4 text-lg md:text-xl text-slate-300 max-w-md mx-auto">
                Maaf, jalur yang Anda ambil tidak ada nih. Silakan kembali ke halaman utama.
            </p>

            <div class="mt-8">
                <a href="/"
                    class="inline-block px-8 py-3 bg-slate-700 text-white font-semibold rounded-lg shadow-lg hover:bg-slate-600 transition-colors duration-300">
                    Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>

</body>

</html>
