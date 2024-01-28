<x-profile-layout>
    {{-- <div class="flex flex-col space-y-2 pb-3">
        <a href="{{ route('student.index') }}" id="back"
            class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
            <i class='bx bx-left-arrow-alt text-black text-lg '></i>
            <p class="poppins text-sm text-black">Back</p>
        </a>
    </div> --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto lg:px-8 space-y-6">
            {{-- <div class="flex flex-col space-y-2 pt-4">
                @if (Auth::user()->role == 'guidance')
                    <a href="{{ route('update.list') }}" id="back"
                        class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                        <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                        <p class="poppins text-sm text-black">Back</p>
                    </a>
                @else
                    <a href="{{ route('student.portal') }}" id="back"
                        class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                        <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                        <p class="poppins text-sm text-black">Back</p>
                    </a>
                @endif
            </div> --}}
            <div class="sm:p-8 bg-white rounded-lg md:border border-gray-300">
                <div class="w-full">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="sm:p-8 bg-white rounded-lg md:border border-gray-300">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        </div>
    </div>
</x-profile-layout>
