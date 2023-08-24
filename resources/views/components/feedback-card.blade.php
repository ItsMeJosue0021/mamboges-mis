@props(['feedback'])

<a class="w-full py-2 flex flex-wrap md:flex-nowrap  hover:bg-gray-100 feedback-container rounded mb-1
    @if($feedback->isRead) bg-gray-50 @else bg-gray-100  @endif"
    href="/feedback/{{$feedback->id}}" id="feedback-{{$feedback->id}}" data-feedback-id="{{$feedback->id}}">  

    <div class="flex items-center justify-between md:flex-grow px-4" id="feedback-content-{{$feedback->id}}">
        <div class="w-1/4" id="feedback-name-{{$feedback->id}}">
            <h2 class="poppins text-base font-medium  
            @if($feedback->isRead) text-gray-500 @else text-gray-900  @endif">{{$feedback->name}}</h2>
        </div>

        <div class="w-1/2 overflow-hidden" id="feedback-message-{{$feedback->id}}">
            <p class="poppins text-sm 
            @if($feedback->isRead) text-gray-500 @else text-gray-900  @endif">{{substr($feedback->message, 0, 70)}}{{strlen($feedback->message) > 100 ? "..." : ""}}</p>
        </div>

        <div class="w-1/4 flex justify-end" id="feedback-date-{{$feedback->id}}">
            <span class="poppins text-sm 
                @if($feedback->isRead) text-gray-500 @else text-gray-900 @endif">
                @if ($feedback->created_at->diffInHours(now()) < 24)
                    {{ $feedback->created_at->format('h:i A') }}
                @else
                    {{ $feedback->created_at->format('M. d') }}
                @endif
            </span>

        </div>
    </div>
</a>





