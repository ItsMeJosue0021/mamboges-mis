<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="{{asset('image/mambog.png')}}"/>
    <title>Mambog Elementary School</title>

     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <x-red-header/>
    <x-nav-header/>
    <main>
        {{$slot}}
    </main>
    <x-footer/>
</body>
</html>





