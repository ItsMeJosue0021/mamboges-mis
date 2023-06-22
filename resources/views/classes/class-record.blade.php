<x-guidance-layout>
    <section class="w-full flex items-start relative">
        <div class="w-full h-660px flex flex-col items-start p-2 overflow-auto">
            <div class="pb-2">
                <a id="back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/classes">
                    <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                    <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
                </a>
            </div>
            <form action="" class="w-full">
                {{-- row 1 --}}
                <div class="w-full flex justify-between mb-2 space-x-2">
                    <div class="w-1/4 flex justify-center items-center py-4 bg-gray-100 border border-gray-400 rounded">
                        <h1 class="poppins text-base font-medium">LEARNERS' NAMES</h1>
                    </div>
                    <div class="w-3/4 ">
                        {{-- loop the table evaluation --}}
                        <div class="flex space-x-2">
                            <div class="flex evalnav active-eval justify-center items-center  w-full py-4 bg-gray-100 cursor-pointer hover:bg-blue-400 border border-gray-300 rounded">
                                <div class="flex flex-col justify-center items-center space-x-2">
                                    <h1 class="poppins text-sm font-medium">WRITTEN WORKS</h1>
                                    <span class="poppins text-sm font-medium ">20%</span>
                                </div>
                            </div>
                            <div class="flex evalnav justify-center items-center w-full py-4 bg-gray-100 cursor-pointer hover:bg-blue-400 border border-gray-300 rounded">
                                <div class="flex flex-col justify-center items-center space-x-2 ">
                                    <h1 class="poppins text-sm font-medium">PERFORMANCE TASKS</h1>
                                    <span class="poppins text-sm font-medium ">60%</span>
                                </div>
                            </div>
                            <div class="flex evalnav justify-center items-center w-full py-4 bg-gray-100 cursor-pointer hover:bg-blue-400 border border-gray-300 rounded">
                                <div class="flex flex-col justify-center items-center space-x-2">
                                    <h1 class="poppins text-sm font-medium">QUARTERLY</h1>
                                    <h2 class="poppins text-sm font-medium">ASSESSMENT</h2>
                                    <span class="poppins text-sm font-medium ">20%</span>
                                </div>
                            </div>

                            <div class="flex evalnav justify-center items-center w-full py-4 bg-gray-100 cursor-pointer hover:bg-blue-400 border border-gray-300 rounded">
                                <div class="flex space-x-2">
                                    <h1 class="poppins text-sm font-medium">FINAL GRADE</h1>
                                </div>
                            </div>

                            {{-- <div class="flex evalnav justify-center items-center w-full py-4 bg-gray-100 cursor-pointer hover:bg-blue-400 border border-gray-300 rounded">
                                <div class="flex space-x-2">
                                    <h1 class="poppins text-sm font-medium">FINAL GRADE</h1>
                                </div>
                            </div>  --}}
                        </div>
                    </div>
                </div>

                <div class="eval-container">
                    <div id="written" class="w-full ">
                        <div class="w-full flex items-center bg-gray-100 border border-gray-300 rounded py-1 px-2 mb-2">
                            <div class="w-full flex items-center space-x-4 rounded">
                                <div class="w-fit flex items-center space-x-4">
                                    <h1 class="poppins text-sm">WRITTEN WORKS</h1>

                                    <div class="flex items-center space-x-2">
                                        <div class="flex items-center space-x-2 rounded py-1 px-2 border border-gray-300">
                                            <input class="w-10 py-0 px-1 poppins text-sm rounded border-0 focus:outline-none" type="number" placeholder="20">
                                            <p class="poppins text-base">%</p>
                                        </div>
                                        <button class="poppins text-xs text-white bg-blue-400 p-2 rounded">CHANGE</button>
                                    </div>
                                </div>

                                <div class="w-fit h-full px-3 flex items-center space-x-4 border-l-2 border-gray-300">
                                    <h1 class="poppins text-sm">NUMBER OF ACTIVITIES</h1>
                                    <p class="poppins py-1 px-3 rounded border border-gray-300 text-sm">10</p>
                                    <a id="new-written-act" class="poppins text-xs text-white bg-green-400 p-2 rounded cursor-pointer">NEW</a>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border border-gray-400">
                            {{-- row 2 --}}
                            <div class="w-full flex border-t border-b border-gray-400 bg-gray-100">
                                <div class="w-1/4 flex justify-center items-center py-2 border-r border-gray-400">
                                    <p class="poppins text-sm">ACTIVITY NO.</p>
                                </div>
                                
                                <div class="w-3/4 flex justify-between border-gray-400">
                                    <div class="flex">
                                            {{-- loop the table activity and show the max score each --}}
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">1</p>
                                        </div>
                                        
                                        {{--  --}}

                                    </div>
    
                                    <div class="flex">
                                        <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                            <p class="poppins text-xs font-medium">TOTAL</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-xs font-medium">PS</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-xs font-medium">WS</p>
                                        </div>
                                    </div>  
                                </div>
                            
                            </div>
    
                            {{-- row 3 --}}
                            <div class="w-full flex justify-start border-t border-b border-gray-300 bg-gray-200">
                                <div class="w-1/4 flex justify-center items-center py-1 border-r  border-gray-400">
                                    <p class="poppins text-sm">HIGHEST POSSIBLE SCORE</p>
                                </div>
                                <div class="w-3/4 flex justify-between">
                                    <div class="flex">
                                        {{-- loop the table activity and show the max score each --}}
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">20</p>
                                        </div>

                                        {{--  --}}
                                        
                                    </div>
    
                                    <div class="flex">
                                        <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            {{-- row 4 --}}
                            <div>                       
                                @foreach ($students as $student)
                                    
                                <div class="flex justify-start border-t border-b border-gray-400">
                                    
                                            {{-- name --}}
                                    <div class="w-1/4 flex justify-start items-center py-1 border-r border-gray-400">
                                        <div class="flex space-x-2 px-2">
                                            <p class="poppins text-sm">{{$student->last_name}},</p>
                                            <p class="poppins text-sm">{{$student->first_name}}</p>
                                            <p class="poppins text-sm">{{ substr($student->middle_name, 0, 1) }}.</p>
                                        </div>
                                    </div>
                                    {{-- activities --}}
                                    <div class="w-3/4 flex justify-between">
                                        <div class="flex overflow-hidden"> 
                                            {{-- loop the table activities for each students --}}                                            
                                            <div class="w-60px justify-start border-r border-gray-400 focus:border-r-0">
                                                <input class="w-full h-full poppins appearance-none px-5 text-sm border-0" type="number" name="score" placeholder="20">
                                            </div>
                                            
                                            {{--  --}}
                                            
                                        </div>
    
                                        <div class="flex bg-gray-200">
                                            <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                                <p class="poppins text-sm">0</p>
                                            </div>
                                            <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                                <p class="poppins text-sm">0</p>
                                            </div>
                                            <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                                <p class="poppins text-sm">0</p>
                                            </div>
                                        </div>
                                    </div> 
    
                                </div>
                                {{-- @endfor --}}
                                @endforeach
                            </div>
                        </div>
    
                        <div class="w-full flex items-center py-4">
                            <button type="submit" class="poppins text-base text-white bg-blue-500 hover:bg-blue-700 border border-blue-500 hover:border-blue-700 py-2 px-10 rounded">Save</button>
                        </div>
                    </div>

                    <div id="pt" class="hidden w-full ">
                        <div class="w-full flex items-center bg-gray-100 border border-gray-300 rounded py-1 px-2 mb-2">
                            <div class="w-full flex items-center space-x-4 rounded">
                                <div class="w-fit flex items-center space-x-4">
                                    <h1 class="poppins text-sm">PERFORMANCE TASK</h1>

                                    <div class="flex items-center space-x-2">
                                        <div class="flex items-center space-x-2 rounded py-1 px-2 border border-gray-300">
                                            <input class="w-10 py-0 px-1 poppins text-sm rounded border-0 focus:outline-none" type="number" placeholder="60">
                                            <p class="poppins text-base">%</p>
                                        </div>
                                        <button class="poppins text-xs text-white bg-blue-400 p-2 rounded">CHANGE</button>
                                    </div>
                                </div>

                                <div class="w-fit h-full px-3 flex items-center space-x-4 border-l-2 border-gray-300">
                                    <h1 class="poppins text-sm">NUMBER OF TASKS</h1>
                                    <p class="poppins py-1 px-3 rounded border border-gray-300 text-sm">10</p>
                                    <a id="new-pt-act" class="poppins text-xs text-white bg-green-400 p-2 rounded cursor-pointer">NEW</a>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border border-gray-400">
                            {{-- row 2 --}}
                            <div class="w-full flex border-t border-b border-gray-400 bg-gray-100">
                                <div class="w-1/4 flex justify-center items-center py-2 border-r border-gray-400">
                                    <p class="poppins text-sm">ACTIVITY NO.</p>
                                </div>
                                
                                <div class="w-3/4 flex justify-between border-gray-400">
                                    <div class="flex">
                                            {{-- loop the table activity and show the max score each --}}
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">1</p>
                                        </div>
                                        
                                        {{--  --}}

                                    </div>
    
                                    <div class="flex">
                                        <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                            <p class="poppins text-xs font-medium">TOTAL</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-xs font-medium">PS</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-xs font-medium">WS</p>
                                        </div>
                                    </div>  
                                </div>
                            
                            </div>
    
                            {{-- row 3 --}}
                            <div class="w-full flex justify-start border-t border-b border-gray-300 bg-gray-200">
                                <div class="w-1/4 flex justify-center items-center py-1 border-r  border-gray-400">
                                    <p class="poppins text-sm">HIGHEST POSSIBLE SCORE</p>
                                </div>
                                <div class="w-3/4 flex justify-between">
                                    <div class="flex">
                                        {{-- loop the table activity and show the max score each --}}
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">20</p>
                                        </div>
                                        
                                        {{--  --}}


                                    </div>
    
                                    <div class="flex">
                                        <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            {{-- row 4 --}}
                            <div>
                                @foreach ($students as $student)
                                    
                                <div class="flex justify-start border-t border-b border-gray-400">
                                    
                                            {{-- name --}}
                                    <div class="w-1/4 flex justify-start items-center py-1 border-r border-gray-400">
                                        <div class="flex space-x-2 px-2">
                                            <p class="poppins text-sm">{{$student->last_name}},</p>
                                            <p class="poppins text-sm">{{$student->first_name}}</p>
                                            <p class="poppins text-sm">{{ substr($student->middle_name, 0, 1) }}.</p>
                                        </div>
                                    </div>
                                    {{-- activities --}}
                                    <div class="w-3/4 flex justify-between">
                                        <div class="flex overflow-hidden"> 
                                            {{-- loop the table activities for each students --}}                                            
                                            <div class="w-60px justify-start border-r border-gray-400 focus:border-r-0">
                                                <input class="w-full h-full poppins appearance-none px-5 text-sm border-0" type="number" name="score" placeholder="20">
                                            </div>
                                            
                                            {{--  --}}
                                            
                                        </div>
    
                                        <div class="flex bg-gray-200">
                                            <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                                <p class="poppins text-sm">0</p>
                                            </div>
                                            <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                                <p class="poppins text-sm">0</p>
                                            </div>
                                            <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                                <p class="poppins text-sm">0</p>
                                            </div>
                                        </div>
                                    </div> 
    
                                </div>
                                {{-- @endfor --}}
                                @endforeach
                            </div>
                        </div>
    
                        <div class="w-full flex items-center py-4">
                            <button type="submit" class="poppins text-base text-white bg-blue-500 hover:bg-blue-700 border border-blue-500 hover:border-blue-700 py-2 px-10 rounded">Save</button>
                        </div>
                    </div>

                    <div id="quarterly" class="hidden w-full ">
                        <div class="w-full flex items-center bg-gray-100 border border-gray-300 rounded py-1 px-2 mb-2">
                            <div class="w-full flex items-center space-x-4 rounded">
                                <div class="w-fit flex items-center space-x-4">
                                    <h1 class="poppins text-sm">QUARTERLY ASSESSMENT</h1>

                                    <div class="flex items-center space-x-2">
                                        <div class="flex items-center space-x-2 rounded py-1 px-2 border border-gray-300">
                                            <input class="w-10 py-0 px-1 poppins text-sm rounded border-0 focus:outline-none" type="number" placeholder="20">
                                            <p class="poppins text-base">%</p>
                                        </div>
                                        <button class="poppins text-xs text-white bg-blue-400 p-2 rounded">CHANGE</button>
                                    </div>
                                </div>

                                <div class="w-fit h-full px-3 flex items-center space-x-4 border-l-2 border-gray-300">
                                    <h1 class="poppins text-sm">NUMBER OF ASSESSMENT</h1>
                                    <p class="poppins py-1 px-3 rounded border border-gray-300 text-sm">10</p>
                                    <a id="new-assessment" class="poppins text-xs text-white bg-green-400 p-2 rounded cursor-pointer">NEW</a>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border border-gray-400">
                            {{-- row 2 --}}
                            <div class="w-full flex border-t border-b border-gray-400 bg-gray-100">
                                <div class="w-1/4 flex justify-center items-center py-2 border-r border-gray-400">
                                    <p class="poppins text-sm">ACTIVITY NO.</p>
                                </div>
                                
                                <div class="w-3/4 flex justify-between border-gray-400">
                                    <div class="flex">
                                            {{-- loop the table activity and show the max score each --}}
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">1</p>
                                        </div>
                                        
                                        {{--  --}}

                                    </div>
    
                                    <div class="flex">
                                        <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                            <p class="poppins text-xs font-medium">TOTAL</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-xs font-medium">PS</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-xs font-medium">WS</p>
                                        </div>
                                    </div>  
                                </div>
                            
                            </div>
    
                            {{-- row 3 --}}
                            <div class="w-full flex justify-start border-t border-b border-gray-300 bg-gray-200">
                                <div class="w-1/4 flex justify-center items-center py-1 border-r  border-gray-400">
                                    <p class="poppins text-sm">HIGHEST POSSIBLE SCORE</p>
                                </div>
                                <div class="w-3/4 flex justify-between">
                                    <div class="flex">
                                        {{-- loop the table activity and show the max score each --}}
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">20</p>
                                        </div>
                                        
                                        {{--  --}}

                                    </div>
    
                                    <div class="flex">
                                        <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                        <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            {{-- row 4 --}}
                            <div>
                                @foreach ($students as $student)
                                    
                                <div class="flex justify-start border-t border-b border-gray-400">
                                    
                                            {{-- name --}}
                                    <div class="w-1/4 flex justify-start items-center py-1 border-r border-gray-400">
                                        <div class="flex space-x-2 px-2">
                                            <p class="poppins text-sm">{{$student->last_name}},</p>
                                            <p class="poppins text-sm">{{$student->first_name}}</p>
                                            <p class="poppins text-sm">{{ substr($student->middle_name, 0, 1) }}.</p>
                                        </div>
                                    </div>
                                    {{-- activities --}}
                                    <div class="w-3/4 flex justify-between">
                                        <div class="flex overflow-hidden"> 
                                            {{-- loop the table activities for each students --}}                                            
                                            <div class="w-60px justify-start border-r border-gray-400 focus:border-r-0">
                                                <input class="w-full h-full poppins appearance-none px-5 text-sm border-0" type="number" name="score" placeholder="20">
                                            </div>
                                           
                                            {{--  --}}
                                            
                                        </div>
    
                                        <div class="flex bg-gray-200">
                                            <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                                <p class="poppins text-sm">0</p>
                                            </div>
                                            <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                                <p class="poppins text-sm">0</p>
                                            </div>
                                            <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                                <p class="poppins text-sm">0</p>
                                            </div>
                                        </div>
                                    </div> 
    
                                </div>
                                {{-- @endfor --}}
                                @endforeach
                            </div>
                        </div>
    
                        <div class="w-full flex items-center py-4">
                            <button type="submit" class="poppins text-base text-white bg-blue-500 hover:bg-blue-700 border border-blue-500 hover:border-blue-700 py-2 px-10 rounded">Save</button>
                        </div>
                    </div>

                    <div id="final" class="hidden w-full ">
                        <div class="w-full flex items-center bg-gray-100 border border-gray-300 rounded py-1 px-2 mb-2">
                            <div class="w-full flex items-center space-x-4 rounded">
                                <div class="w-fit flex items-center space-x-4">
                                    <h1 class="poppins text-sm py-2">FINAL GRADE</h1>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border border-gray-400">
                           
                            {{-- row 4 --}}
                            <div>
                                @foreach ($students as $student)
                                    
                                <div class="flex justify-between border-t border-b border-gray-400">
                                    
                                            {{-- name --}}
                                    <div class="w-1/4 flex justify-start items-center py-2 border-r border-gray-400">
                                        <div class="flex space-x-2 px-2">
                                            <p class="poppins text-sm">{{$student->last_name}},</p>
                                            <p class="poppins text-sm">{{$student->first_name}}</p>
                                            <p class="poppins text-sm">{{ substr($student->middle_name, 0, 1) }}.</p>
                                        </div>
                                    </div>

                                    <div class="flex bg-gray-200">
                                        <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                            <p class="poppins text-sm">0</p>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- <div id="final" class="hidden w-full ">
                        <div class="w-full flex items-center bg-gray-100 border border-gray-300 rounded py-1 px-2 mb-2">
                            <div class="w-full flex items-center space-x-4 rounded">
                                <div class="w-fit flex items-center space-x-4">
                                    <h1 class="poppins text-sm">FINAL GRADE</h1>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border border-gray-400"> --}}
                           
                            {{-- row 4 --}}
                            {{-- <div>
                                @foreach ($students as $student)
                                    
                                <div class="flex justify-start border-t border-b border-gray-400"> --}}
                                    
                                            {{-- name --}}
                                    {{-- <div class="w-1/4 flex justify-start items-center py-1 border-r border-gray-400">
                                        <div class="flex space-x-2 px-2">
                                            <p class="poppins text-sm">{{$student->last_name}},</p>
                                            <p class="poppins text-sm">{{$student->first_name}}</p>
                                            <p class="poppins text-sm">{{ substr($student->middle_name, 0, 1) }}.</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div> --}}
                </div>
            </form>
        </div>

        <div id="written-modal" class="hidden w-full h-full absolute top-0 left-0 flex pt-40 justify-center bg-black bg-opacity-5">
            <div class="w-96 h-fit rounded-md bg-white">
                <form class="flex flex-col space-y-3 py-4 px-6" action="">
                    <div>
                        <h1 class="poppins font-semibold">New Written Activity</h1>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="poppins text-xs" for="">TITLE</label>
                        <input class="poppins text-sm px-4 rounded" type="text">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="poppins text-xs" for="">HIGHEST POSSIBLE SCORE</label>
                        <input class="poppins text-sm px-4 rounded" type="text">
                    </div>
                    <div class="flex items-center justify-end space-x-4 pt-2">
                        <button class="poppins py-2 px-4 bg-blue-400 text-white hover:bg-blue-500 rounded">Save</button>
                        <a id="written-act-cancel" class="poppins cursor-pointer hover:text-red-500">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <div id="pt-modal" class="hidden w-full h-full absolute top-0 left-0 flex pt-40 justify-center bg-black bg-opacity-5">
            <div class="w-96 h-fit rounded-md bg-white">
                <form class="flex flex-col space-y-3 py-4 px-6" action="">
                    <div>
                        <h1 class="poppins font-semibold">New Performace Task</h1>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="poppins text-xs" for="">TITLE</label>
                        <input class="poppins text-sm px-4 rounded" type="text">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="poppins text-xs" for="">HIGHEST POSSIBLE SCORE</label>
                        <input class="poppins text-sm px-4 rounded" type="text">
                    </div>
                    <div class="flex items-center justify-end space-x-4 pt-2">
                        <button class="poppins py-2 px-4 bg-blue-400 text-white hover:bg-blue-500 rounded">Save</button>
                        <a id="pt-act-cancel" class="poppins cursor-pointer hover:text-red-500">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <div id="assessment-modal" class="hidden w-full h-full absolute top-0 left-0 flex pt-40 justify-center bg-black bg-opacity-5">
            <div class="w-96 h-fit rounded-md bg-white">
                <form class="flex flex-col space-y-3 py-4 px-6" action="">
                    <div>
                        <h1 class="poppins font-semibold">New Assessment</h1>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="poppins text-xs" for="">TITLE</label>
                        <input class="poppins text-sm px-4 rounded" type="text">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="poppins text-xs" for="">HIGHEST POSSIBLE SCORE</label>
                        <input class="poppins text-sm px-4 rounded" type="text">
                    </div>
                    <div class="flex items-center justify-end space-x-4 pt-2">
                        <button class="poppins py-2 px-4 bg-blue-400 text-white hover:bg-blue-500 rounded">Save</button>
                        <a id="assessment-cancel" class="poppins cursor-pointer hover:text-red-500">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </section>
