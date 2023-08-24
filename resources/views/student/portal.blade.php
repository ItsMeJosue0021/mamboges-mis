<x-app-layout>
    <div class="pt-24 p-4 px-8">
        <div class="container flex container mx-auto md:px-22 lg:px-28 ">

            <div class="w-full flex flex-col lg:flex-row items-start lg:space-x-8">

                <div class="w-full lg:w-1/4 flex flex-col items-center p-4">
                    <div class="w-64 h-64 bg-white rounded-md p-2">
                        <img class="w-full h-full rounded-md" src="{{Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('image/mamboges.jpg')}}" alt="" srcset="">
                    </div>
    
                    <div class="w-full flex flex-col space-y-4">
                        <div class="w-full flex items-center justify-center py-3 border-b border-gray-300">
                            <span>
                                <h1 class="poppins text-lg font-semibold text-gray-600">{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</h1>
                            </span>
                        </div>
                        <div class="w-full">
                            <div class="border-b border-gray-200 hover:border-blue-500">
                                <h1 class="poppins text-base  text-gray-600 hover:text-white hover:bg-blue-500 rounded px-2 py-1" >{{$student->lrn}}</h1>
                            </div>
                            <div class="border-b border-gray-200 hover:border-blue-500">
                                <h1 class="poppins text-base text-gray-600 hover:text-white hover:bg-blue-500 rounded px-2 py-1" >Section:
                                    @if ($section)
                                    {{$section->name}}
                                @else
                                    <span class="poppins text-sm text-red-400">No section yet</span>
                                @endif
                                </h1>
                            </div>
                            <div class="border-b border-gray-200 hover:border-blue-500">
                                <h1 class="poppins text-base text-gray-600 hover:text-white hover:bg-blue-500 rounded px-2 py-1" >
                                    @if ($student_section == null)
                                    <span class="text-blue-400 text-sm">Waiting for section assignment</span>
                                    @elseif ($student_section->grade_level == 'kinder')
                                        Kinder
                                    @else
                                        Grade {{ $student_section->grade_level }}
                                    @endif
                                </h1>
                            </div>
                            <div class="border-b border-gray-200 hover:border-blue-500">
                                <h1 class="poppins text-base text-gray-600 hover:text-white hover:bg-blue-500 rounded px-2 py-1" >Birthdate: {{date('F j, Y', strtotime($student->dob))}}</h1>
                            </div>

                        </div>
                        <div class="">
                            <p>SCHOOL YEAR: <span class="text-blue-500">{{$schoolYear}}</span></p>
                        </div>
                    </div>
                </div>
        
                <div class="w-full lg:w-3/4 flex py-4">
                    <div class="w-full flex flex-col py-4 space-y-4">
                        <div class="w-full flex items-center border-b border-gray-300 p-2">
                            <h1 class="poppins text-xl font-medium text-gray-600">CLASSES</h1>
                        </div>

                        <div class="w-full flex flex-col space-y-2">

                            <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-md">
                                <div class="collapse-title">
                                  <p>Grade 6</p>
                                </div>
                                <div class="collapse-content">

                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>

                                </div>
                            </div>

                            <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-md">
                                <div class="collapse-title">
                                  <p>Grade 5</p>
                                </div>
                                <div class="collapse-content">

                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>

                                </div>
                            </div>

                            <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-md">
                                <div class="collapse-title">
                                  <p>Grade 4</p>
                                </div>
                                <div class="collapse-content">

                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                </div>
                            </div>

                            <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-md">
                                <div class="collapse-title">
                                  <p>Grade 3</p>
                                </div>
                                <div class="collapse-content">

                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                </div>
                            </div>

                            <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-md">
                                <div class="collapse-title">
                                  <p>Grade 2</p>
                                </div>
                                <div class="collapse-content">

                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                </div>
                            </div>

                            <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-md">
                                <div class="collapse-title">
                                  <p>Grade 1</p>
                                </div>
                                <div class="collapse-content">

                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                    <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                        <h2>Subject name</h2>
                                        <p>remarks</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>