<button id="printButton" onclick="printClassRecord()" class="my-4 text-sm bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 flex items-center poppins">
    <i class='bx bx-printer text-white text-lg mr-2'></i> Print
</button>
<div id="class-record" class="w-full mb-10 old-english">
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
                            <input type="text" disabled
                                class="w-[133.5px] h-6 text-center text-[12px] p-0 border border-b-0 border-gray-700 placeholder:text-center"
                                value="IV-A">
                        </div>
                        <div>
                            <span class="font-bold text-[13px]">DIVISION</span>
                            <input type="text" disabled
                                class="w-[180px] h-6 text-center text-[12px] p-0 border border-b-0 border-gray-700 placeholder:text-center"
                                value="BACOOR CITY">
                        </div>
                    </div>
                    <div class="w-full flex items-start justify-end">
                        <div class="w-full flex space-x-1 items-center justify-end">
                            <span class="font-bold text-[13px]">SCHOOL NAME</span>
                            <input type="text" disabled
                                class="w-[423px] h-6 text-center text-[12px] p-0 border border-gray-700 placeholder:text-center" value="MAMBOG ELEMENTARY SCHOOL">
                        </div>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col">
                    <div class="w-full h-full flex items-end justify-end space-x-12">
                        <div>
                            <span class="font-bold text-[13px]">SCHOOL ID</span>
                            <input type="text" disabled
                                class="w-[200px] h-6 text-center text-[12px] p-0 border- border-gray-700 placeholder:text-center" value="107873">
                        </div>
                        <div>
                            <span class="font-bold text-[13px]">SCHOOL YEAR</span>
                            <input type="text" disabled
                                class="w-[180px] h-6 text-center text-[12px] p-0 border border-gray-700 placeholder:text-center" value="{{ $schoolYear }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-20"></div>
    </div>
    <div class="w-full flex">
        <div class="min-w-[20%] w-1/5 h-6 border-2 border-r-0 border-gray-700 flex items-center justify-center text-[10px]">
            <span class="font-bold uppercase">{{ $classrecord->quarter->name }}</span>
        </div>
        <div
            class="w-1/4 h-6 border-2 border-r-0 border-gray-700 flex items-center justify-center space-x-12 text-[10px]">
            <span class="font-bold">GRADE & SECTION:</span>
            <span class="uppercase">
                {{ $classrecord->grade }} - {{ $classrecord->section }}
            </span>
        </div>
        <div
            class="w-2/6 h-6 border-2 border-r-0 border-gray-700 flex items-center justify-center space-x-12 text-[10px]">
            <span class="font-bold">TEACHER:</span>
            <span class="uppercase">
                {{ $class->faculty->user->profile->firstName }}
                {{ $class->faculty->user->profile->middleName }}
                {{ $class->faculty->user->profile->lastName }}
            </span>
        </div>
        <div class="w-2/6 h-6 border-2 border-gray-700 flex items-center justify-center space-x-12 text-[10px]">
            <span class="font-bold">SUBJECT:</span>
            <span class="uppercase">{{ $classrecord->subject }}</span>
        </div>
    </div>
    <div class="w-full flex">
        <div class="min-w-[20%] w-1/5 flex border-0 border-l-2 border-gray-700">
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
                    <span class="font-bold text-[11px]">WRITTEN WORKS ({{ $evaluations->first()->percentage}}%)</span>
                </div>
                <div class="w-full h-4 border-b-2 border-gray-700 flex items-center justify-between">
                    <div class="h-4 border-gray-700 flex items-center">
                        @for ($i = 0; $i < 10; $i++)
                            <div
                                class="w-8 h-4 text-[10px] flex items-center justify-center @if ($i == 9) border-r-2 @else border-r @endif border-gray-700">
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
                                $activityIndex = $i;
                                $currentActivity = isset($wrActivities[$activityIndex]) ? $wrActivities[$activityIndex] : null;
                                $isLastIteration = $i == 9;
                                $wr_total += $currentActivity->max_score ?? 0;
                            @endphp

                            <div
                                class="w-8 h-4 text-[10px] flex items-center justify-center @if ($isLastIteration) border-r-2 @else border-r @endif border-gray-700">
                                <span class="font-bold">{{ $currentActivity->max_score ?? '' }}</span>
                            </div>
                        @endfor
                    </div>

                    <div class="flex items-center">
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold">{{ $wr_total }}</span>
                        </div>
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold">100.00</span>
                        </div>
                        <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                            <span class="font-bold">{{ $evaluations->first()->percentage }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-2/6 border-0 border-l-2 border-gray-700 ">
            <div class="w-full">
                <div class="h-[48px] flex items-center justify-center border-b-2 border-gray-700">
                    <span class="font-bold text-[11px]">PERFORMANCE TASKS ({{ $evaluations->skip(1)->first()->percentage}}%)</span>
                </div>
                <div class="w-full h-4 border-b-2 border-gray-700 flex items-center justify-between">
                    <div class="h-4 border-gray-700 flex items-center">
                        @for ($i = 0; $i < 10; $i++)
                            <div
                                class="w-8 h-4 text-[10px] flex items-center justify-center @if ($i == 9) border-r-2 @else border-r @endif border-gray-700">
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
                            $activityCount = count($ptActivities);
                            $pt_total = 0;
                        @endphp

                        @for ($i = 0; $i < 10; $i++)
                            @php
                                $activityIndex = $i;
                                $currentActivity = isset($ptActivities[$activityIndex]) ? $ptActivities[$activityIndex] : null;
                                $isLastIteration = $i == 9;
                                $pt_total += $currentActivity->max_score ?? 0;
                            @endphp

                            <div
                                class="w-8 h-4 text-[10px] flex items-center justify-center @if ($isLastIteration) border-r-2 @else border-r @endif border-gray-700">
                                <span class="font-bold">{{ $currentActivity->max_score ?? '' }}</span>
                            </div>
                        @endfor
                    </div>

                    <div class="flex items-center">
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold">{{ $pt_total }}</span>
                        </div>
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold">100.00</span>
                        </div>
                        <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                            <span class="font-bold">{{ $evaluations->skip(1)->first()->percentage }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/4 border-0 border-x-2 border-gray-700 flex items-start ">
            <div class="w-auto">
                <div
                    class="h-[48px] flex flex-col items-center justify-center border-b-2 border-gray-700 text-[11px]">
                    <span class="font-bold text-center">QUARTERLY</span>
                    <span class="font-bold text-center">ASSEMENT</span>
                    <span class="font-bold text-center">({{ $evaluations->skip(2)->first()->percentage}}%)</span>
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
                        <span class="font-bold">{{ $qaActivities->first()->max_score ?? '0'}}</span>
                    </div>
                    <div class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                        <span class="font-bold">100.00</span>
                    </div>
                    <div class="w-10 h-4 text-[10px] flex items-center justify-center">
                        <span class="font-bold">{{$evaluations->skip(2)->first()->percentage}}%</span>
                    </div>
                </div>
            </div>
            <div
                class="w-full h-full border-x-2 border-b-2 border-gray-700 text-[10px] flex flex-col items-center justify-center space-y-4">
                <span>Initial</span>
                <span>Grade</span>
            </div>
            <div
                class="w-full h-full text-[10px] border-b-2 border-gray-700 flex flex-col items-center justify-center space-y-4">
                <span>Quarterly</span>
                <span>Grade</span>
            </div>
        </div>
    </div>

    <div class="w-full flex bg-gray-200">
        <div class="min-w-[20%] w-1/5 flex border-0 border-l-2 border-gray-700">
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
                        <div
                            class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                            <span class="font-bold"></span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold"></span>
                        </div>
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
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
                        <div
                            class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                            <span class="font-bold"></span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold"></span>
                        </div>
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
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
            <div
                class="w-full h-4 border-x-2 border-b-2 border-gray-700 text-[10px] flex flex-col items-center justify-center space-y-4">
                <span></span>
            </div>
            <div
                class="w-full h-4 text-[10px] border-b-2 border-gray-700 flex flex-col items-center justify-center space-y-4">
                <span></span>
            </div>
        </div>
    </div>

    @php
        $male = [];
        $female = [];

        foreach ($students as $key => $student) {
            if ($student->user->profile->sex == 'Male') {
                array_push($male, $student);
            } else {
                array_push($female, $student);
            }
        }
    @endphp

    @foreach ($male as $student)
        <x-class-record-student :loop="$loop" :student="$student" :evaluations="$evaluations" :classrecord="$classrecord"
            :wrActivities="$wrActivities" :ptActivities="$ptActivities" :qaActivities="$qaActivities" />
    @endforeach

    <div class="w-full flex bg-gray-200">
        <div class="min-w-[20%] w-1/5 flex border-0 border-l-2 border-gray-700">
            <div class="w-6 h-4 border-b-2 border-r-2 border-gray-700 flex items-center justify-center">
                <span class="text-[10px] h-4 "></span>
            </div>
            <div class="w-full">
                <div class="w-full h-4 text-[10px] flex items-center justify-left border-b-2 border-gray-700">
                    <span class="font-bold px-2">FEMALE</span>
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
                        <div
                            class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                            <span class="font-bold"></span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold"></span>
                        </div>
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
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
                        <div
                            class="w-8 h-4 text-[10px] flex items-center justify-center border-r-2 border-gray-700">
                            <span class="font-bold"></span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
                            <span class="font-bold"></span>
                        </div>
                        <div
                            class="w-10 h-4 text-[10px] border-r-2 border-gray-700 flex items-center justify-center">
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
            <div
                class="w-full h-4 border-x-2 border-b-2 border-gray-700 text-[10px] flex flex-col items-center justify-center space-y-4">
                <span></span>
            </div>
            <div
                class="w-full h-4 text-[10px] border-b-2 border-gray-700 flex flex-col items-center justify-center space-y-4">
                <span></span>
            </div>
        </div>
    </div>

    @foreach ($female as $student)
        <x-class-record-student :loop="$loop" :student="$student" :evaluations="$evaluations" :classrecord="$classrecord"
            :wrActivities="$wrActivities" :ptActivities="$ptActivities" :qaActivities="$qaActivities" />
    @endforeach

</div>

<script>
    function printClassRecord() {
        document.getElementById('printButton').style.display = 'none';
        // Print the document
        window.print();

        document.getElementById('printButton').style.display = 'block';
    }
</script>
