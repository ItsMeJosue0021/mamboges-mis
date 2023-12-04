<x-guidance-layout>
    <div id="container" class="w-full">

        <div class="flex justify-between items-center px-4 py-4 border-b border-gray-300">
            <div class="flex border-l-4 border-red-400 py-1 px-2">
                <h1 class="poppins text-2xl font-medium">SUBJECTS</h1>
            </div>
            <div class="flex">
                <a id="add-subject" class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">New Subject</a>
            </div>
        </div>

        <div class="h-auto px-4 overflow-auto w-full">
            <div class="h-full flex flex-col">
                <a class="w-full flex justify-between py-1 px-2 border-b border-gray-300  items-center">

                    <p class="w-full poppins text-lg font-semibold ">SUBJECT</p>

                    {{-- <p class="w-full poppins text-lg text-center font-semibold ">GRADE LEVEL</p> --}}

                    <div class="w-full flex items-center justify-end space-x-2 h-fit ">
                        <i class='bx bx-trash text-gray-500 text-xl py-1 px-2 bg-red-50' ></i>
                        <i class='bx bx-edit text-gray-500 text-xl py-1 px-2  bg-blue-50'></i>
                    </div>
                </a>
            @if(count($subjects) == 0)
                <div class="w-full h-96 flex flex-col items-center justify-center mt-20">
                    <img class="h-60 w-60" src="{{asset('image/search.png')}}" alt="">
                    <p class="poppins text-xl  text-red-500 mt-5">Oops! No result found.</p>
                    <a class="poppins text-xm text-blue-500 underline" href="/subjects">refresh</a>
                </div>
            @endif
            @foreach ($subjects as $subject)
                {{-- href="/sections/{{$section->id}}" --}}

                <div class="w-full flex justify-between py-1 px-2 border-b border-gray-300 items-center">
                    <p class="w-full poppins text-base font-normal ">
                        {{$subject->name}}
                    </p>

                    {{-- <p class="w-full poppins text-center text-base ">
                        @if ($subject->grade_level == 0)
                            Kinder
                        @else
                            Grade {{ $subject->grade_level }}
                        @endif
                    </p> --}}

                    <div class="w-full flex items-center justify-end space-x-2 h-fit ">
                        {{-- data-section-id="{{$section->id}}" --}}
                        <a class="show-delete-modal py-1 px-2 rounded hover:bg-red-50" data-subject-id="{{$subject->id}}">
                            <i class='bx bx-trash text-red-500 text-xl  cursor-pointer ' ></i>
                        </a>
                        {{-- href="/sections/{{$section->id}}/edit" --}}
                        <a class="edit-btn py-1 px-2 rounded hover:bg-blue-50" data-subject-id="{{$subject->id}}">
                            <i class='bx bx-edit text-blue-500 text-xl cursor-pointer '></i>
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>

        {{-- Add Subject Modal --}}
        <div id="add-subject-modal" class="hidden absolute top-0 left-0 w-full h-screen z-50">
            <div class="w-full h-full flex flex-col items-center justify-center space-y-6 px-4 md:px-32 py-8 bg-black bg-opacity-5">
                {{-- action="/subject/save" action="javascript:void(0)"--}}
                <form id="subject-form" method="POST" action="/subjects/save" class="w-full md:w-96 flex flex-col space-y-2 bg-white p-4 md:p-6 pt-0 rounded-lg shadow-md">
                    @csrf
                    <div class="w-full flex py-4">
                        <h1 class="poppins text-xl text-gray-800 font-medium">NEW SUBJECT</h1>
                    </div>

                    <div class="w-full flex flex-col space-y-1">
                        <div class="flex items-baseline space-x-2">
                            <label for="subject_name"
                            class="poppins text-sm font-medium text-gray-600">Subject Name</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <input type="text" name="subject_name" id="subject_name"
                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Subject Name">
                    </div>

                    {{-- <div class="w-full flex flex-col space-y-1">
                        <div class="flex items-baseline space-x-2">
                            <label for="grade_level"
                            class="poppins text-sm font-medium text-gray-600">Grade Level</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <select name="grade_level" id="grade_level"
                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 mr-3">
                            <option disabled selected value="">Select Grade Level</option>
                            <option value="0">Kinder</option>
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                            <option value="4">Grade 4</option>
                            <option value="5">Grade 5</option>
                            <option value="6">Grade 6</option>
                        </select>
                    </div> --}}

                    <div class="flex items-center justify-start space-x-4 pt-4 ">
                        <button type="submit"
                            class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                            Save
                        </button>

                        <a id="cancel"
                            class="poppins text-base font-medium text-blue-400 border border-blue-400 hover:border-blue-600 hover:text-blue-600 py-2 px-6 rounded cursor-pointer">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Delete Modal --}}
        <div id="delete-modal" class="hidden absolute top-0 left-0 w-full h-screen z-50">
            <div class="flex flex-col w-full h-full items-center justify-start space-y-6 bg-black bg-opacity-5 px-4">
                <div class="flex flex-col p-4 rounded-md bg-white shadow-lg space-y-2 mt-60" id="delete-subject-id">
                    <div class="flex space-x-2">
                        <i class='bx bx-trash text-red-500 text-xl  cursor-pointer ' ></i>
                        <h1 class="poppins text-lg font-medium">Delete Faculty</h1>
                    </div>
                    <h1 class="poppins ">Are you sure you want to delete this Faculty?</h1>
                    <div class="flex justify-end space-x-2 pt-4">
                        <button id="delete-cancel" class="poppins text-gray-700 bg-gray-200 rounded px-3 py-1 hover:bg-gray-300">Cancel</button>
                        <button class="delete-btn poppins text-white bg-red-500 rounded px-3 py-1">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Subject Modal --}}
        <div id="edit-subject-modal" class="hidden absolute top-0 left-0 w-full h-screen z-50">
            <div class="w-full h-full flex flex-col items-center justify-center space-y-6 px-4 md:px-32 py-8 bg-black bg-opacity-5">
                {{-- action="/departments/save" action="javascript:void(0)"--}}
                <form id="edit-subject-form" method="POST" action="javascript:void(0)"  class="w-full md:w-1/2 flex flex-col space-y-6 bg-white p-8 pt-0 rounded-lg shadow-lg">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex py-4">
                        <h1 class="poppins text-xl text-gray-800 font-medium">EDIT DEPARTMENT</h1>
                    </div>

                    <div class="w-full flex flex-col space-y-1" id="edit-subject-id">
                        <div class="flex items-baseline space-x-2">
                            <label for="edit_subject_name"
                            class="poppins text-sm font-medium text-gray-600">Subject Name</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <input type="text" name="edit_subject_name" id="edit_subject_name"
                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Departmen Name">
                    </div>

                    {{-- <div class="w-full flex flex-col space-y-1">
                        <div class="flex items-baseline space-x-2">
                            <label for="edit_grade_level"
                            class="poppins text-sm font-medium text-gray-600">Grade Level</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <select name="edit_grade_level" id="edit_grade_level"
                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 mr-3">
                            <option disabled selected value="">Select Grade Level</option>
                            <option value="0">Kinder</option>
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                            <option value="4">Grade 4</option>
                            <option value="5">Grade 5</option>
                            <option value="6">Grade 6</option>
                        </select>
                    </div> --}}

                    <div class="flex items-center justify-start space-x-4 pt-4 ">
                        <button type="submit"
                            class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                            Update
                        </button>

                        <a id="edit-cancel"
                            class="poppins text-base font-medium text-blue-400 border border-blue-400 hover:border-blue-600 hover:text-blue-600 py-2 px-6 rounded cursor-pointer">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guidance-layout>
<script type="module" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="module" src="{{ asset('js/subject_index.js') }}"></script>
