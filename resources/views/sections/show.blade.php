<x-guidance-layout>
    <div id="container" class="w-full flex flex-col p-4 pb-0 relative h-auto min-h-screen">
        <div class="pb-2">
            <a id="back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/sections">
                <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
            </a>
        </div>
        <div class="w-full h-auto min-h-600px flex flex-col items-start justify-start space-y-2">
            <div class=" get-id w-full h-auto flex justify-between items-start border border-blue-400 rounded p-3 bg-blue-50 " id="{{$section->id}}">
                <div class="w-full flex justify-between">
                    <div class="flex flex-col space-y-1">
                        <div class="flex space-x-2 items-start">
                            <h1 class="poppins text-4xl font-medium text-gray-700">{{$section->name}}</h1>
                        </div>
                        <h2 class="poppins text-lg text-gray-600">
                            @if ($section->adviser_faculty_id && $adviser->has($section->adviser_faculty_id))
                                {{ optional($adviser[$section->adviser_faculty_id])->suffix }} 
                                {{ optional($adviser[$section->adviser_faculty_id])->first_name }} 
                                {{ optional($adviser[$section->adviser_faculty_id])->last_name}}
                            @else
                                <span class="poppins text-xs text-red-500">No adviser yet.</span>
                            @endif
                        </h2>
                        <div class="flex space-x-4">
                            <h2 class="poppins text-sm text-white bg-blue-400 rounded px-2 w-fit">
                                @if ($section->grade_level == 0)
                                    Kinder
                                @else
                                    Grade {{ $section->grade_level }}
                                @endif
                            </h2>
                            <h3 class="poppins text-sm font-medium text-gray-600">S.Y. {{$school_year->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col bg-blue-50 border border-blue-500 justify-center items-center py-6 px-8 h-full rounded">
                    <h1 id="student-count" class="poppins text-blue-500 text-5xl font-bold"></h1>
                    <h1 class="poppins text-blue-500 text-xs font-bold">STUDENTS</h1>
                </div>
            </div>

            <div class="w-full">
                <div class="w-full flex space-x-8 py-2">
                    <div class="w-full flex items-center space-x-4 border-b border-gray-400 py-1">
                        <h1 class="poppins text-lg text-gray-700 font-medium px-2 py-1 rounded border-l-3 border-gray-400">STUDENTS</h1>
                        <a id="add-student" class="poppins px-2 text-xs text-white font-medium rounded cursor-pointer flex items-center bg-blue-500">
                            <i class='bx bx-user-plus text-base px-1'></i>
                            Add
                        </a>
                    </div>

                    <div class="w-full flex items-center space-x-4 border-b border-gray-400 py-1">
                        <h1 class="poppins text-lg text-gray-700 font-medium px-2 py-1 rounded border-l-3 border-gray-400">SUBJECTS</h1>
                        <a id="add-subject" class="poppins px-2 text-xs text-white font-medium rounded cursor-pointer flex items-center bg-blue-500">
                            <i class='bx bx-list-plus text-base px-1'></i>
                            Add
                        </a>
                    </div>
                </div>

                <div class="w-full flex space-x-8">
                    <div id="students-list1" class="w-full h-auto">
                    
                    </div>

                    <div id="subjects-list" class="w-full h-auto">
                        
                    </div>
                </div>
            </div>
        </div>

        {{-- ADD STUDENT MODAL --}}
        <div id="add-student-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center space-y-6  bg-black bg-opacity-5 pt-8"> 
                <div class="flex flex-col w-fit bg-white p-6 rounded-md shadow-2xl">
                    <div class="w-fit flex flex-col">
                        <div class=" flex space-x-4 mb-6">
                            <div class="">
                                <div class="flex space-between">
                                    <input type="text" name="search-student" id="search-student" class="poppins w-700px py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 mr-3" placeholder="Seach for student.."/>
                                </div>
                            </div>
                            <div>
                                <h1 class="poppins text-base py-2 font-medium">Current Student</h1>
                            </div>

                        </div>
    
                        <div class="flex space-x-4">
                            <div class="w-700px h-400px overflow-auto">
                                <div id="students-container">
                                    
                                </div>
                            </div>
                            <div id="students-list2" class="w-400px h-400px overflow-auto">
                                
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-start space-x-4 pt-4 ">
                        <button id="done" 
                            class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                            Done
                        </button>
    
                        <a id="add-cancel"
                            class="poppins text-base font-medium text-gray-400 border border-gray-400 hover:border-red-600 hover:text-red-600 py-2 px-6 rounded cursor-pointer">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>

         {{-- ADD SUBJECT MODAL --}}
         <div id="add-subject-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-start space-y-6 bg-black bg-opacity-5 pt-40">
                <div class="flex flex-col w-fit items-center justify-center space-y-6 bg-white p-6 rounded-md shadow-lg">
                    {{-- action="javascript:void(0)" /sections/{{$section->id}}--}}
                    <form id="add-subject-form" method="POST" action="javascript:void(0)" class="w-700px flex flex-col space-y-3">
                        @csrf
                        <div class="w-full flex">
                            <h1 class="poppins text-xl text-gray-800 font-medium">ADD SUBJECTS</h1>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="subject"
                                class="poppins text-sm font-medium text-gray-600">SUBJECT</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="subject" id="subject"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option disabled selected value="">Select a Subject</option>
                                @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="teacher"
                                class="poppins text-sm font-medium text-gray-600">SUBJECT TEACHER</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="teacher" id="teacher"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option disabled selected value="">Select a Teacher</option>    
                                @foreach ($faculties as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->suffix}} {{$teacher->first_name}} {{$teacher->last_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-start space-x-4 pt-4 ">
                            <button id="add-subject-button" type="submit" 
                                class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                                Add 
                            </button>
        
                            <a id="add-subject-cancel"
                                class="poppins text-base font-medium text-gray-400 border border-gray-400 hover:border-red-600 hover:text-red-600 py-2 px-6 rounded cursor-pointer">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guidance-layout>

<script type="module"  src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script type="module"  src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="module" src="{{ asset('js/section_fetch_student.js') }}"></script>
