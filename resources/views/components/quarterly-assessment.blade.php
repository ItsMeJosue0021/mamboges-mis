<div id="quarterly" class="hidden w-full ">

    <x-qa-config :evaluations="$evaluations" />

    <form action="{{ route('score.store') }}" method="POST"> 
        @csrf
        <input name="criteria_id" type="hidden" value="{{$evaluations->skip(2)->first()->id}}">

        <div class="w-full border-l border-b border-gray-400 rounded-md">
            {{-- row 2 --}}
            <div class="w-full flex border-t border-b border-r  border-gray-400 bg-gray-100 rounded-t-md">
                <div class="w-1/4 flex justify-start items-center px-2 py-2 border-r border-gray-400">
                    <p class="poppins text-sm">ACTIVITY NUMBER</p>
                </div>
                
                <div class="w-3/4 flex justify-between border-gray-400">
                    <div class="flex">
                        @foreach ($activities as $index => $activity)
                            <x-activity-number :number="$index + 1"/>
                        @endforeach
                    </div>

                    <div class="flex">
                        <div class="w-[65px] flex justify-center items-center border-r border-l border-gray-400">
                            <p class="poppins text-xs font-medium">TOTAL</p>
                        </div>
                        <div class="w-[65px] flex justify-center items-center border-r border-gray-400">
                            <p class="poppins text-xs font-medium">PS</p>
                        </div>
                        <div class="w-[65px] flex justify-center items-center rounded-tr-md border-gray-400">
                            <p class="poppins text-xs font-medium">WS</p>
                        </div>
                    </div>  
                </div>
            </div>

            {{-- row 3 --}}
            <div class="w-full flex justify-start border-r border-gray-400 bg-gray-200">
                <div class="w-1/4 flex justify-start items-center px-2 py-2 border-r  border-gray-400">
                    <p class="poppins text-sm font-semibold">HIGHEST POSSIBLE SCORE</p>
                </div>
                <div class="w-3/4 flex justify-between">
                    <div class="flex">
                        @php
                            $total_score = 0;
                        @endphp
                        @foreach ($activities as $activity)
                            <x-highest-possible-score :activity="$activity" />
                            @php
                                $total_score +=  $activity->max_score;
                            @endphp
                        @endforeach
                    </div>

                    <div class="flex">
                        <div class="w-[65px] flex justify-center items-center border-r border-l border-gray-400">
                            <p class="poppins font-semibold text-sm">{{$total_score}}</p>
                        </div>
                        <div class="w-[65px] flex justify-center items-center border-r border-gray-400">
                            <p class="poppins font-semibold text-sm">100%</p>
                        </div>
                        <div class="w-[65px] flex justify-center items-center border-gray-400">
                            <p class="percentageValue_2 poppins font-semibold text-sm">{{$evaluations->skip(2)->first()->percentage}}%</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- row 4 --}}
            <div class="border-r border-gray-400 rounded-br-md">                      
                @foreach ($students as $student)          
                    <x-qa-student-row :student="$student" :activities="$activities" :evaluations="$evaluations" :totalscore="$total_score"/> {{--:activities="$activities"--}}
                @endforeach
            </div>

        </div>
        <div class="w-full space-x-4 flex items-center mt-4">
            <button type="submit" class="poppins text-sm text-white bg-blue-700 hover:bg-blue-800 border border-blue-800 py-2 px-6 rounded">Save</button>
            <button type="submit" class="poppins text-sm text-black bg-gray-200 hover:bg-gray-300 border border-gray-200 py-2 px-6 rounded">Refresh</button>
            {{-- <a href="{{ route('class.record', $classrecord->id) }}" class="poppins text-sm text-black bg-gray-200 hover:bg-gray-300 border border-gray-200 py-2 px-6 rounded">Refresh</a> --}}
        </div>
    </form>

</div>