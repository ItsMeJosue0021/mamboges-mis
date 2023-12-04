<div id="add-modal" class="hidden absolute top-0 left-0 w-full h-screen z-50">
    <div class="flex flex-col w-full h-full items-center justify-center space-y-6 bg-black bg-opacity-10 p-4">
        <div class="flex flex-col w-full md:w-fit items-center justify-center space-y-6 bg-white p-6 rounded-md shadow-lg">
            <form id="section-form" method="POST" action="javascript:void(0)" class="w-full md:w-[700px] flex flex-col space-y-3">
                @csrf
                <div class="w-full flex">
                    <h1 class="poppins text-xl text-gray-800 font-medium">NEW SECTION</h1>
                </div>
                <div class="flex flex-col space-y-1">
                    <div class="flex items-baseline space-x-2">
                        <label for="name"
                        class="poppins text-sm font-medium text-gray-600">SECTION NAME</label>
                        <span class="error text-xs text-red-600"></span>
                    </div>
                    <input type="text" name="name" id="name"
                    class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="Section Name">
                </div>

                <div class="flex flex-col space-y-1">
                    <div class="flex items-baseline space-x-2">
                        <label for="grade_level"
                        class="poppins text-sm font-medium text-gray-600">GRADE LEVEL</label>
                        <span class="error text-xs text-red-600"></span>
                    </div>
                    <select name="grade_level" id="grade_level"
                    class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <option disabled selected value="">Select Grade Level</option>
                        <option value="Kinder">Kinder</option>
                        <option value="1">Grade 1</option>
                        <option value="2">Grade 2</option>
                        <option value="3">Grade 3</option>
                        <option value="4">Grade 4</option>
                        <option value="5">Grade 5</option>
                        <option value="6">Grade 6</option>
                    </select>
                </div>

                <div class="flex flex-col space-y-1">
                    <div class="flex items-baseline space-x-2">
                        <label for="adviser"
                        class="poppins text-sm font-medium text-gray-600">ADVISER</label>
                        <span class="error text-xs text-red-600"></span>
                    </div>
                    <select name="adviser" id="adviser"
                    class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <option disabled selected value="">Select Adviser</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{$faculty->id}}">
                                {{$faculty->user->profile->suffix ?? ''}}
                                {{$faculty->user->profile->firstName}}
                                {{$faculty->user->profile->lastName}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-start space-x-4 pt-4 ">
                    <button type="submit"
                        class="poppins text-SM font-medium text-white bg-blue-600 hover:bg-blue-700  border border-blue-600 hover:border-blue-700 py-2 px-8 rounded">
                        Save
                    </button>

                    <a id="add-cancel"
                        class="poppins text-SM font-medium text-gray-400 border border-gray-400 hover:border-gray-600 hover:text-gray-600 py-2 px-6 rounded cursor-pointer">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    <x-scripts.modal-new-section />
</div>
