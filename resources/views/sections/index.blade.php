<x-guidance-layout>
    <div id="container" class="w-full relative">

        <div class="flex justify-between items-center px-4 py-4 border-b border-gray-300">
            <div class="flex border-l-4 border-red-400 py-1 px-2">
                <h1 class="poppins text-2xl font-medium">SECTIONS</h1>
            </div>
            <div class="w-2/3 flex">
                <form action="/sections" class="flex w-full justify-end space-x-4">
                    <input name="search" type="text" placeholder="Search for section name" 
                    class="w-500px poppins text-sm focus:outline-none focus:bg-blue-100 border border-gray-400 rounded focus:border-blue-400 py-2 px-4">
                    <button type="submit" class="poppins text-sm bg-white text-blue-600 border border-blue-600 rounded py-2 px-6">Search</button>
                    <a id="add" class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">Add Section</a>
                </form>
            </div>
            {{-- <div class="flex">
                <button id="add" class="poppins py-2 px-4 bg-blue-500 text-white font-medium rounded hover:bg-blue-600">Add Section</button>
            </div> --}}
        </div>

        <div class="h-700px px-4 overflow-auto w-full">
            {{-- <div class="h-full flex flex-col"> --}}
                <a class="w-full flex">
                    <div class="w-full flex justify-between py-1 px-4 border-b border-gray-300 items-center">
                        <p class="w-full poppins text-lg font-semibold">SECTION</p>
                        <p class="w-full poppins text-lg font-semibold">GRADE</p>
                        <p class="w-full poppins text-lg font-semibold">SECTION ADVISER</p>

                        <div class="flex items-center space-x-2 h-fit">
                            <i class='bx bx-trash text-gray-500 text-xl py-1 px-2 bg-red-50' ></i>
                            <i class='bx bx-edit text-gray-500 text-xl py-1 px-2  bg-blue-50'></i>
                        </div>
                    </div>
                </a>
            @if(count($sections) == 0)
                <div class="w-full h-96 flex flex-col items-center justify-center mt-20">
                    <img class="h-60 w-60" src="{{asset('image/search.png')}}" alt="">
                    <p class="poppins text-xl  text-red-500 mt-5">Oops! No result found.</p>
                    <a class="poppins text-xm text-blue-500 underline" href="/sections">refresh</a>
                </div>
            @endif

            @foreach ($sections as $section)
                <a href="/sections/{{$section->id}}" class="w-full flex ">
                    <div class="flex justify-between py-1 px-4 border-b border-gray-300 items-center group hover:bg-blue-50">
                        <p class="w-full poppins text-base font-medium group-hover:text-blue-500">
                            @if ($section->name)
                                {{ $section->name }}
                            @else
                                <span class="poppins text-xs text-red-500 group-hover:text-blue-500">Section name already taken</span>
                            @endif
                        </p>
                        <p class="w-full poppins text-base group-hover:text-blue-500"> 
                            @if ($section->grade_level == 0)
                                Kinder
                            @else
                                Grade {{ $section->grade_level }}
                            @endif
                        </p>
                
                        <p class="w-full poppins text-base group-hover:text-blue-500">
                            @if ($section->adviser_faculty_id && $advisers->has($section->adviser_faculty_id))
                                {{ optional($advisers[$section->adviser_faculty_id])->suffix }} 
                                {{ optional($advisers[$section->adviser_faculty_id])->first_name }} 
                                {{ optional($advisers[$section->adviser_faculty_id])->last_name }}
                            @else
                            <span class="poppins text-xs text-red-500 group-hover:text-blue-500">Adviser already taken</span>
                            @endif
                        </p>
                
                        <div class="flex items-center h-fit">
                            <a class="show-delete-modal pr-2" data-section-id="{{$section->id}}">
                                <i class='bx bx-trash text-red-500 text-xl rounded hover:bg-red-50 cursor-pointer py-1 px-2' ></i>
                            </a>
                            {{-- href="/sections/{{$section->id}}/edit" --}}
                            <a id="edit_btn" class="edit-btn " data-section-id="{{$section->id}}">
                                <i class='bx bx-edit text-blue-500 text-xl cursor-pointer rounded hover:bg-blue-50 py-1 px-2'></i>
                            </a>
                        </div>
                    </div>
                </a>
            @endforeach
        <div>

        {{-- MODAL FOR ADDING NEW SECTION --}}
        <div id="add-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-center space-y-6 bg-black bg-opacity-5">
                <div class="flex flex-col w-fit items-center justify-center space-y-6 bg-white p-6 rounded-md shadow-lg">
                    {{-- action="javascript:void(0)" --}}
                    <form id="section-form" method="POST" action="javascript:void(0)" class="w-700px flex flex-col space-y-3">
                        @csrf
                        <div class="w-full flex">
                            <h1 class="poppins text-xl text-gray-800 font-medium">ADD SECTION</h1>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="name"
                                class="poppins text-sm font-medium text-gray-600">SECTION</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="name" id="name"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="Section Name">
                        </div>

                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="grade_level"
                                class="poppins text-sm font-medium text-gray-600">GRADE LEVEL</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="grade_level" id="grade_level"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option disabled selected value="">Select Grade Level</option>
                                <option value="0">Kinder</option>
                                <option value="1">Grade 1</option>
                                <option value="2">Grade 2</option>
                                <option value="3">Grade 3</option>
                                <option value="4">Grade 4</option>
                                <option value="5">Grade 5</option>
                                <option value="6">Grade 6</option>
                            </select>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="adviser"
                                class="poppins text-sm font-medium text-gray-600">ADVISER</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="adviser" id="adviser"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option disabled selected value="">Select Adviser</option>    
                                @foreach ($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->suffix}} {{$teacher->first_name}} {{$teacher->last_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-start space-x-4 pt-4 ">
                            <button type="submit" 
                                class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                                Save
                            </button>
        
                            <a id="add-cancel"
                                class="poppins text-base font-medium text-gray-400 border border-gray-400 hover:border-red-600 hover:text-red-600 py-2 px-6 rounded cursor-pointer">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- EDIT MODAL --}}
        <div id="edit-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-center space-y-6 bg-black bg-opacity-5">
                <div class="flex flex-col w-fit items-center justify-center space-y-6 bg-white p-6 rounded-md shadow-lg">
                    <form id="edit-section-form" method="POST" action="javascript:void(0)"  class="w-700px flex flex-col space-y-3">
                        {{-- action="javascript:void(0)" --}}
                        @csrf
                        @method('PUT')
                        <div class="w-full flex">
                            <h1 class="poppins text-xl text-gray-800 font-medium">EDIT SECTION</h1>
                        </div>
                        {{-- id="{{$sections->id}}" --}}
                        <div class="get-id flex flex-col space-y-1" id="edit-section-id"> 
                            <div class="flex items-baseline space-x-2">
                                <label for="name"
                                class="poppins text-sm font-medium text-gray-600">SECTION</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            {{-- value="{{$sections->name}}" --}}
                            <input type="text" name="name" id="edit-name" 
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="Section Name">
                        </div>
                    
                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="grade_level"
                                class="poppins text-sm font-medium text-gray-600">GRADE LEVEL</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="grade_level" id="edit-grade_level" 
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option disabled selected value="">Select Grade Level</option>
                                <option value="0" >Kinder</option>
                                <option value="1" >Grade 1</option>
                                <option value="2" >Grade 2</option>
                                <option value="3" >Grade 3</option>
                                <option value="4" >Grade 4</option>
                                <option value="5" >Grade 5</option>
                                <option value="6" >Grade 6</option>
                            </select>
                        </div>
                    
                    
                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="adviser"
                                class="poppins text-sm font-medium text-gray-600">ADVISER</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="adviser" id="edit-adviser" 
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option disabled selected value="">Select Adviser</option>    
                                @foreach ($all_teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->suffix }} {{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="flex items-center justify-start space-x-4 pt-4 ">
                            <button type="submit" 
                                class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                                Update
                            </button>
                    
                            <a id="edit-cancel"
                                class="poppins text-base font-medium text-gray-400 border border-gray-400 hover:border-red-600 hover:text-red-600 py-2 px-6 rounded cursor-pointer">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="py-2 pt-4 px-8">
                <a id="edit-back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/sections">
                    <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                    <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
                </a>
            </div> --}}

        </div>

        
        <div id="delete-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-center space-y-6 bg-black bg-opacity-5">
                <div class="flex flex-col p-4 rounded-md bg-white shadow-lg space-y-2" id="delete-section-id">
                    <div class="flex space-x-2">
                        <i class='bx bx-trash text-red-500 text-xl  cursor-pointer ' ></i>
                        <h1 class="poppins text-lg font-medium">Delete Section</h1>
                    </div>
                    <h1 class="poppins ">Are you sure you want to delete this Section?</h1>
                    <div class="flex justify-end space-x-2 pt-4">
                        <button id="delete-cancel" class="poppins text-gray-700 bg-gray-200 rounded px-3 py-1 hover:bg-gray-300">Cancel</button>
                        <button class="delete-btn poppins text-white bg-red-500 rounded px-3 py-1">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</x-guidance-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('js/section_index.js') }}"></script>



 {{-- <form id="csv-form" action="javascript:void(0)" class="py-4 border-t border-gray-300" method="POST" enctype="multipart/form-data">
    @csrf
    <p class="poppins text-base mb-2 text-gray-800">Or you can upload a CSV file instead</p> 
    <div class="w-500px flex justify-between border border-green-300 rounded py-3 px-2 bg-green-50">
        <div  class="flexl">
            <label>
                <input name="csv" type="file" id="csv" class="poppins text-sm mr-2
                file:mr-5 file:py-3 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-medium
                file:bg-green-200 file:text-green-600 
                hover:file:cursor-pointer"/>
            </label>
        </div>

        <button type="submit" 
            class="poppins text-base font-medium text-white bg-green-500 hover:bg-green-600  border border-blue-100 py-2 px-6 rounded-md">
            Upload
        </button>
    </div>
    <span class="error poppins text-red-500 text-sm"></span>
    </form> --}}

