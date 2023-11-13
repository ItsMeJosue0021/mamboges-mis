<x-web-layout>
    <div>
        <div class="w-full max-w-[1300px] mx-auto p-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('achievements.index') }}" id="back"
                    class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                    <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                    <p class="poppins text-sm text-black">Back</p>
                </a>
            </div>
            <div class="flex flex-col md:flex-row items-start space-y-6 md:space-y-0 md:space-x-6 pt-6">
                <div class="w-full md:w-1/2">
                    <div class="flex flex-col space-y-8">
                        <div>
                            <h1 class="poppins text-3xl font-semibold title-font text-gray-900">{{ $achievement->title }}</h1>
                            <div class="flex items-center space-x-4 py-2">
                                <span class="poppins mt-1 text-gray-500 text-sm">{{$achievement->created_at}}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xl text-gray-700 text-justify poppins">{!! $achievement->description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="flex flex-col space-y-4">
                        @foreach ($achievement->achievementImages as $images)
                            <img src="{{ asset('storage/' . $images->fileName) }}" alt="" class="w-full h-96 rounded-md" data-aos="fade-up" data-aos-delay="500">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
