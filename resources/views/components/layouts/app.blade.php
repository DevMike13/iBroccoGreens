<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <wireui:scripts />
    </head>
    <body>
        @livewire('partials.navbar')
        {{ $slot }}
        @livewire('partials.footer')
        @livewireScripts
    </body>
</html>
