<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net ">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-6 relative">
        
        <!-- Blurred background image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
             style="background-image: url('{{ asset('images/images12.jpg') }}'); filter: blur(3px);"></div>
        
        <!-- Dark overlay for better text readability -->
        <div class="absolute inset-0 bg-black/40"></div>
        
        <!-- Content wrapper with higher z-index -->
        <div class="relative z-10 flex flex-col items-center">
            <!-- Very big title -->
            <div class="mb-8">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white drop-shadow-2xl text-center tracking-wider">
                    E-Notis JPPH
                </h1>
            </div>
            
            <div>
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 h-20 drop-shadow-lg" />
                </a>
            </div>
            <div
                class="w-full sm:max-w-md mt-6 px-8 py-6 bg-white/95 backdrop-blur-md shadow-2xl rounded-2xl border border-white/20">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>