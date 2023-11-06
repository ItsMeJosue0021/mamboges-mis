<x-guidance-layout>
    <div id="container" class="w-full relative">

        <div class="flex justify-between items-center px-4 py-4 border-b border-gray-300">
            <div class="flex border-l-4 border-red-400 py-1 px-2">
                <h1 class="poppins text-2xl font-medium">DEPARTMENTS</h1>
            </div>
            <div class="flex">
                <a id="add-department"
                    class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">New
                    Department</a>
            </div>
        </div>

        <div class="h-600px px-4 overflow-auto w-full">
            <div class="h-full flex flex-col">
                <a class="flex justify-between py-1 px-4 border-b border-gray-300  items-center">
                    <p class="w-full poppins text-lg font-semibold">DEPARTMENT NAME</p>
                    <p class="w-full poppins text-lg font-semibold">DEPARTMENT HEAD</p>

                    <div class="flex items-center space-x-2 h-fit">
                        <i class='bx bx-trash text-gray-500 text-xl py-1 px-2 bg-red-50'></i>
                        <i class='bx bx-edit text-gray-500 text-xl py-1 px-2  bg-blue-50'></i>
                    </div>
                </a>
                @if (count($departments) == 0)
                    <div class="w-full h-96 flex flex-col items-center justify-center mt-20">
                        <img class="h-60 w-60" src="{{ asset('image/search.png') }}" alt="">
                        <p class="poppins text-xl  text-red-500 mt-5">Oops! No result found.</p>
                        <a class="poppins text-xm text-blue-500 underline" href="/departments">refresh</a>
                    </div>
                @endif
                @foreach ($departments as $department)
                    <a class="w-full flex">
                        <div class="flex justify-between py-1 px-4 border-b border-gray-300 items-center">
                            <p class="w-full poppins text-base font-normal">
                                {{ $department->name }}
                            </p>

                            @php
                                $faculty = App\Models\Faculty::where('id', $department->faculty_id)->first();
                            @endphp

                            @if ($faculty)
                                <p class="w-full poppins text-base font-normal">
                                    {{$faculty->user->profile->suffix ?? ''}}
                                    {{$faculty->user->profile->firstName}}
                                    {{$faculty->user->profile->lastName}}
                                </p>
                            @endif

                            <div class="flex items-center space-x-2 h-fit">
                                <a class="show-delete-modal py-1 px-2 rounded hover:bg-red-50"
                                    data-department-id="{{ $department->id }}">
                                    <i class='bx bx-trash text-red-500 text-xl  cursor-pointer '></i>
                                </a>
                                <a class="edit-btn py-1 px-2 rounded hover:bg-blue-50"
                                    data-department-id="{{ $department->id }}">
                                    <i class='bx bx-edit text-blue-500 text-xl cursor-pointer '></i>
                                </a>
                            </div>
                        </div>
                    </a>
                @endforeach
                <div>

                    <div id="add-department-modal" class="hidden absolute top-0 left-0 w-full h-full overflow-auto">
                        <div
                            class="w-full h-full flex flex-col items-center justify-center space-y-6 px-32 py-8 bg-black bg-opacity-10">
                            <form id="department-form" method="POST" action="/departments/save"
                                class="w-full flex flex-col space-y-6 bg-white p-8 pt-0 rounded-lg shadow-md">
                                @csrf
                                <div class="w-full flex py-4">
                                    <h1 class="poppins text-xl text-gray-800 font-medium">NEW DEPARTMENT</h1>
                                </div>

                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="department_name"
                                            class="poppins text-sm font-medium text-gray-600">Department Name</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <input type="text" name="department_name" id="department_name"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                        placeholder="Departmen Name">
                                </div>

                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="department_head"
                                            class="poppins text-sm font-medium text-gray-600">Department Head</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <select name="department_head" id="department_head"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                        <option disabled selected value="">Select Department Head</option>
                                        @foreach ($faculties as $faculty)
                                            <option value="{{ $faculty->id }}">
                                                {{ $faculty->user->profile->suffix ?? '' }}
                                                {{ $faculty->user->profile->firstName }}
                                                {{ $faculty->user->profile->lastName }}
                                                {{ $faculty->user->profile->middleName }}</option>
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

                    <div id="delete-modal" class="hidden absolute top-0 left-0 w-full h-full">
                        <div
                            class="flex flex-col w-full h-full items-center justify-start space-y-6 bg-black bg-opacity-10 ">
                            <div class="flex flex-col p-4 rounded-md bg-white shadow-lg space-y-2 mt-60"
                                id="delete-department-id">
                                <div class="flex space-x-2">
                                    <i class='bx bx-trash text-red-500 text-xl  cursor-pointer '></i>
                                    <h1 class="poppins text-lg font-medium">Delete Faculty</h1>
                                </div>
                                <h1 class="poppins ">Are you sure you want to delete this Faculty?</h1>
                                <div class="flex justify-end space-x-2 pt-4">
                                    <button id="delete-cancel"
                                        class="poppins text-gray-700 bg-gray-200 rounded px-3 py-1 hover:bg-gray-300">Cancel</button>
                                    <button
                                        class="delete-btn poppins text-white bg-red-500 rounded px-3 py-1">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="edit-department-modal" class="hidden absolute top-0 left-0 w-full h-full overflow-auto">
                        <div
                            class="w-full h-full flex flex-col items-center justify-center space-y-6 px-32 py-8 bg-black bg-opacity-10">
                            {{-- action="/departments/save" action="javascript:void(0)" --}}
                            <form id="edit-department-form" method="POST" action="javascript:void(0)"
                                class="w-full flex flex-col space-y-6 bg-white p-8 pt-0 rounded-lg shadow-md">
                                @csrf
                                @method('PUT')
                                <div class="w-full flex py-4">
                                    <h1 class="poppins text-xl text-gray-800 font-medium">EDIT DEPARTMENT</h1>
                                </div>

                                <div class="w-full flex flex-col space-y-1" id="edit-department-id">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="edit_department_name"
                                            class="poppins text-sm font-medium text-gray-600">Department Name</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <input type="text" name="edit_department_name" id="edit_department_name"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500 w-full"
                                        placeholder="Departmen Name">
                                </div>

                                <div class="w-full flex flex-col space-y-1">
                                    <div class="flex items-baseline space-x-2">
                                        <label for="edit_department_head"
                                            class="poppins text-sm font-medium text-gray-600">Department Head</label>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <select name="edit_department_head" id="edit_department_head"
                                        class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                        <option disabled selected value="">Select Department Head</option>
                                        @foreach ($faculties as $faculty)
                                            <option value="{{ $faculty->id }}">{{ $faculty->user->profile->suffix }}
                                                {{ $faculty->user->profile->firstName }}
                                                {{ $faculty->user->profile->lastName }}
                                                {{ $faculty->user->profile->middleName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex items-center justify-start space-x-4 pt-4 ">
                                    <button type="submit"
                                        class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                                        Update
                                    </button>

                                    <a id="edit-cancel"
                                        class="poppins text-base font-medium text-blue-400 border border-blue-400 hover:border-blue-600 hover:text-blue-600 py-2 px-6 rounded cursor-pointer">
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
<script type="module" src="{{ asset('js/department_index.js') }}"></script>
