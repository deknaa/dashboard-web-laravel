<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased overflow-hidden">
        <div class="p-5 min-h-screen flex items-center justify-center bg-[#4880FF] dark:bg-gray-900 relative">

            <img src="{{ asset('assets/pattern/Shape.png') }}" class="bg-no-repeat bg-blend-multiply bg-cover absolute w-full h-screen object-cover">

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-2xl relative">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
