@props(['update'])
<div class="py-8 flex flex-wrap md:flex-nowrap items-center space-x-4">
    <div class="md:w-64 h-56 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
       <img class="rounded h-full" 
       src="{{$update->image ? asset('storage/' . $update->image) : asset('image/mamboges.jpg')}}"
       alt="image">
    </div>
    
    <div class="md:flex-grow">
        <div class="flex items-start space-x-4">
            <h2 class="poppins text-xl font-medium text-gray-900 title-font mb-1">{{$update->title}}</h2>
            <a class="text-xs text-red-600 py-1 px-2 border border-red-600 rounded" href="/updates/list?tag={{$update->tag}}" >{{$update->tag}}</a>
        </div>
        <div class="mb-1">
            <span class="poppins mt-1 text-gray-500 text-sm">{{$update->created_at->format('M. d, Y')}}</span>
        </div>
        <p class="poppins text-sm">{{substr($update->description, 0, 300)}}{{strlen($update->description) > 300 ? "..." : ""}}</p>
        <div class="w-fit flex items-center space-x-2 py-1 px-2 mt-4 rounded border border-gray-200">
            <a  href="/updates/{{$update->id}}/edit">
                <i class='bx bx-edit text-blue-500 text-xl cursor-pointer rounded hover:bg-blue-50 py-1 px-2'></i>
            </a>
            <form method="POST" action="/updates/{{$update->id}}/delete">
                @method('DELETE')
                @csrf
                <button>
                    <i class='bx bx-trash text-red-500 text-xl rounded hover:bg-red-50 cursor-pointer py-1 px-2' ></i>
                </button>
            </form>
        </div>
    </div>
</div>