<x-app-layout>
    <div class="py-12">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-[1400px] w-full mx-auto px-4 space-y-4">
                <div class="flex flex-col space-y-2 pt-4">
                    <a href="{{ route('student.portal') }}" id="back"
                        class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                        <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                        <p class="poppins text-sm text-black">Back</p>
                    </a>
                </div>

                <div class="bg-white shadow-sm sm:rounded-md flex items-center justify-center">
                    <div class="">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
