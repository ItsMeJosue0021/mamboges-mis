@php
    $evaluationCriterias = $classrecord->classRecordEvaluationCriterias;
    $initialGrade = 0;

    foreach ($evaluationCriterias as $evaluationCriteria) {
        $activity_statistic = $student->activityStatistics->where('class_record_evaluation_criteria_id', $evaluationCriteria->id)->first();
        $initialGrade += $activity_statistic->ws ?? 0;
    }
@endphp


<div class="w-full flex">
    <div class="w-1/5 flex border-0 border-l-2 border-gray-700">
        <div class="w-6 h-4 border-b border-r-2 border-gray-700 flex items-center justify-center">
            <span class="text-[10px] h-4 ">{{ $loop->index + 1 }}</span>
        </div>
        <div class="w-full">
            <div class="w-full h-4 text-[10px] flex items-center justify-left border-b border-gray-700">
                <span class="font-bold px-2">
                    {{ $student->user->profile->firstName }}
                    {{ $student->user->profile->middleName }}
                    {{ $student->user->profile->lastName }}
                </span>
            </div>
        </div>
    </div>
    <div class="w-2/6 border-0 border-l-2 border-gray-700 ">
        <div class="w-full">
            <div class="w-full h-4 border-b border-gray-700 flex items-center justify-between ">
                <div class="h-4 border-gray-700 flex items-center">
                    @for ($i = 0; $i < 10; $i++)
                        @php
                            $activityIndex = $i ;
                            $currentActivity = isset($wrActivities[$activityIndex]) ? $wrActivities[$activityIndex] : null;
                            $isLastIteration = ($i == 9);
                            if ($currentActivity) {
                                $score = $student->scores->where('activity_id', $currentActivity->id)->first();
                                $scoreValue = $score ? $score->score : " ";
                            } else {
                                $scoreValue = " ";
                            }
                        @endphp

                        <div class="w-8 h-4 text-[10px] flex items-center justify-center @if ($isLastIteration) border-r-2 @else border-r @endif border-gray-700">
                            <span class="font-bold">{{ $scoreValue }}</span>
                        </div>
                    @endfor
                </div>

                @php
                    $evaluation_percentage = $evaluations->first()->percentage;
                    $statistic = $student->activityStatistics->where('class_record_evaluation_criteria_id', $evaluations->first()->id)->first();
                    $total = $statistic ? $statistic->total : 0;
                    $ps = $statistic ? $statistic->ps : 0;
                    $ws = $statistic ? $statistic->ws : 0;
                @endphp

                <div class="flex items-center">
                    <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                        <span class="font-bold">{{ $total }}</span>
                    </div>
                    <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                        <span class="font-bold">{{ $ps != 100 ? number_format($ps, 2) : 100 }}</span>
                    </div>
                    <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                        <span class="font-bold">{{ $ws != $evaluation_percentage ? (fmod($ws, 1) == 0 ? $ws : number_format($ws, 2)) : $evaluation_percentage }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-2/6 border-0 border-l-2 border-gray-700 ">
        <div class="w-full">
            <div class="w-full h-4 border-b border-gray-700 flex items-center justify-between ">
                <div class="h-4 border-gray-700 flex items-center">
                    @for ($i = 0; $i < 10; $i++)
                        @php
                            $activityIndex = $i ;
                            $currentActivity = isset($ptActivities[$activityIndex]) ? $ptActivities[$activityIndex] : null;
                            $isLastIteration = ($i == 9);
                            if ($currentActivity) {
                                $score = $student->scores->where('activity_id', $currentActivity->id)->first();
                                $scoreValue = $score ? $score->score : " ";
                            } else {
                                $scoreValue = " ";
                            }
                        @endphp

                        <div class="w-8 h-4 text-[10px] flex items-center justify-center @if ($isLastIteration) border-r-2 @else border-r @endif border-gray-700">
                            <span class="font-bold">{{ $scoreValue }}</span>
                        </div>
                    @endfor

                </div>

                @php
                    $evaluation_percentage = $evaluations->skip(1)->first()->percentage;
                    $statistic = $student->activityStatistics->where('class_record_evaluation_criteria_id', $evaluations->skip(1)->first()->id)->first();
                    $total = $statistic ? $statistic->total : 0;
                    $ps = $statistic ? $statistic->ps : 0;
                    $ws = $statistic ? $statistic->ws : 0;
                @endphp

                <div class="flex items-center">
                    <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                        <span class="font-bold">{{ $total }}</span>
                    </div>
                    <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                        <span class="font-bold">{{ $ps != 100 ? number_format($ps, 2) : 100 }}</span>
                    </div>
                    <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                        <span class="font-bold">{{ $ws != $evaluation_percentage ? (fmod($ws, 1) == 0 ? $ws : number_format($ws, 2)) : $evaluation_percentage }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-1/4 border-0 border-x-2 border-gray-700 flex items-start ">
        <div class="w-auto">
            @php
                $evaluation_percentage = $evaluations->skip(2)->first()->percentage;
                $statistic = $student->activityStatistics->where('class_record_evaluation_criteria_id', $evaluations->skip(2)->first()->id)->first();
                $total = $statistic ? $statistic->total : 0;
                $ps = $statistic ? $statistic->ps : 0;
                $ws = $statistic ? $statistic->ws : 0;
            @endphp
            <div class="h-4 flex items-center border-b border-gray-700">
                <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                    <span class="font-bold">{{$total}}</span>
                </div>
                <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                    <span class="font-bold">{{ $ps != 100 ? number_format($ps, 2) : 100 }}</span>
                </div>
                <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                    <span class="font-bold">{{ $ws != $evaluation_percentage ? (fmod($ws, 1) == 0 ? $ws : number_format($ws, 2)) : $evaluation_percentage }}</span>
                </div>
            </div>
        </div>
        <div class="w-full h-4 border-x-2 border-b border-gray-700 text-[10px] flex flex-col items-center justify-center space-y-4">
            <span>{{ $initialGrade }}</span>
        </div>
        <div class="w-full h-4 text-[10px] border-b border-gray-700 flex flex-col items-center justify-center space-y-4">
            <span></span>
        </div>
    </div>
</div>
