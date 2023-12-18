<x-web-layout>
    <div class="bg-white text-gray-700 poppins">
        <div class="w-full max-w-[1300px] mx-auto p-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('update.index') }}" id="back"
                    class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                    <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                    <p class="poppins text-sm text-black">Back</p>
                </a>
            </div>
            <div class="flex flex-col items-start space-y-6 pt-6">
                <div class="w-full ">
                    <div class="flex flex-col space-y-8">
                        <div>
                            <h1 class="poppins text-3xl font-semibold title-font text-gray-900">{{ $update->title }}
                            </h1>
                            <div class="flex items-center space-x-4 py-2">
                                <span class="poppins mt-1 text-gray-500 text-sm">{{ $update->created_at }}</span>
                                <a
                                    class="poppins text-xs text-red-600 py-1 px-2 border border-red-600 rounded">{{ $update->tag->tag ?? '' }}</a>
                            </div>
                        </div>
                        <div>
                            <p class="text-xl text-gray-700 text-justify poppins">{!! $update->description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="w-full ">
                    <div class="flex flex-wrap gap-4 items-start">
                        @foreach ($update->updateImages as $images)
                            <img src="{{ asset('storage/' . $images->url) }}" alt="" class="w-[600px] h-fit rounded-md"
                                data-aos="fade-up" data-aos-delay="500">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
