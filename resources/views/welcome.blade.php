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
        <x-web.org-chart :orgChartRows="$rows" />
        <x-web.web-missionvission />
        <x-web.web-feedback />
        <x-footer/>

        <button onclick="topFunction()" id="myBtn" title="Go to top" class="fixed bottom-8 right-8 px-2 py-1 rounded cursor-pointer hidden bg-red-600 bg-opacity-10">
            <i class='bx bx-up-arrow-circle text-6xl text-red-600'></i>
        </button>

        <script>
            window.onscroll = function() {
                scrollFunction();
            };

            function scrollFunction() {
                var mybutton = document.getElementById("myBtn");
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }

            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
    </body>
</html>
