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
    <link rel="stylesheet" href="{{ asset('css/print-class-record.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        @media print {
            #class-record {
                width: 100%; /* Set the width to 100% for printing */
                margin: 0; /* Remove any margins for printing */
                page-break-before: always; /* Ensure each section starts on a new page */
                /* Additional styles for the print layout */
                transform: scale(0.8); /* Adjust the scale as needed to fit onto the A4 paper */
                transform-origin: top left; /* Set the transformation origin to top left */
            }
        }

    </style>

</head>

<body>
    <section class="w-full ">
        <div class="h-fit min-h-screen flex">
            <!-- main -->
            <div class="w-full h-full flex flex-col pb-4">
                <!-- header -->
                <div
                    class="w-full sticky top-0 flex items-center justify-between py-3 px-4 border-b border-gray-300 bg-white shadow z-10">

                    <div class="flex items-center text-gray-700">
                        <a href="/" class="flex items-center space-x-2">
                            <img class="w-[60px] h-[60px]" src="{{ asset('image/mambog.png') }}" alt="">
                            <div class="flex flex-col">
                                <p class="castoro text-sm font-bold">MAMBOG</p>
                                <p class="castoro text-xs font-medium">ELEMENTARY SCHOOL</p>
                            </div>
                        </a>
                    </div>
                    <div class="flex items-center space-x-2 ">
                        <div class="flex sm:items-center">
                            <x-dropdown width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <img class="h-10 w-10 rounded-full border bprder-gray-200"
                                            src="{{ Auth::user()->profile->image ? asset('storage/' . Auth::user()->profile->image) : asset('image/mamboges.jpg') }}"
                                            alt="">
                                    </button>
                                </x-slot>
                                <x-slot name="content" class=" ">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
                <!-- main content -->
                <div id="container" class="w-full px-4 bg-white text-gray-700 h-auto min-h-screen">
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
        <x-flash-messages />
    </section>
</body>

</html>
