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
</head>
<body>
    <section class="w-full">
        <div class="h-fit min-h-screen flex">
            <!-- main -->
            <div class="w-full h-full flex flex-col pb-4">
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
                        <div class="flex sm:items-center">
                            <x-dropdown  width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <img class="h-10 w-10 rounded-full border bprder-gray-200"  src="{{Auth::user()->profile->image ? asset('storage/' . Auth::user()->profile->image) : asset('image/mamboges.jpg')}}" alt="">
                                    </button>
                                </x-slot>
                                
                                <x-slot name="content" class=" ">
                                    @if (Auth::user()->type == 'lr')
                                        <x-dropdown-link :href="route('lr.video')">
                                            {{ __('Videos') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('lr.module')">
                                            {{ __('Modules') }}
                                        </x-dropdown-link>
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
                                    @else
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
                                    @endif
                                    
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
                <!-- main content -->
                <div id="container" class="w-full pt-24 px-8">
                    <main>
                        {{$slot}}
                    </main>
                </div>
            </div>
        </div>
        <x-flash-messages/>
    </section>
</body>
</html>
