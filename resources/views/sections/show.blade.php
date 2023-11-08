<x-guidance-layout>
    <div id="container" class="w-full flex flex-col p-4 pb-0 relative h-auto min-h-screen">
        <div class="flex flex-col space-y-2 mb-4">
            <a href="{{ route('sections.index') }}" id="back" class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>
        <div class="w-full h-auto min-h-600px flex flex-col items-start justify-start space-y-2">
            <div class=" get-id w-full h-auto flex justify-between items-center border border-gray-200 rounded p-3 shadow bg-blue-800 " id="{{$section->id}}">
                <div class="w-full flex justify-between">
                    <div class="flex flex-col">
                        <div class="flex space-x-2 items-start">
                            <h1 class="poppins text-2xl font-medium text-white">{{$section->name}}</h1>
                        </div>
                        <h2 class="poppins text-lg text-gray-200">
                            @if ($section->faculty)
                                {{ $section->faculty->user->profile->suffix }}
                                {{ $section->faculty->user->profile->firstName }}
                                {{ $section->faculty->user->profile->middleName }}
                                {{ $section->faculty->user->profile->lastName }}
                            @else
                                <span class="poppins text-sm text-gray-300">No Adviser</span>
                            @endif
                        </h2>
                        <div class="flex space-x-4">
                            <h2 class="poppins text-sm text-white bg-blue-500 px-2 w-fit">
                                @if ($section->gradeLevel != 'Kinder')
                                    Grade {{ $section->gradeLevel }}
                                @else
                                    {{ $section->gradeLevel }}
                                @endif
                            </h2>
                            <h3 class="poppins text-sm font-medium text-gray-400">S.Y. {{$school_year->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col border-2 border-gray-400 justify-center items-center py-2 px-4 h-full rounded">
                    <h1 id="student-count" class="poppins text-gray-200 text-2xl font-bold">0</h1>
                    <h1 class="poppins text-gray-300 text-xs font-bold">STUDENTS</h1>
                </div>
            </div>

            <div class="w-full">
                <div class="w-full flex space-x-8 py-2">
                    <div class="w-full flex items-center space-x-4  py-1">
                        <h1 class="poppins text-lg text-gray-700 font-medium px-2 py-1 rounded border-l-3 border-gray-400">STUDENTS</h1>
                        <a id="add-student" class="poppins py-1 px-4 text-sm text-white font-medium cursor-pointer rounded flex items-center bg-blue-600 hover:scale-105">
                            <i class='bx bx-user-plus text-lg px-1'></i>
                            Add
                        </a>
                    </div>

                    <div class="w-full flex items-center space-x-4 py-1">
                        <h1 class="poppins text-lg text-gray-700 font-medium px-2 py-1 rounded border-l-3 border-gray-400">SUBJECTS</h1>
                        <a id="add-subject" class="poppins py-1 px-4 text-sm text-white font-medium cursor-pointer rounded flex items-center bg-blue-600 hover:scale-105">
                            <i class='bx bx-list-plus text-lg px-1'></i>
                            Add
                        </a>
                    </div>
                </div>

                <div class="w-full flex space-x-8">
                    <div id="students-list1" class="w-full h-auto"></div>
                    <div id="subjects-list" class="w-full h-auto"></div>
                </div>

            </div>
        </div>

        {{-- ADD STUDENT MODAL --}}
        <div id="add-student-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center space-y-6  bg-black bg-opacity-5">
                <div class="flex flex-col h-full w-full bg-white p-6 rounded-md shadow-2xl">
                    <div class="w-full flex flex-col">

                        <x-scripts.modal-search-student />

                        <div class="px-4">
                            <h2 class="text-3xl font-bold">Enroll Student</h2>
                        </div>

                        <div class="w-full flex space-x-4">
                            <div class="w-1/2 h-fit max-h-[500px] overflow-y-auto p-4">
                                <div class="mb-3">
                                    <h1 class="poppins text-base font-medium">Search Student</h1>
                                    <input type="text" name="search-student" id="search-student"
                                    class="poppins w-full py-2 px-4 text-base border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 mr-3"
                                    placeholder="Seach for student.."/>
                                </div>

                                <div id="students-list-container"></div>
                            </div>
                            <div class="w-1/2 h-fit max-h-[500px] overflow-auto p-4">
                                <h1 class="poppins text-base py-2 font-medium">Current Student</h1>
                                <div id="students-list2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-start space-x-4 pt-4 px-4 ">
                        <button id="done"
                            class="poppins text-sm font-medium text-white bg-blue-600 hover:bg-blue-700  border border-blue-600 hover:border-blue-700 py-2 px-8 ">
                            Done
                        </button>

                        <a id="add-cancel"
                            class="poppins text-sm font-medium text-gray-400 border border-gray-400 hover:border-red-600 hover:text-red-600 py-2 px-6 cursor-pointer">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>

         {{-- ADD SUBJECT MODAL --}}
         <div id="add-subject-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-start space-y-6 bg-black bg-opacity-5 pt-40">
                <div class="flex flex-col w-fit items-center justify-center space-y-6 bg-white p-6 rounded-md shadow-lg">

                    <x-scripts.modal-add-subject />

                    <form id="add-subject-form" method="POST" action="javascript:void(0)" class="w-700px flex flex-col space-y-3">
                        @csrf
                        <div class="w-full flex">
                            <h1 class="poppins text-xl text-gray-800 font-medium">ADD SUBJECTS</h1>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="subject"
                                class="poppins text-sm font-medium text-gray-600">SUBJECT</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="subjectId" id="subject"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option disabled selected value="">Select a Subject</option>
                                @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <div class="flex items-baseline space-x-2">
                                <label for="teacher"
                                class="poppins text-sm font-medium text-gray-600">SUBJECT TEACHER</label>
                                <span class="error text-xs text-red-600"></span>
                            </div>
                            <select name="facultyId" id="teacher"
                            class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option disabled selected value="">Select a Teacher</option>
                                @foreach ($faculties as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->user->profile->suffix}} {{$teacher->user->profile->firstName}} {{$teacher->user->profile->lastName}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-start space-x-4 pt-4 ">
                            <button id="add-subject-button" type="submit"
                                class="poppins text-sm font-medium text-white bg-blue-600 hover:bg-blue-700  border border-blue-600 hover:border-blue-700 py-2 px-8 ">
                                Add
                            </button>

                            <a id="add-subject-cancel"
                                class="poppins text-sm font-medium text-gray-400 border border-gray-400 hover:border-red-600 hover:text-red-600 py-2 px-6  cursor-pointer">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guidance-layout>



<script type="module">
    const add_student_btn = $('#add-student');
    const add_student_modal = $('#add-student-modal');

    add_student_btn.click(function() {
        add_student_modal.removeClass('hidden');
    });

    const add_cancel = $('#add-cancel');
    const done = $('#done');

    add_cancel.click(function() {
        add_student_modal.addClass('hidden');
    });

    done.click(function() {
        add_student_modal.addClass('hidden');
    });


    const add_subject_btn = $('#add-subject');
    const add_subject_modal = $('#add-subject-modal');

    add_subject_btn.click(function() {
        add_subject_modal.removeClass('hidden');
    });

    const add_subject_cancel = $('#add-subject-cancel');

    add_subject_cancel.click(function() {
        add_subject_modal.addClass('hidden');
    });
</script>
