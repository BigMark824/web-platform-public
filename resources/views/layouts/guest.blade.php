<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'WebPlatform') }}</title>
    @vite(['resources/css/app.css', 'resources/css/font-awesome/all.min.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    @include('layouts.navigation-guest')

    <main class="flex-1">
        {{ $slot }}
    </main>

    @include('layouts.footer')
</body>
</html>