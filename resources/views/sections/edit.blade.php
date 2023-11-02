<x-guidance-layout>
    <div class="p-4">
        <div class="flex flex-col space-y-2 mb-4">
            <a href="{{ route('sections.index') }}" id="back" class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>
        <div  id="container" class="w-full h-full flex items-center justify-center">
            <form  method="POST" action="{{ route('sections.update', $section->id) }}" class="w-500px flex flex-col space-y-2 p-6 rounded-md border border-gray-300 shadow">
                @csrf
                @method('PUT')
                <div class="w-full flex">
                    <h1 class="poppins text-xl text-gray-800 font-medium">EDIT SECTION</h1>
                </div>
                <div class="get-id flex flex-col space-y-1" id="{{$section->id}}">
                    <div class="flex items-baseline space-x-2">
                        <label for="name"
                        class="poppins text-sm font-medium text-gray-600">SECTION</label>
                        <span class="error text-xs text-red-600"></span>
                    </div>
                    <input type="text" name="name" id="name" value="{{$section->name}}"
                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="Section Name">
                </div>

                <div class="flex flex-col space-y-1">
                    <div class="flex items-baseline space-x-2">
                        <label for="gradeLevel"
                        class="poppins text-sm font-medium text-gray-600">GRADE LEVEL</label>
                        <span class="error text-xs text-red-600"></span>
                    </div>
                    <select name="gradeLevel" id="gradeLevel"
                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <option disabled>Select Grade Level</option>
                        <option value="Kinder" {{ $section->gradLevel == 'Kinder' ? 'selected' : '' }}>Kinder</option>
                        <option value="1" {{ $section->gradeLevel == '1' ? 'selected' : '' }}>Grade 1</option>
                        <option value="2" {{ $section->gradeLevel == '2' ? 'selected' : '' }}>Grade 2</option>
                        <option value="3" {{ $section->gradeLevel == '3' ? 'selected' : '' }}>Grade 3</option>
                        <option value="4" {{ $section->gradeLevel == '4' ? 'selected' : '' }}>Grade 4</option>
                        <option value="5" {{ $section->gradeLevel == '5' ? 'selected' : '' }}>Grade 5</option>
                        <option value="6" {{ $section->gradeLevel == '6' ? 'selected' : '' }}>Grade 6</option>
                    </select>
                </div>

                <div class="flex flex-col space-y-1">
                    <div class="flex items-baseline space-x-2">
                        <label for="adviser"
                        class="poppins text-sm font-medium text-gray-600">ADVISER</label>
                        <span class="error text-xs text-red-600"></span>
                    </div>
                    <select name="adviser" id="adviser"
                    class="poppins py-2 px-4 text-sm border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <option disabled selected >Select Adviser</option>
                        @foreach ($faculties as $teacher)
                        <option value="{{ $teacher->id }}" {{ $teacher->id == $section->faculty_id ? 'selected' : '' }}>
                            {{ $teacher->user->profile->firstName }}
                            {{ $teacher->user->profile->middleName }}
                            {{ $teacher->user->profile->lastName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-start space-x-4 pt-4 ">
                    <button type="submit"
                        class="poppins text-sm font-medium text-white bg-blue-600 hover:bg-blue-700  border border-blue-600 hover:border-blue-700 py-2 px-6 rounded">
                        Update
                    </button>

                    <a id="cancel" href="/sections"
                        class="poppins text-sm font-medium text-gray-400 border border-gray-400 hover:border-red-600 hover:text-red-600 py-2 px-6 rounded cursor-pointer">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guidance-layout>
