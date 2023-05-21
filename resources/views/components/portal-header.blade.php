<div class="w-full fixed bg-base-100 z-50 border-b border-gray-200 bg-white">
    <div class="navbar flex justify-between items-center container mx-auto md:px-22 lg:px-28 ">
        <div class="flex items-center">
            <div class="flex items-center space-x-2">
                <a href="/" class="flex items-center space-x-2">
                    <img class="w-60px h-60px" src="{{asset('image/mambog.png')}}" alt="">
                    <div class="flex flex-col">
                        <p class="castoro text-sm font-bold">MAMBOG</p>
                        <p class="castoro text-xs font-medium">ELEMENTARY SCHOOL</p>
                    </div>
                </a>
            </div>
            {{-- <div class="hidden md:flex items-center space-x-2 px-5">
                <div class="py-2 px-4 hover:bg-gray-200 rounded">
                    <a class="font-sans text-base" href="/">Home</a>
                </div>
            </div> --}}
        </div>

        <div class="flex space-x-2">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="{{asset('image/mamboges.jpg')}}" />
                    </div>
                </label>
                <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>Account Settings</a></li>
                    <li><a>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
