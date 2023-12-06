<x-web-layout>
    <div class="flex w-full items-start justify-center ">
        <div class="w-full max-w-[1300px] mx-auto px-4 py-6">
            <div
                class="w-full flex flex-col md:flex-row md:items-center md:justify-between pb-4 mb-8 border-b border-gray-300">
                <h1 class="w-full poppins text-2xl font-medium">Video Lessons</h1>
                <form action="{{ route('video.index') }}" class="w-full">
                    <div class="w-full flex items-center space-x-2 md:space-x-4">
                        <input name="search" type="text"
                            class="w-2/4 md:w-96 rounded poppins text-sm border border-gray-400"
                            placeholder="Search here..">
                        <select name="grade" id="grade"
                            class="w-1/4 md:w-28 rounded text-sm poppins border border-gray-400">
                            <option value="" disabled selected>Grade</option>
                            <option value="Kinder">Kinder</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <button
                            class="w-1/4 px-4 py-2 rounded text-sm text-white bg-blue-600 hover:bg-blue-700 poppins">Search</button>
                    </div>
                </form>
            </div>
            @if (count($videos) == 0)
                <div class="w-full h-80 flex flex-col items-center justify-center">
                    <span class="text-sm text-red-600 poppins">No Record Found</span>
                    <a href="{{ route('video.index') }}" class="text-sm poppins text-blue-600">Back</a>
                </div>
            @endif
            <div class="flex flex-wrap gap-4">
                @foreach ($videos as $video)
                    <div
                        class="w-full md:w-72 h-78 flex flex-col justify-between items-center  space-y-2 p-3 rounded bg-white hover:bg-gray-200 transition-all ease-in-out duration-200">
                        <video class="w-full h-40 md:h-28 rounded" controls>
                            <source src="{{ $video->video ? asset($video->video) : asset('image/mamboges.jpg') }}" type="video/mp4">
                        </video>
                        <div class="w-full flex flex-col ">
                            <h1 class="poppins text-lg text-black font-semibold">{{ $video->title }}</h1>
                            <div class="flex items-center space-x-4">
                                @php
                                    $subject = App\Models\Subjects::find($video->topic);
                                @endphp
                                <span class="poppins text-sm text-green-600">{{ $subject->name }}</span>
                                <span class="poppins text-sm text-blue-500">
                                    @if ($video->grade == 'Kinder')
                                        {{ $video->grade }}
                                    @else
                                        Grade {{ $video->grade }}
                                    @endif
                                </span>
                            </div>
                            <p class="poppins text-sm text-gray-600">
                                {!! substr($video->description, 0, 45) !!}{{ strlen($video->description) > 45 ? '...' : '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pt-4 poppins">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
</x-web-layout>
