<div class="w-full fixed z-50 border-b border-gray-200 bg-white">
    <div class="navbar flex justify-between items-center w-full max-w-[1400px] mx-auto px-4 ">
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
        </div>

        <div class="flex space-x-2">
            <div class="dropdown dropdown-end">
                <label tabindex="0">
                    <div class="flex space-x-2 items-center cursor-pointer p-1 px-2 rounded-md hover:bg-gray-200 group">
                         <p class="poppins text-gray-500 group-hover:text-gray-700 hidden md:block">{{ Auth::user()->profile->firstName }} {{ Auth::user()->profile->lastName }}</p>
                        <div class="w-10 rounded-full">
                            <img src="{{Auth::user()->profile->image ? asset('storage/' . Auth::user()->profile->image) : asset('image/mamboges.jpg')}}" class="rounded-full" />
                        </div>
                    </div>
                </label>
                <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded w-52">
                    <x-dropdown-link :href="route('change.password')">
                        {{ __('Change Password') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div>
