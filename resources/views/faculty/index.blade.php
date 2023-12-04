<x-guidance-layout>
    <div id="container" class="w-full">

        <div class="flex justify-between items-center px-4 py-4 border-b border-gray-300">
            <h1 class="hidden md:block poppins text-2xl font-medium">FACULTY</h1>
            <div class="w-full md:w-2/3 flex">
                <form action="{{ route('faculties.index') }}" class="flex w-full items-center justify-between md:justify-end space-x-4">
                    <div class="flex items-center space-x-2 p-1">
                        <input name="search" type="text" placeholder="Type here.."
                            class="w-full md:w-[500px] poppins text-sm focus:outline-none focus:bg-blue-100 border border-gray-400 rounded focus:border-blue-400 py-2 px-4">
                        <button type="submit"
                            class="poppins bg-gray-600 hover:bg-blue-600 rounded px-6 py-1  flex justify-center items-center">
                            <i class='bx bx-search text-white text-lg'></i>
                        </button>
                    </div>
                    <a id="add-faculty" class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">Add </a>
                </form>
            </div>
        </div>

        <div class="w-full h-full flex flex-col space-y-1 p-4">
            @if (count($faculties) == 0)
                <div class="w-full flex justify-center items-center rounded p-2 border border-gray-300">
                    <span class="font-semibold text-base poppins">No results found.</span>
                </div>
            @endif
            @foreach ($faculties as $faculty)
                <div class="w-full flex items-center justify-between rounded p-2 border border-gray-300">
                    <div class="w-full flex items-center space-x-3">
                        <img src="{{ $faculty->user->profile->image ? asset('storage/' . $faculty->user->profile->image) : asset('image/mamboges.jpg') }}"
                            alt="" srcset="" class="w-10 h-10 rounded">

                        <p class="poppins text-base font-semibold group-hover:text-blue-500">
                            {{ $faculty->user->profile->firstName }}
                            {{ $faculty->user->profile->middleName ?? '' }}
                            {{ $faculty->user->profile->lastName }}
                            {{ $faculty->user->profile->suffix ?? '' }}
                        </p>
                    </div>

                    <p class="hidden md:block w-full poppins text-sm group-hover:text-blue-500">
                        {{ $faculty->department->name ?? '' }}
                    </p>

                    <a href="{{ route('faculties.show', $faculty->id) }}"
                        class="poppins py-2 px-4 bg-blue-600 text-xs text-white font-medium rounded cursor-pointer">View</a>
                </div>
            @endforeach
        </div>

        {{-- Add Faculty Modal --}}
        <div id="add-facuty-modal" class="hidden absolute top-0 left-0 w-full h-auto md:h-screen z-50">
            <div class="w-full h-full flex flex-col items-center justify-center space-y-6 px-4 md:px-32 py-8 bg-black bg-opacity-10">
                <form id="faculty-form" method="POST" action="javascript:void(0)"
                    class="w-full flex flex-col space-y-2 bg-white p-4 md:p-8 pt-0 rounded-lg shadow-md">
                    @csrf
                    <div class="w-full flex py-4">
                        <h1 class="poppins text-xl text-gray-800 font-medium">TEACHER'S INFORMATION</h1>
                    </div>

                    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 items-start">
                        <div class="flex flex-col space-y-1 items-start justify-start w-full md:w-1/3">
                            <label for="tag" class="poppins text-sm font-medium text-gray-700">Image
                                @error('cover_photo')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </label>
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div id="description" class="flex flex-col items-center justify-center pt-5 pb-6">
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
                                <input id="dropzone-file" type="file" name="image" class="hidden"
                                    accept="image/png, image/jpeg, image/gif" onchange="previewCoverPhoto(this)" />
                            </label>

                            <script>
                                function previewCoverPhoto(input) {
                                    var imagePreview = document.getElementById('image-preview');
                                    var description = document.getElementById('description');

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function(e) {
                                            imagePreview.src = e.target.result;
                                            imagePreview.classList.remove('hidden');
                                            description.classList.add('hidden');
                                        };

                                        reader.readAsDataURL(input.files[0]);
                                    } else {
                                        imagePreview.src = '';
                                        imagePreview.classList.add('hidden');
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
                                        class="w-full poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 md:w-[60px]"
                                        placeholder="jr.">
                                </div>
                            </div>

                            <div class="w-full flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
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
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-start space-x-4 pt-4 ">
                        <button type="submit"
                            class="poppins text-base font-medium text-white bg-blue-600 hover:bg-blue-700  border border-blue-600 hover:border-blue-700 py-2 px-8 rounded">
                            Save
                        </button>

                        <a id="cancel"
                            class="poppins text-base font-medium text-blue-600 border border-blue-600 hover:border-blue-700 hover:text-blue-700 py-2 px-6 rounded cursor-pointer">
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
<script type="module" src="{{ asset('js/faculty_index.js') }}"></script>
