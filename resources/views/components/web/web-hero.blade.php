<section class="hero-pattern" >

    <div class="max-w-[1300px] mx-auto px-4">

        <div class="h-[610px] w-full flex items-center">
            <div class="w-full md:w-1/2">
                <div class="w-full flex flex-col justify-center space-y-6 p-4 rounded-lg pr-8">
                    <p class="poppins text-red text-gray-800 font-semibold text-3xl text-center md:text-left animate-bounce"
                    data-aos="fade-right"
                    data-aos-delay="300">
                    Welcome!
                    </p>
                    <div class="flex flex-col space-y-2">
                        <p class="castoro font-bold text-5xl tablet:text-7xl text-red-600 text-center md:text-left "
                        data-aos="fade-right"
                        data-aos-delay="350">
                        MAMBOG
                        </p>
                        <p class="castoro font-bold text-3xl tablet:text-5xl text-gray-700 text-center md:text-left "
                        data-aos="fade-right"
                        data-aos-delay="400">
                        ELEMENTARY SCHOOL
                        </p>
                    </div>
                    <p class="poppins text-base font-light text-center md:text-left text-gray-600 "
                    data-aos="fade-right"
                    data-aos-delay="450">
                    Mambog Elementary School is located in Baranggay Mambog III, Bacoor, Cavite, Region IV CALABARZON.
                    </p>


                    <div class="pt-3 flex items-center justify-center md:justify-start space-x-6">
                        <a href="#" class="poppins w-[120px] text-center py-2 border-2 border-red-600 bg-red-600 text-white hover:bg-red-700 hover:scale-125"
                        data-aos="fade-right"
                        data-aos-delay="500">
                        Learn More
                        </a>

                        <a href="{{ route('student.login') }}" class="poppins w-[120px] text-center py-2 border border-red-600 text-red-600 hover:border-red-700 hover:text-red-700 hover:scale-125"
                        data-aos="fade-right"
                        data-aos-delay="500">
                        Log In
                        </a>
                    </div>

                </div>
            </div>

            <div class="w-1/2 hidden md:block ">
                <div class="relative w-full h-[500px]">
                    <div class="rounded absolute bottom-0 left-0 hover:transform hover:scale-105 transition duration-300 ease-in-out hover:z-10 cursor-pointer ">
                        <img  alt="" srcset="" src="{{asset('image/chairs.jpg')}}"
                        data-aos="fade-up"
                        data-aos-delay="300"
                        class="h-[300px] w-[200px] shadow-lg rounded bg-white ">
                    </div>

                    <div class="rounded absolute bottom-[70px] left-[145px] hover:transform hover:scale-105 transition duration-300 ease-in-out hover:z-10 cursor-pointer">
                        <img  alt="" srcset="" src="{{asset('image/child.jpg')}}"
                        data-aos="fade-down"
                        data-aos-delay="400"
                        class="h-[300px] w-[200px] shadow-lg rounded bg-white ">
                    </div>

                    <div class="rounded absolute bottom-[130px] left-[290px] hover:transform hover:scale-105 transition duration-300 ease-in-out hover:z-10 cursor-pointer">
                        <img  alt="" srcset="" src="{{asset('image/globe.jpg')}}"
                        data-aos="fade-up"
                        data-aos-delay="500"
                        class="h-[300px] w-[200px] shadow-lg rounded bg-white ">
                    </div>

                    <div class="rounded absolute top-0 right-0 hover:h-[310px] hover:transform hover:scale-105 transition duration-300 ease-in-out hover:z-10 cursor-pointer">
                        <img  alt="" srcset="" src="{{asset('image/chalk.jpg')}}"
                        data-aos="fade-down"
                        data-aos-delay="600"
                        class="h-[300px] w-[200px] shadow-lg rounded bg-white ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
