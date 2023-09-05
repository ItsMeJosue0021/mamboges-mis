@php
    $score = $student->scores->where('activity_id', $activity->id)->first();
    $scoreValue = $score ? $score->score : " ";
@endphp

<div class="w-[60px] flex justify-start border-r border-gray-400 focus:border-r-0  ">
    <input 
    class="student-grade w-full h-full border-0 focus:border-2 border-blue-600 poppins text-center text-sm" 
    type="number" 
    max="{{$activity->max_score}}"
    min="0"
    name="scores[{{ $student->id }}][{{ $activity->id }}]" 
    value="{{ $scoreValue }}"
    placeholder="0"
    >
</div> 

<script type="module">
    $(document).ready(function() {

        $(".student-grade").on("input", function() {
            var min = parseFloat($(this).attr("min"));
            var max = parseFloat($(this).attr("max"));
            var value = parseFloat($(this).val());

            if (isNaN(value)) {
                $(this).val(min);
            } else if (value < min) {
                $(this).val(min);
            } else if (value > max) {
                $(this).val(max);
            }
        });
    });
</script>

