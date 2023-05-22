<x-guest-layout>
    <div class="w-full h-full flex justify-center items-center">
        <div class="flex flex-col space-y-4 items-center px-2 py-6 border border-gray-300 rounded-md">

            <div class="flex items-center justify-center">
                <div class="flex justify-center tablet:justify-start items-center space-x-2">
                    <img class="w-24 h-24" src="{{asset('image/mambog.png')}}" alt="">
                    <div class="flex flex-col">
                        <p class="castoro text-gray-700 text-xl font-bold">MAMBOG</p>
                        <p class="castoro text-gray-600 text-sm font-medium">ELEMENTARY SCHOOL</p>
                    </div> 
                </div>
            </div>

            <div class="md:w-96 flex bg-white py-4 px-4">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
    
                <form method="POST" action="{{ route('staff.login') }}" class="w-full">
                    @csrf
    
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="sample@email.com"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
    
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
    
                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" placeholder="password"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
    
                    <!-- Remember Me -->
                    {{-- <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div> --}}
    
                    <div class="w-full flex items-center mt-4">
                        <button class="w-full poppins text-xm py-2 px-4 bg-red-600 text-white rounded">LOGIN</button>
                    </div>
    
                    <div class="flex items-center mt-2 space-x-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
