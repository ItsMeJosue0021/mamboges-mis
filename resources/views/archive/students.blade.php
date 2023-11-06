<x-guidance-layout>
    <div class="w-full flex">
        <div class="w-full flex flex-col p-4">

            <div class="w-full flex py-2 px-2 mb-5 border-b border-gray-300">
                <h1 class="poppins text-2xl font-medium">ARCHIVE</h1>
            </div>
            {{-- header --}}
            <div class="w-full mb-5">
                <div class="w-fit flex space-x-2">
                    <a href="{{ route('archive.students') }}" class="active-archive archive-link flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <i class='bx bx-user-circle text-2xl text-lightblack group-hover:text-white cursor-pointer'></i>
                        <label class="poppins text-sm cursor-pointer">Student</label>
                    </a>

                    <a href="{{ route('archive.faculties') }}" class="archive-link flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <i class='bx bx-user-pin text-2xl text-lightblack group-hover:text-white cursor-pointer'></i>
                        <label class="poppins text-sm cursor-pointer">Faculty</label>
                    </a>
                </div>
            </div>

            <div id="archive-container" class="w-full flex flex-col">
                <div id="student-container" class="w-full">

                    <div class="w-full flex flex-col">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-400">
                                <thead>
                                    <tr>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">NAME</th>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">LAST SECTION ATTENDED</th>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">GRADE LEVEL</th>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">REASON</th>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">PROFILE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($students->count() > 0)
                                        @foreach($students as $key => $student)
                                        <tr>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $student->user->profile->firstName . ' ' . $student->user->profile->middleName . ' ' . $student->user->profile->lastName }}</td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">
                                                {{ $student->lastSectionAttended ?? 'No Record' }}
                                            </td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">
                                            {{ $student->gradeLevelWhenArchived ?? 'No Record' }}
                                            </td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $student->reasonForArchiving ?? 'No Record' }}</td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">
                                                <a href="{{ route('archive.student.restore', $student->id) }}" class="text-xs text-blue-500 underline">Restore</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guidance-layout>


