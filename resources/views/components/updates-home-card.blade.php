@props(['update'])
<div class="p-4 md:w-1/3 sm:mb-0 mb-6" data-aos="fade-up" data-aos-delay="300"> 
    <div class="rounded-lg h-64 overflow-hidden">
        <img alt="content" class="object-cover object-center h-full w-full" 
        src="{{$update->image ? asset('storage/' . $update->image) : asset('image/mamboges.jpg')}}">
    </div>
    <div class="flex items-center space-x-4 mt-5">
        <h2 class="poppins text-xl font-semibold title-font text-gray-900">{{substr($update->title, 0, 30)}}{{strlen($update->title) > 30 ? "..." : ""}}</h2>
    </div>
    <div class="flex items-center space-x-4 py-2">
        <span class="poppins mt-1 text-gray-500 text-sm">{{$update->created_at}}</span>
        <a class="text-xs text-red-600 py-1 px-2 border border-red-600 rounded" href="/updates?tag={{$update->tag}}">{{$update->tag}}</a>
    </div>
    <div>
        {{-- {{substr($update->description, 0, 45)}}{{strlen($update->description) > 45 ? "..." : ""}} --}}
        {{-- {!! $update->description !!} --}}
        {!! substr($update->description, 0, 45) !!}{{ strlen($update->description) > 45 ? "..." : "" }}
    </div>
    <a class="poppins text-indigo-500 inline-flex items-center mt-3 p-2 px-4 rounded bg-lightgray" href="/updates/{{$update->id}}">See More</a>
</div>