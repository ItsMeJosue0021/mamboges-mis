<x-guidance-layout>
    <div id="container" class="w-full flex flex-col p-4 px-6 pb-0 relative">
        <div class="flex flex-col space-y-2">
            <a href="{{ route('student.index') }}" id="back"
                class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>

        <div class="w-full flex flex-col space-y-6 py-4">
            <div class="w-full h-auto flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                <div class="w-full md:min-w-[230px] md:w-[210px] md:h-[220px] md:rounded-full border border-gray-200 shadow relative">
                    <img src="{{ $student->user->profile->image ? asset('storage/' . $student->user->profile->image) : asset('image/mamboges.jpg') }}"
                        alt="" class="w-full h-full rounded-md md:rounded-full">

                    <div class="md:hidden flex flex-col items-start space-y-2 absolute right-2 top-2">
                        <a href="{{ route('student.edit', $student->id) }}">
                            <i
                                class='bx bx-edit text-blue-500 text-xl cursor-pointer rounded bg-blue-50 py-1 px-2'></i>
                        </a>
                        <a href="{{ route('student.archiving-info', $student->id) }}">
                            <i
                                class='bx bx-trash text-red-500 text-xl rounded bg-red-50 cursor-pointer py-1 px-2'></i>
                        </a>
                    </div>
                </div>

                <div class="w-full h-fit flex justify-between md:p-2 rounded space-x-4 md:border border-gray-200">
                    <div class="w-full flex flex-col">
                        <div class="flex items-center space-x-2 border border-gray-300 py-1 px-2 bg-blue-100 rounded-t">
                            <span class="poppins text-2xl font-medium">{{ $student->user->profile->firstName }}</span>
                            <span class="poppins text-2xl font-medium">{{ $student->user->profile->middleName }}</span>
                            <span class="poppins text-2xl font-medium">{{ $student->user->profile->lastName }}</span>
                        </div>
                        <div class="flex items-center justify-between border border-gray-300 border-t-0 py-1 px-2">
                            <span class="poppins text-sm">Bithdate: </span>
                            <span
                                class="poppins text-sm">{{ date('F j, Y', strtotime($student->user->profile->dob)) }}</span>
                        </div>
                        <div class="flex items-center justify-between border border-gray-300 border-t-0 py-1 px-2">
                            <span class="poppins text-sm">Sex: </span>
                            <span class="poppins text-sm">{{ $student->user->profile->sex }}</span>
                        </div>
                        <div class="flex items-center justify-between border border-gray-300 border-t-0 py-1 px-2">
                            <span class="poppins text-sm">Grade Level: </span>
                            <span class="poppins text-sm">{{ $section->gradeLevel ?? 'Student Unenrolled' }}</span>
                        </div>
                        <div class="flex items-center justify-between border border-gray-300 border-t-0 py-1 px-2">
                            <span class="poppins text-sm">Section: </span>
                            <span class="poppins text-sm">{{ $section->name ?? 'Student Unenrolled' }}</span>
                        </div>
                        <div
                            class="flex items-center justify-between border border-gray-300 border-t-0 py-1 px-2 rounded-b">
                            <span class="poppins text-sm">LRN: </span>
                            <span class="poppins text-sm">{{ $student->lrn }}</span>
                        </div>
                    </div>

                    <div class="hidden md:flex items-start">
                        <div class="flex flex-col items-start space-y-2">
                            <a href="{{ route('student.edit', $student->id) }}">
                                <i
                                    class='bx bx-edit text-blue-500 text-xl cursor-pointer rounded bg-blue-50 py-1 px-2'></i>
                            </a>
                            <a href="{{ route('student.archiving-info', $student->id) }}">
                                <i
                                    class='bx bx-trash text-red-500 text-xl rounded bg-red-50 cursor-pointer py-1 px-2'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex flex-col-reverse md:flex-row md:space-x-4">
                <div class="w-full md:w-2/3 h-auto min-h-[500px] flex justify-center items-start">
                    <div class="w-full flex flex-col space-y-2">
                        @foreach ($classes as $class)
                            <div tabindex="0" class="collapse collapse-arrow border border-gray-200 rounded bg-white">
                                <div class="collapse-title">
                                    <p class="font-bold">
                                        @if ($class->section->gradeLevel != 'Kinder')
                                            Grade {{ $class->section->gradeLevel }}
                                        @else
                                            {{ $class->section->gradeLevel }}
                                        @endif
                                        - {{ $class->section->name }}
                                    </p>
                                    <p class="text-sm">
                                        {{ $class->section->faculty ? $class->section->faculty->user->profile->firstName : '' }}
                                        {{ $class->section->faculty ? $class->section->faculty->user->profile->middleName : '' }}
                                        {{ $class->section->faculty ? $class->section->faculty->user->profile->lastName : '' }}
                                     </p>
                                </div>
                                <div class="collapse-content p-0">
                                    @foreach ($class->section->sectionSubjects as $sectionSubject)
                                        <div class="border border-gray-200 bg-white mb-6 p-4">
                                            <div class="border border=gray-300 p-2 mb-4">
                                                <h2 class="font-bold text-sm last:uppercase text-gray-700 w-full flex justify-between items-center">
                                                    <span>SUBJECT: {{ $sectionSubject->subjects->name }}</span>
                                                    <span class="">TEACHER:
                                                        {{ $sectionSubject->faculty ? $sectionSubject->faculty->user->profile->firstName : '' }}
                                                        {{ $sectionSubject->faculty ? $sectionSubject->faculty->user->profile->middleName : '' }}
                                                        {{ $sectionSubject->faculty ? $sectionSubject->faculty->user->profile->lastName : ''}}
                                                    </span>
                                                </h2>
                                            </div>
                                            <div>
                                                @php
                                                    $student_grades = $grades->where('subjects_id', $sectionSubject->subjects->id)
                                                                            ->where('school_year_id', $sectionSubject->schoolYear->id);
                                                @endphp
                                                @foreach ($student_grades as $grade)
                                                    <div class="flex justify-between py-2 px-4 border-t border-gray-200">
                                                        <span class="text-sm">{{ $grade->quarter->name }}</span>
                                                        <span class="text-sm">{{ $grade->remarks }}</span>
                                                    </div>
                                                @endforeach

                                                @if (count($student_grades) == 0)
                                                    <div class="flex justify-center py-2 ">
                                                        <span class="text-xs text-center text-red-500">No Grades</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="w-full md:w-1/3 h-full  mb-4 md:mb-0">
                    <div class="w-full rounded border border-gray-200 p-4">
                        <h1 class="poppins font-medium text-lg border-b border-gray-300 mb-2">Parents information</h1>
                        <div>
                            <span class="font-medium">Name:</span>
                            <span>
                                {{ $student->guardian->profile->suffix ?? '' }}
                                {{ $student->guardian->profile->firstName ?? '' }}
                                {{ $student->guardian->profile->middleName ?? ''}}
                                {{ $student->guardian->profile->lastName ?? 'No Record' }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium">Date Of Birth:</span>
                            <span> {{ $student->guardian->profile->dob ?? 'No Record' }} </span>
                        </div>
                        <div>
                            <span class="font-medium">Sex:</span>
                            <span> {{ $student->guardian->profile->sex ?? 'No Record' }} </span>
                        </div>
                        <div>
                            <span class="font-medium">Contact Number:</span>
                            <span> {{ $student->guardian->profile->contactNumber ?? 'No Record' }} </span>
                        </div>
                    </div>

                    <div>

                    </div>
                </div>
            </div>

        </div>


        {{-- ADD STUDENT MODAL --}}
        {{-- <x-updatestudent-modal :student="$student" :parent="$parent"/> --}}

        {{-- DELETE STUDENT MODAL --}}
        <div id="delete-modal" class="hidden absolute top-0 left-0 w-full h-full">
            <div class="flex flex-col w-full h-full items-center justify-start space-y-6 bg-black bg-opacity-5 ">
                <div class="flex flex-col p-4 rounded-md bg-white shadow-lg space-y-3 mt-60" id="delete-student-id">
                    <div class="flex space-x-2">
                        <i class='bx bx-trash text-red-500 text-xl  cursor-pointer '></i>
                        <h1 class="poppins text-lg font-medium">Delete Student</h1>
                    </div>
                    <h1 class="poppins text-base">Are you sure you want to delete this Student?</h1>
                    <div class="flex flex-col space-y-1 pt-3 border-t border-gray-200">
                        <label for="reason" class="poppins text-sm">Please specify your reason:</label>
                        <select name="reason" id="reason" class="poppins text-sm border border-gray-300 rounded">
                            <option value="" disabled selected>Select a reason</option>
                            <option value="No Longer Participating">No Longer Participating</option>
                            <option value="Transfered To Another School">Transfered To Another School</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('js/student_show.js') }}"></script>
