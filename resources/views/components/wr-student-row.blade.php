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

        @php
            $evaluation_percentage = $evaluations->first()->percentage;
            $statistic = $student->activityStatistics->where('class_record_evaluation_criteria_id', $evaluations->first()->id)->first();
            $total = $statistic ? $statistic->total : 0;
            $ps = $total / $totalscore * 100;
            $ws =  $evaluation_percentage / 100 * $ps ;
        @endphp

        <div class="flex ">
            <div class="w-[60px] flex justify-center items-center border-r border-l border-gray-400">
                <p class="poppins text-xs">{{$total}}</p>
            </div>
            <div class="w-[60px] flex justify-center items-center border-r border-gray-400">
                <p class="poppins text-xs">{{ $ps != 100 ? number_format($ps, 2) : 100 }}</p>
            </div>
            <div class="w-[60px] flex justify-center items-center border-r border-gray-400">
                <p class="poppins text-xs">{{ $ws !=  $evaluation_percentage ? number_format($ws, 2) :  $evaluation_percentage }}</p>
            </div>
        </div>
    </div> 
</div>