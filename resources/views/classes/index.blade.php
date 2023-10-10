<x-faculty-layout>
    <div class="w-full flex flex-col py-4">
        <div class="w-full flex flex-wrap -m-2">
            @if (count($classes) == 0)   
                <div class="h-64 w-full flex items-center justify-center">
                    <h1 class="poppins text-red-500 text-sm">No classes assigned yet.</h1>
                </div>
            @endif
            @foreach ($classes as $class)
                <div class="p-2 lg:w-1/4 md:w-1/2 h-fit w-full group cursor-pointer">
                    <div class="h-full flex flex-col border-gray-200 border rounded-lg shadow-md group-hover:border-gray-300 group-hover:shadow-lg">
                        <div class="w-full h-32 py-4 rounded-t-lg bg-cover bg-[url('/public/image/mamboges2.png')]">
                            <div class="flex h-full items-start ">
                                <h2 class="poppins text-lg text-white font-bold p-2 bg-blue-600 bg-opacity-80 rounded-r-md">{{$class->name}}</h2>
                            </div>
                        </div>
                        <div class="flex items-center rounded p-2 w-fit ">
                            <a class="poppins text-sm text-black group-hover:text-blue-700" href="/classes/{{$class->id}}/class-record">Class Record</a>
                            <i class='bx bx-right-arrow-alt text-lg text-black group-hover:text-blue-700'></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
</x-faculty-layout>