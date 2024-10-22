<div class="evaluations w-full flex justify-between mb-3 space-x-2">
    <div class="w-1/4 flex justify-center items-center py-4 border border-gray-500">
        <h1 class="poppins text-base font-semibold">LEARNERS</h1>
    </div>
    <div class="w-3/4 ">
        <div class="flex space-x-2">
            @foreach ($evaluations as $key => $evaluation)
                <div class="h-20 flex evalnav {{ $key === 0 ? ' active-eval' : '' }} justify-center items-center w-full py-4 cursor-pointer hover:bg-blue-800 border border-gray-500 group">
                    <div class="flex flex-col justify-center items-center space-y-1">
                        <h1 class="poppins text-center text-sm font-medium group-hover:text-white">{{ strtoupper($evaluation->name)}} </h1>
                        <span id="percentageValue_{{ $loop->index }}" class=" poppins text-sm font-medium group-hover:text-white rounded px-1 border border-gray-500">{{$evaluation->percentage}}%</span>
                    </div>
                </div>
            @endforeach
            <div class="h-20 flex evalnav justify-center items-center w-full py-4 cursor-pointer hover:bg-blue-800 border border-gray-500 group">
                <div class="flex">
                    <h1 class="poppins text-sm font-medium group-hover:text-white ">FINAL GRADE</h1>
                </div>
            </div>
        </div>
    </div>
</div>
