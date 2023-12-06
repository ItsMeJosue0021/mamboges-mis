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
            <span class="text-[10px] h-4 ">1</span>
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
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                        <span class="font-bold"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-2/6 border-0 border-l-2 border-gray-700 ">
        <div class="w-full">
            <div class="w-full h-4 border-b border-gray-700 flex items-center justify-between ">
                <div class="h-4 border-gray-700 flex items-center">
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                        <span class="font-bold"></span>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                        <span class="font-bold"></span>
                    </div>
                    <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                        <span class="font-bold"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-1/4 border-0 border-x-2 border-gray-700 flex items-start ">
        <div class="w-auto">
            <div class="h-4 flex items-center border-b border-gray-700">
                <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                    <span class="font-bold"></span>
                </div>
                <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                    <span class="font-bold"></span>
                </div>
                <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                    <span class="font-bold"></span>
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
