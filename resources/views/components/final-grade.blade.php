
<div id="final" class="hidden">
    <div class="w-full flex items-center justify-between border border-gray-300 shadow py-2 px-2 mb-3">
        <div class="w-full flex items-center space-x-4 ">
            <div class="w-fit flex items-center space-x-4">
                <h1 class="poppins h-full rounded p-2 text-sm font-bold">CLASS RECORD</h1>
            </div>
        </div>
    </div>

    {{-- <div class=" w-full border-t border-l border-r border-gray-400 rounded-md">
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
    </div> --}}
    <div class="w-full mt-16 mb-10 border border-gray-200 old-english">
        <div class="w-full flex items-start relative">
            <img src="{{ asset('image/deped/deped.png') }}" alt="" class="w-48 h-20 absolute right-4 top-0">
            <div class="p-5">
                <img src="{{ asset('image/deped/deped-circle.png') }}" alt="" class="w-24 ">
            </div>
            <div class="w-full">
                <div class="w-full">
                    <div class="w-full flex items-end justify-center">
                        <h1 class="text-2xl font-bold old-english">Class Record</h1>
                    </div>
                    <div class="w-full flex items-end justify-center py-1">
                        <span class="text-[7px] italic old-english">(Pursuant to Deped Order 8 series of 2015)</span>
                    </div>
                </div>
                <div class="w-full flex space-x-12">
                    <div class="w-1/2 flex flex-col">
                        <div class="w-full flex items-start justify-end space-x-12">
                            <div>
                                <span class="font-bold text-[13px]">REGION</span>
                                <input type="text" class="w-[133.5px] h-6 text-center text-[12px] p-0 border border-b-0 border-gray-700 placeholder:text-center" placeholder="IV-A">
                            </div>
                            <div>
                                <span class="font-bold text-[13px]">DIVISION</span>
                                <input type="text" class="w-[180px] h-6 text-center text-[12px] p-0 border border-b-0 border-gray-700 placeholder:text-center" placeholder="BACOOR CITY">
                            </div>
                        </div>
                        <div class="w-full flex items-start justify-end">
                            <div class="w-full flex space-x-1 items-center justify-end">
                                <span class="font-bold text-[13px]">SCHOOL NAME</span>
                                <input type="text" class="w-[423px] h-6 text-center text-[12px] p-0 border border-gray-700 placeholder:text-center">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 flex flex-col">
                        <div class="w-full h-full flex items-end justify-end space-x-12">
                            <div>
                                <span class="font-bold text-[13px]">SCHOOL ID</span>
                                <input type="text" class="w-[200px] h-6 text-center text-[12px] p-0 border- border-gray-700 placeholder:text-center" >
                            </div>
                            <div>
                                <span class="font-bold text-[13px]">SCHOOL YEAR</span>
                                <input type="text" class="w-[180px] h-6 text-center text-[12px] p-0 border border-gray-700 placeholder:text-center" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-20"></div>
        </div>
        <div class="w-full flex">
            <div class="w-1/5 h-6 border-2 border-r-0 border-gray-700 flex items-center justify-center text-[10px]">
                <span class="font-bold">THIRD QUARTER</span>
            </div>
            <div class="w-1/4 h-6 border-2 border-r-0 border-gray-700 flex items-center justify-center space-x-12 text-[10px]">
                <span class="font-bold">GRADE & SECTION:</span>
                <span>4-GUMAMELA</span>
            </div>
            <div class="w-2/6 h-6 border-2 border-r-0 border-gray-700 flex items-center justify-center space-x-12 text-[10px]">
                <span class="font-bold">TEACHER:</span>
                <span>JOSHUA C. SALCEDA</span>
            </div>
            <div class="w-2/6 h-6 border-2 border-gray-700 flex items-center justify-center space-x-12 text-[10px]">
                <span class="font-bold">SUBJECT:</span>
                <span>FILIPINO</span>
            </div>
        </div>
        <div class="w-full flex">
            <div class="w-1/5 flex border-0 border-l-2 border-gray-700">
                <div class="w-6">
                    <div class="h-[48px] border-b-2 border-r-2 border-gray-700"></div>
                    <div class="h-4 border-b-2 border-r-2 border-gray-700"></div>
                    <div class="h-4 border-b-2 border-r-2 border-gray-700"></div>
                </div>
                <div class="w-full">
                    <div class="h-[48px] flex items-center justify-center border-b-2 border-gray-700">
                        <span class="font-bold text-[11px]">LEARNER'S NAMES</span>
                    </div>
                    <div class="w-full h-4 border-b-2 border-gray-700"></div>
                    <div class="w-full h-4 text-[10px] flex items-center justify-center border-b-2 border-gray-700">
                        <span class="font-bold">HIGHEST POSSIBLE SCORE</span>
                    </div>
                </div>
            </div>
            <div class="w-2/6 border-0 border-l-2 border-gray-700 ">
                <div class="w-full">
                    <div class="h-[48px] flex items-center justify-center border-b-2 border-gray-700">
                        <span class="font-bold text-[11px]">WRITTEN WORKS (30%)</span>
                    </div>
                    <div class="w-full h-4 border-b-2 border-gray-700 flex items-center justify-between">
                        <div class="h-4 border-gray-700 flex items-center">
                                @for ($i = 0; $i < 10; $i++)
                                    <div class="w-8 h-4 text-[10px] flex items-center justify-center @if ($i == 9) border-r-2 @else border-r @endif border-gray-700">
                                        <span class="font-bold">{{ $i + 1 }}</span>
                                    </div>
                                @endfor
                        </div>

                        <div class="flex items-center">
                            <div class="w-10 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                                <span class="font-bold">Total</span>
                            </div>
                            <div class="w-10 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                                <span class="font-bold">PS</span>
                            </div>
                            <div class="w-10 text-[10px] flex items-center justify-center">
                                <span class="font-bold">WS</span>
                            </div>
                        </div>
                    </div>
                    <div class="w-full h-4 border-b-2 border-gray-700 flex items-center justify-between ">
                        <div class="h-4 border-gray-700 flex items-center">
                            @php
                                $activityCount = count($wrActivities);
                                $wr_total = 0;
                            @endphp

                            @for ($i = 0; $i < 10; $i++)
                                @php
                                    $activityIndex = $i ;
                                    $currentActivity = isset($wrActivities[$activityIndex]) ? $wrActivities[$activityIndex] : null;
                                    $isLastIteration = ($i == 9);
                                    $wr_total +=  $currentActivity->max_score ?? 0;
                                @endphp

                                <div class="w-8 h-4 text-[10px] flex items-center justify-center @if ($isLastIteration) border-r-2 @else border-r @endif border-gray-700">
                                    <span class="font-bold">{{ $currentActivity->max_score ?? '' }}</span>
                                </div>
                            @endfor
                        </div>

                        <div class="flex items-center">
                            <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                                <span class="font-bold">{{ $wr_total }}</span>
                            </div>
                            <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                                <span class="font-bold">100.00</span>
                            </div>
                            <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                                <span class="font-bold">30%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-2/6 border-0 border-l-2 border-gray-700 ">
                <div class="w-full">
                    <div class="h-[48px] flex items-center justify-center border-b-2 border-gray-700">
                        <span class="font-bold text-[11px]">PERFORMANCE TASKS (50%)</span>
                    </div>
                    <div class="w-full h-4 border-b-2 border-gray-700 flex items-center justify-between">
                        <div class="h-4 border-gray-700 flex items-center">
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                                <span class="font-bold">2</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                                <span class="font-bold">3</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                                <span class="font-bold">4</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                                <span class="font-bold">5</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                                <span class="font-bold">6</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                                <span class="font-bold">7</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                                <span class="font-bold">8</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r border-gray-700">
                                <span class="font-bold">9</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">10</span>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-10 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                                <span class="font-bold">Total</span>
                            </div>
                            <div class="w-10 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                                <span class="font-bold">PS</span>
                            </div>
                            <div class="w-10 text-[10px] flex items-center justify-center">
                                <span class="font-bold">WS</span>
                            </div>
                        </div>
                    </div>
                    <div class="w-full h-4 border-b-2 border-gray-700 flex items-center justify-between ">
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
                                <span class="font-bold">100.00</span>
                            </div>
                            <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                                <span class="font-bold">30%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/4 border-0 border-x-2 border-gray-700 flex items-start ">
                <div class="w-auto">
                    <div class="h-[48px] flex flex-col items-center justify-center border-b-2 border-gray-700 text-[11px]">
                        <span class="font-bold text-center">QUARTERLY</span>
                        <span class="font-bold text-center">ASSEMENT</span>
                        <span class="font-bold text-center">(20%)</span>
                    </div>
                    <div class="h-4 flex items-center border-b-2 border-gray-700">
                        <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold">Total</span>
                        </div>
                        <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold">PS</span>
                        </div>
                        <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                            <span class="font-bold">WS</span>
                        </div>
                    </div>
                    <div class="h-4 flex items-center border-b-2 border-gray-700">
                        <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold"></span>
                        </div>
                        <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold">100.00</span>
                        </div>
                        <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                            <span class="font-bold">30%</span>
                        </div>
                    </div>
                </div>
                <div class="w-full h-full border-x-2 border-b-2 border-gray-700 text-[10px] flex flex-col items-center justify-center space-y-4">
                    <span>Initial</span>
                    <span>Grade</span>
                </div>
                <div class="w-full h-full text-[10px] border-b-2 border-gray-700 flex flex-col items-center justify-center space-y-4">
                    <span>Quarterly</span>
                    <span>Grade</span>
                </div>
            </div>
        </div>

        <div class="w-full flex bg-gray-200">
            <div class="w-1/5 flex border-0 border-l-2 border-gray-700">
                <div class="w-6 h-4 border-b-2 border-r-2 border-gray-700 flex items-center justify-center">
                    <span class="text-[10px] h-4 "></span>
                </div>
                <div class="w-full">
                    <div class="w-full h-4 text-[10px] flex items-center justify-left border-b-2 border-gray-700">
                        <span class="font-bold px-2">MALE</span>
                    </div>
                </div>
            </div>
            <div class="w-2/6 border-0 border-l-2 border-gray-700 ">
                <div class="w-full">
                    <div class="w-full h-4 border-b-2 border-gray-700 flex items-center justify-between ">
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
                    <div class="w-full h-4 border-b-2 border-gray-700 flex items-center justify-between ">
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
                    <div class="h-4 flex items-center border-b-2 border-gray-700">
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
                <div class="w-full h-4 border-x-2 border-b-2 border-gray-700 text-[10px] flex flex-col items-center justify-center space-y-4">
                    <span></span>
                </div>
                <div class="w-full h-4 text-[10px] border-b-2 border-gray-700 flex flex-col items-center justify-center space-y-4">
                    <span></span>
                </div>
            </div>
        </div>

        @foreach ($students as $student)
            <x-class-record-student :student="$student" :classrecord="$classrecord" :wrActivities="$wrActivities" :ptActivities="$ptActivities" :qaActivities="$qaActivities"/>
        @endforeach

    </div>
</body>
