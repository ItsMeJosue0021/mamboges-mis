<section class="bg-gray-50">
    <div class="max-w-[1300px] mx-auto px-4 py-16 md:py-24">
        <div class="w-full flex items-center justify-center pb-12">
            <h1 class="castoro text-3xl text-lightblack font-semibold text-center">SCHOOL'S ACHIEVEMENTS</h1>
        </div>
        <div class="flex flex-row-reverse items-start md:space-x-4 justify-between">

            @if ($firstachievement != null)
                <div class="w-[700px] hidden md:flex flex-col space-y-2 relative" data-aos="fade-right"
                data-aos-delay="500">
                    <img alt=""
                        src="{{ $firstachievement->coverPhoto ? asset('storage/' . $firstachievement->coverPhoto) : asset('image/mamboges.jpg') }}"
                        class="w-full h-[450px] rounded shadow-md">

                    <div class="w-full absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent opacity-70">
                        <div class="w-full flex flex-col space-y-1 p-6 text-gray-200 poppins text-sm">
                            <h1 class="poppins font-semibold text-lg text-white">
                                {{ substr($firstachievement->title, 0, 70) }}{{ strlen($firstachievement->title) > 70 ? '...' : '' }}
                            </h1>
                            <p class="poppins text-sm text-white ">
                                <span class="poppins text-white text-sm">{{$firstachievement->created_at}}</span>
                            </p>
                            <p class="poppins text-white ">
                                {!! substr($firstachievement->description, 0, 90) !!}{{ strlen($firstachievement->description) > 90 ? '...' : '' }}
                            </p>
                            <div class="flex items-center justify-start py-2">
                                <a href="{{ route('achievements.show', $firstachievement->id) }}"
                                    class="poppins px-2 py-1 text-xs text-white border border-white">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="w-full md:w-1/2 flex flex-col space-y-4">
                @foreach ($achievements as $achievement)
                    <div class="flex flex-col md:flex-row items-center md:space-x-3" data-aos="fade-up"
                    data-aos-delay="500">
                        <img alt=""
                            src="{{ $achievement->coverPhoto ? asset('storage/' . $achievement->coverPhoto) : asset('image/mamboges.jpg') }}"
                            class="w-full md:w-[200px] h-64 md:h-[140px] rounded shadow-md">
                        <div class="w-full md:w-auto">
                            <h1 class="poppins font-semibold text-lg text-gray-800">
                                {{ substr($achievement->title, 0, 25) }}{{ strlen($achievement->title) > 25 ? '...' : '' }}
                            </h1>
                            <p class="poppins text-sm text-gray-600 ">
                                <span class="poppins text-gray-500 text-sm">{{$achievement->created_at}}</span>
                            </p>
                            <div class="poppins text-sm text-gray-600 ">
                                {!! substr($achievement->description, 0, 45) !!}{{ strlen($achievement->description) > 45 ? '...' : '' }}
                            </div>
                            <div class="flex items-center justify-start py-2">
                                <a href="{{ route('achievements.show', $achievement->id) }}"
                                    class="poppins px-2 py-1 text-xs text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($firstachievement == null && count($achievements) == 0)
                    <div class="w-full h-[120px] flex items-center justify-center">
                        <a class="flex items-center justify-center md:justify-end space-x-4 cursor-pointer">
                            <p class="text-base poppins font-medium text-red-600">Nothing is posted</p>
                        </a>
                    </div>
                @else
                    <div class="w-full h-[120px] flex items-center justify-center">
                        <a href="{{ route('achievements.index') }}" class="flex items-center justify-center md:justify-end space-x-4 cursor-pointer animate-pulse">
                            <p class="text-base poppins font-medium text-blue-600">See more posts</p>
                            <i class='bx bx-chevrons-right text-3xl text-blue-600'></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
