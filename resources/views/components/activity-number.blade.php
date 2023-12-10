<div class="w-[60px] flex justify-center items-center border-r border-gray-400 group hover:bg-blue-700">
    <p class="poppins text-sm group-hover:hidden">{{$number}}</p> {{--{{$number}}--}}

    <a href="{{ route('activity.delete', $activity->id) }}" class="w-full h-full hidden group-hover:flex items-center justify-center ">
        <i class='bx bx-trash text-base text-white'></i>
    </a>

    {{-- <form action="{{ route('activity.delete', $activity->id) }}" method="DELETE">
        @csrf
        <button class="w-full h-full hidden group-hover:flex items-center justify-center ">
            <i class='bx bx-trash text-base text-white'></i>
        </button>
    </form> --}}
</div>
