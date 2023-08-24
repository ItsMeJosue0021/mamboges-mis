@php
    $score = $student->scores->where('activity_id', $activity->id)->first();
    $scoreValue = $score ? $score->score : null;
@endphp

<div class="w-[60px] flex justify-start border-r border-gray-400 focus:border-r-0  ">
    <input 
    class="w-full h-full poppins appearance-none text-center text-sm border-0" 
    type="number" 
    name="scores[{{ $student->id }}][{{ $activity->id }}]" value="{{ $scoreValue }}"
    placeholder="0"
    >
</div> 