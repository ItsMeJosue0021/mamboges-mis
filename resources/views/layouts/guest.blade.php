<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Castoro&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="//unpkg.com/alpinejs" defer></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style type="text/tailwindcss">
            @layer utilities {
                .poppins {
                    font-family: 'Poppins', sans-serif;
                }
                .castoro {
                    font-family: 'Castoro', serif;
                }
                label.error {   
                    color: red;
                    font-family: 'Poppins', sans-serif;
                    font-size: 12px;
                }
            }
        </style>
    
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        screens: {
                            'phone': '350px',
                            'tablet': '640px',
                            'tablet+': '850px',
                            'laptop': '1024px',
                            'desktop': '1280px',
                        },
                        colors: {
                            // red: '#d90429',
                            // blue: '#004e89',
                            lightgray: '#EFF0F3',
                            yellow: '#FBE830',
                            black: '#212529',
                            lightblack: '#343a40',
                            youtube: '#FF0000',
                            lightestgray: '#6c757d',
                            whitegray: '#e9ecef',
                            white2: '#f8f9fa'
                        },
                        margin: {
                            '3px': '3px',
                            '1px': '1px',
                        },
                        width: {
                            '1px': '5px',
                            '70px': '70px',
                            '80px': '80px',
                            '250px': '250px',
                            '200px': '200px',
                            '180px': '180px',
                            '400px': '600px',
                            '300px': '300px',
                        },
                        height: {
                            '70px': '70px',
                            '80px': '80px',
                            '250px': '250px',
                            '200px': '200px',
                            '610px': '610px',
                            '300px': '80px',
                            '400px': '400px',
                            '550px': '550px',
                        },
                        minHeight: {
                            '610px': '610px',
                        },
                        maxHeight: {
                            '600px': '600px',
                        },
                        fontSize: {
                            '5px': '12px',
                        },
                        backgroundImage: {
                            'school': "url('image/school-blur.png')",
                            'deped': "url('images/deped.png')",
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                {{-- <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a> --}}
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
