<x-guidance-layout>
    <div id="container" class="w-full flex flex-col p-4 px-6 pb-0 relative">
        <div class="">
            <a id="back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/archive">
                <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
            </a>
        </div>

        <div class="w-full flex flex-col space-y-6 py-4 pb-6">
            <div class="w-full h-250px flex items-start space-x-4 rounded border border-gray-300 p-4">
                <div class="w-64 p-2">
                    <img  src="{{$faculty->image ? asset('storage/' . $faculty->image) : ($faculty->sex == 'Female' ? asset('image/female.png') : asset('image/male.png'))}}" alt="" class="w-full h-full rounded">
                </div>

                {{-- src="{{asset('image/profile.png')}}" --}}
    
                <div class="w-full h-fit flex p-4 ">
                    <div class="flex flex-col space-y-2">
                        <div class="flex items-center space-x-2">
                            <h1 class="poppins text-2xl font-medium">{{$faculty->first_name}}</h1>
                            <h1 class="poppins text-2xl font-medium">{{$faculty->middle_name}}</h1>
                            <h1 class="poppins text-2xl font-medium">{{$faculty->last_name}}</h1>
                        </div>
                        <div>
                            <h1 class="poppins text-base">{{$faculty->sex}}</h1>
                        </div>
                        <div>
                            @foreach ($departments as $department)
                                @if ($faculty->department_id == $department->id) 
                                <h1 class="poppins text-base">{{$department->department_name}}</h1>                                  
                                @endif
                            @endforeach    
                        </div>
                        <div>
                            <h1 class="poppins text-base">{{$faculty->email}}</h1>
                        </div>
                        <div>
                            <h1 class="poppins text-base">{{$faculty->contact_no}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full py-2 px-2 mb-4 border-b border-gray-300">
            <p class="text-base">HANDLED CLASSES</p>
        </div>

        <div class="w-full flex flex-col space-y-2 h-screen ">
            @if (count($classes) == 0)   
                <div class="h-64 w-full flex items-center justify-center">
                    <h1 class="poppins text-red-500 text-sm">No classes assigned yet.</h1>
                </div>
            @endif

            @foreach ($classes as $class)
                <div class="flex w-full space-y-2">
                    <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-md h-fit w-full">
                        <div class="collapse-title">
                            <p>{{$class->name}}</p>
                        </div>
                        <div class="collapse-content">
                            @if (isset($students[$class->section_id]))
                                @foreach ($students[$class->section_id] as $student)
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>{{$student->last_name}} {{$student->first_name}} {{$student->middle_name}}</h2>
                                        <p>remarks</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-guidance-layout>