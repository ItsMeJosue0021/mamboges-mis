<div id="assessment-modal" class="hidden">
    <div class="flex w-full absolute top-0 left-0 pt-40 items-center justify-center">
        <div class="w-96 h-fit rounded-md bg-white shadow-2xl bg-gradient-to-b from-gray-100 to-white">
            <form class="flex flex-col space-y-3 py-4 px-6"  method="post" action="{{route('activity.store')}}"> {{--action="{{route('activity.store')}}"--}}
                @csrf
                <div>
                    <h1 class="poppins font-semibold">NEW ASSESSMENTK</h1>
                </div>
                <div class="flex flex-col space-y-1">
                    <label class="poppins text-sm" for="">Name</label>
                    <input class="poppins text-sm py-2 px-4 rounded border border-gray-300" type="text" name="name">
                </div>
                <div class="flex flex-col space-y-1">
                    <label class="poppins text-sm" for="">Highest Possible Score</label>
                    <input type="number" min="0" class="poppins text-sm py-2 px-4 rounded border border-gray-300" name="max_score" >
                </div>
                 <input type="hidden" name="evaluation_criteria_id" value="{{ $evaluations->skip(2)->first()->id }}"> {{--data-evaluation-id="{{ $evaluations->first()->id }}" --}}
                <div class="flex items-center justify-end space-x-4 pt-2">
                    <button  type="submit" class="poppins text-sm text-white bg-blue-800  hover:bg-[#004080] border border-blue-800 hover:border-[#004080] py-2 px-6 rounded">Save</button>
                    <a id="assessment-cancel" class="poppins cursor-pointer px-6 py-2 hover:bg-gray-200 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div> 
</div>

