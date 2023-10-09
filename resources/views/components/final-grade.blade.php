<div id="final" class="hidden w-full border-t border-l border-r border-gray-400 rounded-md">
    @foreach ($students as $student)
        <div class="flex justify-start border-b border-gray-400 ">
            <div class="w-1/4 flex justify-start items-center px-2">
                <div class="flex space-x-2 py-2">
                    <p class="poppins text-sm">{{$student->user->profile->firstName}},</p>
                    <p class="poppins text-sm">{{$student->user->profile->lastName}}</p>
                    <p class="poppins text-sm">{{ substr($student->user->profile->middleName, 0, 1) }}.</p>
                </div>
            </div>

            @php
                $evaluationCriterias = $classrecord->classRecordEvaluationCriterias;
                $finalGrade = 0;
            @endphp

            <div class="w-3/4 flex justify-end">
                <div class="flex">
                    @foreach ($evaluationCriterias as $evaluationCriteria)
                        @php
                            $activity_statistic = $student->activityStatistics->where('class_record_evaluation_criteria_id', $evaluationCriteria->id)->first();
                            $finalGrade += $activity_statistic->ws ?? 0;
                        @endphp
                        <div class="w-[65px] flex justify-center items-center border-r border-gray-400">
                            <p class="poppins text-sm">{{ $activity_statistic->ws ?? 0 }}</p>
                        </div>   
                    @endforeach
                    <div class="w-[65px] flex justify-center items-center border-l border-gray-400">
                        <p class="poppins text-sm">{{ $finalGrade }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
