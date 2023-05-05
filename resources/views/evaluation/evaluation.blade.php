<x-guidance-layout>
    <section class="w-full flex items-start">
        <div class="w-full h-660px flex items-start p-2 overflow-auto">
            <form action="" class="w-full">
                <div class="w-full border border-gray-400">
                    {{-- row 1 --}}
                    <div class="w-full flex justify-between bg-gray-200">
                        <div class="w-1/4 flex justify-center items-center border-r boder-l border-gray-400 py-6">
                            <h1 class="poppins text-base font-medium">LEARNERS' NAMES</h1>
                        </div>
                        <div class="w-3/4 ">
                            {{-- loop the table evaluation --}}
                            <div class="flex">
                                <div class="flex justify-center items-center  w-full border-r boder-l border-gray-400 py-6">
                                    <div class="flex flex-col justify-center items-center space-x-2">
                                        <h1 class="poppins text-base font-medium">WRITTEN WORKS</h1>
                                        <span class="poppins text-base font-medium">20%</span>
                                    </div>
                                </div>
                                <div class="flex justify-center items-center w-full border-r boder-l border-gray-400 py-6">
                                    <div class="flex flex-col justify-center items-center space-x-2">
                                        <h1 class="poppins text-base font-medium">PERFORMANCE TASKS</h1>
                                        <span class="poppins text-base font-medium">60%</span>
                                    </div>
                                </div>
                                <div class="flex justify-center items-center w-full border-r boder-l border-gray-400 py-6">
                                    <div class="flex flex-col justify-center items-center space-x-2">
                                        <h1 class="poppins text-base font-medium">QUARTERLY</h1>
                                        <h1 class="poppins text-base font-medium">ASSESSMENT</h1>
                                        <span class="poppins text-base font-medium">20%</span>
                                    </div>
                                </div>

                                <div class="flex justify-center items-center w-full border-r boder-l border-gray-400 py-6">
                                    <div class="flex space-x-2">
                                        <h1 class="poppins text-base font-medium">INITIAL GRADE</h1>
                                    </div>
                                </div>

                                <div class="flex justify-center items-center w-full border-r boder-l border-gray-400 py-6">
                                    <div class="flex space-x-2">
                                        <h1 class="poppins text-base font-medium">FINAL GRADE</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- row 2 --}}
                    <div class="w-full flex border-t border-b border-gray-400 bg-gray-100">
                        <div class="w-1/4 flex justify-center items-center py-2 border-r border-gray-400">
                            <p class="poppins text-base">ACTIVITY NO.</p>
                        </div>
                        
                        <div class="w-3/4 flex justify-between border-gray-400">
                            <div class="flex">
                                    {{-- loop the table activity and show the max score each --}}
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">1</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r  border-gray-400">
                                    <p class="poppins">2</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r  border-gray-400">
                                    <p class="poppins">3</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r  border-gray-400">
                                    <p class="poppins">4</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r  border-gray-400">
                                    <p class="poppins">5</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r  border-gray-400">
                                    <p class="poppins">6</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r  border-gray-400">
                                    <p class="poppins">7</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r  border-gray-400">
                                    <p class="poppins">8</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r  border-gray-400">
                                    <p class="poppins">9</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r  border-gray-400">
                                    <p class="poppins">10</p>
                                </div>
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
                            <p class="poppins text-base">HIGHEST POSSIBLE SCORE</p>
                        </div>
                        <div class="w-3/4 flex justify-between">
                            <div class="flex">
                                {{-- loop the table activity and show the max score each --}}
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                                <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                    <p class="poppins">20</p>
                                </div>
                            </div>
                        </div>
                    </div>














                    {{-- row 4 --}}
                    <div>
                        {{-- loop the table student --}}
                        {{-- @for ($i = 0; $i < 20; $i++) --}}
                        @foreach ($students as $student)
                            
                        <div class="flex justify-start border-t border-b border-gray-400">
                            
                                    {{-- name --}}
                            <div class="w-1/4 flex justify-start items-center py-1 border-r border-gray-400">
                                <div class="flex space-x-2 px-2">
                                    <p class="poppins text-base">{{$student->last_name}},</p>
                                    <p class="poppins text-base">{{$student->first_name}}</p>
                                    <p class="poppins text-base">{{ substr($student->middle_name, 0, 1) }}.</p>
                                </div>
                            </div>
                            {{-- activities --}}
                            <div class="w-3/4 flex justify-between">
                                <div class="flex overflow-hidden"> 
                                    {{-- loop the table activities for each students --}}
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    <div class="w-60px justify-start border-r border-gray-400">
                                        <input class="w-full h-full poppins appearance-none px-5" type="number" name="score" placeholder="20">
                                    </div>
                                    
                                </div>

                                <div class="flex bg-gray-200">
                                    <div class="w-60px flex justify-center items-center border-r border-l border-gray-400">
                                        <p class="poppins">20</p>
                                    </div>
                                    <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                        <p class="poppins">20</p>
                                    </div>
                                    <div class="w-60px flex justify-center items-center border-r border-gray-400">
                                        <p class="poppins">20</p>
                                    </div>
                                </div>
                            </div> 

                        </div>
                        {{-- @endfor --}}
                        @endforeach
                    </div>

                </div>

                <div class="w-full flex items-center py-4">
                    <button type="submit" class="poppins text-base text-white bg-red-500 hover:bg-red-700 border border-red-500 hover:border-red-700 py-2 px-10 rounded">Save</button>
                </div>
            </form>
        </div>
    </section>
</x-guidance-layout>