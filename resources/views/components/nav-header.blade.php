<section class="shadow-md border-b border-gray-200 bg-white bg-opacity-90">
    <div class="max-w-[1300px] mx-auto px-4">
        <div class="w-full flex items-center justify-between">
            <div class="flex items-center py-2">
                <a href="/" class="flex items-center space-x-2">
                    <img class="w-[60px] h-[60px]" src="{{ asset('image/mambog.png') }}" alt="">
                    <div class="flex flex-col">
                        <p class="castoro text-base font-bold">MAMBOG</p>
                        <p class="castoro text-xs font-medium">ELEMENTARY SCHOOL</p>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex items-center">
                <ul class="flex items-center space-x-2">
                    <li class="p-2 px-4 hover:border-b hover:bg-gray-200 rounded  cursor-pointer">
                        <a href="/" class="poppins font-medium text-base">Home</a>
                    </li>
                    <li class="p-2 px-4 hover:border-b hover:bg-gray-200 rounded cursor-pointer">
                        <a href="{{ route('update.index') }}" class="poppins font-medium text-base">News &
                            Announcements</a>
                    </li>
                    <div class="flex dropdown dropdown-end">
                        <label tabindex="0"
                            class="p-2 px-4 flex items-center space-x-3 hover:bg-gray-200 rounded cursor-pointer">
                            <p class="poppins">More</p>
                            <i class='bx bx-chevron-down text-lg'></i>
                        </label>
                        <ul tabindex="0" class="dropdown-content z-[1] p-2 shadow-md bg-base-100 rounded-md w-56">
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a class="poppins text-sm">Organizational Structure</a>
                            </li>
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a class="poppins text-sm">Calendar of Activities</a>
                            </li>
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a href="{{ route('achievements.index') }}" class="poppins text-sm">Awards and Achievements</a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>

            <div class="flex md:hidden dropdown dropdown-end">
                <label tabindex="0" class="px-1 border-2 border-gray-400 rounded-md cursor-pointer">
                    <i class='bx bx-menu text-2xl text-gray-400'></i>
                </label>
                <ul tabindex="0" class="dropdown-content z-[1] p-2 shadow bg-base-100 rounded-md w-80">
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="/" class="poppins ">Home</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="{{ route('update.index') }}" class="poppins ">News and Announcements</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="{{ route('achievements.index') }}" class="poppins ">Awards and Achievements</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="" class="poppins ">Organizational Structure</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="" class="poppins ">Calendar of Activities</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="" class="poppins ">Downloadables</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
