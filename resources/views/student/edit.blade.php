<x-guidance-layout>
    <div class="w-full p-4">
        <div class="flex flex-col space-y-2 pb-3">
            <a href="{{ route('student.show', $student->id) }}" id="back"
                class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>

        <form action="{{ route('student.update', $student->id) }}" method="POST" class=""
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="pb-6">
                <div class="pb-3">
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 ">
                        Student's Personal Information
                    </h2>
                    <p class="poppins text-xs italic text-blue-500">'<span class="text-red-500 text-base">*</span>'
                        indicates required fields.</p>
                </div>

                <div class="flex items-start space-x-4 ">
                    <div class="flex flex-col items-start justify-start min-w-[330px]">
                        <label for="tag" class="poppins text-sm font-medium text-gray-700">Image
                            @error('cover_photo')
                                <span class="text-xs font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </label>
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-72 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div id="description" class="hidden flex flex-col items-center justify-center pt-5 pb-6">
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
                            <img id="db-cover-photo" src="{{ asset('storage/' . $student->user->profile->image) }}"
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
                                    description.classList.add('hidden');
                                    dbCoverPhoto.classList.add('hidden');
                                }
                            }
                        </script>
                    </div>

                    <div class="w-full flex-col space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-full flex flex-col ">
                                <div class="flex items-baseline space-x-2">
                                    <label for="firstName" class="poppins text-sm font-medium text-gray-700">First Name
                                        <span class="text-red-500">*</span></label>
                                    @error('firstName')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="firstName" id="firstName"
                                    value="{{ old('firstName') ?? $student->user->profile->firstName }}"
                                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="First Name">
                            </div>

                            <div class="w-full flex flex-col ">
                                <div class="flex items-baseline space-x-2">
                                    <label for="lastName" class="poppins text-sm font-medium text-gray-700">Last Name
                                        <span class="text-red-500">*</span></label>
                                    @error('lastName')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="lastName" id="lastName"
                                    value="{{ old('lastName') ?? $student->user->profile->lastName }}"
                                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="Last Name">
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-full flex flex-col ">
                                <div class="flex items-baseline space-x-2">
                                    <label for="middleName" class="poppins text-sm font-medium text-gray-700">Middle
                                        Name</label>
                                    @error('middleName')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="middleName" id="middleName"
                                    value="{{ old('middleName') ?? $student->user->profile->middleName }}"
                                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="Middle Name">
                            </div>

                            <div class="w-full flex items-center space-x-4">
                                <div class="w-full flex flex-col ">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="suffix"
                                            class="poppins text-sm font-medium text-gray-700">Suffix</label>
                                        @error('suffix')
                                            <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="text" name="suffix" id="suffix"
                                        value="{{ old('suffix') ?? $student->user->profile->suffix }}"
                                        class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                        placeholder="Suffix">
                                </div>

                                <div class="w-full flex flex-col ">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="sex"
                                            class="poppins text-sm font-medium text-gray-700">Sex</label>
                                        @error('sex')
                                            <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <select name="sex" id="sex"
                                        class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full">
                                        <option value="Male"
                                            {{ old('sex') == 'Male' || $student->user->profile->sex == 'Male' ? 'selected' : '' }}>
                                            Male
                                        </option>
                                        <option value="Female"
                                            {{ old('sex') == 'Female' || $student->user->profile->sex == 'Female' ? 'selected' : '' }}>
                                            Female
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-full flex flex-col ">
                                <div class="flex items-baseline space-x-2">
                                    <label for="contactNumber"
                                        class="poppins text-sm font-medium text-gray-700">Contact Number</label>
                                    @error('contactNumber')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="contactNumber" id="contactNumber"
                                    value="{{ old('contactNumber') ?? $student->user->profile->contactNumber }}"
                                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="Contact Number">
                            </div>

                            <div class="w-full flex flex-col ">
                                <div class="flex items-baseline space-x-2">
                                    <label for="dob" class="poppins text-sm font-medium text-gray-700">Date Of
                                        Birth <span class="text-red-500">*</span></label>
                                    @error('dob')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="date" name="dob" id="dob"
                                    value="{{ old('dob') ?? $student->user->profile->dob }}"
                                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="Date Of Birth">

                                <script type="module">
                                    dobException();

                                    function dobException() {
                                        var maxDate = new Date();
                                        maxDate.setFullYear(maxDate.getFullYear() - 5);
                                        var maxDateString = maxDate.toISOString().slice(0, 10);

                                        var minDate = new Date();
                                        minDate.setFullYear(minDate.getFullYear() - 100);
                                        var minDateString = minDate.toISOString().slice(0, 10);

                                        $('#dob').attr('max', maxDateString);
                                        $('#dob').attr('min', minDateString);
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="w-full flex flex-col">
                            <div class="flex items-baseline space-x-2">
                                <label for="lrn" class="poppins text-sm font-medium text-gray-700">Learner's
                                    Reference Number (LRN) <span class="text-red-500">*</span></label>
                                @error('lrn')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="lrn" id="lrn"
                                value="{{ old('lrn') ?? $student->lrn }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Learner's Reference Number">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-4">
                <div class="pb-3">
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 ">
                        Student's Address
                    </h2>
                    <p class="poppins text-xs italic text-blue-500">'<span class="text-red-500 text-base">*</span>'
                        indicates required fields.</p>
                </div>
                <div class="flex flex-col space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="lot" class="poppins text-sm font-medium text-gray-700">Lot</label>
                                @error('lot')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="lot" id="lot"
                                value="{{ old('lot') ?? $student->user->profile->address->lot }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Lot">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="block" class="poppins text-sm font-medium text-gray-700">Block</label>
                                @error('block')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="block" id="block"
                                value="{{ old('block') ?? $student->user->profile->address->block }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Block">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="street" class="poppins text-sm font-medium text-gray-700">Street</label>
                                @error('street')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="street" id="street"
                                value="{{ old('street') ?? $student->user->profile->address->street }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Street">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="subdivision"
                                    class="poppins text-sm font-medium text-gray-700">Subdivision</label>
                                @error('subdivision')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="subdivision" id="subdivision"
                                value="{{ old('subdivision') ?? $student->user->profile->address->subdivision }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Subdivision">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="barangay" class="poppins text-sm font-medium text-gray-700">Barangay <span
                                        class="text-red-500">*</span></label>
                                @error('barangay')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="barangay" id="barangay"
                                value="{{ old('barangay') ?? $student->user->profile->address->barangay }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Barangay">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="city"
                                    class="poppins text-sm font-medium text-gray-700">City/Municipality <span
                                        class="text-red-500">*</span></label>
                                @error('city')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="city" id="city"
                                value="{{ old('city') ?? $student->user->profile->address->city }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="City/Municipality">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="province" class="poppins text-sm font-medium text-gray-700">Province <span
                                        class="text-red-500">*</span></label>
                                @error('province')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="province" id="province"
                                value="{{ old('province') ?? $student->user->profile->address->province }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Province">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="zipCode" class="poppins text-sm font-medium text-gray-700">Zip
                                    Code</label>
                                @error('zipCode')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="number" name="zipCode" id="zipCode"
                                value="{{ old('zipCode') ?? $student->user->profile->address->zipCode }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Zip Code">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-4">
                <div class="pb-3">
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 ">
                        Parent's Information
                    </h2>
                    <p class="poppins text-xs italic text-blue-500">'<span class="text-red-500 text-base">*</span>'
                        indicates required fields.</p>
                </div>
                <div class="flex-col space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parentsFirstName" class="poppins text-sm font-medium text-gray-700">First
                                    Name <span class="text-red-500">*</span></label>
                                @error('parentsFirstName')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="parentsFirstName" id="parentsFirstName"
                                value="{{ old('parentsFirstName') ?? ($student->guardian->profile->firstName ?? '') }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="First Name">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parentsLastName" class="poppins text-sm font-medium text-gray-700">Last
                                    Name <span class="text-red-500">*</span></label>
                                @error('parentsLastName')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="parentsLastName" id="parentsLastName"
                                value="{{ old('parentsLastName') ?? ($student->guardian->profile->lastName ?? '') }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Last Name">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parentsMiddleName"
                                    class="poppins text-sm font-medium text-gray-700">Middle
                                    Name</label>
                                @error('parentsMiddleName')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="parentsMiddleName" id="parentsMiddleName"
                                value="{{ old('parentsMiddleName') ?? ($student->guardian->profile->middleName ?? '') }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Middle Name">
                        </div>

                        <div class="w-full flex items-center space-x-4">
                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="parentsSuffix"
                                        class="poppins text-sm font-medium text-gray-700">Suffix</label>
                                    @error('parentsSuffix')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="parentsSuffix" id="parentsSuffix"
                                    value="{{ old('parentsSuffix') ?? ($student->guardian->profile->suffix ?? '') }}"
                                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="Suffix">
                            </div>

                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="parentsSex"
                                        class="poppins text-sm font-medium text-gray-700">Sex</label>
                                    @error('parentsSex')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <select name="parentsSex" id="parentsSex"
                                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full">
                                    <option value="Male"
                                        {{ old('sex') == 'Male' || ($student->guardian->profile->sex ?? '') == 'Male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="Female"
                                        {{ old('sex') == 'Female' || ($student->guardian->profile->sex ?? '') == 'Female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parentsContactNumber"
                                    class="poppins text-sm font-medium text-gray-700">Contact Number </label>
                                @error('parentsContactNumber')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="parentsContactNumber" id="parentsContactNumber"
                                value="{{ old('parentsContactNumber') ?? ($student->guardian->profile->contactNumber ?? '') }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Mobile Number">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="parentsDob" class="poppins text-sm font-medium text-gray-700">Date Of
                                    Birth <span class="text-red-500">*</span></label>
                                @error('parentsDob')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="date" name="parentsDob" id="parentsDob"
                                value="{{ old('parentsDob') ?? ($student->guardian->profile->dob ?? '') }}"
                                class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Date Of Birth">

                            <script type="module">
                                dobException();

                                function dobException() {
                                    var maxDate = new Date();
                                    maxDate.setFullYear(maxDate.getFullYear() - 5);
                                    var maxDateString = maxDate.toISOString().slice(0, 10);

                                    var minDate = new Date();
                                    minDate.setFullYear(minDate.getFullYear() - 100);
                                    var minDateString = minDate.toISOString().slice(0, 10);

                                    $('#dob').attr('max', maxDateString);
                                    $('#dob').attr('min', minDateString);
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-start">
                <button type="submit"
                    class="px-4 py-2 rounded text-white bg-blue-600 hover:bg-blue-700 poppins">Submit</button>
            </div>
        </form>
    </div>
</x-guidance-layout>
