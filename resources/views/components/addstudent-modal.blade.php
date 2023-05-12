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
                    <input type="number" name="lrn" id="lrn"
                    class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full" placeholder="12345678910">
                </div>
            </div>

            <x-upload-photo/>

            {{-- PARENTS INFORMATION --}}

            <div class="w-full flex py-4 border-t border-gray-300">
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
                    <input type="number" name="parent_contact_no" id="parent_contact_no"
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