<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net ">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .ultra-bold-title {
            font-weight: 900;
            font-family: 'figtree', sans-serif;
            -webkit-text-stroke: 2px white;
            text-stroke: 2px white;
            text-shadow: 
                3px 3px 0px white,
                -1px -1px 0px white,  
                1px -1px 0px white,
                -1px 1px 0px white,
                1px 1px 0px white,
                4px 4px 8px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-6 relative">
        
        <!-- Blurred background image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
             style="background-image: url('{{ asset('images/images13.jpg') }}'); filter: blur(3px);"></div>
        
        <!-- Dark overlay for better text readability -->
        <div class="absolute inset-0 bg-black/40"></div>
        
        <!-- Content wrapper with higher z-index -->
        <div class="relative z-10 flex flex-col items-center">
            
            <!-- Title and Logo Container Box -->
            <div class="mb-8 bg-white/10 backdrop-blur-md rounded-3xl px-8 py-6 border border-white/30 shadow-2xl">
                <div class="flex items-center justify-center gap-6">
                    <!-- Logo -->
                    <div>
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 drop-shadow-lg" />
                        </a>
                    </div>
                    
                    <!-- Title -->
                    <div>
                        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl ultra-bold-title drop-shadow-2xl text-center tracking-wider" 
                            style="color: #0e2050ff;">
                            E-NotisJPPH
                        </h1>
                    </div>
                </div>
            </div>
            
            <!-- Login/Content Box -->
            <div class="w-full sm:max-w-md px-8 py-6 bg-white/95 backdrop-blur-md shadow-2xl rounded-2xl border border-white/20">
                <!-- Main content area -->
                <div class="flex flex-col h-full">
                    <!-- Form content goes here -->
                    <div class="flex-grow">
                        {{ $slot }}
                    </div>
                    
                    <!-- Additional text positioned above button -->
                    <div class="mt-6 mb-1 text-center">
                        <p class="text-sm text-gray-600 font-medium">
                            Maklumat lanjut boleh hubungi<br>JPPH Teluk Intan 
                            <a href="tel:056223711" class="text-blue-600 hover:text-blue-800 underline font-semibold">
                                05-6223711
                            </a>
                            atau email: 
                            <a href="mailto:jpphtelukintan@gmail.com" class="text-blue-600 hover:text-blue-800 underline font-semibold">
                                jpphtelukintan@gmail.com
                            </a>
                        </p>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</body>
</html>