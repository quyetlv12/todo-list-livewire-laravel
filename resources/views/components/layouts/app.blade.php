<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TodoList App' }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="overflow-x-hidden">
    @auth
    <livewire:layout.header>
        @endauth
        <main>
            {{ $slot }}
        </main>
        <x-toaster-hub />
</body>

</html>