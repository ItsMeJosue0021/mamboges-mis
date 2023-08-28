<div id="written" class="w-full ">

    <x-wr-config :evaluations="$evaluations" />

    <form action="{{ route('score.store') }}" method="POST"> 
        @csrf
        <input name="criteria_id" type="hidden" value="{{$evaluations->first()->id}}">

        <div class="w-full border-l border-gray-400">
            {{-- row 2 --}}
            <div class="w-full flex border-t border-b  border-gray-400 bg-gray-100">
                <div class="w-1/4 flex justify-start items-center px-2 py-2 border-r border-gray-400">
                    <p class="poppins text-sm">ACTIVITY NO.</p>
                </div>
                
                <div class="w-3/4 flex justify-between border-gray-400">
                    <div class="flex">
                        @foreach ($activities as $index => $activity)
                            <x-wr-activity-number :number="$index + 1"/>
                        @endforeach
                    </div>

                    <div class="flex">
                        <div class="w-[60px] flex justify-center items-center border-r border-l border-gray-400">
                            <p class="poppins text-xs font-medium">TOTAL</p>
                        </div>
                        <div class="w-[60px] flex justify-center items-center border-r border-gray-400">
                            <p class="poppins text-xs font-medium">PS</p>
                        </div>
                        <div class="w-[60px] flex justify-center items-center border-r border-gray-400">
                            <p class="poppins text-xs font-medium">WS</p>
                        </div>
                    </div>  
                </div>
            
            </div>

            {{-- row 3 --}}
            <div class="w-full flex justify-start border-t border-b border-gray-300 bg-gray-200">
                <div class="w-1/4 flex justify-start items-center px-2 py-2 border-r  border-gray-400">
                    <p class="poppins text-sm">HIGHEST POSSIBLE SCORE</p>
                </div>
                <div class="w-3/4 flex justify-between">
                    <div class="flex">
                        @php
                            $total_score = 0;
                        @endphp
                        @foreach ($activities as $activity)
                            <x-wr-highest-possible-score :activity="$activity" />
                            @php
                                $total_score +=  $activity->max_score;
                            @endphp
                        @endforeach
                    </div>

                    <div class="flex">
                        <div class="w-[60px] flex justify-center items-center border-r border-l border-gray-400">
                            <p class="poppins font-semibold text-xs">{{$total_score}}</p>
                        </div>
                        <div class="w-[60px] flex justify-center items-center border-r border-gray-400">
                            <p class="poppins font-semibold text-xs">100%</p>
                        </div>
                        <div class="w-[60px] flex justify-center items-center border-r border-gray-400">
                            <p id="percentageValue" class="percentageValue poppins font-semibold text-xs">{{$evaluations->first()->percentage}}%</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- row 4 --}}
            <div>                      
                @foreach ($students as $student)          
                    <x-wr-student-row :student="$student" :activities="$activities" :evaluations="$evaluations" :totalscore="$total_score"/> {{--:activities="$activities"--}}
                @endforeach
            </div>

        </div>
        <div class="w-full space-x-4 flex items-center mt-4">
            <button type="submit" class="poppins text-sm text-white bg-blue-800 hover:bg-[#004080] border border-[#004080] py-2 px-6 rounded">Save</button>
            <a href="{{ route('class.record', $classrecord->id) }}" class="poppins text-sm text-black bg-gray-200 hover:bg-gray-300 border border-gray-200 py-2 px-6 rounded">Refresh</a>
        </div>
    </form>
</div>