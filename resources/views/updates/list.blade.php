<x-guidance-layout>
    <section class="border-b rounded px-8 sticky top-[85px] bg-white">
        <div class="flex items-center justify-between py-4">
            <div class="">
                <a id="create" class="flex items-center text-sm poppins text-white bg-blue-600 hover:bg-blue-700 rounded py-2 px-4" href="/updates/create">
                    <i class='bx bx-plus text-sm font-bold mr-2'></i>
                    New
                </a>
            </div>
            <div class="w-1/2 flex justify-end">
                <form action="/updates/list" class="flex w-full justify-between space-x-4">
                    <input name="search" type="text" placeholder="Search for news and announcements" 
                    class="w-full poppins text-sm focus:outline-none focus:bg-gray-100 border-gray-300 py-2 px-4 rounded">
                    <button type="submit" class="poppins text-sm text-white bg-blue-600 hover:bg-blue-700 hover:text-white rounded py-2 px-6">Search</button>
                </form>
            </div>
        </div>
    </section>
    <section class=" text-gray-600 body-font  scrollbar-thin">
        <div class="px-8 py-14 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                @if(count($updates) == 0)
                    <div class="w-full h-96 flex flex-col items-center justify-center mt-20">
                        <img class="h-60 w-60" src="{{asset('image/search.png')}}" alt="">
                        <p class="poppins text-xl  text-red-500 mt-5">Oops! No result found.</p>
                        <a class="poppins text-xm text-blue-500 underline" href="/updates/list">refresh</a>
                    </div>
                @endif
                @foreach ($updates as $update)
                    <x-updates-list-card :update="$update"/>
                @endforeach 
            </div>
        </div>
    </section>
</x-guidance-layout>
