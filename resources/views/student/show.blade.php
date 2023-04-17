<x-guidance-layout>
    <div id="container" class="w-full flex flex-col p-4 px-6 pb-0 relative">
        <div class="">
            <a id="back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/students">
                <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
            </a>
        </div>

        <div class="w-full flex flex-col space-y-6 py-4 pb-6">
            <div class="w-full h-250px flex space-x-4">
                <div class="min-w-250px w-250px h-250px bg-gray-200 rounded border border-gray-200">
                    <img src="{{asset('image/profile.png')}}" alt="" class="w-full h-full shadow-lg rounded">
                </div>
    
                <div class="w-full h-fit flex justify-between p-4 rounded shadow space-x-8 border border-gray-200">
                    <div class="w-full flex flex-col">
                        <div class="flex items-center space-x-2 border border-gray-300 py-1 px-2">
                            <h1 class="poppins text-2xl font-medium">{{$student->first_name}}</h1>
                            <h1 class="poppins text-2xl font-medium">{{$student->middle_name}}</h1>
                            <h1 class="poppins text-2xl font-medium">{{$student->last_name}}</h1>
                        </div>
                        <div class="flex justify-between border border-gray-300 border-t-0 py-1 px-2">
                            <h1 class="poppins text-base">BIRTHDATE: </h1>
                            <h1 class="poppins text-base">{{date('F j, Y', strtotime($student->dob))}}</h1>
                        </div>
                        <div class="flex justify-between border border-gray-300 border-t-0 py-1 px-2">
                            <h1 class="poppins text-base">Sex: </h1>
                            <h1 class="poppins text-base">{{$student->sex}}</h1>
                        </div>
                        <div class="flex justify-between border border-gray-300 border-t-0 py-1 px-2">
                            <h1 class="poppins text-base">GRADE LEVEL: </h1>
                            <h1 class="poppins text-base">
                                @if ($student_section == null)
                                <span class="text-blue-400 text-sm">Waiting for section assignment</span>
                                @elseif ($student_section->grade_level == 0)
                                    Kinder
                                @else
                                    Grade {{ $student_section->grade_level }}
                                @endif
                            </h1>
                        </div>
                        <div class="flex justify-between items-center border border-gray-300 border-t-0 py-1 px-2">
                            {{-- && $section->has($student->section_id) --}}
                            <h1 class="poppins text-base">SECTION: </h1>
                            @if ($section)
                                <h1 class="poppins text-base">{{$section->name}}</h1>
                            @else
                                <h1 class="poppins text-sm text-red-400">No section yet</h1>
                            @endif
                        </div>
                        <div class="flex justify-between border border-gray-300 border-t-0 py-1 px-2">
                            <h1 class="poppins text-base">LRN: </h1>
                            <h1 class="poppins text-base">{{$student->lrn}}</h1>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-start space-x-1">
                            <a id="show-delete-modal" data-student-id="{{$student->id}}">
                                <i class='bx bx-trash text-red-500 text-xl rounded bg-red-50 cursor-pointer py-1 px-2' ></i>
                            </a>
                            <a id="edit-student" class="edit-student" data-student-id="{{$student->id}}">
                                <i class='bx bx-edit text-blue-500 text-xl cursor-pointer rounded bg-blue-50 py-1 px-2'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex space-x-4 h-screen">
                <div class="w-2/3 h-full flex justify-center items-center shadow-md rounded border border-gray-200">
                    <p>This is the report card area</p>
                </div>

                <div class="w-1/3 h-full ">
                    <div class="w-full h-400px flex justify-center items-center shadow rounded border border-gray-200">
                        <p>Parents information area</p>
                    </div>

                    <div>

                    </div>
                </div>
            </div>

        </div>


        {{-- ADD STUDENT MODAL --}}
        <div id="edit-student-modal" class="hidden absolute top-0 left-0 w-full h-full bg-white overflow-auto">
            <div class="w-fitt flex flex-col w-full items-center justify-center space-y-6 px-32 py-8">
                {{-- action="/students/{{$student->id}}/edit" --}}
                <form id="edit-student-form" method="POST"  action="javascript:void(0)" class="w-full flex flex-col space-y-4">
                    @csrf
                    @method('PUT')
                    {{-- STUDENT'S INFORMATION --}}

                    <div class="w-full flex py-4">
                        <h1 class="poppins text-xl text-gray-800 font-medium">STUDENT'S INFORMATION</h1>
                    </div>
                    <div class="w-full flex space-x-4">

                        <div class="w-full flex flex-col space-y-1" id="{{$student->id}}">
                            <div class="flex items-baseline space-x-2">
                                <label for="last_name"
                                class="poppins text-sm font-medium text-gray-600">LAST NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="last_name" id="last_name" value="{{$student->last_name}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Cruz">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="first_name"
                                class="poppins text-sm font-medium text-gray-600">FIRST NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="first_name" id="first_name" value="{{$student->first_name}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Juan">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="middle_name"
                                class="poppins text-sm font-medium text-gray-600">MIDDLE NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="middle_name" id="middle_name" value="{{$student->middle_name}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Reyes">
                        </div>

                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="suffix"
                                class="poppins text-sm font-medium text-gray-600">SUFFIX</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="suffix" id="suffix" value="{{$student->suffix}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-60px" placeholder="jr.">
                        </div>
                    </div>


                    <div class="w-full flex space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="sex"
                                class="poppins text-sm font-medium text-gray-600">SEX</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="sex" id="sex"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full">
                                <option value="Male" {{ $student->sex == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $student->sex == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="dob"
                                class="poppins text-sm font-medium text-gray-600">BIRTHDAY</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="date" name="dob" id="dob" value="{{$student->dob}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full">
                        </div>
                    </div>

                    <div class="w-full flex space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="lrn"
                                class="poppins text-sm font-medium text-gray-600">LRN</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="lrn" id="lrn" value="{{$student->lrn}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="12345678910">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="grade_level"
                                class="poppins text-sm font-medium text-gray-600">Grade Level</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="grade_level" id="grade_level"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 mr-3">
                                <option disabled selected value="">Select Grade Level</option>
                                <option value="0" {{ $student->grade_level == 0 ? 'selected' : '' }}>Kinder</option>
                                <option value="1" {{ $student->grade_level == 1 ? 'selected' : '' }}>Grade 1</option>
                                <option value="2" {{ $student->grade_level == 2 ? 'selected' : '' }}>Grade 2</option>
                                <option value="3" {{ $student->grade_level == 3 ? 'selected' : '' }}>Grade 3</option>
                                <option value="4" {{ $student->grade_level == 4 ? 'selected' : '' }}>Grade 4</option>
                                <option value="5" {{ $student->grade_level == 5 ? 'selected' : '' }}>Grade 5</option>
                                <option value="6" {{ $student->grade_level == 6 ? 'selected' : '' }}>Grade 6</option>
                            </select>
                        </div>
                    </div>

                    {{-- PARENTS INFORMATION --}}

                    <div class="w-full flex py-4">
                        <h1 class="poppins text-xl text-gray-800 font-medium">PARENT'S INFORMATION</h1>
                    </div>

                    <div class="w-full flex space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_last_name"
                                class="poppins text-sm font-medium text-gray-600">LAST NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_last_name" id="parent_last_name" value="{{$parent->last_name}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Cruz">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_first_name"
                                class="poppins text-sm font-medium text-gray-600">FIRST NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_first_name" id="parent_first_name" value="{{$parent->first_name}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Juan">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_middle_name"
                                class="poppins text-sm font-medium text-gray-600">MIDDLE NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_middle_name" id="parent_middle_name" value="{{$parent->middle_name}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Reyes">
                        </div>

                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_parent_suffix"
                                class="poppins text-sm font-medium text-gray-600">SUFFIX</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_parent_suffix" id="parent_parent_suffix" value="{{$parent->suffix}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-60px" placeholder="jr.">
                        </div>
                    </div>

                    <div class="w-full flex space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_sex"
                                class="poppins text-sm font-medium text-gray-600">SEX</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="parent_sex" id="parent_sex"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full">
                            <option value="Male" {{ $parent->sex == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $parent->sex == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_contact_no"
                                class="poppins text-sm font-medium text-gray-600">CONTACT NO.</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_contact_no" id="parent_contact_no" value="{{$parent->contact_no}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="09123456789">
                        </div>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <div class="flex items-baseline space-x-2">
                            <label for="email"
                            class="poppins text-sm font-medium text-gray-600">EMAIL</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <input type="email" name="email" id="email" value="{{$parent->email}}"
                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="juandelacrus@gmail.com">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <div class="flex items-baseline space-x-2">
                            <label for="address"
                            class="poppins text-sm font-medium text-gray-600">ADDRESS</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <input type="text" name="address" id="address" value="{{$parent->address}}"
                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="Address">
                    </div>

                    <div class="flex items-center justify-start space-x-4 pt-4 ">
                        <button type="submit" 
                            class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                            Save
                        </button>

                        <a id="cancel"
                            class="poppins text-base font-medium text-gray-400 border border-gray-400 hover:border-red-600 hover:text-red-600 py-2 px-6 rounded cursor-pointer">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>


        <div id="delete-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-start space-y-6 bg-black bg-opacity-5 ">
                <div class="flex flex-col p-4 rounded-md bg-white shadow-lg space-y-2 mt-60" id="delete-student-id">
                    <div class="flex space-x-2">
                        <i class='bx bx-trash text-red-500 text-xl  cursor-pointer ' ></i>
                        <h1 class="poppins text-lg font-medium">Delete Student</h1>
                    </div>
                    <h1 class="poppins ">Are you sure you want to delete this Student?</h1>
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
<script src="{{ asset('js/student_show.js') }}"></script>


 
 
 
 
 
 
 
 
 
 
 
 