@props(['update'])
<div class="w-full p-4 md:w-1/3 sm:mb-0 mb-6 flex flex-col space-y-1" data-aos="fade-up" data-aos-delay="300">
    <div class="rounded-md h-64 overflow-hidden border border-gray-200">
        <img class="object-cover object-top h-full w-full"
        src="{{$update->cover_photo ? asset('storage/' . $update->cover_photo) : ''}}">
    </div>
    <div class="flex items-center space-x-4">
        <h2 class="poppins text-sm font-semibold title-font text-gray-900">{{substr($update->title, 0, 30)}}{{strlen($update->title) > 30 ? "..." : ""}}</h2>
    </div>
    <div class="flex items-center space-x-4">
        <span class="poppins mt-1 text-gray-500 text-xs">{{$update->created_at}}</span>
        <a class="text-xs text-red-600 py-1 px-2 border border-red-600 rounded" href="/news-and-announcements?tag={{$update->tag->tag}}">{{$update->tag->tag ?? ''}}</a>
    </div>
    <div class="text-xs">
        {!! substr($update->description, 0, 100) !!}{{ strlen($update->description) > 100 ? "..." : "" }}
    </div>
    <a class="w-full text-center poppins px-2 py-1 text-xs text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white" href="{{ route('update.show', $update->id) }}">Read More</a>
</div>
