<x-guidance-layout>
    <div id="container" class="w-full relative">

        <div class="flex justify-between items-center px-4 py-4 border-b border-gray-300">
            <div class="flex border-l-4 border-red-400 py-1 px-2">
                <h1 class="poppins text-2xl font-medium">STUDENTS</h1>
            </div>
            <div class="w-2/3 flex">
                <form action="/students" class="flex w-full justify-end space-x-4">
                    <input name="search" id="search-student" type="text" placeholder="Search for news and announcements" 
                    class="w-500px poppins text-sm focus:outline-none focus:bg-blue-100 border border-gray-400 rounded focus:border-blue-400 py-2 px-4">
                    {{-- <button type="submit" class="poppins text-sm bg-white text-blue-600 border border-blue-600 rounded py-2 px-6">Search</button> --}}
                    <a id="add-student" class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">New Student</a>
                </form>
            </div>
        </div>

        <div class="w-full h-600px px-4 overflow-auto">
            <div class="h-full flex flex-col">
                <div class="flex justify-between py-1 px-4 border-b border-gray-300  items-center">
                    <p class="w-full poppins text-lg font-semibold">NAME</p>
                    <p class="w-full poppins text-center text-lg font-semibold">SEX</p>
                    <p class="w-full poppins text-end text-lg font-semibold">LRN</p>
                </div>

            <div id="students-container">

            </div>
            
        <div>


        {{-- ADD STUDENT MODAL --}}
        <div id="add-student-modal" class="hidden absolute top-0 left-0 w-full h-full bg-white overflow-auto">
            <div class="w-fitt flex flex-col w-full items-center justify-center space-y-6 px-32 py-8">
                <form id="student-form" method="POST" action="/students/register" class="w-full flex flex-col space-y-4">
                    @csrf

                    {{-- STUDENT'S INFORMATION --}}

                    <div class="w-full flex py-4">
                        <h1 class="poppins text-xl text-gray-800 font-medium">STUDENT'S INFORMATION</h1>
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
                                <label for="dob"
                                class="poppins text-sm font-medium text-gray-600">BIRTHDAY</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="date" name="dob" id="dob"
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
                            <input type="text" name="lrn" id="lrn"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="12345678910">
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
                    </div>

                    {{-- PARENTS INFORMATION --}}

                    <div class="w-full flex py-4">
                        <h1 class="poppins text-xl text-gray-800 font-medium">PARENT'S INFORMATION</h1>
                    </div>

                    <div class="w-full flex space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_first_name"
                                class="poppins text-sm font-medium text-gray-600">FIRST NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_first_name" id="parent_first_name"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Juan">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_last_name"
                                class="poppins text-sm font-medium text-gray-600">LAST NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_last_name" id="parent_last_name"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Cruz">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_middle_name"
                                class="poppins text-sm font-medium text-gray-600">MIDDLE NAME</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_middle_name" id="parent_middle_name"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="Reyes">
                        </div>

                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_parent_suffix"
                                class="poppins text-sm font-medium text-gray-600">SUFFIX</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_parent_suffix" id="parent_parent_suffix"
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
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
    
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parent_contact_no"
                                class="poppins text-sm font-medium text-gray-600">CONTACT NO.</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <input type="text" name="parent_contact_no" id="parent_contact_no"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="09123456789">
                        </div>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <div class="flex items-baseline space-x-2">
                            <label for="email"
                            class="poppins text-sm font-medium text-gray-600">EMAIL</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <input type="email" name="email" id="email"
                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="juandelacrus@gmail.com">
                    </div>
   
                    <div class="flex flex-col space-y-1">
                        <div class="flex items-baseline space-x-2">
                            <label for="address"
                            class="poppins text-sm font-medium text-gray-600">ADDRESS</label>
                            <span class="error text-xs text-red-600"></span>
                        </div>
                        <input type="text" name="address" id="address"
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

       
        

    </div>
</x-guidance-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('js/student_index.js') }}"></script>


{{-- <div class="py-2 pt-4 px-8">
    <a id="backfromadd" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/sections/{{$section->id}}">
        <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
        <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
    </a>
</div> --}}

{{-- /sections/{{$section->id}}/importstudent --}}
{{-- <form id="csv-form" action="javascript:void(0)" class="w-full py-4 border-t border-gray-300" method="POST" enctype="multipart/form-data">
    @csrf
    <p class="poppins text-base mb-2 text-gray-800">Or you can upload a CSV file instead</p> 
    <div class="w-full flex justify-between border border-green-300 rounded py-3 px-2 bg-green-50">
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