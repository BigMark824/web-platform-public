<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', env('APP_NAME', 'WebPlatform'))</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/font-awesome/all.min.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        <main class="flex-1">
            @yield('content')
        </main>

        @include('layouts.footer')
    </body>
</html>