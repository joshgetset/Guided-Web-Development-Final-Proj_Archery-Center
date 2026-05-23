<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo.svg') }}">
        <meta name="application-name" content="{{ config('app.name', 'Archery Adventures') }}">
        <meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'Archery Adventures') }}">
        <title>@yield('title', config('app.name', 'Archery Adventures'))</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @fonts

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                body { margin: 0; font-family: 'Open Sans', ui-sans-serif, system-ui, sans-serif; background: #F5F5DC; color: #1B1B18; }
            </style>
        @endif
        @stack('head')
    </head>

    <body class="overflow-x-hidden bg-[#F5F5DC] text-[#1B1B18]">
        <div class="min-h-screen overflow-x-hidden">
            @include('partials.header', ['activePage' => $activePage ?? null])

            @yield('content')

            @include('partials.footer')
            @include('partials.auth-modals')
        </div>
        @stack('scripts')
    </body>
</html>
