<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gulag</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gray-100">
            <div class="p-6">
                @if (Route::has('login'))
                    <nav class="flex justify-end space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-gray-900">Register</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>

            <div class="flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        Welcome to the Gulag
                    </h1>
                    <p class="text-lg text-gray-600">
                        Please login or register to continue
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>