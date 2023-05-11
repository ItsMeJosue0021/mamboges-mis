<x-guidance-layout>
    <div class="w-full flex">
        <div class="w-full flex flex-col p-4">

            <div class="w-full flex border-l-4 border-red-400 py-1 px-2 mb-5 border-b border-gray-400">
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
                    <div class="flex flex-wrap -m-2">
                        @foreach ($students as $student)
                            <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                                <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                                    <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="{{asset('image/profile.png')}}">
                                    <div class="flex-grow">
                                        <h2 class="poppins text-lg text-gray-900 title-font font-medium">{{$student->last_name}}, {{$student->first_name}} {{$student->middle_name}}</h2>
                                        <p class="poppins text-sm text-gray-500">LRN: {{$student->lrn}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div id="faculty-container" class="hidden w-full">
                    <div class="flex flex-wrap -m-2">
                        @foreach ($faculties as $faculty)
                            <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                                <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                                    <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="{{asset('image/profile.png')}}">
                                    <div class="flex-grow">
                                        <h2 class="poppins text-lg text-gray-900 title-font font-medium">{{$faculty->last_name}}, {{$faculty->first_name}} {{$faculty->middle_name}}</h2>
                                        <p class="poppins text-sm text-gray-500">{{$faculty->email}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guidance-layout>

<script>
   $(document).ready(function() {
        // Add click handlers to the link elements
        $(".archive-link").click(function() {
            // Remove active class from all links
            $(".archive-link").removeClass("active-archive");
            // Add active class to the clicked link
            $(this).addClass("active-archive");

            // Show/hide the corresponding container based on which link was clicked
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