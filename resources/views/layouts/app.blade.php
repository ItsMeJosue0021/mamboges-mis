<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mambog Elementary School</title>


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Castoro&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <script src="//unpkg.com/alpinejs" defer></script>
        <link rel="icon" href="{{asset('image/mambog.png')}}"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            <x-portal-header/>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <x-flash-messages />

            @if (Auth::user()->type == 'student')
                <!-- drawer component -->
                <div id="drawer-navigation" class="fixed top-0 left-0 z-50 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
                    <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>
                    <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close menu</span>
                    </button>
                    <div class="py-4 overflow-y-auto">
                        <ul class="space-y-1 font-medium">
                            <li>
                                <a id="link12"
                                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                                    href="{{ route('change.password') }}">
                                    <i
                                        class='bx bxs-user-detail text-xl text-lightblack group-hover:text-blue-600'></i>
                                    <p class="poppins text-sm group-hover:text-blue-600">Change Password</p>
                                </a>
                            </li>

                            {{-- <li>
                                <a id="link13"
                                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                                    href="{{ route('lr.module') }}">
                                    <i class='bx bx-book text-xl text-lightblack group-hover:text-blue-600'></i>
                                    <p class="poppins text-sm group-hover:text-blue-600">Modules</p>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            @endif

        </div>
    </body>
</html>
