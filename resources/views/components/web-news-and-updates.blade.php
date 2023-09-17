<section class="bg-gray-100">
    <div class="max-w-[1300px] mx-auto px-4">
        <div class="flex items-start space-x-4 justify-between py-24">

            <div class="w-[700px] flex flex-col space-y-2">
                <img alt="" src="{{$firstupdate->cover_photo ? asset('storage/' . $firstupdate->cover_photo) : asset('image/mamboges.jpg')}}"
                class="w-full h-[450px] rounded shadow-md">
                <div class="flex flex-col space-y-1 py-2">
                    <a href="#" class="poppins text-red-600 text-sm ">
                        {{$firstupdate->tag->tag}}
                    </a>
                    <h1 class="poppins font-semibold text-lg text-gray-800">
                        {{substr($firstupdate->title, 0, 60)}}{{strlen($firstupdate->title) > 60 ? "..." : ""}}
                    </h1>
                    <p class="poppins text-sm text-gray-600 ">
                        {!! substr($firstupdate->description, 0, 45) !!}{{ strlen($firstupdate->description) > 45 ? "..." : "" }}
                    </p>
                    <div class="flex items-center justify-start py-2">
                        <a href="" class="poppins px-2 py-1 text-xs text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white ">Read More</a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col space-y-4">
                @foreach ($updates as $update)
                    <div class="flex items-center space-x-3">
                        <img alt="" src="{{$update->cover_photo ? asset('storage/' . $update->cover_photo) : asset('image/mamboges.jpg')}}"
                        class="w-[200px] h-[140px] rounded shadow-md">
                        <div>
                            <a href="#" class="poppins text-red-600 text-sm ">
                                {{$update->tag->tag}}
                            </a>
                            <h1 class="poppins font-semibold text-lg text-gray-800">
                                {{substr($update->title, 0, 30)}}{{strlen($update->title) > 30 ? "..." : ""}}
                            </h1>
                            <div class="poppins text-sm text-gray-600 ">
                                {!! substr($update->description, 0, 45) !!}{{ strlen($update->description) > 45 ? "..." : "" }}
                            </div>
                            <div class="flex items-center justify-start py-2">
                                <a href="" class="poppins px-2 py-1 text-xs text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <a class="h-[120px] flex items-center justify-end space-x-4 cursor-pointer animate-pulse">
                    <p class="text-base poppins font-medium text-blue-600">See more updates</p>
                    <i class='bx bx-chevrons-right text-3xl text-blue-600'></i>
                </a>

            </div>
        </div>
    </div>
</section>