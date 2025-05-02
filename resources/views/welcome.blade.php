<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white flex items-center justify-center min-h-screen">
    <div class="text-center p-6 bg-white bg-opacity-10 rounded-lg shadow-lg backdrop-blur-md">
        <h1 class="text-4xl font-bold mb-3">Welcome to Laravel</h1>
        <p class="text-lg mb-4">Your app is ready to go!</p>
        @if (Route::has('login'))
            <div class="space-x-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-green-600 rounded hover:bg-green-700 transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700 transition">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
