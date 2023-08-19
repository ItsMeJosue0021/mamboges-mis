<x-faculty-layout>
    <div class="w-full flex flex-col py-4">
        <div class="w-full flex flex-wrap -m-2">
            @if (count($classes) == 0)   
                <div class="h-64 w-full flex items-center justify-center">
                    <h1 class="poppins text-red-500 text-sm">No classes assigned yet.</h1>
                </div>
            @endif
            @foreach ($classes as $class)
                <div class="p-2 lg:w-1/4 md:w-1/2 w-full group cursor-pointer">
                    <div class="h-full flex flex-col border-gray-200 border rounded-lg shadow-md group-hover:border-gray-300 group-hover:shadow-lg">
                        <div class="w-full h-40 bg-mambog rounded-t-lg">
                            <img class="w-full h-full rounded-t-lg " src="{{asset('image/mamboges2.png')}}" alt="">
                        </div>
                        <div class="flex flex-col space-y-2 p-4">
                            <h2 class="poppins text-base text-blue-700 font-semibold">{{$class->name}}</h2>
                            <div class="flex items-center group-hover:bg-blue-700 rounded px-2 w-fit border border-gray-400 group-hover:border-0">
                                <a class="poppins text-sm text-black group-hover:text-white" href="/classes/{{$class->id}}/class-record">Class Record</a>
                                <i class='bx bx-right-arrow-alt text-lg text-black group-hover:text-white'></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
</x-faculty-layout>