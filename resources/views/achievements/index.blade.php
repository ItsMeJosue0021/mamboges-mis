<x-web-layout>
    <section class="bg-white text-gray-700">
        <div class="w-full max-w-[1300px] mx-auto px-4">
            <div class="py-4">
                <div class="flex items-center justify-start py-4">
                    <div class="w-full flex">
                        <form action="{{ route('achievements.index') }}" class="flex w-full justify-between space-x-4">
                            <input name="search" type="text" placeholder="Search for achievements"
                                class="w-full poppins text-base focus:outline-none border border-gray-300 focus:border-gray-500 py-2 px-4 rounded">
                            <button type="submit"
                                class="poppins text-sm text-white bg-blue-600 hover:bg-blue-700 hover:text-white rounded py-2 px-6">Search</button>
                        </form>
                    </div>
                </div>

                <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
                    @if (count($achievements) == 0)
                        <div class="w-full h-96 flex flex-col items-center justify-center">
                            <img class="h-60 w-60" src="{{ asset('image/search.png') }}" alt="">
                            <p class="poppins text-2xl font-medium text-red-500 mt-5">Oops! No result found.</p>
                            <a class="poppins text-xm text-blue-500 hover:underline" href="{{ route('achievements.index') }}">Refresh</a>
                        </div>
                    @endif

                    @foreach ($achievements as $achievement)
                        <div class="w-full p-4 md:w-1/3 sm:mb-0 mb-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="rounded-lg h-64 overflow-hidden">
                                <img alt="content" class="object-cover object-center h-full w-full"
                                    src="{{ $achievement->coverPhoto ? asset('storage/' . $achievement->coverPhoto) : asset('image/mamboges.jpg') }}">
                            </div>
                            <div class="flex items-center space-x-4 mt-5">
                                <h2 class="poppins text-xl font-semibold title-font text-gray-900">
                                    {{ substr($achievement->title, 0, 30) }}{{ strlen($achievement->title) > 30 ? '...' : '' }}
                                </h2>
                            </div>
                            <div class="flex items-center">
                                <span class="poppins mt-1 text-gray-500 text-sm">{{ $achievement->created_at }}</span>
                            </div>
                            <div  class="flex items-center py-2">
                                {!! substr($achievement->description, 0, 45) !!}{{ strlen($achievement->description) > 45 ? '...' : '' }}
                            </div>
                            <a class=" poppins text-sm px-2 py-1 text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white"
                                href="{{ route('achievements.show', $achievement->id) }}">Read More</a>
                        </div>
                    @endforeach

                    <div class="w-full p-4 mt-5">
                        {{ $achievements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
