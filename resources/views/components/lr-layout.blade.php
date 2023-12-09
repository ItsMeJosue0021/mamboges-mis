<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mambog Elementary School</title>

    <link rel="icon" href="{{asset('image/mambog.png')}}"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-head.tinymce-config/>

</head>

<body>
    <section class="w-full">
        <div class="h-fit min-h-screen mx-auto flex">
            <!-- main -->
            <div class="w-full h-full flex flex-col  mx-auto pb-4">
                <!-- header -->
                <div class=" w-full flex items-center justify-between py-3 px-4 border-b border-gray-300 bg-white shadow z-10">
                    <div class="flex md:hidden items-center py-2 mb-2">
                        <button class="px-2 py-1 rounded hover:bg-gray-100" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
                            <i class='bx bx-menu text-4xl text-gray-700'></i>
                        </button>
                    </div>

                    <div class="hidden md:flex items-center">
                        <a href="/" class="flex items-center space-x-2">
                            <img class="w-[60px] h-[60px]" src="{{ asset('image/mambog.png') }}" alt="">
                            <div class="flex flex-col">
                                <p class="castoro text-sm font-bold">MAMBOG</p>
                                <p class="castoro text-xs font-medium">ELEMENTARY SCHOOL</p>
                            </div>
                        </a>
                    </div>

                    <div class="flex items-center space-x-2 ">
                        {{-- <i class='bx bx-cog text-2xl text-lightestgray '></i> --}}
                        <div class="flex sm:items-center">
                            <x-dropdown  width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div class="flex items-center space-x-2">
                                            <div>
                                                <h1 class="poppins">{{ Auth::user()->profile->firstName }}
                                                    {{ Auth::user()->profile->lastName }}</h1>
                                            </div>
                                            <img class="h-10 w-10 rounded-full border bprder-gray-200"
                                                src="{{ Auth::user()->profile->image ? asset('storage/' . Auth::user()->profile->image) : asset('image/mamboges.jpg') }}"
                                                alt="">
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
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
                <div id="container" class="w-full py-4 px-4 bg-white text-gray-700 h-auto min-h-screen">
                    <main>
                        {{$slot}}
                    </main>
                </div>
            </div>
        </div>
        <x-flash-messages/>

         <!-- drawer component -->
         <div id="drawer-navigation" class="fixed top-0 left-0 z-50 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64 dark:bg-gray-800 text-gray-700" tabindex="-1" aria-labelledby="drawer-navigation-label">
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
                        <a id="link6"
                            class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                            href="{{ route('lr.video') }}">
                            <i class='bx bxs-videos text-xl text-lightblack group-hover:text-blue-600'></i>
                            <p class="poppins text-sm group-hover:text-blue-600">Video Lessons</p>
                        </a>
                    </li>

                    <li>
                        <a id="link13"
                            class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                            href="{{ route('lr.module') }}">
                            <i class='bx bx-book text-xl text-lightblack group-hover:text-blue-600'></i>
                            <p class="poppins text-sm group-hover:text-blue-600">Modules</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>
