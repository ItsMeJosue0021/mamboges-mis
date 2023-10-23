<x-guidance-layout>
    <section>
        <div class="p-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('update.list') }}" id="back" class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                    <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                    <p class="poppins text-sm text-black">Back</p>
                </a>
            </div>

            <div class="flex items-start justify-center ">
                <div class="w-1/2 flex flex-col space-y-4">
                    <form action="{{ route('tags.store') }}" method="POST"
                    class="w-full flex flex-col space-y-3 rounded shadow border border-gray-200 p-4">
                    @csrf
                        <div class="flex flex-col space-y-1">
                            <label class="flex items-start">Tag Name<span class="text-sm font-light text-red-600">*</span>
                                @error('tag')
                                    <span class="text-xs font-light text-red-600 self-end">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" name="tag" placeholder="Tag name.."
                            class="text-sm px-4 rounded border border-gray-300">
                        </div>
                        <div class="w-full ">
                            <button class="w-full poppins px-4 py-2 text-sm rounded text-white bg-blue-600">Add</button>
                        </div>
                    </form>
                    <div class="flex flex-col space-y-2">
                        @foreach ($tags as $tag)
                            <form action="{{ route('tags.delete', $tag->id) }}" method="POST" 
                                class="w-full flex items-center justify-between py-2 px-2 border border-gray-200 rounded">
                                @csrf
                                @method('DELETE')
                                <p class="poppins text-sm font-medium">{{ $tag->tag }}</p>
                                <button class="text-xs text-red-500">Delete</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>

</x-guidance-layout>

