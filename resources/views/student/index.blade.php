<x-guidance-layout>
    <div id="container" class="w-full">
        {{-- <div class="fixed z-30 top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-14 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div> --}}
        <div class="flex justify-between items-center px-4 py-4 border-b border-gray-300">
            <h1 class="poppins text-2xl font-medium">LEARNERS</h1>
            <div class="w-2/3 flex">
                <form action="{{ route('student.index') }}" class="flex w-full items-center justify-end space-x-4">
                    <div class="flex items-center space-x-1 p-1">
                        <input name="search" type="text" placeholder="Search by First name, Last name or LRN.."
                            class="w-500px poppins text-sm focus:outline-none focus:bg-blue-100 border border-gray-400 rounded focus:border-blue-400 py-2 px-4">
                        <button type="submit"
                            class="poppins bg-gray-600 hover:bg-blue-600 rounded px-3 py-1  flex justify-center items-center">
                            <i class='bx bx-search text-white text-lg'></i>
                        </button>
                    </div>
                    <a href="{{ route('student.create') }}" class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">New</a>
                </form>
            </div>
        </div>

        <div class="w-full px-4 overflow-auto">
            <div class="w-full py-4 px-2">
                <div class="w-fit flex space-x-2">
                    <a data-grade-level="0" href="{{ route('student.index') }}"
                        class="level flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <p class="poppins text-base cursor-pointer no-underline">All</p>
                    </a>

                    <a data-grade-level="1" href="{{ route('student.index', ['grade_level' => 'Kinder']) }}"
                        class="level flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <label class="poppins text-base cursor-pointer">Kinder</label>
                    </a>

                    <a data-grade-level="2" href="{{ route('student.index', ['grade_level' => '1']) }}"
                        class="level flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <label class="poppins text-base cursor-pointer">Grade 1</label>
                    </a>

                    <a data-grade-level="3" href="{{ route('student.index', ['grade_level' => '2']) }}"
                        class="level flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <label class="poppins text-base cursor-pointer">Grade 2</label>
                    </a>

                    <a data-grade-level="4" href="{{ route('student.index', ['grade_level' => '3']) }}"
                        class="level flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <label class="poppins text-base cursor-pointer">Grade 3</label>
                    </a>

                    <a data-grade-level="5" href="{{ route('student.index', ['grade_level' => '4']) }}"
                        class="level flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <label class="poppins text-base cursor-pointer">Grade 4</label>
                    </a>

                    <a data-grade-level="6" href="{{ route('student.index', ['grade_level' => '5']) }}"
                        class="level flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <label class="poppins text-base cursor-pointer">Grade 5</label>
                    </a>

                    <a data-grade-level="7" href="{{ route('student.index', ['grade_level' => '6']) }}"
                        class="level flex items-center space-x-2 rounded py-1 px-4 bg-gray-200 group hover:bg-blue-400 hover:text-white cursor-pointer">
                        <label class="poppins text-base cursor-pointer">Grade 6</label>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="pt-4 py-2 flex space-x-3 items-center">
                        <h1>TOTAL LEARNERS:</h1>
                        <h1 id="total-student"
                            class="text-base text-blue-400 font-medium px-2 border border-blue-400 rounded">
                            {{ $totalLearners }}</h1>
                    </div>

                    <div class="pt-4 py-2 flex space-x-3 items-center">
                        <h1>RESULT COUNT:</h1>
                        <h1 id="enrolled-student"
                            class="text-base text-blue-400 font-medium px-2 border border-blue-400 rounded">
                            {{ $resultCount }}</h1>
                    </div>
                </div>
            </div>

            <div class="w-full flex flex-col space-y-2 px-2">
                @if (count($students) == 0)
                    <div class="w-full flex justify-center items-center rounded p-2 border border-gray-300">
                        <span class="font-semibold text-base poppins">No results found.</span>
                    </div>
                @else
                    @foreach ($students as $student)
                        <div class="w-full flex items-center justify-between rounded p-2 border border-gray-200">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $student->user->profile->image ? asset('storage/' . $student->user->profile->image) : asset('image/mamboges.jpg') }}"
                                    alt="" srcset="" class="w-10 h-10 rounded">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-base poppins">
                                        {{ $student->user->profile->firstName }}
                                        {{ $student->user->profile->middleName }}
                                        {{ $student->user->profile->lastName }}
                                    </span>
                                    <span class="text-sm text-gray-600 poppins">{{ $student->lrn }}</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('student.show', $student->id) }}"
                                    class="poppins py-2 px-4 bg-blue-600 text-xs text-white font-medium rounded cursor-pointer">View</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="w-full poppins px-2 py-4">
                <div class="pagination">
                    {{ $students->links() }}
                </div>
            </div>

            {{-- Add new student modal --}}
            <x-addstudent-modal />

            <div>

            </div>
</x-guidance-layout>
<script type="module" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="module" src="{{ asset('js/student_index.js') }}"></script>

<script type="module">
    const levels = document.querySelectorAll('.level');
    const activeLevelId = localStorage.getItem('activeLevelId');

    if (activeLevelId) {
        const activeLevel = document.querySelector(`[data-grade-level="${activeLevelId}"]`);
        if (activeLevel) {
            activeLevel.classList.add('active-level');
        }
    } else {
        // Set the initial active level to the first level
        levels[0].classList.add('active-level');
        localStorage.setItem('activeLevelId', levels[0].getAttribute('data-grade-level'));
    }

    levels.forEach(level => {
        level.addEventListener('click', (event) => {
            // event.preventDefault(); // Prevent the default behavior (page reload)
            const levelId = level.getAttribute('data-grade-level');

            levels.forEach(otherLevel => {
                otherLevel.classList.remove('active-level');
            });

            level.classList.add('active-level');
            localStorage.setItem('activeLevelId', levelId);
        });
    });
</script>
