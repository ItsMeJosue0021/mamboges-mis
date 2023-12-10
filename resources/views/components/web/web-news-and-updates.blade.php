<section class="bg-gray-50">
    <div class="max-w-[1300px] mx-auto px-4 py-16 md:py-24">
        <div class="w-full flex items-center justify-center pb-12">
            <h1 class="castoro text-3xl text-lightblack font-semibold text-center">NEWS AND ANNOUNCEMENTS</h1>
        </div>
        <div class="flex items-start md:space-x-4 justify-between">

            @if ($firstupdate != null)
                <div class="w-[700px] hidden md:flex flex-col space-y-2" data-aos="fade-right" data-aos-delay="500">
                    <img alt=""
                        src="{{ $firstupdate->cover_photo ? asset('storage/' . $firstupdate->cover_photo) : asset('image/mamboges.jpg') }}"
                        class="w-full h-[450px] rounded shadow-md">

                    <div class="w-full absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent opacity-70">
                        <div class="flex flex-col space-y-1 backdrop-blur-sm p-6 text-gray-200 poppins">
                            <a href="#" class="poppins text-red-600 text-sm ">
                                {{ $firstupdate->tag->tag ?? '' }}
                            </a>
                            <h1 class="poppins font-semibold text-lg text-white">
                                {{ substr($firstupdate->title, 0, 70) }}{{ strlen($firstupdate->title) > 70 ? '...' : '' }}
                            </h1>
                            <p class="poppins text-sm text-white ">
                                <span class="poppins text-white text-sm">{{ $firstupdate->created_at }}</span>
                            </p>
                            <p class="poppins text-sm ">
                                {!! substr($firstupdate->description, 0, 90) !!}{{ strlen($firstupdate->description) > 90 ? '...' : '' }}
                            </p>
                            <div class="flex items-center justify-start py-2">
                                <a href="{{ route('update.show', $firstupdate->id) }}"
                                    class="poppins px-2 py-1 text-xs text-white border border-white ">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div
                class="w-full md:w-1/2 flex flex-col space-y-8 md:space-y-2 justify-center items-center md:items-start">
                @foreach ($updates as $update)
                    <div class="w-full md:w-fit flex flex-col md:flex-row items-center space-y-3 md:space-y-0 md:space-x-3"
                        data-aos="fade-up" data-aos-delay="500">
                        <img alt=""
                            src="{{ $update->cover_photo ? asset('storage/' . $update->cover_photo) : asset('image/mamboges.jpg') }}"
                            class="w-full md:w-[200px] h-64 md:h-[140px] rounded shadow-md">
                        <div class="w-full md:w-auto flex flex-col space-y-1">
                            <a href="/news-and-announcements?tag={{ $update->tag->tag }}"
                                class="poppins text-red-600 text-sm ">
                                {{ $update->tag->tag ?? '' }}
                            </a>
                            <h1 class="poppins font-semibold text-lg text-gray-800">
                                {{ substr($update->title, 0, 25) }}{{ strlen($update->title) > 25 ? '...' : '' }}
                            </h1>
                            <p class="poppins text-sm text-gray-600 ">
                                <span class="poppins text-gray-500 text-sm">{{ $update->created_at }}</span>
                            </p>
                            <div class="poppins text-sm text-gray-600 ">
                                {!! substr($update->description, 0, 45) !!}{{ strlen($update->description) > 45 ? '...' : '' }}
                            </div>
                            <div class="flex items-center justify-start py-2">
                                <a href="{{ route('update.show', $update->id) }}"
                                    class="popp ins px-2 py-1 text-xs text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($firstupdate == null && count($updates) == 0)
                    <div class="w-full h-[120px] flex items-center justify-center">
                        <a class="flex items-center justify-center md:justify-end space-x-4 cursor-pointer">
                            <p class="text-base poppins font-medium text-red-600">Nothing is posted</p>
                        </a>
                    </div>
                @else
                    <div class="w-full h-[120px] flex items-center justify-center">
                        <a href="{{ route('update.index') }}"
                            class="flex items-center justify-center md:justify-end space-x-4 cursor-pointer animate-pulse">
                            <p class="text-base poppins font-medium text-blue-600">See more updates</p>
                            <i class='bx bx-chevrons-right text-3xl text-blue-600'></i>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
