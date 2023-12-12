<div class="flex flex-col space-y-2 py-16 bg-white text-gray-700">
    <div class="w-full flex items-center justify-center p-4">
        <h1 class="castoro text-3xl text-lightblack font-semibold text-center">ORGANIZATIONAL CHART</h1>
    </div>
    @if ($orgChartRows->isEmpty())
    <div class="w-full h-96 flex flex-col items-center justify-center">
        <img class="h-60 w-60" src="{{ asset('image/search.png') }}" alt="">
    </div>
    @else
        @foreach ($orgChartRows as $row)
            <div class="w-full h-fit min-h-[150px] p-1">
                <p class="poppins font-semibold text-center pb-2">{{ $row->title ?? '' }}</p>
                @if ($row->orgChartRowItems)
                    <div class="w-full flex justify-center items-start space-x-4 overflow-x-auto">
                        @foreach ($row->orgChartRowItems as $item)
                            <div class="w-36 h-full p-2 rounded relative group flex flex-col items-center justify-center">
                                <div class="w-16 md:w-full h-14 md:h-24 flex justify-center items-center">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt=""
                                        class="w-full h-full rounded">
                                </div>
                                <p class=" text-[11px] md:text-sm text-center font-bold">{{ $item->name ?? '' }}</p>
                                <p class="text-[10px] text-center">{{ $item->position ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>
