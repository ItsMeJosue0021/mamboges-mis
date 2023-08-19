<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('image/mambog.png')}}"/>
    <title>Mambog Elementary School</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="w-full min-w-900px">
        <div class="h-fit min-h-screen container mx-auto flex">
            <!-- main -->
            <div class="w-full h-full flex flex-col container mx-auto pb-4">
                <!-- header -->
                <div class="fixed w-full flex items-center justify-between py-3 px-8 border-b border-gray-300 bg-white shadow z-10">
                    <div class="flex items-center">
                        <a href="/" class="flex items-center space-x-2">
                            <img class="w-60px h-60px" src="{{asset('image/mambog.png')}}" alt="">
                            <div class="flex flex-col">
                                <p class="castoro text-sm font-bold">MAMBOG</p>
                                <p class="castoro text-xs font-medium">ELEMENTARY SCHOOL</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-2 ">
                        {{-- <i class='bx bx-cog text-2xl text-lightestgray '></i> --}}
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown  width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{-- <div>
                                            <h1 class="poppins">{{ Auth::user()->name }}</h1>
                                            
                                        </div>
            
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div> --}}
                                        <img class="h-10 w-10 rounded-full border bprder-gray-200"  src="{{Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('image/mamboges.jpg')}}" alt="">
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
                <div class="w-full pt-24 px-8">
                    <main>
                        {{$slot}}
                    </main>
                </div>
            </div>

        </div>
        @if (session()->has('message')) 
            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
                <p>{{session('message')}}</p>
            </div>
        @endif
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const links = document.querySelectorAll('#links a');
        const baseUrl = window.location.origin; 
        const activeLinkId = localStorage.getItem('activeLinkId');
        links.forEach((link) => {
        if (link.href.startsWith(baseUrl)) {
            // Add an event listener to the link
            link.addEventListener('click', function(event) {
            // Set the id of the clicked link in localStorage
            localStorage.setItem('activeLinkId', link.id);

            // Remove active class from all links
            links.forEach((link) => {
                link.classList.remove('active');
            });

            // Add active class to the clicked link
            this.classList.add('active');
            });

            // Check if the current URL includes the link's href
            if (window.location.href.includes(link.href)) {
            // Add active class to the link
            link.classList.add('active');

            // Set the id of the clicked link in localStorage
            localStorage.setItem('activeLinkId', link.id);
            }

            // Check if the link's id matches the id of the previously clicked link
            if (link.id === activeLinkId) {
            // Add active class to the link
            link.classList.add('active');
            }
        }
        });
    </script>
</body>

</html>
