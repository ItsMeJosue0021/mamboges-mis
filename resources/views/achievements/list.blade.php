<x-guidance-layout>
    <section class="border-b rounded px-4 sticky top-[85px] bg-white">
        <div class="flex items-center justify-between py-4">
            <div class="">
                <a id="create" class="hidden md:flex items-center text-sm poppins text-white bg-blue-600 hover:bg-blue-700 rounded py-2 px-4" href="{{ route('achievements.create') }}">
                    <i class='bx bx-plus text-sm font-bold mr-2'></i>
                    New
                </a>
            </div>
            <div class="w-full md:w-1/2 flex justify-end">
                <form action="{{ route('achievements.list') }}" class="flex w-full justify-between space-x-4">
                    <input name="search" type="text" placeholder="Type here.."
                    class="w-full poppins text-sm focus:outline-none focus:bg-gray-100 border-gray-300 py-2 px-4 rounded">
                    <button type="submit" class="poppins text-sm text-white bg-blue-600 hover:bg-blue-700 hover:text-white rounded py-2 px-6">Search</button>
                </form>
            </div>
        </div>
    </section>
    <div class="md:hidden w-full flex p-4">
        <a id="create" class="w-fit flex items-center text-sm poppins text-white bg-blue-600 hover:bg-blue-700 rounded py-2 px-4" href="{{ route('achievements.create') }}">
            <i class='bx bx-plus text-sm font-bold mr-2'></i>
            New
        </a>
    </div>
    <section class=" text-gray-600 body-font  scrollbar-thin">
        <div class="px-4 py-14 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                @if(count($achievements) == 0)
                    <div class="w-full h-96 flex flex-col items-center justify-center mt-20">
                        <img class="h-60 w-60" src="{{asset('image/search.png')}}" alt="">
                        <p class="poppins text-xl  text-red-500 mt-5">Oops! No result found.</p>
                        <a class="poppins text-xm text-blue-500 underline" href="/updates/list">refresh</a>
                    </div>
                @endif

                <div class="flex flex-col space-y-6">
                    @foreach ($achievements as $achievement)
                    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                        <div class="md:w-48 flex-shrink-0 flex flex-col">
                            <img class="rounded h-full"
                            src="{{$achievement->coverPhoto ? asset('storage/' . $achievement->coverPhoto) : asset('image/mamboges.jpg')}}"
                            alt="image">
                         </div>

                         <div class="md:flex-grow">
                             <div class="flex items-start space-x-4">
                                 <h2 class="poppins text-lg font-medium text-gray-900 title-font">{{$achievement->title}}</h2>
                             </div>
                             <div class="mb-1">
                                 <span class="poppins mt-1 text-gray-500 text-xs">{{$achievement->created_at->format('M. d, Y')}}</span>
                             </div>
                             <p class="poppins text-sm">{!! substr($achievement->description, 0, 250) !!}{{ strlen($achievement->description) > 250 ? "..." : "" }}</p>
                             <div class="w-fit flex items-center space-x-2 mt-1 rounded">
                                 <a  href="{{ route('achievements.edit', $achievement->id) }}">
                                     <i class='bx bx-edit text-blue-500 text-base cursor-pointer rounded bg-blue-50 py-1 px-2'></i>
                                 </a>
                                 <form method="POST" action="{{ route('achievements.delete', $achievement->id) }}">
                                     @method('DELETE')
                                     @csrf
                                     <button>
                                         <i class='bx bx-trash text-red-500 text-base rounded bg-red-50 cursor-pointer py-1 px-2' ></i>
                                     </button>
                                 </form>
                             </div>
                         </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-guidance-layout>
