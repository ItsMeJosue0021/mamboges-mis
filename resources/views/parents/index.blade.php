<x-guidance-layout>
    <div id="container" class="w-full relative">

        <div class="flex justify-between items-center px-4 py-4 border-b border-gray-300">
            <div class="flex border-l-4 border-red-400 py-1 px-2">
                <h1 class="poppins text-2xl font-medium">FACULTY</h1>
            </div>
            <div class="w-2/3 flex">
                <form action="" class="flex w-full justify-end space-x-4">
                    <input name="search" type="text" placeholder="Search for news and announcements" 
                    class="w-500px poppins text-sm focus:outline-none focus:bg-blue-100 border border-gray-400 rounded focus:border-blue-400 py-2 px-4">
                    <button type="submit" class="poppins text-sm bg-white text-blue-600 border border-blue-600 rounded py-2 px-6">Search</button>
                    {{-- <a id="add" class="poppins py-2 px-4 bg-blue-600 text-sm text-white font-medium rounded cursor-pointer">Add Faculty</a> --}}
                </form>
            </div>
        </div>

        <div class="h-580px px-4 overflow-auto w-full">
            <div class="h-full flex flex-col">
                <a class="flex justify-between py-1 px-4 border-b border-gray-300  items-center">
                    <p class="w-full poppins text-lg font-semibold">NAME</p>
                    {{-- <p class="w-full poppins text-lg font-semibold">DEPARTMENT</p> --}}

                    <div class="flex items-center space-x-2 h-fit">
                        <i class='bx bx-trash text-gray-500 text-xl py-1 px-2 bg-red-50' ></i>
                        <i class='bx bx-edit text-gray-500 text-xl py-1 px-2  bg-blue-50'></i>
                    </div>
                </a>
            @if(count($parents) == 0)
                <div class="w-full h-96 flex flex-col items-center justify-center mt-20">
                    <img class="h-60 w-60" src="{{asset('image/search.png')}}" alt="">
                    <p class="poppins text-xl  text-red-500 mt-5">Oops! No result found.</p>
                    <a class="poppins text-xm text-blue-500 underline" href="/updates/list">refresh</a>
                </div>
            @endif
            @foreach ($parents as $parent)
                {{-- href="/sections/{{$section->id}}" --}}
                <a class="w-full flex"> 
                    <div class="flex justify-between py-1 px-4 border-b border-gray-300 items-center">
                        <p class="w-full poppins text-base font-normal">
                            {{$parent->suffix}} {{$parent->first_name}} {{$parent->middle_name}} {{$parent->last_name}}
                        </p>

                        {{-- <p class="w-full poppins text-base">
                            Department Name
                        </p> --}}

                        <div class="flex items-center space-x-2 h-fit">
                            {{-- data-section-id="{{$section->id}}" --}}
                            <a class="delete-btn py-1 px-2 rounded hover:bg-red-50" >
                                <i class='bx bx-trash text-red-500 text-xl  cursor-pointer ' ></i>
                            </a>
                            {{-- href="/sections/{{$section->id}}/edit" --}}
                            <a class="py-1 px-2 rounded hover:bg-blue-50" >
                                <i class='bx bx-edit text-blue-500 text-xl cursor-pointer '></i>
                            </a>
                        </div>
                    </div>
                </a>
            @endforeach
        <div>
    </div>
</x-guidance-layout>