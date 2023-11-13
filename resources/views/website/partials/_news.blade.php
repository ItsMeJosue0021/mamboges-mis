<section class="">
    <div class="w-full max-w-[1300px] mx-auto px-4">
        <div class="py-4">
            <div class="flex items-center justify-start py-8">
                <div class="w-full flex">
                    <form action="{{ route('update.index') }}" class="flex w-full justify-between space-x-4">
                        <input name="search" type="text" placeholder="Search news and annoucenments" class="w-full poppins text-base focus:outline-none border-2 border-gray-300 focus:border-gray-500 py-2 px-4 rounded">
                        <button type="submit" class="poppins text-sm text-white bg-red-600 hover:bg-red-700 hover:text-white rounded py-2 px-6">Search</button>
                    </form>
                </div>
            </div>

            <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
                @if(count($updates) == 0)
                    <div class="w-full h-96 flex flex-col items-center justify-center">
                        <img class="h-60 w-60" src="{{asset('image/search.png')}}" alt="">
                        <p class="poppins text-2xl font-medium text-red-500 mt-5">Oops! No result found.</p>
                        <a class="poppins text-xm text-blue-500 hover:underline" href="/updates">Refresh</a>
                    </div>
                @endif

                @foreach ($updates as $update)
                    <x-updates-home-card :update="$update"/>
                @endforeach

                <div class="w-full p-4 mt-5">
                    {{$updates->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
