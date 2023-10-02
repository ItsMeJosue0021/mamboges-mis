<x-guidance-layout>
    <div id="container" class="w-full relative">

        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-300">
            <h1 class="poppins text-xl font-medium">SECTIONS</h1>
            <div class="w-2/3 flex">
                <form action="/sections" class="flex w-full items-center justify-end space-x-4">
                    <div class="flex items-center space-x-2 p-1">
                        <input name="search" type="text" placeholder="Type here.." 
                        class="w-500px poppins text-sm rounded py-2 px-4">
                        <button type="submit" class="poppins bg-gray-600 hover:bg-blue-600 rounded px-3 py-1  flex justify-center items-center">
                            <i class='bx bx-search text-white text-lg'></i>
                        </button>
                    </div>
                    <a id="add" class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">New</a>
                </form>
            </div>
        </div>

        <div class="h-auto p-4 overflow-auto w-full">
            
        {{-- @if(count($sections) == 0)
            <tr>
                <td colspan="4" class="w-full border-t px-6 py-4">
                    <div class="flex flex-col items-center justify-center">
                        <img class="h-40 w-40" src="{{asset('image/search.png')}}" alt="">
                        <a class="poppins mt-2" href="/sections">
                            <i class='bx bx-refresh text-4xl text-blue-600'></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endif --}}
        
        <div class="overflow-x-auto">
            <table class="w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-200 text-gray-800  border-b rounded">
                    <tr>
                        <th class="poppins font-semibold px-6 py-3 text-left">Name</th>
                        <th class="poppins font-semibold px-6 py-3 text-left">Grade Level</th>
                        <th class="poppins font-semibold px-6 py-3 text-left">Adviser</th>
                        <th class="poppins font-semibold px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($sections as $section)
                        <tr class="border-b">
                            <td class="poppins text-sm border-t px-6 py-3">{{ $section->name }}</td>
                            <td class="poppins text-sm border-t px-6 py-3">{{ $section->gradeLevel }}</td>
                            <td class="poppins text-sm border-t px-6 py-3">
                                @if ($section->faculty == null)
                                    <span class="text-gray-400">No Adviser</span>
                                @else
                                    {{ $section->faculty->user->profile->firstName }} {{ $section->faculty->user->profile->middleName }} {{ $section->faculty->user->profile->lastName }}
                                @endif
                            </td>
                            <td class="poppins border-t px-6 py-3 flex space-x-4 justify-end">
                                <a class="show-delete-modal  rounded" >
                                    <i class='bx bx-trash text-red-600 hover:text-red-700 text-xl  cursor-pointer hover:scale-105 ' ></i>
                                </a>
                                <a class="edit-btn  rounded" >
                                    <i class='bx bx-edit text-blue-600 hover:text-blue-700 text-xl cursor-pointer hover:scale-105 '></i>
                                </a>
                                <a href="{{ route('sections.show', $section->id) }}" >
                                    <i class='bx bxs-right-arrow-square text-blue-600 hover:text-blue-700 text-xl cursor-pointer hover:scale-105 '></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    
                    
                    
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
            
        <div>

        {{-- MODAL FOR ADDING NEW SECTION --}}
        {{-- <div id="add-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-center space-y-6 bg-black bg-opacity-5">
                <div class="flex flex-col w-fit items-center justify-center space-y-6 bg-white p-6 rounded-md shadow-lg">
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
        </div> --}}

        {{-- EDIT MODAL --}}
        {{-- <div id="edit-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-center space-y-6 bg-black bg-opacity-5">
                <div class="flex flex-col w-fit items-center justify-center space-y-6 bg-white p-6 rounded-md shadow-lg">
                    <form id="edit-section-form" method="POST" action="javascript:void(0)"  class="w-700px flex flex-col space-y-3">
                        @csrf
                        @method('PUT')
                        <div class="w-full flex">
                            <h1 class="poppins text-xl text-gray-800 font-medium">EDIT SECTION</h1>
                        </div>
                        <div class="get-id flex flex-col space-y-1" id="edit-section-id"> 
                            <div class="flex items-baseline space-x-2">
                                <label for="name"
                                class="poppins text-sm font-medium text-gray-600">SECTION</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            
                            <input type="text" name="name" id="edit-name" 
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="Section Name">
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
        </div> --}}

{{--         
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
        </div> --}}

        
    </div>
</x-guidance-layout>

{{-- <script type="module"  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module"  src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="module"  src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="module"  src="{{ asset('js/section_index.js') }}"></script> --}}



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

