<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Менеджер задач')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @if(session('status'))
            <div>{{ session('status') }}</div>
        @endif
        <div id="app">
            @include('sections.static.header')
            <section>
                <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 lg:py-16 lg:grid-cols-12 lg:pt-28 xl:gap-0">
                    <div class="grid col-span-full">
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
