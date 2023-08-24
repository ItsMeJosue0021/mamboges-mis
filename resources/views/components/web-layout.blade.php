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
    <link rel="icon" href="image/mambog.png"/>
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
                        'mambog': "url('image/mamboges.jpg')",
                    }
                }
            }
        }
    </script>

</head>
<body>
    <!-- top section -->
    <section class="bg-red-600">
        <div class="container tablet:mx-auto tablet:px-24">
            <div class="flex justify-between items-center py-3">
                <!-- contact us | news and updates -->
                <div class="hidden tablet:flex tablet:justify-between items-center">
                    <div class="pr-2 border-r-2">
                        {{-- <div class="flex items-center space-x-1">
                            <i class='bx bxs-phone text-yellow'></i>
                            <a href="#" class="text-white poppins text-sm">Contact Us</a>
                        </div> --}}
                    </div>
                    <div class="px-2">
                        <div class="flex items-center space-x-1">
                            <i class='bx bxs-news text-yellow text-xl' ></i>
                            <a href="/updates" class="text-white poppins text-sm">News and Updates</a>
                        </div>
                    </div>
                </div>

                <!-- student portal and social media icons -->
                <div class="flex justify-between items-center">
                    <div class="flex px-2 items-center space-x- 2 border-r-2">
                        @if (Route::has('student.login'))
                            </i><i class='bx bx-log-in text-xl mb-1px text-yellow'></i>
                            <a href="{{ route('student.login') }}" class="text-white poppins text-sm">Login</a>
                        @endif
                    </div>

                    <div class="pl-2">
                        <div class="flex items-center space-x-2">
                            <a href="#">
                                <i class='bx bxl-facebook-circle text-yellow text-xl'></i>
                            </a>
                            <a href="#">
                                <i class='bx bxl-youtube text-yellow text-lg text-xl'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <header>
        <div class="container tablet:mx-auto py-2 tablet:px-24">
            <div class="flex items-center justify-between">
                <!-- logo -->
                <div class="flex items-center py-2">
                    <a href="/" class="flex items-center space-x-2">
                        <img class="w-70px h-70px" src="{{asset('image/mambog.png')}}" alt="">
                        <div class="flex flex-col">
                            <p class="castoro text-base font-bold">MAMBOG</p>
                            <p class="castoro text-sm font-medium">ELEMENTARY SCHOOL</p>
                        </div>
                    </a>
                </div>

                <!-- navigation -->
                <nav class="">
                    <div class="hidden tablet+:flex justify-between space-x-6">
                        <div class="flex items-center space-x-1">
                            <a href="/" class="poppins font-medium text-base">Home</a>
                        </div>
                        <div class="flex items-center space-x-1">
                            <a href="#" class="poppins font-medium text-base">About Us</a>
                        </div>
                        <div class="flex flex-col relative group">
                            <div class="flex items-center space-x-1">
                                <a href="#" class="poppins font-medium text-base">Activities</a>
                                <i class='bx bx-chevron-down text-lg'></i>
                            </div>
                            <div class="hidden group-hover:block hover:block absolute mt-7 bg-white rounded p-2 w-250px shadow-md">
                                <div class="p-2 hover:bg-lightgray rounded">
                                    <a class="poppins" href="#">Enrollment</a>
                                </div>
                                <div class="p-2 hover:bg-lightgray rounded">
                                    <a class="poppins" href="#">Calendar of Activities</a>
                                </div>
                                <div class="p-2 hover:bg-lightgray rounded">
                                    <a class="poppins" href="#">News and Announcements</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col relative group">
                            <div class="flex items-center space-x-1">
                                <a href="#" class="poppins font-medium text-base">Management</a>
                                <i class='bx bx-chevron-down text-lg'></i>
                            </div>
                            <div class="hidden group-hover:block hover:block absolute mt-7 bg-white rounded p-2 w-250px shadow-md">
                                <div class="p-2 hover:bg-lightgray rounded">
                                    <a class="poppins" href="#">Organizational Structure</a>
                                </div>
                                <div class="p-2 hover:bg-lightgray rounded">
                                    <a class="poppins" href="#">Transparency Board</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col relative group">
                            <div class="flex items-center space-x-1">
                                <a href="#" class="poppins font-medium text-base">Downloadables</a>
                                <i class='bx bx-chevron-down text-lg'></i>
                            </div>
                            <div class="hidden group-hover:block hover:block absolute mt-7 bg-white rounded p-2 w-200px shadow-md">
                                <div class="p-2 hover:bg-lightgray rounded">
                                    <a class="poppins" href="#">Enrollment Forms</a>
                                </div>
                                <div class="p-2 hover:bg-lightgray rounded">
                                    <a class="poppins" href="#">Other forms</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header> --}}

    <main>
        {{$slot}}
    </main>
    
    <footer class="bg-lightgray">
        <div class="container mx-auto tablet:px-24">
            <div class="flex flex-col tablet:flex-row justify-between items-start py-12 border-b-2 space-y-4 tablet:space-y-0">

                <div class="w-full tablet:w-auto flex flex-col">
                    <div class="flex justify-center tablet:justify-start items-center space-x-2">
                        <img class="w-80px h-80px" src="{{asset('image/mambog.png')}}" alt="">
                        <div class="flex flex-col">
                            <p class="castoro text-lg font-bold">MAMBOG</p>
                            <p class="castoro text-5px font-medium">ELEMENTARY SCHOOL</p>
                        </div> 
                    </div>
                    <div class="flex justify-center tablet:justify-start py-4">
                        <img class="h-70px w-180px" src="{{asset('image/deped.png')}}" alt="">
                    </div>
                </div>

                <div class="w-full tablet:w-auto flex flex-col space-y-6">
                    <h1 class="poppins text-lg font-semibold text-black text-center tablet:text-left">Government Links</h1>
                    <div class="flex flex-col space-y-2">
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" 
                        href="https://www.officialgazette.gov.ph/" target="_blank" rel="noopener noreferrer">Government PH</a>
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" 
                        href="https://www.deped.gov.ph/" target="_blank" rel="noopener noreferrer">DepEd</a>
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" 
                        href="https://cavite.gov.ph/home/" target="_blank" rel="noopener noreferrer">Cavite PH</a>
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" 
                        href="https://bacoor.gov.ph/" target="_blank" rel="noopener noreferrer">Bacoor PH</a>
                    </div>
                </div>
                    
                <div class="w-full tablet:w-auto flex flex-col space-y-4">
                    <h1 class="poppins text-lg font-semibold text-black text-center tablet:text-left">Quick Links</h1>
                    <div class="flex flex-col space-y-2">
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="#">Enrollment Procedures</a>
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="#">News and Announcements</a>
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="#">Organizational Structure</a>
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="#">Transparency Board</a>
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="#">Calendar of Acvtivities</a>
                        <a class="poppins text-base font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="#">Downloadable Forms</a>
                    </div>
                </div>
                    
                <div class="w-full tablet:w-auto flex flex-col space-y-4">
                    <h1 class="poppins text-lg font-semibold text-black text-center tablet:text-left">Contact Information</h1>
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-col">
                            <a class="poppins text-base font-light text-lightestgray hover:text-red-500 text-center tablet:text-left" href="#">Mambog III, Bacoor City, Cavite</a>
                            <a class="poppins text-base font-light text-lightestgray hover:text-red-500 text-center tablet:text-left" href="#">Region IV - CALABARZON</a>
                        </div>
                        <div class="flex flex-col">
                            <a class="poppins text-base font-light text-lightestgray hover:text-red-500 text-center tablet:text-left" href="#">Contact: 471-10-00</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between py-8">
                <div class="hidden tablet:flex">
                    <div class="flex items-center space-x-3">
                        <a href="#">
                            <i class='bx bxl-facebook-circle text-3xl text-blue'></i>
                        </a>
                        <a href="#">
                            <i class='bx bxl-youtube text-youtube text-3xl'></i>
                        </a>
                    </div>
                </div>
                <div class="w-full tablet:w-auto flex items-center justify-center">
                    <div class="flex items-center space-x-2">
                        <i class='bx bx-copyright text-light text-lg text-gray-400'></i>
                        <p class="poppins text-base font-light text-gray-400">2023 Mambog Elementary School</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 150,
            duration: 1400
        });
    </script>
</body>
</html>





