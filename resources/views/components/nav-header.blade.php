<section class="shadow-md border-b border-gray-200 bg-white bg-opacity-90">
    <div class="max-w-[1300px] mx-auto px-4">
        <div class="w-full flex items-center justify-between">
            <div class="flex items-center py-2">
                <a href="/" class="flex items-center space-x-2">
                    <img class="w-[60px] h-[60px]" src="{{asset('image/mambog.png')}}" alt="">
                    <div class="flex flex-col">
                        <p class="castoro text-base font-bold">MAMBOG</p>
                        <p class="castoro text-xs font-medium">ELEMENTARY SCHOOL</p>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex items-center">
                <ul class="flex items-center space-x-2">
                    <li class="p-2 px-4 hover:border-b hover:bg-gray-200 rounded  cursor-pointer">
                        <a href="" class="poppins font-medium text-base">Home</a>
                    </li>
                    <li class="p-2 px-4 hover:border-b hover:bg-gray-200 rounded cursor-pointer">
                        <a href="" class="poppins font-medium text-base">History</a>
                    </li>
                    <div class="flex dropdown dropdown-end">
                        <label tabindex="0" class="p-2 px-4 flex items-center justify-between hover:bg-gray-200 rounded cursor-pointer">
                            <p class="poppins">Downloadables</p>
                            <i class='bx bx-chevron-down text-lg'></i>
                        </label>
                        <ul tabindex="0" class="dropdown-content z-[1] p-2 shadow bg-base-100 rounded-md w-52">
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a class="poppins ">Forms</a>
                            </li>
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a class="poppins ">Others</a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>

            <div class="flex md:hidden dropdown dropdown-end">
                <label tabindex="0" class="px-1 border-2 border-gray-400 rounded-md cursor-pointer">
                    <i class='bx bx-menu text-2xl text-gray-400'></i>
                </label>
                <ul tabindex="0" class="dropdown-content z-[1] p-2 shadow bg-base-100 rounded-md w-52">
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a class="poppins ">Home</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a class="poppins ">History</a>
                    </li>
                    <div tabindex="0" class="collapse m-0 p-0"> 
                        <div class="p-2 flex items-center justify-between hover:bg-gray-200 rounded cursor-pointer">
                            <p class="poppins">Downloadables</p>
                            <i class='bx bx-chevron-down text-lg'></i>
                        </div>
                        <div class="collapse-content p-0">
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a class="poppins ">Forms</a>
                            </li> 
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a class="poppins ">Others</a>
                            </li> 
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</section>