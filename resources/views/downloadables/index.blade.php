<x-web-layout>
    <div class="w-full max-w-[1300px] mx-auto h-auto min-h-[600px] p-4">
        <div class="w-full flex items-start justify-center">
            <div class="w-full md:w-1/2 flex flex-col space-y-4 pt-4">
                <h1 class="poppins text-lg font-bold">CURRENT DOWNLOADABLE FILES</h1>
                <div class="flex flex-col space-y-4">
                    @foreach ($groups as $group)
                        <div class="w-full border border-gray-100 bg-base-100 rounded-md shadow ">
                            <div class="p-4 flex justify-between items-start bg-gray-200 rounded-t-md">
                                <p class="poppins font-medium">{{$group->name}}</p>
                            </div>
                            @foreach ($group->downloadableFiles as $file)
                                <div class="flex justify-between items-center p-2 px-4 border-t border-gray-200">
                                    <a href="{{ route('downloadables.view', $file->id) }}" target="_blank"
                                        class="poppins text-sm hover:text-blue-600 hover:underline">
                                        {{ $file->title }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
