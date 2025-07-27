<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GUGA ADMIN</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="preload" href="{{ asset('img/logo_normal.png') }}" as="image">
        <!-- Scripts -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="font-sans antialiased bg-gradient-to-b from-slate-50 via-slate-200 to-slate-300">
        @vite('resources/js/app.js')
        <!-- Page Content -->
        <main>
            <div id="app"></div>
            {{-- {{ $slot }} --}}
        </main>

    </body>
</html>
