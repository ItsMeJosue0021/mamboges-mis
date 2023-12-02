<section class="bg-red-600">
    <div class="max-w-[1300px] mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            <div class="flex items-center">
                <div class="flex space-x-2">
                    <a href="#">
                        <i class='bx bxl-facebook-square text-yellow text-xl'></i>
                    </a>
                    <div class="flex items-center space-x-1 border-l-2 px-2 group">
                        <i class='bx bxs-news text-yellow text-xl' ></i>
                        <a href="{{ route('update.index') }}" class="text-white poppins text-sm group-hover:text-yellow">News and Announcements</a>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div>
                    @auth
                        @if (Auth::user()->type == 'guidance')
                            <div class="flex py-1 px-3 items-center space-x-2 border-2 border-yellow cursor-pointer hover:border-white group">
                                <a href="{{ route('update.list') }}" class="text-yellow poppins text-sm group-hover:text-white">Admin</a>
                            </div>
                        @elseif (Auth::user()->type == 'lr')
                            <div class="flex py-1 px-3 items-center space-x-2 border-2 border-yellow cursor-pointer hover:border-white group">
                                <a href="{{ route('lr.video') }}" class="text-yellow poppins text-sm group-hover:text-white">Resources</a>
                            </div>
                        @elseif (Auth::user()->type == 'faculty')
                            <div class="flex py-1 px-3 items-center space-x-2 border-2 border-yellow cursor-pointer hover:border-white group">
                                <a href="{{ route('faculty.classes') }}" class="text-yellow poppins text-sm group-hover:text-white">Classes</a>
                            </div>
                        @elseif (Auth::user()->type == 'student')
                        <div class="flex py-1 px-3 items-center space-x-2 border-2 border-yellow cursor-pointer hover:border-white group">
                            <a href="{{ route('student.portal') }}" class="text-yellow poppins text-sm group-hover:text-white">Classes</a>
                        </div>
                        @endif
                    @else
                        <div class="flex py-1 px-3 items-center space-x-2 border-2 border-yellow cursor-pointer hover:border-white group">
                            <a href="{{ route('student.login') }}" class="text-yellow poppins text-sm group-hover:text-white">Login</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>
