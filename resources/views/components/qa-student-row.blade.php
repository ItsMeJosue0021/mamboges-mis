<div class="flex justify-start border-t border-gray-400">            
    <div class="w-1/4 flex justify-start items-center py-2 border-r border-gray-400">
        <div class="flex space-x-2 px-2">
            <p class="poppins text-sm">{{$student->user->profile->firstName}},</p>
            <p class="poppins text-sm">{{$student->user->profile->lastName}}</p>
            <p class="poppins text-sm">{{ substr($student->user->profile->middleName, 0, 1) }}.</p>
        </div>
    </div>

    <div class="w-3/4 flex justify-between">
        <div class="flex overflow-hidden"> 
            @foreach ($activities as $activity)
                <x-qa-student-grade :activity="$activity" :student="$student"/>
            @endforeach
        </div>

        @php
            $evaluation_percentage = $evaluations->skip(2)->first()->percentage;
            $statistic = $student->activityStatistics->where('class_record_evaluation_criteria_id', $evaluations->skip(2)->first()->id)->first();
            $total = $statistic ? $statistic->total : 0;
            $ps = $statistic ? $statistic->ps : 0;
            $ws = $statistic ? $statistic->ws : 0;
        @endphp

        <div class="flex ">
            <div class="w-[65px] flex justify-center items-center border-r border-l border-gray-400">
                 <p class="poppins text-sm">{{$total}}</p> 
            </div>
            <div class="w-[65px] flex justify-center items-center border-r border-gray-400">
                 <p class="poppins text-sm">{{ $ps != 100 ? number_format($ps, 2) : 100 }} </p> 
            </div>
            <div class="w-[65px] flex justify-center items-center border-gray-400">
                <p class="poppins text-sm">{{ $ws != $evaluation_percentage ? (fmod($ws, 1) == 0 ? $ws : number_format($ws, 2)) : $evaluation_percentage }}
                </p> 
            </div>
        </div>
    </div> 
</div>