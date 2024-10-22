<section class=" border-b border-gray-200 bg-white sticky top-0 z-20">
    <div class="max-w-[1300px] mx-auto px-4">
        <div class="w-full flex items-center justify-between">
            <div class="flex items-center py-2">
                <a href="/" class="flex items-center space-x-2">
                    <img class="w-[60px] h-[60px]" src="{{ asset('image/mambog.png') }}" alt="">
                    <div class="flex flex-col">
                        <p class="castoro text-base font-bold text-gray-700">MAMBOG</p>
                        <p class="castoro text-xs font-medium text-gray-700">ELEMENTARY SCHOOL</p>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex items-center">
                <ul class="flex items-center space-x-2">
                    <li class="p-2 px-4 hover:border-b hover:bg-gray-200 rounded  cursor-pointer">
                        <a href="/" class="poppins font-medium text-base text-gray-700">Home</a>
                    </li>
                    <li class="p-2 px-4 hover:border-b hover:bg-gray-200 rounded  cursor-pointer">
                        <a href="{{ route('module.index') }}" class="poppins font-medium text-base text-gray-700">Modules</a>
                    </li>
                    <li class="p-2 px-4 hover:border-b hover:bg-gray-200 rounded  cursor-pointer">
                        <a href="{{ route('video.index') }}" class="poppins font-medium text-base text-gray-700">Videos</a>
                    </li>
                    <li class="p-2 px-4 hover:border-b hover:bg-gray-200 rounded cursor-pointer">
                        <a href="{{ route('update.index') }}" class="poppins font-medium text-base text-gray-700">News &
                            Announcements</a>
                    </li>
                    <div class="flex dropdown dropdown-end bg-white">
                        <label tabindex="0"
                            class="p-2 px-4 flex items-center space-x-3 hover:bg-gray-200 rounded cursor-pointer">
                            <p class="poppins text-gray-700">More</p>
                            <i class='bx bx-chevron-down text-lg'></i>
                        </label>
                        <ul tabindex="0" class="dropdown-content z-[1] p-2 shadow-md bg-white rounded-md w-56">
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a href="{{ route('org.chart') }}" class="poppins text-sm text-gray-700">Organizational Structure</a>
                            </li>
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a href="{{ route('calendar.show') }}" class="poppins text-sm text-gray-700">Calendar of
                                    Activities</a>
                            </li>
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a href="{{ route('achievements.index') }}" class="poppins text-sm text-gray-700">Awards and
                                    Achievements</a>
                            </li>
                            <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                                <a href="{{ route('downloadables.index') }}" class="poppins text-sm text-gray-700">Downloadables</a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>

            <div class="flex md:hidden dropdown dropdown-end bg-white text-gray-700">
                <label tabindex="0" class="px-1 cursor-pointer">
                    <i class='bx bx-menu text-4xl text-gray-700'></i>
                </label>
                <ul tabindex="0" class="dropdown-content z-[1] p-2 shadow rounded-md w-80 bg-white">
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="/" class="poppins ">Home</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="{{ route('module.index') }}" class="poppins ">Modules</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="{{ route('video.index') }}" class="poppins ">Videos Lessons</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="{{ route('update.index') }}" class="poppins ">News and Announcements</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="{{ route('achievements.index') }}" class="poppins ">Awards and Achievements</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="{{ route('org.chart') }}" class="poppins ">Organizational Structure</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="{{ route('calendar.show') }}" class="poppins ">Calendar of Activities</a>
                    </li>
                    <li class="p-2 rounded  hover:bg-gray-200 cursor-pointer">
                        <a href="{{ route('downloadables.index') }}" class="poppins ">Downloadables</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
