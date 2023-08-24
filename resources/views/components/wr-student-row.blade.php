<div class="flex justify-start border-t border-b border-gray-400">            
    {{-- name --}}
    <div class="w-1/4 flex justify-start items-center py-2 border-r border-gray-400">
        <div class="flex space-x-2 px-2">
            <p class="poppins text-sm">{{$student->last_name}},</p>
            <p class="poppins text-sm">{{$student->first_name}}</p>
            <p class="poppins text-sm">{{ substr($student->middle_name, 0, 1) }}.</p>
            {{-- <p class="poppins text-sm">{{$student->name}}</p> --}}
        </div>
    </div>
        {{-- activities --}}
    <div class="w-3/4 flex justify-between">
        <div class="flex overflow-hidden"> 
            {{-- loop the table activities for each students --}}     
            @foreach ($activities as $activity)
                <x-wr-student-grade :activity="$activity" :student="$student"/>
            @endforeach
            {{--  --}}
        </div>

        <div class="flex ">
            <div class="w-[60px] flex justify-center items-center border-r border-l border-gray-400">
                <p class="poppins text-sm">0</p>
            </div>
            <div class="w-[60px] flex justify-center items-center border-r border-gray-400">
                <p class="poppins text-sm">0</p>
            </div>
            <div class="w-[60px] flex justify-center items-center border-r border-gray-400">
                <p class="poppins text-sm">0</p>
            </div>
        </div>
    </div> 
</div>