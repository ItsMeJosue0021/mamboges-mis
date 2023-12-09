<x-lr-layout>
    <div class="flex w-full items-start justify-center ">
        <div class="w-full md:w-2/3">
            <div class="hidden md:flex items-center space-x-6 poppins w-full border-b border-gray-200">
                <a href="{{ route('lr.video') }}" class="px-6 py-1 border-b-2 border-gray-400">Videos</a>
                <a href="{{ route('lr.module') }}" class="px-6 py-1">Modules</a>
            </div>
            <div class="w-full flex items-center justify-between space-x-6 py-4">
                <h1 class="poppins text-xl font-medium">Video Lessons</h1>
                <a href="{{ route('video.create') }}"
                    class="poppins text-sm px-4 py-2 rounded-sm text-white bg-blue-700 hover:bg-blue-800">Upload
                    Video Lesson</a>
            </div>
            <div class="flex flex-col space-y-3">
                @foreach ($videos as $video)
                    <div
                        class="relative w-full p-4 rounded bg-white hover:bg-gray-200 transition-all ease-in-out duration-200 shadow-md flex items-center justify-between border border-gray-200">
                        <div class="w-full flex flex-col md:flex-row items-center space-x-4">
                            <video controls src="{{ $video->video ? asset($video->video) : asset('image/mamboges.jpg') }}"
                                alt="video" class="w-full md:w-64 h-28 rounded">
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
                                            Grade {{$video->grade}}
                                        @endif
                                    </span>
                                </div>
                                <p class="poppins text-sm text-gray-600">
                                    {!! substr($video->description, 0, 45) !!}{{ strlen($video->description) > 45 ? '...' : '' }}</p>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 md:flex flex-col items-center space-y-2 z-10">
                            <a href="{{ route('video.edit', $video->id) }}">
                                <i class='bx bx-edit text-xl text-blue-600'></i>
                            </a>
                            <form action="{{ route('video.delete', $video->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <i class='bx bx-trash text-xl text-red-600'></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-lr-layout>
