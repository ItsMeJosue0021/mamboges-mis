<x-guidance-layout>
    <div class="w-full flex flex-col p-4">
        <div class="w-full flex flex-wrap -m-2">
            @if (count($classes) == 0)   
                <h1 class="poppins text-red-500 text-sm">No data</h1>
            @endif
            @foreach ($classes as $class)
                <div class="p-2 lg:w-1/4 md:w-1/2 w-full">
                    <div class="h-full flex flex-col border-gray-200 border rounded-lg hover:shadow-md hover:border-gray-400">
                        <div class="w-full h-40 bg-mambog rounded-t-lg">
                            <img class="w-full h-full rounded-t-lg opacity-90" src="{{asset('image/mamboges.jpg')}}" alt="">
                        </div>
                        <div class="flex-grow p-4">
                            <h2 class="poppins text-gray-900 title-font font-semibold">{{$class->name}}</h2>
                            <div class="group flex items-center">
                                <a class="poppins text-sm group-hover:underline text-gray-500 group-hover:text-blue-500" href="/classes/{{$class->id}}/class-record">Class record</a>
                                <i class='bx bx-right-arrow-alt text-lg text-gray-500 group-hover:text-blue-500'></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
</x-guidance-layout>