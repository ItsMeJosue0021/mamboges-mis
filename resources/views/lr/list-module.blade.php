<x-lr-layout>
    <div class="flex w-full items-start justify-center ">
        <div class="w-full md:w-2/3">
            <div class="hidden md:flex items-center space-x-6 poppins w-full border-b border-gray-200">
                <a href="{{ route('lr.video') }}" class="px-6 py-1">Videos</a>
                <a href="{{ route('lr.module') }}" class="px-6 py-1 border-b-2 border-gray-400">Modules</a>
            </div>
            <div class="w-full flex items-center justify-between py-4">
                <h1 class="poppins text-xl font-medium">Modules</h1>
                <a href="{{ route('module.create') }}"
                    class="poppins text-sm px-4 py-2 rounded-sm text-white bg-blue-700 hover:bg-blue-800">Upload
                    Module</a>
            </div>
            <div class="flex flex-col space-y-3">
                @foreach ($modules as $module)
                    <div
                        class="relative w-full p-2 rounded bg-white hover:bg-gray-200 transition-all ease-in-out duration-200 shadow-md flex items-center justify-between border border-gray-200">
                        <div class="w-full flex flex-col md:flex-row items-center md:space-x-4">
                            <img src="{{ $module->thumbnail ? asset('storage/' . $module->thumbnail) : asset('image/mamboges.jpg') }}"
                                alt="thumbnail" class="w-full md:w-64 h-40 rounded">
                            <div class="w-full flex flex-col space-y-1">
                                <h1 class="poppins text-lg text-black font-semibold">{{ $module->title }}</h1>
                                <div class="flex items-center space-x-4">
                                    @php
                                        $subject = App\Models\Subjects::find($module->topic);
                                    @endphp
                                    <span class="poppins text-sm text-green-600">{{ $subject->name }}</span>
                                    <span class="poppins text-sm text-blue-500">
                                        @if ($module->grade == 'Kinder')
                                            {{ $module->grade }}
                                        @else
                                            Grade {{$module->grade}}
                                        @endif
                                    </span>
                                </div>
                                <p class="poppins text-sm text-gray-600">
                                    {!! substr($module->description, 0, 45) !!}{{ strlen($module->description) > 45 ? '...' : '' }}</p>
                                <a href="{{ route('module.view', $module->id) }}" target="_blank"
                                    class="w-fit text-sm poppins text-blue-600 hover:underline text-center py-1 px-3 border border-blue-600">Open</a>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 md:flex flex-col items-center space-y-2 z-10 bg-white bg-opacity-50 p-2 rounded-md">
                            <a href="{{ route('module.edit', $module->id) }}">
                                <i class='bx bx-edit text-xl text-blue-600'></i>
                            </a>
                            <form action="{{ route('module.delete', $module->id) }}" method="POST">
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