</x-guidance-layout>

<script>
    $(document).ready(function() {

        const newWrittenActBtn = $('#new-written-act');
        const nenwWrittenActModal = $('#written-modal');
        const nreWrittenActCancel = $('#written-act-cancel');

        newWrittenActBtn.click(function() {
            nenwWrittenActModal.removeClass('hidden');
        });

        nreWrittenActCancel.click(function() {
            nenwWrittenActModal.addClass('hidden');
        });

        const newPTActBtn = $('#new-pt-act');
        const nenwPTActModal = $('#pt-modal');
        const nrePTActCancel = $('#pt-act-cancel');

        newPTActBtn.click(function() {
            nenwPTActModal.removeClass('hidden');
        });

        nrePTActCancel.click(function() {
            nenwPTActModal.addClass('hidden');
        });

        const newAssessmentBtn = $('#new-assessment');
        const nenwAssessmentModal = $('#assessment-modal');
        const assessmentCancel = $('#assessment-cancel');

        newAssessmentBtn.click(function() {
            nenwAssessmentModal.removeClass('hidden');
        });

        assessmentCancel.click(function() {
            nenwAssessmentModal.addClass('hidden');
        });


         $(".evalnav").click(function() {

             $(".evalnav").removeClass("active-eval");
             $(this).addClass("active-eval");
 
             if ($(this).find("h1").text() === "WRITTEN WORKS") {

                $("#pt").addClass("hidden");
                $("#quarterly").addClass("hidden");
                $("#initial").addClass("hidden");
                $("#final").addClass("hidden");
                $("#written").removeClass("hidden");

             } else if ($(this).find("h1").text() === "PERFORMANCE TASKS") {

                $("#written").addClass("hidden");
                $("#quarterly").addClass("hidden");
                $("#initial").addClass("hidden");
                $("#final").addClass("hidden");
                $("#pt").removeClass("hidden");

             }  else if ($(this).find("h1").text() === "QUARTERLY") {

                $("#pt").addClass("hidden");
                $("#written").addClass("hidden");
                $("#initial").addClass("hidden");
                $("#final").addClass("hidden");
                $("#quarterly").removeClass("hidden");

            // } else if ($(this).find("h1").text() === "INITIAL GRADE") {

            //     $("#pt").addClass("hidden");
            //     $("#quarterly").addClass("hidden");
            //     $("#written").addClass("hidden");
            //     $("#final").addClass("hidden");
            //     $("#initial").removeClass("hidden");

            } else if ($(this).find("h1").text() === "FINAL GRADE") {

                $("#pt").addClass("hidden");
                $("#quarterly").addClass("hidden");
                $("#initial").addClass("hidden");
                $("#written").addClass("hidden");
                $("#final").removeClass("hidden");

            }
         });
     });
 
 </script>