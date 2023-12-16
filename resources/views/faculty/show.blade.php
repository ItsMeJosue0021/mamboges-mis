<x-guidance-layout>
    <div id="container" class="w-full flex flex-col p-4 px-6 pb-0">
        <div class="flex flex-col space-y-2">
            <a href="{{ route('faculties.index') }}" id="back"
                class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>

        <div class="w-full flex flex-col space-y-6 py-4">
            <div class="relative w-full h-auto md:h-[250px] flex flex-col md:flex-row space-y-4 md:space-y-0 items-center md:space-x-4 rounded border border-gray-200 shadow p-4">
                <div class="w-64 h-full">
                    <img src="{{ $faculty->user->profile->image ? asset('storage/' . $faculty->user->profile->image) : ($faculty->user->profile->sex == 'Female' ? asset('image/female.png') : asset('image/male.png')) }}"
                        alt="" class="w-full h-full md:rounded rounded-full object-cover object-top">
                </div>

                <div class="w-full h-fit flex items-start justify-between p-4 ">
                    <div class="flex flex-col">
                        <div class="flex items-center space-x-2">
                            <h1 class="poppins text-2xl font-medium">{{ $faculty->user->profile->firstName }}</h1>
                            <h1 class="poppins text-2xl font-medium">{{ $faculty->user->profile->middleName ?? '' }}
                            </h1>
                            <h1 class="poppins text-2xl font-medium">{{ $faculty->user->profile->lastName }}</h1>
                        </div>
                        <div>
                            <h1 class="poppins text-sm"><span class="font-medium">Sex: </span>
                                {{ $faculty->user->profile->sex }}</h1>
                        </div>
                        <div>
                            <h1 class="poppins text-sm"><span class="font-medium">Date Of Birth: </span>
                                {{ $faculty->user->profile->dob }}</h1>
                        </div>
                        <div>
                            <h1 class="poppins text-sm"><span class="font-medium">Department: </span>
                                {{ $faculty->department->name ?? '' }}</h1>
                        </div>
                        <div>
                            <h1 class="poppins text-sm"><span class="font-medium">Email: </span>
                                {{ $faculty->user->email }}</h1>
                        </div>
                        <div>
                            <h1 class="poppins text-sm"><span class="font-medium">Contact Number: </span>
                                {{ $faculty->user->profile->contactNumber ?? '' }}</h1>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 absolute top-2 right-2">
                        <button id="edit-faculty" class="edit-faculty" data-faculty-id="{{ $faculty->id }}">
                            <i class='bx bx-edit text-blue-500 text-xl cursor-pointer rounded bg-blue-50 py-1 px-2'></i>
                        </button>
                        <a href="{{ route('faculties.archiving-info', $faculty->id) }}">
                            <i class='bx bx-trash text-red-500 text-xl rounded bg-red-50 cursor-pointer py-1 px-2'></i>
                        </a>
                    </div>
                </div>

            </div>

            <div class="w-full py-2 px-2 mb-4 border-b border-gray-300">
                <p class="text-base">HANDLED CLASSES</p>
            </div>

            <div class="w-full flex flex-col space-y-2 h-auto min-28">
                @if (count($classes) == 0)
                    <div class="h-64 w-full flex items-center justify-center">
                        <h1 class="poppins text-red-500 text-sm">No classes assigned yet.</h1>
                    </div>
                @endif

                @foreach ($classes as $class)
                    <div class="flex w-full space-y-2">
                        <div tabindex="0"
                            class="collapse collapse-arrow border border-gray-200 bg-white rounded-md h-fit w-full">
                            <div class="collapse-title">
                                <p class="poppins font-bold">{{ $class->name }}</p>
                            </div>
                            <div class="collapse-content">
                                @if (isset($students[$class->section_id]))
                                    @foreach ($students[$class->section_id] as $student)
                                        <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                            <h2 class="poppins text-sm">{{ $student->user->profile->lastName }} {{ $student->user->profile->firstName }}
                                                {{ $student->user->profile->middleName }}</h2>
                                            {{-- <p>remarks</p> --}}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- Edit Faculty Modal --}}
        <div id="edit-facuty-modal" class="hidden absolute top-0 left-0 w-full h-auto md:h-screen z-50">
            <div class="w-full h-full flex flex-col justify-start space-y-6 px-4 md:px-32 py-8 md:pt-20 bg-black bg-opacity-10">
                <form id="edit-faculty-form" method="POST" action="javascript:void(0)"
                    class="w-full flex flex-col space-y-2 bg-white p-4 md:p-8 pt-0 rounded-lg shadow-md">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex pb-4">
                        <h1 class="poppins text-xl text-gray-800 font-medium">TEACHER'S INFORMATION</h1>
                    </div>

                    <div class="flex flex-col md:flex-row space-y-4 space-0 md:space-x-4 items-start">
                        <div class="flex flex-col space-y-1 items-start justify-start w-full md:w-1/3">
                            <label for="tag" class="poppins text-sm font-medium text-gray-700">Image
                                @error('cover_photo')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </label>
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div id="description"
                                    class="hidden flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click
                                            to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF</p>
                                </div>
                                <img id="image-preview" src="#" alt="Preview"
                                    class="hidden w-full h-full rounded-md" />
                                <img id="db-cover-photo" src="{{ asset('storage/' . $faculty->user->profile->image) }}"
                                    alt="Image" class="w-full h-full rounded-md" />
                                <input id="dropzone-file" type="file" name="image" class="hidden"
                                    accept="image/png, image/jpeg, image/gif" onchange="previewCoverPhoto(this)" />
                            </label>

                            <script>
                                function previewCoverPhoto(input) {
                                    var imagePreview = document.getElementById('image-preview');
                                    var dbCoverPhoto = document.getElementById('db-cover-photo');
                                    var description = document.getElementById('description');

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function(e) {
                                            imagePreview.src = e.target.result;
                                            imagePreview.classList.remove('hidden');
                                            dbCoverPhoto.classList.add('hidden');
                                            description.classList.add('hidden');
                                        };

                                        reader.readAsDataURL(input.files[0]);
                                    } else {
                                        imagePreview.src = '';
                                        imagePreview.classList.add('hidden');
                                        dbCoverPhoto.classList.add('hidden');
                                        description.classList.remove('hidden');
                                    }
                                }
                            </script>
                        </div>
                        <div class="w-full flex flex-col space-y-2">
                            <div class="w-full flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="first_name" class="poppins text-sm font-medium text-gray-600">FIRST
                                            NAME</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <input type="text" name="first_name" id="first_name"
                                        value="{{ $faculty->user->profile->firstName }}"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                        placeholder="Juan">
                                </div>

                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="last_name" class="poppins text-sm font-medium text-gray-600">LAST
                                            NAME</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <input type="text" name="last_name" id="last_name"
                                        value="{{ $faculty->user->profile->lastName }}"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                        placeholder="Cruz">
                                </div>

                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="middle_name"
                                            class="poppins text-sm font-medium text-gray-600">MIDDLE NAME</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <input type="text" name="middle_name" id="middle_name"
                                        value="{{ $faculty->user->profile->middleName }}"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                        placeholder="Reyes">
                                </div>

                                <div class="flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="suffix"
                                            class="poppins text-sm font-medium text-gray-600">SUFFIX</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <input type="text" name="suffix" id="suffix"
                                        value="{{ $faculty->user->profile->suffix }}"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full md:w-[60px]"
                                        placeholder="jr.">
                                </div>
                            </div>

                            <div  class="w-full flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="sex"
                                            class="poppins text-sm font-medium text-gray-600">SEX</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <select name="sex" id="sex"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full">
                                        <option value="Male"
                                            {{ $faculty->user->profile->sex == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female"
                                            {{ $faculty->user->profile->sex == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>

                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="contact_no"
                                            class="poppins text-sm font-medium text-gray-600">Contact No.</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <input type="text" name="contact_no" id="contact_no"
                                        value="{{ $faculty->user->profile->contactNumber }}"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                        placeholder="09123456789">
                                </div>

                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="contact_no" class="poppins text-sm font-medium text-gray-600">Date
                                            Of Birth</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <input type="date" name="dob" id="dob"
                                        value="{{ $faculty->user->profile->dob }}"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                        placeholder="09123456789">
                                </div>
                            </div>

                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="email"
                                        class="poppins text-sm font-medium text-gray-600">Email</label>
                                    <span class="error text-xs text-red-600"></span>
                                </div>
                                <input type="email" name="email" id="email"
                                    value="{{ $faculty->user->email }}"
                                    class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="sample@email.com">
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
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ ($faculty->department->id ?? null) == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                        <i class='bx bx-trash text-red-500 text-xl  cursor-pointer '></i>
                        <h1 class="poppins text-lg font-medium">Delete Faculty</h1>
                    </div>
                    <h1 class="poppins ">Are you sure you want to delete this Faculty?</h1>
                    <div class="flex justify-end space-x-2 pt-4">
                        <button id="delete-cancel"
                            class="poppins text-gray-700 bg-gray-200 rounded px-3 py-1 hover:bg-gray-300">Cancel</button>
                        <button class="delete-btn poppins text-white bg-red-500 rounded px-3 py-1">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guidance-layout>
<script type="module" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="module" src="{{ asset('js/faculty_show.js') }}"></script>
