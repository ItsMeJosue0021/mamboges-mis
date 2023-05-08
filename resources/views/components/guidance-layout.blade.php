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
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="{{asset('image/mambog.png')}}"/>
    <title>Mambog Elementary School</title>

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
            .active {
                background-color: #FEF2F2;
            }

            .active p, .active i {
                color: #DC2626; 
            }

            .active-archive {
                background-color: #60a5fa;
                color: white;
            }

            .active-archive label, .active-archive i  {
                color: white;
            }

            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                display: none;
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
                    '250px': '250px',
                    
                },
                width: {
                    '60px': '60px',
                    '250px': '400px',
                    '500px': '500px',
                    '200px': '200px',
                    '300px': '300px',
                    '400px': '400px',
                    '700px': '700px',
                    '300px': '300px',
                    '250px': '250px',
                },
                height: {
                    '60px': '60px',
                    '560px': '560px',
                    '565px': '565px',
                    '570px': '570px',
                    '580px': '580px',
                    '585px': '585px',
                    '595px': '595px',
                    '600px': '600px',
                    '700px': '670px',
                    '400px': '400px',
                    '390px': '390px',
                    '500px': '500px',
                    '200px': '200px',
                    '250px': '250px',
                    '300px': '300px',
                },
                minHeight: {
                    '600px': '600px',
                    '900px': '900px',
                    '250px': '250px',
                },
                minWidth: {
                    '250px': '250px',
                    '900px': '900px',
                },
                fontSize: {
                    
                },
                backgroundImage: {
                    
                },
                boxShadow: {
                    'EmailForm': '0px 0px 6px 0px rgba(0,0,0,0.2)',
                }
            }
        }
    }
    </script>
</head>

<body>
    <section class="w-full min-w-900px">
        <div class="h-fit min-h-screen container mx-auto flex">
            <!-- sidebar -->
            <div class="min-h-full flex flex-grow border-r border-gray-300 bg-white shadow fixed z-20">
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
                    <div id="links" class="h-full flex flex-col">
                        @if (Auth::user()->type === 'guidance')
                        <div class="space-y-1 py-2">                         
                            <a id="link2" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/students">
                                <i class='bx bx-user-circle text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Students</p>
                            </a>
    
                            <a id="link3" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/faculties">
                                <i class='bx bx-user-pin text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Faculty</p>
                            </a>

                            <a id="link1" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/sections">
                                <i class='bx bx-folder text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Sections</p>
                            </a>
                            
                            <a id="link8" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/subjects">
                                <i class='bx bx-book-alt text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Subjects</p>
                            </a>

                            <a id="link4" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/departments">
                                <i class='bx bx-category text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Departments</p>
                            </a>

                            {{-- <a id="link5" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/parents">
                                <i class='bx bx-user text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Parents</p>
                            </a> --}}
                        </div>

                        <div class="w-full border-t-2 border-gray-200 py-2 space-y-1">
                            <a id="link6" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/updates/list">
                                <i class='bx bx-news text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">News & Updates</p>
                            </a>
    
                            <a id="link7" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/feedback">
                                <i class='bx bx-comment-dots text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Feedback</p>
                            </a>
    
                        </div>

                        <div class="w-full border-t-2 border-gray-200 py-2 space-y-1">
                            <a id="link9" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/logs">
                                <i class='bx bx-list-ul text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Logs</p>
                            </a>
    
                            <a id="link10" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/archive">
                                <i class='bx bx-archive text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Archive</p>
                            </a>
                        </div>

                        <div class="w-full self-end border-t-2 border-gray-200 py-2 space-y-1">
                            <a id="link11" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/settings">
                                <i class='bx bx-cog text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Settings</p>
                            </a>

                            <a id="link12" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/profile">
                                <i class='bx bxs-user-detail text-2xl text-lightblack group-hover:text-red-600'></i>
                                <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Profile</p>
                            </a>
                        </div>

                        @elseif(Auth::user()->type === 'faculty') 

                            <div class="w-full self-end py-2 space-y-1">
                                <a id="link13" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/classes">
                                    <i class='bx bx-spreadsheet text-2xl text-lightblack group-hover:text-red-600'></i>
                                    <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Classes</p>
                                </a>

                                <a id="link14" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/profile">
                                    <i class='bx bxs-user-detail text-2xl text-lightblack group-hover:text-red-600'></i>
                                    <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Profile</p>
                                </a>
                            </div>


                        @endif

                    </div>
                </div>
            </div>

            <!-- main -->
            <div class="ml-250px w-full h-full flex flex-col container">
                <!-- header -->
                <div class="w-full flex items-center justify-end py-2 px-8 border-b border-gray-300 shadow z-20">
                    <div class="flex items-center space-x-4 py-4 z-20">
                        {{-- <i class='bx bx-cog text-2xl text-lightestgray '></i> --}}
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
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

                        <img class="h-8 w-8 rounded-full border bprder-gray-200" src="{{asset('image/profile.png')}}" alt="">
                    </div>
                </div>

                <!-- main content -->
                <div class="w-full h-full z-10 relative">
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
