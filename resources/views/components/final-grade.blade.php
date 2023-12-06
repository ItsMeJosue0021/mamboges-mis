
<div id="final" class="hidden">
    <div class="w-full flex items-center justify-between border border-gray-300 shadow rounded py-2 px-2 mb-3">
        <div class="w-full flex items-center space-x-4 rounded">
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
    <div class="w-full mt-16 border border-gray-200 old-english">
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
                <div class="w-full flex">
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
        <div class="w-full flex text-[12px]">
            <div class="w-1/5 h-6 border-2 border-r-0 border-gray-700 flex items-center justify-center text-[10px]">
                <span class="font-bold">THIRD QUARTER</span>
            </div>
            <div class="w-1/4 h-6 border-2 border-r-0 border-gray-700 flex items-center justify-center space-x-12 text-[10px]">
                <span class="font-bold">GRADE & SECTION:</span>
                <span>4-GUMAMELA</span>
            </div>
            <div class="w-2/6 h-6 border-2 border-r-0 border-gray-700 flex items-center justify-center space-x-12 text-[10px]">
                <span class="font-bold">TEACHER:</span>
                <span>JOSHUA C. SALCEA</span>
            </div>
            <div class="w-2/6 h-6 border-2 border-gray-700 flex items-center justify-center space-x-12 text-[10px]">
                <span class="font-bold">SUBJECT:</span>
                <span>FILIPINO</span>
            </div>
        </div>
        <div class="w-full flex">
            <div class="w-1/5 flex text-[13px] border-0 border-l-2 border-gray-700">
                <div class="w-6">
                    <div class="h-[48px] border-b-2 border-r-2 border-gray-700"></div>
                    <div class="h-4 border-b-2 border-r-2 border-gray-700"></div>
                    <div class="h-4 border-b-2 border-r-2 border-gray-700"></div>
                </div>
                <div class="w-full">
                    <div class="h-[48px] flex items-center justify-center border-b-2 border-gray-700">
                        <span class="font-bold">LEARNER'S NAMES</span>
                    </div>
                    <div class="w-full h-4 border-b-2 border-gray-700"></div>
                    <div class="w-full h-4 text-[10px] flex items-center justify-center border-b-2 border-gray-700">
                        <span class="font-bold">HIGHEST POSSIBLE SCORE</span>
                    </div>
                </div>
            </div>
            <div class="w-2/6 border-0 border-l-2 border-gray-700 text-[13px]">
                <div class="w-full">
                    <div class="h-[48px] flex items-center justify-center border-b-2 border-gray-700">
                        <span class="font-bold">WRITTEN WORKS (30%)</span>
                    </div>
                    <div class="w-full h-4 border-b-2 border-gray-700 flex items-center justify-between">
                        <div class="w-full h-4 border-b-2 border-gray-700 flex items-center">
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                            <div class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                                <span class="font-bold">1</span>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="w-10 border-r-2 border-gray-700"></div>
                            <div class="w-10 border-r-2 border-gray-700"></div>
                            <div class="w-10"></div>
                        </div>

                    </div>
                    <div class="w-full h-4 text-[10px] flex items-center justify-center border-b-2 border-gray-700">

                    </div>
                </div>
            </div>
            <div class="w-2/6 border-0 border-l-2 border-gray-700"></div>
            <div class="w-1/4 border-0 border-x-2 border-gray-700"></div>
        </div>
    </div>
</div>

