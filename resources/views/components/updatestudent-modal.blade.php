@props(['student', 'parent'])

<div id="edit-student-modal" class="hidden absolute top-0 left-0 w-full h-full bg-white overflow-auto">
    <div class="w-fitt flex flex-col w-full items-center justify-center space-y-6 px-32 py-8">
        {{-- action="/students/{{$student->id}}/edit" --}}
        <form id="edit-student-form" method="POST"  action="javascript:void(0)" class="w-full flex flex-col space-y-4" enctype="multipart/form-data">
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

            <div>
                <div id="photo-preview" class="h-80 w-96 flex items-center justify-center bg-gray-100 bg-cover bg-center rounded shadow-md"
                    style="background-image: url('{{ asset('storage/' . $student->image) }}')">
                    @if (!$student->image)
                        <p class="poppins text-3xl text-gray-400 font-semibold">Upload a photo</p>
                    @endif
                </div>
                <div class="relative py-4">
                    <label>
                        <input name="image" type="file" id="photo-input" class="poppins text-sm mr-2
                        file:mr-5 file:py-2 file:px-4
                        file:rounded file:border-0
                        file:text-sm file:font-medium
                        file:bg-green-400 file:text-white file:border file:border-gray-400 file:cursor:pointer" />
                    </label>
                    <span class="error poppins text-red-500 text-sm"></span>
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