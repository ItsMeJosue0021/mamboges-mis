<x-guidance-layout>
    <div id="container" class="w-full">

        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-300">
            <h1 class="hidden md:block poppins text-xl font-medium">SECTIONS</h1>
            <div class="w-full md:w-2/3 flex">
                <form action="/sections" class="flex w-full items-center justify-center md:justify-end space-x-4">
                    <div class="w-full flex items-center space-x-2 p-1">
                        <input name="search" type="text" placeholder="Type here.."
                            class="w-full md:w-[500px] poppins text-sm rounded py-2 px-4">
                        <button type="submit"
                            class="poppins bg-gray-600 hover:bg-blue-600 rounded px-6 py-1  flex justify-center items-center">
                            <i class='bx bx-search text-white text-lg'></i>
                        </button>
                    </div>
                    <a id="add"
                        class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">New</a>
                </form>
            </div>
        </div>

        <div class="h-auto p-4 overflow-auto w-full">
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-200 text-gray-800  border-b rounded">
                        <tr>
                            <th class="poppins font-semibold px-6 py-3 text-left">Name</th>
                            <th class="poppins font-semibold px-6 py-3 text-left">Grade Level</th>
                            <th class="poppins font-semibold px-6 py-3 text-left">Adviser</th>
                            <th class="poppins font-semibold px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @if (count($sections) == 0)
                            <tr>
                                <td colspan="4" class="w-full border-t px-6 py-4">
                                    <div class="flex flex-col items-center justify-center">
                                        <img class="h-40 w-40" src="{{ asset('image/search.png') }}" alt="">
                                        <a class="poppins mt-2" href="/sections">
                                            <i class='bx bx-refresh text-4xl text-blue-600'></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($sections as $section)
                            <tr class="border-b">
                                <td class="poppins text-sm border-t px-6 py-3">{{ $section->name }}</td>
                                <td class="poppins text-sm border-t px-6 py-3">{{ $section->gradeLevel }}</td>
                                <td class="poppins text-sm border-t px-6 py-3">
                                    @if ($section->faculty == null)
                                        <span class="text-gray-400">No Adviser</span>
                                    @else
                                        {{ $section->faculty->user->profile->firstName }}
                                        {{ $section->faculty->user->profile->middleName }}
                                        {{ $section->faculty->user->profile->lastName }}
                                    @endif
                                </td>
                                <td class="poppins border-t px-6 py-3 flex space-x-4 justify-end">
                                    <a data-section-id="{{ $section->id }}" class="show-delete-modal  rounded">
                                        <i
                                            class='bx bx-trash text-red-600 hover:text-red-700 text-xl  cursor-pointer hover:scale-105 '></i>
                                    </a>
                                    <a href="{{ route('sections.edit', $section->id) }}" class="rounded">
                                        <i
                                            class='bx bx-edit text-blue-600 hover:text-blue-700 text-xl cursor-pointer hover:scale-105 '></i>
                                    </a>
                                    <a href="{{ route('sections.show', $section->id) }}">
                                        <i
                                            class='bx bxs-right-arrow-square text-blue-600 hover:text-blue-700 text-xl cursor-pointer hover:scale-105 '></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pt-4">
                {{ $sections->links() }}
            </div>

            <div>
                <x-modals.add-new-section :faculties="$faculties" />

                <div id="delete-modal" class="hidden absolute top-0 left-0 w-full h-screen z-50">
                    <div
                        class="flex flex-col w-full h-full items-center justify-center space-y-6 bg-black bg-opacity-10 p-8">
                        <div class="flex flex-col p-4 rounded-md bg-white shadow-lg space-y-2" id="delete-section-id">
                            <div class="flex space-x-2">
                                <i class='bx bx-trash text-red-500 text-xl  cursor-pointer '></i>
                                <h1 class="poppins text-lg font-medium">Delete Section</h1>
                            </div>
                            <h1 class="poppins ">Are you sure you want to delete this Section?</h1>
                            <div class="flex justify-end space-x-2 pt-4">
                                <button id="delete-cancel"
                                    class="poppins text-gray-700 bg-gray-200 rounded px-3 py-1 hover:bg-gray-300">Cancel</button>
                                <button
                                    class="delete-btn poppins text-white bg-red-500 rounded px-3 py-1">Delete</button>
                            </div>
                        </div>
                    </div>
                    <x-scripts.delete-section />
                </div>


            </div>
</x-guidance-layout>
