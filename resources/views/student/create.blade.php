<x-guidance-layout>
    <div class="w-full p-4">

        <form action="{{ route('student.store') }}" method="post" class="">
            @csrf
            <div class="pb-6">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 pb-3">
                    Student's Personal Information
                </h2>
                <div class="flex items-start space-x-4 ">
                    <div class="flex flex-col space-y-1 items-start justify-start w-1/3">
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

                    <div class="w-2/3 flex-col space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="firstName" class="poppins text-sm font-medium text-gray-700">First
                                        Name</label>
                                    @error('firstName')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="firstName" id="firstName"
                                    class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="First Name">
                            </div>

                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="lastName" class="poppins text-sm font-medium text-gray-700">First
                                        Name</label>
                                    @error('lastName')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="lastName" id="lastName"
                                    class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="Last Name">
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="middleName" class="poppins text-sm font-medium text-gray-700">Middle
                                        Name</label>
                                    @error('middleName')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="middleName" id="middleName"
                                    class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="Middle Name">
                            </div>

                            <div class="w-full flex items-center space-x-4">
                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="suffix"
                                            class="poppins text-sm font-medium text-gray-700">Suffix</label>
                                        @error('suffix')
                                            <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="text" name="suffix" id="suffix"
                                        class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                        placeholder="Suffix">
                                </div>

                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="sex"
                                            class="poppins text-sm font-medium text-gray-700">Sex</label>
                                        @error('sex')
                                            <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <select name="sex" id="sex"
                                        class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="contactNumber" class="poppins text-sm font-medium text-gray-700">Contact
                                        Number
                                    </label>
                                    @error('contactNumber')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="contactNumber" id="contactNumber"
                                    class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="Mobile Number">
                            </div>

                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="dob" class="poppins text-sm font-medium text-gray-700">Date Of
                                        Birth
                                    </label>
                                    @error('dob')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="date" name="dob" id="dob"
                                    class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
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
            </div>

            <div class="pb-4">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 pb-3">
                    Student's Address
                </h2>
                <div class="flex flex-col space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="lot" class="poppins text-sm font-medium text-gray-700">
                                    Lot</label>
                                @error('lot')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="lot" id="lot"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Lot">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="block" class="poppins text-sm font-medium text-gray-700">
                                    Block</label>
                                @error('block')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="block" id="block"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Block">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="street" class="poppins text-sm font-medium text-gray-700">
                                    Street</label>
                                @error('street')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="street" id="street"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Street">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="subdivision" class="poppins text-sm font-medium text-gray-700">
                                    Subdivision</label>
                                @error('subdivision')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="subdivision" id="subdivision"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Subdivision">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="barangay" class="poppins text-sm font-medium text-gray-700">
                                    Barangay</label>
                                @error('barangay')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="barangay" id="barangay"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Barangay">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="city" class="poppins text-sm font-medium text-gray-700">
                                    City/Municipality</label>
                                @error('city')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="city" id="city"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="City/Municipality">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="province" class="poppins text-sm font-medium text-gray-700">
                                    Province</label>
                                @error('province')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="province" id="province"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Province">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="zipCode" class="poppins text-sm font-medium text-gray-700">
                                    Zip Code</label>
                                @error('zipCode')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="number" name="zipCode" id="zipCode"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Zip Code">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-4">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 pb-3">
                    Parent's Information
                </h2>
                <div class="flex-col space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="firstName" class="poppins text-sm font-medium text-gray-700">First
                                    Name</label>
                                @error('firstName')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="firstName" id="firstName"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="First Name">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="lastName" class="poppins text-sm font-medium text-gray-700">First
                                    Name</label>
                                @error('lastName')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="lastName" id="lastName"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Last Name">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="middleName" class="poppins text-sm font-medium text-gray-700">Middle
                                    Name</label>
                                @error('middleName')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="middleName" id="middleName"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Middle Name">
                        </div>

                        <div class="w-full flex items-center space-x-4">
                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="suffix"
                                        class="poppins text-sm font-medium text-gray-700">Suffix</label>
                                    @error('suffix')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" name="suffix" id="suffix"
                                    class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                    placeholder="Suffix">
                            </div>

                            <div class="w-full flex flex-col space-y-1">
                                <div class="flex items-baseline space-x-2">
                                    <label for="sex"
                                        class="poppins text-sm font-medium text-gray-700">Sex</label>
                                    @error('sex')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <select name="sex" id="sex"
                                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="contactNumber" class="poppins text-sm font-medium text-gray-700">Contact
                                    Number
                                </label>
                                @error('contactNumber')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="text" name="contactNumber" id="contactNumber"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
                                placeholder="Mobile Number">
                        </div>

                        <div class="w-full flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="dob" class="poppins text-sm font-medium text-gray-700">Date Of Birth
                                </label>
                                @error('dob')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="date" name="dob" id="dob"
                                class="poppins py-2 px-4 text-sm border-2 border-gray-200 rounded focus:outline-none focus:border-blue-500 w-full"
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

        </form>
    </div>
</x-guidance-layout>
