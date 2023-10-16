
<div id="final" class="hidden">
    <div class="w-full flex items-center justify-between border border-gray-300 shadow rounded py-2 px-2 mb-3">
        <div class="w-full flex items-center space-x-4 rounded">
            <div class="w-fit flex items-center space-x-4">
                <h1 class="poppins h-full rounded p-2 text-sm font-bold">FINAL GRADE</h1>
            </div>
        </div>
    </div>
    <div class=" w-full border-t border-l border-r border-gray-400 rounded-md">
        <div class="flex justify-start border-b border-gray-400 rounded-t-md bg-gray-200 ">
            <div class="w-1/4 flex justify-start items-center px-2 border-r border-gray-400">
                <p class="poppins text-sm text-center font-semibold">Learners</p>
            </div>
            <div class="w-3/4 flex justify-end">
                <div class="flex border-l border-gray-400">
                    <div class="w-[150px] flex flex-col justify-center items-center border-r border-gray-400 py-2">
                        <p class="poppins text-sm text-center font-semibold">Written Works</p>
                    </div>
                    <div class="w-[150px] flex flex-col justify-center items-center border-r border-gray-400 py-2">
                        <p class="poppins text-sm text-center font-semibold">Performance</p>
                        <p class="poppins text-sm text-center font-semibold">Tasks</p>
                    </div>
                    <div class="w-[150px] flex flex-col justify-center items-center border-r border-gray-400 py-2">
                        <p class="poppins text-sm text-center font-semibold">Quarterly</p>
                        <p class="poppins text-sm text-center font-semibold">Assessments</p>
                    </div>
                    <div class="w-[150px] flex flex-col justify-center items-center">
                        <p class="poppins text-sm text-center font-semibold">Final Grade</p>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($students as $student)
            <div class="flex justify-start border-b border-gray-400 ">
                <div class="w-1/4 flex justify-start items-center px-2 border-r border-gray-400">
                    <div class="flex space-x-2 py-2">
                        <p class="poppins text-sm">{{ $student->user->profile->firstName }},</p>
                        <p class="poppins text-sm">{{ $student->user->profile->lastName }}</p>
                        <p class="poppins text-sm">{{ substr($student->user->profile->middleName, 0, 1) }}.</p>
                    </div>
                </div>

                @php
                    $evaluationCriterias = $classrecord->classRecordEvaluationCriterias;
                    $finalGrade = 0;
                @endphp

                <div class="w-3/4 flex justify-end">
                    <div class="flex border-l border-gray-400">
                        @foreach ($evaluationCriterias as $evaluationCriteria)
                            @php
                                $activity_statistic = $student->activityStatistics->where('class_record_evaluation_criteria_id', $evaluationCriteria->id)->first();
                                $finalGrade += $activity_statistic->ws ?? 0;
                            @endphp
                            <div class="w-[150px] flex justify-center items-center border-r border-gray-400">
                                <p class="poppins text-sm">{{ $activity_statistic->ws ?? 0 }}</p>
                            </div>
                        @endforeach
                        <div class="w-[150px] flex justify-center items-center">
                            <p class="poppins text-sm">{{ $finalGrade }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

