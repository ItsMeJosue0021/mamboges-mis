<x-guidance-layout>
    <div id="container" class="w-full flex flex-col p-4 px-6 pb-0 relative">
        {{-- <div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-14 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div> --}}
        <div class="">
            <a id="back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/students">
                <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
            </a>
        </div>

        <div class="w-full flex flex-col space-y-6 py-4 pb-6">
            <div class="w-full h-250px flex space-x-4">
                <div class="min-w-250px w-250px h-250px rounded border border-gray-200 p-2 shadow-lg">
                    {{-- <img src="{{$student->image ? asset('storage/' . $student->image) : asset('image/male.png')}}" 
                    alt="" class="w-full h-full shadow-lg rounded"> --}}

                    <img src="{{$student->image ? asset('storage/' . $student->image) : ($student->sex == 'Female' ? asset('image/female.png') : asset('image/male.png'))}}" 
                    alt="" class="w-full h-full rounded">

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
        <x-updatestudent-modal :student="$student" :parent="$parent"/>

        {{-- DELETE STUDENT MODAL --}}
        <div id="delete-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-start space-y-6 bg-black bg-opacity-5 ">
                <div class="flex flex-col p-4 rounded-md bg-white shadow-lg space-y-3 mt-60" id="delete-student-id">
                    <div class="flex space-x-2">
                        <i class='bx bx-trash text-red-500 text-xl  cursor-pointer ' ></i>
                        <h1 class="poppins text-lg font-medium">Delete Student</h1>
                    </div>
                    <h1 class="poppins text-base">Are you sure you want to delete this Student?</h1>
                    <div class="flex flex-col space-y-1 pt-3 border-t border-gray-200">
                        <label for="reason" class="poppins text-sm">Please specify your reason:</label>
                        <select name="reason" id="reason" class="poppins text-sm border border-gray-300 rounded">
                            <option value="" disabled selected>Select a reason</option>
                            <option value="No Longer Participating">No Longer Participating</option>
                            <option value="Transfered To Another School">Transfered To Another School</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
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


 
 
 
 
 
 
 
 
 
 
 
 