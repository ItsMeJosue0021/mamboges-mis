<x-lr-layout>
    <div class="flex w-full items-start justify-center ">
        <div class="w-full md:w-2/3">
            <div class="flex items-center space-x-4 pb-5">
                <a href="{{ route('module.create') }}"
                    class="poppins text-sm px-4 py-2 rounded-sm text-white bg-blue-700 hover:bg-blue-800">Upload
                    Module</a>
            </div>
            <h1 class="poppins text-2xl font-medium pb-3">Current Modules</h1>
            <div class="flex flex-col space-y-3">
                @foreach ($modules as $module)
                    <div
                        class="relative w-full p-4 rounded bg-white hover:bg-gray-200 transition-all ease-in-out duration-200 shadow-md flex items-center justify-between border border-gray-200">
                        <div class="w-full flex flex-col md:flex-row items-center space-x-4">
                            <img src="{{ $module->thumbnail ? asset('storage/' . $module->thumbnail) : asset('image/mamboges.jpg') }}"
                                alt="thumbnail" class="w-full md:w-32 h-28 rounded">
                            <div class="w-full flex flex-col ">
                                <h1 class="poppins text-lg text-black font-semibold">{{ $module->title }}</h1>
                                <div class="flex items-center space-x-4">
                                    @php
                                        $subject = App\Models\Subjects::find($module->topic);
                                    @endphp
                                    <span class="poppins text-sm text-green-600">{{ $subject->name }}</span>
                                    <span class="poppins text-sm text-blue-500">{{ $module->grade }}</span>
                                </div>
                                <p class="poppins text-sm text-gray-600">
                                    {!! substr($module->description, 0, 45) !!}{{ strlen($module->description) > 45 ? '...' : '' }}</p>
                                <a href="{{ route('module.view', $module->id) }}" target="_blank"
                                    class="text-sm poppins text-blue-600 hover:underline">{!! substr($module->file, 0, 20) !!}{{ strlen($module->file) > 20 ? '...' : '' }}</p></a>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 md:flex flex-col items-center space-y-2 z-10">
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
