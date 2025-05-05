<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GUGA</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="preload" href="{{ asset('img/logo_normal.png') }}" as="image">
        <!-- Scripts -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('scripts')
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="flex flex-col min-h-screen relative">
            {{-- @include('layouts.navigation') --}}

            <!-- Page Heading -->
            @isset($header)
                {{-- <header id="navbar" class="sticky top-0 z-20 w-full dark:bg-gray-800 shadow transition-all duration-300"> --}}
                <header id="navbar" class="navbar fixed  w-full dark:bg-gray-800 transition-all duration-300 z-50">
                        {{ $header }}
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            @isset($footer)
                <footer class="bg-white dark:bg-gray-800 shadow">
                    {{ $footer }}
                </footer>
            @endisset


            @if(request()->is('/'))
                <div id="contactBtn" class="fixed bottom-10 right-0 z-50 hidden">
                    <x-contact-button />
                </div>
            @endif
        </div>
    </body>
</html>
