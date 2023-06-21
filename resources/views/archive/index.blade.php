<x-guidance-layout>
    <div class="w-full flex">
        <div class="w-full flex flex-col p-4">

            <div class="w-full flex py-2 px-2 mb-5 border-b border-gray-300">
                <h1 class="poppins text-2xl font-medium">ARCHIVE</h1>
            </div>
            {{-- header --}}
            <div class="w-full mb-5">
                <div class="w-fit flex space-x-2">
                    <div class="active-archive archive-link flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <i class='bx bx-user-circle text-2xl text-lightblack group-hover:text-white cursor-pointer'></i>
                        <label class="poppins text-base cursor-pointer">Student</label>
                    </div>

                    <div class="archive-link flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <i class='bx bx-user-pin text-2xl text-lightblack group-hover:text-white cursor-pointer'></i>
                        <label class="poppins text-base cursor-pointer">Faculty</label>
                    </div>
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
                                    @if($students->count())
                                        @foreach($students as $key => $student)
                                        <tr>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name }}</td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">
                                                {{ $sectionNames[$student->section_id] ?? 'unassigned' }}
                                              </td>
                                              <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">
                                                {{ $student->grade_level ?? 'unassigned' }}
                                              </td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $student->reason ?? 'N/A' }}</td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">
                                                <a href="/archive/student/{{$student->student_id}}" class="text-xs text-blue-500 underline">View Profile</a>
                                            </td>
                                        </tr>  
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>                
                    </div>

                </div>

                <div id="faculty-container" class="hidden w-full">
                    
                    <div class="w-full flex flex-col">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-400">
                                <thead>
                                    <tr>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">NAME</th>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">EMAIL</th>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">DEPARTMENT</th>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">REASON</th>
                                        <th class="poppins text-sm border border-gray-400 px-4 py-2 text-center">PROFILE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($faculties->count())
                                        @foreach($faculties as $key => $faculty)
                                        <tr>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $faculty->first_name . ' ' . $faculty->middle_name . ' ' . $faculty->last_name }}</td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $faculty->email }}</td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center"> 
                                                @foreach ($departments as $department)
                                                    @if ($faculty->department_id == $department->id) 
                                                        {{$department->department_name}}                                  
                                                    @endif
                                                @endforeach 
                                            </td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">{{ $faculty->reason ?? 'N/A' }}</td>
                                            <td class="poppins text-sm border border-gray-400 px-4 py-2 text-center">
                                                <a href="/archive/faculty/{{$faculty->faculty_id}}" class="text-xs text-blue-500 underline">View Profile</a>
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

<script>
   $(document).ready(function() {
        
        $(".archive-link").click(function() {
       
            $(".archive-link").removeClass("active-archive");

            $(this).addClass("active-archive");

            if ($(this).find("label").text() === "Student") {

                $("#faculty-container").addClass("hidden");
                $("#student-container").removeClass("hidden");

            } else if ($(this).find("label").text() === "Faculty") {

                $("#student-container").addClass("hidden");
                $("#faculty-container").removeClass("hidden");

            }
        });
    });

</script>