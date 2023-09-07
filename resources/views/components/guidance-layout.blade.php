<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Castoro&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="icon" href="{{asset('image/mambog.png')}}"/>
    <title>Mambog Elementary School</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <section class="w-full min-w-900px">
        <div class="h-fit min-h-screen container mx-auto flex">
            <!-- sidebar -->
            <div class="min-h-full flex flex-grow border-r border-gray-300 bg-white shadow fixed z-30">
                <div class="h-full p-2 px-4 min-w-250px">
                    <!-- logo -->
                    <div class="flex items-center py-2 mb-4">
                        <a href="/" class="flex items-center space-x-2">
                            <img class="w-60px h-60px" src="{{asset('image/mambog.png')}}" alt="">
                            <div class="flex flex-col">
                                <p class="castoro text-sm font-bold">MAMBOG</p>
                                <p class="castoro text-xs font-medium">ELEMENTARY SCHOOL</p>
                            </div>
                        </a>
                    </div>

                    <!-- links -->
                    <div id="links" class="h-full flex flex-col overflow-y-auto">
                        @if (Auth::user()->type === 'guidance')
                        <div class="space-y-1 py-2">                         
                            <a id="link2" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/students">
                                <i class='bx bx-user-circle text-2xl text-lightblack group-hover:text-blue-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Learners</p>
                            </a>
    
                            <a id="link3" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/faculties">
                                <i class='bx bx-user-pin text-2xl text-lightblack group-hover:text-blue-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Faculty</p>
                            </a>

                            <a id="link1" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/sections">
                                <i class='bx bx-folder text-2xl text-lightblack group-hover:text-blue-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Sections</p>
                            </a>
                            
                            <a id="link8" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/subjects">
                                <i class='bx bx-book-alt text-2xl text-lightblack group-hover:text-blue-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Subjects</p>
                            </a>

                            <a id="link4" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/departments">
                                <i class='bx bx-category text-2xl text-lightblack group-hover:text-blue-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Departments</p>
                            </a>

                        </div>

                        <div class="w-full border-t-2 border-gray-200 pt-2 space-y-1">
                            <a id="link6" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/updates/list">
                                <i class='bx bx-news text-2xl text-lightblack group-hover:text-blue-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">News & Updates</p>
                            </a>
    
                            <a id="link7" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/feedback">
                                <i class='bx bx-comment-dots text-2xl text-lightblack group-hover:text-blue-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Feedback</p>
                            </a>
    
                        </div>

                        <div class="w-full border-b-2 border-gray-200 pb-2 space-y-1">
                            <a id="settingsBtn" class="flex group items-center justify-between p-2 rounded hover:bg-blue-50 focus:bg-blue-50 cursor-pointer">
                                <div class="flex items-center space-x-4">
                                    <i class='bx bx-cog text-2xl text-lightblack group-hover:text-blue-600'></i>
                                    <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Settings</p>
                                </div>
                                <i class='bx bx-chevron-down text-xl'></i>
                            </a>

                            <div  id="settings" class="hidden w-full space-y-1 border-t border-gray-200">
                                <a id="link9" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/logs">
                                    <i class='bx bx-list-ul text-2xl text-lightblack group-hover:text-blue-600'></i>
                                    <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Logs</p>
                                </a>
        
                                <a id="link10" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/archive">
                                    <i class='bx bx-archive text-2xl text-lightblack group-hover:text-blue-600'></i>
                                    <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Archive</p>
                                </a>
    
                                <a id="link11" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/settings">
                                    <i class='bx bx-calendar text-2xl text-lightblack group-hover:text-blue-600'></i>
                                    <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">School Year</p>
                                </a>
    
                                <a id="link12" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/profile">
                                    <i class='bx bxs-user-detail text-2xl text-lightblack group-hover:text-blue-600'></i>
                                    <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Profile</p>
                                </a>
                            </div>
                        </div>


                        <script>
                             openLinks();

                            function openLinks() {
                                const settingsBtn = document.getElementById('settingsBtn');
                                const settings = document.getElementById('settings');

                                settingsBtn.addEventListener('click', () => {
                                    if (settings.classList.contains('hidden')) {
                                        settings.classList.remove('hidden');
                                        settingsBtn.querySelector('.bx-chevron-down').classList.add('rotate-180');
                                    } else {
                                        settings.classList.add('hidden');
                                        settingsBtn.querySelector('.bx-chevron-down').classList.remove('rotate-180');
                                    }
                                });
                            }
                        </script>

                        

                        @elseif(Auth::user()->type === 'faculty') 

                            <div class="w-full self-end py-2 space-y-1">
                                <a id="link13" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/classes">
                                    <i class='bx bx-spreadsheet text-2xl text-lightblack group-hover:text-blue-600'></i>
                                    <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Classes</p>
                                </a>

                                <a id="link14" class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50" href="/profile">
                                    <i class='bx bxs-user-detail text-2xl text-lightblack group-hover:text-blue-600'></i>
                                    <p class="poppins text-lightblack font-medium text-sm group-hover:text-blue-600">Profile</p>
                                </a>
                            </div>


                        @endif

                    </div>
                </div>
            </div>

            <!-- main -->
            <div class="ml-250px relative w-full h-full flex flex-col container">
                <!-- header -->
                <div class="fixed custom-width flex items-center justify-between py-2 px-4 border-b border-gray-300 bg-white shadow z-10">
                    <div class="">
                        <p>SCHOOL YEAR: <span class="text-blue-500">{{$schoolYear}}</span></p>
                    </div>
                    <div class="flex items-center space-x-2 py-4">
                        {{-- <i class='bx bx-cog text-2xl text-lightestgray '></i> --}}
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown  width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>
                                            <h1 class="poppins">{{ Auth::user()->name }}</h1>
                                        </div>
            
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
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

                        <img class="h-9 w-9 rounded-full border bprder-gray-200"  src="{{Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('image/mamboges.jpg')}}" alt="">

                    </div>
                </div>

                <!-- main content -->
                <div class="h-full relative mt-20">
                    <main>
                        {{$slot}}
                    </main>
                </div>
            </div>

        </div>
        @if (session()->has('success') || session()->has('error')) 
            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="fixed top-0 left-1/2 transform -translate-x-1/2 text-white px-10 py-3 z-50">
                <p>{{session('message')}}</p>
            </div>
        @endif

    </section>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const links = document.querySelectorAll('#links a');
        const baseUrl = window.location.origin; 
        const activeLinkId = localStorage.getItem('activeLinkId');
        links.forEach((link) => {
            if (link.href.startsWith(baseUrl)) {
                link.addEventListener('click', function(event) {
                localStorage.setItem('activeLinkId', link.id);

                links.forEach((link) => {
                    link.classList.remove('active');
                });

                this.classList.add('active');
                });

                if (window.location.href.includes(link.href)) {
                    link.classList.add('active');

                    localStorage.setItem('activeLinkId', link.id);
                }

                if (link.id === activeLinkId) {
                    link.classList.add('active');
                }
            }
        });
    </script>
</body>

</html>
