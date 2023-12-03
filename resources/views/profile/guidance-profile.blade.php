<x-guidance-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 p-4">
        <div class="max-w-7xl mx-auto lg:px-8 space-y-6">
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
        </div>
    </div>
</x-guidance-layout>
