<x-guidance-layout>
        <div id="container" class="w-full relative">
    
            <div class="flex justify-between items-center px-4 py-4 border-b border-gray-300">
                <div class="flex border-l-4 border-red-400 py-1 px-2">
                    <h1 class="poppins text-2xl font-medium">FACULTY</h1>
                </div>
                <div class="w-2/3 flex">
                    <form action="" class="flex w-full justify-end space-x-4">
                        <input name="search" type="text" placeholder="Search for faculty member" 
                        class="w-500px poppins text-sm focus:outline-none focus:bg-blue-100 border border-gray-400 rounded focus:border-blue-400 py-2 px-4">
                        <button type="submit" class="poppins text-sm bg-white text-blue-600 border border-blue-600 rounded py-2 px-6">Search</button>
                        <a id="add-faculty" class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">Add Faculty</a>
                    </form>
                </div>
            </div>
    
            <div class="h-600px px-4 overflow-auto w-full">
                <div class="w-full h-full flex flex-col">
                    <a class="w-full flex justify-between py-1 px-4 border-b border-gray-300  items-center">
                        <p class="w-full poppins text-lg font-semibold">NAME</p>
                        <p class="w-full poppins text-lg font-semibold">DEPARTMENT</p>
                    </a>

                @if(count($faculties) == 0)
                    <div class="w-full h-96 flex flex-col items-center justify-center mt-20">
                        <img class="h-60 w-60" src="{{asset('image/search.png')}}" alt="">
                        <p class="poppins text-xl  text-red-500 mt-5">Oops! No result found.</p>
                        <a class="poppins text-xm text-blue-500 underline" href="/faculties">refresh</a>
                    </div>
                @endif
                @foreach ($faculties as $faculty)
                    <a class="w-full flex" href="/faculties/{{$faculty->id}}"> 
                        <div class="w-full flex justify-between py-2 px-4 border-b border-gray-300 items-center group hover:bg-blue-50">
                            <p class="w-full poppins text-base group-hover:text-blue-500">
                                {{$faculty->user->profile->suffix ? $faculty->user->profile->suffix : '' }}
                                {{$faculty->user->profile->firstName}} 
                                {{$faculty->user->profile->middleName}} 
                                {{$faculty->user->profile->lastName}}
                            </p>

                            <p class="w-full poppins text-base group-hover:text-blue-500">
                                {{ $faculty->department->name }}
                            </p>
                        </div>
                    </a>
                @endforeach
            <div>

            <div id="add-facuty-modal" class="hidden absolute top-0 left-0 w-full h-full overflow-auto">
                <div class="w-full h-full flex flex-col items-center justify-center space-y-6 px-32 py-8 bg-black bg-opacity-10">
                    {{-- action="/faculties/save"  --}}
                    <form id="faculty-form" method="POST" action="javascript:void(0)" class="w-full flex flex-col space-y-6 bg-white p-8 pt-0 rounded-lg shadow-md">
                        @csrf
                        <div class="w-full flex py-4">
                            <h1 class="poppins text-xl text-gray-800 font-medium">TEACHER'S INFORMATION</h1>
                        </div>
                        <div class="w-full flex space-x-4">
                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="first_name"
                                    class="poppins text-sm font-medium text-gray-600">FIRST NAME</label>
                                    <span class="error text-xs text-red-600"></span>
                                </div>
                                <input type="text" name="first_name" id="first_name"
                                class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Juan">
                            </div>
    
                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="last_name"
                                    class="poppins text-sm font-medium text-gray-600">LAST NAME</label>
                                    <span class="error text-xs text-red-600"></span>
                                </div>
                                <input type="text" name="last_name" id="last_name"
                                class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Cruz">
                            </div>
    
                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="middle_name"
                                    class="poppins text-sm font-medium text-gray-600">MIDDLE NAME</label>
                                    <span class="error text-xs text-red-600"></span>
                                </div>
                                <input type="text" name="middle_name" id="middle_name"
                                class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Reyes">
                            </div>
    
                            <div class="flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="suffix"
                                    class="poppins text-sm font-medium text-gray-600">SUFFIX</label>
                                    <span class="error text-xs text-red-600"></span>
                                </div>
                                <input type="text" name="suffix" id="suffix"
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
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
        
                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="contact_no"
                                    class="poppins text-sm font-medium text-gray-600">Contact No.</label>
                                    <span class="error text-xs text-red-600"></span>
                                </div>
                                <input type="text" name="contact_no" id="contact_no"
                                class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="09123456789">
                            </div>
                        </div>
    
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="email"
                                class="poppins text-sm font-medium text-gray-600">Email</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="email" name="email" id="email"
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
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                            </select>
                        </div>
        
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
        </div>
</x-guidance-layout>
<script type="module"  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module"  src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="module"  src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="module"  src="{{ asset('js/faculty_index.js') }}"></script>