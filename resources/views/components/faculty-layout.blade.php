<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Castoro&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="images/mambog.png"/>
    <title>Mambog Elementary School</title>

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
                    
                },
                width: {
                    '60px': '60px',
                    '250px': '400px',
                    '200px': '200px',
                },
                height: {
                    '60px': '60px',
                    '560px': '560px',
                    '570px': '570px',
                    '585px': '585px',
                    '600px': '600px',
                    '700px': '670px',
                    '660px': '650px',
                    '400px': '400px',
                },
                minHeight: {
                    '900px': '900px',
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
            <div class="min-h-full flex flex-grow">
                <div class="h-full border-r border-gray-300 p-2 px-4 min-w-250px">
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
                    <div id="links" class="flex flex-col space-y-1">
                        <a id="link2" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="#">
                            <i class='bx bx-comment-dots text-2xl text-lightblack group-hover:text-red-600'></i>
                            <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Classes</p>
                        </a>

                        <a id="link1" class="flex group items-center space-x-4 p-2 rounded hover:bg-red-50 focus:bg-red-50" href="/evaluation">
                            <i class='bx bx-news text-2xl text-lightblack group-hover:text-red-600'></i>
                            <p class="poppins text-lightblack font-medium text-sm group-hover:text-red-600">Evaluation</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- main -->
            <div class="w-full h-full flex flex-col container mx-auto pb-4">
                <!-- header -->
                <div class="w-full flex items-center justify-end py-2 px-8 border-b border-gray-300 ">
                    <div class="flex items-center space-x-4 py-4">
                        <i class='bx bx-bell text-2xl text-lightestgray '></i>
                        <img class="h-8 w-8 rounded-full" src="{{asset('image/profile.jpg')}}" alt="">
                    </div>
                </div>

                <!-- main content -->
                <div class="w-full h-full">
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
