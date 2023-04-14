<x-guidance-layout>
    <div id="container" class="w-full flex flex-col p-4 px-6 pb-0 relative">
        <div class="">
            <a id="back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/faculties">
                <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
            </a>
        </div>

        <div class="w-full flex flex-col space-y-6 py-4 pb-6">
            <div class="w-full h-250px flex items-start space-x-4">
                <div class="min-w-250px w-250px h-250px bg-gray-200 rounded border border-gray-200">
                    <img src="{{asset('image/profile.png')}}" alt="" class="w-full h-full shadow-lg rounded">
                </div>
    
                <div class="w-full h-fit flex justify-between p-4 rounded shadow border border-gray-200">
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

            <div class="w-full flex space-x-4 h-screen">
               
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


 
 
 
 
 
 
 
 
 
 
 
 