<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mambog Elementary School</title>

    <link rel="icon" href="{{ asset('image/mambog.png') }}" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <section class="w-full">
        <div id="container" class="min-w-[1600px] md:min-w-[1500px] w-full px-4">
            <main>
                {{ $slot }}
            </main>
        </div>
    </section>
</body>

</html>
