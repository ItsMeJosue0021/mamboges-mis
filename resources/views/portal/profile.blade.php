<x-app-layout>
    <div class="flex items-start justify-center min-h-screen h-auto max-w-[1400px] mx-auto w-full p-4 pt-28 bg-white">
        <div class="w-full flex flex-col items-center justify-center bg-white text-gray-700">
            <div class="w-full flex flex-col space-y-2 mb-4">
                <a href="{{ route('student.portal') }}" id="back"
                    class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                    <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                    <p class="poppins text-sm text-black">Back</p>
                </a>
            </div>
            <div class="flex flex-col space-y-2">
                <div>
                    @if ($student->user->profile->image)
                        <img src="{{ asset('storage/' . $student->user->profile->image)}}" alt="image" class="w-48 h-48 rounded-full">
                    @else
                        @if ($student->user->profile->sex == "Male")
                            <img src="{{ asset('image/male.png') }}" alt="male" class="w-48 h-48 rounded-full">
                        @else
                            <img src="{{ asset('image/female.png') }}" alt="female" class="w-48 h-48 rounded-full">
                        @endif
                    @endif
                </div>
                <div class="flex items-center justify-center">
                    <span class="text-xl font-semibold ">
                        {{ $student->user->profile->firstName }}
                        {{ $student->user->profile->middleName }}
                        {{ $student->user->profile->lastName }}
                        {{ $student->user->profile->suffix }}
                    </span>
                </div>
            </div>
            <div class="w-full md:w-80 flex flex-col ">
                <div class="flex items-center justify-between border-b border-gray-200 py-2">
                    <span class="font-medium">LRN</span>
                    <span class="text-sm font-medium">
                        {{ $student->lrn }}
                    </span>
                </div>
                <div class="flex items-center justify-between border-b border-gray-200 py-2">
                    <span class="font-medium">Sex</span>
                    <span>{{ $student->user->profile->sex }}</span>
                </div>
                <div class="flex items-center justify-between border-b border-gray-200 py-2">
                    <span class="font-medium">Birthday</span>
                    <span>{{ $student->user->profile->dob }}</span>
                </div>
            </div>
            <div class="w-full md:w-80 flex items-center justify-start mt-4">
                <a href="{{ route('change.password') }}" class="w-fit rounded px-4 py-2 bg-blue-700 text-sm text-white">Change Password</a>
            </div>
        </div>
    </div>
</x-app-layout>
