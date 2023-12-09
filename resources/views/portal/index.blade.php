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
                                        <p>
                                            @if ($class->section->gradeLevel != 'Kinder')
                                                Grade {{ $class->section->gradeLevel }}
                                            @else
                                                {{ $class->section->gradeLevel }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="collapse-content">
                                        @foreach ($class->section->sectionSubjects as $sectionSubject)
                                            @foreach ($classes as $class)
                                                <div tabindex="0" class="collapse collapse-arrow border-b border-gray-200 bg-white mb-4">
                                                    <div class="collapse-title">
                                                        <h2>{{ $sectionSubject->subjects->name }}</h2>
                                                    </div>
                                                    <div class="collapse-content">
                                                        @foreach ($class->section->sectionSubjects as $sectionSubject)
                                                            <div class="flex justify-between p-2 px-1 border-t border-gray-200">
                                                                <h2>{{ $sectionSubject->subjects->name }}</h2>
                                                                <p>remarks</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
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
