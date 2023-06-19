<x-guidance-layout>
    <div id="container" class="w-full flex flex-col p-4 px-6 pb-0 relative">
        <div class="">
            <a id="back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/faculties">
                <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
            </a>
        </div>

        <div class="w-full flex flex-col space-y-6 py-4 pb-6">
            <div class="w-full h-250px flex items-start space-x-4 rounded border border-gray-300 p-4">
                <div class="w-64 p-2">
                    <img  src="{{$faculty->image ? asset('storage/' . $faculty->image) : ($faculty->sex == 'Female' ? asset('image/female.png') : asset('image/male.png'))}}" alt="" class="w-full h-full rounded">
                </div>

                {{-- src="{{asset('image/profile.png')}}" --}}
    
                <div class="w-full h-fit flex justify-between p-4 ">
                    <div class="flex flex-col space-y-2">
                        <div class="flex items-center space-x-2">
                            <h1 class="poppins text-2xl font-medium">{{$faculty->first_name}}</h1>
                            <h1 class="poppins text-2xl font-medium">{{$faculty->middle_name}}</h1>
                            <h1 class="poppins text-2xl font-medium">{{$faculty->last_name}}</h1>
                        </div>
                        <div>
                            <h1 class="poppins text-base">{{$faculty->sex}}</h1>
                        </div>
                        <div>
                            @foreach ($departments as $department)
                                @if ($faculty->department_id == $department->id) 
                                <h1 class="poppins text-base">{{$department->department_name}}</h1>                                  
                                @endif
                            @endforeach    
                        </div>
                        <div>
                            <h1 class="poppins text-base">{{$faculty->email}}</h1>
                        </div>
                        <div>
                            <h1 class="poppins text-base">{{$faculty->contact_no}}</h1>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-start space-x-1">
                            <a id="show-delete-modal" data-faculty-id="{{$faculty->id}}">
                                <i class='bx bx-trash text-red-500 text-xl rounded bg-red-50 cursor-pointer py-1 px-2' ></i>
                            </a>
                            <a id="edit-faculty" class="edit-faculty" data-faculty-id="{{$faculty->id}}">
                                <i class='bx bx-edit text-blue-500 text-xl cursor-pointer rounded bg-blue-50 py-1 px-2'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="w-full flex flex-wrap -m-2">
                @if (count($classes) == 0)   
                    <div class="h-64 w-full flex items-center justify-center">
                        <h1 class="poppins text-red-500 text-sm">No classes assigned yet.</h1>
                    </div>
                @endif
                @foreach ($classes as $class)
                    <div class="p-2 lg:w-1/4 md:w-1/2 w-full">
                        <div class="h-full flex flex-col border-gray-200 border rounded-lg hover:shadow-md hover:border-gray-400">
                            <div class="w-full h-40 bg-mambog rounded-t-lg">
                                <img class="w-full h-full rounded-t-lg opacity-90" src="{{asset('image/mamboges.jpg')}}" alt="">
                            </div>
                            <div class="flex-grow p-4">
                                <h2 class="poppins text-gray-900 title-font font-semibold">{{$class->name}}</h2>
                                <div class="group flex items-center">
                                    <a class="poppins text-sm group-hover:underline text-gray-500 group-hover:text-blue-500" href="/classes/{{$class->id}}/class-record">Class record</a>
                                    <i class='bx bx-right-arrow-alt text-lg text-gray-500 group-hover:text-blue-500'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}

            <div class="w-full flex flex-col space-y-2 h-screen">
                @if (count($classes) == 0)   
                    <div class="h-64 w-full flex items-center justify-center">
                        <h1 class="poppins text-red-500 text-sm">No classes assigned yet.</h1>
                    </div>
                @endif

                {{-- @foreach ($classes as $class)
                    <div class="flex w-full space-y-2">
                        <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-md h-fit w-full">
                            <div class="collapse-title">
                            <p>{{$class->name}}</p>
                            </div>
                            <div class="collapse-content">
                                @foreach ($students as $student)
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>{{$student->last_name}} {{$student->first_name}} {{$student->middle_name}}</h2>
                                        <p>remarks</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach --}}

                @foreach ($classes as $class)
                    <div class="flex w-full space-y-2">
                        <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-md h-fit w-full">
                            <div class="collapse-title">
                                <p>{{$class->name}}</p>
                            </div>
                            <div class="collapse-content">
                                @if (isset($students[$class->section_id]))
                                    @foreach ($students[$class->section_id] as $student)
                                        <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                            <h2>{{$student->last_name}} {{$student->first_name}} {{$student->middle_name}}</h2>
                                            <p>remarks</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>

        <div id="edit-facuty-modal" class="hidden absolute top-0 left-0 w-full h-full overflow-auto">
            <div class="w-full h-full flex flex-col justify-start space-y-6 px-32 py-8 pt-20 bg-black bg-opacity-10">
                {{-- action="/faculties/{{$faculty->id}}/update" action="javascript:void(0)"--}}
                <form id="edit-faculty-form" method="POST"  action="javascript:void(0)" class="w-full flex flex-col space-y-6 bg-white p-8 pt-0 rounded-lg shadow-md">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex py-4">
                        <h1 class="poppins text-xl text-gray-800 font-medium">TEACHER'S INFORMATION</h1>
                    </div>
                    <div class="w-full flex space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="last_name"
                                class="poppins text-sm font-medium text-gray-600">LAST NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="last_name" id="last_name" value="{{$faculty->last_name}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Cruz">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="first_name"
                                class="poppins text-sm font-medium text-gray-600">FIRST NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="first_name" id="first_name" value="{{$faculty->first_name}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Juan">
                        </div>
    
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="middle_name"
                                class="poppins text-sm font-medium text-gray-600">MIDDLE NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="middle_name" id="middle_name" value="{{$faculty->middle_name}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Reyes">
                        </div>
    
                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="suffix"
                                class="poppins text-sm font-medium text-gray-600">SUFFIX</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="suffix" id="suffix" value="{{$faculty->suffix}}"
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
                                <option value="Male" {{ $faculty->sex == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $faculty->sex == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
    
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="contact_no"
                                class="poppins text-sm font-medium text-gray-600">Contact No.</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="contact_no" id="contact_no" value="{{$faculty->contact_no}}"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="09123456789">
                        </div>
                    </div>
    
                    <div class="w-full flex flex-col space-y-1">
                        <div class="flex items-baseline space-x-2">
                            <label for="email"
                            class="poppins text-sm font-medium text-gray-600">Email</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <input type="email" name="email" id="email" value="{{$faculty->email}}"
                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="sample@email.com">
                    </div>
    
                    <div class="w-full flex flex-col space-y-1">
                        <div class="flex items-baseline space-x-2">
                            <label for="department"
                            class="poppins text-sm font-medium text-gray-600">Department</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <select name="department" id="department"
                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                            <option disabled selected value="">Select Department</option>
                            @foreach($departments as $department) 
                                <option value="{{$department->id}}" {{ $faculty->department_id == $department->id ? 'selected' : '' }}>{{$department->department_name}}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="flex items-center justify-start space-x-4 pt-4 ">
                        <button type="submit" 
                            class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                            Update
                        </button>
    
                        <a id="cancel"
                            class="poppins text-base font-medium text-blue-400 border border-blue-400 hover:border-blue-600 hover:text-blue-600 py-2 px-6 rounded cursor-pointer">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div id="delete-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-start space-y-6 bg-black bg-opacity-10 ">
                <div class="flex flex-col p-4 rounded-md bg-white shadow-lg space-y-2 mt-60" id="delete-faculty-id">
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
    </div> 

</x-guidance-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('js/faculty_show.js') }}"></script>


 
 
 
 
 
 
 
 
 
 
 
 