<x-guidance-layout>
    <section class="border-b rounded px-4 bg-white">
        <div class="flex md:flex-row flex-col items-center justify-between py-4 bg-white">
            <div class="hidden md:flex items-center space-x-4">
                <a id="create" class="flex items-center text-sm poppins text-white bg-blue-600 border border-blue-600 hover:bg-blue-700 rounded py-2 px-4" href="/updates/create">
                    <i class='bx bx-plus text-sm font-bold mr-2'></i>
                    New
                </a>

                <a class="flex items-center text-sm poppins text-blue-600 border border-blue-600 bg-white  rounded py-2 px-4" href="{{ route('tags.list') }}">
                    Manage Tags
                </a>
            </div>
            <div class="w-full md:w-1/2 flex justify-end">
                <form action="/updates/list" class="flex w-full justify-between space-x-4">
                    <input name="search" type="text" placeholder="Type here.."
                    class="w-full poppins text-sm focus:outline-none focus:bg-gray-100 border-gray-300 py-2 px-4 rounded">
                    <button type="submit" class="poppins text-sm text-white bg-blue-600 hover:bg-blue-700 hover:text-white rounded py-2 px-6">Search</button>
                </form>
            </div>
        </div>
    </section>
    <div class="flex md:hidden items-center space-x-4 px-4 py-4">
        <a id="create" class="flex items-center text-sm poppins text-white bg-blue-600 border border-blue-600 hover:bg-blue-700 rounded py-2 px-4" href="/updates/create">
            <i class='bx bx-plus text-sm font-bold mr-2'></i>
            New
        </a>

        <a class="flex items-center text-sm poppins text-blue-600 border border-blue-600 bg-white  rounded py-2 px-4" href="{{ route('tags.list') }}">
            Manage Tags
        </a>
    </div>
    <section class=" text-gray-600 body-font scrollbar-thin">
        <div class="px-4 py-6 mx-auto">
            <div class="hidden md:block -my-8 divide-y-2 divide-gray-100">
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
            <div class="w-full md:hidden">
                @if(count($updates) == 0)
                    <div class="w-full h-96 flex flex-col items-center justify-center ">
                        <img class="h-60 w-60" src="{{asset('image/search.png')}}" alt="">
                        <p class="poppins text-xl  text-red-500 mt-5">Oops! No result found.</p>
                        <a class="poppins text-xm text-blue-500 underline" href="/updates/list">refresh</a>
                    </div>
                @endif
                @foreach ($updates as $update)
                    <div class="w-full md:w-1/3 sm:mb-0 mb-6 flex flex-col space-y-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="rounded-lg h-64 overflow-hidden">
                            <img alt="content" class="object-cover object-center h-full w-full border border-gray-200"
                            src="{{$update->cover_photo ? asset('storage/' . $update->cover_photo) : asset('image/mamboges.jpg')}}">
                        </div>
                        <div class="flex items-center space-x-4 mt-5">
                            <h2 class="poppins text-xl font-semibold title-font text-gray-900">{{substr($update->title, 0, 30)}}{{strlen($update->title) > 30 ? "..." : ""}}</h2>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="poppins mt-1 text-gray-500 text-sm">{{$update->created_at}}</span>
                            <a class="text-xs text-red-600 py-1 px-2 border border-red-600 rounded" href="/updates/list?tag={{$update->tag->tag}}">{{$update->tag->tag ?? ''}}</a>
                        </div>
                        <div>
                            {!! substr($update->description, 0, 45) !!}{{ strlen($update->description) > 45 ? "..." : "" }}
                        </div>
                        <a class="w-full text-center poppins px-2 py-1 text-sm text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white" href="{{ route('update.show', $update->id) }}">Read More</a>
                        <div class="w-fit flex items-center space-x-2 mt-1 rounded">
                            <a href="/updates/{{ $update->id }}/edit">
                                <i class='bx bx-edit text-blue-500 text-base cursor-pointer rounded bg-blue-50 py-1 px-2'></i>
                            </a>
                            <form method="POST" action="/updates/{{ $update->id }}/delete">
                                @method('DELETE')
                                @csrf
                                <button>
                                    <i class='bx bx-trash text-red-500 text-base rounded bg-red-50 cursor-pointer py-1 px-2'></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-guidance-layout>
