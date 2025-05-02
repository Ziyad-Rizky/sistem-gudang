<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Gudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col justify-center items-center p-4">
        <div class="max-w-4xl w-full bg-white rounded-lg shadow-lg p-8 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Sistem Manajemen Gudang</h1>
            <p class="text-lg text-gray-600 mb-8">Solusi modern untuk pengelolaan inventaris dan mutasi barang</p>
            
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-2">Manajemen Barang</h2>
                    <p class="text-gray-600">Kelola stok barang dengan mudah dan efisien</p>
                </div>
                <div class="bg-green-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-green-800 mb-2">Tracking Mutasi</h2>
                    <p class="text-gray-600">Pantau perpindahan barang secara real-time</p>
                </div>
            </div>

            <div class="space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <footer class="mt-8 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} Sistem Gudang. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
