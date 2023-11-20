<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mambog Elementary School</title>
        {{-- icon --}}
        <link rel="icon" href="{{asset('image/mambog.png')}}"/>

        {{-- links --}}

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        {{-- script --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body>
        <x-red-header/>
        <x-nav-header/>
        <x-web.web-hero/>
        <x-web.web-news-and-updates :firstupdate="$first_update" :updates="$updates" />
        <x-web.web-achievement :firstachievement="$first_achievement" :achievements="$achievements" />
        <x-web.web-missionvission />
        <x-web.org-chart :orgChartRows="$rows" />
        <x-web.web-feedback />
        <x-footer/>
    </body>
</html>
