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
    <body class="font-sans text-gray-900">
        <div class="
            bg-gray-100
            min-h-screen  
            pt-6 sm:pt-0 
            flex flex-col sm:justify-center items-center
        ">
            <div class="
                bg-white
                w-full sm:max-w-md 
                px-6 py-4 sm:rounded-lg shadow-md mt-6 overflow-hidden 
            ">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
