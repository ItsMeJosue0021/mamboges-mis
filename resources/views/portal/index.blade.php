<x-app-layout>
    <div class="pt-20 bg-white text-gray-700">
        <div class="flex w-full max-w-[1400px] mx-auto px-4 ">
            <div class="w-full flex flex-col lg:flex-row items-start lg:space-x-8">
                <div class="w-full flex py-4">
                    <div class="w-full flex flex-col pb-4 space-y-4">
                        <div class="w-full flex items-center border-b border-gray-300 p-2">
                            <h1 class="poppins text-xl font-medium text-gray-600">CLASSES</h1>
                        </div>

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
                                    <div class="collapse-content">
                                        @foreach ($class->section->sectionSubjects as $sectionSubject)
                                            <div  class=" border-b border-gray-200 bg-white mb-6">
                                                <div class="py-2 px-2 bg-gray-400 rounded">
                                                    <h2 class="font-bold text-white ">
                                                        {{ $sectionSubject->subjects->name }} |
                                                        <span class="font-normal ">
                                                            {{ $sectionSubject->faculty ? $sectionSubject->faculty->user->profile->firstName : '' }}
                                                            {{ $sectionSubject->faculty ? $sectionSubject->faculty->user->profile->middleName : '' }}
                                                            {{ $sectionSubject->faculty ? $sectionSubject->faculty->user->profile->lastName : ''}}
                                                        </span>
                                                    </h2>
                                                </div>
                                                <div>
                                                    @php
                                                        $student_grades = $grades->where('subjects_id', $sectionSubject->subjects->id)->where('school_year_id', $sectionSubject->schoolYear->id);
                                                    @endphp
                                                    @foreach ($student_grades as $grade)
                                                        <div class="flex justify-between py-2 px-2 border-t border-gray-200">
                                                            <span class="text-sm">{{ $grade->quarter->name }}</span>
                                                            <span class="text-sm">{{ $grade->remarks }}</span>
                                                        </div>
                                                    @endforeach
                                                    @if (count($student_grades) == 0)
                                                        <div class="flex justify-center py-2 border-t border-gray-200">
                                                            <span class="text-sm text-center text-red-500">No Grades Yet</span>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
